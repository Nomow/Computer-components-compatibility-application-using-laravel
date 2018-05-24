<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGpuColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gpu', function (Blueprint $table) {
        $table->integer('boost_clock');
        $table->integer('hdmi');
        $table->integer('displayport');
        $table->integer('dvi_port');
        $table->boolean('sli_cross');
        $table->integer('card_count');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gpu', function (Blueprint $table) {
            //
        });
    }
}
