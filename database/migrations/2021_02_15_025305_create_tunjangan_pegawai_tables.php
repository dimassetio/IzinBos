<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTunjanganPegawaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tunjangan_pegawai', function (Blueprint $table) {
            $table->unsignedBigInteger('pegawai_id');
            $table->unsignedBigInteger('tunjangan_id');

            $table->foreign('pegawai_id')
                    ->references('id')
                    ->on('pegawai')
                    ->onDelete('cascade');
            $table->foreign('tunjangan_id')
                    ->references('id')
                    ->on('tunjangan')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tunjangan_pegawai_tables');
    }
}
