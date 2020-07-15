<?php

use Illuminate\Support\Facades\Route;

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

//Backend
Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
	Route::get('/dashboard','DashboardController@index')->name('dashboard');
	Route::resource('category', 'CategoryController');
	Route::resource('brand', 'BrandController');
	Route::get('get_brands/{id}', 'CategoryController@getBrands')->name('get_brands');
	Route::resource('bike', 'BikeController');
});

Route::group(['prefix' => 'api_auth'], function()
{
    Route::get('index', 'Api\AuthController@index')->name('api_auth.index');
    Route::get('login', 'Api\AuthController@loginForm')->name('api_auth.login');
    Route::post('login', 'Api\AuthController@login')->name('api_auth.login');
    Route::get('signup', 'Api\AuthController@signupForm')->name('api_auth.signup');
    Route::post('signup', 'Api\AuthController@signup')->name('api_auth.signup');
});