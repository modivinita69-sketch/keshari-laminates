<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::with(['category.parent']);

        // Filter by category if specified
        if (request('category_id')) {
            $query->where('category_id', request('category_id'));
        }

        // Search functionality
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get all categories for the filter dropdown
        $categories = Category::with('parent')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        // Get all categories for product assignment
        $categories = Category::with('parent')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'product_code' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'specifications' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['images']);
        
        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
            // Ensure uniqueness
            $count = Product::where('slug', 'like', $data['slug'] . '%')->count();
            if ($count > 0) {
                $data['slug'] = $data['slug'] . '-' . ($count + 1);
            }
        }

        $product = Product::create($data);
        
        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('products', 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => $index + 1,
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load(['category.parent', 'images', 'catalogs']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Get all categories for product assignment
        $categories = Category::with('parent')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'product_code' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'specifications' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['images']);
        $product->update($data);
        
        // Handle new image uploads
        if ($request->hasFile('images')) {
            $existingImageCount = $product->images()->count();
            
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('products', 'public');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => $existingImageCount + $index + 1,
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete product images from storage
        foreach ($product->images as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function deleteImage(ProductImage $image)
    {
        // Delete the file from storage
        Storage::delete('public/' . $image->image_path);
        
        // Delete the database record
        $image->delete();

        return response()->json(['success' => true]);
    }
}
