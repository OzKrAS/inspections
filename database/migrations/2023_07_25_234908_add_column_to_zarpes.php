<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToZarpes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zarpes', function(Blueprint $table){
           $table->unsignedBigInteger('id_boat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zarpes', function (Blueprint $table) {
            if(Schema::hasColumn('zarpes', 'id_boat')){
                $table->dropColumn('id_boat');
            }
        });
    }
}
