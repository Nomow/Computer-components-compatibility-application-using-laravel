<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id');
            $table->string('part_number', 100);
            $table->string('type', 50);
            $table->string('model', 50)->nullable();


            $table->integer('gpu_lenght');
            $table->integer('cpu_cooler_height');

            $table->string('psu_type', 50);


            $table->boolean('side_panel_window')->default(0);
            $table->boolean('front_usb_panel')->default(0);
            

            $table->integer('external_525');
            $table->integer('external_35');

            $table->integer('internal_35');
            $table->integer('internal_25');
            $table->integer('expansion_slots');
            $table->string('slug', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('case');
    }
}
