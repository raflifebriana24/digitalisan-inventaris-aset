<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCheck;
use App\Models\AssetLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function index()
    {
        $recentChecks = AssetCheck::with('asset')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $activeLoans = AssetLoan::with('asset')
            ->where('status', 'Dipinjam')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('operator.index', compact('recentChecks', 'activeLoans'));
    }

    public function sop()
    {
        return view('operator.sop');
    }

    /**
     * Halaman daftar laporan kerusakan yang pernah dikirim operator ini.
     */
    public function laporanKerusakan()
    {
        $laporan = AssetCheck::with('asset')
            ->where('user_id', Auth::id())
            ->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalRusakRingan = AssetCheck::where('user_id', Auth::id())->where('kondisi', 'Rusak Ringan')->count();
        $totalRusakBerat  = AssetCheck::where('user_id', Auth::id())->where('kondisi', 'Rusak Berat')->count();

        return view('operator.laporan-kerusakan', compact('laporan', 'totalRusakRingan', 'totalRusakBerat'));
    }

    /**
     * Form membuat laporan kerusakan baru.
     */
    public function buatLaporan()
    {
        $assets = Asset::orderBy('nama_aset')->get(['id', 'kode_aset', 'nama_aset', 'lokasi', 'kondisi']);
        return view('operator.buat-laporan', compact('assets'));
    }

    /**
     * Simpan laporan kerusakan dari operator.
     */
    public function kirimLaporan(Request $request)
    {
        $validated = $request->validate([
            'asset_id'   => 'required|exists:assets,id',
            'kondisi'    => 'required|in:Rusak Ringan,Rusak Berat',
            'catatan'    => 'required|string|min:10|max:1000',
        ], [
            'asset_id.required'  => 'Silakan pilih aset yang mengalami kerusakan.',
            'asset_id.exists'    => 'Aset tidak ditemukan.',
            'kondisi.required'   => 'Tingkat kerusakan wajib dipilih.',
            'kondisi.in'         => 'Pilih Rusak Ringan atau Rusak Berat.',
            'catatan.required'   => 'Catatan deskripsi kerusakan wajib diisi.',
            'catatan.min'        => 'Catatan kerusakan minimal 10 karakter.',
        ]);

        // Simpan laporan pengecekan
        AssetCheck::create([
            'asset_id' => $validated['asset_id'],
            'user_id'  => Auth::id(),
            'kondisi'  => $validated['kondisi'],
            'catatan'  => $validated['catatan'],
            'status_verifikasi' => 'Menunggu Verifikasi', // Default from DB but good to be explicit
        ]);

        return redirect()
            ->route('operator.laporan-kerusakan')
            ->with('success', 'Laporan kerusakan berhasil dikirim ke Admin!');
    }
}

