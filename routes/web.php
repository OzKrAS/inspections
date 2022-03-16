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
       

    });

});

//Route::get('/home', 'HomeController@index')->name('home');
