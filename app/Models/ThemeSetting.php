<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function getThemeColors()
    {
        $defaults = [
            'primary_color' => '#ff6b35',
            'secondary_color' => '#f7941d',
            'text_color' => '#333333',
            'link_color' => '#ff6b35',
            'header_bg_color' => '#ff6b35',
            'sidebar_bg_start' => '#ff6b35',
            'sidebar_bg_end' => '#f7941d',
        ];

        $settings = self::where('group', 'colors')->pluck('value', 'key')->toArray();
        
        return array_merge($defaults, $settings);
    }

    /**
     * Generate CSS variables for theme colors.
     *
     * @return string
     */
    public static function generateCssVariables()
    {
        $colors = self::getThemeColors();
        $css = ":root {\n";
        
        foreach ($colors as $key => $value) {
            $css .= "    --" . str_replace('_', '-', $key) . ": " . $value . ";\n";
            
            // Add RGB variables for alpha operations
            $hex = ltrim($value, '#');
            $rgb = array_map('hexdec', str_split($hex, 2));
            $css .= "    --" . str_replace('_', '-', $key) . "-rgb: " . implode(", ", $rgb) . ";\n";
        }
        
        $css .= "}\n";
        return $css;
    }
}