<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameBoat'); 
            $table->string('enrollment'); 
            $table->string('noPatent'); 
            $table->string('noResolution'); 
            $table->date('dateValidityPat');
            $table->date('dateValid');
            $table->date('dateResolution');
            $table->string('tp_boat');

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
        Schema::dropIfExists('boats');
    }
}
