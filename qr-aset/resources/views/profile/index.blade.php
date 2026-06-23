@extends('layout')
@section('content')

@if(session('success'))
    <div class="alert alert-success" style="margin-bottom: 1.5rem;">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">Profile</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Kelola informasi akun Anda</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Update Profile Card -->
    <div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light);">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            Informasi Profile
        </h3>

        @if($errors->updateProfile->any())
            <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
                <strong>Error:</strong>
                <ul style="margin: 0.5rem 0 0 1.25rem;">
                    @foreach($errors->updateProfile->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Update Profile
            </button>
        </form>
    </div>

    <!-- Update Password Card -->
    <div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light);">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
            </svg>
            Ubah Password
        </h3>

        @if($errors->updatePassword->any())
            <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
                <strong>Error:</strong>
                <ul style="margin: 0.5rem 0 0 1.25rem;">
                    @foreach($errors->updatePassword->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password" class="form-label">Password Saat Ini</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small class="text-muted">Minimal 8 karakter</small>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-warning">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                Ubah Password
            </button>
        </form>
    </div>
</div>

<!-- Account Info -->
<div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light); margin-top: 2rem;">
    <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1.5rem;">Informasi Akun</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div>
            <label style="font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Akun Dibuat</label>
            <div style="font-size: 0.9375rem; color: var(--text-primary);">{{ $user->created_at->format('d F Y, H:i') }}</div>
        </div>
        <div>
            <label style="font-size: 0.875rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Terakhir Diupdate</label>
            <div style="font-size: 0.9375rem; color: var(--text-primary);">{{ $user->updated_at->format('d F Y, H:i') }}</div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection
