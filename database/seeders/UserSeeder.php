<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);
        $admin->assignRole('admin');

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => '12345678',
        ]);
        $manager->assignRole('manager');

        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => '12345678',
        ]);
        $editor->assignRole('editor');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '12345678',
        ]);
        $user->assignRole('user');
    }
}
