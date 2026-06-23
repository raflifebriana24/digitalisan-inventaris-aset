<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCheck;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (\Illuminate\Support\Facades\Auth::user()->role === 'operator') {
            return redirect()->route('operator.index');
        }

        $totalAssets = Asset::count();
        $totalEstimatedValue = Asset::where('kategori', '!=', 'Ruangan')->sum('estimated_value');
        $assetsByCategory = Asset::selectRaw('kategori, COUNT(*) as total')->groupBy('kategori')->get();
        $recentAssets = Asset::orderBy('created_at', 'desc')->take(5)->get();
        $assetItems = Asset::where('kategori', '!=', 'Ruangan')->count();
        $assetRooms = Asset::where('kategori', 'Ruangan')->count();



        // Laporan Kerusakan
        $laporanKerusakan = AssetCheck::with(['asset', 'user'])
            ->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalKerusakan = AssetCheck::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])
            ->count();

        // Menunggu Persetujuan - laporan kerusakan yang belum diverifikasi Admin
        $totalMenungguPersetujuan = AssetCheck::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])
            ->where('status_verifikasi', 'Menunggu Verifikasi')
            ->count();

        $totalSemuaLaporan = AssetCheck::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->count();

        return view('dashboard', compact(
            'totalAssets',
            'totalEstimatedValue',
            'assetsByCategory',
            'recentAssets',
            'assetItems',
            'assetRooms',

            'laporanKerusakan',
            'totalKerusakan',
            'totalMenungguPersetujuan',
            'totalSemuaLaporan'
        ));
    }
}
