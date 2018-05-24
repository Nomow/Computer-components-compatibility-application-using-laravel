<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpuCoolerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu_cooler', function (Blueprint $table) {
$table->increments('id');
$table->integer('manufacturer_id');
$table->string('part_number', 100);
$table->integer('height');
$table->string('bearing', 50)->nullable();

$table->boolean('liquid_cooled')->default(0);
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
        Schema::drop('cpu_cooler');
    }
}
