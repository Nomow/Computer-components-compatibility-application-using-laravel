<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnSocketIdFromCpuSocketTableAndRenameTempColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cpu_socket', function (Blueprint $table) {
            $table->dropColumn('socket_id');
            $table->renameColumn('temp', 'name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cpu_socket', function (Blueprint $table) {
            //
        });
    }
}
