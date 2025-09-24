<?php

// Simple script to create sample categories
// Run this with: php create_categories.php

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
    
    $categories = [
        [
            'name' => 'Plain/Solid Laminates',
            'slug' => 'plain-solid-laminates',
            'description' => 'Premium quality plain and solid colored laminates for modern interiors',
            'is_active' => 1,
            'sort_order' => 1,
        ],
        [
            'name' => 'Wooden Laminates',
            'slug' => 'wooden-laminates',
            'description' => 'Natural wood finish laminates with authentic textures and patterns',
            'is_active' => 1,
            'sort_order' => 2,
        ],
        [
            'name' => 'Abstract Laminates',
            'slug' => 'abstract-laminates',
            'description' => 'Creative abstract patterns and designs for unique interior styling',
            'is_active' => 1,
            'sort_order' => 3,
        ],
        [
            'name' => 'Decor Plys',
            'slug' => 'decor-plys',
            'description' => 'Decorative plywood with premium finishes for furniture and interiors',
            'is_active' => 1,
            'sort_order' => 4,
        ],
        [
            'name' => 'Bell Laminates',
            'slug' => 'bell-laminates',
            'description' => 'High-quality Bell brand laminates with superior durability',
            'is_active' => 1,
            'sort_order' => 5,
        ],
        [
            'name' => 'Promica Laminates',
            'slug' => 'promica-laminates',
            'description' => 'Premium Promica brand laminates for professional applications',
            'is_active' => 1,
            'sort_order' => 6,
        ],
    ];
    
    // Check if categories already exist
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        echo "Categories already exist! ($count categories found)\n";
    } else {
        // Insert categories
        $stmt = $pdo->prepare("
            INSERT INTO categories (name, slug, description, is_active, sort_order, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ");
        
        $inserted = 0;
        foreach ($categories as $category) {
            $stmt->execute([
                $category['name'],
                $category['slug'],
                $category['description'],
                $category['is_active'],
                $category['sort_order']
            ]);
            $inserted++;
        }
        
        echo "✅ $inserted categories created successfully!\n";
        foreach ($categories as $category) {
            echo "📁 " . $category['name'] . "\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}