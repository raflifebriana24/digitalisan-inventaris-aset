@extends('layout')
@section('content')

{{-- Header --}}
<div style="margin-bottom: 2rem;">
    <a href="{{ route('operator.laporan-kerusakan') }}" class="btn btn-secondary" style="margin-bottom:1rem; display:inline-flex; align-items:center; gap:0.5rem;">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
        Kembali ke Riwayat Laporan
    </a>
    <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.35rem; display:flex; align-items:center; gap:0.75rem;">
        <span style="display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, #ef4444, #dc2626); width:40px; height:40px; border-radius: var(--radius-md); flex-shrink:0;">
            <svg width="22" height="22" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </span>
        Buat Laporan Kerusakan
    </h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Pilih aset yang rusak, pilih tingkat kerusakan, dan deskripsikan kondisinya. Laporan akan langsung terkirim ke Admin.</p>
</div>

{{-- Info banner --}}
<div style="background: linear-gradient(135deg, #fef3c7, #fffbeb); border: 1px solid #fcd34d; border-radius: var(--radius-lg); padding: 1rem 1.25rem; margin-bottom: 2rem; display:flex; align-items:flex-start; gap:0.75rem;">
    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20" style="color:#d97706; flex-shrink:0; margin-top:0.1rem;">
        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
    <div>
        <strong style="color:#92400e; font-size:0.9375rem;">Informasi Penting</strong>
        <p style="color:#92400e; font-size:0.875rem; margin:0.25rem 0 0;">Laporan ini hanya dapat diisi untuk aset yang mengalami kerusakan (<strong>Rusak Ringan</strong> atau <strong>Rusak Berat</strong>). Kondisi aset akan otomatis diperbarui dan Admin dapat melihat laporan ini di dashboard mereka.</p>
    </div>
</div>

{{-- Validation Errors --}}
@if($errors->any())
<div class="alert alert-danger" style="margin-bottom:1.5rem; flex-direction:column; align-items:flex-start; gap:0.5rem;">
    <div style="display:flex; align-items:center; gap:0.5rem; font-weight:600;">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
        Harap perbaiki kesalahan berikut:
    </div>
    <ul style="margin:0; padding-left:1.25rem; font-size:0.875rem;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Form Laporan --}}
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
    
    {{-- Form utama --}}
    <form action="{{ route('operator.laporan-kerusakan.kirim') }}" method="POST" id="form-laporan">
        @csrf
        <div style="background: white; border-radius: var(--radius-lg); border: 1px solid var(--border-light); box-shadow: var(--shadow-sm); padding: 2rem;">
            
            {{-- Pilih Aset --}}
            <div class="form-group">
                <label class="form-label" for="asset_id" style="font-size:1rem; font-weight:600;">
                    <span style="display:inline-flex; align-items:center; gap:0.4rem;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" style="color:var(--primary);"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                        Pilih Aset yang Rusak <span style="color:#ef4444;">*</span>
                    </span>
                </label>
                <select name="asset_id" id="asset_id" class="form-select" required onchange="updateAssetInfo(this)">
                    <option value="">-- Pilih Aset --</option>
                    @foreach($assets as $asset)
                    <option value="{{ $asset->id }}"
                        data-kode="{{ $asset->kode_aset }}"
                        data-lokasi="{{ $asset->lokasi }}"
                        data-kondisi="{{ $asset->kondisi ?? 'Baik' }}"
                        {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                        {{ $asset->nama_aset }} ({{ $asset->kode_aset }})
                    </option>
                    @endforeach
                </select>
                <span class="text-muted">Pilih aset yang Anda temukan mengalami kerusakan di lapangan.</span>
            </div>

            {{-- Info aset (muncul setelah dipilih) --}}
            <div id="asset-info-box" style="display:none; background:var(--bg-tertiary); border:1px solid var(--border); border-radius:var(--radius-md); padding:1rem; margin-bottom:1.5rem;">
                <div style="font-size:0.8125rem; color:var(--text-muted); margin-bottom:0.5rem; font-weight:600;">Info Aset Terpilih</div>
                <div style="display:flex; gap:1.5rem; flex-wrap:wrap;">
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-muted);">Kode</span>
                        <div id="info-kode" style="font-weight:700; color:var(--primary);"></div>
                    </div>
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-muted);">Lokasi</span>
                        <div id="info-lokasi" style="font-weight:600; color:var(--text-primary);"></div>
                    </div>
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-muted);">Kondisi Terakhir</span>
                        <div id="info-kondisi" style="font-weight:600;"></div>
                    </div>
                </div>
            </div>

            {{-- Tingkat Kerusakan --}}
            <div class="form-group">
                <label class="form-label" style="font-size:1rem; font-weight:600;">
                    <span style="display:inline-flex; align-items:center; gap:0.4rem;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" style="color:#ef4444;"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        Tingkat Kerusakan <span style="color:#ef4444;">*</span>
                    </span>
                </label>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    {{-- Rusak Ringan --}}
                    <label for="rusak_ringan" style="cursor:pointer;">
                        <input type="radio" id="rusak_ringan" name="kondisi" value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'checked' : '' }} style="display:none;" class="kondisi-radio">
                        <div class="kondisi-card" data-value="Rusak Ringan" style="border:2px solid var(--border); border-radius:var(--radius-lg); padding:1.25rem; text-align:center; transition:all 0.2s;">
                            <div style="font-size:2rem; margin-bottom:0.5rem;">⚠️</div>
                            <div style="font-weight:700; font-size:1rem; color:#92400e;">Rusak Ringan</div>
                            <div style="font-size:0.8125rem; color:var(--text-muted); margin-top:0.25rem;">Aset masih dapat digunakan namun perlu diperbaiki</div>
                        </div>
                    </label>
                    {{-- Rusak Berat --}}
                    <label for="rusak_berat" style="cursor:pointer;">
                        <input type="radio" id="rusak_berat" name="kondisi" value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'checked' : '' }} style="display:none;" class="kondisi-radio">
                        <div class="kondisi-card" data-value="Rusak Berat" style="border:2px solid var(--border); border-radius:var(--radius-lg); padding:1.25rem; text-align:center; transition:all 0.2s;">
                            <div style="font-size:2rem; margin-bottom:0.5rem;">🚨</div>
                            <div style="font-weight:700; font-size:1rem; color:#991b1b;">Rusak Berat</div>
                            <div style="font-size:0.8125rem; color:var(--text-muted); margin-top:0.25rem;">Aset tidak dapat digunakan dan perlu penanganan segera</div>
                        </div>
                    </label>
                </div>
                @error('kondisi')
                    <span class="text-muted" style="color:#ef4444;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Catatan Kerusakan --}}
            <div class="form-group">
                <label class="form-label" for="catatan" style="font-size:1rem; font-weight:600;">
                    <span style="display:inline-flex; align-items:center; gap:0.4rem;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" style="color:var(--primary);"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm8 8v2h1v1H4v-1h1v-2a1 1 0 011-1h8a1 1 0 011 1z" clip-rule="evenodd"/></svg>
                        Deskripsi Kerusakan <span style="color:#ef4444;">*</span>
                    </span>
                </label>
                <textarea name="catatan" id="catatan" class="form-control" rows="5" required minlength="10" maxlength="1000"
                    placeholder="Deskripsikan kerusakan secara detail. Contoh: &#10;- Bagian mana yang rusak&#10;- Penyebab kerusakan (jika diketahui)&#10;- Kondisi terakhir saat ditemukan">{{ old('catatan') }}</textarea>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0.35rem;">
                    <span class="text-muted">Minimal 10 karakter. Deskripsikan dengan jelas agar Admin dapat menindaklanjuti.</span>
                    <span id="char-count" style="font-size:0.75rem; color:var(--text-muted);">0/1000</span>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div style="display:flex; gap:0.75rem; padding-top:0.5rem;">
                <button type="submit" class="btn btn-danger" style="flex:1; justify-content:center; background:linear-gradient(135deg,#ef4444,#dc2626); font-size:1rem; padding:0.875rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Laporan ke Admin
                </button>
                <a href="{{ route('operator.laporan-kerusakan') }}" class="btn btn-secondary" style="padding:0.875rem 1.25rem;">
                    Batal
                </a>
            </div>
        </div>
    </form>

    {{-- Panel panduan --}}
    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <div style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color:white; padding:1.5rem; border-radius:var(--radius-lg); box-shadow:var(--shadow-md);">
            <h4 style="font-weight:700; margin-bottom:1rem; font-size:1rem; display:flex; align-items:center; gap:0.5rem;">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                Panduan Pengisian
            </h4>
            <ol style="font-size:0.875rem; opacity:0.95; padding-left:1.25rem; line-height:1.9; margin:0;">
                <li>Pilih aset yang ditemukan rusak dari daftar</li>
                <li>Pilih tingkat kerusakan: <strong>Rusak Ringan</strong> atau <strong>Rusak Berat</strong></li>
                <li>Isi deskripsi kerusakan dengan detail dan jelas</li>
                <li>Klik <strong>"Kirim Laporan ke Admin"</strong></li>
                <li>Admin akan menerima notifikasi di dashboard mereka</li>
            </ol>
        </div>

        <div style="background:white; border:1px solid var(--border-light); border-radius:var(--radius-lg); padding:1.5rem; box-shadow:var(--shadow-sm);">
            <h4 style="font-weight:700; margin-bottom:0.75rem; font-size:0.9375rem; color:var(--text-primary);">
                Perbedaan Tingkat Kerusakan
            </h4>
            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                <div style="background:#fef3c7; border-radius:var(--radius-md); padding:0.875rem; border-left:4px solid #f59e0b;">
                    <div style="font-weight:700; color:#92400e; font-size:0.875rem; margin-bottom:0.25rem;">⚠️ Rusak Ringan</div>
                    <div style="font-size:0.8125rem; color:#78350f;">Fungsi aset masih berjalan sebagian. Contoh: retak, goresan, tombol macet, layar redup.</div>
                </div>
                <div style="background:#fee2e2; border-radius:var(--radius-md); padding:0.875rem; border-left:4px solid #ef4444;">
                    <div style="font-weight:700; color:#991b1b; font-size:0.875rem; margin-bottom:0.25rem;">🚨 Rusak Berat</div>
                    <div style="font-size:0.8125rem; color:#7f1d1d;">Aset tidak dapat digunakan sama sekali. Contoh: tidak menyala, komponen patah/hilang, terbakar.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .kondisi-card:hover {
        border-color: #ef4444 !important;
        background: #fff5f5;
    }
    .kondisi-radio:checked + .kondisi-card {
        border-color: #ef4444 !important;
        background: #fee2e2;
        box-shadow: 0 0 0 3px rgba(239,68,68,0.15);
    }
    @media (max-width: 900px) {
        div[style*="grid-template-columns: 2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
    @media (max-width: 600px) {
        div[style*="grid-template-columns:1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script>
function updateAssetInfo(select) {
    const box = document.getElementById('asset-info-box');
    if (!select.value) {
        box.style.display = 'none';
        return;
    }
    const opt = select.options[select.selectedIndex];
    document.getElementById('info-kode').textContent = opt.dataset.kode || '-';
    document.getElementById('info-lokasi').textContent = opt.dataset.lokasi || '-';
    const kondisi = opt.dataset.kondisi || 'Baik';
    const el = document.getElementById('info-kondisi');
    el.textContent = kondisi;
    el.style.color = kondisi === 'Baik' ? '#059669' : kondisi === 'Rusak Ringan' ? '#d97706' : '#dc2626';
    box.style.display = 'block';
}

// Char counter
document.getElementById('catatan').addEventListener('input', function() {
    document.getElementById('char-count').textContent = this.value.length + '/1000';
});

// Radio visual
document.querySelectorAll('.kondisi-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.kondisi-card').forEach(card => {
            card.style.borderColor = 'var(--border)';
            card.style.background = 'white';
            card.style.boxShadow = 'none';
        });
        if (this.checked) {
            const card = this.nextElementSibling;
            card.style.borderColor = '#ef4444';
            card.style.background = '#fee2e2';
            card.style.boxShadow = '0 0 0 3px rgba(239,68,68,0.15)';
        }
    });
});

// Restore state on page load (for validation errors)
document.querySelectorAll('.kondisi-radio').forEach(radio => {
    if (radio.checked) {
        const card = radio.nextElementSibling;
        card.style.borderColor = '#ef4444';
        card.style.background = '#fee2e2';
        card.style.boxShadow = '0 0 0 3px rgba(239,68,68,0.15)';
    }
});

// Restore asset info on reload
const assetSelect = document.getElementById('asset_id');
if (assetSelect.value) updateAssetInfo(assetSelect);
</script>

@endsection
