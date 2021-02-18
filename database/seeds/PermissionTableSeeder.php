<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission([
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'pegawai-list',
            'pegawai-data',
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
            'izin-list',
            'izin-create',
            'izin-edit',
            'izin-delete',
            'izin-confirmation',
            'biodata-edit',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
