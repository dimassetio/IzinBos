<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Gaji extends Model
{
    protected $table = 'detail_gaji';

    protected $fillable = ['pegawai_id', 'gaji_id','tanggal','tunjangan_id','nominal_tunjangan'];
}
