<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusTable extends Migration
{
    
    public function up()
    {
        Schema::table('house_promotion', function (Blueprint $table) {
           $table->integer('status')->default(0);
        });
    }

    
    public function down()
    {
        Schema::table('house_promotion', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
