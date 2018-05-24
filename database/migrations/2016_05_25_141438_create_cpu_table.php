<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu', function (Blueprint $table) {

              $table->increments('id');
              $table->integer('manufacturer_id');
              $table->string('series', 50);
              $table->string('name', 50);
              $table->string('part_number', 100);

                  $table->string('core_name', 50);
                  $table->integer('core_count');
                  $table->integer('thread_count')->nullable();
                  $table->float('frequency');
                  $table->float('max_frequency')->nullable();

                       $table->string('l1_cache', 50)->nullable();
                       $table->string('l2_cache', 50)->nullable();
                       $table->string('l3_cache', 50)->nullable();
                       $table->integer('manufacturing_tech')->nullable();
                       $table->string('integrated_graphics', 50)->nullable();


                              $table->integer('thermal_power');
                              $table->boolean('hyper_threading')->nullable(); 
                              $table->boolean('cooling_device')->nullable(); 
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
        Schema::table('cpu', function (Blueprint $table) {
            //
        });
    }
}
