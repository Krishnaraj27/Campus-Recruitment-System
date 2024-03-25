<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToCompanyRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName('company');
        $permissions = ['create_drives','view_drive_applications','cancel_drive','update_drive'];

        foreach ($permissions as $permission) {
            $role->givePermissionTo(Permission::findByName($permission));
        }
    }
}
