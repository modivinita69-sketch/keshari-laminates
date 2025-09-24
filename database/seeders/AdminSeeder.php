<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@kesharilaminates.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // You can add more admin users here
        Admin::create([
            'name' => 'Keshari Admin',
            'email' => 'keshari@kesharilaminates.com',
            'password' => Hash::make('keshari123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        echo "Admin users created successfully!\n";
        echo "Login credentials:\n";
        echo "1. Email: admin@kesharilaminates.com, Password: password123 (Super Admin)\n";
        echo "2. Email: keshari@kesharilaminates.com, Password: keshari123 (Admin)\n";
    }
}