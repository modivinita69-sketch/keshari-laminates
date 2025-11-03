<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function download(Catalog $catalog)
    {
        if (!$catalog->is_active) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($catalog->file_path)) {
            abort(404);
        }

        $catalog->incrementDownloadCount();

        return response()->download(
            storage_path('app/public/' . $catalog->file_path),
            $catalog->title . '.pdf'
        );
    }
}