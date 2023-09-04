<?php


namespace App\Http\Controllers\app_data\consumer_app;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\driver;
use Illuminate\Support\Facades\DB; 
use Input;
use Session;

class ConsumerLanguageController extends Controller
{
    public function language_list(){
        // $authkey=$request->input('auth_keys');
        // echo 'sdsdsdsdsdssddsdsds   :'.$authkey; exit();
        $status = '0';
        $data=DB::table('languages')->where('language_status',$status)->get();
        if(count($data)>0){
            return response()->json([
                'result'=>'S',
                'status'=>'0',
                'Message'=>"Consumer Language List.",
                "JSONData"=>$data
            ]);
        }
        else{
            return response()->json([
                'result'=>'S',
                'status'=>'1',
                'Message'=>"No Language List found.",
                "JSONData"=>""
            ]);
        
        }

    }

    public function get_pages_lists(Request $request){
        $bucket = [];
        $page_sku=$request->input('page_sku');
        $language_id=$request->input('language_id');
        $data=DB::select("SELECT * FROM `language_consumer_page`  ");

        // print_r($data); exit();
        if(count($data)>0){

            foreach ($data as $key) {
                $data_list['page_id'] = $key->language_consumer_page_id;
                $data_list['page_name_sku'] = $key->language_consumer_page_name_sku;
                $data_list['page_name_txt'] = $key->language_consumer_page_name_txt;
                array_push($bucket, $data_list);
            }
            
            return response()->json([
                'result'=>'S',
                'status'=>'0',
                'Message'=>"Page List data",
                "JSONData"=>$bucket
            ]);
        }
        else{
            return response()->json([
                'result'=>'S',
                'status'=>'1',
                'Message'=>"No Page List Found",
                "JSONData"=>$bucket
            ]);
        
        }

    }


    public function get_page_text(Request $request){
        $bucket = [];
        $page_sku=$request->input('page_sku');
        $language_id=$request->input('language_id');
        $data=DB::select("SELECT * FROM `language_consumer_page` 
        JOIN language_consumer_data ON language_consumer_data.language_consumer_page_id=language_consumer_page.language_consumer_page_id 
        WHERE language_consumer_page.language_consumer_page_name_sku LIKE '$page_sku' 
        AND language_consumer_data.language_consumer_lang_id='$language_id' 
        ORDER BY `language_consumer_data`.`language_consumer_sr_no`+0 ASC");
        if(count($data)>0){

            foreach ($data as $key) {
                $data_list['page_sku'] = $key->language_consumer_page_name_sku;
                $data_list['page_name'] = $key->language_consumer_page_name_txt;
                $data_list['text_sr_no'] = $key->language_consumer_sr_no;
                $data_list['text_in_english'] = $key->language_consumer_text_english;
                $data_list['text_in_selected_lang'] = $key->language_consumer_text;
                array_push($bucket, $data_list);
            }
            
            return response()->json([
                'result'=>'S',
                'status'=>'0',
                'Message'=>"Page Text data",
                "JSONData"=>$bucket
            ]);
        }
        else{
            return response()->json([
                'result'=>'S',
                'status'=>'1',
                'Message'=>"No Page Text Found",
                "JSONData"=>$bucket
            ]);
        
        }

    }

     
}