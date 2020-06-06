<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('design', 'DesignController');
// socialite login routes
Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');


Route::get('/make/{role}','AllUsersRegisterController@RegistrationForm')
->where('role','admin|user|designer|company')->name('registeration.form');
Route::post('/make/user','AllUsersRegisterController@register')->name('user.registeration');
Route::post('/make/admin','AllUsersRegisterController@register')->middleware('check-role:admin')->name('admin.registeration');
Route::post('/make/company','AllUsersRegisterController@register')->name('company.registeration');
Route::post('/make/designer','AllUsersRegisterController@register')->name('designer.registeration');

Route::get('/403', function () {
    return view('auth.403');
});
// Routes for both tags and material resources
Route::resource('admin/tag', 'TagController');
Route::resource('admin/material', 'MaterialController');

