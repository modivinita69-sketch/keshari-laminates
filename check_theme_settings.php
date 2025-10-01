<?php
require 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Check current theme settings
$themeSettings = DB::table('theme_settings')->where('group', 'colors')->get();
echo "Current Theme Settings:\n";
foreach ($themeSettings as $setting) {
    echo "{$setting->key}: {$setting->value}\n";
}