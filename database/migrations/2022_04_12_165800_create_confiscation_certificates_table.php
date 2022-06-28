<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiscationCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confiscation_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noActa');
            $table->string('departament');
            $table->string('municipality');
            $table->string('text4');
            $table->string('officialName');
            $table->string('documentIdOfficial');
            $table->string('representativeName');
            $table->string('documentIdRepresentative');
            $table->string('plateCertificate');
            $table->string('name');
            $table->string('documentIdOffender');
            $table->string('expeditionPlace');
            $table->string('homeAddress');
            $table->string('municipalityOffender');
            $table->string('corregimiento');
            $table->string('neighborhood');
            $table->string('telephone');
            $table->string('mobile');
            $table->string('email');
            $table->date('date');
            $table->date('dateExpedition');
            $table->string('observation');

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
        Schema::dropIfExists('confiscation_certificates');
    }
}
