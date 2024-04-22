<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AssignAdminRoleToModel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = User::where('type','admin')->get();

        $admins->transform(function($admin){
            $admin->assignRole('admin');
            $admin->save();
            return $admin;
        });

    }
}
