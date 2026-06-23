@extends('layout')
@section('content')

<div style="margin-bottom: 2rem;">
    <a href="{{ route('assets.index') }}" class="btn btn-secondary" style="margin-bottom: 1rem;">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Kembali ke Daftar Aset
    </a>
    <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">Detail Aset</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Informasi lengkap tentang aset ini</p>
</div>

<div class="detail-grid">
    <!-- Left Column: Asset Information with Photo -->
    <div>
        <div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light);">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
                Informasi Aset
            </h3>
            
            <div style="space-y: 1.25rem;">
                <!-- Asset Photo -->
                @if($asset->image_path)
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.75rem;">Foto Aset</label>
                    <div style="background: white; padding: 1rem; border-radius: var(--radius-lg); border: 2px solid var(--border); text-align: center;">
                        <img src="{{ asset('storage/'.$asset->image_path) }}" 
                             alt="{{ $asset->nama_aset }}" 
                             style="max-width: 100%; max-height: 300px; border-radius: var(--radius-md); box-shadow: var(--shadow-md);">
                    </div>
                    <div style="margin-top: 0.75rem; text-align: center;">
                        <a href="{{ asset('storage/'.$asset->image_path) }}" download="{{ $asset->kode_aset }}_photo.jpg" class="btn btn-secondary btn-sm">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Download Foto
                        </a>
                    </div>
                </div>
                @endif

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Kode Aset</label>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">{{ $asset->kode_aset }}</div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Nama Aset</label>
                    <div style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">{{ $asset->nama_aset }}</div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Kategori</label>
                    <span style="display: inline-block; padding: 0.5rem 1rem; background: linear-gradient(135deg, #eff6ff, #dbeafe); color: #1e40af; border-radius: var(--radius-md); font-size: 0.9375rem; font-weight: 600; border: 1px solid #93c5fd;">
                        {{ $asset->kategori }}
                    </span>
                </div>


                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Kondisi Saat Ini</label>
                    @php
                        $kondisiColor = match($asset->kondisi) {
                            'Baik' => 'bg-green-100 text-green-800 border-green-200',
                            'Rusak Ringan' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'Rusak Berat' => 'bg-red-100 text-red-800 border-red-200',
                            default => 'bg-gray-100 text-gray-800 border-gray-200'
                        };
                    @endphp
                    <span style="display: inline-block; padding: 0.5rem 1rem; border-radius: var(--radius-md); font-size: 0.9375rem; font-weight: 600; border: 1px solid; 
                        {{ $asset->kondisi == 'Baik' ? 'background: #d1fae5; color: #065f46; border-color: #6ee7b7;' : '' }}
                        {{ $asset->kondisi == 'Rusak Ringan' ? 'background: #fef3c7; color: #92400e; border-color: #fcd34d;' : '' }}
                        {{ $asset->kondisi == 'Rusak Berat' ? 'background: #fee2e2; color: #991b1b; border-color: #fca5a5;' : '' }}
                    ">
                        {{ $asset->kondisi ?? 'Baik' }}
                    </span>
                    
                    @php
                        $latestCheck = $asset->checks()->latest()->first();
                    @endphp
                    @if($latestCheck && $latestCheck->catatan)
                    <div style="margin-top: 0.75rem; background: var(--bg-tertiary); padding: 0.75rem; border-radius: var(--radius-md); border-left: 3px solid var(--warning);">
                        <div style="font-size: 0.75rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.25rem;">Catatan Kerusakan ({{ $latestCheck->created_at->format('d/m/Y') }}):</div>
                        <div style="font-size: 0.875rem; color: var(--text-secondary); font-style: italic;">
                            "{{ $latestCheck->catatan }}"
                        </div>
                    </div>
                    @endif
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Lokasi</label>
                    <div style="font-size: 1rem; color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20" style="color: var(--primary);">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        {{ $asset->lokasi }}
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem; display: flex; gap: 1.5rem;">
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Tahun Perolehan</label>
                        <div style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">{{ $asset->tahun_perolehan ?? '-' }}</div>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Umur Aset</label>
                        @if($asset->umur !== null)
                            <div style="font-size: 1.125rem; font-weight: 600; color: {{ $asset->umur >= 5 ? '#dc2626' : 'var(--text-primary)' }};">
                                {{ $asset->umur }} Tahun
                                @if($asset->umur >= 5)
                                    <span style="font-size: 0.75rem; font-weight: 700; background: #fee2e2; color: #991b1b; padding: 0.15rem 0.5rem; border-radius: 9999px; margin-left: 0.25rem;">≥ 5 Tahun</span>
                                @endif
                            </div>
                        @else
                            <div style="font-size: 1.125rem; font-weight: 600; color: var(--text-muted);">-</div>
                        @endif
                    </div>
                </div>

                @if($asset->deskripsi)
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Deskripsi</label>
                    <div style="font-size: 0.9375rem; color: var(--text-secondary); line-height: 1.6; padding: 1rem; background: white; border-radius: var(--radius); border: 1px solid var(--border-light);">
                        {{ $asset->deskripsi }}
                    </div>
                </div>
                @endif

                @if($asset->estimated_value)
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Estimasi Nilai Aset</label>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #059669; display: flex; align-items: center; gap: 0.5rem; padding: 1rem; background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-radius: var(--radius-lg); border: 2px solid #34d399;">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20" style="color: #059669;">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                        {{ $asset->formatted_estimated_value }}
                    </div>
                </div>
                @endif

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Ditambahkan Pada</label>
                    <div style="font-size: 0.9375rem; color: var(--text-secondary);">
                        {{ $asset->created_at->format('d F Y, H:i') }}
                    </div>
                </div>

                @if($asset->updated_at != $asset->created_at)
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Terakhir Diupdate</label>
                    <div style="font-size: 0.9375rem; color: var(--text-secondary);">
                        {{ $asset->updated_at->format('d F Y, H:i') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: QR Code -->
    <div>
        <div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light); text-align: center;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd"/>
                </svg>
                QR Code
            </h3>
            
            <div style="background: white; padding: 2rem; border-radius: var(--radius-lg); border: 2px dashed var(--border); margin-bottom: 1.5rem;">
                <img src="{{ asset('storage/'.$asset->qr_path) }}" alt="QR Code {{ $asset->kode_aset }}" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
            </div>

            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.5rem;">
                Scan QR code ini untuk melihat detail aset
            </p>

            <a href="{{ asset('storage/'.$asset->qr_path) }}" download="{{ $asset->kode_aset }}.svg" class="btn btn-info" style="width: 100%;">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                Download QR Code
            </a>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div style="display: flex; gap: 0.75rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light); margin-bottom: 2rem;">
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
            </svg>
            Edit Aset
        </a>
        
        <button onclick="window.print()" class="btn btn-secondary" style="background: var(--bg-tertiary); border: 1px solid var(--border);">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm-1 9H8v3h4v-3z" clip-rule="evenodd"/>
            </svg>
            Cetak Detail Aset
        </button>
    @else
        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
            Update Lokasi
        </a>
    @endif
    
    @if(auth()->user()->role === 'admin')
    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset {{ $asset->nama_aset }}? Tindakan ini tidak dapat dibatalkan.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            Hapus Aset
        </button>
    </form>
    @endif
</div>



<style>
    .detail-grid {
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 2rem; 
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .detail-grid {
            grid-template-columns: 1fr !important;
        }
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 1cm;
        }
        
        body {
            font-size: 10pt !important;
        }
        
        .detail-grid {
            grid-template-columns: 1fr 1fr !important;
            gap: 1rem !important;
            margin-bottom: 0 !important;
        }
        
        .detail-grid > div > div {
            padding: 1rem !important;
            margin-bottom: 0 !important;
            break-inside: avoid;
        }
        
        h2 {
            font-size: 16pt !important;
            margin-bottom: 0.25rem !important;
        }
        
        h3 {
            font-size: 12pt !important;
            margin-bottom: 0.5rem !important;
        }

        .btn, a.btn {
            display: none !important;
        }

        img {
            max-height: 150px !important;
            width: auto !important;
        }
        
        /* Reduce spacing between elements */
        div[style*="margin-bottom: 1.25rem"], div[style*="margin-bottom: 1.5rem"] {
            margin-bottom: 0.5rem !important;
        }
        
        label {
            margin-bottom: 0.15rem !important;
            font-size: 8pt !important;
        }
        
        div[style*="font-size: 1.25rem"], div[style*="font-size: 1.125rem"], div[style*="font-size: 1.5rem"] {
            font-size: 11pt !important;
        }
        
        /* Force single page */
        html, body {
            height: 99%;
            overflow: hidden;
        }
        
        .content-card {
            padding: 0 !important;
        }
    }
</style>

@endsection