<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class DemoProductSeeder extends Seeder
{
    public function run(): void
    {
        // Define demo products with their categories
        $products = [
            [
                'name' => 'Classic Wood Grain Laminate',
                'category_name' => 'Wooden',
                'description' => 'Premium wood grain laminate with natural texture and rich color.',
                'price' => 1499.99,
                'product_code' => 'WGL-001',
                'is_featured' => true,
                'sku' => 'WGL001'
            ],
            [
                'name' => 'Pure White Solid Laminate',
                'category_name' => 'Plain/Solid',
                'description' => 'High-quality solid white laminate for modern interiors.',
                'price' => 999.99,
                'product_code' => 'SWL-001',
                'is_featured' => true,
                'sku' => 'SWL001'
            ],
            [
                'name' => 'Abstract Pattern Laminate',
                'category_name' => 'Abstract',
                'description' => 'Contemporary abstract pattern laminate with unique design.',
                'price' => 1299.99,
                'product_code' => 'APL-001',
                'is_featured' => true,
                'sku' => 'APL001'
            ],
            [
                'name' => 'Premium Bell Laminate',
                'category_name' => 'Bell',
                'description' => 'High-end bell laminate with superior finish.',
                'price' => 1899.99,
                'product_code' => 'BEL-001',
                'is_featured' => true,
                'sku' => 'BEL001'
            ],
            [
                'name' => 'Designer Promica Series',
                'category_name' => 'Promica',
                'description' => 'Designer promica laminate for luxury interiors.',
                'price' => 2499.99,
                'product_code' => 'PRL-001',
                'is_featured' => true,
                'sku' => 'PRL001'
            ]
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', 'LIKE', '%' . $productData['category_name'] . '%')->first();
            
            if ($category) {
                $product = Product::create([
                    'name' => $productData['name'],
                    'category_id' => $category->id,
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'product_code' => $productData['product_code'],
                    'is_featured' => $productData['is_featured'],
                    'sku' => $productData['sku']
                ]);

                // Create a placeholder image for the product
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/products/placeholder-' . strtolower($category->name) . '.jpg',
                    'sort_order' => 0
                ]);
            }
        }
    }
}