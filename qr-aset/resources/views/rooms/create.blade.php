@extends('layout')
@section('content')

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">Tambah Ruangan Baru</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Lengkapi form di bawah untuk menambahkan ruangan baru</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
            <strong>Terdapat kesalahan:</strong>
            <ul style="margin-top: 0.5rem; padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action="{{ route('rooms.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="kode_ruangan" class="form-label">Kode Ruangan *</label>
        <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" value="{{ old('kode_ruangan') }}" placeholder="Contoh: R101" required>
        <small class="text-muted">Kode unik untuk identifikasi ruangan</small>
    </div>

    <div class="form-group">
        <label for="nama_ruangan" class="form-label">Nama Ruangan *</label>
        <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan') }}" placeholder="Contoh: Ruang Meeting" required>
    </div>

    <div class="form-group">
        <label for="gedung" class="form-label">Gedung</label>
        <input type="text" class="form-control" id="gedung" name="gedung" value="{{ old('gedung') }}" placeholder="Contoh: Gedung A">
    </div>

    <div class="form-group">
        <label for="lantai" class="form-label">Lantai</label>
        <input type="text" class="form-control" id="lantai" name="lantai" value="{{ old('lantai') }}" placeholder="Contoh: Lantai 1">
    </div>

    <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi atau catatan tambahan (opsional)">{{ old('deskripsi') }}</textarea>
    </div>

    <div style="display: flex; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid var(--border-light);">
        <button type="submit" class="btn btn-primary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Simpan Ruangan
        </button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Batal
        </a>
    </div>
</form>

@endsection
