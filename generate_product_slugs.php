<?php

// Simple script to generate slugs for existing products
// Run this with: php generate_product_slugs.php

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

function generateSlug($text) {
    // Convert to lowercase and replace special characters
    $slug = strtolower(trim($text));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
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
    
    // Get all products that don't have slugs or have empty slugs
    $stmt = $pdo->query("SELECT id, name, slug FROM products WHERE slug IS NULL OR slug = ''");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Found " . count($products) . " products without slugs.\n";
    
    $updated = 0;
    foreach ($products as $product) {
        $slug = generateSlug($product['name']);
        
        // Check if slug already exists and make it unique
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE slug = ? AND id != ?");
        $checkStmt->execute([$slug, $product['id']]);
        $count = $checkStmt->fetchColumn();
        
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        
        // Update the product with the new slug
        $updateStmt = $pdo->prepare("UPDATE products SET slug = ? WHERE id = ?");
        $updateStmt->execute([$slug, $product['id']]);
        
        echo "  - Updated: '{$product['name']}' → slug: '$slug'\n";
        $updated++;
    }
    
    echo "\n✅ Successfully updated $updated product slugs!\n";
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}