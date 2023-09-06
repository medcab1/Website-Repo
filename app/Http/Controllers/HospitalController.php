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

class HospitalController extends Controller
{ 
    public function CheckHospitalData(){
            $data = DB::table('hospital_service_category')
            ->orderBy('hospital_serv_cat_id', 'DESC')
            ->limit(20)
            ->get();

        return view('hospital_pages.hospital_services')->with(compact('data'));
    }


    // saurabh
    public function hospital_services() {
        $get_data = DB::table('hospital_service_category')
            ->get();

        return view('hospitals')->with(compact('get_data'));
    }
    // saurabh

    public function HospitalServicesCategory($category_name)
    {
        $service_data = DB::table('hospital_service_category')
            ->orderBy('hospital_serv_cat_id', 'DESC')
            ->limit(20)
            ->get();
    
        return view('hospital_pages.hospital_services_category_data')->with(compact('service_data','category_name'));
    }

    public function CitySearch(Request $request){
        $query = $request->input('query');
        $cities = DB::table('city')
            ->select("city_name", "city_id")
            ->where('city_name', 'LIKE', "%{$query}%")
            ->get();
    
        $formattedCities = [];
        foreach ($cities as $city) {
            $formattedCities[] = $city->city_name . ' (' . $city->city_id . ')';
        }
    
        return response()->json($formattedCities);
}


    public function HospitalServiceCity(Request $request,$category_name)
    {
        // dd($request->all());
        $category_name = $request->input('hospital_serv_cat_name_sku');
        $city = $request->input('city');
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        $hospital_data = DB::select("
            SELECT
                hospital_lists.hospital_name,
                hospital_service_category.hospital_serv_cat_id,
                hospital_service_category.hospital_serv_cat_icon,
                hospital_service_category.hospital_serv_cat_name,
                hospital_available_service.hospital_available_serv_av_qt,
                hospital_available_service.hospital_available_serv_av_status,
                city.city_name,
                ROUND(
                    6371 * 2 * ASIN(
                        SQRT(
                            POWER(
                                SIN((? - hospital_lists.hospital_lat) * pi()/180 / 2),
                                2
                            ) + COS(? * pi()/180) * COS(hospital_lists.hospital_lat * pi()/180) * POWER(SIN((? - hospital_lists.hospital_long) * pi()/180 / 2), 2)
                        )
                    )
                ) as distance
            FROM hospital_available_service
            JOIN hospital_lists ON hospital_available_service.ha_hospital_id = hospital_lists.hospital_id
            JOIN hospital_service_category ON hospital_available_service.hospital_available_serv_cat_id = hospital_service_category.hospital_serv_cat_id
            LEFT JOIN city ON city.city_id = hospital_lists.hospital_city_name
            WHERE hospital_service_category.hospital_serv_cat_name_sku = ? AND city.city_name = ?
            ORDER BY distance
            LIMIT 20
        ", [$userLatitude, $userLatitude, $userLongitude, $category_name, $city]);

        $service_data = DB::table('hospital_service_category')
        ->orderBy('hospital_serv_cat_id', 'DESC')
        ->limit(20)
        ->get();
        // dd($hospital_data);

        // dd($hospital_data,$city,$service_data,$category_name);

        return view('hospital_pages.hospital_services_category_city', compact('hospital_data', 'service_data', 'category_name', 'city'));

    }
    




}