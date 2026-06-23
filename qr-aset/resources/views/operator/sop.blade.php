@extends('layout')
@section('content')

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color: var(--primary);">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        SOP Operator Inventaris Aset
    </h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Standar Operasional Prosedur (SOP) pengelolaan aset oleh Operator di Diskominfo Kota Serang.</p>
</div>

<!-- Alur Diagram -->
<div style="background: var(--bg-primary); border-radius: var(--radius-xl); padding: 2rem; border: 1px solid var(--border-light); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
    <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; text-align: center;">Diagram Alur Pengelolaan Aset</h3>
    <div style="display: flex; justify-content: center; overflow-x: auto;">
        <div class="mermaid">
        flowchart TD
            Start([Mulai]) --> A[1. Terima Informasi Aset Baru]
            A --> B[2. Pencatatan Aset ke Sistem]
            B --> C[3. Pemberian Identitas QR Code]
            C --> D[4. Penempatan Aset & Update Lokasi]
            D --> E[5. Monitoring & Pengecekan]
            
            E --> F{Apakah Aset<br>Berpindah?}
            F -- Ya --> G[6. Pengelolaan Mutasi]
            F -- Tidak --> H{Apakah Aset<br>Rusak Berat?}
            
            G --> H
            
            H -- Ya --> I[8. Pendataan Penghapusan]
            H -- Tidak --> J[7. Pembuatan Laporan]
            
            I --> J
            J --> End([Selesai])
        </div>
    </div>
</div>

<!-- Langkah Detail -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <!-- Step 1 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">1</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Penerimaan Informasi</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Operator menerima informasi aset baru dari bagian pengadaan atau bidang terkait. Dokumen berupa faktur atau BAST.</p>
    </div>
    
    <!-- Step 2 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">2</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Pencatatan Aset</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Operator menginput data aset (nama, kode, spesifikasi, jumlah, lokasi, tahun, kondisi) ke dalam sistem inventaris.</p>
    </div>

    <!-- Step 3 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">3</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Identitas Aset</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Sistem menghasilkan QR Code. Operator mencetak dan menempelkan label QR Code pada aset fisik secara langsung.</p>
    </div>

    <!-- Step 4 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">4</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Penempatan Aset</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Aset diserahkan ke ruangan atau bidang terkait. Operator mencatat lokasi penempatan secara akurat dalam sistem.</p>
    </div>

    <!-- Step 5 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">5</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Monitoring</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Melakukan pengecekan rutin di lapangan. Gunakan fitur Scan QR untuk memperbarui data kondisi aset secara real-time.</p>
    </div>

    <!-- Step 6 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">6</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Pengelolaan Mutasi</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Jika aset berpindah ruangan, segera perbarui lokasi pada sistem. Riwayat perpindahan akan dicatat sebagai dokumentasi.</p>
    </div>

    <!-- Step 7 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">7</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Pelaporan Aset</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Membuat laporan inventaris berkala yang berisi jumlah, kondisi, lokasi, dan daftar aset yang mengalami kerusakan.</p>
    </div>

    <!-- Step 8 -->
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border); box-shadow: var(--shadow-sm); position: relative;">
        <div style="position: absolute; top: -1rem; left: 1.5rem; background: var(--primary); color: white; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.125rem; box-shadow: var(--shadow-md);">8</div>
        <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-top: 0.5rem; margin-bottom: 0.5rem;">Penghapusan</h4>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Mendata aset yang rusak berat. Melaporkan data tersebut kepada pengelola barang untuk diproses penghapusannya.</p>
    </div>
</div>

<!-- Load Mermaid.js -->
<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        mermaid.initialize({ 
            startOnLoad: true, 
            theme: 'default',
            flowchart: {
                curve: 'basis'
            }
        });
    });
</script>

@endsection
