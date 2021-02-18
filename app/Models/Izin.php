<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = 'izin';

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai', 
        'keterangan', 
        'type_izin', 
        'status_diterima', 
        'pegawai_id', 
    ];

    public function getNamaPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        return $pegawai->nama;
    }
}
