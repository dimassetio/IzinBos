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
            'gaji_pokok' => '4000000',
            'bonus_professional' => '100000',
        ]);
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Sales',
            'gaji_pokok' => '3000000',
            'bonus_professional' => '100000',
        ]);
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Akuntan',
            'gaji_pokok' => '3500000',
            'bonus_professional' => '100000',
        ]);
    }
}
