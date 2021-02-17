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
            'bonus_professional' => '500000',
        ]);
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Salesman',
            'gaji_pokok' => '3000000',
            'bonus_professional' => '600000',
        ]);
    }
}
