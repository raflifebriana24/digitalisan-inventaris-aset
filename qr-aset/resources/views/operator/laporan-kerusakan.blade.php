@extends('layout')
@section('content')

{{-- Header --}}
<div style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
        <div>
            <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.75rem;">
                <span style="display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, #ef4444, #dc2626); width:40px; height:40px; border-radius: var(--radius-md); flex-shrink:0;">
                    <svg width="22" height="22" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </span>
                Laporan Kerusakan Aset
            </h2>
            <p style="color: var(--text-secondary); font-size: 0.9375rem;">Riwayat laporan kerusakan yang Anda kirimkan kepada Admin.</p>
        </div>
        <a href="{{ route('operator.laporan-kerusakan.buat') }}" class="btn btn-danger" style="display:inline-flex; align-items:center; gap:0.5rem; background: linear-gradient(135deg, #ef4444, #dc2626);">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Buat Laporan Baru
        </a>
    </div>
</div>

{{-- Notif success --}}
@if(session('success'))
<div class="alert alert-success" style="margin-bottom: 1.5rem;">
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- Statistik --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 1.25rem 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
        <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Rusak Ringan</div>
        <div style="font-size: 2rem; font-weight: 800;">{{ $totalRusakRingan }}</div>
        <div style="font-size: 0.8rem; opacity: 0.85;">Laporan Anda</div>
    </div>
    <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 1.25rem 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
        <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Rusak Berat</div>
        <div style="font-size: 2rem; font-weight: 800;">{{ $totalRusakBerat }}</div>
        <div style="font-size: 0.8rem; opacity: 0.85;">Laporan Anda</div>
    </div>
    <div style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 1.25rem 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
        <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">Total Laporan</div>
        <div style="font-size: 2rem; font-weight: 800;">{{ $totalRusakRingan + $totalRusakBerat }}</div>
        <div style="font-size: 0.8rem; opacity: 0.85;">Semua kerusakan</div>
    </div>
</div>

{{-- Tabel Riwayat Laporan --}}
<div style="background: white; border-radius: var(--radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1rem; font-weight: 600; color: var(--text-primary); margin: 0; display:flex; align-items:center; gap: 0.5rem;">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20" style="color: var(--danger);">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            Riwayat Laporan Saya
        </h3>
        <span style="font-size: 0.8125rem; color: var(--text-muted); background: var(--bg-tertiary); padding: 0.25rem 0.75rem; border-radius: var(--radius-sm);">
            {{ $laporan->total() }} laporan
        </span>
    </div>

    <div class="table-container" style="border:none; border-radius:0;">
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Aset</th>
                    <th>Kondisi</th>
                    <th>Catatan Kerusakan</th>
                    <th>Waktu Laporan</th>
                    <th style="text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $i => $check)
                <tr>
                    <td style="color:var(--text-muted); font-size:0.875rem;">{{ $laporan->firstItem() + $i }}</td>
                    <td>
                        <a href="{{ route('assets.show', $check->asset_id) }}" style="font-weight:700; color:var(--primary); text-decoration:none; font-size:0.9375rem;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            {{ $check->asset->nama_aset ?? '-' }}
                        </a>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:0.1rem; background:var(--bg-tertiary); display:inline-block; padding:0.1rem 0.4rem; border-radius:var(--radius-sm);">
                            {{ $check->asset->kode_aset ?? '-' }}
                        </div>
                    </td>
                    <td>
                        @if($check->kondisi === 'Rusak Berat')
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.8125rem; font-weight:700; padding:0.3rem 0.75rem; border-radius:9999px; background:#fee2e2; color:#991b1b; border:1px solid #fca5a5;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                Rusak Berat
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.8125rem; font-weight:700; padding:0.3rem 0.75rem; border-radius:9999px; background:#fef3c7; color:#92400e; border:1px solid #fcd34d;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                Rusak Ringan
                            </span>
                        @endif
                    </td>
                    <td style="max-width:260px;">
                        @if($check->catatan)
                            <p style="font-size:0.875rem; color:var(--text-secondary); margin:0; background:var(--bg-tertiary); padding:0.4rem 0.6rem; border-radius:var(--radius-sm); border-left:3px solid {{ $check->kondisi === 'Rusak Berat' ? '#ef4444' : '#f59e0b' }};">
                                "{{ \Illuminate\Support\Str::limit($check->catatan, 90) }}"
                            </p>
                        @else
                            <span style="color:var(--text-muted); font-style:italic;">-</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:0.875rem; color:var(--text-secondary);">{{ $check->created_at->format('d M Y') }}</div>
                        <div style="font-size:0.75rem; color:var(--text-muted);">{{ $check->created_at->diffForHumans() }}</div>
                    </td>
                    <td style="text-align:center;">
                        @if($check->status_verifikasi === 'Disetujui')
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.75rem; font-weight:600; padding:0.25rem 0.7rem; border-radius:9999px; background:#d1fae5; color:#065f46; border:1px solid #6ee7b7;">
                                <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Disetujui
                            </span>
                        @elseif($check->status_verifikasi === 'Ditolak')
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.75rem; font-weight:600; padding:0.25rem 0.7rem; border-radius:9999px; background:#fee2e2; color:#991b1b; border:1px solid #fca5a5;">
                                <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                Ditolak
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.75rem; font-weight:600; padding:0.25rem 0.7rem; border-radius:9999px; background:#fef3c7; color:#92400e; border:1px solid #fcd34d;">
                                <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                Menunggu Verifikasi
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:3.5rem; color:var(--text-muted);">
                        <svg width="52" height="52" fill="currentColor" viewBox="0 0 20 20" style="margin:0 auto 1rem; opacity:0.25; display:block;">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div style="font-weight:600; font-size:1rem;">Belum ada laporan kerusakan</div>
                        <div style="font-size:0.875rem; margin-top:0.35rem;">Gunakan tombol "Buat Laporan Baru" jika menemukan aset yang rusak.</div>
                        <a href="{{ route('operator.laporan-kerusakan.buat') }}" class="btn btn-danger" style="margin-top:1rem; display:inline-flex; align-items:center; gap:0.5rem; background:linear-gradient(135deg,#ef4444,#dc2626);">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Buat Laporan Sekarang
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($laporan->hasPages())
    <div style="padding:1.25rem 1.5rem; border-top:1px solid var(--border-light); display:flex; justify-content:center;">
        {{ $laporan->links() }}
    </div>
    @endif
</div>

@endsection
