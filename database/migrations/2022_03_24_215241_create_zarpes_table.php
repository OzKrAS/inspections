<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZarpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zarpes', function (Blueprint $table) {
            $table->increments('id');       
            $table->string('insNo'); 
            $table->string('portArrival'); 
            $table->string('radioCall'); 
            $table->string('idOmi'); 
            $table->string('noResolution'); 
            $table->string('nameBoat'); 
            $table->string('enrollment'); 
            $table->string('noPatent'); 
            $table->string('representative'); 
            $table->string('business'); 
            $table->string('zoneAutFish'); 
            $table->string('eyeMesh'); 
            $table->string('netWidth'); 
            $table->string('eyeFlake'); 
            $table->string('typeHook'); 
            $table->string('longNet'); 
            $table->string('materialArt'); 
            $table->string('equipDevi'); 
            $table->string('captain'); 
            $table->string('nacionality'); 
            $table->string('observation'); 
            $table->string('conclusions'); 
            $table->string('comments');    
            $table->date('dateIns');
            $table->date('dateScale');
            $table->date('dateZarpe');
            $table->date('dateResolution');
            $table->date('dateValid');
            $table->date('dateLatestArrival');
            $table->date('dateValidityPat');

            $table->integer('id_port')->unsigned();
            $table->foreign('id_port')->references('id')->on('ports');
            $table->integer('id_flag')->unsigned();
            $table->foreign('id_flag')->references('id')->on('flags');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('regions');
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
        Schema::dropIfExists('zarpes');
    }
}
