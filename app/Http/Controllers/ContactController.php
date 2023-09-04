<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Input;
use Validator;
use Session;
use Mail;

class ContactController extends Controller
{
    //
    public function contactUsView(){
        return view('contact_us');
    }
    public function contactUs(Request $request){
        $rules = [
                
            'first-name' => 'required|min:3',
            'last-name' => 'required|min:3',
            'mob_no' => 'required|max:10|min:10|unique:contact_us',
            'email' => 'required|unique:contact_us',
            'message' => 'required|min:10',
            ];
        $errors = [
            'first-name.required' => 'The first name  is required.',
            'first-name.min' => 'The first name must be at least 3 characters.',
            'last-name.required' => 'The last name  is required.',
            'last-name.min' => 'The last name must be at least 3 characters.',
            'mob_no.required' => 'The contact no  is required.',
            'mob_no.min' => 'The contact no must be 10 characters.',
            'mob_no.max' => 'The contact no must be 10 characters.',
            'mob_no.unique' => 'Already added,Please Enter another number!',
            'email.required' => 'The email is required.',
            'email.unique' => 'This email is already taken, Please Enter another email!',
            'message.min' => 'The message must be at least 10 characters.',
            
            ];
            // dd($request->all());
        
        $validator = Validator::make($request->all(), $rules, $errors);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $data['name']=$request->input('first-name')." ".$request->input('last-name');
            $data['toEmail']=$request->input('email');
           // $data = array('name'=>$name,'toEmail'=>$email);
            $sendMail=Mail::send('mail', $data, function($message) use ($data) {
                $message->to($data['toEmail'])->subject
                   ('Welcome To MedCab Care Pvt. Ltd.');
                $message->from('webdevelopermedcab@gmail.com','MedCab Care Pvt. Ltd');
             });
            if($sendMail){
                $save=DB::table('contact_us')->insert([
                    'first_name'=>$request->input('first-name'),
                    'last_name'=>$request->input('last-name'),
                    'email'=>$request->input('email'),
                    'mob_no'=>$request->input('mob_no'),
                    'message'=>$request->input('message'),
                ]);
                 if($save){
                    Session::flash('success_mess','Thank you for getting in touch! ');
                 }
                 else{
                    Session::flash('success_mess','Thank you for getting in touch! Failed to send mail');
                 }
                    
                return redirect()->back();
                
            }
            else{
                Session::flash('failed_mess','Something went wrong. Please try again!');
            return redirect()->back();

            }
        }  
        
    }
}
