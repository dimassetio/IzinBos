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
        $permissions = [
         /* 01 */   'role-list',
         /* 02 */   'role-create',
         /* 03 */   'role-edit',
         /* 04 */   'role-delete',
         /* 05 */   'permission-list',
         /* 06 */   'permission-create',
         /* 07 */   'permission-edit',
         /* 08 */   'permission-delete',
         /* 09 */   'user-list',
         /* 10 */   'user-create',
         /* 11 */   'user-edit',
         /* 12 */   'user-delete',
         /* 13 */   'pegawai-list',
         /* 14 */   'pegawai-data',
         /* 15 */   'pegawai-create',
         /* 16 */   'pegawai-edit',
         /* 17 */   'pegawai-delete',
         /* 18 */   'biodata-edit',
         /* 19 */   'jabatan-list',
         /* 20 */   'jabatan-create',
         /* 21 */   'jabatan-edit',
         /* 22 */   'jabatan-delete',
         /* 23 */   'tunjangan-list',
         /* 24 */   'tunjangan-create',
         /* 25 */   'tunjangan-edit',
         /* 26 */   'tunjangan-delete',
         /* 27 */   'potongan-list',
         /* 28 */   'potongan-create',
         /* 29 */   'potongan-edit',
         /* 30 */   'potongan-delete',
         /* 31 */   'izin-list', 
         /* 32 */   'izin-create',
         /* 33 */   'izin-edit',
         /* 34 */   'izin-delete',
         /* 35 */   'izin-confirmation',
         /* 36 */   'give-tunjangan',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

