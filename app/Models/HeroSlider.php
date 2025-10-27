<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = [
        'image_path',
        'title',
        'subtitle',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public static function getActiveSlides()
    {
        return self::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }
}