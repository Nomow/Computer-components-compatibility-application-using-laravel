<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWirelessCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wireless_card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id');
            $table->string('part_number', 100);
            $table->string('interface', 50);
             $table->string('protocol', 100);
            $table->string('security', 100)->nullable();
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
        Schema::drop('wireless_card');
    }
}
