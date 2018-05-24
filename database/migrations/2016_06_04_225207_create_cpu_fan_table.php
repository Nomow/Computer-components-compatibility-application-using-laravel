<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpuFanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_fan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id');
            $table->string('part_number', 100);
$table->string('model', 50);
$table->integer('size');
$table->string('bearing', 50)->nullable();
$table->integer('rpm_from')->nullable();
$table->integer('rpm_to')->nullable();
$table->float('air_from')->nullable();
$table->float('air_to')->nullable();
$table->float('noise_from')->nullable();
$table->float('noise_to')->nullable();
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
        Schema::drop('case_fan');
    }
}
