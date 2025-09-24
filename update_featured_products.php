<?php

// Simple script to mark some products as featured
// Run this with: php update_featured_products.php

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
    
    // Mark the first 3 products as featured
    $stmt = $pdo->prepare("UPDATE products SET is_featured = 1 WHERE id IN (1, 2, 3)");
    $result = $stmt->execute();
    $affected = $stmt->rowCount();
    
    echo "✅ Updated $affected products as featured!\n";
    
    // Show featured products
    $stmt = $pdo->query("SELECT id, name, is_featured FROM products WHERE is_featured = 1");
    $featuredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n🌟 Featured Products:\n";
    foreach ($featuredProducts as $product) {
        echo "  - ID: {$product['id']}, Name: {$product['name']}\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}