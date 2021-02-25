<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role=Role::create(['name' => 'admin']);

        for ($i=0; $i<=40; $i++) {
            $Role->GivePermissionTo($i);
        }
        
        $Role=Role::create(['name' => 'sales']);
        $Role->GivePermissionTo(14,18,23,27,31,32,33,37);
        
        $Role=Role::create(['name' => 'produksi']);
        $Role->GivePermissionTo(14,18,23,27,31,32,33,37);
        
        $Role=Role::create(['name' => 'akuntan']);
        $Role->GivePermissionTo(14,18,23,27,31,32,33,37);
    }
}
