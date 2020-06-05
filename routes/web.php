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


// socialite login routes
Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');


Route::get('/designer/create','DesignerController@showRegistrationForm')->name('designer.create');
Route::get('/user/create','UserController@showRegistrationForm')->name('user.create');
Route::get('/company/create','CompanyController@showRegistrationForm')->name('company.create');
Route::get('/admin/create','AdminController@showRegistrationForm')->name('admin.create');
Route::post('/designer/register','DesignerController@register')->name('designer.register');
Route::post('/user/register','UserController@register')->name('user.register');
Route::post('/company/register','CompanyController@register')->name('company.register');
Route::post('/admin/register','AdminController@register')->name('admin.register');
Route::get('/403', function () {
    return view('auth.403');
});
// Routes for both tags and material resources
Route::resource('admin/tag', 'TagController');
Route::resource('admin/material', 'MaterialController');
