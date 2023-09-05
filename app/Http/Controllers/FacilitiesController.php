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
}
