<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureHouseTable extends Migration
{
   
    public function up()
    {
        Schema::create('feature_house', function (Blueprint $table) {
            // creo due colonne
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('house_id');
            // creo chiavi esterne
            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('house_id')->references('id')->on('houses');
            // creo chiave primaria UNIVOCA
            $table->primary(['feature_id', 'house_id']);
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('feature_house');
    }
}
