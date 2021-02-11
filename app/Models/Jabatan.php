<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;


class Jabatan extends Model
{
    // use Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $table = 'jabatan';

    protected $fillable = ['nama_jabatan', 'gaji_pokok', 'bonus_professional'];
}
