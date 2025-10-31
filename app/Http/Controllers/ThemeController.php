<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Response;

class ThemeController extends Controller
{
    public function css()
    {
        // Get theme settings or use defaults
        $themeSettings = \App\Models\ThemeSetting::where('group', 'colors')->get();
        
        if ($themeSettings->isEmpty()) {
            $themeSettings = collect([
                (object)[
                    'key' => 'primary_color',
                    'value' => '#F97316'
                ],
                (object)[
                    'key' => 'secondary_color',
                    'value' => '#FB923C'
                ]
            ]);
        }
        
        // Generate version string
        $version = md5(serialize($themeSettings));
        
        // Set cache headers
        $etag = '"' . $version . '"';
        
        if (request()->header('If-None-Match') === $etag) {
            return response()->noContent(304);
        }
        
        $css = "/* Theme version: {$version} */\n:root {\n";
        
        foreach ($themeSettings as $setting) {
            $key = str_replace('_', '-', $setting->key);
            $css .= "    --{$key}: {$setting->value};\n";
            
            // Add RGB variables for alpha operations
            $hex = ltrim($setting->value, '#');
            $rgb = array_map('hexdec', str_split($hex, 2));
            $css .= "    --{$key}-rgb: " . implode(", ", $rgb) . ";\n";
            
            // Add aliases for backward compatibility
            if ($key === 'primary-color') {
                $css .= "    --primary-orange: {$setting->value};\n";
            }
            if ($key === 'secondary-color') {
                $css .= "    --secondary-orange: {$setting->value};\n";
            }
        }
        
        $css .= "}\n\n";
        
        // Add the custom theme styles
        $css .= file_get_contents(resource_path('views/layouts/theme-colors.blade.php'));
        
        return response($css)
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'no-cache, must-revalidate');
    }
}