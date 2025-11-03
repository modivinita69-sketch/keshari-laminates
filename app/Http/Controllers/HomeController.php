<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\HeroSlider;
use App\Models\Catalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get hero slider images
        $hero_slides = HeroSlider::getActiveSlides();

        // Get featured products with their primary images and categories
        $featured_products = Product::where('is_active', true)
            ->with(['images' => function($query) {
                $query->where('is_primary', true);
            }, 'category'])
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        // Get root categories and their children for display
        $categories = Category::where('is_active', true)
            ->rootCategories()
            ->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->get();

        // Get only leaf categories (categories with products) for quick navigation
        $leaf_categories = Category::where('is_active', true)
            ->whereHas('products')
            ->with('parent')
            ->orderBy('sort_order')
            ->get();

        // Get active brands
        $brands = \App\Models\Brand::where('is_active', true)
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get active catalogs
        $catalogs = Catalog::where('is_active', true)
            ->latest()
            ->get();

        // Get company information (with fallbacks)
        $company_info = [
            'about_us' => CompanyInfo::getValue('about_us', 'Keshari Laminates - Your trusted partner in quality laminates'),
            'hero_title' => CompanyInfo::getValue('hero_title', 'Premium Quality Laminates'),
            'hero_subtitle' => CompanyInfo::getValue('hero_subtitle', 'Wholesale distributor of premium laminates, bells, promica, and decor plys'),
        ];

        return view('welcome', compact('featured_products', 'categories', 'leaf_categories', 'company_info', 'brands', 'hero_slides', 'catalogs'));
    }

    public function about()
    {
        $company_info = [
            'about_us' => CompanyInfo::getValue('about_us', 'We are a leading wholesale distributor of premium quality laminates, serving customers with excellence for over a decade.'),
            'mission' => CompanyInfo::getValue('mission', 'To provide premium quality laminates at competitive wholesale prices.'),
            'vision' => CompanyInfo::getValue('vision', 'To be the most trusted wholesale distributor of laminates.'),
            'experience' => CompanyInfo::getValue('experience', 'Over 15 years of experience in the laminate industry.'),
        ];

        return view('about', compact('company_info'));
    }

    public function contact()
    {
        $contact_info = [
            'address' => CompanyInfo::getValue('address', 'Industrial Area, Your City, State - 123456'),
            'phone' => CompanyInfo::getValue('phone', '+91 98765 43210'),
            'email' => CompanyInfo::getValue('email', 'info@kesharilaminates.com'),
            'business_hours' => CompanyInfo::getValue('business_hours', 'Monday - Saturday: 9:00 AM - 6:00 PM'),
        ];

        return view('contact', compact('contact_info'));
    }
}