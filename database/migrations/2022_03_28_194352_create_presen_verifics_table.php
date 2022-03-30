<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresenVerificsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presen_verifics', function (Blueprint $table) {
            $table->increments('id');       
            $table->string('nameShip'); 
            $table->string('cruise'); 
            $table->string('nameFish'); 
            $table->string('nameCaptain'); 
            $table->string('dateZarpe'); 
            $table->string('dateDesemb'); 
           
            $table->integer('id_flag')->unsigned();
            $table->foreign('id_flag')->references('id')->on('flags');
          
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
        Schema::dropIfExists('presen_verifics');
    }
}
