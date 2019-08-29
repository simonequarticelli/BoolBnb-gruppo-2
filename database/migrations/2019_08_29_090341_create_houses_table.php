<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->tinyInteger('n_beds');
            $table->tinyInteger('n_wc');
            $table->smallInteger('mq');
            $table->string('address');
            $table->float('longitude', 10, 6);
            $table->float('latitude', 10, 6);
            $table->text('img');
            $table->string('slug');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
