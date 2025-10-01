<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Admin;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', true)->count(),
            'root_categories' => Category::whereNull('parent_id')->count(),
            'leaf_categories' => Category::whereHas('products')->count(),
            'total_admins' => Admin::count(),
            'company_info_entries' => CompanyInfo::count(),
            'total_brands' => \App\Models\Brand::count(),
            'active_brands' => \App\Models\Brand::where('is_active', true)->count(),
        ];

        // Get recent products
        $recent_products = Product::with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get category tree for overview
        $category_tree = Category::whereNull('parent_id')
            ->with(['children.children.products'])
            ->orderBy('sort_order')
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_products', 'category_tree'));
    }
}
