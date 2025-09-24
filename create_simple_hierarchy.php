<?php

require_once 'vendor/autoload.php';

use App\Models\Category;
use App\Models\Product;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Creating hierarchical category structure...\n";

try {
    // Clear existing parent relationships first
    Category::query()->update([
        'parent_id' => null,
        'level' => 0,
        'path' => null
    ]);
    
    echo "Cleared existing hierarchical relationships.\n";
    
    // Create root category
    $laminate = Category::updateOrCreate(
        ['slug' => 'laminates'],
        [
            'name' => 'Laminates',
            'description' => 'All types of premium laminates',
            'parent_id' => null,
            'level' => 0,
            'path' => 'laminates',
            'is_active' => true,
            'sort_order' => 1
        ]
    );
    echo "Created root: Laminates (ID: {$laminate->id})\n";
    
    // Create decorative laminates parent
    $decorative = Category::updateOrCreate(
        ['slug' => 'decorative-laminates'],
        [
            'name' => 'Decorative Laminates',
            'description' => 'Decorative finish laminates for interior design',
            'parent_id' => $laminate->id,
            'level' => 1,
            'path' => 'laminates/decorative-laminates',
            'is_active' => true,
            'sort_order' => 1
        ]
    );
    echo "Created: Decorative Laminates (ID: {$decorative->id})\n";
    
    // Update existing categories to be children of decorative
    $existingCategories = [
        'plain-solid' => 'Plain/Solid',
        'wooden' => 'Wooden',
        'abstract' => 'Abstract'
    ];
    
    $level2Categories = [];
    foreach ($existingCategories as $slug => $name) {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->update([
                'parent_id' => $decorative->id,
                'level' => 2,
                'path' => "laminates/decorative-laminates/{$slug}"
            ]);
            $level2Categories[$slug] = $category;
            echo "Updated: {$name} (ID: {$category->id}) as child of Decorative\n";
        }
    }
    
    // Create brand categories
    $brands = Category::updateOrCreate(
        ['slug' => 'brand-categories'],
        [
            'name' => 'Brand Categories',
            'description' => 'Premium brand laminates',
            'parent_id' => $laminate->id,
            'level' => 1,
            'path' => 'laminates/brand-categories',
            'is_active' => true,
            'sort_order' => 2
        ]
    );
    echo "Created: Brand Categories (ID: {$brands->id})\n";
    
    // Update Bell and Promica as brand children
    $brandCategories = ['bell' => 'Bell', 'promica' => 'Promica'];
    foreach ($brandCategories as $slug => $name) {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->update([
                'parent_id' => $brands->id,
                'level' => 2,
                'path' => "laminates/brand-categories/{$slug}"
            ]);
            echo "Updated: {$name} (ID: {$category->id}) as brand child\n";
        }
    }
    
    // Update Decor Plys
    $decorPly = Category::where('slug', 'decor-plys')->first();
    if ($decorPly) {
        $decorPly->update([
            'parent_id' => $laminate->id,
            'level' => 1,
            'path' => 'laminates/decor-plys'
        ]);
        echo "Updated: Decor Plys (ID: {$decorPly->id}) as direct child of Laminates\n";
    }
    
    // Create some sub-categories for wooden laminates
    if (isset($level2Categories['wooden'])) {
        $wooden = $level2Categories['wooden'];
        
        $woodTypes = [
            ['name' => 'Teak Wood', 'slug' => 'teak-wood'],
            ['name' => 'Oak Wood', 'slug' => 'oak-wood'],
            ['name' => 'Walnut Wood', 'slug' => 'walnut-wood']
        ];
        
        foreach ($woodTypes as $wood) {
            $woodCategory = Category::updateOrCreate(
                ['slug' => $wood['slug']],
                [
                    'name' => $wood['name'],
                    'description' => "Premium {$wood['name']} finish laminates",
                    'parent_id' => $wooden->id,
                    'level' => 3,
                    'path' => "laminates/decorative-laminates/wooden/{$wood['slug']}",
                    'is_active' => true,
                    'sort_order' => 1
                ]
            );
            echo "Created: {$wood['name']} (ID: {$woodCategory->id}) as wooden sub-category\n";
        }
    }
    
    echo "\nHierarchical category structure created successfully!\n";
    
    // Display the tree
    echo "\nCategory Tree:\n";
    $rootCategories = Category::whereNull('parent_id')->orderBy('sort_order')->get();
    
    function displayTree($categories, $level = 0) {
        foreach ($categories as $category) {
            $productCount = $category->products()->count();
            echo str_repeat('  ', $level) . "- {$category->name} (ID: {$category->id}, Products: $productCount)\n";
            $children = Category::where('parent_id', $category->id)->orderBy('sort_order')->get();
            if ($children->count() > 0) {
                displayTree($children, $level + 1);
            }
        }
    }
    
    displayTree($rootCategories);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}