<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_potongan');
            $table->integer('besar_potongan');
            $table->timestamps();
        });

        // Schema::create('potongan_pegawai', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedInteger('pegawai_id');
        //     $table->integer('total_potongan');
        //     $table->string('periode_potongan');
        //     $table->foreign('pegawai_id')
        //         ->references('id')
        //         ->on('pegawai')
        //         ->onDelete('cascade');
        // });
        
        // Schema::create('potongan_detail', function (Blueprint $table) {
        // $table->id();
        //     $table->unsignedInteger('potongan_pegawai_id');
        //     $table->unsignedInteger('potongan_id');
        //     $table->integer('besar_potongan');
        //     $table->integer('banyak_hari_potongan');
        //     $table->foreign('potongan_id')
        //         ->references('id')
        //         ->on('potongan')
        //         ->onDelete('cascade');
        //     $table->foreign('potongan_pegawai_id')
        //         ->references('id')
        //         ->on('potongan_pegawai')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potongan');
    }
}
