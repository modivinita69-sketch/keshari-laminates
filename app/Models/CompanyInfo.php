<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'key',
        'value',
        'type'
    ];

    public static function getValue($key, $default = null)
    {
        $info = self::where('key', $key)->first();
        return $info ? $info->value : $default;
    }

    public static function setValue($key, $value, $type = 'text')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}