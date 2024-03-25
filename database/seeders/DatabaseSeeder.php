<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AssignPermissionsToAdminRole;
use Database\Seeders\AssignPermissionsToCompanyRole;
use Database\Seeders\AssignPermissionsToStudentRole;
use Database\Seeders\CreatePermissions;
use Database\Seeders\CreateRoles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CreateRoles::class,
            CreatePermissions::class,
            AssignPermissionsToAdminRole::class,
            AssignPermissionsToCompanyRole::class,
            AssignPermissionsToStudentRole::class
        ]);
    }
}
