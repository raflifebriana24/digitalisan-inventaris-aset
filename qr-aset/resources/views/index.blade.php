@extends('layout')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        {{ session('error') }}
    </div>
@endif

{{-- ======================== PAGE HEADER ======================== --}}
<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin: 0 0 0.25rem 0;">Manajemen Aset</h2>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; margin: 0;">Kelola seluruh aset barang milik Diskominfo</p>
    </div>
    <div style="display: flex; gap: 0.625rem; flex-wrap: wrap;">
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('assets.create') }}" class="btn btn-primary" style="font-size: 0.875rem;">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            Tambah Aset
        </a>
        @endif
        <a href="{{ route('scan') }}" class="btn btn-warning" style="font-size: 0.875rem;">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd"/></svg>
            Scan QR Code
        </a>

    </div>
</div>

{{-- ======================== STAT CARDS ======================== --}}
<div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; margin-bottom: 1.75rem;">
    {{-- Total Aset --}}
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.25rem; box-shadow: var(--shadow-sm); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 1rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #dbeafe, #bfdbfe); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="#2563eb" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <div>
            <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; margin-bottom: 0.125rem;">Total Aset</div>
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary); line-height: 1;">{{ $totalAssets }}</div>
            <div style="font-size: 0.6875rem; color: var(--text-muted); margin-top: 0.125rem;">Semua aset terdaftar</div>
        </div>
    </div>

    {{-- Aset Baik --}}
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.25rem; box-shadow: var(--shadow-sm); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 1rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #d1fae5, #a7f3d0); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="#059669" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; margin-bottom: 0.125rem;">Aset Kondisi Baik</div>
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary); line-height: 1;">{{ $totalBaik }}</div>
            <div style="font-size: 0.6875rem; color: var(--text-muted); margin-top: 0.125rem;">{{ $totalAssets > 0 ? round(($totalBaik / $totalAssets) * 100, 1) : 0 }}% dari total aset</div>
        </div>
    </div>

    {{-- Dalam Perbaikan --}}
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.25rem; box-shadow: var(--shadow-sm); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 1rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #fef3c7, #fde68a); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="#d97706" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; margin-bottom: 0.125rem;">Dalam Perbaikan</div>
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary); line-height: 1;">{{ $totalPerbaikan }}</div>
            <div style="font-size: 0.6875rem; color: var(--text-muted); margin-top: 0.125rem;">{{ $totalAssets > 0 ? round(($totalPerbaikan / $totalAssets) * 100, 1) : 0 }}% dari total aset</div>
        </div>
    </div>

    {{-- Aset Rusak --}}
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.25rem; box-shadow: var(--shadow-sm); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 1rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #fee2e2, #fecaca); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="22" height="22" fill="none" stroke="#dc2626" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; margin-bottom: 0.125rem;">Aset Kondisi Rusak</div>
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary); line-height: 1;">{{ $totalRusak }}</div>
            <div style="font-size: 0.6875rem; color: var(--text-muted); margin-top: 0.125rem;">{{ $totalAssets > 0 ? round(($totalRusak / $totalAssets) * 100, 1) : 0 }}% dari total aset</div>
        </div>
    </div>

    {{-- Total Nilai Aset --}}
    <div style="background: white; border-radius: var(--radius-lg); padding: 1.25rem; box-shadow: var(--shadow-sm); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 1rem;">
        <div style="width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #ede9fe, #ddd6fe); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <span style="font-size: 1rem; font-weight: 800; color: #7c3aed;">Rp</span>
        </div>
        <div>
            <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; margin-bottom: 0.125rem;">Total Nilai Aset</div>
            <div style="font-size: 1.125rem; font-weight: 800; color: var(--text-primary); line-height: 1.2;">Rp {{ number_format($totalNilai, 0, ',', '.') }}</div>
            <div style="font-size: 0.6875rem; color: var(--text-muted); margin-top: 0.125rem;">Total estimasi nilai aset</div>
        </div>
    </div>
</div>

{{-- ======================== FILTER & SEARCH BAR ======================== --}}
<form method="GET" action="{{ route('assets.index') }}" id="filterForm" style="margin-bottom: 1.5rem; background: white; padding: 1.25rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--border-light);">
    <div style="display: flex; gap: 0.75rem; align-items: flex-end; flex-wrap: wrap;">
        {{-- Search --}}
        <div style="flex: 1; min-width: 220px;">
            <div style="position: relative;">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Cari berdasarkan kode, nama, kategori, atau lokasi..."
                    style="padding-left: 2.75rem; font-size: 0.875rem;"
                >
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20" style="position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="font-size: 0.875rem; padding: 0.7rem 1.25rem;">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            Cari
        </button>

        {{-- Kategori --}}
        <div style="min-width: 160px;">
            <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; display: block; margin-bottom: 0.25rem;">Kategori</label>
            <select name="filter_kategori" class="form-select" onchange="document.getElementById('filterForm').submit()" style="font-size: 0.875rem; padding: 0.65rem 0.75rem;">
                <option value="">Semua Kategori</option>
                @foreach($kategoriList as $kat)
                <option value="{{ $kat }}" {{ request('filter_kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
        </div>

        {{-- Lokasi --}}
        <div style="min-width: 160px;">
            <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; display: block; margin-bottom: 0.25rem;">Lokasi</label>
            <select name="filter_lokasi" class="form-select" onchange="document.getElementById('filterForm').submit()" style="font-size: 0.875rem; padding: 0.65rem 0.75rem;">
                <option value="">Semua Lokasi</option>
                @foreach($lokasiList as $lok)
                <option value="{{ $lok }}" {{ request('filter_lokasi') === $lok ? 'selected' : '' }}>{{ $lok }}</option>
                @endforeach
            </select>
        </div>

        {{-- Status / Kondisi --}}
        <div style="min-width: 160px;">
            <label style="font-size: 0.75rem; color: var(--text-muted); font-weight: 500; display: block; margin-bottom: 0.25rem;">Status</label>
            <select name="filter_kondisi" class="form-select" onchange="document.getElementById('filterForm').submit()" style="font-size: 0.875rem; padding: 0.65rem 0.75rem;">
                <option value="">Semua Status</option>
                <option value="Baik" {{ request('filter_kondisi') === 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Dalam Perbaikan" {{ request('filter_kondisi') === 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                <option value="Rusak Ringan" {{ request('filter_kondisi') === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="Rusak Berat" {{ request('filter_kondisi') === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>

        {{-- Reset --}}
        @if(request()->hasAny(['search','filter_kategori','filter_lokasi','filter_kondisi']))
        <a href="{{ route('assets.index') }}" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.7rem 1rem; font-size: 0.8125rem; font-weight: 500; color: var(--text-secondary); background: var(--bg-tertiary); border: 1px solid var(--border); border-radius: var(--radius-md); white-space: nowrap; transition: all 0.2s;">
            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            Reset Filter
        </a>
        @endif
    </div>
</form>

{{-- ======================== TABLE ======================== --}}
<div class="table-container" style="background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--border-light);">
    <table>
        <thead>
            <tr>
                <th style="width: 70px;">Gambar</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Estimasi Nilai</th>
                <th style="text-align: center; width: 80px;">QR Code</th>
                <th style="text-align: center; width: 210px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assets as $asset)
            <tr>
                <td>
                    @if($asset->image_path)
                        <img src="{{ asset('storage/'.$asset->image_path) }}"
                             alt="{{ $asset->nama_aset }}"
                             style="width: 56px; height: 56px; object-fit: cover; border-radius: var(--radius); border: 2px solid var(--border);">
                    @else
                        <div style="width: 56px; height: 56px; background: var(--bg-tertiary); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; border: 2px solid var(--border);">
                            <svg width="22" height="22" fill="currentColor" viewBox="0 0 20 20" style="color: var(--text-muted);">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    @endif
                </td>
                <td><strong style="font-family: monospace; font-size: 0.875rem;">{{ $asset->kode_aset }}</strong></td>
                <td>
                    <div style="font-weight: 600; font-size: 0.9375rem;">{{ $asset->nama_aset }}</div>
                </td>
                <td>
                    <span style="display: inline-block; padding: 0.2rem 0.75rem; background: #eff6ff; color: #1e40af; border: 1px solid #93c5fd; border-radius: 9999px; font-size: 0.8125rem; font-weight: 600;">
                        {{ $asset->kategori }}
                    </span>
                </td>
                <td style="font-size: 0.875rem; max-width: 180px;">{{ $asset->lokasi }}</td>
                <td>
                    @php
                        $kondisi = $asset->kondisi ?? 'Baik';
                        $kondisiStyles = [
                            'Baik' => ['bg' => '#d1fae5', 'color' => '#065f46', 'border' => '#6ee7b7', 'dot' => '#10b981'],
                            'Dalam Perbaikan' => ['bg' => '#fef3c7', 'color' => '#92400e', 'border' => '#fcd34d', 'dot' => '#f59e0b'],
                            'Rusak Ringan' => ['bg' => '#fee2e2', 'color' => '#991b1b', 'border' => '#fca5a5', 'dot' => '#ef4444'],
                            'Rusak Berat' => ['bg' => '#fee2e2', 'color' => '#991b1b', 'border' => '#fca5a5', 'dot' => '#dc2626'],
                        ];
                        $style = $kondisiStyles[$kondisi] ?? $kondisiStyles['Baik'];
                    @endphp
                    <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.75rem; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; border: 1px solid {{ $style['border'] }}; border-radius: 9999px; font-size: 0.8125rem; font-weight: 600; white-space: nowrap;">
                        <span style="width: 7px; height: 7px; border-radius: 50%; background: {{ $style['dot'] }}; flex-shrink: 0;"></span>
                        {{ $kondisi }}
                    </span>
                </td>
                <td>
                    @if($asset->estimated_value)
                        <span style="font-weight: 600; color: #059669; font-size: 0.875rem;">{{ $asset->formatted_estimated_value }}</span>
                    @else
                        <span style="color: var(--text-muted); font-style: italic;">—</span>
                    @endif
                </td>
                <td style="text-align: center;">
                    <div class="qr-code" style="display:inline-block;">
                        <img src="{{ asset('storage/'.$asset->qr_path) }}" width="54" height="54" alt="QR Code" style="display: block;" />
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-info btn-sm">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                            Detail
                        </a>
                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                            Edit
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus aset {{ addslashes($asset->nama_aset) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center" style="padding: 3rem; color: var(--text-muted);">
                    <svg width="56" height="56" fill="currentColor" viewBox="0 0 20 20" style="margin: 0 auto 1rem; opacity: 0.25;">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <div style="font-size: 1rem; font-weight: 600; margin-bottom: 0.25rem;">
                        @if(request()->hasAny(['search','filter_kategori','filter_lokasi','filter_kondisi']))
                            Tidak ada aset yang cocok dengan filter
                        @else
                            Belum ada data aset
                        @endif
                    </div>
                    <div style="font-size: 0.875rem;">
                        @if(request()->hasAny(['search','filter_kategori','filter_lokasi','filter_kondisi']))
                            Coba ubah kata kunci atau filter pencarian
                        @else
                            Klik tombol "Tambah Aset" untuk memulai
                        @endif
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ======================== PAGINATION ======================== --}}
@if($assets->hasPages())
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.25rem; flex-wrap: wrap; gap: 1rem;">
    {{-- Info --}}
    <div style="font-size: 0.875rem; color: var(--text-secondary);">
        Menampilkan {{ $assets->firstItem() }} - {{ $assets->lastItem() }} dari {{ $assets->total() }} data
    </div>

    {{-- Page links --}}
    <div style="display: flex; align-items: center; gap: 0.375rem;">
        {{-- Previous --}}
        @if($assets->onFirstPage())
            <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: var(--bg-tertiary); color: var(--text-muted); font-size: 0.875rem; cursor: not-allowed;">&lsaquo;</span>
        @else
            <a href="{{ $assets->previousPageUrl() }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: white; color: var(--text-secondary); border: 1px solid var(--border); text-decoration: none; font-size: 0.875rem; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-secondary)'">&lsaquo;</a>
        @endif

        {{-- Page Numbers --}}
        @php
            $currentPage = $assets->currentPage();
            $lastPage = $assets->lastPage();
            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);
        @endphp

        @if($startPage > 1)
            <a href="{{ $assets->url(1) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: white; color: var(--text-secondary); border: 1px solid var(--border); text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-secondary)'">1</a>
            @if($startPage > 2)
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; color: var(--text-muted); font-size: 0.875rem;">...</span>
            @endif
        @endif

        @for($i = $startPage; $i <= $endPage; $i++)
            @if($i == $currentPage)
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; font-size: 0.875rem; font-weight: 600; box-shadow: var(--shadow-sm);">{{ $i }}</span>
            @else
                <a href="{{ $assets->url($i) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: white; color: var(--text-secondary); border: 1px solid var(--border); text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-secondary)'">{{ $i }}</a>
            @endif
        @endfor

        @if($endPage < $lastPage)
            @if($endPage < $lastPage - 1)
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; color: var(--text-muted); font-size: 0.875rem;">...</span>
            @endif
            <a href="{{ $assets->url($lastPage) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: white; color: var(--text-secondary); border: 1px solid var(--border); text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-secondary)'">{{ $lastPage }}</a>
        @endif

        {{-- Next --}}
        @if($assets->hasMorePages())
            <a href="{{ $assets->nextPageUrl() }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: white; color: var(--text-secondary); border: 1px solid var(--border); text-decoration: none; font-size: 0.875rem; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-secondary)'">&rsaquo;</a>
        @else
            <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: var(--radius-md); background: var(--bg-tertiary); color: var(--text-muted); font-size: 0.875rem; cursor: not-allowed;">&rsaquo;</span>
        @endif
    </div>

    {{-- Per page selector --}}
    <div style="display: flex; align-items: center; gap: 0.5rem;">
        <select onchange="window.location.href=this.value" class="form-select" style="font-size: 0.8125rem; padding: 0.5rem 0.75rem; width: auto;">
            @foreach([10, 25, 50, 100] as $pp)
                <option value="{{ request()->fullUrlWithQuery(['per_page' => $pp, 'page' => 1]) }}" {{ $assets->perPage() == $pp ? 'selected' : '' }}>{{ $pp }} / halaman</option>
            @endforeach
        </select>
    </div>
</div>
@else
<div style="margin-top: 1rem; font-size: 0.875rem; color: var(--text-muted);">
    Menampilkan {{ $assets->total() }} data
</div>
@endif

<style>
    @media (max-width: 1200px) {
        div[style*="grid-template-columns: repeat(5"] {
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }
    @media (max-width: 768px) {
        div[style*="grid-template-columns: repeat(5"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    @media (max-width: 480px) {
        div[style*="grid-template-columns: repeat(5"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection