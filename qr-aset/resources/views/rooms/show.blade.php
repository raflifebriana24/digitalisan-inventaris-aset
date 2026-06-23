@extends('layout')
@section('content')

<div style="margin-bottom: 2rem;">
    <a href="{{ route('rooms.index') }}" class="btn btn-secondary" style="margin-bottom: 1rem;">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Kembali ke Daftar Ruangan
    </a>
    <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">{{ $room->nama_ruangan }}</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Kode: <strong>{{ $room->kode_ruangan }}</strong></p>
</div>

<div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light); margin-bottom: 2rem;">
    <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem;">Informasi Ruangan</h3>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div>
            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Gedung</label>
            <div style="font-size: 1rem; color: var(--text-primary);">{{ $room->gedung ?? '-' }}</div>
        </div>
        <div>
            <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Lantai</label>
            <div style="font-size: 1rem; color: var(--text-primary);">{{ $room->lantai ?? '-' }}</div>
        </div>
    </div>

    @if($room->deskripsi)
    <div style="margin-top: 1.5rem;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: var(--text-muted); margin-bottom: 0.375rem;">Deskripsi</label>
        <div style="font-size: 0.9375rem; color: var(--text-secondary); line-height: 1.6;">{{ $room->deskripsi }}</div>
    </div>
    @endif
</div>

<div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);">
            Aset di Ruangan Ini ({{ $room->assets->count() }})
        </h3>
        <a href="{{ route('assets.index') }}" class="btn btn-primary btn-sm">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Tambah Aset
        </a>
    </div>

    @forelse($room->assets as $asset)
    <div style="display: flex; gap: 1rem; padding: 1rem; background: white; border-radius: var(--radius-md); margin-bottom: 0.75rem; border: 1px solid var(--border-light);">
        @if($asset->image_path)
            <img src="{{ asset('storage/'.$asset->image_path) }}" 
                 alt="{{ $asset->nama_aset }}" 
                 style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius); border: 2px solid var(--border); flex-shrink: 0;">
        @else
            <div style="width: 60px; height: 60px; background: var(--bg-tertiary); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; border: 2px solid var(--border); flex-shrink: 0;">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20" style="color: var(--text-muted);">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                </svg>
            </div>
        @endif
        <div style="flex: 1;">
            <div style="font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;">{{ $asset->nama_aset }}</div>
            <div style="font-size: 0.875rem; color: var(--text-secondary);">{{ $asset->kode_aset }} • {{ $asset->kategori }}</div>
        </div>
        <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-info btn-sm" style="align-self: center;">
            Detail
        </a>
    </div>
    @empty
    <p style="text-align: center; color: var(--text-muted); padding: 2rem;">Belum ada aset di ruangan ini</p>
    @endforelse
</div>

<div style="display: flex; gap: 0.75rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light); margin-top: 2rem;">
    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
        </svg>
        Edit Ruangan
    </a>
    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            Hapus Ruangan
        </button>
    </form>
</div>

@endsection
