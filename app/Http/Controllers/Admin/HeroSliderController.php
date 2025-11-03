<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $slides = HeroSlider::orderBy('sort_order')->get();
        return view('admin.hero-slider.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slider.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'title' => 'nullable|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'sort_order' => 'nullable|integer|min:0'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                
                // Create directory if it doesn't exist
                $uploadPath = public_path('images/slider');
                if (!file_exists($uploadPath)) {
                    if (!mkdir($uploadPath, 0777, true)) {
                        throw new \Exception('Failed to create upload directory');
                    }
                }

                // Generate filename
                $filename = time() . '_' . str_replace(' ', '_', $image->getClientOriginalName());
                $fullPath = $uploadPath . DIRECTORY_SEPARATOR . $filename;
                
                // Move the file
                if (!$image->move($uploadPath, $filename)) {
                    throw new \Exception('Failed to move uploaded file');
                }

                // Verify file exists after upload
                if (!file_exists($fullPath)) {
                    throw new \Exception('File not found after upload');
                }

                // Create the slider record
                $data = [
                    'image_path' => 'images/slider/' . $filename,
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'sort_order' => $request->input('sort_order', 0),
                    'is_active' => true
                ];

                $slider = HeroSlider::create($data);
                
                if (!$slider) {
                    // If slider creation fails, remove the uploaded file
                    @unlink($fullPath);
                    throw new \Exception('Failed to create slider record in database');
                }

                return redirect()
                    ->route('admin.hero-slider.index')
                    ->with('success', 'Slider image added successfully');
            }

            return back()
                ->withInput()
                ->with('error', 'Please upload an image');
                
        } catch (\Exception $e) {
            \Log::error('Error adding slider: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(HeroSlider $slider)
    {
        return view('admin.hero-slider.edit', compact('slider'));
    }

    public function update(Request $request, HeroSlider $slider) // The $slider parameter name must match the route parameter
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($slider->image_path && file_exists(public_path($slider->image_path))) {
                unlink(public_path($slider->image_path));
            }

            // Store new image
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/slider'), $filename);
            $data['image_path'] = 'images/slider/' . $filename;
        }

        $slider->update($data);

        return redirect()->route('admin.hero-slider.index')
            ->with('success', 'Slider image updated successfully');
    }

    public function destroy(HeroSlider $slider)
    {
        if ($slider->image_path && file_exists(public_path($slider->image_path))) {
            unlink(public_path($slider->image_path));
        }

        $slider->delete();

        return redirect()->route('admin.hero-slider.index')
            ->with('success', 'Slider image deleted successfully');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'integer'
        ]);

        foreach ($request->orders as $id => $order) {
            HeroSlider::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}