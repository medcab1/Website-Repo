<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\http\view;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Notification_models;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use App\Models\booking_addons;
use App\Models\booking_view;
use Session;

class DriverController extends Controller
{
    //test curl
    public function index(){
        echo "Hello";
    }

    public function test(Request $request){

        echo "Hello";
        $dataArray=['title'=>'New Booking',
        'fcm_token'=>'dTK5sutZRkOQkeKe2R2EOF:APA91bGMiN0t4JPyvpolxq-RupUI4aryk0uAnLUv4hOOno0yceFmaENzgb58GvjUYaz9SExF3Xo7FjIQThQS3YLFYt45x6PEU3T1FOHAtJvvdICcBMbkh2TuUVRgF6Nz-atnsLpOFZd7',
        'sound'=>"default",
        'image'=>"https://madmin.cabmed.in/site_img/title_icon.png",
        'key1'=>'2',
        'driver_id'=>1,
        'enquiry_id'=>234,
        'key2'=>1, 
        'body'=>  "Hey , You have a booking from MedCab | Ambulance Service "]; 
// dd(DB::table('driver')->where('driver_id','39')->get());

       $data=  app('App\Http\Controllers\SendNotificationController')->cancel_notification($request,$dataArray);
       dd($data);
    //    return  app('App\Http\Controllers\SendNotificationController')->send_notification($request,$dataArray);
        // return redirect()->route('Cancellation', $dataArray);
        // return app('App\Http\Controllers\NotificationController')->send_notification('790','58','2');

    }

   

    public function searchDriver(Request $request){  
        $orderId=$transactionId=$amount='';
        if(session('orderId')!=''&& session('paymentId')!=''){
            $order_id=session('orderId');
            $transection_id=session('transection_id');
        }

    $consumer_id=session('consumer_id');
    $enquary_id=session('booking_id');
     // Razor Pay Order Id
    // if (empty($order_id)) {
    //     $order_id='N/A'; // 1 for not Paid, 2 for Paid    
    // }
    // $booking_payment_method = $update_data['booking_payment_method'] =$request->input('payment_method'); //	1 for cash, 2 for online
    // $booking_payment_type = $update_data['booking_payment_type'] =$request->input('payment_type'); //	1 for not payment, 2 for advance payment,3 for full payment 
    // $transection_id =$request->input('transection_id'); 
    // if (empty($transection_id)) {
    //     $transection_id='N/A'; // 1 for not Paid, 2 for Paid    
    // }
    // $transfer_amount =$request->input('transfer_amount'); 
    if (session('payment_type')== 1) {
        $update_data['booking_payment_status'] ='2'; // 1 for not Paid, 2 for Paid    
    }else if(session('payment_type')== 2){
        $update_data['booking_payment_status'] ='3'; // 1 for not Paid, 2 for Paid
    } else{
        $update_data['booking_payment_status'] ='1'; // 1 for not Paid, 2 for Paid

    }

    $update_data['booking_status'] = '1';
    // $auth_key=$request->input('auth_key');
    $data=DB::table('booking_view')
    ->where('booking_id',$enquary_id)
    ->where('booking_by_cid',$consumer_id)
    ->get();

    if(count($data)>0){
        $booking_type = $data[0]->booking_type;
        $distance = $data[0]->booking_distance;
        $booking_amount = $data[0]->booking_amount;   
        if($booking_type =='0' || $booking_type=='1'){
            $result=booking_view::where('booking_id', $enquary_id)
            ->update($update_data);
            //..............notification. for normal .....................
            $category_type=$data[0]->booking_category;
            $pickup_lat=$data[0]->booking_pick_lat;
            $pickup_long=$data[0]->booking_pick_long;
            $nearest_drivers=DB::select("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS( $pickup_lat * pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long - driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE  driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10 ");
            // $nearest_drivers=DB::select("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS( $pickup_lat * pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long - driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE vehicle.vehicle_category_type = '$category_type driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10 ");
            foreach ($nearest_drivers as $nav){
                $driver_id = $nav->driver_id;
                $driver_name = $nav->driver_name;
                $vehicle_id = $nav->vehicle_id;
                $driver_fcm_token = $nav->driver_fcm_token;
                if(!empty($driver_fcm_token)){
                    $i =0;
                    $title='New Booking';
                    $sound="default";
                    $image="https://madmin.cabmed.in/site_img/title_icon.png";
                    $key='1';
                    $key2=''.$enquary_id; // splash screen
                    $body=  "Hey ,".$driver_name." You have a booking from MedCab | Ambulance Service "; 
                    $dataArray=['enquiry_id' => $enquary_id,'driver_id'=>$driver_id,'key1'=>'1'];
                    $result = app('App\Http\Controllers\SendNotificationController')->send_notification($request,$dataArray);

                    $nearest_drivers =DB::select("INSERT INTO `booking_assigned_td` (`booking_assigned_td_id`, `booking_assigned_td_booking_id`, `booking_assigned_td_driver_id`, `booking_assigned_td_status`) VALUES (NULL, '$enquary_id', '$driver_id', '1') "); // category filter and distance filter pending
                    $current_time=time();
                    $updatedriver_time =DB::select("UPDATE `driver` SET `driver_last_booking_notified_time` = $current_time WHERE `driver`.`driver_id` = $driver_id;
                    "); // Notifiy Driver
                    
                } 
            }
        //..............notification  for Normal Booking end......................
        }
    } 
        // $jsonData=$response->json();
        // dd($response);
        $booking_status=DB::table('booking_view')->where('booking_id','=',session('booking_id'))->pluck('booking_status');
            if($booking_status[0]==2){
                return redirect()->route('Driver.AssignedDriver',session('booking_id'))->with('data','');  
            }
            else{
                return redirect()->route('PaymentDone',session('booking_id'));
            }
        
    }
    
    public function waitingView(Request $request){
        if(is_int((int)$request->booking_id)!=1 || $request->booking_id==''){
            $booking_id=session('booking_id');
        }
        else{
            $booking_id=$request->booking_id;
        }
        $booking_status=DB::table('booking_view')->where('booking_id','=',$booking_id)->pluck('booking_status');
            if($booking_status[0]==2){
                return response()->json(['status'=>2,'booking_id'=>$booking_id]);
            }
            else if($booking_status[0]==3){
                $remain_amount=DB::table('booking_invoice')->where('bi_booking_id',$booking_id)->first('bi_total_amount_without_SC');
                return response()->json(['status'=>2,'booking_id'=>$booking_id,'remaining_amount'=>$remain_amount]);

            }
            else{
                return response()->json(['status'=>1,'booking_id'=>$booking_id]);
            }
           
        }

    public function driver_assigned(Request $request){
        // dd($request->all());
        if(is_int((int)$request->booking_id)!=1 || $request->booking_id==null){
            $booking_id=session('booking_id');
            // echo is_int((int)$request->booking_id)."!=true";
            // dd( $booking_id);
        }
        else{
            // echo 'g';
            $booking_id=$request->booking_id;
            // dd( $booking_id);
        }   
        // dd($booking_id);
        $data['booking_id']=$booking_id;
        $check_booking=DB::table('booking_view')->where('booking_id', '=', $booking_id)->count();
        $rating_list=DB::table('booking_rating_text_consumer_to_driver')->select('br_text_ctd_id','br_text_ctd_text')->where('br_text_ctd_status','=','0')->get();
        $cancel_reason_list=DB::table('booking_cancel_reasons')->select('booking_cancel_reasons_id','booking_cancel_reasons_text')->where('cancel_reason_type','=','1')->get();
        $consumer_id=session('consumer_id');
        if($check_booking==1){
        $bucket = [];
        $bucket_driver_live_loc = [];
        $bucketcl= [];
        $sp_data_array =[];
        $addons_amount =0;
        $data=DB::table('booking_view')
        ->leftJoin('ambulance_category', 'booking_view.booking_category', '=', 'ambulance_category.ambulance_category_type')
        ->leftJoin('driver', 'booking_view.booking_acpt_driver_id', '=', 'driver.driver_id')
        ->leftJoin('vehicle', 'booking_view.booking_acpt_vehicle_id', '=', 'vehicle.vehicle_id')
        ->where('booking_id', $booking_id)
        ->where('booking_by_cid',$consumer_id)
        ->get();
        
      
        $driver_id = 0;
        if(count($data)==1){
            $sp_data=DB::table('booking_addons')
                ->leftJoin('ambulance_support_specialists', 'booking_addons.booking_ambu_support_specialist_id', '=', 'ambulance_support_specialists.ambulance_support_specialists_id')
                ->where('booking_id', $booking_id)
                ->where('booking_addons_by_cid',$consumer_id)
                ->where('booking_addons_status',0)
                ->get();
            $speclist_bucket = [];
            $total_specialist_cost = 0;
            if(count($sp_data) > 0){
                foreach($sp_data as $key){
                    $addons['addons_name'] = $key->booking_addons_name;
                    $addons['addons_price'] = $key->booking_addons_price;
                    $addons['addons_icon'] = $key->ambulance_support_specialists_image_circle;
                    $total_specialist_cost = $total_specialist_cost + $key->booking_addons_price;
                    array_push($speclist_bucket, $addons);
                }

            }

            foreach ($data as $booking_view) {
         
                $update_data['booking_id'] = "".$booking_view->booking_id;
                $update_data['category'] = "".$booking_view->booking_category;
                $update_data['source'] = "".$booking_view->booking_source;
                $update_data['booking_type'] = "".$booking_view->booking_type;
                $update_data['booking_type_for_rental'] = "".$booking_view->booking_type_for_rental;
                $update_data['booking_bulk_master_key'] = "".$booking_view->booking_bulk_master_key;
                $update_data['booking_no_of_bulk'] = "".$booking_view->booking_no_of_bulk;
                $update_data['booking_bulk_total'] = "".$booking_view->booking_bulk_total;
                $update_data['consumer_id'] = "".$booking_view->booking_by_cid;
                $update_data['otp'] = "".$booking_view->booking_view_otp;
                $update_data['otp_status'] = "".$booking_view->booking_view_status_otp;
                $update_data['otp_status_dev_txt'] = "0 for matched , 1 for not matched";
                $update_data['c_name'] = "".$booking_view->booking_con_name;
                $update_data['c_mobile'] = "".$booking_view->booking_con_mobile; 
                $update_data['pickup_address'] = "".$booking_view->booking_pickup;
                $update_data['drop_address'] = "".$booking_view->booking_drop;
                $update_data['pick_lat'] = "".$booking_view->booking_pick_lat;
                $update_data['pick_long'] = "".$booking_view->booking_pick_long;
                $update_data['drop_lat'] = "".$booking_view->booking_drop_lat;
                $update_data['drop_long'] = "".$booking_view->booking_drop_long;
                $update_data['booking_amount'] = "".$booking_view->booking_amount;
                $update_data['booking_adv_amount'] = "".$booking_view->booking_adv_amount;
                $update_data['booking_payment_type'] = "".$booking_view->booking_payment_type;
                $update_data['booking_payment_status'] = "".$booking_view->booking_payment_status;
                $update_data['distance'] = "".$booking_view->booking_distance;
                $update_data['duration'] = "".$booking_view->booking_duration;
                $update_data['poliline'] = "".$booking_view->booking_polyline; 
                $update_data['schudle_time'] = "".$booking_view->booking_schedule_time; 
                $update_data['booking_status'] = "".$booking_view->booking_status; 
                $update_data['booking_status_dev_txt'] = "0 for enquiry, 1 for booking done, 2 for driver assigned,3 for invoice, 4 for complete, 5 for Cancel Booking"; 
                $driver_id = $update_data['booking_driver_id'] = "".$booking_view->booking_acpt_driver_id;  
                $update_data['booking_driver_name'] = "".$booking_view->driver_name.' '.$booking_view->driver_last_name;  
                $update_data['booking_driver_image'] = "".$booking_view->driver_profile_img;  
                $update_data['booking_driver_mobile'] = "".$booking_view->driver_mobile;  
                $update_data['booking_vehicle_id'] = "".$booking_view->booking_acpt_vehicle_id; 
                $update_data['booking_vehicle_rc_no'] = "".$booking_view->vehicle_rc_number;  
                $update_data['booking_category_type'] = "".$booking_view->booking_category;  
                $update_data['booking_category_icon'] = "".$booking_view->booking_view_category_icon; 
                $update_data['booking_category_name'] = "".$booking_view->booking_view_category_name;  
                $update_data['booking_accept_lat'] = "";  
                $update_data['booking_accept_long'] = "";  
                $update_data['booking_includes']="".$booking_view->booking_view_includes;
                $update_data['acc_to_pick_polilyne'] = "".$booking_view->booking_ap_polilyne; 
                $update_data['acc_to_pick_duration'] = "".$booking_view->booking_ap_duration; 
                $update_data['acc_to_pick_distance'] = "".$booking_view->booking_ap_distance;
                $update_data['pickup_time']=$booking_view->booking_view_pickup_time;
                $update_data['booking_total_ride'] = "".$booking_view->driver_total_ride_till_today;  
                $update_data['booking_driver_rating'] = "".$booking_view->driver_rating;  
                $update_data['payment_method'] = "".$booking_view->booking_payment_method;  
                $update_data['payment_method_dev_txt'] = "1 for cash, 2 for online	";  
                $update_data['payment_type'] = "".$booking_view->booking_payment_type;  
                $update_data['payment_type_dev_txt'] = "1 for full payment ,2 for advance payment, 3 for Zero Pay";  
                $update_data['amount'] = "".$booking_view->booking_view_base_rate;  
                $update_data['advance_amount'] = "".$booking_view->booking_adv_amount;  
                $update_data['total_amount'] = "".$booking_view->booking_total_amount;  
                $update_data['service_charge'] = "".$booking_view->booking_view_service_charge_rate;  
                if($booking_view->booking_view_service_charge_rate > 0){
                    $update_data['gst_charge'] = "".$booking_view->booking_view_service_charge_rate*0.05;
                }else{
                    $update_data['gst_charge'] = "";
                }  
                $update_data['currency_symbol'] = "Rs";  
                $update_data['gst_percentage'] = "5%";  
                $update_data['payment_status'] = "".$booking_view->booking_payment_status;  
                $update_data['payment_status_dev_txt'] = "1 for not Paid, 2 for Paid";  
                $update_data['includes'] = "".$booking_view->booking_view_includes;  
                if($booking_view->booking_payment_type =='1'){// full
                    $update_data['remaining_amount'] = "0";
                }elseif($booking_view->booking_payment_type =='2'){// advance
                    $remain_amount= $booking_view->booking_total_amount - $booking_view->booking_adv_amount;
                    $update_data['remaining_amount'] = "".$remain_amount;
                }
                elseif($booking_view->booking_payment_type =='3'){ //  zero pay
                    $update_data['remaining_amount'] ="".$booking_view->booking_total_amount;
                }else{
                    $update_data['remaining_amount'] ="".$booking_view->booking_total_amount;
                }
                $update_data['refund_amount'] = "0";  
                $update_data['cancellection_charge'] = "0";   
                $update_data['driver_total_rides'] = $booking_view->driver_total_ride_till_today;  
                $update_data['extra_km'] = "2";  
                $update_data['extra_km_rate'] = "8";  
                $update_data['extra_km_rate_total'] = "16";  
                $update_data['extra_time'] = "4";  
                $update_data['extra_time_rate'] = "2";  
                $update_data['extra_time_rate_total'] = "12";  
                $update_data['specialist_cost'] = ''.$total_specialist_cost;  
                $update_data['discount_Amount'] = "0";    
                
                
            }
            array_push($bucket, $update_data);
            $data_dll=DB::table('driver_live_location')
                    ->where('driver_live_location_d_id',$driver_id) 
                    ->get();

            if (count($data_dll)>0) {
                $bucket_driver_live_loc['live_location'] =$data_dll; 
            }else{
                $bucket_driver_live_loc['live_location'] =[]; 
            }
            
            $bucketcl['booking_details'] = $bucket;
            $bucketcl['specialist_list_rate'] = $speclist_bucket;
            $bucketcl['live_location_details'] = $bucket_driver_live_loc;
            array_push($sp_data_array, $bucketcl);
            $data=$sp_data_array;
            // dd($data);
            return view('driver_assigned')->with(compact('data','rating_list','cancel_reason_list'));
        }
        else{
            echo "Invalide Request";  
        
        }

        }
        else{
            $response=['status'=>1,'message'=>'Something went wrong!'];
            return view('driver_assigned',['driver'=>$request]);
        }
        
    }

    public function cancel_booking(Request $request){
        if(!is_int((int)$request->booking_id)  || $request->booking_id==''){
            $enquary_id=session('booking_id');
        }
        else{
            $enquary_id=$request->booking_id;
        } 
        // dd($enquary_id);
        $cancel=$request->all();
        $cancel['consumer_id']=session('consumer_id');
        $cancel['booking_id']=$request->booking_id;
        $accepted_status =1; // 1 for not accepted 0 for accepted
        $consumer_id=session('consumer_id');
        $update_data['booking_status'] = '5';
        $data=DB::table('booking_view')
        ->where('booking_id',$enquary_id)
        ->where('booking_by_cid',$consumer_id)
        ->get();
        // print_r($data); exit();
        if(count($data)>0){
            if ($data[0]->booking_status =='1'|| $data[0]->booking_status =='0') {
                $msg = 'Pre Cancel Booking Successfully ' ;
                $status = '0';

                $update_booking_status=DB::table('booking_view')->where('booking_id', $enquary_id)
                ->update(['booking_status'=>'5']);
                $update_cancel_status=DB::table('booking_a_c_history')
                ->insert([
                    'bah_booking_id'=>$enquary_id,
                    'bah_consumer_id'=>$consumer_id,
                    'bah_consumer_latitude'=>''.$request->input('lat'),
                    'bah_consumer_longitude'=>''.$request->input('lng'),
                    'bah_time'=>time(),
                    'bah_user_type'=>'1',
                    'bah_cancel_reason_id'=>''.$request->input('reason_id'),
                    'bah_cancel_reason_text'=>''.$request->input('reason_text'),
                    'bah_status'=>'2',
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>'',
                ]);
              
                if($update_booking_status && $update_cancel_status){
                    return response()->json([
                        'message'=>$msg."success",
                        'c_status'=>'0',
                        'status'=>$status,
                    ]);
                }
                else{
                    return response()->json([
                        'message'=>$msg."Failed",
                        'c_status'=>'1',
                        'status'=>$status,
                        'b1'=>$update_booking_status,
                        'b2'=>$update_cancel_status,
                    ]);
                }
                
            }elseif ($data[0]->booking_status =='2') {
                $msg = 'Cancel Booking Successfully' ;
                $status = '0';
                $accepted_status =0;
                $driver_id=DB::table('booking_view')
                ->where('booking_id','=',$enquary_id)
                ->limit(1)->pluck('booking_acpt_driver_id')->first();

                $update_cancel_status=DB::table('booking_a_c_history')
                ->where('bah_booking_id','=',$enquary_id)
                ->limit(1)
                ->update([
                    
                    'bah_consumer_id'=>$consumer_id,
                    'bah_consumer_latitude'=>''.$request->input('lat'),
                    'bah_consumer_longitude'=>''.$request->input('lng'),
                    'bah_time'=>time(),
                    'bah_user_type'=>'1',
                    'bah_cancel_reason_id'=>''.$request->input('reason_id'),
                    'bah_cancel_reason_text'=>''.$request->input('reason_text'),
                    'bah_status'=>'2',
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                $update_booking_status=DB::table('booking_view')->where('booking_id', $enquary_id)
                ->update(['booking_status'=>'5']);
            
                
                if($update_cancel_status && $update_booking_status){
                    $dataArray = ['enquiry_id'=>$enquary_id,"driver_id"=>$driver_id,'key1'=>'2'];
                    app('App\Http\Controllers\SendNotificationController')->cancel_notification($request,$dataArray);
                    return response()->json([
                        'message'=>$msg,
                        'c_status'=>'0',
                        'status'=>$update_cancel_status,
                        'status2'=>$update_booking_status,
                    ]);
                }
                else{
                    return response()->json([
                        'message'=>$msg,
                        'c_status'=>'1',
                        'status'=>$status,
                        'data'=>DB::table('booking_a_c_history')
                        ->where('bah_booking_id','=',$enquary_id)
                        ->limit(1)->get(),
                        'data2'=>DB::table('booking_a_c_history')
                        ->where('bah_booking_id','=',$enquary_id)
                        ->get(),
                        'b1'=>$update_booking_status,
                        'b2'=>$update_cancel_status,

                    ]);
                }

            }elseif ($data[0]->booking_status =='5'){
                $msg = 'Booking already cancelled' ;
                $status = '0';
                $b=$data[0]->booking_status;
            }else{
                $msg = 'Invalid Request , please try again.' ;
                $status = '1';
                $b=$request->all();
            }
            // if ($status == '0') {
            //     $msg = 'Cancel Booking Successfully' ;
            //     $status = '0';
            //     $accepted_status =0;
            // }
            // if($accepted_status == '0'){

            //     // notification
            // }
            return response()->json([
                'message'=>$msg,
                'c_status'=>$status,
                'b_statu'=>$b,
            ]);
            
            
        }
        else{
            return response()->json([
                'message'=>"Invalid Request, Please try again.",
            ]);   
        
        }
    }

    public function getDriverLiveLocation(Request $request){
        // if(!is_int((int)$request->booking_id || $request->booking_id=='')){
        //     $booking_id=session('booking_id');
        // });
        // else{
        //     $booking_id=$request->booking_id;
        // }
        $booking_id=$request->input('booking_id');
        $driver_id=$request->input('driver_id');
        $driver_location=DB::table('driver_live_location')->where('driver_live_location_d_id',$driver_id)->get();
        $location=[];
        $total_specialist_cost=0;
        $location['dvr_id']=$driver_location[0]->driver_live_location_d_id;
        $location['dvr_lat']=$driver_location[0]->driver_live_location_lat;
        $location['dvr_lng']=$driver_location[0]->driver_live_location_long;
        $location['dvr_distance']=$driver_location[0]->driver_total_driven_distance;
        $accept_status=DB::table('booking_view')
                ->where('booking_id','=',$booking_id)
                ->where('booking_by_cid','=',session('consumer_id'))->get();

        if($accept_status[0]->booking_view_status_otp=='1'){
            $location['accept_status']=$accept_status[0]->booking_view_status_otp;
            $location['booking_status']=$accept_status[0]->booking_status;
        }
        else{
            $location['remaining']='';
                $location['payment_status']='';
            // $location['accept_status']=$accept_status->booking_view_status_otp;
            // $location['booking_status']=$accept_status->booking_status;s
            // $location['accept_status']=$accept_status;
            $location['accept_status']=$accept_status[0]->booking_view_status_otp;
            $location['booking_status']=$accept_status[0]->booking_status;
            $location['payment_status']=$accept_status[0]->booking_payment_status;

            //$location['remaining']=DB::table('booking_invoice')-> where('bi_booking_id','=' , $booking_id)->get('bi_remain_amount')[0]->bi_remain_amount;
           // dd();

            if($accept_status[0]->booking_status==3 && $accept_status[0]->booking_payment_status ==1){
                $location['remaining']=DB::select('select bi_remain_amount from booking_invoice where bi_booking_id=' . $booking_id)[0]->bi_remain_amount;

            }
            else if ($accept_status[0]->booking_payment_status ==2){
                if($accept_status[0]->booking_status==3){
                    $location['remaining']=DB::select('select bi_remain_amount from booking_invoice where bi_booking_id=' . $booking_id)[0]->bi_remain_amount;
                  
                }
                else{
                    $location['payment_status']=$accept_status[0]->booking_payment_status;
                }
               
            }
            else{
                

            }
           

        }
        return response()->json($location);
        
    }
    public function getInvoice(Request $request){
        $enquary_id=$request->booking_id;
        $consumer_id=session('consumer_id');
        $detail=[];
        $speclist_bucket=[];
        $invoiceData=[];
        $total_specialist_cost =0;
        // Booking Details
        $data=DB::table('booking_view')
        ->leftJoin('ambulance_category', 'booking_view.booking_category', '=', 'ambulance_category.ambulance_category_type')
        ->leftJoin('ambulance_rate', 'booking_view.booking_category', '=', 'ambulance_category.ambulance_category_type')
        ->leftJoin('driver', 'booking_view.booking_acpt_driver_id', '=', 'driver.driver_id')
        ->leftJoin('vehicle', 'booking_view.booking_acpt_vehicle_id', '=', 'vehicle.vehicle_id')
        ->leftjoin('booking_invoice','booking_view.booking_id', '=', 'booking_invoice.bi_booking_id')
        ->where('booking_id',$enquary_id)
        ->where('booking_by_cid',$consumer_id)
        ->get();

        // invoice details
        $invoice=DB::table('booking_invoice')->where('bi_booking_id',$enquary_id)
        ->where('bi_consumer_id',$consumer_id)
        ->get();
        // dd($invoice);
        // Booking addons lists
        $sp_data=DB::table('booking_addons')
        ->where('booking_id',$enquary_id)
        ->where('booking_addons_by_cid',$consumer_id)
        ->where('booking_addons_status',0)
        ->get();

        if(count($sp_data) > 0){
            foreach($sp_data as $key){
                $addons['addons_name'] = $key->booking_addons_name;
                $addons['addons_price'] = $key->booking_addons_price;
               $total_specialist_cost = $total_specialist_cost + $key->booking_addons_price;
                array_push($speclist_bucket, $addons);
            }

        }
        
        $detail['invoice']=$invoice[0];
        $detail['addons']=$speclist_bucket;
        $detail['addons_cost']=$total_specialist_cost;
        // Driver Total trips calculation
        $driver_trips=DB::table('booking_a_c_history')
        ->where('bah_driver_id',$data[0]->booking_acpt_driver_id)
        ->where('bah_status','3')->count();

        $booking_detail=[];
        $booking_detail['consumer_id']=$data[0]->booking_by_cid;
        $booking_detail['booking_id']=$data[0]->booking_id;
        $booking_detail['source'] = "".$data[0]->booking_source;
        $booking_detail['booking_type'] = "".$data[0]->booking_type;
        $booking_detail['booking_type_for_rental'] = "".$data[0]->booking_type_for_rental;
        $booking_detail['booking_bulk_master_key'] = "".$data[0]->booking_bulk_master_key;
        $booking_detail['booking_no_of_bulk'] = "".$data[0]->booking_no_of_bulk;
        $booking_detail['booking_bulk_total'] = "".$data[0]->booking_bulk_total;
        $booking_detail['consumer_id'] = "".$data[0]->booking_by_cid;
        $booking_detail['otp'] = "".$data[0]->booking_view_otp;
        $booking_detail['otp_status'] = "".$data[0]->booking_view_status_otp;
        $booking_detail['driver_id']=$data[0]->booking_acpt_driver_id;
        $booking_detail['c_name']=$data[0]->booking_con_name ;
        $booking_detail['c_mobile']=$data[0]->booking_con_mobile ;
        $booking_detail['driver_name']=$data[0]->driver_name.' '.$data[0]->driver_last_name ;
        $booking_detail['driver_vehicle_no']=$data[0]->vehicle_rc_number;
        $booking_detail['driver_trips']=$driver_trips;
        $booking_detail['schedule_time']=$data[0]->booking_schedule_time;
        $booking_detail['duration']=$data[0]->booking_duration;
        $booking_detail['distance']=$data[0]->booking_distance;
        $booking_detail['pickup_address']=$data[0]->booking_pickup;
        $booking_detail['drop_address']=$data[0]->booking_drop;
        $booking_detail['booking_status']=$data[0]->booking_status;
        $booking_detail['booking_category_name']=$data[0]->booking_view_category_name;
        $booking_detail['booking_category_type']=$data[0]->ambulance_category_type;
        $booking_detail['acc_to_pick_distance']=$data[0]->booking_ap_distance;
        $booking_detail['pickup_time']=$data[0]->booking_view_pickup_time;
        $booking_detail['driver_image']=$data[0]->driver_profile_img;
        $booking_detail['driver_mobile']=$data[0]->driver_mobile;
        $booking_detail['advance_amount'] = "".$data[0]->booking_adv_amount;  
        $booking_detail['total_amount'] = "".$data[0]->booking_total_amount;  
        $booking_detail['amount'] = "".$data[0]->booking_amount; 
        $booking_detail['service_charge'] = "".$data[0]->booking_view_service_charge_rate;  
        $booking_detail['payment_method'] = "".$data[0]->booking_payment_method;   
        $booking_detail['payment_type'] = "".$data[0]->booking_payment_type; 
        if($data[0]->booking_view_service_charge_rate > 0){
            $booking_detail['gst_charge'] = "".$data[0]->booking_view_service_charge_rate*0.05;
        }else{
            $booking_detail['gst_charge'] = "";
        }    
        if($data[0]->booking_payment_type =='1'){// full
            $booking_detail['remaining_amount'] = "0";
        }elseif($data[0]->booking_payment_type =='2'){// advance
            $remain_amount= $data[0]->booking_amount - $data[0]->booking_adv_amount;
            $booking_detail['remaining_amount'] = "".$remain_amount;
        }
        elseif($data[0]->booking_payment_type =='3'){ //  zero pay
            $booking_detail['remaining_amount'] ="".$data[0]->booking_amount;
        }else{
            $booking_detail['remaining_amount'] ="".$data[0]->booking_amount;
        }
        $booking_detail['extra_km_rate'] = $data[0]->booking_view_per_ext_km_rate;  
        $booking_detail['extra_min_rate'] = $data[0]->booking_view_per_ext_min_rate;    
        $booking_detail['currency_symbol'] = "Rs";  
        $booking_detail['gst_percentage'] = "5%";  
        $booking_detail['payment_status'] = "".$data[0]->booking_payment_status;  
        $booking_detail['includes'] = "".$data[0]->booking_view_includes;  
        $booking_detail['c_to_d_r_status'] =$data[0]->booking_view_rating_c_to_d_status;    
        $booking_detail['driver_avg_rating'] = DB::table('booking_consumer_rating')
        ->where('booking_consumer_rating_did', $data[0]->booking_acpt_driver_id)
        ->avg('booking_consumer_rating_total_rating');
        $booking_detail['driver_total_trips'] = DB::table('booking_a_c_history')
        ->where([['bah_driver_id','=',$data[0]->booking_acpt_driver_id],['bah_status','=','3']])
        ->count();    

        $detail['booking_detail']=$booking_detail;
        $rating_list=DB::table('booking_rating_text_consumer_to_driver')->select('br_text_ctd_id','br_text_ctd_text')->where('br_text_ctd_status','=','0')->get();

        $detail['booking_detail']=$booking_detail;
        $detail['rating_text']=$rating_list;
        return view('user_invoice',compact('detail'));
    }
    


    public function consumerRating(Request $request){
        $driver_id=$request->input('driver_id');
        $stars=$request->input('ratingStars');
        $text=$request->input('ratingText');
        $consumer_id=session('consumer_id');
        $booking_id=$request->input('booking_id');
        $rating_status=DB::table('booking_view')->where('booking_by_cid',$consumer_id)
        ->where('booking_id',$booking_id)
        ->update(['booking_view_rating_c_to_d_status'=>'0']);
        $rating_data=DB::table('booking_consumer_rating')
        ->insert([
            'booking_consumer_rating_bid'=>$booking_id,
            'booking_consumer_rating_cid'=>$consumer_id,
            'booking_consumer_rating_did'=>$driver_id,
            'booking_consumer_rating_comment'=>''.$text,
            'booking_consumer_rating_total_rating'=>$stars,
            'booking_consumer_rating_time_unix'=>time(),
            'updated_at'=>date('y-m-d h:i:s'),
            'created_at'=>date('y-m-d h:i:s'),
            'booking_consumer_rating_status'=>'0'
        ]);
        if($rating_status && $rating_data){
            return response()->json([
                'status'=>'0',
                'message'=>'Thank you for rating!'
            ]);
        }
        else{
            return response()->json([
                'status'=>'0',
                'message'=>'Sorry ! Something went wrong.'
            ]);
        }

    }
    public function driver_page(){
        echo "This is driver api route file.<br/>";
        return "hello world";
    }


    public function multiple_notification_msg($id = NULL,$title,$body,$sound,$image=NULL,$key,$key2) {
        $notification_model = new Notification_models();
        $data="";
		$payload['data_object'] = json_encode($data );
		$push_type = 'individual';
		$notification_model->setTitle($title);
		$notification_model->setMessage($body);
		$notification_model->setSound($sound);
		$notification_model->setKey($key);
		$notification_model->setKey2($key2);
		if (!empty($image)) {
			$notification_model->setImage('');
		} else {
			$notification_model->setImage('');
		}
		$notification_model->setPayload($payload);
		$json = '';
		$response = '';
		$json = $notification_model->getPush();
		$response = $notification_model->send($id, $json);
    }
    
}
