<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ThemeSetting;

class ThemeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultColors = [
            'primary_color' => '#ff6b35',
            'secondary_color' => '#f7941d',
            'text_color' => '#333333',
            'link_color' => '#ff6b35',
            'header_bg_color' => '#ff6b35',
            'sidebar_bg_start' => '#ff6b35',
            'sidebar_bg_end' => '#f7941d',
        ];

        foreach ($defaultColors as $key => $value) {
            ThemeSetting::updateOrCreate(
                [
                    'key' => $key,
                    'group' => 'colors'
                ],
                [
                    'value' => $value
                ]
            );
        }
    }
}
