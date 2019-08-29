<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousePaymentTable extends Migration
{
    
    public function up()
    {
        Schema::create('house_payment', function (Blueprint $table) {
            
            // creo due colonne
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('payment_id');
            // creo chiavi esterne
            $table->foreign('house_id')->references('id')->on('houses');
            $table->foreign('payment_id')->references('id')->on('payments');
            // creo chiave primaria UNIVOCA
            $table->primary(['house_id', 'payment_id']);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('house_payment');
    }
}
