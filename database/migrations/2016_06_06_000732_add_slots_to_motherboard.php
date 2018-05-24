<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlotsToMotherboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motherboard', function (Blueprint $table) {
           $table->integer('pci');
           $table->integer('pcix1');
             $table->integer('pcix4');
              $table->integer('pcix8');
               $table->integer('pcix16');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motherboard', function (Blueprint $table) {
            //
        });
    }
}
