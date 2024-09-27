<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'full_access',
            'description' => 'Full access for administrator'
        ]);

        Permission::create([
            'name' => 'create_post',
            'description' => 'Create new posts'
        ]);

        Permission::create([
            'name' => 'edit_post',
            'description' => 'Edit existing posts'
        ]);

        Permission::create([
            'name' => 'delete_post',
            'description' => 'Delete posts'
        ]);

        Permission::create([
            'name' => 'view_post',
            'description' => 'View posts'
        ]);
    }
}
