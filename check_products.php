<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=keshari_laminates', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query('SELECT id, name, slug FROM products LIMIT 5');
    
    echo "Product URLs for testing:\n";
    echo "========================\n";
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "• {$row['name']}\n";
        echo "  URL: http://127.0.0.1:8000/products/{$row['slug']}\n\n";
    }
    
} catch(PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>