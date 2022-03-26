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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    // Route::get('/login', 'Auth\LoginController@login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');




    Route::group(['middleware' => ['Administrador']], function () {
        
        // region
        Route::get('/region', 'RegionController@index');
        Route::post('/region/save', 'RegionController@store');
        Route::put('/region/update', 'RegionController@update');
        Route::post('/region/delete', 'RegionController@destroy');
        //municipios
        Route::get('/municipalities', 'MunicipalityController@index');
        Route::post('/municipalities/save', 'MunicipalityController@store');
        Route::put('/municipalities/update', 'MunicipalityController@update');
        Route::post('/municipalities/delete', 'MunicipalityController@destroy');
        Route::get('/region/selectRegion', 'RegionController@selectRegion');
        //puertos
        Route::get('/ports', 'PortsController@index');
        Route::post('/ports/save', 'PortsController@store');
        Route::put('/ports/update', 'PortsController@update');
        Route::post('/ports/delete', 'PortsController@destroy');
        //zonas autorizadas
        Route::get('/autoFishers', 'AutoFisherController@index');
        Route::post('/autoFishers/save', 'AutoFisherController@store');
        Route::put('/autoFishers/update', 'AutoFisherController@update');
        Route::post('/autoFishers/delete', 'AutoFisherController@destroy');
        Route::put('/autoFishers/desactivar', 'AutoFisherController@desactivar');
        Route::put('/autoFishers/activar', 'AutoFisherController@activar');
        //bandera
        Route::get('/flags', 'FlagController@index');
        Route::post('/flags/save', 'FlagController@store');
        Route::put('/flags/update', 'FlagController@update');
        Route::post('/flags/delete', 'FlagController@destroy');
        //muelles
        Route::get('/docks', 'DockController@index');
        Route::post('/docks/save', 'DockController@store');
        Route::put('/docks/update', 'DockController@update');
        Route::post('/docks/delete', 'DockController@destroy');
        Route::get('/ports/selectPorts', 'PortsController@selectPort');
        //zarpe
        Route::get('/zarpes', 'ZarpeController@index');
        Route::post('/zarpes/save', 'ZarpeController@store');
        Route::put('/zarpes/update', 'ZarpeController@update');
        Route::post('/zarpes/delete', 'ZarpeController@destroy');
        Route::get('/zarpes/selectPorts', 'PortsController@selectPort');
        Route::get('/flags/selectFlags', 'FlagController@selectFlag');
        Route::get('/region/selectRegion', 'RegionController@selectRegion');
        //verificación 71
        Route::get('/checkDetInch', 'CheckDetInchController@index');
        Route::post('/checkDetInch/save', 'CheckDetInchController@store');
        Route::put('/checkDetInch/update', 'CheckDetInchController@update');
        Route::post('/checkDetInch/delete', 'CheckDetInchController@destroy');


       
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
