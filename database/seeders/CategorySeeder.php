<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Plain/Solid Laminates',
                'slug' => 'plain-solid-laminates',
                'description' => 'Premium quality plain and solid colored laminates for modern interiors',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Wooden Laminates',
                'slug' => 'wooden-laminates',
                'description' => 'Natural wood finish laminates with authentic textures and patterns',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Abstract Laminates',
                'slug' => 'abstract-laminates',
                'description' => 'Creative abstract patterns and designs for unique interior styling',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Decor Plys',
                'slug' => 'decor-plys',
                'description' => 'Decorative plywood with premium finishes for furniture and interiors',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Bell Laminates',
                'slug' => 'bell-laminates',
                'description' => 'High-quality Bell brand laminates with superior durability',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Promica Laminates',
                'slug' => 'promica-laminates',
                'description' => 'Premium Promica brand laminates for professional applications',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        echo "Product categories created successfully!\n";
    }
}