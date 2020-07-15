<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function setting(Request $req){

        $setting = Setting::first();
        if($req->Session()->has('AdminStatus')){
            $id = $req->Session()->get('id');
            $data = User::find($id);
        }
        $site = Controller::logo();
        return view('settings', compact('setting'), compact('site'))->with('data',$data);
    }

    public function setting_change(Request $req)
    {

        $validator=Validator::make($req->all(),[
            'sitename' => 'required|max:30|min:3',
            'logo.*' => 'mimes:jpeg,png,jpg,gif,svg|required',
            'small_logo.*' => 'mimes:jpeg,png,jpg,gif,svg|required',
            'address' => 'required',
            'contact_number' => 'required',
            'primary_color' => 'required',
            'secondary_color' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('/setting')->withErrors($validator)->withInput();
        }

        $setting = Setting::find($req->id);
        if($req->hasFile('logo'))
        {
            //file move upload
            $file = $req->file('logo');
            $destinationPath = 'dist/img';
            $ext = explode(".",$file->getClientOriginalName());
            $filename = "AdminLTELogo.".$ext[1];
            $file->move($destinationPath,$filename);

            $setting->logo = $filename;
        }
        if($req->hasFile('small_logo'))
        {
            $file = $req->file('small_logo');
            $destinationPath = 'dist/img';
            $ext = explode(".",$file->getClientOriginalName());
            $filename = "AdminLTESmallLogo.".$ext[1];
            $file->move($destinationPath,$filename);

            $setting->small_logo = $filename;

        }
        $setting->sitename = $req->sitename;
        $setting->address = $req->address;
        $setting->contact_number = $req->contact_number;
        $setting->primary_color = $req->primary_color;
        $setting->secondary_color = $req->secondary_color;
        $setting->save();

        $cookie_name = "primary_color";
        $cookie_value = $req->primary_color;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $cookie_name = "secondary_color";
        $cookie_value = $req->secondary_color;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

        return redirect('/setting');
    }


}
