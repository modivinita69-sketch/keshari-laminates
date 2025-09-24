<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCatalog;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)
            ->with(['images' => function($q) {
                $q->where('is_primary', true);
            }, 'category.parent']);

        $selected_category = null;
        $breadcrumbs = collect();

        // Filter by category if specified (supports hierarchical paths)
        if ($request->category && $request->category !== 'all') {
            $category = Category::where('path', $request->category)
                ->orWhere('slug', $request->category)
                ->where('is_active', true)
                ->first();

            if ($category) {
                $selected_category = $category;
                $breadcrumbs = $category->getBreadcrumb();
                
                // Get products from this category and all its descendants
                $categoryIds = collect([$category->id]);
                $this->collectDescendantIds($category, $categoryIds);
                
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Search functionality
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('product_code', 'LIKE', "%{$search}%");
            });
        }

        // Sort by price if specified
        if ($request->sort === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('sort_order')->orderBy('name');
        }

        $products = $query->paginate(12);

        // Get all categories for filter dropdown (only leaf categories with products)
        $categories = Category::where('is_active', true)
            ->whereHas('products')
            ->with('parent')
            ->orderBy('sort_order')
            ->get();

        // Get root categories for navigation
        $root_categories = Category::where('is_active', true)
            ->rootCategories()
            ->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->get();

        return view('products', compact('products', 'categories', 'root_categories', 'selected_category', 'breadcrumbs'));
    }

    private function collectDescendantIds($category, $collection)
    {
        $children = Category::where('parent_id', $category->id)->get();
        foreach ($children as $child) {
            $collection->push($child->id);
            $this->collectDescendantIds($child, $collection);
        }
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['images', 'category', 'catalogs'])
            ->firstOrFail();

        // Get related products from the same category
        $related_products = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['images' => function($q) {
                $q->where('is_primary', true);
            }])
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'related_products'));
    }

    public function category($path)
    {
        $category = Category::where('path', $path)
            ->orWhere('slug', $path)
            ->where('is_active', true)
            ->firstOrFail();

        // Get breadcrumbs
        $breadcrumbs = $category->getBreadcrumb();

        // Get products from this category and all descendants
        $categoryIds = collect([$category->id]);
        $this->collectDescendantIds($category, $categoryIds);

        $products = Product::where('is_active', true)
            ->whereIn('category_id', $categoryIds)
            ->with(['images' => function($q) {
                $q->where('is_primary', true);
            }, 'category'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        // Get all categories for navigation
        $categories = Category::where('is_active', true)
            ->whereHas('products')
            ->with('parent')
            ->orderBy('sort_order')
            ->get();

        // Get root categories for navigation
        $root_categories = Category::where('is_active', true)
            ->rootCategories()
            ->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->get();

        return view('products', compact('products', 'categories', 'root_categories', 'category', 'breadcrumbs'));
    }

    public function downloadCatalog($id)
    {
        $catalog = ProductCatalog::findOrFail($id);
        $catalog->incrementDownloads();

        $file_path = storage_path('app/public/' . $catalog->catalog_path);
        
        if (file_exists($file_path)) {
            return response()->download($file_path, $catalog->catalog_name);
        }
        
        return redirect()->back()->with('error', 'Catalog not found');
    }
}