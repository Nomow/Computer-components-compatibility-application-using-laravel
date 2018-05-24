<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpuColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gpu', function (Blueprint $table) {
            $table->string('interface', 50);
            $table->integer('6pin');
            $table->integer('8pin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gpu', function (Blueprint $table) {
            //
        });
    }
}
