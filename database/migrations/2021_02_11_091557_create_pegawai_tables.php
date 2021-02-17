<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('pegawai', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tanggal_masuk')->nullable();
            $table->string('rekening')->nullable();
            $table->string('type_pegawai')->nullable();
            $table->string('bank_id')->nullable();
            $table->unsignedBigInteger('jabatan_id')->nullable();
            // $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('bonus_loyalitas')->nullable();
            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatan')
                ->onDelete('set null');
            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('pegawai_tables');
    }
}
