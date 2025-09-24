<?php

require_once 'vendor/autoload.php';

use App\Models\Category;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Fixing hierarchical category structure...\n";

try {
    // Get the root and parent categories
    $laminate = Category::where('slug', 'laminates')->first();
    $decorative = Category::where('slug', 'decorative-laminates')->first();
    $brands = Category::where('slug', 'brand-categories')->first();
    
    if (!$laminate || !$decorative || !$brands) {
        echo "Missing parent categories. Exiting.\n";
        exit;
    }
    
    // Update existing leaf categories to be children of decorative
    $decorativeChildren = [
        'plain-solid-laminates' => 'plain-solid',
        'wooden-laminates' => 'wooden', 
        'abstract-laminates' => 'abstract'
    ];
    
    foreach ($decorativeChildren as $originalSlug => $newSlug) {
        $category = Category::where('slug', $originalSlug)->first();
        if ($category) {
            $category->update([
                'slug' => $newSlug,
                'parent_id' => $decorative->id,
                'level' => 2,
                'path' => "laminates/decorative-laminates/{$newSlug}"
            ]);
            echo "Updated: {$category->name} -> parent: Decorative Laminates\n";
        }
    }
    
    // Update brand categories
    $brandChildren = [
        'bell-laminates' => 'bell',
        'promica-laminates' => 'promica'
    ];
    
    foreach ($brandChildren as $originalSlug => $newSlug) {
        $category = Category::where('slug', $originalSlug)->first();
        if ($category) {
            $category->update([
                'slug' => $newSlug,
                'parent_id' => $brands->id,
                'level' => 2,
                'path' => "laminates/brand-categories/{$newSlug}"
            ]);
            echo "Updated: {$category->name} -> parent: Brand Categories\n";
        }
    }
    
    // Update Decor Plys to correct slug
    $decorPly = Category::where('name', 'like', '%Decor Ply%')->first();
    if ($decorPly) {
        $decorPly->update([
            'slug' => 'decor-plys',
            'parent_id' => $laminate->id,
            'level' => 1,
            'path' => 'laminates/decor-plys'
        ]);
        echo "Updated: {$decorPly->name} -> parent: Laminates\n";
    }
    
    echo "\nFinal Category Tree:\n";
    $rootCategories = Category::whereNull('parent_id')->orderBy('sort_order')->get();
    
    function displayTree($categories, $level = 0) {
        foreach ($categories as $category) {
            $productCount = $category->products()->count();
            echo str_repeat('  ', $level) . "- {$category->name} (Products: $productCount, Path: {$category->path})\n";
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