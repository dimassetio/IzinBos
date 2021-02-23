<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Pegawai;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= User::create([
            'name' => 'admin bro',
            'email' => 'admin@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(1);
        $pegawai = Pegawai::create([
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email
        ]);

        $user= User::create([
            'name' => 'sales gan',
            'email' => 'sales@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(2);
        $pegawai = Pegawai::create([
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email
        ]);
        
        $user= User::create([
            'name' => 'produksi coy',
            'email' => 'produksi@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(3);
        $pegawai = Pegawai::create([
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email
        ]);

        $user= User::create([
            'name' => 'akuntan sam',
            'email' => 'akuntan@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(4);
        $pegawai = Pegawai::create([
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email
        ]);
    }
}
