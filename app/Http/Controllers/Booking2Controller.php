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


class Booking2Controller extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
   
    public function booking_view()
    {   
        $ambu_data=[];
        $detail=$details=0;
        $booking_id=0;
        if(Session::has('booking_id')){
            $booking_id=Session::get('booking_id');
        }
        
        $otp=random_int(1000,9999);
        $check_booking=booking_view::where("booking_by_cid","=",session('consumer_id'))
        ->where("booking_id","=",$booking_id)->count();
        $ambu_Type=session('selAmbuData')['ambu_type'];
        $cat_type=DB::table('ambulance_category')->where('ambulance_category_name','=',$ambu_Type)->get();
        $catagory=DB::table('ambulance_facilities')->where('ambulance_facilities_category_type','=',$cat_type[0]->ambulance_category_type)->pluck('ambulance_facilities_name')->all();
        $ambu_case=DB::table('ambulance_category_case_like')->where('accl_cat_type',$cat_type[0]->ambulance_category_type)->pluck('accl_text');
        $ambu_facilities=DB::table('ambulance_facilities')->where('ambulance_facilities_category_type',$cat_type[0]->ambulance_category_type)->get();
       
        $ambu_support=DB::table('ambulance_support_specialists')->where('ambulance_support_specialists_category_name',$cat_type[0]->ambulance_category_type)->get();
        $ambu_data['ambu_cat']=$cat_type[0];
        $ambu_data['ambu_case']=$ambu_case;
        $ambu_data['ambu_facilities']=$ambu_facilities;
        $ambu_data['ambu_support']=$ambu_support;
        $includes=implode(',',$catagory);
        $distance=Session::get('distance');
    
        if(session('users')['booking-type']==0 || session('users')['booking-type']==2){
            $ambu_facilities=DB::select('select * from ambulance_facilities join ambulance_facilities_rate on ambulance_facilities.ambulance_facilities_id=ambulance_facilities_rate.ambulance_facilities_rate_f_id where  '.session('distance').' between ambulance_facilities_rate_from AND ambulance_facilities_rate_to  and ambulance_facilities.ambulance_facilities_category_type="$cat_type[0]->ambulance_category_type"');
            $b_details=DB::select("SELECT * FROM ambulance_category JOIN ambulance_base_rate ON ambulance_category.ambulance_category_type = ambulance_base_rate.ambulance_base_rate_cat_type JOIN ambulance_rate ON ambulance_rate.ambulance_rate_category_type = ambulance_category.ambulance_category_type  WHERE ".session('distance') ." BETWEEN ambulance_rate_starting_km AND ambulance_rate_end_km" ); 
            foreach($b_details as $detail){
                if($detail->ambulance_category_name==$ambu_Type){
                    $details=$detail;
                    break;
                }
            }
            $facility_rate=0;
            foreach($ambu_facilities as $facility){
                if($detail->ambulance_category_type==$facility->ambulance_facilities_category_type){
                    $facility_rate=$facility_rate+$facility->ambulance_facilities_rate_amount ;
                    $facility_rate=sprintf('%0.2f', intval($facility_rate));  
                }
                
            }
            if($distance>$details->ambulance_base_rate_till_km){
                $km_rate=($distance-$details->ambulance_base_rate_till_km)*$details->ambulance_rate_multiply*$details->ambulance_rate_amount + $facility_rate;
            }
            else{
                $km_rate=0+$facility_rate;
            }
            
            $total_fare=$km_rate+$details->ambulance_base_rate_amount;
            $service_charge=$total_fare*($details->ambulance_rate_service_charge/100);
        }
        else{
            if(session('users')['booking-period']==24){
                $bookingDuration= session('users')['sel-hours'];
                $book_duration_type=0;
                $b_details=DB::select("select * from ambulance_category join ambulance_rental_rate on ambulance_rental_rate.arr_category_type=ambulance_category.ambulance_category_type where ".$bookingDuration." between  arr_value_from and arr_value_to AND aa_book_type='$book_duration_type'");

            }
            else{
                $bookingDuration= session('users')['sel-days'];
                $book_duration_type=1;
                $b_details=DB::select("select * from ambulance_category join ambulance_rental_rate on ambulance_rental_rate.arr_category_type=ambulance_category.ambulance_category_type where aa_book_type='$book_duration_type'");
            }
        
        }
        foreach($b_details as $detail){
            if($detail->ambulance_category_name==session("selAmbuData")['ambu_type']){
                $ambu_case=DB::table('ambulance_category_case_like')->where('accl_cat_type',$cat_type[0]->ambulance_category_type)->pluck('accl_text');
                session::put(['ambu_case'=>$ambu_case]);
                $details=$detail;
                break;
            }
        }
            if($check_booking=='0'){ 
                $pickup_lat=Session::get('users.pick_lat');
                $pickup_long=Session::get('users.pick_lng');
                $distance=Session::get('distance');
                $booking = new booking_view;  
                $booking->booking_source='WEBSITE';        
                $booking->booking_type=Session::get('users.booking-type');  
                if(Session::get('users.booking-type')==2){
                    $booking_amount=session('selAmbuData')['total_price']/session('selAmbuData')['total_ambu'];
                     $booking->booking_no_of_bulk=1;
                     $booking->booking_bulk_total=session('selAmbuData')['total_ambu'];
                     $booking->booking_amount =$booking_amount;

                } 
                else{
                    if(session('selAmbuData')["ambu_price"]==null){
                        $booking_amount=session('selAmbuData')['total_price']/session('selAmbuData')['total_ambu'];
                    }
                    else{
                        $booking_amount=session('selAmbuData')["ambu_price"];
                    }
                     $booking->booking_no_of_bulk=0;
                     $booking->booking_bulk_total=0;
                    $booking->booking_amount =$booking_amount;
                    $booking->booking_distance =session('distance');

                }
                $booking->booking_bulk_master_key=0;     
                $booking->booking_by_cid=session('consumer_id');  
                $booking->booking_view_otp=$otp;   
                $booking->booking_view_status_otp='1';  
                $booking->booking_con_name = "";
                $booking->booking_con_mobile ="";
                $booking->booking_category =$details->ambulance_category_type;
                $booking->booking_schedule_time =Session::get('users.schedule-time');
                $booking->booking_pickup =Session::get('users.pick');
                $booking->booking_pick_lat =Session::get('users.pick_lat');
                $booking->booking_pick_long =Session::get('users.pick_lng');
                
                $booking->booking_adv_amount=" ";
                $booking->booking_payment_type =" ";
                $booking->booking_payment_method =" ";
                $booking->booking_duration =Session::get('duration');
                $booking->booking_polyline =Session::get('polyline');
                $booking->booking_distance =Session::get('distance');
                $booking->booking_total_amount ="";
                $booking->booking_status ="0";
                $booking->booking_payment_status ="1";
                $booking->booking_acpt_driver_id ="0";
                $booking->booking_acpt_vehicle_id="0";
                $booking->booking_acpt_time='0';
                $booking->booking_ap_polilyne='NA';
                $booking->booking_view_category_name=$details->ambulance_category_name;
                $booking->booking_view_category_icon=$details->ambulance_category_icon;
                if(session::get('users')['booking-type']==1){
                    $booking->booking_drop_lat =Session::get('users.drop_lat');
                    $booking->booking_drop_long =Session::get('users.drop_lng');
                    $booking->booking_distance =$details->arr_km_range;
                    $booking->booking_view_base_rate=$details->arr_day_amount;
                    $booking->booking_view_km_till=$details->arr_value_to;
                    $booking->booking_view_per_km_rate=' ';
                    $booking->booking_view_per_ext_km_rate=$details->arr_extra_km_rate;
                    $booking->booking_view_per_ext_min_rate=$details->arr_extra_min_rate;
                    if(session::get('users')['booking-period']==24){
                        $booking_drop='Rental for '.session::get('users')['sel-days'].' Hours';
                        $booking_duration_type=0;
                        $fare=$details->arr_day_amount;
                        $service_charge=($fare*$details->arr_service_charge)/100;
                        $total_fare=$fare;
                        
                    }
                    else if(session::get('users')['booking-period']==31){
                        $booking_drop='Rental for '.session::get('users')['sel-days'].' Days';
                        $booking_duration_type=1;
                        $fare=$details->arr_day_amount*session::get('users')['sel-days'];
                        $service_charge=($fare*$details->arr_service_charge)/100;
                        $total_fare=$fare;
                        
                    }
                    $booking->booking_drop =$booking_drop;
                    $booking->booking_type_for_rental=$booking_duration_type;
                    $booking->booking_view_km_rate=$fare;
                    $booking->booking_view_total_fare=$total_fare;
                    $booking->booking_view_service_charge_rate=$service_charge;
                }
                else{
                //  dd(round((float)Session::get('users.drop_lat'),3));
                    $booking->booking_drop =Session::get('users.drop');
                    $booking->booking_drop_lat =round((float)Session::get('users.drop_lat'),6);
                    $booking->booking_drop_long =round((float)Session::get('users.drop_lng'),6);
                    $booking->booking_type_for_rental=0;
                    $booking->booking_view_base_rate=$details->ambulance_base_rate_amount;
                    $booking->booking_view_km_till=$details->ambulance_base_rate_till_km;
                    $booking->booking_view_per_km_rate=$details->ambulance_rate_amount;
                    $booking->booking_view_per_ext_km_rate=$details->ambulance_rate_ext_km_charge;
                    $booking->booking_view_per_ext_min_rate=$details->ambulance_rate_ext_min_charge;
                    $booking->booking_view_km_rate=$km_rate;
                    $booking->booking_view_total_fare=$total_fare;
                    $booking->booking_view_service_charge_rate=$service_charge;

                }
            
                try{
                    $arrival_time=DB::select("SELECT  round(6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS(  $pickup_lat* pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long-driver_live_location_long) * pi()/180 / 2), 2) )))*5 as arrival from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE vehicle.vehicle_category_type = '$details->ambulance_category_type' AND driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON'   having arrival/5 <= 40 order by arrival asc LIMIT 1");
                    if(count($arrival_time)>0){
                        $arrival=$arrival_time[0]->arrival." min";
                    }
                    else{
                        $arrival='';
                    }
                    
                }
                catch(Exception $e){
                    $arrival='';
                    
                }
                $booking->booking_view_includes=$includes;
                $booking->booking_view_arrival_time=($arrival!='')?$arrival:'10 Min';
                $result=$booking->save();
                // exit();

                if(!empty($result)){
                    $lastId=$booking->id;
                    $booking_addons=booking_addons::where('booking_id','=',$lastId)->get();
                    Session::put(['booking_id'=>$lastId,'booking_addons'=>$booking_addons]);
                    session::put(['ambu_data'=>$ambu_data]);
                    if(session::get('users')['booking-type']==2){
                        $bulk_booking=DB::table('booking_view')->where('booking_id',$lastId)->update(['booking_bulk_master_key'=>$lastId]);
                        if($bulk_booking){
                            return view('booking')->with('booking_data',$ambu_data);
                        }
                        else{
                            return view('booking')->with('booking_data',$ambu_data);
                        }
                    }
                    return view('booking')->with('booking_data',$ambu_data);
                }
                else{
                    return view('booking')->with('booking_data',$ambu_data);
                }
            
            }
            else{          
                $booking_addons=booking_addons::where('booking_id','=',$booking_id)->where('booking_addons_by_cid','=',session('consumer_id'))->get();
                Session::put('booking_addons',$booking_addons);
                return view('booking')->with('booking_data',$ambu_data);
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
            $pay_type=1;
            $pay_method=2;
            $payment_status=2;
            $pay_amount=Session::get('consumer.full_amount');
            
        }
        else if(Session::get("consumer.pay_type")==2)
        {
            $pay_type=2;//full , Advance or cash
            $pay_method=2; //cash or online
            // session::put('payAmount',Session::get('consumer.adv_amount'));
            $payment_status=3;//paid or unpaid
            $pay_amount=Session::get('consumer.adv_amount');

        }
        else{
            $pay_type=3;
            $pay_method=1;
            $payment_status=1;
            $pay_amount=Session::get('consumer.full_amount');

            session::put('payAmount',Session::get('consumer.full_amount'));
        }
        session::put(['payment_method'=>$payment_status,'payment_type'=>$pay_type]);
        
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
            if(session::get('users')['booking-type']==2)
            {
                $totalPrice=$consumer['total']/$consumer['total_ambu'];
                $totalAdvPrice=$totalPrice*.1;
            }
            else{
                $totalPrice=Session::get('consumer.full_amount');
                $totalAdvPrice=Session::get('consumer.adv_amount');
            }
            $booking =booking_view::where("booking_by_cid","=",$cid)
                                    ->where("booking_id","=",$booking_id)
                                    ->update([
                                        
                                        'booking_con_name'=>Session::get('consumer.c_name'),
                                        'booking_con_mobile'=>Session::get('consumer.c_mob'),
                                        'booking_adv_amount'=>$totalAdvPrice,
                                        'booking_payment_type'=>$pay_type,
                                        'booking_total_amount'=>$totalPrice,
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
                    if(session('users')['booking-type']==2){
                        session::put('consumer.booking_bulk_master_key',$booking_id);
                        $masterKey=$booking_id;
                        $check=DB::table('booking_bulk')->where('booking_bulk_booking_id',$booking_id)->count();
                       if($check==0){
                            $bulk_booking=DB::table('booking_bulk')->insert([
                                'booking_bulk_consumer_id'=>session('consumer_id'),
                                'booking_bulk_booking_id'=>$masterKey,
                                'booking_bulk_category_type'=>session('selAmbuData')['ambu_cat_type'],
                                'booking_bulk_category_qt'=>session('selAmbuData')['total_ambu'],
                                'updated_at'=>date('y-m-d h:i:s'),
                                'created_at'=>date('y-m-d h:i:s'),
                                'booking_bulk_added_time'=>time(),
        
                            ]);
                            if($bulk_booking){
                                $mess= 'Booking successfully.';
                            }
                            else{
                                $mess='Booking failed!';   
                            }
                        }
                        else{
                             $mess='Already Done Bulk Added!';
                        }
                    
                    }
                    else{
                        $mess='Not a bulk booking!';
                        $masterKey=0;
                    }         
            }
            else{
                $mess='Booking failed!';
            }
        }
        else{
            $mess="Booking now existed from this booking id";
        }     
        return response()->json([
            'status' => $mess,
            'code'=>$pay_type,
            "pay_amount"=>$pay_amount,
            'consumer'=>session::get('consumer'),
            'name'=>Session::get('consumer.c_name'),
            'mob'=>Session::get('consumer.c_mob'),
            'masterKey'=>$masterKey,
        ]);   
    }
    
    public function session_save(Request $req)
    {
// dd("session_save");
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
