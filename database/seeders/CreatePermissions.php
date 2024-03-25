<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'create_drives']);
        Permission::create(['name'=>'apply_to_drives']);
        Permission::create(['name'=>'view_drives']);
        Permission::create(['name'=>'view_drive_applications']);
        Permission::create(['name'=>'cancel_drive']);
        Permission::create(['name'=>'update_drive']);
        Permission::create(['name'=>'block_or_unblock_student']);
        Permission::create(['name'=>'view_students']);
        Permission::create(['name'=>'view_companies']);
    }
}
