<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (require authentication)
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/', function() {
        if (\Illuminate\Support\Facades\Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('operator.index');
        }
    })->name('home');
    
    // Admin Dashboard
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/laporan-kerusakan', [\App\Http\Controllers\LaporanKerusakanController::class, 'index'])->name('admin.laporan-kerusakan');
        Route::post('/admin/laporan-kerusakan/{id}/setujui', [\App\Http\Controllers\LaporanKerusakanController::class, 'setujui'])->name('admin.laporan-kerusakan.setujui');
        Route::post('/admin/laporan-kerusakan/{id}/tolak', [\App\Http\Controllers\LaporanKerusakanController::class, 'tolak'])->name('admin.laporan-kerusakan.tolak');
    });

    Route::get('/scan', function(){ return view('scan'); })->name('scan');
    Route::get('/assets/search/{code}', [AssetController::class, 'searchByCode'])->name('assets.search');
    Route::resource('assets', AssetController::class);
    Route::resource('rooms', RoomController::class);

    // Operator Dashboard
    Route::middleware('role:operator')->group(function () {
        Route::get('/operator', [\App\Http\Controllers\OperatorController::class, 'index'])->name('operator.index');
        Route::get('/operator/sop', [\App\Http\Controllers\OperatorController::class, 'sop'])->name('operator.sop');
        Route::get('/operator/laporan-kerusakan', [\App\Http\Controllers\OperatorController::class, 'laporanKerusakan'])->name('operator.laporan-kerusakan');
        Route::get('/operator/laporan-kerusakan/buat', [\App\Http\Controllers\OperatorController::class, 'buatLaporan'])->name('operator.laporan-kerusakan.buat');
        Route::post('/operator/laporan-kerusakan/kirim', [\App\Http\Controllers\OperatorController::class, 'kirimLaporan'])->name('operator.laporan-kerusakan.kirim');
    });
    
    // Asset Check & Loan Routes
    Route::post('/assets/{asset}/check', [\App\Http\Controllers\AssetCheckController::class, 'store'])->name('assets.check.store');
    Route::delete('/assets/check/{check}', [\App\Http\Controllers\AssetCheckController::class, 'destroy'])->name('assets.check.destroy');
    Route::post('/assets/{asset}/loan', [\App\Http\Controllers\AssetLoanController::class, 'store'])->name('assets.loan.store');
    Route::put('/assets/loan/{loan}/return', [\App\Http\Controllers\AssetLoanController::class, 'return'])->name('assets.loan.return');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
