<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tunjangan extends Model
{
    protected $table = 'tunjangan';

    protected $fillable = ['nama_tunjangan', 'besar_tunjangan'];
}
