<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Mobil_Id');
            $table->integer('Slot_Id');
            $table->integer('Biaya');
            $table->integer('Pinalti');
            $table->time('Tanggal_Order');
            $table->time('CheckIn');
            $table->time('Check_Out');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_orders');
    }
}
