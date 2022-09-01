<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationDisembTunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_disemb_tunas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameBoat');
            $table->string('ZoneFisher');
            // $table->string('nameOfficial'); 
            // $table->string('yellowFin'); 
            // $table->string('barrilete'); 
            // $table->string('patudo');    
            $table->date('date');
            $table->date('dateBeginningFaena');
            $table->date('dateEndFaena');
            $table->string('observation');
            // $table->string('other');
            // $table->string('poundRating1');
            // $table->string('poundRating2');
            // $table->string('poundRating3');
            // $table->string('poundRating4');
           
            $table->integer('id_port')->unsigned();
            $table->foreign('id_port')->references('id')->on('ports');
            $table->integer('id_flag')->unsigned();
            $table->foreign('id_flag')->references('id')->on('flags');
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
        Schema::dropIfExists('certification_disemb_tunas');
    }
}
