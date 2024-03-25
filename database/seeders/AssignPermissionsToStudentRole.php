<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToStudentRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName('student');
        $permissions = ['view_drives','apply_to_drives'];

        foreach ($permissions as $permission) {
            $role->givePermissionTo(Permission::findByName($permission));
        }
    }
}
