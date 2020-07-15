<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Mail;
use Illuminate\Support\MessageBag;	

class UserController extends Controller
{
    public function register(){
    	return view('register');
    }

    public function add_user(Request $req){
        if($req->Session()->has('AdminStatus')){
            $id = $req->Session()->get('id');
            $data = User::find($id);
        }
        $site = Controller::logo();
        return view('add_user',compact('site'))->with('data',$data);
    }

    public function register_db(Request $req){

    	$users = new User();

    	$validator=Validator::make($req->all(),[
            'name' => 'required|max:30|min:3',
            'email' => 'required|email|unique:users,email',
            'Password' => 'required|confirmed|min:6',
        ]);

	     if($validator->fails())
	     {
	     	if($req->Session()->has('AdminStatus')){
                return redirect('/add_user')->withErrors($validator)->withInput();
            }
             return redirect('/register_user')->withErrors($validator)->withInput();
	     }
	     $users->name = $req->name;
	     $users->email = $req->email;
	     if($req->Session()->has('AdminStatus')){
            $users->role = $req->role;
         }else{
             $users->role = 0;
         }

	     $users->password = md5($req->Password);

	     $users->save();
         if($req->Session()->has('AdminStatus')){
            return redirect('/user_list');
         }else{
             return redirect('/user_login');
         }
	     


    }

    public function user_list(Request $req){
    	if($req->Session()->has('AdminStatus')){
    		$id = $req->Session()->get('id');
    		$data = User::find($id);
    	}
    	$users = User::all();
        $site = Controller::logo();
    	return view('user_list',compact('site'))->with('data',$data)->with('users',$users);
    }

    public function delete_user(Request $req){
        if($req->Session()->has('AdminStatus')){
            if($req->Session()->get('id') == $req->id){
                $user = User::where('id',$req->id)->delete();
                $req->Session()->forget('AdminStatus');
                $req->Session()->forget('id');
                return redirect("/user_login");
            }
        }
    	$user = User::where('id',$req->id)->delete();
    	return redirect('/user_list');
    }

    public function edit_user_form(Request $req){
    	if($req->Session()->has('AdminStatus')){
    		$id = $req->Session()->get('id');
    		$data = User::find($id);
    	}
    	$users = User::find($req->id);
        $site = Controller::logo();
    	return view('user_edit_form',compact('site'))->with('data',$data)->with('users',$users);
    }

    public function user_update(Request $req){
    	$user = User::find($req->id);
    	$data = new User();

    	$validator=Validator::make($req->all(),[
            'name' => 'required|max:30|min:3',
            'email' => 'required|email',
        ]);

	     if($validator->fails())
	     {
	       return redirect('/edit_user_form/'.$req->id)->withErrors($validator)->withInput();
	     }

	     $user->name = $req->name;
	     $user->role = $req->role;
	     $user->email = $req->email;
	     $user->save();
	     return redirect('/user_list');

    }
}
