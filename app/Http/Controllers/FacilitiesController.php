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
     // Query the database based on the $category_id
     $ambulanceData = DB::table('ambulance_category')
     ->leftJoin('ambulance_facilities', 'ambulance_facilities.ambulance_facilities_category_type', '=', 'ambulance_category.ambulance_category_type')
     ->where('ambulance_category.ambulance_category_name', '=', $categoryId) // Replace 'some_column_name' with the actual column to filter by
     ->get(); //0. Corrected 'first()' method
     
     if(count($ambulanceData)>0){
      
     }

 // Return the ambulance data as a JSON response
  return response()->json($ambulanceData);
    
  }
}





