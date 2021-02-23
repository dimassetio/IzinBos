<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'nama', 
        'email', 
        'alamat', 
        'tanggal_masuk', 
        'rekening', 
        'type_pegawai', 
        'bank_id', 
        'jabatan_id', 
        'id',
        'bonus_loyalitas'
    ];

    public function jabatan()
    {
        return $this->hasOne('App\Models\Jabatan');
    }

    public function getJabatanName($id)
    {
        if ($id == null) {
            return " ";
        }
        $jabatan = Jabatan::find($id);
        return $jabatan->nama_jabatan;
    }
    public function getBonus($id)
    {
        $jabatan = Jabatan::find($id);
        return $jabatan->bonus_professional;
    }
}
