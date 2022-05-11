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

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:api'], function (){
    Route::get('/zarpeJson', 'DataJsonController@jsonZarpe');
    Route::get('/donationCertificates', 'DonationCertificateController@index');
    Route::get('/ports', 'PortsController@index');
    Route::post('/ports/save', 'PortsController@store');
    Route::post('/checkDetFlaps/save', 'CheckDetFlapController@store');
    Route::put('/checkDetFlaps/update', 'CheckDetFlapController@update');
    Route::post('/checkDetFlaps/delete', 'CheckDetFlapController@destroy');
    Route::post('/logout', 'UserController@logout');  
});
Route::post('/user', 'UserController@login');
