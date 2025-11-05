<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::latest()->get();
        return view('admin.catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('admin.catalogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'catalog_file' => 'required|mimes:pdf|max:10240', // max 10MB
            'thumbnail' => 'nullable|image|max:2048', // max 2MB
            'is_active' => 'boolean',
        ]);

        $catalog = new Catalog();
        $catalog->title = $request->title;
        $catalog->description = $request->description;
        $catalog->is_active = $request->boolean('is_active', true);

        if ($request->hasFile('catalog_file')) {
            $file = $request->file('catalog_file');
            $path = $file->store('catalogs', 'public');
            $catalog->file_path = $path;
        }

        if ($request->hasFile('thumbnail')) {
           $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('storage/catalog-thumbnails'), $filename);
            $catalog->thumbnail_path = 'catalog-thumbnails/' . $filename;
        }

        $catalog->save();

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog created successfully.');
    }

    public function edit(Catalog $catalog)
    {
        return view('admin.catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'catalog_file' => 'nullable|mimes:pdf|max:10240',
            'thumbnail' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $catalog->title = $request->title;
        $catalog->description = $request->description;
        $catalog->is_active = $request->boolean('is_active', true);

        if ($request->hasFile('catalog_file')) {
            // Delete old file
            if ($catalog->file_path) {
                Storage::disk('public')->delete($catalog->file_path);
            }
            
            $file = $request->file('catalog_file');
            $path = $file->store('catalogs', 'public');
            $catalog->file_path = $path;
        }
        
        
        
        if ($request->hasFile('thumbnail')) {
           $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('storage/catalog-thumbnails'), $filename);
            $catalog->thumbnail_path = 'catalog-thumbnails/' . $filename;
        }

        $catalog->save();

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog updated successfully.');
    }

    public function destroy(Catalog $catalog)
    {
        // Delete files
        if ($catalog->file_path) {
            Storage::disk('public')->delete($catalog->file_path);
        }
        if ($catalog->thumbnail_path) {
            Storage::disk('public')->delete($catalog->thumbnail_path);
        }

        $catalog->delete();

        return redirect()->route('admin.catalogs.index')
            ->with('success', 'Catalog deleted successfully.');
    }
}