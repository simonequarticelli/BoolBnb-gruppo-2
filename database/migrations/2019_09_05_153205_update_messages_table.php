<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessagesTable extends Migration
{
    
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {

            $table->unsignedBigInteger('house_id')->nullable()->after('id');
            $table->foreign('house_id')->references('id')->on('houses');

        });
    }

    
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {

            $table->dropForeign('messages_house_id_foreign'); 
            $table->dropColumn('house_id'); 

        });
    }
}
