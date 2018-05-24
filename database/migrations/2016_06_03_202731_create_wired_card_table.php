<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWiredCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wired_card', function (Blueprint $table) {

          $table->increments('id');
            $table->integer('manufacturer_id');
            $table->string('part_number', 100);
            $table->string('interface', 50);
            $table->string('speed', 100);
            $table->integer('connector');
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
        Schema::drop('wired_card');
    }
}
