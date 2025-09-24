<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Admin;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_categories' => Category::count(),
            'active_categories' => Category::active()->count(),
            'total_admins' => Admin::count(),
        ];

        $recent_products = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_products'));
    }
}