<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Marino',
                'description' => 'Premium quality laminates with Italian designs and finishes.',
                'is_active' => true,
                'categories' => ['Wooden Laminates', 'Designer Laminates']
            ],
            [
                'name' => 'Greenlam',
                'description' => 'Eco-friendly and sustainable laminate solutions.',
                'is_active' => true,
                'categories' => ['Wooden Laminates', 'Kitchen Laminates']
            ],
            [
                'name' => 'Merino',
                'description' => 'High-quality decorative laminates with modern aesthetics.',
                'is_active' => true,
                'categories' => ['Wooden Laminates', 'Designer Laminates', 'Kitchen Laminates']
            ],
            [
                'name' => 'Century Laminates',
                'description' => 'Traditional and contemporary laminate designs for every space.',
                'is_active' => true,
                'categories' => ['Wooden Laminates', 'Office Laminates']
            ],
            [
                'name' => 'Royal Touch',
                'description' => 'Luxury laminate collections with royal finishes.',
                'is_active' => true,
                'categories' => ['Designer Laminates', 'Premium Laminates']
            ]
        ];

        foreach ($brands as $brandData) {
            $brand = Brand::create([
                'name' => $brandData['name'],
                'slug' => \Str::slug($brandData['name']),
                'description' => $brandData['description'],
                'is_active' => $brandData['is_active']
            ]);

            // Find categories and attach them to the brand
            foreach ($brandData['categories'] as $categoryName) {
                $category = Category::where('name', 'like', "%{$categoryName}%")->first();
                if ($category) {
                    $brand->categories()->attach($category->id);
                }
            }

            // Create dummy logo for the brand
            $this->createDummyLogo($brand);
        }

        $this->command->info('Brands created successfully!');
    }

    private function createDummyLogo(Brand $brand)
    {
        // Create a colored background with text as logo
        $width = 200;
        $height = 200;
        $image = imagecreatetruecolor($width, $height);
        
        // Generate a random pastel color for background
        $red = mt_rand(150, 255);
        $green = mt_rand(150, 255);
        $blue = mt_rand(150, 255);
        $color = imagecolorallocate($image, $red, $green, $blue);
        
        // Fill background
        imagefill($image, 0, 0, $color);
        
        // Add text
        $textColor = imagecolorallocate($image, 50, 50, 50);
        $text = strtoupper($brand->name);
        
        // Calculate text position
        $font = 5; // Built-in font size (1-5)
        $textWidth = strlen($text) * imagefontwidth($font);
        $textHeight = imagefontheight($font);
        $centerX = ($width - $textWidth) / 2;
        $centerY = ($height - $textHeight) / 2;
        
        // Draw text
        imagestring($image, $font, $centerX, $centerY, $text, $textColor);
        
        // Ensure storage directory exists
        if (!Storage::disk('public')->exists('brands')) {
            Storage::disk('public')->makeDirectory('brands');
        }
        
        // Save image
        $filename = 'brands/' . \Str::slug($brand->name) . '.png';
        $filepath = storage_path('app/public/' . $filename);
        imagepng($image, $filepath);
        imagedestroy($image);
        
        // Update brand with logo path
        $brand->update(['logo' => $filename]);
    }
}