<?php



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
    

    public function send_notification($enquiry_id,$driver_id,$key1,$fcm_token){
        // dd($enquary_id);
            //........test api................................................................
            // $enquiry_id=$request->input('enquiry_id');
            // $driver_id=$request->input('driver_id');
            // $key1=$request->input('key1');
            // $fcm_token =$request->input('dvr_fcm_token');
            // dd($driver_id);
            //..............notification......................
            $booked_driver =DB::select("SELECT * FROM `driver` where driver_id='$driver_id'"); // category filter and distance filter pending
            // $booked_driver =DB::select("SELECT * FROM `driver` JOIN vehicle ON driver.driver_assigned_vehicle_id = vehicle.vehicle_id WHERE driver.driver_status='1' ANd driver.driver_duty_status='ON' AND driver.driver_id='$driver_id' "); // category filter and distance filter pending
            // dd($booked_driver);
            if ($booked_driver){
                // $driver_id = $booked_driver->driver_id;
                $driver_name = $booked_driver[0]->driver_name;
                // $vehicle_id = $booked_driver->vehicle_id;
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