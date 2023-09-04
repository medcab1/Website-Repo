<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking_Payment;
use App\Models\booking_view;
use Razorpay\Api\Api;
use App\Models\Notification_models;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http; 
use Illuminate\Validation\Factory; 
use Validator;
use Input;
use Session;


class BookingPaymentController extends Controller
{
    //use this on top in the controller
    public function viewPayment(){
        return view('payment');
    }
    public function sessionPrint(){
        dd(session()->all());
    }
    public function saveBulk(Request $request){
        $bulk_no=0;
        $masterKey=session('consumer.booking_bulk_master_key');
        $check_booking_data=DB::table('booking_view')->where('booking_bulk_master_key',$masterKey)->get();
        $check_booking=$check_booking_data[0];
        if($check_booking_data->count()==1){ 
            for($i=2;$i<=session('selAmbuData')['total_ambu'];$i++){
                $booking = new booking_view;  
                $booking->booking_source='WEBSITE';        
                $booking->booking_type=$check_booking->booking_type;   
                $booking->booking_no_of_bulk=$i;
                $booking->booking_bulk_total=$check_booking->booking_bulk_total;
                $booking->booking_type_for_rental=0;     
                $booking->booking_bulk_master_key=$check_booking->booking_bulk_master_key;     
                $booking->booking_by_cid=$check_booking->booking_by_cid;  
                $booking->booking_view_otp=random_int(1000,9999);   
                $booking->booking_view_status_otp='1';  
                $booking->booking_con_name = $check_booking->booking_con_name;
                $booking->booking_con_mobile =$check_booking->booking_con_mobile;
                $booking->booking_category =$check_booking->booking_category ;
                $booking->booking_schedule_time =$check_booking->booking_schedule_time;
                $booking->booking_pickup =$check_booking->booking_pickup;
                $booking->booking_drop =$check_booking->booking_drop;
                $booking->booking_pick_lat =$check_booking->booking_pick_lat;
                $booking->booking_pick_long =$check_booking->booking_pick_long;
                $booking->booking_drop_lat =$check_booking->booking_drop_lat;
                $booking->booking_drop_long =$check_booking->booking_drop_long;
                $booking->booking_amount =$check_booking->booking_amount;
                $booking->booking_adv_amount=$check_booking->booking_adv_amount;
                $booking->booking_payment_type =$check_booking->booking_payment_type;
                $booking->booking_payment_method =$check_booking->booking_payment_method ;
                $booking->booking_distance =$check_booking->booking_distance;
                $booking->booking_duration =$check_booking->booking_duration ;
                $booking->booking_polyline =$check_booking->booking_polyline;
                $booking->booking_total_amount =$check_booking->booking_total_amount;
                $booking->booking_status =$check_booking->booking_status ;
                $booking->booking_payment_status =$check_booking->booking_payment_status;
                $booking->booking_acpt_driver_id =$check_booking->booking_acpt_driver_id;
                $booking->booking_acpt_vehicle_id=$check_booking->booking_acpt_vehicle_id;
                $booking->booking_acpt_time=$check_booking->booking_acpt_time;
                $booking->booking_ap_polilyne=$check_booking->booking_ap_polilyne;
                $booking->booking_view_category_name=$check_booking->booking_view_category_name;
                $booking->booking_view_category_icon=$check_booking->booking_view_category_icon;
                $booking->booking_view_base_rate=$check_booking->booking_view_base_rate;
                $booking->booking_view_km_till=$check_booking->booking_view_km_till;
                $booking->booking_view_per_km_rate=$check_booking->booking_view_per_km_rate;
                $booking->booking_view_per_ext_km_rate=$check_booking->booking_view_per_ext_km_rate;
                $booking->booking_view_per_ext_min_rate=$check_booking->booking_view_per_ext_min_rate;
                $booking->booking_view_km_rate=$check_booking->booking_view_km_rate;
                $booking->booking_view_total_fare=$check_booking->booking_view_total_fare;
                $booking->booking_view_service_charge_rate=$check_booking->booking_view_service_charge_rate;
                $booking->booking_view_includes=$check_booking->booking_view_includes;
                $booking->booking_view_arrival_time=$check_booking->booking_view_arrival_time;
                $result=$booking->save();
                $pickup_lat = $check_booking->booking_pick_lat;
                $pickup_long = $check_booking->booking_pick_long;
                if($result){
                    $status=$result;                  
                }

            }
        }
        $testBulk=DB::table('booking_view')->where([['booking_bulk_master_key','=',session('consumer.booking_bulk_master_key')]])->get();
        if($testBulk->count()==$testBulk[0]->booking_bulk_total){
           print_r($testBulk);
            foreach($testBulk as $bulk){
                $bulk_no=0;
                $category_type=$bulk->booking_category;
                $pickup_lat=$bulk->booking_pick_lat;
                $pickup_long=$bulk->booking_pick_long;
                $nearest_drivers=DB::select("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS( $pickup_lat * pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long - driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id  WHERE vehicle.vehicle_category_type = '$category_type' AND driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10");
                // dd($nearest_drivers);
                
                // vehicle.vehicle_category_type = '$category_type' add in above query
                // $nearest_drivers=DB::select("SELECT * from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE  driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' ");
                foreach ($nearest_drivers as $nav){
                    $driver_id = $nav->driver_id;
                    $driver_name = $nav->driver_name;
                    $vehicle_id = $nav->vehicle_id;
                    $driver_fcm_token = $nav->driver_fcm_token;
                    echo "Notifying driver";
                    if(!empty($driver_fcm_token)){
                        $i =0;
                        $dataArray=['title'=>'New Booking',
                        'fcm_token'=>$driver_fcm_token,
                        'sound'=>"default",
                        'image'=>"https://madmin.cabmed.in/site_img/title_icon.png",
                        'key1'=>'1',
                        'key2'=>$bulk->booking_id,
                        'enquiry_id'=>$bulk->booking_id,
                        'driver_id'=>$driver_id,
                        'body'=>  "Hey ,".$driver_name." You have a booking from MedCab | Ambulance Service "];
                        $result =app('App\Http\Controllers\SendNotificationController')->bulk_notification($request,$dataArray);
                        $current_time = time();
                        $status=DB::select("INSERT INTO `booking_assigned_td` (`booking_assigned_td_id`, `booking_assigned_td_booking_id`, `booking_assigned_td_driver_id`, `booking_assigned_td_status`) VALUES (NULL, '$bulk->booking_id', '$driver_id', '1') "); // category filter and distance filter pending
                    } 
                }
                $bulk_no=$bulk_no+0;
            }
        }
        return response()->json(['status'=>$status, 'bulk_no'=>$bulk_no]);
    }
    public function saveBulkBookingDetails(Request $request){
        $masterKey=session('consumer.booking_bulk_master_key');
        $testBulk=DB::table('booking_view')->where([['booking_bulk_master_key','=',$masterKey]])->get();
        if($testBulk->count()==1 && $testBulk->count()!=$testBulk[0]->booking_bulk_total){
            // if($testBulk->count()==$testBulk[0]->booking_bulk_total){
            if($masterKey!=0 || $masterKey!=""){
                $result=$this->saveBulk($request);
                echo "notification";

                    // if($result){
                    //     // dd($request);
                    //     return redirect()->route('Booking.History');
                    // }
                    // else{
                    //     return view('booking')->with("booking_status","Booking failed!");
                    // }
                    return redirect()->route('Booking.History');

            }
            else{
                echo 'Failed';
            }
        }
        else{
            return redirect()->route('Booking.History');
        }
        

    }
    public function orderIdGenerate(Request $request){
        $api = new Api(config('app.razorpay_api_key'), config('app.seceret_key'));
        $order = $api->order->create(array('receipt' => 'order_rcptid_11', 'amount' => $request->input('price') * 100, 'currency' => 'INR')); // Creates order
        return response()->json(['order_id' => $order['id']]);
    }

    
    public function storePayment($razorpay_payment_id,$razorpay_order_id,$razorpay_payment_signature)
    {
        $api = new Api(config('app.razorpay_api_key'), config('app.seceret_key'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($razorpay_payment_id);
        if(!empty($payment) && $payment['status'] == 'captured') {
            $paymentId = $payment['id'];
            $amount = $payment['amount'];
            $currency = $payment['currency'];
            $status = $payment['status'];
            $entity = $payment['entity'];
            $orderId = $payment['order_id'];
            $invoiceId = $payment['invoice_id'];
            $method = $payment['method'];
            $bank = $payment['bank'];
            $wallet = $payment['wallet'];
            $bankTranstionId = isset($payment['acquirer_data']['bank_transaction_id']) ? $payment['acquirer_data']['bank_transaction_id'] : '';
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong, Please try again later!');
        }
        $check_transaction=Booking_Payment::where('booking_id','=',session('booking_id'))->get();
        if($check_transaction->count()==1){
            // dd($check_transaction);
            return redirect()->route('PaymentDone')->with(['success'=>'Payment Detail store successfully!',"payment_details"=>$check_transaction]);
        }
        else{
            try {
                // Payment detail save in database
                session::put('payAmount',$amount / 100);
                $payment = new Booking_Payment;
                $payment->consumer_id = session('consumer_id');
                $payment->booking_id = session('booking_id');
                $payment->transaction_id = $paymentId;
                $payment->amount = $amount / 100;
                $payment->currency = $currency;
                $payment->entity = $entity;
                $payment->status = $status;
                $payment->order_id = $orderId;
                $payment->method = $method;
                $payment->bank = $bank;
                $payment->wallet = $wallet;
                $payment->bank_ref_no = $bankTranstionId;
                $payment->booking_transaction_time=time();
                $saved = $payment->save();

                if($saved)
                {
                    session::put(['pay_id'=>$payment,'orderId'=>$orderId,'transactionId'=>$paymentId]);
                    if(session('users')['booking-type']==2){
                        $result=$this->saveBulk();
                        // if($result){
                        //     echo "Way to upcoming booking and booking history.";
                        //     return redirect()->route('Booking.History');
                        // }
                        // else{
                        //     echo "payment with bulk data failed";
                        //     // return redirect()->route('Driver.SearchDriver');
                        // }
                        return redirect()->route('Booking.History');

                    }
                    else{
                        return redirect()->route('Driver.SearchDriver');
                    }
                    
                }
                else
                {
                    return redirect()->
                            route('PaymentDone')
                            ->with(['status'=>'Something went wrong, Please try again later!']);
                }
            }
            catch (Exception $e) {
                $saved = false;
                echo "PaymentError:Something went wrong, Please try again later" ;
            }
        }
        
    }
    

}
