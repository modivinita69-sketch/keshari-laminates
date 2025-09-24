<?php

require_once 'vendor/autoload.php';

use App\Models\Category;
use App\Models\Product;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Creating hierarchical category structure...\n";

// First, let's create the main category structure
$categoryStructure = [
    'Laminates' => [
        'children' => [
            'Decorative Laminates' => [
                'children' => [
                    'Plain/Solid' => [
                        'description' => 'Premium quality plain and solid colored laminates for modern interiors',
                        'products' => ['Plain White Laminate', 'Solid Black Laminate', 'Cream Color Laminate']
                    ],
                    'Wooden' => [
                        'description' => 'Natural wood finish laminates with authentic textures and patterns',
                        'children' => [
                            'Teak Wood' => ['description' => 'Premium teak wood finish laminates'],
                            'Oak Wood' => ['description' => 'Classic oak wood texture laminates'],
                            'Walnut Wood' => ['description' => 'Rich walnut wood grain laminates']
                        ],
                        'products' => ['Teak Wood Finish', 'Oak Wood Natural', 'Walnut Premium']
                    ],
                    'Abstract' => [
                        'description' => 'Creative abstract patterns and designs for unique interior styling',
                        'children' => [
                            'Geometric Patterns' => ['description' => 'Modern geometric design laminates'],
                            'Artistic Designs' => ['description' => 'Creative and artistic pattern laminates']
                        ],
                        'products' => ['Geometric Lines', 'Abstract Art Design']
                    ]
                ]
            ],
            'Brand Categories' => [
                'children' => [
                    'Bell' => [
                        'description' => 'High-quality Bell brand laminates with superior durability',
                        'products' => ['Bell Premium Series', 'Bell Classic Collection']
                    ],
                    'Promica' => [
                        'description' => 'Premium Promica brand laminates for professional applications',
                        'products' => ['Promica Professional']
                    ]
                ]
            ],
            'Specialty Products' => [
                'children' => [
                    'Decor Plys' => [
                        'description' => 'Decorative plywood with premium finishes for furniture and interiors',
                        'products' => ['Premium Decor Ply']
                    ]
                ]
            ]
        ]
    ]
];

function createCategoryHierarchy($structure, $parentId = null, $level = 0) {
    foreach ($structure as $name => $data) {
        $slug = strtolower(str_replace(['/', ' '], ['-', '-'], $name));
        
        echo str_repeat('  ', $level) . "Creating: $name (Level $level)\n";
        
        // Check if category already exists
        $category = Category::where('slug', $slug)->first();
        
        if (!$category) {
            $category = Category::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $data['description'] ?? "Premium $name category",
                'parent_id' => $parentId,
                'level' => $level,
                'is_active' => true,
                'sort_order' => 1
            ]);
        } else {
            // Update existing category with parent info
            $category->update([
                'parent_id' => $parentId,
                'level' => $level,
                'description' => $data['description'] ?? $category->description
            ]);
        }
        
        // Move existing products to this category if specified
        if (isset($data['products'])) {
            foreach ($data['products'] as $productName) {
                $product = Product::where('name', 'like', "%$productName%")->first();
                if ($product) {
                    $product->update(['category_id' => $category->id]);
                    echo str_repeat('  ', $level + 1) . "Moved product: {$product->name}\n";
                }
            }
        }
        
        // Create children if they exist
        if (isset($data['children'])) {
            createCategoryHierarchy($data['children'], $category->id, $level + 1);
        }
    }
}

try {
    // Create the hierarchical structure
    createCategoryHierarchy($categoryStructure);
    
    // Update paths for all categories
    echo "\nUpdating category paths...\n";
    $rootCategories = Category::rootCategories()->get();
    foreach ($rootCategories as $root) {
        $root->updatePath();
    }
    
    echo "\nHierarchical category structure created successfully!\n";
    echo "\nCategory Tree:\n";
    
    // Display the tree structure
    function displayTree($categories, $level = 0) {
        foreach ($categories as $category) {
            echo str_repeat('  ', $level) . "- {$category->name} (ID: {$category->id}, Level: {$category->level})\n";
            if ($category->children->count() > 0) {
                displayTree($category->children, $level + 1);
            }
        }
    }
    
    $rootCategories = Category::rootCategories()->with('children.children.children')->get();
    displayTree($rootCategories);
    
    echo "\nProducts per category:\n";
    foreach (Category::all() as $category) {
        $productCount = $category->products()->count();
        if ($productCount > 0) {
            echo "- {$category->getFullName()}: $productCount products\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}