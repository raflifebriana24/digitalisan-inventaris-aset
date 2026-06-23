<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetCheckController extends Controller
{
    public function store(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'catatan' => 'nullable|string'
        ]);

        // Create the check record
        AssetCheck::create([
            'asset_id' => $asset->id,
            'user_id' => Auth::id(),
            'kondisi' => $validated['kondisi'],
            'catatan' => $validated['catatan']
        ]);

        // Update the asset's current condition
        $asset->update(['kondisi' => $validated['kondisi']]);

        return back()->with('success', 'Kondisi aset berhasil diupdate dan dicatat!');
    }
    public function destroy(AssetCheck $check)
    {
        // Only allow deletion if user owns the check or is an admin
        if (Auth::id() !== $check->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $check->delete();

        return back()->with('success', 'Riwayat pengecekan berhasil dihapus.');
    }
}
