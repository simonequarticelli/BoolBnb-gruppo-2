<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHousesTable extends Migration
{
    
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            
            $table->unsignedInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
            
            $table->dropForeign('houses_user_id_foreign'); 
            $table->dropColumn('user_id'); 
       
        });
    }
}
