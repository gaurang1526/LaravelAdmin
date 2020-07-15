<?php

namespace App\Http\Controllers;


use App\User;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Mail;
use Illuminate\Support\MessageBag;	

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function logo(){
        $setting = Setting::select()->first();
        $logo['sitename'] = $setting->sitename;
        $logo['logo'] = $setting->logo;
        $logo['small_logo'] = $setting->small_logo;
        return $logo;
    }

    public function welcome(){
    	return view('welcome');
    }

    public function dashboard(Request $req){
    	if($req->Session()->has('AdminStatus')){
    		$id = $req->Session()->get('id');
    		$data = User::find($id);
    	}
        $site = Controller::logo();
    	return view('dashboard',compact('site'))->with('data',$data);
    }

    public function admin_login_page(){
    	return view('admin_login');
    }

    public function admin_check(Request $req){

    	$validator=Validator::make($req->all(),[
            'email' => 'required|',
            'password' => 'required|',
        ]);

         if($validator->fails())
         { 
           return redirect('/user_login')->withErrors($validator)->withInput();
         }

        $username =  $req->email;
    	$password =  $req->password;

 
    	$data = User::where('email' , $username)->where('password' , md5($password))->first();
    	if($data != '')
	    {
	      	$req->Session()->put('id',$data->id);
	        $req->Session()->put('AdminStatus',true);
	        if($req->remember){
                //Username Password Cookie
		        $cookie_name = "email";
				$cookie_value = $username;
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
				$cookie_name = "password";
				$cookie_value = $password;
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	      	}
            //Layout Cookie
            $setting = Setting::select()->first();
            $cookie_name = "primary_color";
            $cookie_value = $setting->primary_color;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            $cookie_name = "secondary_color";
            $cookie_value = $setting->secondary_color;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

	        return redirect('/dashboard');
	    }
	    else {
            
	        return redirect("/user_login")->with("error","Please Enter Correct Username And Password");
	    }

    }

    public function logout(Request $req){
        //destroy layout cookie
        setcookie('primary_color','', time() - 3600);
        setcookie('secondary_color','', time() - 3600);
        
    	if($req->Session()->has('AdminStatus')){
    		$req->Session()->forget('AdminStatus');
    		$req->Session()->forget('id');
    		return redirect("/user_login");
    	}
    }


    public function reset_password(Request $req){
    	if($req->Session()->has('AdminStatus')){
    		$id = $req->Session()->get('id');
    		$data = User::find($id);
    	}
        $site = Controller::logo();
    	return view('reset_pasword',compact('site'))->with('data',$data);
    }

    public function reset_pw(Request $req){

    	$validator=Validator::make($req->all(),[
            'Password' => 'required|confirmed|min:6',
        ]);

	     if($validator->fails())
	     {
	     	
	       return redirect('/reset_password')->withErrors($validator)->withInput();
	     }
    	$users = User::find($req->id);
    	$users->password = md5($req->Password);
    	$users->save();
	    return redirect('/dashboard');
    }

    public function forgot_password_form(){
    	return view('forgot_password_form');
    }

    public function emailcheck(Request $req){

    	$errors = new MessageBag();
	    // add your error messages:

    	$users = new User();

        $validator=Validator::make($req->all(),[
            'email' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('/forgot_password_form')->withErrors($validator)->withInput();
        }
        $data = User::select()->where('email',$req->email)->first();
        if($data!=''){


	        if($req->email == $data->email)
	        {
	            $n=4; 
	            function getName($n) { 
	                $characters = '0123456789'; 
	                $randomString = ''; 
	  
	                for ($i = 0; $i < $n; $i++) { 
	                    $index = rand(0, strlen($characters) - 1); 
	                    $randomString .= $characters[$index]; 
	                } 
	              
	                return $randomString; 
	            } 

	            $str =  getName($n); 
	            $req->Session()->put('otp',$str);
	            $req->Session()->put('email',$req->email);

	            $to_name = $data->name;
		        $to_email = $data->email;
		        $body = "Your OTP for password reset is : ";
		        $data = array("OTP" => $str);
		       
		        Mail::send('otpmail', $data, function($message) use ($to_name, $to_email) {
		            $message->to($to_email, $to_name)
		                    ->subject('Forgot Password Mail');
		            
		        });

		       //return true;
	            return view('new_password_form'); 
	        }
	    }
	    else{
	    	$errors->add('wrong', 'You entered Wrong Email');
        	return redirect('/user_login')->withErrors($errors);  
	    }

    }

    public function emailcheckotp(Request $req){

    	$errors = new MessageBag();
    	$message = new MessageBag();
	    // add your error messages:
	    
	    $message->add('success','Your password is successfully changed!');

    	$validator=Validator::make($req->all(),[
            'Password' => 'required|confirmed|min:6',
            'otp' => 'required|min:4'
        ]);

        if($validator->fails())
        {
        	$errors->add('wrong', 'You entered Wrong OTP or Password Dosent Matched Try Again!');
        	$req->Session()->forget('otp');
            return redirect('/user_login')->withErrors($errors)->withInput(); 
        }
        $otp = $req->Session()->get('otp');

        if($otp != $req->otp){
        	$req->Session()->forget('otp');
            return redirect('/user_login')->withErrors($errors); 

        }
        else{
            $email = $req->Session()->get('email');
            $user = User::select()->where('email',$email)->first();
            $user->password = md5($req->Password);
            $user->save();
            return redirect('/user_login')->withErrors($message); 

        }

    }

    
    
}
