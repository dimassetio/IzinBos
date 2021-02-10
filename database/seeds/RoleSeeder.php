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
        $Role->GivePermissionTo(1,2,3,4,5,6,7,8);
        
        $Role2=Role::create(['name' => 'user']);
        $Role2->GivePermissionTo(1,5);
    }
}
