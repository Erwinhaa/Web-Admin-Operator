<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotParkirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slot_parkirs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nama_Slot');
            $table->integer('Status_Slot');
            $table->bigInteger('Gedung_Id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slot_parkirs');
    }
}
