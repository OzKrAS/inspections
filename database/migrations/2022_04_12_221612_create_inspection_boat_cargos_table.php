<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionBoatCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_boat_cargos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place');
            $table->string('noForm');
            $table->string('businessColombia');
            $table->string('fullCargo');
            $table->string('nameBoatCargo');
            $table->string('nameBoat');
            $table->string('noIdOmi');
            $table->string('placeTransfer');
            $table->string('areasCapture');
            $table->string('species');
            $table->string('shapeProduct');
            $table->string('amount');
            $table->string('productLanded');
            $table->string('nameOfficial');
            $table->string('nameCaptain');
            $table->string('nameBusiness');
            $table->date('date');
            $table->date('dateTransfer');
            $table->string('notification');
            $table->string('areaOperation');
            $table->string('observation');

            $table->integer('id_port')->unsigned();
            $table->foreign('id_port')->references('id')->on('ports');
            $table->integer('id_portZarpe')->unsigned();
            $table->foreign('id_portZarpe')->references('id')->on('ports');
            $table->integer('id_portDisemb')->unsigned();
            $table->foreign('id_portDisemb')->references('id')->on('ports');
            $table->integer('id_flag')->unsigned();
            $table->foreign('id_flag')->references('id')->on('flags');
            $table->integer('id_flagDonor')->unsigned();
            $table->foreign('id_flagDonor')->references('id')->on('flags');
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
        Schema::dropIfExists('inspection_boat_cargos');
    }
}
