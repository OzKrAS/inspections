<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticePreviousZarpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_previous_zarpes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('time');
            $table->string('portState');
            $table->string('nameBoat'); 
            $table->string('statePavilion'); 
            $table->string('internationalSignal');
            $table->string('informationBoat'); 
            $table->string('ownerBoat'); 
            $table->string('idEnrollment'); 
            $table->string('idOmi'); 
            $table->string('idExternal'); 
            $table->string('idOrop'); 
            $table->string('type'); 
            $table->string('lengthBoat'); 
            $table->string('sleeveBoat'); 
            $table->string('draftBoat'); 
            $table->string('nameCaptain'); 
            $table->string('noIdentification'); 
            $table->string('identifier'); 
            $table->string('fishingAreas'); 
            $table->string('species'); 
            $table->string('arts'); 
            $table->string('typeFishery');
            $table->date('date');
            $table->date('datePlanned');
            $table->string('typeBoat');
            $table->string('slbVms');
            $table->date('dateExp');
            $table->date('dateExpiration');
            $table->string('autorization');

            $table->integer('id_port')->unsigned();
            $table->foreign('id_port')->references('id')->on('ports');
            $table->integer('id_port_scale')->unsigned();
            $table->foreign('id_port_scale')->references('id')->on('ports');
            $table->integer('id_nationality')->unsigned();
            $table->foreign('id_nationality')->references('id')->on('nationalities');
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
        Schema::dropIfExists('notice_previous_zarpes');
    }
}
