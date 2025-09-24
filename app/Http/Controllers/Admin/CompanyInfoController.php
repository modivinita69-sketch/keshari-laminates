<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::all()->keyBy('key');
        
        // Define the structure of company info fields
        $fields = [
            'hero_title' => ['label' => 'Hero Title', 'type' => 'text', 'default' => 'Premium Quality Laminates'],
            'hero_subtitle' => ['label' => 'Hero Subtitle', 'type' => 'textarea', 'default' => 'Wholesale distributor of premium laminates'],
            'about_us' => ['label' => 'About Us', 'type' => 'textarea', 'default' => 'Leading wholesale distributor of premium laminates'],
            'mission' => ['label' => 'Mission Statement', 'type' => 'textarea', 'default' => 'To provide premium quality laminates at competitive prices'],
            'vision' => ['label' => 'Vision Statement', 'type' => 'textarea', 'default' => 'To be the most trusted distributor of laminates'],
            'experience' => ['label' => 'Experience Description', 'type' => 'textarea', 'default' => 'Over 15 years of experience in the industry'],
            'address' => ['label' => 'Business Address', 'type' => 'textarea', 'default' => 'Industrial Area, Your City, State - 123456'],
            'phone' => ['label' => 'Phone Number', 'type' => 'text', 'default' => '+91 98765 43210'],
            'email' => ['label' => 'Email Address', 'type' => 'email', 'default' => 'info@kesharilaminates.com'],
            'business_hours' => ['label' => 'Business Hours', 'type' => 'text', 'default' => 'Monday - Saturday: 9:00 AM - 6:00 PM'],
        ];

        return view('admin.company-info.index', compact('companyInfo', 'fields'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'about_us' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'experience' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'business_hours' => 'nullable|string|max:255',
        ]);

        foreach ($data as $key => $value) {
            if ($value !== null) {
                CompanyInfo::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return redirect()->route('admin.company-info.index')
            ->with('success', 'Company information updated successfully.');
    }
}
