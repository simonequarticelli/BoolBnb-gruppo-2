<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
