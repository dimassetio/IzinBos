<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'pegawai-list',
            'pegawai-create',
            'pegawai-edit',
            'pegawai-delete',
            'jabatan-list',
            'jabatan-create',
            'jabatan-edit',
            'jabatan-delete',
            'tunjangan-list',
            'tunjangan-create',
            'tunjangan-edit',
            'tunjangan-delete',
            'potongan-list',
            'potongan-create',
            'potongan-edit',
            'potongan-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
