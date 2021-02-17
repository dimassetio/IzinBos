<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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

        $user= User::create([
            'name' => 'sales gan',
            'email' => 'sales@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(2);
        
        $user= User::create([
            'name' => 'produksi coy',
            'email' => 'produksi@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(2);

        $user= User::create([
            'name' => 'akuntan sam',
            'email' => 'akuntan@b.c',
            'password' => bcrypt('qwer1234')
        ]);
        $user->assignRole(2);
    }
}
