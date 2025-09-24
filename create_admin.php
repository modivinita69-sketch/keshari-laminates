<?php

// Simple script to create admin user
// Run this with: php create_admin.php

require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables manually
function loadEnv($path) {
    if (!file_exists($path)) {
        throw new Exception('.env file not found');
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        
        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
        }
    }
}

loadEnv(__DIR__ . '/.env');

// Database connection
$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$dbname = $_ENV['DB_DATABASE'] ?? 'keshari_laminates';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Check if admin user already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE email = ?");
    $stmt->execute(['admin@kesharilaminates.com']);
    $exists = $stmt->fetchColumn();
    
    if ($exists > 0) {
        echo "Admin user already exists!\n";
    } else {
        // Create admin user
        $hashedPassword = password_hash('password123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            INSERT INTO admins (name, email, password, role, is_active, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ");
        
        $stmt->execute([
            'Admin',
            'admin@kesharilaminates.com',
            $hashedPassword,
            'super_admin',
            1
        ]);
        
        echo "✅ Admin user created successfully!\n";
        echo "📧 Email: admin@kesharilaminates.com\n";
        echo "🔑 Password: password123\n";
        echo "🔐 Role: Super Admin\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "\nMake sure:\n";
    echo "1. MySQL is running\n";
    echo "2. Database 'keshari_laminates' exists\n";
    echo "3. Database credentials in .env are correct\n";
    echo "4. Run migrations first: php artisan migrate\n";
}