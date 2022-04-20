<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailFisherAutZarpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_fisher_aut_zarpes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_zarpe')->unsigned();
            $table->foreign('id_zarpe')->references('id')->on('zarpes');
            $table->integer('id_fisheryAuthorized')->unsigned();
            $table->foreign('id_fisheryAuthorized')->references('id')->on('fishery_authorizeds');
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
        Schema::dropIfExists('detail_fisher_aut_zarpes');
    }
}
