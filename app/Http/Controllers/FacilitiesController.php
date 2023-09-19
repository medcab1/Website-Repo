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

class FacilitiesController extends Controller
{
  public function GetHospitalAvailableData(){
    $get_hospital_data = db::table('hospital_service_category')
    ->get();

    return view('include.hospital_availability_main',compact('get_hospital_data'));
  }

  public function AmbulanceData(Request $request)
  {
      $categoryId = $request->input('categoryId');
  
      // Query the database based on the $categoryId
      $ambulanceData = DB::table('ambulance_category')
          ->leftJoin('ambulance_facilities', 'ambulance_facilities.ambulance_facilities_category_type', '=', 'ambulance_category.ambulance_category_type')
          ->where('ambulance_category.ambulance_category_name', '=', $categoryId)
          ->get();
  
      // Initialize arrays to store category and emergency kit data
      $categoryData = [];
      $emergencyKits = [];
  
      foreach ($ambulanceData as $value) {
          // Extract category data (assuming it's the same for all rows)
          $categoryData = [
              'category_name' => $value->ambulance_category_name,
              'category_image' => $value->ambulance_category_icon,
              'category_desc' => $value->ambulance_catagory_desc ?? '',
          ];
  
          // Extract emergency kit data for each row and store it in an array
          $emergencyKit = [
              'emergency_kit' => $value->ambulance_facilities_name,
              'emergency_kit_image' => $value->ambulance_facilities_image,
          ];
  
          // Add the emergency kit data to the array of emergency kits
          $emergencyKits[] = $emergencyKit;
      }
  
      // Create an array to hold the final response data
      $responseData = [
          'category_data' => $categoryData,
          'emergency_kits' => $emergencyKits,
      ];
  
      // Return the response data as a JSON response
      return response()->json($responseData);
  }
  
  
}
