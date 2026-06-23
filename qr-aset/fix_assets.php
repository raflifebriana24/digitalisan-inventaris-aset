<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Asset;

Asset::whereHas('checks', function($q) { 
    $q->where('status_verifikasi', 'Disetujui'); 
})->update(['kondisi' => 'Dalam Perbaikan']);

echo "Done\n";
