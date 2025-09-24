<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user for Keshari Laminates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if admin already exists
        $existingAdmin = Admin::where('email', 'admin@kesharilaminates.com')->first();
        
        if ($existingAdmin) {
            $this->error('Admin user already exists!');
            $this->info('Email: admin@kesharilaminates.com');
            return;
        }

        try {
            // Create admin user
            Admin::create([
                'name' => 'Admin',
                'email' => 'admin@kesharilaminates.com',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
                'is_active' => true,
            ]);

            $this->info('✅ Admin user created successfully!');
            $this->info('📧 Email: admin@kesharilaminates.com');
            $this->info('🔑 Password: password123');
            $this->info('🔐 Role: Super Admin');
            $this->info('');
            $this->info('You can now login to the admin panel at: /admin/login');
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to create admin user: ' . $e->getMessage());
            $this->info('Make sure the database tables exist. Run: php artisan migrate');
        }
    }
}