<?php

namespace App\Http\Controllers;

use App\Models\booking_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use App\Models\users;
use App\Models\booking_addons;
use Validator;
use Input;
use Session;
use Carbon;


class BookingController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
   
    public function booking_view()
    {   
        $booking_id=0;
        if(Session::has('booking_id')){
            $booking_id=Session::get('booking_id');
        }
        $otp=random_int(1000,9999);
        $check_booking=booking_view::where("booking_by_cid","=",session('consumer_id'))
        ->where("booking_id","=",$booking_id)->count();
        $cat_type=DB::table('ambulance_category')->where('ambulance_category_name','=',session("ambu_type"))->get(['ambulance_category_type']);
        $catagory=DB::table('ambulance_facilities')->where('ambulance_facilities_category_type','=',$cat_type[0]->ambulance_category_type)->pluck('ambulance_facilities_name')->all();
        $includes=implode(',',$catagory);
        $b_details=DB::select("SELECT * FROM ambulance_category JOIN ambulance_base_rate ON ambulance_category.ambulance_category_type = ambulance_base_rate.ambulance_base_rate_cat_type JOIN ambulance_rate ON ambulance_rate.ambulance_rate_category_type = ambulance_category.ambulance_category_type WHERE ".session('distance') ." BETWEEN ambulance_rate_starting_km AND ambulance_rate_end_km" ); 
        foreach($b_details as $detail){
            if($detail->ambulance_category_name==session("ambu_type")){
                $details=$detail;
                break;
            }
        }
        

        if($check_booking=='0'){
            
            
            $distance=Session::get('distance');
            if($distance>$details->ambulance_base_rate_till_km){
                $km_rate=($distance-$details->ambulance_base_rate_till_km)*1.5*15;
            }
            else{
                $km_rate=0;
            }
            
            $total_fare=$km_rate+$details->ambulance_base_rate_amount;
            $service_charge=$total_fare*($details->ambulance_rate_service_charge/100);
            
            $booking = new booking_view;  
            $booking->booking_source='WEBSITE';        
            $booking->booking_type='0';        
            $booking->booking_type_for_rental='';
            $booking->booking_by_cid=session('consumer_id');  
            $booking->booking_view_otp=$otp;   
            $booking->booking_view_status_otp='1';  
            $booking->booking_con_name = "";
            $booking->booking_con_mobile ="";
            $booking->booking_category =$details->ambulance_category_type;
            $booking->booking_schedule_time =Session::get('users.schedule-time');
            $booking->booking_pickup =Session::get('users.pick');
            $booking->booking_drop =Session::get('users.drop');
            $booking->booking_pick_lat =Session::get('users.pick_lat');
            $booking->booking_pick_long =Session::get('users.pick_lng');
            $booking->booking_drop_lat =Session::get('users.drop_lat');
            $booking->booking_drop_long =Session::get('users.drop_lng');
            $booking->booking_amount =session("ambu_price");
            $booking->booking_adv_amount=" ";
            $booking->booking_payment_type =" ";
            $booking->booking_payment_method =" ";
            $booking->booking_distance =Session::get('distance');
            $booking->booking_duration =Session::get('duration');
            $booking->booking_polyline =Session::get('polyline');
            $booking->booking_total_amount ="";
            $booking->booking_status ="0";
            $booking->booking_payment_status ="1";
            $booking->booking_acpt_driver_id ="0";
            $booking->booking_acpt_vehicle_id="0";
            $booking->booking_acpt_time='0';
            $booking->booking_ap_polilyne='NA';
            $booking->booking_view_category_name=$details->ambulance_category_name;
            $booking->booking_view_category_icon=$details->ambulance_category_icon;
            $booking->booking_view_base_rate=$details->ambulance_base_rate_amount;
            $booking->booking_view_km_till=$details->ambulance_base_rate_till_km;
            $booking->booking_view_per_km_rate=$details->ambulance_rate_amount;
            $booking->booking_view_per_ext_km_rate=$details->ambulance_rate_ext_km_charge;
            $booking->booking_view_per_ext_min_rate=$details->ambulance_rate_ext_min_charge;
            $booking->booking_view_km_rate=$km_rate;
            $booking->booking_view_total_fare=$total_fare;
            $booking->booking_view_service_charge_rate=$service_charge;
            $booking->booking_view_includes=$includes;
            $booking->booking_view_arrival_time='10 Min';
            // $booking->booking_ride_id=" ";
            $result=$booking->save();
            if(!empty($result)){
                $lastId=$booking->id;
                $booking_addons=booking_addons::where('booking_id','=',$lastId)->get();
                Session::put(['booking_id'=>$lastId,'booking_addons'=>$booking_addons]);
                return view('booking')->with('booking_status', 'Booking successfully.');
            }
            else{
                return view('booking')->with("booking_status","Booking failed!");
            }
        
        }
        else{
            $booking_addons=booking_addons::where('booking_id','=',$booking_id)->where('booking_addons_by_cid','=',session('consumer_id'))->get();
            Session::put('booking_addons',$booking_addons);
            echo "<script>alert('already booking');</script>".$booking_id;
            return view('booking')->with("status","Already Booked your Ride! Please Do payment for complete your booking. ");
        }
        
    }

    public function booking_proccess(Request $req){
        $consumer=$req->all();
        
        $cid=session('consumer_id');
        $booking_id=session('booking_id');
        Session::put("consumer",$consumer);
        $validator = Validator::make($req->all(), [
            'c_name' => 'required|min:3|string',
            'c_mob' => 'required',
        ]);

        if(Session::get("consumer.pay_type")==1)
        {
            $pay_type="Full payment";
            $pay_method=1;
            $payment_status=2;
            
        }
        else if(Session::get("consumer.pay_type")==2)
        {
            $pay_type="Advance payment";
            $pay_method=2;
            $payment_status=1;
        }
        else{
            $pay_type="Case payment";
            $pay_method=3;
            $payment_status=1;
            session::put('payAmount',Session::get('consumer.full_amount'));
        }
        session::put(['payment_method'=>$payment_status,'payment_type'=>$pay_method]);
        
        if($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all(),
                        'data'=>$consumer,
                    ]);
        }
        $check_booking_for_update=booking_view::
                                    where("booking_by_cid","=",$cid)
                                    ->where("booking_id","=",$booking_id)->get()->count();
        if($check_booking_for_update==1){
            $booking =booking_view::where("booking_by_cid","=",$cid)
                                    ->where("booking_id","=",$booking_id)
                                    ->update([
                                        'booking_con_name'=>Session::get('consumer.c_name'),
                                        'booking_con_mobile'=>Session::get('consumer.c_mob'),
                                        'booking_adv_amount'=>Session::get('consumer.adv_amount'),
                                        'booking_payment_type'=>$pay_method,
                                        'booking_total_amount'=>Session::get('consumer.full_amount'),
                                        'booking_payment_status'=>$payment_status,
                                        'booking_status'=>'1',
                                        'booking_payment_method'=>$pay_method,
                                    ]);      
    
            if($booking)
            { 
                // if($pay_method==1){
                //     $success='Successful';
                //     return redirect()->route('PaymentDone')->with(compact('success'));
                // }
                // else{
                    return response()->json([
                                'status' => 'Booking successfully.',
                                'code'=>$pay_method,
                                'consumer'=>session::get('consumer'),
                                'name'=>Session::get('consumer.c_name'),
                                'mob'=>Session::get('consumer.c_mob')
                            ]);
                        // }            
            }
            else{
                return response()->json(["status"=>"Booking failed!"]);
            }
        }
        else{
            return response()->json(["status"=>"Booking now existed from this booking id"]);
        }       
    }
    
    public function session_save(Request $req)
    {

        $add_time = date('Y-m-d H:i:s');
        $cid=session('consumer_id'); 
        if(Session::has('booking_id')){
            $booking_id=Session::get('booking_id');
        }
       $addons=new booking_addons;
       $supportName=$req->supportName;
       $supportPrice=$req->supportPrice;
       $support_addons=DB::table('ambulance_support_specialists')->where("ambulance_support_specialists_name","=",$supportName)->get();
       $check_addons=booking_addons::where("booking_addons_name","=",$supportName)
                                    ->where("booking_id","=",Session::get('booking_id'))
                                    ->get();
                
       if($check_addons->count()===0)
       {
            $addons->booking_addons_by_cid=session('consumer_id');
            $addons->booking_id=session('booking_id');
            $addons->booking_ambu_support_specialist_id=$support_addons[0]->ambulance_support_specialists_id;
            $addons->booking_addons_name=$supportName;
            $addons->booking_addons_price=$supportPrice;
            $addons->booking_addons_status=0;
            $addons->booking_addons_remove_time=" ";
            $addons->booking_addons_added_time=time();
            $addons->save();
            if($addons->save()){
                $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
                Session::put('booking_addons',$booking_addons);
                return response()->json(["status" => "Added Successfully","booking_addons_status"=>0,"Booking_id" => session('booking_id')]);
            }
            else{
                return response()->json(["status" => "Failed to add Support Addons.","addons_status"=>1,]);
            }
        }

        else{  
            
            if($check_addons[0]->booking_addons_status>0)
            {
            $cid=session('consumer_id');
            try
            {
                $update_remove_addons=booking_addons::
                where("booking_addons_name","=",$supportName)
                ->where("booking_id","=",Session::get('booking_id'))
                ->where('booking_addons_status','=','1')
                ->update([
                    'booking_addons_status'=>'0', 'booking_addons_added_time'=>time(),
                ]);
                if($update_remove_addons){
                    $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
                    Session::put('booking_addons',$booking_addons);
                    return response()->json(['status'=> 'Removed Addons Updated Successfully','booking_addons_status'=>0,'booking_id'=>Session::get('booking_id')]);
                }
                else{
                    return response()->json(['status'=> DB::getQueryLog($update_remove_addons),'booking_addons_status'=>1]);
                }

            }
            catch(Exception $e)
            {
                return response()->json(['status'=>$ex->getMessage(),"booking_addons_status"=>1 ]);
            }
        }
        else{
            return response()->json(["status" => "Already Added","booking_addons_status"=>0,'booking_id'=>session('booking_id'),"Ambu_type"=>$supportName,"data"=>$check_addons]);
        }
    }
}

    public function show(booking $booking)
    {
        //
    }

    public function remove_addon(Request $req)
    {
        $supportName=$req->supportName;
        $supportPrice=$req->supportPrice;
        $booking_id=Session::get('booking_id');
        $remove_addons=booking_addons::where("booking_addons_name","=",$supportName)
        ->where("booking_id","=",$booking_id)->where('booking_addons_status','=','0')->get();
                            
        if($remove_addons->count()>0){
            booking_addons::where("booking_addons_name","=",$supportName)
                            ->where("booking_id","=",$booking_id)
                            ->where('booking_addons_status','=','0')
                            ->update([
                                    'booking_addons_status'=>'1',
                                    'booking_addons_remove_time'=>strtotime(date('Y-m-d H:i:s'))
                                ]);
            $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
            Session::put('booking_addons',$booking_addons);
            return response()->json(['addons_status'=>'Addons Removed',"booking_addons_status"=>0]);
        }
        else{
            $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
            Session::put('booking_addons',$booking_addons);
            return response()->json([
                'addons_status'=>'Addons Already Removed',
                'booking_id'=>$booking_id,
                'booking_addons_status'=>0,
                'error'=>$remove_addons->count()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(booking $booking)
    {
        //
    }
}
