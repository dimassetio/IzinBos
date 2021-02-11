<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Potongan extends Model
{
    protected $table = 'potongan';

    protected $fillable = ['nama_potongan', 'besar_potongan'];
}
