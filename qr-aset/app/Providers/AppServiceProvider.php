<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layout', function ($view) {
            if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === 'admin') {
                $pendingReportsCount = \App\Models\AssetCheck::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])
                    ->where(function($q) {
                        $q->whereNull('status_verifikasi')
                          ->orWhere('status_verifikasi', 'Menunggu');
                    })
                    ->count();
                $view->with('pendingReportsCount', $pendingReportsCount);
            }
        });
    }
}
