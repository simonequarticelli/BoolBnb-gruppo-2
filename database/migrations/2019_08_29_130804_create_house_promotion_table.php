<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousePromotionTable extends Migration
{
    
    public function up()
    {
        Schema::create('house_promotion', function (Blueprint $table) {
            // creo due colonne
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('promotion_id');
            // creo chiavi esterne
            $table->foreign('house_id')->references('id')->on('houses');
            $table->foreign('promotion_id')->references('id')->on('promotions');
            // creo chiave primaria UNIVOCA
            $table->primary(['house_id', 'promotion_id']);
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('house_promotion');
    }
}
