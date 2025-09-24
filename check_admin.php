<?php

require_once 'vendor/autoload.php';

use App\Models\Admin;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Checking existing admin users...\n";

try {
    $admins = Admin::all();
    
    if ($admins->count() > 0) {
        echo "Found " . $admins->count() . " admin user(s):\n";
        foreach ($admins as $admin) {
            echo "- ID: {$admin->id}, Email: {$admin->email}, Name: {$admin->name}, Role: {$admin->role}\n";
        }
    } else {
        echo "No admin users found. Creating default admin...\n";
        
        $admin = Admin::create([
            'name' => 'Keshari Admin',
            'email' => 'admin@kesharilaminates.com',
            'password' => bcrypt('admin123'),
            'role' => 'super_admin'
        ]);
        
        echo "Created admin user:\n";
        echo "Email: admin@kesharilaminates.com\n";
        echo "Password: admin123\n";
        echo "Role: super_admin\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}