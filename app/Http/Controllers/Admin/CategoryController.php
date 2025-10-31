<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['parent', 'children'])
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        // Group by level for display
        $categoryTree = Category::whereNull('parent_id')
            ->with(['children.children.children'])
            ->orderBy('sort_order')
            ->get();

        return view('admin.categories.index', compact('categories', 'categoryTree'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
            ->orWhere('level', '<', 3) // Limit nesting depth
            ->with('children')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        return view('admin.categories.create', compact('parentCategories'));
    }

    private function handleImage($image)
    {
        // Generate a unique file name
        $fileName = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
        
        // Ensure the directory exists
        $path = public_path('images/categories');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }
        
        // Move the file to the destination path
        $image->move($path, $fileName);
        
        return 'images/categories/' . $fileName;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Set level based on parent
        if ($data['parent_id']) {
            $parent = Category::find($data['parent_id']);
            $data['level'] = $parent->level + 1;
        } else {
            $data['level'] = 0;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $data['image'] = $this->handleImage($request->file('image'));
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to upload image. Please try again.');
            }
        }

        $category = Category::create($data);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        $category->load(['parent', 'children.products', 'products']);
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('id', '!=', $category->id)
            ->where(function($query) use ($category) {
                $query->whereNull('parent_id')
                      ->orWhere('level', '<', $category->level);
            })
            ->with('children')
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Set level based on parent
        if ($data['parent_id']) {
            $parent = Category::find($data['parent_id']);
            $data['level'] = $parent->level + 1;
        } else {
            $data['level'] = 0;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists
                if ($category->image && File::exists(public_path($category->image))) {
                    File::delete(public_path($category->image));
                }

                $data['image'] = $this->handleImage($request->file('image'));
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to upload image. Please try again.');
            }
        }

        $category->update($data);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if category has children or products
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with child categories.');
        }

        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with products.');
        }

        // Delete category image if exists
        if ($category->image && File::exists(public_path($category->image))) {
            File::delete(public_path($category->image));
        }

        $category->delete();
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function getChildren(Request $request)
    {
        $parentId = $request->get('parent_id');
        $children = Category::where('parent_id', $parentId)
            ->orderBy('sort_order')
            ->get(['id', 'name']);
        
        return response()->json($children);
    }
}
