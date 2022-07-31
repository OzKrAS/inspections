<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckDetFlapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_det_flaps', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('office'); 
            $table->string('official'); 
            $table->string('boat'); 
            $table->string('enrollment'); 
            $table->string('outhFhisher'); 
            $table->string('fishLicense'); 
            $table->string('owner'); 
            $table->string('fishCaptain'); 
            $table->string('location'); 
            $table->string('observation'); 
            $table->date('date');
            
            $table->string('flapMeshSize');
            $table->string('angleDet');
            $table->string('typeDet');
            $table->string('materialDet');
            $table->string('exit');
            $table->string('float');

            $table->integer('id_company')->unsigned();
            $table->foreign('id_company')->references('id')->on('companies');
            $table->integer('id_regional')->unsigned();
            $table->foreign('id_regional')->references('id')->on('regionals');

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
        Schema::dropIfExists('check_det_flaps');
    }
}
