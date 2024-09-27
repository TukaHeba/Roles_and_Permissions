<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrator with full access'
        ]);
        $adminRole->assignPermission(['full_access']);

        $managerRole = Role::create([
            'name' => 'manager',
            'description' => 'Manager with limited access'
        ]);
        $managerRole->assignPermission(['create_post', 'edit_post', 'view_post']);

        $editorRole = Role::create([
            'name' => 'editor',
            'description' => 'Editor with limited access'
        ]);
        $editorRole->assignPermission(['create_post', 'edit_post', 'view_post']);

        $userRole = Role::create([
            'name' => 'user',
            'description' => 'Normal user with limited access'
        ]);
        $userRole->assignPermission(['view_post']);
    }
}
