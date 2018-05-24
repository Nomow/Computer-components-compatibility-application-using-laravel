<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage', function (Blueprint $table) {
          
        $table->increments('id');
        $table->string('manufacturer_id');
        $table->string('part_number', 100);
        $table->string('type', 50);
        $table->string('form_factor', 50);
        $table->integer('capacity');
        $table->string('interface', 50);
        $table->integer('cache')->nullable(); 
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
        Schema::drop('storage');
    }
}
