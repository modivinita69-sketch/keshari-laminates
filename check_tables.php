<?php

// Basic security - Add your IP address here
$allowedIPs = [
    '127.0.0.1', // localhost
    // Add your IP address here
];

if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) {
    die('Access Denied - Your IP: ' . $_SERVER['REMOTE_ADDR']);
}

// Require the autoloader
require __DIR__.'/../keshari/vendor/autoload.php';

// Load environment file
$app = require_once __DIR__.'/../keshari/bootstrap/app.php';

echo "<pre>";
echo "Checking Database Tables...\n\n";

try {
    // Get database connection
    $db = $app->make('db');
    
    // Tables to check
    $tables = [
        'admins',
        'brands',
        'categories',
        'company_info',
        'hero_sliders',
        'migrations',
        'products',
        'product_images',
        'theme_settings'
    ];
    
    foreach ($tables as $table) {
        if ($db->connection()->getSchemaBuilder()->hasTable($table)) {
            $count = $db->table($table)->count();
            echo "✓ Table '{$table}' exists with {$count} records\n";
        } else {
            echo "✗ Table '{$table}' does not exist!\n";
        }
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\nDone!\n";
echo "</pre>";