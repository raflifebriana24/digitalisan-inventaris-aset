<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetLoanController extends Controller
{
    public function store(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tenggat_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'catatan' => 'nullable|string'
        ]);

        // Check if asset is already borrowed
        $activeLoan = $asset->loans()->where('status', 'Dipinjam')->first();
        if ($activeLoan) {
            return back()->with('error', 'Aset ini sedang dipinjam oleh ' . $activeLoan->peminjam);
        }

        AssetLoan::create([
            'asset_id' => $asset->id,
            'user_id' => Auth::id(),
            'peminjam' => $validated['peminjam'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tenggat_kembali' => $validated['tenggat_kembali'],
            'status' => 'Dipinjam',
            'catatan' => $validated['catatan']
        ]);

        return back()->with('success', 'Peminjaman aset berhasil dicatat!');
    }

    public function return(Request $request, AssetLoan $loan)
    {
        $validated = $request->validate([
            'catatan_kembali' => 'nullable|string'
        ]);

        $loan->update([
            'status' => 'Dikembalikan',
            'tanggal_dikembalikan' => now(),
            'catatan' => $loan->catatan . "\nCatatan Pengembalian: " . ($validated['catatan_kembali'] ?? '-')
        ]);

        return back()->with('success', 'Aset berhasil dikembalikan!');
    }
}
