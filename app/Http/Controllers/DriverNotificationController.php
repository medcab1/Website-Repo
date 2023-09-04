<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\consumer;
use App\Models\Notification_models;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;  


class DriverNotificationController extends Controller
{
    
public function test(){
    dd("Send notification");
}
    public function send_notification($enquiry_id,$driver_id,$key1,$fcm_token){
            //..............notification......................
            $booked_driver =DB::select("SELECT * FROM `driver` where driver_id='$driver_id'"); // category filter and distance filter pending
            // $booked_driver =DB::select("SELECT * FROM `driver` JOIN vehicle ON driver.driver_assigned_vehicle_id = vehicle.vehicle_id WHERE driver.driver_status='1' ANd driver.driver_duty_status='ON' AND driver.driver_id='$driver_id' "); // category filter and distance filter pending
            // dd($booked_driver);
            if ($booked_driver){
                $driver_name = $booked_driver[0]->driver_name;
                if($key1==2){
                    $title_text='Booking Cancellation';
                    $driver_fcm_token = $booked_driver[0]->driver_fcm_token;
                    $bodyy=  "Hey ,".$driver_name." Your booking ID ".$enquiry_id." has been cancelled. | Ambulance Service "; 
                }
                else{
                    $title_text='New Booking';
                    $driver_fcm_token =  $fcm_token;
                    $bodyy=  "Hey ,".$driver_name." Your have a booking from Medcab | Ambulance Service."; 
                }

                if(!empty($driver_fcm_token)){
                    $i =0;
                    $title=$title_text;
                    $sound="default";
                    $image="https://madmin.cabmed.in/site_img/title_icon.png";
                    $key=$key1;
                    $key2=''.$enquiry_id; // splash screen
                    $body= $bodyy; 
                    $result = $this->notification_msg($driver_fcm_token,$title,$body,$sound,$image,$key,$key2);
                    // $nearest_drivers =DB::select("INSERT INTO `booking_assigned_td` (`booking_assigned_td_id`, `booking_assigned_td_booking_id`, `booking_assigned_td_driver_id`, `booking_assigned_td_status`) VALUES (NULL, '$enquary_id', '$driver_id', '1'); "); // category filter and distance filter pending
                    
                }
                
                return response()->json([
                    'result'=>'S',
                    'status'=>'0',
                    'Message'=>"Send cancellation Notification to driver Sucessfully.",
                    
                ]);
                
            }
            //..............notification end......................

            
            return response()->json([
                'result'=>'S',
                'status'=>'1',
                'Message'=>"Failed to send  cancellation  notification to driver.",
                
            ]);
      

    }
    public function booking_send_notification(Request $request,$booking_id){
         $booking_id=$request->input('enquary_id');
        // $consumer_id=$request->input('consumer_id');
        // return $request->all();
       
        $data=DB::table('booking_view')
        ->where('booking_id',$booking_id)
        ->get();
        if(count($data)>0){

            $booking_type = $data[0]->booking_type;
            $distance = $data[0]->booking_distance;
            $booking_amount = $data[0]->booking_amount;   
            if($booking_type =='0' || $booking_type=='1' ||$booking_type=='2'){
            
                $category_type=$data[0]->booking_category;
                $pickup_lat=$data[0]->booking_pick_lat;
                $pickup_long=$data[0]->booking_pick_long;
                // $nearest_drivers=DB::select("SELECT * from driver where driver_id=53 ");
                $nearest_drivers=DB::select("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS(  $pickup_lat* pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long-driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE vehicle.vehicle_category_type = '$category_type' AND driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10;");
        $result['driver']=$nearest_drivers;
        // $result['booking']=$data;

                foreach ($nearest_drivers as $nav){

                    $driver_id = $nav->driver_id;
                    $driver_name = $nav->driver_name;
                    // $vehicle_id = $nav->vehicle_id;
                    $driver_fcm_token = $nav->driver_fcm_token;
                    if(!empty($driver_fcm_token)){
                        $i =0;
                        $title='New Booking';
                        $sound="default";
                        $image="https://madmin.cabmed.in/site_img/title_icon.png";
                        $key='1';

                        $key2=''.$booking_id; // splash screen
                        $body=  "Hey ,".$driver_name." You have a new booking from MedCab | Ambulance Service "; 
                        $dataArray=['enquiry_id' => $booking_id,'driver_id'=>$driver_id,'key1'=>'1'];
                        // $result = app('App\Http\Controllers\SendNotificationController')->send_notification($request,$dataArray);
                        $result[$driver_id] = $this->notification_msg($driver_fcm_token,$title,$body,$sound,$image,$key,$key2);
                        $driver_status =DB::select("INSERT INTO `booking_assigned_td` (`booking_assigned_td_id`, `booking_assigned_td_booking_id`, `booking_assigned_td_driver_id`, `booking_assigned_td_status`) VALUES (NULL, '$booking_id', '$driver_id', '1') "); // category filter and distance filter pending
                        $current_time=time();
                        $updatedriver_time =DB::select("UPDATE `driver` SET `driver_last_booking_notified_time` = $current_time WHERE `driver`.`driver_id` = $driver_id;
                        "); // Notifiy Driver
                        
                    } 
                }
                return response()->json([
                    'result'=>'S',
                    'status'=>'0',
                    'Message'=>"Send Booking Notification to driver Sucessfully.",
                    'result'=>"done",
                    // 'drivers'=>$nearest_drivers
                    
                ]);
            }
        } 
       
      else{
        return response()->json([
            'result'=>'S',
            'status'=>'1',
            'Message'=>"Failed to send  booking  notification to driver.",
            'data'=>$data,
            'booking_id'=>$booking_id,
            
            
        ]);
      }
}

    public function notification_msg($id = NULL,$title,$body,$sound,$image=NULL,$key,$key2) {
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