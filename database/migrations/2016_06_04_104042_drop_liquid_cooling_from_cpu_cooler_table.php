<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLiquidCoolingFromCpuCoolerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cpu_cooler', function (Blueprint $table) {
           $table->dropColumn('liquid_cooled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cpu_cooler', function (Blueprint $table) {
            //
        });
    }
}
