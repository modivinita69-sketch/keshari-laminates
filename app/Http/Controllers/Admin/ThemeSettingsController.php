<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;

class ThemeSettingsController extends Controller
{
    public function index()
    {
        $colors = ThemeSetting::getThemeColors();
        return view('admin.theme-settings.index', compact('colors'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'text_color' => 'required|string|max:7',
            'link_color' => 'required|string|max:7',
            'header_bg_color' => 'required|string|max:7',
            'sidebar_bg_start' => 'required|string|max:7',
            'sidebar_bg_end' => 'required|string|max:7',
        ]);

        foreach ($request->except('_token') as $key => $value) {
            ThemeSetting::updateOrCreate(
                ['key' => $key, 'group' => 'colors'],
                ['value' => $value]
            );
        }

        return redirect()
            ->route('admin.theme-settings.index')
            ->with('success', 'Theme colors updated successfully!');
    }
}