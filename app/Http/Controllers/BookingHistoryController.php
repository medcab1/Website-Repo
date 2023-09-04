<?php

namespace App\Http\Controllers;

use App\Models\booking_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Validator;
use Input;
use Session;
use Carbon;


class BookingHistoryController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
   public function bulk_notification(){
    $current_time = time();
    $pickup_lat = session('users')['pick_lat'];
    $pickup_long = session('users')['pick_lng'];
    $bulkData=DB::table('booking_view')->where([
        ['booking_bulk_master_key','=',session('consumer.booking_bulk_master_key')],
        ['booking_by_cid','=',session('consumer_id')]
    ])->get();  
    foreach($bulkData as $bulk){

    //..............notification. for normal .....................
    $nearest_drivers =DB::select("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS( $pickup_lat * pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long - driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE vehicle.vehicle_category_type = 'A' AND driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10 "); 
    if(count($nearest_drivers) >0){
        foreach ($nearest_drivers as $nav){
            $driver_id = $nav->driver_id;
            $driver_name = $nav->driver_name;
            $vehicle_id = $nav->vehicle_id;
            $driver_fcm_token = $nav->driver_fcm_token;
            // echo "<br> Driver Shortlistd ".$driver_fcm_token; exit();

            if(!empty($driver_fcm_token)){
                $i =0;
                // $title='New Booking';
                // $sound="default";
                // $image="https://madmin.cabmed.in/site_img/title_icon.png";
                // $key='1';
                // $key2=''.session(''); // splash screen
                // $body=  "Hey ,".$driver_name."You have a booking from MedCab | Ambulance Service "; 
                // $result = $this->multiple_notification_msg($driver_fcm_token,$title,$body,$sound,$image,$key,$key2);
                $response=http::post('https://dev.cabmed.in/api/app_data/consumer_app/booking/cancel_Notification',[
                    'enquiry_id'=>$bulk->booking_id,'driver_id'=>$driver_id,'key1'=>'1','dvr_fcm_token'=>$driver_fcm_token
                ]);

                // $save_shortlist =DB::select("INSERT INTO `booking_assigned_td` (`booking_assigned_td_id`, `booking_assigned_td_booking_id`, `booking_assigned_td_driver_id`, `booking_assigned_td_status`) VALUES (NULL, '$bulk->booking_id', '$driver_id', '1') "); // assigned data

                // $updatedriver_time =DB::select("UPDATE `driver` SET `driver_last_booking_notified_time` = $current_time WHERE `driver`.`driver_id` = $driver_id;
                //             "); // Notifiy Driver    
            }
        }
        }else{
            // echo "<br> no driver found ".$category_name;
        }
        //..............notification  for Normal Booking end......................
    }  
   
   }
    public function booking_history()
    {   
             $booking_history=DB::table('booking_view')
             ->leftJoin('vehicle','booking_view.booking_acpt_vehicle_id','=','vehicle.vehicle_id')->where([['booking_by_cid','=',session('consumer_id')],['booking_status','>',2]])->orderBy('booking_id', 'DESC')->get();
             $booking_upcoming=DB::table('booking_view')
             ->leftJoin('vehicle','booking_view.booking_acpt_vehicle_id','=','vehicle.vehicle_id')->where('booking_by_cid','=',session('consumer_id'))->whereBetween('booking_status',[1,2])->orderBy('booking_id', 'DESC')->get();
            $data=[];
            $booking_data=[];
            $booking_data['booking_history']=$booking_history;
            $booking_data['booking_upcoming']=$booking_upcoming;
            array_push($data,$booking_data);
            //  dd($data);
            return view('history&upcoming')->with('data',$data);
    }

    public function booking_refreshing(){
        $booking_upcoming=DB::table('booking_view')
        ->leftJoin('vehicle','booking_view.booking_acpt_vehicle_id','=','vehicle.vehicle_id')->where([['booking_by_cid','=',session('consumer_id')],['booking_status','<=',2]])->get(['booking_id','booking_status','vehicle_rc_number']);
        $booking_data['booking_upcoming']=$booking_upcoming;
        return response()->json(['data'=>$booking_upcoming]);
    }

    public function driver_assigned($booking_id){
        $consumer_id=session('consumer_id');
        $check=DB::table('booking_view')->where('booking_id',$booking_id)->count();
        $data=[];
        $booking_data=[];
        if($check==1){
            $booking_detail=DB::table('booking_view')
            ->leftJoin('ambulance_category', 'booking_view.booking_category', '=', 'ambulance_category.ambulance_category_type')
            ->leftJoin('driver', 'booking_view.booking_acpt_driver_id', '=', 'driver.driver_id')
            ->leftJoin('vehicle', 'booking_view.booking_acpt_vehicle_id', '=', 'vehicle.vehicle_id')
            ->where('booking_id',$enquary_id)
            ->where('booking_by_cid',$consumer_id)
            ->get();
            $booking_addons=DB::table('booking_addons')
            ->where([['booking_id','=',$booking_id],
            ['booking_addons_by_cid','=',$consumer_id],
            ['booking_addons_status','=',0],
            ])->get();
            $booking_data['booking_detail']=$booking_detail;
            $booking_data['booking_addons']=$booking_addons;
            array_push($data,$booking_data);
            return view('driver_assigned')->with('data',$data);

        }
        else{
            echo "Data not found";
        }
       
    }

    // public function downloadInvoicePDF(){
    //      // Get the invoice data from your database or any other source
    //      $invoiceData = [
    //         'invoice_number' => 'INV-001',
    //         'customer_name' => 'John Doe',
    //         // Add more invoice data as needed
    //     ];
    //     $detail=session('invoice_detail');
    //     // Generate the invoice view with the data
    //     $invoiceView = View('user_invoice',compact('detail'));

    //     // Convert the specific part of the view into HTML content
    //     $invoiceContent = $invoiceView->renderSections()['main'];
    

    //     // Instantiate Dompdf
    //     $dompdf = new Dompdf();

    //     // Load HTML content into Dompdf
    //     $dompdf->loadHtml($invoiceContent);

    //     // (Optional) Set paper size and orientation
    //     $dompdf->setPaper('A4', 'portrait');

    //     // Render the HTML content to PDF
    //     $dompdf->render();

    //     // Generate a random file name for the PDF
    //     $fileName = 'invoice_' . uniqid() . '.pdf';

    //     // Save the PDF to a public directory
    //     $dompdf->stream($fileName, ['Attachment' => true]);

    //     // Return a response or redirect as needed
    //     // For example, redirect back to the previous page
    //     return redirect()->back();


    // }
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
