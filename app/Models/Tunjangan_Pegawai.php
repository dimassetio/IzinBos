<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tunjangan_Pegawai extends Model
{
    protected $table = 'tunjangan_pegawai';

    protected $fillable = ['pegawai_id', 'tunjangan_id'];
}
