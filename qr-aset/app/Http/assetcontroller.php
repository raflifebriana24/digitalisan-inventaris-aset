<?php
namespace App\Http\Controllers;


use App\Models\Asset;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class AssetController extends Controller
{
public function index()
{
$assets = Asset::all();
return view('assets.index', compact('assets'));
}


public function create()
{
return view('assets.create');
}


public function store(Request $request)
{
$data = $request->validate([
'kode_aset' => 'required|unique:assets',
'nama_aset' => 'required',
'kategori' => 'required',
'lokasi' => 'required',
'deskripsi' => 'nullable'
]);


// Generate QR Code
$qrName = $request->kode_aset.'.png';
$qrPath = 'qr/'.$qrName;
Storage::disk('public')->put($qrPath, QrCode::format('png')->size(300)->generate($request->kode_aset));


$data['qr_path'] = $qrPath;


Asset::create($data);


return redirect()->route('assets.index')->with('success','Aset berhasil ditambahkan!');
}


public function show(Asset $asset)
{
return view('assets.show', compact('asset'));
}
}