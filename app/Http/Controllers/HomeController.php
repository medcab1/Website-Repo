<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\vehicle;
use Input;
use Session;

class HomeController extends Controller
{   
    public function __construct(){
        $ser_cat=DB::table('ambulance_category')->where('ambulance_category_status','=','0')->get();
        $ambu_equips=DB::table('ambulance_facilities')->leftJoin('ambulance_category','ambulance_facilities.ambulance_facilities_category_type','=','ambulance_category.ambulance_category_type')->get();
        Session::put(['ser_cats'=>$ser_cat,'ambu_equips'=>$ambu_equips]);
    }
    public function sitemap(){
        $xml = View('sitemap');
        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
    }
 
    public function index(){
       
        return view('home');
    }
    public function selectCategory(){
        return view('searchAmbu');
    }
    public function ambu_price_detail(Request $req){
    
        $users=$req->all();
        // dd($users);
        $pick=$req->input('pick');
        $drop=$req->input('drop');
        $pickup_lat=$req->input('pick_lat');
        $pickup_long=$req->input('pick_lng');
        $origin=$req->input('pick_lat').','.$req->input('pick_lng');
        $dest=$req->input('drop_lat').','.$req->input('drop_lng');
        if($users['booking-type']==0 || $users['booking-type']==2){
            if($req->input('drop_lat')=='lat' && $req->input('drop_lng')=='lng'){
                $response=Http::post('https://maps.googleapis.com/maps/api/directions/json?key='.env('GOOGLE_MAP_KEY').'&origin='.$pick.'&destination='.$drop.'&mode=driving');  
                $route=$response->json()['routes'];
                 
            }
            else{
                $response=Http::post('https://maps.googleapis.com/maps/api/directions/json?key='.env('GOOGLE_MAP_KEY').'&origin='.$origin.'&destination='.$dest.'&mode=driving');
                $route=$response->json()['routes'];
            }
            $users['drop_lat']=$route[0]['legs'][0]['end_location']['lat'];
            $users['drop_lng']=$route[0]['legs'][0]['end_location']['lng'];
            $distance=$route[0]['legs'][0]['distance']['value']/1000;  
            $duration=$route[0]['legs'][0]['duration']['text'];
            $polyline=$route[0]['overview_polyline']['points'];
           
        }
        else{
            $users['drop_lat']='';
            $users['drop']='';
            $users['drop_lng']='';
            $distance='';
            $polyline='';
            if($users['booking-period']==24){
                $duration=$users['sel-hours'];
            }
            else if($users['booking-period']==31){
                $duration=$users['sel-days'];
            }
            else{
                $duration='';
            }
        }
        
        session::put(['distance' => $distance, 'polyline' => $polyline, 'duration' =>$duration]);
        session::forget('booking_id');
        $users['distance']=$distance;
        $support_list=DB::table('ambulance_support_specialists')->get();
        $cases_like=DB::table('ambulance_category_case_like')->get();
        $ambu_cat= DB::table('ambulance_category')->get();
        $ambu_facilities=DB::table('ambulance_facilities')->get();
      
        if($users['booking-type']==0 || $users['booking-type']==2){
            if(!empty($users)){ 
                $price=DB::select('select * from ambulance_category join ambulance_base_rate on ambulance_category.ambulance_category_type=ambulance_base_rate.ambulance_base_rate_cat_type join ambulance_rate on ambulance_rate.ambulance_rate_category_type=ambulance_category.ambulance_category_type where '.$distance.' between ambulance_rate_starting_km AND ambulance_rate_end_km');  
                $ambu_facilities=DB::select('select * from ambulance_facilities join ambulance_facilities_rate on ambulance_facilities.ambulance_facilities_id=ambulance_facilities_rate.ambulance_facilities_rate_f_id where '.$distance.' between ambulance_facilities_rate_from AND ambulance_facilities_rate_to');
            }
            else{
                return Redirect::route('/');
            }
        }
        else{
            if($users['booking-period']==24){
                $bookingDuration= $users['sel-hours'];
                $book_duration_type=0;
                $price=DB::select("SELECT *,arr_day_amount as arr_rental_amount  FROM ambulance_rental_rate LEFT JOIN ambulance_category On ambulance_category.ambulance_category_type=ambulance_rental_rate.arr_category_type WHERE ($bookingDuration BETWEEN ambulance_rental_rate.arr_value_from and ambulance_rental_rate.arr_value_to) AND aa_book_type ='$book_duration_type'");
            }
            else{
                $bookingDuration= $users['sel-days'];
                $book_duration_type=1;
                $price=DB::select("SELECT *,arr_day_amount*$bookingDuration as arr_rental_amount FROM ambulance_rental_rate LEFT JOIN ambulance_category On ambulance_category.ambulance_category_type=ambulance_rental_rate.arr_category_type WHERE  aa_book_type ='$book_duration_type'");
            
            }
            
        }
        $price_list=[];
        foreach($price as $avl){
            $distance_avl=DB::Select("SELECT * , (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS(  $pickup_lat* pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long-driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE vehicle.vehicle_category_type = '$avl->ambulance_category_type' AND driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10;");
            if(count($distance_avl)>0){
                $driver_dis=round($distance_avl[0]->distance)*5;
                if($driver_dis>0){
                    $arrival=$driver_dis ." min away";
                }
                else{
                    $arrival=5 ." min away";
                }
                
                $avl->avl_status='0';
                $avl->arrival_time=($arrival!='')?$arrival:'10 Min away';

            }
            else{
                $avl->avl_status='1';
                $avl->arrival_time='Not Available';
            }
            array_push($price_list,$avl);
        }
        $price=$price_list;
        session::put(['support_list'=>$support_list,'users'=>$users]);
        return view('searchAmbu')-> with(compact('ambu_cat','price','ambu_facilities','users','cases_like'));

    }

    public function getAvailableCategory(Request $request){
        $distance=session('distance');
        $pickup_lat=session('users')['pick_lat'];
        $pickup_long=session('users')['pick_lng'];
        if(session('users')['booking-type']==0 || session('users')['booking-type']==2){
            if(!empty(session('users'))){ 
                $price=DB::select('select ambulance_category.ambulance_category_type from ambulance_category join ambulance_base_rate on ambulance_category.ambulance_category_type=ambulance_base_rate.ambulance_base_rate_cat_type join ambulance_rate on ambulance_rate.ambulance_rate_category_type=ambulance_category.ambulance_category_type where '.$distance.' between ambulance_rate_starting_km AND ambulance_rate_end_km');  
                $ambu_facilities=DB::select('select * from ambulance_facilities join ambulance_facilities_rate on ambulance_facilities.ambulance_facilities_id=ambulance_facilities_rate.ambulance_facilities_rate_f_id where '.$distance.' between ambulance_facilities_rate_from AND ambulance_facilities_rate_to');
            }
            else{
                return response()->json(['status'=>'F','message'=>'Invalid Request']);
            }
        }
        else{
            if(session("users")['booking-period']==24){
                $bookingDuration= session('users')['sel-hours'];
                $book_duration_type=0;
                $price=DB::select("SELECT ambulance_category.ambulance_category_type,arr_day_amount as arr_rental_amount  FROM ambulance_rental_rate LEFT JOIN ambulance_category On ambulance_category.ambulance_category_type=ambulance_rental_rate.arr_category_type WHERE ($bookingDuration BETWEEN ambulance_rental_rate.arr_value_from and ambulance_rental_rate.arr_value_to) AND aa_book_type ='$book_duration_type'");
            }
            else{
                $bookingDuration= session('users')['sel-days'];
                $book_duration_type=1;
                $price=DB::select("SELECT ambulance_category.ambulance_category_type,arr_day_amount*$bookingDuration as arr_rental_amount FROM ambulance_rental_rate LEFT JOIN ambulance_category On ambulance_category.ambulance_category_type=ambulance_rental_rate.arr_category_type WHERE  aa_book_type ='$book_duration_type'");
            
            }
            
        }
        $price_list=[];
        foreach($price as $avl){
            $distance_avl=DB::Select("SELECT (6371 * 2 * ASIN(SQRT( POWER(SIN(( $pickup_lat- driver_live_location_lat) * pi()/180 / 2), 2) +COS(  $pickup_lat* pi()/180) * COS(driver_live_location_lat * pi()/180) * POWER(SIN(( $pickup_long-driver_live_location_long) * pi()/180 / 2), 2) ))) as distance , ROUND((UNIX_TIMESTAMP()-driver_live_location.driver_live_location_updated_time) / 60, 0) as time_diff , ROUND((UNIX_TIMESTAMP()-driver.driver_last_booking_notified_time) / 60, 0) as last_booking from driver_live_location LEFT JOIN driver ON driver.driver_id =driver_live_location.driver_live_location_d_id LEFT JOIN vehicle ON vehicle.vehicle_id= driver.driver_assigned_vehicle_id WHERE vehicle.vehicle_category_type = '$avl->ambulance_category_type' AND driver.driver_on_booking_status = '0' AND driver.driver_duty_status= 'ON' having distance <= 40 AND time_diff <= 100 AND last_booking >= .60 order by distance LIMIT 10;");
            if(count($distance_avl)>0){
                $driver_dis=round($distance_avl[0]->distance)*5;
                if($driver_dis>0){
                    $arrival=$driver_dis ." min away";
                }
                else{
                    $arrival=5 ." min away";
                }
                
                $avl->avl_status='0';
                $avl->arrival_time=($arrival!='')?$arrival:'10 Min away';

            }
            else{
                $avl->avl_status='1';
                $avl->arrival_time='Not Available';
            }
            array_push($price_list,$avl);
        }
        $price=$price_list;
        $users=session('users');
        return response()->json([
            'users'=>$users,
            'price_list'=>$price,
            'Message'=>'Availability of ambulance category for booking'
        ]);
       

    }


    public function filterAvailableFacility(Request $request){
        $facility_search=$request->input('facility_search');
        $city=$request->input('city');
        $data=DB::select("SELECT  distinct hospital_service_category.hospital_serv_cat_id,hospital_service_category.hospital_serv_cat_icon,hospital_service_category.hospital_serv_cat_name, 'In City' as distance from `hospital_available_service` JOIN hospital_lists On hospital_available_service.ha_hospital_id=hospital_lists.hospital_id LEFT JOIN hospital_service_category ON hospital_available_service.hospital_available_serv_cat_id=hospital_service_category.hospital_serv_cat_id LEFT JOIN city ON city.city_id=hospital_lists.hospital_city_name WHERE hospital_service_category.hospital_serv_cat_status='0'AND hospital_service_category.hospital_serv_cat_name Like '%$facility_search%' order by hospital_id DESC"); 
        $output='';
        $output=' <div class="row justify-content-center">'; 
        
        if(count($data)>0){      
            foreach($data as $facility){
                $output.='<div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                <div class="h-facility-box">
                    <div class="h-facility-icon">
                        <img src="https://dev.cabmed.in/'.$facility->hospital_serv_cat_icon.'" alt="">
                    </div>
                    <span class="h-facility-name">'
                        .$facility->hospital_serv_cat_name.'
                    </span>
                    <span class="h-facility-desc">
                            Check Availability of both AC and Non-AC
                    </span>
                    <div class="h-facility-arrow">
                        <a href="https://book.cabmed.in/hospital/check-hospital-availability/'.$city.'/'.$facility->hospital_serv_cat_id.'" class="check-avl-hospital"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>'; 
            }
        }    
        else{
            $output.="<h6  class='text-center text-gray'>Not Available !</h6>";
        }
        $output.="</div>";
        // echo $output;
        return response()->json(['facilities'=>$output]);
    }
    public function searchHospitalCity(Request $request){
        $city=$request->input('city');
        $output='';
        $output='<ul class="list-group">'; 
        $cityList=DB::table('city')->join('state','state.state_id','=','city.city_state')
        ->where('city_name', 'LIKE',  $city . '%')
        ->get(); 
        if($cityList->count()>0){      
            foreach($cityList as $cityname){
                $output.='<li class="list-group-item list-group-item-action" city_id="'.$cityname->city_id.'">'.$cityname->city_name.', '.$cityname->state_name.'</li>'; 
            }
        }    
        else{
            $output.="<li  class='list-group-item'>City not found</li>";
        }
        $output.="</ul>";
        return response()->json(['cities'=>$output]);
    }
    public function checkHospitalAvailability(Request $request){
        $ser_id=$request->input('ser_id');
        $city=$request->input('city');
        $data=DB::select("SELECT  hospital_lists.hospital_name ,hospital_service_category.hospital_serv_cat_id,hospital_service_category.hospital_serv_cat_icon,hospital_service_category.hospital_serv_cat_name, 'In City' as distance from `hospital_available_service` JOIN hospital_lists On hospital_available_service.ha_hospital_id=hospital_lists.hospital_id LEFT JOIN hospital_service_category ON hospital_available_service.hospital_available_serv_cat_id=hospital_service_category.hospital_serv_cat_id LEFT JOIN city ON city.city_id=hospital_lists.hospital_city_name WHERE city.city_name='Varanasi' AND hospital_service_category.hospital_serv_cat_status='0' order by hospital_id DESC LIMIT 10");
        return view('checkAvailabilityInHospital')->with(compact('data','city'));;
    }

}
