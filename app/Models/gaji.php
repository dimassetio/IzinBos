<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    protected $table = 'gaji';
    protected $fillable = ['id_pegawai','gaji_pokok','total_tunjangan','tanggal']
}
