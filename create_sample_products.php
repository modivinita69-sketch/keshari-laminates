<?php

// Script to create sample products with demo data
// Run this with: php create_sample_products.php

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
    
    // Get category IDs
    $stmt = $pdo->prepare("SELECT id, name FROM categories ORDER BY id");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($categories)) {
        echo "❌ No categories found! Please run create_categories.php first.\n";
        exit(1);
    }
    
    echo "Found " . count($categories) . " categories.\n";
    
    // Sample products data
    $sampleProducts = [
        // Plain/Solid Laminates
        [
            'name' => 'Premium White Solid Laminate',
            'slug' => 'premium-white-solid-laminate',
            'description' => 'High-quality pure white solid laminate perfect for modern kitchens and offices. Scratch-resistant and easy to clean surface.',
            'product_code' => 'KL-PS-001',
            'thickness' => '0.8mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 450.00,
            'category' => 'Plain/Solid Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Matte',
                'Core Material' => 'Decorative Paper',
                'Backing' => 'Balance Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '10 Years'
            ])
        ],
        [
            'name' => 'Classic Black Solid Laminate',
            'slug' => 'classic-black-solid-laminate',
            'description' => 'Elegant black solid laminate with superior durability. Ideal for contemporary furniture and interior applications.',
            'product_code' => 'KL-PS-002',
            'thickness' => '1.0mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 475.00,
            'category' => 'Plain/Solid Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Glossy',
                'Core Material' => 'Decorative Paper',
                'Backing' => 'Balance Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '10 Years'
            ])
        ],
        [
            'name' => 'Ocean Blue Solid Laminate',
            'slug' => 'ocean-blue-solid-laminate',
            'description' => 'Beautiful ocean blue colored laminate that adds vibrant appeal to any space. Perfect for accent walls and furniture.',
            'product_code' => 'KL-PS-003',
            'thickness' => '0.8mm',
            'dimension' => '8x4 feet',
            'grade' => 'Standard',
            'price' => 420.00,
            'category' => 'Plain/Solid Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Matte',
                'Core Material' => 'Decorative Paper',
                'Backing' => 'Balance Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '8 Years'
            ])
        ],

        // Wooden Laminates
        [
            'name' => 'Natural Oak Wood Laminate',
            'slug' => 'natural-oak-wood-laminate',
            'description' => 'Authentic oak wood grain laminate with natural texture. Perfect for creating warm, traditional interiors.',
            'product_code' => 'KL-WD-001',
            'thickness' => '1.0mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 650.00,
            'category' => 'Wooden Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Textured',
                'Wood Pattern' => 'Oak Grain',
                'Core Material' => 'Decorative Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '12 Years'
            ])
        ],
        [
            'name' => 'Walnut Wood Grain Laminate',
            'slug' => 'walnut-wood-grain-laminate',
            'description' => 'Rich walnut wood pattern laminate with deep grain texture. Ideal for premium furniture and paneling.',
            'product_code' => 'KL-WD-002',
            'thickness' => '1.2mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium Plus',
            'price' => 750.00,
            'category' => 'Wooden Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Deep Textured',
                'Wood Pattern' => 'Walnut Grain',
                'Core Material' => 'High-grade Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '15 Years'
            ])
        ],
        [
            'name' => 'Teak Wood Finish Laminate',
            'slug' => 'teak-wood-finish-laminate',
            'description' => 'Premium teak wood finish laminate with authentic grain pattern. Perfect for luxury interiors and furniture.',
            'product_code' => 'KL-WD-003',
            'thickness' => '1.0mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 680.00,
            'category' => 'Wooden Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Natural Texture',
                'Wood Pattern' => 'Teak Grain',
                'Core Material' => 'Decorative Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '12 Years'
            ])
        ],

        // Abstract Laminates
        [
            'name' => 'Modern Geometric Pattern',
            'slug' => 'modern-geometric-pattern',
            'description' => 'Contemporary geometric pattern laminate with bold design elements. Perfect for modern commercial spaces.',
            'product_code' => 'KL-AB-001',
            'thickness' => '0.8mm',
            'dimension' => '8x4 feet',
            'grade' => 'Designer',
            'price' => 580.00,
            'category' => 'Abstract Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Matte',
                'Pattern Type' => 'Geometric',
                'Design Category' => 'Contemporary',
                'Fire Rating' => 'Class 1',
                'Warranty' => '10 Years'
            ])
        ],
        [
            'name' => 'Marble Texture Abstract',
            'slug' => 'marble-texture-abstract',
            'description' => 'Elegant marble texture laminate with abstract veining. Ideal for countertops and premium applications.',
            'product_code' => 'KL-AB-002',
            'thickness' => '1.0mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 720.00,
            'category' => 'Abstract Laminates',
            'specifications' => json_encode([
                'Surface Finish' => 'Glossy',
                'Pattern Type' => 'Marble Veined',
                'Design Category' => 'Luxury',
                'Fire Rating' => 'Class 1',
                'Warranty' => '12 Years'
            ])
        ],

        // Bell Laminates
        [
            'name' => 'Bell Premium Gloss White',
            'slug' => 'bell-premium-gloss-white',
            'description' => 'Bell brand premium gloss white laminate with superior finish quality. Industry-leading durability and shine.',
            'product_code' => 'BL-PG-001',
            'thickness' => '0.8mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 520.00,
            'category' => 'Bell Laminates',
            'specifications' => json_encode([
                'Brand' => 'Bell',
                'Surface Finish' => 'High Gloss',
                'Core Material' => 'Premium Paper',
                'Fire Rating' => 'Class 1',
                'Warranty' => '12 Years'
            ])
        ],
        [
            'name' => 'Bell Wood Grain Maple',
            'slug' => 'bell-wood-grain-maple',
            'description' => 'Bell brand maple wood grain laminate with authentic texture. Perfect for furniture and interior applications.',
            'product_code' => 'BL-WG-002',
            'thickness' => '1.0mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 680.00,
            'category' => 'Bell Laminates',
            'specifications' => json_encode([
                'Brand' => 'Bell',
                'Surface Finish' => 'Wood Textured',
                'Wood Pattern' => 'Maple Grain',
                'Fire Rating' => 'Class 1',
                'Warranty' => '15 Years'
            ])
        ],

        // Promica Laminates
        [
            'name' => 'Promica High Gloss Black',
            'slug' => 'promica-high-gloss-black',
            'description' => 'Promica brand high gloss black laminate with mirror-like finish. Premium quality for luxury applications.',
            'product_code' => 'PR-HG-001',
            'thickness' => '1.0mm',
            'dimension' => '8x4 feet',
            'grade' => 'Luxury',
            'price' => 850.00,
            'category' => 'Promica Laminates',
            'specifications' => json_encode([
                'Brand' => 'Promica',
                'Surface Finish' => 'Mirror Gloss',
                'Core Material' => 'Premium Grade',
                'Fire Rating' => 'Class 1',
                'Warranty' => '20 Years'
            ])
        ],

        // Decor Plys
        [
            'name' => 'Premium Decor Ply Natural',
            'slug' => 'premium-decor-ply-natural',
            'description' => 'High-quality decorative plywood with natural wood veneer. Perfect for furniture and interior paneling.',
            'product_code' => 'DP-NAT-001',
            'thickness' => '6mm',
            'dimension' => '8x4 feet',
            'grade' => 'Premium',
            'price' => 1200.00,
            'category' => 'Decor Plys',
            'specifications' => json_encode([
                'Material' => 'Decorative Plywood',
                'Veneer Type' => 'Natural Wood',
                'Core' => 'Hardwood',
                'Grade' => 'BWR',
                'Warranty' => '10 Years'
            ])
        ]
    ];
    
    // Check if products already exist
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM products");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        echo "Products already exist! ($count products found)\n";
        echo "Do you want to add more products? (Current products will remain)\n";
    }
    
    // Create category ID mapping
    $categoryMap = [];
    foreach ($categories as $cat) {
        $categoryMap[$cat['name']] = $cat['id'];
    }
    
    // Insert products
    $stmt = $pdo->prepare("
        INSERT INTO products (name, slug, description, product_code, thickness, dimension, grade, price, category_id, is_active, sort_order, specifications, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");
    
    $inserted = 0;
    foreach ($sampleProducts as $index => $product) {
        // Check if category exists
        if (!isset($categoryMap[$product['category']])) {
            echo "⚠️ Category '{$product['category']}' not found, skipping {$product['name']}\n";
            continue;
        }
        
        // Check if product already exists
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE product_code = ?");
        $checkStmt->execute([$product['product_code']]);
        if ($checkStmt->fetchColumn() > 0) {
            echo "⚠️ Product {$product['product_code']} already exists, skipping\n";
            continue;
        }
        
        $stmt->execute([
            $product['name'],
            $product['slug'],
            $product['description'],
            $product['product_code'],
            $product['thickness'],
            $product['dimension'],
            $product['grade'],
            $product['price'],
            $categoryMap[$product['category']],
            1, // is_active
            $index + 1, // sort_order
            $product['specifications']
        ]);
        $inserted++;
        echo "✅ Added: " . $product['name'] . " (" . $product['product_code'] . ")\n";
    }
    
    echo "\n🎉 Successfully created $inserted sample products!\n";
    echo "\nProducts created by category:\n";
    
    // Show summary
    foreach ($categories as $cat) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = ?");
        $stmt->execute([$cat['id']]);
        $productCount = $stmt->fetchColumn();
        echo "📁 {$cat['name']}: $productCount products\n";
    }
    
    echo "\n🌐 Your website now has dynamic product data!\n";
    echo "Visit: http://127.0.0.1:8002 to see the products\n";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}