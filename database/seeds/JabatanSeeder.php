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
            'nama_jabatan' => 'CEO',
            'gaji_pokok' => '10000000',
            'bonus_professional' => '5000000',
        ]);
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'CTO',
            'gaji_pokok' => '8000000',
            'bonus_professional' => '4000000',
        ]);
    }
}
