<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('categories')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.brands.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'logo' => 'nullable|image|max:1024',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'is_active' => 'boolean'
        ]);

        $brand = new Brand();
        $brand->name = $validated['name'];
        $brand->slug = Str::slug($validated['name']);
        $brand->description = $validated['description'];
        $brand->is_active = $request->boolean('is_active', true);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('brands', 'public');
            $brand->logo = $path;
        }

        $brand->save();
        $brand->categories()->sync($validated['categories']);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand created successfully');
    }

    public function edit(Brand $brand)
    {
        $categories = Category::orderBy('name')->get();
        $selectedCategories = $brand->categories->pluck('id')->toArray();
        
        return view('admin.brands.edit', compact('brand', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'logo' => 'nullable|image|max:1024',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'is_active' => 'boolean'
        ]);

        $brand->name = $validated['name'];
        $brand->description = $validated['description'];
        $brand->is_active = $request->boolean('is_active', true);

        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $path = $request->file('logo')->store('brands', 'public');
            $brand->logo = $path;
        }

        $brand->save();
        $brand->categories()->sync($validated['categories']);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }
        
        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully');
    }
}