<?php

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Produksi',
            'gaji_pokok' => '2800000',
            'bonus_professional' => '100000',
        ]);
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Sales',
            'gaji_pokok' => '2800000',
            'bonus_professional' => '100000',
        ]);
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Akuntan',
            'gaji_pokok' => '2800000',
            'bonus_professional' => '100000',
        ]);
    }
}
