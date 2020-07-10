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

    public function register_db(Request $req){

    	$users = new User();

    	$validator=Validator::make($req->all(),[
            'name' => 'required|max:30|min:3',
            'email' => 'required|email|unique:users,email',
            'Password' => 'required|confirmed|min:6',
        ]);

	     if($validator->fails())
	     {
	     	
	       return redirect('/register_user')->withErrors($validator)->withInput();
	     }
	     $users->name = $req->name;
	     $users->email = $req->email;
	     $users->role = 0;
	     $users->password = md5($req->Password);

	     $users->save();

	     return redirect('/user_login');


    }

    public function user_list(Request $req){
    	if($req->Session()->has('AdminStatus')){
    		$id = $req->Session()->get('id');
    		$data = User::find($id);
    	}
    	$users = User::all();

    	return view('user_list')->with('data',$data)->with('users',$users);
    }

    public function delete_user(Request $req){
    	$user = User::where('id',$req->id)->delete();
    	return redirect('/user_list');
    }

    public function edit_user_form(Request $req){
    	if($req->Session()->has('AdminStatus')){
    		$id = $req->Session()->get('id');
    		$data = User::find($id);
    	}
    	$users = User::find($req->id);

    	return view('user_edit_form')->with('data',$data)->with('users',$users);
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
