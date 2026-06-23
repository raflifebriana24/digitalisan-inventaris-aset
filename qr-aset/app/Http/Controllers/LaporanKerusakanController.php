<?php

namespace App\Http\Controllers;

use App\Models\AssetCheck;
use Illuminate\Http\Request;

class LaporanKerusakanController extends Controller
{
    public function index(Request $request)
    {
        $query = AssetCheck::with(['asset', 'user'])
            ->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat']);

        // Filter by kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        // Filter by date range
        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        // Search by asset name / code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('asset', function ($q) use ($search) {
                $q->where('nama_aset', 'LIKE', "%{$search}%")
                  ->orWhere('kode_aset', 'LIKE', "%{$search}%");
            });
        }

        // Filter by asset age (umur)
        if ($request->filled('umur')) {
            $umurLimit = (int) $request->umur;
            $limitYear = (int) date('Y') - $umurLimit;
            $query->whereHas('asset', function ($q) use ($limitYear) {
                $q->whereNotNull('tahun_perolehan')
                  ->where('tahun_perolehan', '<=', $limitYear);
            });
        }

        $laporan = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $totalRusakRingan = AssetCheck::where('kondisi', 'Rusak Ringan')->count();
        $totalRusakBerat  = AssetCheck::where('kondisi', 'Rusak Berat')->count();

        return view('admin.laporan-kerusakan', compact(
            'laporan',
            'totalRusakRingan',
            'totalRusakBerat'
        ));
    }

    public function setujui($id)
    {
        $check = AssetCheck::findOrFail($id);
        $check->update(['status_verifikasi' => 'Disetujui']);
        
        if ($check->asset) {
            $check->asset->update(['kondisi' => 'Dalam Perbaikan']);
        }
        
        return redirect()->back()->with('success', 'Laporan disetujui, kondisi aset telah diperbarui menjadi Dalam Perbaikan.');
    }

    public function tolak($id)
    {
        $check = AssetCheck::findOrFail($id);
        $check->update(['status_verifikasi' => 'Ditolak']);
        
        return redirect()->back()->with('success', 'Laporan kerusakan ditolak.');
    }
}
