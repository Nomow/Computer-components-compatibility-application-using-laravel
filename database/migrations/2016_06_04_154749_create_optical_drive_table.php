<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpticalDriveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optical_drive', function (Blueprint $table) {
            $table->increments('id');
                     $table->integer('manufacturer_id');
            $table->string('part_number', 100);

            $table->string('form_factor');
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
        Schema::drop('optical_drive');
    }
}
