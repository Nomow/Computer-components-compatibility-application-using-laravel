<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPsuTablePinTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('psu', function (Blueprint $table) {
             $table->integer('6pin');
            $table->integer('8pin');
            $table->integer('6_plus_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('psu', function (Blueprint $table) {
            //
        });
    }
}
