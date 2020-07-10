<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'Controller@welcome')->name('welcome');
Route::get('/register_user','UserController@register')->name('register-user');
Route::post('/register_user_db','UserController@register_db')->name('register-user-db');

Route::get('/forgot_password_form','Controller@forgot_password_form')->name('forgot-password-form');
Route::post('/emailcheck','Controller@emailcheck')->name('emailcheck');
Route::post('/emailcheckotp','Controller@emailcheckotp')->name('emailcheckotp');

Route::get('/user_login', 'Controller@admin_login_page')->name('user-login');
Route::post('/admin_check', 'Controller@admin_check')->name('check');


Route::group(['middleware' => 'AdminLogin'],function(){

	Route::get('/user_list', 'UserController@user_list')->name('user-list');
	Route::get('/delete_user/{id}','UserController@delete_user')->name("delete-user");
	Route::get('/edit_user_form/{id}','UserController@edit_user_form')->name("edit-user-form");
	Route::post('/user_update','UserController@user_update')->name('user-update');

	Route::get('/dashboard', 'Controller@dashboard')->name('dashboard');
	Route::get('/reset_password', 'Controller@reset_password')->name('reset-password');
	Route::post('/reset_pw', 'Controller@reset_pw')->name('reset-pw');
	Route::get('/logout', 'Controller@logout')->name('logout');

});

Auth::routes();
