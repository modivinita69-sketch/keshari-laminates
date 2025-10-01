<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Response;

class ThemeController extends Controller
{
    public function css()
    {
        // Generate CSS variables directly
        $themeSettings = \App\Models\ThemeSetting::where('group', 'colors')->get();
        $css = ":root {\n";
        
        foreach ($themeSettings as $setting) {
            $key = str_replace('_', '-', $setting->key);
            $css .= "    --{$key}: {$setting->value};\n";
            
            // Add RGB variables for alpha operations
            $hex = ltrim($setting->value, '#');
            $rgb = array_map('hexdec', str_split($hex, 2));
            $css .= "    --{$key}-rgb: " . implode(", ", $rgb) . ";\n";
        }
        
        $css .= "}\n\n";
        
        // Add the rest of the theme styles
        $css .= file_get_contents(resource_path('views/layouts/theme-colors.blade.php'));
        
        return response($css)
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'no-cache, must-revalidate');
    }
}