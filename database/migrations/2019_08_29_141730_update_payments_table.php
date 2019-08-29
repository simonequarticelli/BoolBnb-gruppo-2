<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaymentsTable extends Migration
{
    
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->unsignedBigInteger('promotion_id')->nullable()->after('id');
            $table->foreign('promotion_id')->references('id')->on('promotions');
        });
    }

    
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropForeign('payment_promotion_id_foreign'); 
            $table->dropColumn('promotion_id'); 
        });
    }
}
