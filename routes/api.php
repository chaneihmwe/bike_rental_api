<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'setup'], function()
{
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        Route::resource('category','Api\CategoryController');
    });

	Route::resource('brand','Api\BrandController');
    Route::resource('bike','Api\BikeController');
	Route::resource('bicycle','Api\BicycleController');
	Route::get('bike_by_category/{category_id}','Api\BikeController@getBikeByCategory');
	Route::resource('rent','Api\RentController');
	Route::resource('user','Api\UserController');
	Route::post('check_auth','Api\UserController@checkAuth')->name('check_auth');
});