<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '/v1'], function ($router) {
	Route::apiResource('locations', 'LocationController');
	Route::apiResource('categories', 'CategoryController');
	Route::apiResource('recreations', 'RecreationController')->except('location', 'category');
	Route::apiResource('reviews', 'ReviewController')->except('index');
	Route::get('locations/{location}/recreations', 'RecreationController@by_location')->name('recreations.location');
	Route::get('categories/{category}/recreations', 'RecreationController@by_category')->name('recreations.category');
	Route::get('recreations/{recreation}/reviews', 'ReviewController@index')->name('reviews.index');
});