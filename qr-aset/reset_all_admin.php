<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::where('role', 'admin')->get();
foreach ($users as $user) {
    $user->password = \Illuminate\Support\Facades\Hash::make('password');
    $user->save();
}
echo "All admin passwords reset to 'password'\n";
