<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234567890',
            'role' => 'super_admin',
            'is_active' => 1,
        ]);

        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'phone' => '0987654321',
            'role' => 'admin',
            'is_active' => 1,
        ]);

        Admin::create([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'moderator',
            'is_active' => 1,
        ]);
    }
}
