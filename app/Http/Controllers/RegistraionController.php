<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use App\Models\team;
use Validator;
use Input;
use Session;

class RegistraionController extends Controller
{
    public function login_varification(Request $req){
        $mob= $req->phone;
        // $ambu_type=$req->ambu_type;
        // $ambu_price=$req->ambu_price;
        session::put('selAmbuData',$req->all());
       
        $rule  =  array(
            'phone'       => 'required|min:10|max:10',
            ) ;
           
            $validator = Validator::make($req->all(),$rule);
            if ($validator->fails())
            {
                $messages = $validator->messages();
                return response()->json(['requestdata'=>$req->all(),'res'=>$messages]);
                // return redirect()->back()->withErrors($validator)->withInput();

            }
            else
            {
                $otp=random_int(100000,999999);
                $res= $this->resend_otp($req,$mob,$otp);
                $selAmbuData=["ambu_type"=>$ambu_type,
                "ambu_price"=>$ambu_price];
                session::put('selAmbuData',$selAmbuData);
                session::put(['OTP'=>$otp,"consumer_mob"=>$mob]);
                $consumer = DB::table('consumer')->where("consumer_mobile_no",$mob)->get();
                if($consumer->count())
                {
                    $data = [
                        'success' => true,
                        'message'=> 'logged In',
                        'code'=>'0',
                        'otp'=>$otp,
                        'name'=>$consumer[0]->consumer_name,
                        'res'=>$res,
                    ]; 
                }
                else{
                    $data = [
                        'success' => false,
                        'message'=> 'You are not registered with this number.Please Register First!',
                        'code'=>'1'
                    ];
                }
                return response()->json($data);    

            }
    }

    public function otp_match(Request $req){
        $otp=$req->input('otp');
        if($otp==session('OTP')){
            $mob=session()->get('consumer_mob');
            $consumer = DB::table('consumer')->where("consumer_mobile_no",$mob)->get();
            $value=Session::put([
            "consumer_id"=>$consumer[0]->consumer_id,
            "consumer_name"=>$consumer[0]->consumer_name]);
            $message="You have logged In Successfully.";
            $status=0;
        }
        else{
            $message="Wrong Credentials!";
            $status=1;
            
        }
        return response()->json(
            ["message"=>$message, 
            "data"=>$otp,
            'session-otp'=>session('OTP'),
            'status'=>$status,
        ]);
        
    }
// Resend OTP
    public function resend_otp(Request $request,$MOB,$OTP=null){
        
        if($OTP=="" || $MOB==""){
            $mob=$request->input('mob');
            $otp=random_int(100000,999999);
        }
        else{
            $otp=$OTP;
            $mob=$MOB;
        }
        Session::put('OTP',$otp);
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://control.msg91.com/api/v5/otp?template_id=643fde80d6fc0517dc4feab2&mobile=91'.$mob.'&otp='.$otp.'&authkey=394219AXMGKO4O52Jt642fe133P1',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: PHPSESSID=88cmviqh9qcc0tcjlmg0qifka6'
                ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $response;
                $saveOTP=DB::table('verification_otp')->insert([
                    'vfn_source'=>'WEBSITE',
                    'vfn_consumer_mob_no'=>''.$mob,
                    'vfn_otp'=>''.$otp,
                    'vfn_timestamp'=>time(),
                    
                ]);
                return response()->json(['status'=>0,'otp'=>$otp,'mob'=>$mob,]);
    }
    public function register_consumer(Request $request){
        $rules = [
			'name' => 'required|string|min:3|max:255',	
		];
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails())
        {
			$json=[
                'status'=>'200',
                'message'=>"Invalid Input data"
            ];
            return response()->json($json);
		}
		else{
            $data = $request->input();
            $name=$request->input('name');
            // $ambu_type=$request->ambu_type;
            // $ambu_price=$request->ambu_price;
            // session()->put("consumer_name",$name);
            // session()->put("ambu_type",$ambu_type);
            // Session::put('ambu_price',$ambu_price);
			try{
                $date = date('Y-m-d H:i:s');
               $lastid= DB::table('consumer')->insertGetId([
                    'consumer_name' => $name,
                    'consumer_mobile_no' => session('consumer_mob'),
                    'consumer_auth_key'=>$request->ip(),
                    'consumer_email_id'=>strtolower( str_replace(' ', '', $name))."@gmail.com",
                    'consumer_registred_date'=>time(),
                ]);
                // $lastid= DB::table('consumer')->orderBy('consumer_id', 'desc')->take(1)->first();
                // session::put('consumer_id', $lastid->consumer_id);
                // session::put('consumer_id', $lastid);
                $response=[
                    'success'=>"Inserted Successfully",
                    'status'=>0,
                    'otp'=>random_int(100000,999999),
                    'message'=>"You have register successfully",
                    'consumer_name'=>$name,
                    'consumer_auth_key'=>$request->ip(),    
                ];
                return Response()->json($response);
            }
			catch(Exception $e){
                return Response()->json(['message'=>"operation failed".$e,'status'=>1]);
			}
		}
    }


    public function save_ambu_detail(Request $request){
        session::put(['ambu_type'=>$request->input('ambu_type'),'ambu_price'=>$request->input('ambu_price'),'selAmbuData'=>$request->all()]);
        return response()->json($request->all());
    }

    public function booking_login(Request $req){
        $mob= $req->phone; 
        $rule  =  array(
            'phone'       => 'required|min:10|max:10',
            ) ;
           
            $validator = Validator::make($req->all(),$rule);
            if ($validator->fails())
            {
                $messages = $validator->messages();
                return response()->json(['requestdata'=>$req->all(),'res'=>$messages]);

            }
            else
            {
                $otp=random_int(100000,999999);
               $res= $this->resend_otp($req,$mob,$otp);
                session::put(['OTP'=>$otp,"consumer_mob"=>$mob]);
                $consumer = DB::table('consumer')->where("consumer_mobile_no",$mob)->get();
                if($consumer->count())
                {
                    $data = [
                        'success' => true,
                        'message'=> 'logged In',
                        'code'=>'0',
                        'otp'=>$otp,
                        'name'=>$consumer[0]->consumer_name,
                        'number'=>$consumer->count(),
                        'data'=>$consumer[0],
                        'res'=>$res,
                    ]; 
                        return response()->json($data);    
                    }
                else{
                    $data = [
                        'success' => false,
                        'message'=> 'You are not registered with this number.Please Register First!',
                        'code'=>'1'
                    ];
                    return response()->json($data);    
                }
            }
    }
    public function booking_register(Request $request){
        $rules = [
			'name' => 'required|string|min:3|max:255',	
		];
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails())
        {
			$json=[
                'status'=>'200',
                'message'=>"Invalid Input data"
            ];
            return response()->json($json);
		}
		else{
            $data = $request->input();
            $name=$request->input('name');
            // session()->put("consumer_name",$name);
			try{
                $date = date('Y-m-d H:i:s');
               $lastid= DB::table('consumer')->insertGetId([
                    'consumer_name' => $name,
                    'consumer_mobile_no' => session('consumer_mob'),
                    'consumer_auth_key'=>$request->ip(),
                    'consumer_email_id'=>strtolower( str_replace(' ', '', $name))."@gmail.com",
                    'consumer_registred_date'=>time(),
                ]);
                session::put('consumer_id', $lastid);
                $response=[
                    'success'=>"Inserted Successfully",
                    'status'=>0,
                    'otp'=>random_int(100000,999999),
                    'message'=>"You have register successfully",
                    'consumer_name'=>$name,
                ];
                return Response()->json($response);
            }
			catch(Exception $e){
                return Response()->json(['message'=>"operation failed".$e,'status'=>1]);
			}
		}
    }
}

