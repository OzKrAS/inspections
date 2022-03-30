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
            $table->string('region'); 
            $table->string('office'); 
            $table->string('official'); 
            $table->string('boat'); 
            $table->string('enrollment'); 
            $table->string('outhFhisher'); 
            $table->string('fishLicense'); 
            $table->string('business'); 
            $table->string('owner'); 
            $table->string('fishCaptain'); 
            $table->string('location'); 
            $table->string('date'); 

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
