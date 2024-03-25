<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName('admin');
        $permissions = ['view_drives','view_drive_applications','cancel_drive','block_or_unblock_student','view_students','view_companies'];

        foreach ($permissions as $permission) {
            $role->givePermissionTo(Permission::findByName($permission));
        }
    }
}
