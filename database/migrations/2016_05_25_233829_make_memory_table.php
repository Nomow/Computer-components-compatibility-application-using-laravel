<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeMemoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memory', function (Blueprint $table) {
               $table->increments('id');
              $table->integer('manufacturer_id');
              $table->string('part_number', 100);
              $table->integer('capacity');
              $table->string('type', 50);
              $table->integer('speed');
               $table->integer('latency');
               $table->string('timing', 50)->nullable();
               $table->float('voltage');
               $table->boolean('ecc');
               $table->boolean('registered');
               $table->boolean('spreader')->default(0);
               $table->integer('slots');
               $table->string('data_rate');
        });
    }
   





  
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memory');
    }
}
