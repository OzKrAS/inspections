<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_certificates', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('noActa');
            $table->string('nameScientific');
            $table->string('nameCommon');
            $table->string('presentation');
            $table->string('amount');
            $table->string('weight');
            $table->string('commercialValue');
            $table->date('date');
            $table->string('nameOfficial');
            $table->string('noDocumentId1');
            $table->string('nameRepresentative');
            $table->string('noDocumentId2');
            $table->string('noPlateCertificate');

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
        Schema::dropIfExists('donation_certificates');
    }
}
