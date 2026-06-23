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

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">Daftar Ruangan</h2>
        <p style="color: var(--text-secondary); font-size: 0.9375rem;">Kelola ruangan di Diskominfo Kota Serang</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Tambah Ruangan
    </a>
    @endif
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Kode Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Gedung</th>
                <th>Lantai</th>
                <th style="text-align: center;">Jumlah Aset</th>
                <th style="text-align: center; width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
            <tr>
                <td><strong>{{ $room->kode_ruangan }}</strong></td>
                <td>{{ $room->nama_ruangan }}</td>
                <td>{{ $room->gedung ?? '-' }}</td>
                <td>{{ $room->lantai ?? '-' }}</td>
                <td style="text-align: center;">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #eff6ff; color: #1e40af; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">
                        {{ $room->assets_count }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            Detail
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus ruangan {{ $room->nama_ruangan }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 3rem; color: var(--text-muted);">
                    <svg width="64" height="64" fill="currentColor" viewBox="0 0 20 20" style="margin: 0 auto 1rem; opacity: 0.3;">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <div style="font-size: 1rem; font-weight: 500;">Belum ada data ruangan</div>
                    <div style="font-size: 0.875rem; margin-top: 0.5rem;">Klik tombol "Tambah Ruangan" untuk memulai</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
