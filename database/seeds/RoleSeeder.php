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
        $Role->GivePermissionTo(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
        
        $Role=Role::create(['name' => 'sales']);
        $Role->GivePermissionTo(14,18,23,27,31,32,33);
        
        $Role=Role::create(['name' => 'produksi']);
        $Role->GivePermissionTo(14,18,23,27,31,32,33);
        
        $Role=Role::create(['name' => 'akuntan']);
        $Role->GivePermissionTo(14,18,23,27,31,32,33);
    }
}
