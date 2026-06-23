<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\AssetCheck;
use App\Models\User;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan ada user Admin dan Operator
        $admin = User::firstOrCreate(
            ['email' => 'admin@diskominfo.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $operator = User::firstOrCreate(
            ['email' => 'operator@diskominfo.com'],
            [
                'name' => 'Operator Aset',
                'password' => bcrypt('password'),
                'role' => 'operator',
            ]
        );

        // 2. Daftar Kategori dan Lokasi
        $kategoriList = ['Elektronik', 'Mebel', 'Kendaraan', 'Perangkat Jaringan', 'Ruangan'];
        $lokasiList = ['Ruang Server', 'Ruang Rapat Utama', 'Ruang Kadis', 'Gudang', 'Lobby'];
        
        // 3. Buat beberapa dummy Aset
        $assetsData = [
            ['nama' => 'Laptop Asus ROG', 'kategori' => 'Elektronik', 'harga' => 15000000],
            ['nama' => 'PC Server Dell', 'kategori' => 'Elektronik', 'harga' => 35000000],
            ['nama' => 'Meja Rapat Kayu Jati', 'kategori' => 'Mebel', 'harga' => 5000000],
            ['nama' => 'Kursi Kerja Ergonomis', 'kategori' => 'Mebel', 'harga' => 1200000],
            ['nama' => 'Mobil Dinas Innova', 'kategori' => 'Kendaraan', 'harga' => 300000000],
            ['nama' => 'Motor Dinas Vario', 'kategori' => 'Kendaraan', 'harga' => 18000000],
            ['nama' => 'Router Cisco', 'kategori' => 'Perangkat Jaringan', 'harga' => 8500000],
            ['nama' => 'Switch Hub 24 Port', 'kategori' => 'Perangkat Jaringan', 'harga' => 3200000],
            ['nama' => 'AC Daikin 2 PK', 'kategori' => 'Elektronik', 'harga' => 7500000],
            ['nama' => 'Proyektor Epson', 'kategori' => 'Elektronik', 'harga' => 6000000],
            ['nama' => 'Ruang Rapat Utama', 'kategori' => 'Ruangan', 'harga' => null],
            ['nama' => 'Ruang Server Induk', 'kategori' => 'Ruangan', 'harga' => null],
        ];

        $createdAssets = [];

        foreach ($assetsData as $index => $data) {
            $kodeAset = 'AST-' . date('Y') . '-' . strtoupper(Str::random(5));
            
            // Generate QR Code untuk setiap aset
            $qrPath = 'qrcodes/' . $kodeAset . '.svg';
            if (!Storage::disk('public')->exists($qrPath)) {
                $qrCode = QrCode::format('svg')->size(300)->generate($kodeAset);
                Storage::disk('public')->put($qrPath, $qrCode);
            }

            $asset = Asset::create([
                'kode_aset' => $kodeAset,
                'nama_aset' => $data['nama'],
                'kategori' => $data['kategori'],
                'lokasi' => $lokasiList[array_rand($lokasiList)],
                'deskripsi' => 'Data aset dummy hasil generate otomatis.',
                'kondisi' => 'Baik',
                'estimated_value' => $data['harga'],
                'tahun_perolehan' => rand(2018, date('Y')),
                'qr_path' => $qrPath,
            ]);

            $createdAssets[] = $asset;
        }

        // 4. Buat dummy Laporan Kerusakan (AssetCheck)
        // Ambil 5 aset acak untuk dijadikan bahan laporan kerusakan
        $laporanAssets = array_rand($createdAssets, 5);
        $statusList = ['Menunggu Verifikasi', 'Disetujui', 'Ditolak'];
        
        foreach ($laporanAssets as $assetIndex) {
            $asset = $createdAssets[$assetIndex];
            $status = $statusList[array_rand($statusList)];
            $kondisiLaporan = rand(0, 1) ? 'Rusak Ringan' : 'Rusak Berat';

            AssetCheck::create([
                'asset_id' => $asset->id,
                'user_id' => $operator->id, // Laporan dibuat oleh operator
                'kondisi' => $kondisiLaporan,
                'catatan' => 'Kerusakan terdeteksi saat pengecekan rutin.',
                'status_verifikasi' => $status,
                'created_at' => now()->subDays(rand(1, 10)),
            ]);

            // Jika statusnya disetujui, update kondisi asetnya menjadi Dalam Perbaikan
            if ($status === 'Disetujui') {
                $asset->update(['kondisi' => 'Dalam Perbaikan']);
            }
        }
    }
}
