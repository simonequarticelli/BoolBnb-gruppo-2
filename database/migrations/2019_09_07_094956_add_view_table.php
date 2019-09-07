<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewTable extends Migration
{
    
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {

            $table->integer('view')->after('user_id');

        });
    }

    
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {

            $table->dropColumn('view');

        });
    }
}
