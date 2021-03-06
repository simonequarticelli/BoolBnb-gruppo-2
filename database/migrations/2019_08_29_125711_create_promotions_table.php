<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('price', 3, 2);
            $table->smallInteger('duration');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
