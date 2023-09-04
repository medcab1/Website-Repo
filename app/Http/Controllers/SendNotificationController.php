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


class SendNotificationController extends Controller
{
    public function send_notification(Request $request,$data){
            $enquiry_id=$data['enquiry_id'];
            $driver_id=$data['driver_id'];
            $key1=$data['key1'];
            // $fcm_token =$data['fcm_token'];
            //..............notification......................
            $booked_driver =DB::select("SELECT * FROM `driver` where driver_id='$driver_id'"); 
            if ($booked_driver){
                $driver_name = $booked_driver[0]->driver_name;
                $driver_fcm_token = $booked_driver[0]->driver_fcm_token;
                if($key1==2){
                    $title_text='Booking Cancellation';
                    $driver_fcm_token = $booked_driver[0]->driver_fcm_token;
                    $bodyy=  "Hey ,".$driver_name." Your booking ID ".$enquiry_id." has been cancelled. | Ambulance Service "; 
                    $update_driver_book_status=DB::table('driver')->where('driver_id', $driver_id)
                    ->update(['driver_on_booking_status'=>'0']);//Update driver active 1 for on duity and 0 for free on duty status for duity

                }
                else{
                    $title_text='New Booking';
                    // $driver_fcm_token =  $fcm_token;
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
                    'Message'=>"Send booking Notification to driver Sucessfully.",
                    'data_result'=>$result,
                ]);
                
            }
            //..............notification end......................

            
            return response()->json([
                'result'=>'F',
                'status'=>'1',
                'Message'=>"Failed to send  cancellation  notification to driver.",
                
            ]);
    }

    public function bulk_notification(Request $request,$data){
        $enquiry_id=$data['enquiry_id'];
        $driver_id=$data['driver_id'];
        $key=$data['key1'];
        $fcm_token =$data['fcm_token'];
        $title=$data['title'];
        $body=$data['body'];
        $sound=$data['sound'];
        $image=$data['image'];
        //..............notification......................
        
            if(!empty($fcm_token)){
                $i =0;
                $key2=''.$enquiry_id; // splash screen
                $result = $this->notification_msg($fcm_token,$title,$body,$sound,$image,$key,$key2);
            return response()->json([
                'result'=>'S',
                'status'=>'0',
                'Message'=>"Send booking Notification to driver Sucessfully.",
                'response'=>$result,    
            ]);
            
            }
        else{
            return response()->json([
                'result'=>'F',
                'status'=>'1',
                'Message'=>"Failed to send  booking  notification to driver.",
                'data'=>$request->all(),
                
            ]);
        }
}

public function cancel_notification(Request $request,$data){
    $enquiry_id=$data['enquiry_id'];
    $driver_id=$data['driver_id'];
    $key1=$data['key1'];
    //..............notification......................
    $booked_driver =DB::select("SELECT * FROM `driver` where driver_id='$driver_id'"); 
    if ($booked_driver){
        $driver_name = $booked_driver[0]->driver_name;
        $driver_fcm_token = $booked_driver[0]->driver_fcm_token;
            $title_text='Booking Cancellation';
            $driver_fcm_token = $booked_driver[0]->driver_fcm_token;
            $bodyy=  "Hey ,".$driver_name." Your booking ID ".$enquiry_id." has been cancelled. | Ambulance Service "; 
            $update_driver_book_status=DB::table('driver')->where('driver_id', $driver_id)
            ->update(['driver_on_booking_status'=>'0']);//Update driver active 1 for on duity and 0 for free on duty status for duity
        if(!empty($driver_fcm_token)){
            $i =0;
            $title=$title_text;
            $sound="default";
            $image="https://madmin.cabmed.in/site_img/title_icon.png";
            $key=$key1;
            $key2=''.$enquiry_id; // splash screen
            $body= $bodyy; 
            $result = $this->notification_msg($driver_fcm_token,$title,$body,$sound,$image,$key,$key2);
                       
        }
        
        return response()->json([
            'result'=>'S',
            'status'=>'0',
            'request'=>$data,
            'Message'=>"Send cancellation Notification to driver Sucessfully.",
            
        ]);
        
    }
    return response()->json([
        'result'=>'S',
        'status'=>'1',
        'Message'=>"Failed to send  cancellation  notification to driver.", 
    ]);
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