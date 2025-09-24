<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'catalog_name',
        'catalog_path',
        'file_type',
        'file_size',
        'download_count'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function incrementDownloads()
    {
        $this->increment('download_count');
    }
}