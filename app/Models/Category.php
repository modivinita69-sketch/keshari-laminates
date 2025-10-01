<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'level',
        'path',
        'is_active',
        'sort_order'
    ];

    // Add brands relationship
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_category')
                    ->withTimestamps();
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Hierarchical Relationships
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function descendants()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('descendants');
    }

    public function ancestors()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('ancestors');
    }

    // Scope Methods
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRootCategories($query)
    {
        return $query->whereNull('parent_id')->orderBy('sort_order');
    }

    public function scopeChildrenOf($query, $parentId)
    {
        return $query->where('parent_id', $parentId)->orderBy('sort_order');
    }

    public function scopeAtLevel($query, $level)
    {
        return $query->where('level', $level)->orderBy('sort_order');
    }

    // Helper Methods
    public function isRoot()
    {
        return is_null($this->parent_id);
    }

    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    public function hasProducts()
    {
        return $this->products()->count() > 0;
    }

    public function getAllProducts()
    {
        // Get products from this category and all descendant categories
        $categoryIds = collect([$this->id]);
        $this->collectDescendantIds($categoryIds);
        
        return Product::whereIn('category_id', $categoryIds);
    }

    private function collectDescendantIds($collection)
    {
        $children = $this->children;
        foreach ($children as $child) {
            $collection->push($child->id);
            $child->collectDescendantIds($collection);
        }
    }

    public function getBreadcrumb()
    {
        $breadcrumb = collect();
        $current = $this;
        
        while ($current) {
            $breadcrumb->prepend($current);
            $current = $current->parent;
        }
        
        return $breadcrumb;
    }

    public function getFullName()
    {
        return $this->getBreadcrumb()->pluck('name')->implode(' > ');
    }

    public function updatePath()
    {
        if ($this->parent) {
            $this->path = $this->parent->path ? $this->parent->path . '/' . $this->slug : $this->slug;
            $this->level = $this->parent->level + 1;
        } else {
            $this->path = $this->slug;
            $this->level = 0;
        }
        
        $this->save();
        
        // Update paths for all children
        foreach ($this->children as $child) {
            $child->updatePath();
        }
    }

    // Boot method to automatically update paths
    protected static function boot()
    {
        parent::boot();
        
        static::saved(function ($category) {
            // Only update path if parent_id or slug changed
            if ($category->isDirty(['parent_id', 'slug'])) {
                $category->updatePathOnly();
            }
        });
    }
    
    private function updatePathOnly()
    {
        if ($this->parent) {
            $this->path = $this->parent->path ? $this->parent->path . '/' . $this->slug : $this->slug;
            $this->level = $this->parent->level + 1;
        } else {
            $this->path = $this->slug;
            $this->level = 0;
        }
        
        // Use saveQuietly to avoid triggering boot events
        $this->saveQuietly();
    }
}