@extends('layout')
@section('content')

{{-- Header --}}
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.75rem;">
            <span style="display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, #ef4444, #dc2626); width:40px; height:40px; border-radius: var(--radius-md); flex-shrink:0;">
                <svg width="22" height="22" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </span>
            Laporan Kerusakan Aset
        </h2>
        <p style="color: var(--text-secondary); font-size: 0.9375rem;">Daftar aset yang dilaporkan rusak oleh Operator</p>
    </div>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="display:inline-flex; align-items:center; gap:0.5rem;">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
        Kembali ke Dashboard
    </a>
</div>

{{-- Stats Cards --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
        <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Rusak Ringan</div>
        <div style="font-size: 2.25rem; font-weight: 800;">{{ $totalRusakRingan }}</div>
        <div style="font-size: 0.8125rem; opacity: 0.85; margin-top: 0.25rem;">Laporan masuk</div>
    </div>
    <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
        <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Rusak Berat</div>
        <div style="font-size: 2.25rem; font-weight: 800;">{{ $totalRusakBerat }}</div>
        <div style="font-size: 0.8125rem; opacity: 0.85; margin-top: 0.25rem;">Laporan masuk</div>
    </div>
    <div style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
        <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Laporan</div>
        <div style="font-size: 2.25rem; font-weight: 800;">{{ $totalRusakRingan + $totalRusakBerat }}</div>
        <div style="font-size: 0.8125rem; opacity: 0.85; margin-top: 0.25rem;">Semua kerusakan</div>
    </div>
</div>



{{-- Tabel Laporan --}}
<div style="background: white; border-radius: var(--radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); overflow: hidden;">
    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-light); display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1rem; font-weight: 600; color: var(--text-primary); margin: 0;">
            Daftar Laporan Kerusakan
        </h3>
        <span style="font-size: 0.8125rem; color: var(--text-muted); background: var(--bg-tertiary); padding: 0.25rem 0.75rem; border-radius: var(--radius-sm);">
            Total: {{ $laporan->total() }} laporan
        </span>
    </div>

    <div class="table-container" style="border-radius: 0; border: none;">
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Aset</th>
                    <th>Umur Aset</th>
                    <th>Dilaporkan Oleh</th>
                    <th>Kondisi</th>
                    <th>Catatan</th>
                    <th>Waktu</th>
                    <th>Status Verifikasi</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $i => $check)
                <tr style="animation: fadeInUp {{ ($i % 15) * 0.04 + 0.1 }}s ease;">
                    <td style="color: var(--text-muted); font-size: 0.875rem;">{{ $laporan->firstItem() + $i }}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-primary); font-size: 0.9375rem;">{{ $check->asset->nama_aset ?? '-' }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.125rem; background: var(--bg-tertiary); display: inline-block; padding: 0.1rem 0.5rem; border-radius: var(--radius-sm);">
                            {{ $check->asset->kode_aset ?? '-' }}
                        </div>
                    </td>
                    <td>
                        @if($check->asset && $check->asset->tahun_perolehan)
                            <div style="font-weight: 600; color: {{ $check->asset->umur >= 5 ? '#dc2626' : 'var(--text-primary)' }}; font-size: 0.9375rem; display: flex; align-items: center; gap: 0.25rem;">
                                {{ $check->asset->umur }} Tahun
                                @if($check->asset->umur >= 5)
                                    <span style="font-size: 0.6875rem; font-weight: 700; background: #fee2e2; color: #991b1b; padding: 0.1rem 0.35rem; border-radius: 9999px;">≥ 5 Thn</span>
                                @endif
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.125rem;">
                                Perolehan: {{ $check->asset->tahun_perolehan }}
                            </div>
                        @else
                            <span style="color: var(--text-muted); font-style: italic; font-size: 0.875rem;">Tidak diisi</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <div style="width: 32px; height: 32px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 700; flex-shrink: 0;">
                                {{ strtoupper(substr($check->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-size: 0.875rem; font-weight: 600; color: var(--text-primary);">{{ $check->user->name ?? 'Tidak diketahui' }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Operator</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($check->kondisi === 'Rusak Berat')
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.8125rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: 9999px; background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                Rusak Berat
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.8125rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: 9999px; background: #fef3c7; color: #92400e; border: 1px solid #fcd34d;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                Rusak Ringan
                            </span>
                        @endif
                    </td>
                    <td style="max-width: 220px;">
                        @if($check->catatan)
                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0; background: var(--bg-tertiary); padding: 0.4rem 0.6rem; border-radius: var(--radius-sm); border-left: 3px solid var(--warning);">
                                "{{ \Illuminate\Support\Str::limit($check->catatan, 80) }}"
                            </p>
                        @else
                            <span style="color: var(--text-muted); font-style: italic; font-size: 0.875rem;">Tidak ada catatan</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-size: 0.875rem; color: var(--text-secondary);">{{ $check->created_at->format('d M Y') }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $check->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        @if($check->status_verifikasi === 'Menunggu Verifikasi')
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.75rem; font-weight:600; padding:0.25rem 0.7rem; border-radius:9999px; background:#fef3c7; color:#92400e; border:1px solid #fcd34d;">
                                Menunggu Verifikasi
                            </span>
                        @elseif($check->status_verifikasi === 'Disetujui')
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.75rem; font-weight:600; padding:0.25rem 0.7rem; border-radius:9999px; background:#d1fae5; color:#065f46; border:1px solid #6ee7b7;">
                                Disetujui
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:0.3rem; font-size:0.75rem; font-weight:600; padding:0.25rem 0.7rem; border-radius:9999px; background:#fee2e2; color:#991b1b; border:1px solid #fca5a5;">
                                Ditolak
                            </span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div style="display:flex; flex-direction:column; gap:0.5rem; align-items:center;">
                            <a href="{{ route('assets.show', $check->asset_id) }}" class="btn btn-info btn-sm" style="white-space:nowrap; width:100%; justify-content:center;">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                Lihat Aset
                            </a>
                            
                            @if($check->status_verifikasi === 'Menunggu Verifikasi')
                            <div style="display:flex; gap:0.25rem; width:100%;">
                                <form action="{{ route('admin.laporan-kerusakan.setujui', $check->id) }}" method="POST" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" style="width:100%; padding:0.25rem;" title="Setujui" onclick="return confirm('Setujui laporan ini dan ubah kondisi aset?');">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.laporan-kerusakan.tolak', $check->id) }}" method="POST" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" style="width:100%; padding:0.25rem;" title="Tolak" onclick="return confirm('Tolak laporan kerusakan ini?');">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding: 3.5rem; color: var(--text-muted);">
                        <svg width="52" height="52" fill="currentColor" viewBox="0 0 20 20" style="margin: 0 auto 1rem; opacity:0.3; display:block;">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div style="font-weight: 600; font-size: 1rem;">Tidak ada laporan kerusakan</div>
                        <div style="font-size: 0.875rem; margin-top: 0.35rem;">Belum ada operator yang melaporkan kerusakan aset.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($laporan->hasPages())
    <div style="padding: 1.25rem 1.5rem; border-top: 1px solid var(--border-light); display: flex; justify-content: center;">
        {{ $laporan->links() }}
    </div>
    @endif
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 900px) {
        div[style*="grid-template-columns: 1fr 1fr 1fr auto auto"] {
            grid-template-columns: 1fr 1fr !important;
        }
    }
    @media (max-width: 600px) {
        div[style*="grid-template-columns: 1fr 1fr 1fr auto auto"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection
