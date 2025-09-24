<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'product_code',
        'sku',
        'thickness',
        'dimension',
        'grade',
        'price',
        'category_id',
        'is_active',
        'is_featured',
        'sort_order',
        'specifications'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'specifications' => 'array',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                // Ensure uniqueness
                $count = static::where('slug', 'like', $product->slug . '%')->count();
                if ($count > 0) {
                    $product->slug = $product->slug . '-' . ($count + 1);
                }
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                // Ensure uniqueness
                $count = static::where('slug', 'like', $product->slug . '%')
                    ->where('id', '!=', $product->id)
                    ->count();
                if ($count > 0) {
                    $product->slug = $product->slug . '-' . ($count + 1);
                }
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function catalogs()
    {
        return $this->hasMany(ProductCatalog::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}