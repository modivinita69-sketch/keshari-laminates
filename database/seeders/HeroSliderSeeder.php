<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'image_path' => 'images/slider/laminate-1.jpg',
                'title' => 'Premium Wooden Laminates',
                'subtitle' => 'Discover our extensive collection of wood-finish laminates',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'image_path' => 'images/slider/laminate-2.jpg',
                'title' => 'Modern Abstract Designs',
                'subtitle' => 'Contemporary patterns for modern interiors',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'image_path' => 'images/slider/laminate-3.jpg',
                'title' => 'Solid Color Collection',
                'subtitle' => 'Pure, vibrant colors for minimalist designs',
                'is_active' => true,
                'sort_order' => 3
            ]
        ];

        foreach ($slides as $slide) {
            HeroSlider::create($slide);
        }
    }
}