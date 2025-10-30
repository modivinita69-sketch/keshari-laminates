<?php

// Get current URL
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$baseURL = str_replace('migrate.php', '', $currentURL);

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

// Get the kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<pre>";
echo "Starting Database Migration...\n\n";

try {
    // Run the migration
    $kernel->call('migrate', ['--force' => true]);
    echo "\nMigration completed successfully!\n";

    // Run the seeders if needed
    if (isset($_GET['seed'])) {
        echo "\nRunning Database Seeders...\n";
        $kernel->call('db:seed', ['--force' => true]);
        echo "\nSeeders completed successfully!\n";
    }
} catch (Exception $e) {
    echo "\nError occurred: " . $e->getMessage() . "\n";
}

echo "\nDone!\n";
echo "</pre>";

// Terminate the application
$kernel->terminate($_SERVER['REQUEST_URI'], null);