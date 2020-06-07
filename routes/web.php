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

Route::get('/', 'IndexController@index')->name('website.index');

// payement
// Route::get('/checkout', 'IndexController@checkout')->name('website.checkout');

// cart routes
Route::get('/cart', 'CartController@cart')->name('website.cart');
Route::post('add-to-cart', 'CartController@addToCart')->name('add-to-cart');
Route::post('remove-from-cart', 'CartController@removeFromCart')->name('remove-from-cart');
Route::get('load-cart-data', 'CartController@loadCartData')->name('load-cart');
Route::get('empty-cart', 'CartController@emptyCart')->name('empty-cart');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('design', 'DesignController');
// socialite login routes
Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');


Route::get('/register/{role}','AllUsersRegisterController@RegistrationForm')
->where('role','admin|user|designer|company')->name('registeration.form');
Route::post('/register/user','AllUsersRegisterController@register')->name('user.registeration');
Route::post('/register/admin','AllUsersRegisterController@register')->middleware('check-role:admin')->name('admin.registeration');
Route::post('/register/company','AllUsersRegisterController@register')->name('company.registeration');
Route::post('/register/designer','AllUsersRegisterController@register')->name('designer.registeration');
Route::get('company/{user}/shop','CompanyController@shop')->name('company.shop');
Route::resource('company', 'CompanyController')->except([
    'create', 'store','update','edit'
]);
Route::resource('user','AllUsersUpdateController')->only([
    'update','edit'
]);

Route::get('/403', function () {
    return view('auth.403');
});


// Routes for both tags and material resources
Route::resource('admin/tag', 'TagController');
Route::resource('admin/material', 'MaterialController');

