<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectTable extends Migration
{
    
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            
            $table->string('subject')->after('email');

        });
    }

    
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            
            $table->dropColumn('subject');

        });
    }
}
