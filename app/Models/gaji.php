<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    protected $table = 'gaji';
    protected $fillable = ['pegawai_id','gaji_pokok','total_tunjangan','bonus_loyalitas','tanggal'];
}
