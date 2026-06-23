@extends('layout')
@section('content')

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">Dashboard Operator</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut adalah menu aksi cepat dan aktivitas terbaru Anda.</p>

<!-- Quick Menu / Tombol Aksi Operator -->
<div style="margin-bottom: 2.5rem;">
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="color: var(--primary);">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        Menu Aksi Operator
    </h3>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
        <!-- Laporan Kerusakan -->
        <a href="{{ route('assets.index', ['action' => 'report']) }}" class="menu-btn" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 1.25rem; border-radius: var(--radius-lg); text-decoration: none; display: flex; align-items: center; gap: 1rem; box-shadow: var(--shadow-md); transition: all 0.3s ease;">
            <div style="background: rgba(255,255,255,0.2); padding: 0.75rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <div style="font-weight: 700; font-size: 1rem;">Laporan Kerusakan</div>
                <div style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.15rem;">Laporkan aset rusak/hilang</div>
            </div>
        </a>

        <!-- Pembaruan Informasi -->
        <a href="{{ route('assets.index') }}" class="menu-btn" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 1.25rem; border-radius: var(--radius-lg); text-decoration: none; display: flex; align-items: center; gap: 1rem; box-shadow: var(--shadow-md); transition: all 0.3s ease;">
            <div style="background: rgba(255,255,255,0.2); padding: 0.75rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <div style="font-weight: 700; font-size: 1rem;">Pembaruan Informasi</div>
                <div style="font-size: 0.75rem; opacity: 0.85; margin-top: 0.15rem;">Update lokasi & status aset</div>
            </div>
        </a>

    </div>
</div>

<!-- Extra styles for menu buttons hover effect -->
<style>
    .menu-btn {
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s ease, filter 0.2s ease !important;
    }
    .menu-btn:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15), 0 8px 8px -6px rgba(0, 0, 0, 0.15) !important;
        filter: brightness(1.08);
    }
</style>

<div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
    <!-- Recent Checks -->
    <div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light);">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" style="color: var(--primary);">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            Pengecekan Terakhir Anda
        </h3>

        @if($recentChecks->isEmpty())
            <p style="color: var(--text-muted); font-size: 0.9375rem; text-align: center; padding: 1rem 0;">Belum ada riwayat pengecekan.</p>
        @else
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($recentChecks as $check)
                    <div style="background: white; padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--border); box-shadow: var(--shadow-sm);">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; align-items: flex-start;">
                            <div>
                                <a href="{{ route('assets.show', $check->asset_id) }}" style="font-weight: 600; color: var(--primary); text-decoration: none;">
                                    {{ $check->asset->nama_aset }} ({{ $check->asset->kode_aset }})
                                </a>
                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">{{ $check->created_at->diffForHumans() }}</div>
                            </div>
                            <form action="{{ route('assets.check.destroy', $check->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat pengecekan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; padding: 0.25rem; opacity: 0.7; transition: opacity 0.2s;" title="Hapus Riwayat" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span style="font-size: 0.875rem; color: var(--text-secondary);">Kondisi:</span>
                            <span style="font-size: 0.75rem; font-weight: 600; padding: 0.2rem 0.5rem; border-radius: 9999px; border: 1px solid;
                                {{ $check->kondisi == 'Baik' ? 'background: #d1fae5; color: #065f46; border-color: #6ee7b7;' : '' }}
                                {{ $check->kondisi == 'Rusak Ringan' ? 'background: #fef3c7; color: #92400e; border-color: #fcd34d;' : '' }}
                                {{ $check->kondisi == 'Rusak Berat' ? 'background: #fee2e2; color: #991b1b; border-color: #fca5a5;' : '' }}
                            ">
                                {{ $check->kondisi }}
                            </span>
                        </div>
                        @if($check->catatan)
                            <p style="font-size: 0.875rem; color: var(--text-secondary); margin: 0; background: var(--bg-tertiary); padding: 0.5rem; border-radius: var(--radius-sm);">
                                "{{ $check->catatan }}"
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>


</div>



@endsection
