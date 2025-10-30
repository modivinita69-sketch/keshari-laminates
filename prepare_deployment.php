<?php

// Deployment preparation script
echo "Starting deployment preparation...\n";

// 1. Create necessary directories if they don't exist
$directories = [
    'public/storage',
    'storage/app/public',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
        echo "Created directory: $directory\n";
    }
}

// 2. Set proper permissions
$permissions = [
    'storage' => 0755,
    'storage/app' => 0755,
    'storage/framework' => 0755,
    'storage/logs' => 0755,
    'bootstrap/cache' => 0755,
    'public' => 0755,
];

foreach ($permissions as $path => $permission) {
    chmod($path, $permission);
    echo "Set permissions for $path to " . decoct($permission) . "\n";
}

// 3. Create .env.example if it doesn't exist
if (!file_exists('.env.example')) {
    copy('.env', '.env.example');
    echo "Created .env.example from .env\n";
}

// 4. Create deployment package directory
$deployDir = 'deploy_package';
if (!is_dir($deployDir)) {
    mkdir($deployDir);
    echo "Created deployment package directory\n";
}

// 5. Create list of files to include
$deploymentFiles = [
    'app',
    'bootstrap',
    'config',
    'database',
    'lang',
    'public',
    'resources',
    'routes',
    'storage',
    'vendor',
    'artisan',
    'composer.json',
    'composer.lock',
    '.env.example',
    'README.md',
];

echo "\nDeployment preparation completed!\n";
echo "\nNext steps:\n";
echo "1. Create a ZIP file of the following files/directories:\n";
foreach ($deploymentFiles as $file) {
    echo "   - $file\n";
}
echo "\n2. Upload the ZIP file to your hosting\n";
echo "3. Extract the files in your hosting's file manager\n";
echo "4. Create .env file and set up your production environment variables\n";
echo "5. Set proper permissions on server\n";
echo "6. Run composer install if SSH access is available\n";