<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrivals', function (Blueprint $table) {
            $table->increments('id');       
            $table->string('insNo'); 
            $table->string('radioCall'); 
            $table->string('noResolution'); 
            $table->string('nameBoat'); 
            $table->string('enrollment'); 
            $table->string('noPatent'); 
            $table->string('eyeMesh'); 
            $table->string('netWidth'); 
            $table->string('eyeFlake'); 
            $table->string('typeHook'); 
            $table->string('longNet'); 
            $table->string('materialArt'); 
            $table->string('equipDevi'); 
            $table->string('captain'); 
            $table->string('noOmi'); 
            $table->string('legalRepre'); 
            $table->string('noAllCrew'); 
            $table->string('noCrewForeign'); 
            $table->string('noCrewNational'); 
            $table->string('noDays'); 
            $table->string('noAllHauls'); 
            $table->string('noHaulsNacional'); 
            $table->string('noHaulsInter'); 
            $table->string('landedWeight'); 
            $table->string('observation'); 
            $table->string('notification'); 
            $table->string('finalityArrival'); 
            $table->string('origin'); 
            $table->string('destination'); 
            $table->string('workDone'); 
            $table->string('locationSystem'); 
            $table->string('inspectorConclusions'); 
            $table->string('additionalComments'); 
            $table->date('dateIns'); 
            $table->date('dateScale'); 
            $table->date('dateZarpe'); 
            $table->date('dateLatestArrival'); 
            $table->date('dateValidityPat'); 
            $table->date('date'); 
            $table->date('dateValidity');     
            $table->integer('id_port')->unsigned();
            $table->foreign('id_port')->references('id')->on('ports');
            $table->integer('id_portZarpe')->unsigned();
            $table->foreign('id_portZarpe')->references('id')->on('ports');
            $table->integer('id_portArrival')->unsigned();
            $table->foreign('id_portArrival')->references('id')->on('ports');
            $table->integer('id_flag')->unsigned();
            $table->foreign('id_flag')->references('id')->on('flags');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('regions');
            $table->integer('id_nationality')->unsigned();
            $table->foreign('id_nationality')->references('id')->on('nationalities');
            $table->integer('id_zoneAutoFisher')->unsigned();
            $table->foreign('id_zoneAutoFisher')->references('id')->on('auto_fishers');
            $table->integer('id_fisheryAuthorized')->unsigned();
            $table->foreign('id_fisheryAuthorized')->references('id')->on('fishery_authorizeds');
            $table->integer('id_company')->unsigned();
            $table->foreign('id_company')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrivals');
    }
}
