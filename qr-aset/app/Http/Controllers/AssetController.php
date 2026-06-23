<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asset::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_aset', 'LIKE', "%{$search}%")
                  ->orWhere('nama_aset', 'LIKE', "%{$search}%")
                  ->orWhere('kategori', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi', 'LIKE', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('filter_kategori')) {
            $query->where('kategori', $request->filter_kategori);
        }

        // Filter by lokasi
        if ($request->filled('filter_lokasi')) {
            $query->where('lokasi', 'LIKE', '%' . $request->filter_lokasi . '%');
        }

        // Filter by kondisi
        if ($request->filled('filter_kondisi')) {
            $query->where('kondisi', $request->filter_kondisi);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $assets = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        // Stats
        $totalAssets   = Asset::count();
        $totalBaik     = Asset::where('kondisi', 'Baik')->count();
        $totalPerbaikan = Asset::where('kondisi', 'Dalam Perbaikan')->count();
        $totalRusak    = Asset::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->count();
        $totalNilai    = Asset::where('kategori', '!=', 'Ruangan')->sum('estimated_value');

        // Distinct values for filters
        $kategoriList = Asset::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        $lokasiList   = Asset::select('lokasi')->distinct()->orderBy('lokasi')->pluck('lokasi');

        return view('index', compact(
            'assets',
            'totalAssets',
            'totalBaik',
            'totalPerbaikan',
            'totalRusak',
            'totalNilai',
            'kategoriList',
            'lokasiList'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        if ($request->has('estimated_value') && $request->estimated_value !== null) {
            $cleanValue = preg_replace('/[^\d]/', '', $request->estimated_value);
            $request->merge(['estimated_value' => $cleanValue !== '' ? $cleanValue : null]);
        }

        $validated = $request->validate([
            'kode_aset'        => 'required|unique:assets',
            'nama_aset'        => 'required',
            'kategori'         => 'required',
            'lokasi'           => 'required',
            'deskripsi'        => 'nullable',
            'estimated_value'  => 'nullable|numeric|min:0',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tahun_perolehan'  => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = $validated['kode_aset'] . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
        }

        // Generate QR Code
        $qrCode = QrCode::format('svg')->size(300)->generate($validated['kode_aset']);
        $qrPath = 'qrcodes/' . $validated['kode_aset'] . '.svg';
        Storage::disk('public')->put($qrPath, $qrCode);

        // Set estimated_value to null if category is "Ruangan"
        $estimatedValue = ($validated['kategori'] === 'Ruangan') ? null : ($validated['estimated_value'] ?? null);

        Asset::create([
            'kode_aset'       => $validated['kode_aset'],
            'nama_aset'       => $validated['nama_aset'],
            'kategori'        => $validated['kategori'],
            'lokasi'          => $validated['lokasi'],
            'deskripsi'       => $validated['deskripsi'],
            'estimated_value' => $estimatedValue,
            'image_path'      => $imagePath,
            'qr_path'         => $qrPath,
            'tahun_perolehan' => $validated['tahun_perolehan'] ?? null,
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        return view('edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        if (auth()->user()->role === 'operator') {
            $validated = $request->validate([
                'lokasi' => 'required',
            ]);
            $asset->update(['lokasi' => $validated['lokasi']]);
            return redirect()->route('assets.show', $asset->id)->with('success', 'Lokasi aset berhasil diperbarui!');
        }

        if ($request->has('estimated_value') && $request->estimated_value !== null) {
            $cleanValue = preg_replace('/[^\d]/', '', $request->estimated_value);
            $request->merge(['estimated_value' => $cleanValue !== '' ? $cleanValue : null]);
        }

        $validated = $request->validate([
            'kode_aset'       => 'required|unique:assets,kode_aset,' . $asset->id,
            'nama_aset'       => 'required',
            'kategori'        => 'required',
            'lokasi'          => 'required',
            'deskripsi'       => 'nullable',
            'estimated_value' => 'nullable|numeric|min:0',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($asset->image_path) {
                Storage::disk('public')->delete($asset->image_path);
            }
            $image     = $request->file('image');
            $imageName = $validated['kode_aset'] . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $validated['image_path'] = $imagePath;
        }

        // If kode_aset changed, regenerate QR Code
        if ($asset->kode_aset !== $validated['kode_aset']) {
            Storage::disk('public')->delete($asset->qr_path);
            $qrCode = QrCode::format('svg')->size(300)->generate($validated['kode_aset']);
            $qrPath = 'qrcodes/' . $validated['kode_aset'] . '.svg';
            Storage::disk('public')->put($qrPath, $qrCode);
            $validated['qr_path'] = $qrPath;
        }

        // Set estimated_value to null if category is "Ruangan"
        if ($validated['kategori'] === 'Ruangan') {
            $validated['estimated_value'] = null;
        }

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        if ($asset->image_path) {
            Storage::disk('public')->delete($asset->image_path);
        }
        Storage::disk('public')->delete($asset->qr_path);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus!');
    }

    /**
     * Search asset by code (for QR scanning).
     */
    public function searchByCode($code)
    {
        $asset = Asset::where('kode_aset', $code)->first();
        if ($asset) {
            return redirect()->route('assets.show', $asset->id);
        }
        return redirect()->route('assets.index')->with('error', 'Aset dengan kode ' . $code . ' tidak ditemukan!');
    }
}
