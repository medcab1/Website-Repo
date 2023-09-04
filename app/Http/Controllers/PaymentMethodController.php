<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking_Payment;
use App\Models\booking_view;
use App\Models\Notification_models;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http; 
use Illuminate\Validation\Factory; 
use Input;
use Session;
use Validator;

class PaymentMethodController extends Controller

{
    public function CCPaymentRequest(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            // Add other validation rules for form inputs
        ]);

        if ($validator->fails()) {
            // dd($validator->message);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Prepare data for CC Avenue payment request
        $params = [
            'tid' => uniqid(), // Unique transaction ID
            'merchant_id' => '2566639',
            'order_id' => uniqid(), // Unique order ID
            'amount' => $request->input('amount'),
            'currency' => 'INR', 
            'redirect_url'=>route('CCpayment.PayResponse') ,
            'cancel_url'=>route('CCpayment.PayResponse') ,//
            // Add other data like customer details, etc.
        ];

        // Generate the payment URL
        $paymentUrl = $this->generatePaymentUrl($params);
        // dd($paymentUrl);
        // Redirect the user to the payment URL
        return redirect($paymentUrl);
    }

    private function generatePaymentUrl($params)
    {
        $workingKey = '713B0F5F080E4302A5DBCA80C6514B0A';
        $accessCode = 'AVWU77KF78BE31UWEB';
        // Generate checksum using working key and params
        // $checksum = $this->generateChecksum($params, $workingKey);

        // Append the checksum to the payment URL
        $paymentUrl = 'https://medcab.in/assets/cc_pay_old/ccavRequestHandler.php&merchant_id=2566639' .
            '&tid=' .
            $params['tid'] .
            'order_id=' .
            $params['order_id'] .
            '&amount=' .
            $params['amount'] .
            '&currency=' .
            $params['currency'] .
            '&currency=INR&redirect_url=' .
            route('CCpayment.PayResponse') .
            '&cancel_url=' .
            route('CCpayment.PayResponse') .
            '&language=EN&'.
            $params['tid'] ;
           

        return $paymentUrl;
    }

    private function generateChecksum($params, $workingKey)
    {
        // Generate checksum logic (refer to CC Avenue documentation)
        $data = $params['tid'] . '|' .
            $params['merchant_id'] . '|' .
            $params['amount'] . '|' .
            $params['order_id'] . '|' .
            $params['currency'] . '|' .
            $params['redirect_url'] . '|' .
            $params['cancel_url'] . '|' .
            $workingKey;

    $checksum = strtoupper(hash('sha256', $data));
    DD($checksum);
    return $checksum;
    }

    public function paymentResponse(Request $request)
    {
        dd($request->all());
        // Handle the payment response from CC Avenue
    }

    // public function CCavenuPayment(Request $request){
    //     $consumer_id=$request->input('consumer_id');
    //     $booking_id=$request->input('booking_id');
    //     $transaction_status=$request->input('transaction_status');
    //     if($transaction_status=='Success'){
    //         $status=0;
    //     }
    //     else{
    //         $status=1;
    //     }
    //     $order_id='MEDCAB'.sprintf("%04d", $booking_id).rand(100,999);
    //         $consumer_payments=new booking_payments;
    //         $consumer_payments->payment_source='CCAvenue';
    //         $consumer_payments->consumer_id=$consumer_id;
    //         $consumer_payments->booking_id=$booking_id;
    //         $consumer_payments->transaction_id=$request->input('transaction_id');
    //         $consumer_payments->amount=$request->input('transaction_amount');
    //         $consumer_payments->status=$request->input('transaction_status');
    //         $consumer_payments->order_id=$order_id;
    //         $consumer_payments->booking_payments_trans_status=$status;
    //         $consumer_payments->booking_transaction_time=$request->input('transaction_time');
    //         $saved=$consumer_payments->save();
    //         if($saved){
    //             $data=[
    //                 'result'=>'S',
    //                 'status'=>'0',
    //                 'Message'=>"Payment Done successfully!",
                
    //             ];

    //             app('App\Http\Controllers\DriverNotificationController')->booking_send_notification($request,$booking_id);
    //         }
    //         else{
    //             $data=[
    //                 'result'=>'F',
    //                 'status'=>'1',
    //                 'Message'=>"Payment failed!",
                
    //             ];
    //         }
    //         return response()->json($data);
            

    // }
    public function CCavenuPayment(Request $request){
        $consumer_id=$request->input('consumer_id');
        $booking_id=$request->input('enquary_id');
        $order_id=$request->input('order_id');
        $transaction_id=$request->input('transection_id');
        $transaction_status=$request->input('order_status');
        $transaction_amount=$request->input('transfer_amount'); 
        $bank_ref_no=$request->input('bank_ref_no'); 
        $payment_mode=$request->input('payment_mode'); 
        $payment_mobile=$request->input('payment_mobile'); 
        // $time=$request->input('time'); 
        $time=time();
        if($transaction_status=='Success'){
            $status=0;
        
            $consumer_payments=new Booking_Payment;
            $consumer_payments->payment_source='CCAvenue';
            $consumer_payments->consumer_id=$consumer_id;
            $consumer_payments->booking_id=$booking_id;
            $consumer_payments->transaction_id=$transaction_id;
            $consumer_payments->bank_ref_no = $bank_ref_no;
            $consumer_payments->payment_mobile = $payment_mobile;
            $consumer_payments->amount=$transaction_amount;
            $consumer_payments->status=$transaction_status;
            $consumer_payments->order_id=$order_id;
            $consumer_payments->booking_payments_trans_status=$status;
            $consumer_payments->booking_transaction_time=$time;
            $saved=$consumer_payments->save();
       
            if($saved){
                $booking_detail=DB::table('booking_view')->where('booking_id',$booking_id)->get();
                if($booking_detail[0]->booking_type==2){
                    $master_key=$booking_detail[0]->booking_bulk_master_key;
                    $bulk_no=0;
                    $bulk_booking=DB::table('booking_view')->where('booking_bulk_master_key',$master_key)->get();
                    $check_booking=$bulk_booking[0];
                    if($bulk_booking->count()==1){ 
                        for($i=2;$i<=$bulk_booking[0]->booking_bulk_total;$i++){
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
                  
                    foreach($bulk_booking as $bulk){
                        $booking_id=$bulk->booking_id;
                        $rData=app('App\Http\Controllers\DriverNotificationController')->booking_send_notification($request,$booking_id);
                        $resultData[$booking_id]=$rData;
                    }
                }
                else{
                    $resultData=app('App\Http\Controllers\DriverNotificationController')->booking_send_notification($request,$booking_id);
                }

                $data=[
                    'result'=>'S',
                    'status'=>'0',
                    'Message'=>"Payment Done successfully!",
                    'resultData'=>$resultData,
                
                ];
            }
            else{
                $data=[
                    'result'=>'F',
                    'status'=>'1',
                    'Message'=>"Payment failed!",
                    'resultData'=>'null'

                
                ];
            }
        }
        else{
            $status=1;
            $data=[
                'result'=>'F',
                'status'=>'1',
                'Message'=>"Payment failed!",
                
            
            ];
        }
            return response()->json($data);
            

    }
    
    public function CCavenuPendingPayment(Request $request){
        $consumer_id=$request->input('consumer_id');
        $booking_id=$request->input('enquary_id');
        $order_id=$request->input('order_id');
        $transaction_id=$request->input('transection_id');
        $transaction_status=$request->input('order_status');
        $transaction_amount=$request->input('transfer_amount'); 
        $bank_ref_no=$request->input('bank_ref_no'); 
        $payment_mode=$request->input('payment_mode'); 
        $payment_mobile=$request->input('payment_mobile'); 
        $time=$request->input('time'); 
        if($transaction_status=='Success'){
            $status=0;
        
            $consumer_payments=new Booking_Payment;
            $consumer_payments->payment_source='CCAvenue';
            $consumer_payments->consumer_id=$consumer_id;
            $consumer_payments->booking_id=$booking_id;
            $consumer_payments->transaction_id=$transaction_id;
            $consumer_payments->bank_ref_no = $bank_ref_no;
            $consumer_payments->payment_mobile = $payment_mobile;
            $consumer_payments->amount=$transaction_amount;
            $consumer_payments->status=$transaction_status;
            $consumer_payments->order_id=$order_id;
            $consumer_payments->booking_payments_trans_status=$status;
            $consumer_payments->booking_transaction_time=$time;
            $saved=$consumer_payments->save();
            if($saved){
                    DB::table('booking_view')
                    ->where('booking_id', $booking_id)
                    ->update([ 
                        'booking_payment_type' => '1',
                        'booking_payment_method' => '1',
                        'booking_payment_status' => '2',
                    ]); 

                
                $bucket =[];
                $data_res['consumer_id'] = $consumer_id;
                $data_res['transfer_amount'] = $transaction_amount;  
                array_push($bucket, $data_res);

                return response()->json([
                    'result'=>'S',
                    'status'=>'0',
                    'Message'=>"Pending Payment Done successfully!",
                    "JSONData"=>$bucket
                ]); 

            }
            else{
               
                $bucket =[]; 
                return response()->json([
                    'result'=>'F',
                    'status'=>'1',
                    'Message'=>"Somthing Went Wrong, Please Try Again!",
                    "JSONData"=>$bucket
                ]); 
            }
        }
        else{
            // $status=1;
            // $data=[
            //     'result'=>'F',
            //     'status'=>'1',
            //     'Message'=>"Payment failed!",
            
            // ];
            $bucket =[]; 
                return response()->json([
                    'result'=>'F',
                    'status'=>'1',
                    'Message'=>"Somthing Went Wrong, Please Try Again!",
                    "JSONData"=>$bucket
                ]);
        }
             
            

    }
    
}
