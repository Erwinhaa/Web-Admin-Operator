<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGedungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gedungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nama_Gedung');
            $table->string('Alamat');
            $table->integer('IsFull');
            $table->integer('Jumlah_Slot');
            $table->bigInteger('Operator_Id');
            
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
        Schema::dropIfExists('gedungs');
    }
}
