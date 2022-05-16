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
  
    Route::get('/donationCertificates', 'DonationCertificateController@index');
    Route::get('/ports', 'PortsController@index');
    Route::post('/ports/save', 'PortsController@store');
    Route::post('/checkDetFlaps/save', 'CheckDetFlapController@store');
    Route::put('/checkDetFlaps/update', 'CheckDetFlapController@update');
    Route::post('/checkDetFlaps/delete', 'CheckDetFlapController@destroy');
    Route::post('/zarpes/save', 'ZarpeController@store');
    Route::put('/zarpes/update', 'ZarpeController@update');
    Route::post('/zarpes/delete', 'ZarpeController@destroy');
    Route::post('/arrivals/save', 'ArrivalController@store');
    Route::put('/arrivals/update', 'ArrivalController@update');
    Route::post('/arrivals/delete', 'ArrivalController@destroy');
    Route::post('/checkDetInchs/save', 'CheckDetInchController@store');
    Route::put('/checkDetInchs/update', 'CheckDetInchController@update');
    Route::post('/checkDetInchs/delete', 'CheckDetInchController@destroy');
    Route::post('/presenVerifics/save', 'presenVerificController@store');
    Route::put('/presenVerifics/update', 'presenVerificController@update');
    Route::post('/presenVerifics/delete', 'presenVerificController@destroy');
    Route::post('/donationCertificates/save', 'DonationCertificateController@store');
    Route::put('/donationCertificates/update', 'DonationCertificateController@update');
    Route::post('/donationCertificates/delete', 'DonationCertificateController@destroy');
    Route::post('/confiscationCertificates/save', 'ConfiscationCertificateController@store');
    Route::put('/confiscationCertificates/update', 'ConfiscationCertificateController@update');
    Route::post('/confiscationCertificates/delete', 'ConfiscationCertificateController@destroy');
    Route::post('/inspectionBoatCargo/save', 'InspectionBoatCargoController@store');
    Route::put('/inspectionBoatCargo/update', 'InspectionBoatCargoController@update');
    Route::post('/inspectionBoatCargo/delete', 'InspectionBoatCargoController@destroy');
    Route::post('/certificationDisembTuna/save', 'CertificationDisembTunaController@store');
    Route::put('/certificationDisembTuna/update', 'CertificationDisembTunaController@update');
    Route::post('/certificationDisembTuna/delete', 'CertificationDisembTunaController@destroy');
    Route::post('/logout', 'UserController@logout');  
   
    Route::get('/zarpeJson', 'DataJsonController@jsonZarpe');
    Route::get('/ArrivalJson', 'DataJsonController@jsonArrival');
    Route::get('/detFlapJson', 'DataJsonController@jsonDetFlap');
    Route::get('/DetInchJson', 'DataJsonController@jsonDetInch');
    Route::get('/PresenVerificJson', 'DataJsonController@jsonEquipmentDolphin');
    Route::get('/ConfiscationJson', 'DataJsonController@jsonConfiscation');
    Route::get('/DonationJson', 'DataJsonController@jsonDonation');
    Route::get('/InspectionBoatCargoJson', 'DataJsonController@jsonInspectionBoatCargo');
    Route::get('/CertificationDisembTunaJson', 'DataJsonController@jsonCertificationDisembTuna');
});
Route::post('/user', 'UserController@login');
