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
    Route::get('/login','Auth\LoginController@showLoginForm');
   Route::post('/login', 'Auth\LoginController@login')->name('login');
   Route::get('/logout','Auth\LoginController@showLoginForm');
    // Route::get('/login', 'Auth\LoginController@login');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
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
        Route::get('/municipalities/selectMuni', 'MunicipalityController@selectMunicipality');
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
        Route::get('/docks/selectDocks', 'DockController@selectDocks');
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
        Route::get('/nationality/selectNationality', 'NationalityController@selectNationality');
        Route::get('/orops/selectOrops', 'OropController@selectOrop');
        Route::get('/zarpes/selectZoneAutoFisher', 'AutoFisherController@selectZoneAutoFisher');
        Route::get('/zarpes/selectFisheryAuthorized', 'FisheryAuthorizedController@selectFisheryAuthorized');
        Route::get('/zarpes/selectCompanies', 'CompanyController@selectCompanies');
        // arribo
        Route::get('/arrivals', 'ArrivalController@index');
        Route::post('/arrivals/save', 'ArrivalController@store');
        Route::put('/arrivals/update', 'ArrivalController@update');
        Route::post('/arrivals/delete', 'ArrivalController@destroy');
        Route::get('/arrivals/selectPorts', 'PortsController@selectPort');
        Route::get('/arrivals/selectFlags', 'FlagController@selectFlag');
        Route::get('/arrivals/selectRegion', 'RegionController@selectRegion');
        Route::get('/arrivals/selectNationality', 'NationalityController@selectNationality');
        Route::get('/arrivals/selectZoneAutoFisher', 'AutoFisherController@selectZoneAutoFisher');
        Route::get('/arrivals/selectFisheryAuthorized', 'FisheryAuthorizedController@selectFisheryAuthorized');
        Route::get('/arrivals/selectCompanies', 'CompanyController@selectCompanies');
        //verificación 71
        Route::get('/checkDetInchs', 'CheckDetInchController@index');
        Route::post('/checkDetInchs/save', 'CheckDetInchController@store');
        Route::put('/checkDetInchs/update', 'CheckDetInchController@update');
        Route::post('/checkDetInchs/delete', 'CheckDetInchController@destroy');
        Route::get('/checkDetInchs/selectCompanies', 'CompanyController@selectCompanies');
        Route::get('/checkDetInchs/selectRegional', 'RegionalController@selectRegional');
        //verificacion DET doble solapa
        Route::get('/checkDetFlaps', 'CheckDetFlapController@index');
        Route::post('/checkDetFlaps/save', 'CheckDetFlapController@store');
        Route::put('/checkDetFlaps/update', 'CheckDetFlapController@update');
        Route::post('/checkDetFlaps/delete', 'CheckDetFlapController@destroy');
        Route::get('/checkDetFlaps/selectCompanies', 'CompanyController@selectCompanies');
        Route::get('/checkDetFlaps/selectRegional', 'RegionalController@selectRegional');
        //verificacion presencia equipo de rescate
        Route::get('/presenVerifics', 'presenVerificController@index');
        Route::post('/presenVerifics/save', 'presenVerificController@store');
        Route::put('/presenVerifics/update', 'presenVerificController@update');
        Route::post('/presenVerifics/delete', 'presenVerificController@destroy');
        Route::get('/flags/selectFlags', 'FlagController@selectFlag');
        //pais
        Route::get('/nationality', 'NationalityController@index');
        Route::post('/nationality/save', 'NationalityController@store');
        Route::put('/nationality/update', 'NationalityController@update');
        Route::post('/nationality/delete', 'NationalityController@destroy');
        // empresa
        Route::get('/companies', 'CompanyController@index');
        Route::post('/companies/save', 'CompanyController@store');
        Route::put('/companies/update', 'CompanyController@update');
        Route::post('/companies/delete', 'CompanyController@destroy');
        // regional
        // Route::get('/regionals', 'RegionalController@index');
        // Route::post('/regionals/save', 'RegionalController@store');
        // Route::put('/regionals/update', 'RegionalController@update');
        // Route::post('/regionals/delete', 'RegionalController@destroy');
        // acta de donacion 
        Route::get('/donationCertificates', 'DonationCertificateController@index');
        Route::post('/donationCertificates/save', 'DonationCertificateController@store');
        Route::put('/donationCertificates/update', 'DonationCertificateController@update');
        Route::post('/donationCertificates/delete', 'DonationCertificateController@destroy');
        Route::get('/donationCertificates/selectRegional', 'RegionalController@selectRegional');
        // acta de decomiso
        Route::get('/confiscationCertificates', 'ConfiscationCertificateController@index');
        Route::post('/confiscationCertificates/save', 'ConfiscationCertificateController@store');
        Route::put('/confiscationCertificates/update', 'ConfiscationCertificateController@update');
        Route::post('/confiscationCertificates/delete', 'ConfiscationCertificateController@destroy');
        Route::get('/confiscationCertificates/selectRegional', 'RegionalController@selectRegional'); 
        // iNSPECCION EMBARCACION  DE CARGA
        Route::get('/inspectionBoatCargo', 'InspectionBoatCargoController@index');
        Route::post('/inspectionBoatCargo/save', 'InspectionBoatCargoController@store');
        Route::put('/inspectionBoatCargo/update', 'InspectionBoatCargoController@update');
        Route::post('/inspectionBoatCargo/delete', 'InspectionBoatCargoController@destroy');
        Route::get('/inspectionBoatCargo/selectPorts', 'PortsController@selectPort');
        Route::get('/inspectionBoatCargo/selectFlags', 'FlagController@selectFlag');
        // CERTIFICACIÓN DESEMBARQUE DE ATÚN PARA EXPORTACIÓN 
        Route::get('/certificationDisembTuna', 'CertificationDisembTunaController@index');
        Route::post('/certificationDisembTuna/save', 'CertificationDisembTunaController@store');
        Route::put('/certificationDisembTuna/update', 'CertificationDisembTunaController@update');
        Route::post('/certificationDisembTuna/delete', 'CertificationDisembTunaController@destroy');
        Route::get('/certificationDisembTuna/selectPorts', 'PortsController@selectPort');
        Route::get('/certificationDisembTuna/selectFlags', 'FlagController@selectFlag');
        Route::get('/certificationDisembTuna/selectCompanies', 'CompanyController@selectCompanies');
        // FORMATO DE AVISO PREVIO DE ZARPE DE BUQUE
        Route::get('/noticePreviousZarpe', 'NoticePreviousZarpeController@index');
        Route::post('/noticePreviousZarpe/save', 'NoticePreviousZarpeController@store');
        Route::put('/noticePreviousZarpe/update', 'NoticePreviousZarpeController@update');
        Route::post('/noticePreviousZarpe/delete', 'NoticePreviousZarpeController@destroy');
        Route::get('/noticePreviousZarpe/selectPorts', 'PortsController@selectPort');
        Route::get('/noticePreviousZarpe/selectNationality', 'NationalityController@selectNationality');
        Route::get('/noticePreviousZarpe/selectDocks', 'DockController@selectDocks');
        // FORMATO REPORTE PLANTA PROCESO
        Route::get('/processingPlant', 'ProcessingPlantController@index');
        Route::post('/processingPlant/save', 'ProcessingPlantController@store');
        Route::put('/processingPlant/update', 'ProcessingPlantController@update');
        Route::post('/processingPlant/delete', 'ProcessingPlantController@destroy');
        Route::get('/processingPlant/selectPorts', 'PortsController@selectPort');
        Route::get('/processingPlant/selectDocks', 'DockController@selectDocks');
        // DATAjSON
        Route::get('/zarpeJson', 'DataJsonController@jsonZarpe');
        Route::get('/ArrivalJson', 'DataJsonController@jsonArrival');
        Route::get('/detFlapJson', 'DataJsonController@jsonDetFlap');
        Route::get('/DetInchJson', 'DataJsonController@jsonDetInch');
        Route::get('/PresenVerificJson', 'DataJsonController@jsonEquipmentDolphin');
        Route::get('/ConfiscationJson', 'DataJsonController@jsonConfiscation');
        Route::get('/DonationJson', 'DataJsonController@jsonDonation');
        Route::get('/InspectionBoatCargoJson', 'DataJsonController@jsonInspectionBoatCargo');
        Route::get('/CertificationDisembTunaJson', 'DataJsonController@jsonCertificationDisembTuna');
        //MATERIAL ARTE DE PESCA
        Route::get('/materials', 'FishingGearMaterialController@index');
        Route::post('/materials/save', 'FishingGearMaterialController@store');
        Route::put('/materials/update', 'FishingGearMaterialController@update');
        Route::post('/materials/delete', 'FishingGearMaterialController@destroy');
        //PROFILES
        Route::get('/profiles', 'ProfileController@index');


       
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
if (App::environment('production')) {
    URL::forceScheme('https');
}