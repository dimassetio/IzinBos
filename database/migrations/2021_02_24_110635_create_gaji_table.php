<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai_id');
            $table->integer('gaji_pokok')->default('0');
            $table->integer('total_tunjangan')->default('0');
            $table->integer('bonus_loyalitas')->default('0');
            $table->date('tanggal');
            $table->timestamps();

            // $table->foreign('pegawai_id')
            //     ->references('id')
            //     ->on('pegawai')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji');
    }
}
