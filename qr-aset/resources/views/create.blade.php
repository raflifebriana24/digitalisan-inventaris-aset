@extends('layout')
@section('content')

<style>
.drop-zone {
    border: 2px dashed var(--primary-light);
    border-radius: var(--radius-md);
    padding: 2rem;
    text-align: center;
    background: var(--bg-primary);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    min-height: 180px;
}

.drop-zone:hover {
    border-color: var(--primary);
    background: rgba(59, 130, 246, 0.05);
}

.drop-zone.drag-over {
    border-color: var(--secondary);
    background: rgba(249, 115, 22, 0.08);
    transform: scale(1.01);
}

.drop-zone-icon {
    font-size: 2.5rem;
    color: var(--primary-light);
    transition: transform 0.3s ease;
}

.drop-zone:hover .drop-zone-icon {
    transform: translateY(-5px);
    color: var(--primary);
}

.drop-zone.drag-over .drop-zone-icon {
    transform: scale(1.2);
    color: var(--secondary);
}

.drop-zone-text {
    font-size: 0.9375rem;
    font-weight: 500;
    color: var(--text-primary);
}

.drop-zone-subtext {
    font-size: 0.8125rem;
    color: var(--text-muted);
}

.preview-container {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
}

.preview-image {
    max-width: 250px;
    max-height: 200px;
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
    border: 3px solid white;
    transition: transform 0.2s ease;
}

.preview-image:hover {
    transform: scale(1.05);
}

.remove-btn {
    background: var(--danger);
    color: white;
    border: none;
    padding: 0.375rem 0.75rem;
    font-size: 0.8125rem;
    font-weight: 600;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: background 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.remove-btn:hover {
    background: #dc2626;
}
</style>

<div style="margin-bottom: 2rem;">
    <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem;">Tambah Aset Baru</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Lengkapi form di bawah untuk menambahkan aset baru ke sistem</p>
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

<form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group">
        <label class="form-label">Gambar Aset</label>
        
        <!-- Drag & Drop Zone -->
        <div class="drop-zone" id="dropZone">
            <div id="dropZonePrompt" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                <div class="drop-zone-icon">📁</div>
                <div class="drop-zone-text">Seret & letakkan foto di sini</div>
                <div class="drop-zone-subtext">bisa geser dari Google Images / local, atau klik untuk memilih</div>
            </div>
            
            <div id="dropZonePreview" class="preview-container" style="display: none;">
                <img id="preview" class="preview-image" src="" alt="Preview">
                <button type="button" id="removePreviewBtn" class="remove-btn">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    Hapus Gambar
                </button>
            </div>
        </div>
        
        <input type="file" id="image" name="image" accept="image/*" style="display: none;">
        <small class="text-muted" style="margin-top: 0.5rem; text-align: center;">Format yang didukung: JPEG, PNG, JPG, WEBP (Maksimal 2MB)</small>
    </div>

    <div class="form-group">
        <label for="kode_aset" class="form-label">Kode Aset *</label>
        <input type="text" class="form-control" id="kode_aset" name="kode_aset" value="{{ old('kode_aset') }}" placeholder="Contoh: AST001" required>
        <small class="text-muted">Kode unik untuk identifikasi aset (akan digunakan untuk QR Code)</small>
    </div>

    <div class="form-group">
        <label for="nama_aset" class="form-label">Nama Aset *</label>
        <input type="text" class="form-control" id="nama_aset" name="nama_aset" value="{{ old('nama_aset') }}" placeholder="Contoh: Laptop Dell Latitude E7450" required>
        <small class="text-muted">Nama lengkap dan deskriptif dari aset</small>
    </div>

    <div class="form-group">
        <label for="kategori" class="form-label">Kategori *</label>
        <select class="form-select" id="kategori" name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
            <option value="Furniture" {{ old('kategori') == 'Furniture' ? 'selected' : '' }}>Furniture</option>
            <option value="Kendaraan" {{ old('kategori') == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
            <option value="Peralatan" {{ old('kategori') == 'Peralatan' ? 'selected' : '' }}>Peralatan</option>
            <option value="Ruangan" {{ old('kategori') == 'Ruangan' ? 'selected' : '' }}>Ruangan</option>
            <option value="Lain-lain" {{ old('kategori') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
        </select>
    </div>



    <div class="form-group">
        <label for="lokasi" class="form-label">Lokasi *</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Gedung A Lt. 2 - Ruang Meeting" required>
        <small class="text-muted">Lokasi penempatan aset saat ini</small>
    </div>

    <div class="form-group">
        <label for="tahun_perolehan" class="form-label">Tahun Perolehan</label>
        <input type="number" class="form-control" id="tahun_perolehan" name="tahun_perolehan" value="{{ old('tahun_perolehan', date('Y')) }}" min="1900" max="{{ date('Y') }}" placeholder="Contoh: 2024">
        <small class="text-muted">Tahun saat aset diperoleh atau dibeli</small>
    </div>

    <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Tambahkan deskripsi atau catatan tambahan (opsional)">{{ old('deskripsi') }}</textarea>
        <small class="text-muted">Informasi tambahan tentang kondisi, spesifikasi, atau catatan lainnya</small>
    </div>

    <div class="form-group" id="estimatedValueGroup">
        <label for="estimated_value" class="form-label">Estimasi Nilai Aset (Rp)</label>
        <div style="position: relative;">
            <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-secondary); font-weight: 500;">Rp</span>
            <input type="text" class="form-control" id="estimated_value" name="estimated_value" value="{{ old('estimated_value') }}" placeholder="0" style="padding-left: 3rem;" oninput="formatCurrency(this)">
        </div>
        <small class="text-muted">Perkiraan nilai aset dalam Rupiah (opsional)</small>
    </div>

    <div style="display: flex; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid var(--border-light);">
        <button type="submit" class="btn btn-primary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Simpan Aset
        </button>
        <a href="{{ route('assets.index') }}" class="btn btn-secondary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Batal
        </a>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initDragAndDrop();
    toggleEstimatedValue();
});

function initDragAndDrop() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('image');
    const dropZonePrompt = document.getElementById('dropZonePrompt');
    const dropZonePreview = document.getElementById('dropZonePreview');
    const previewImg = document.getElementById('preview');
    const removeBtn = document.getElementById('removePreviewBtn');
    
    if (!dropZone || !fileInput) return;

    // Trigger click on file input when dropzone clicked
    dropZone.addEventListener('click', (e) => {
        if (e.target.closest('#removePreviewBtn')) return;
        fileInput.click();
    });

    // Handle file input changes
    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) handleFile(file);
    });

    // Drag-over styling
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
        }, false);
    });

    // Drop handler
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        
        // 1. Local files
        if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
            const file = e.dataTransfer.files[0];
            if (file.type.startsWith('image/')) {
                fileInput.files = e.dataTransfer.files;
                handleFile(file);
            } else {
                alert('Format file harus berupa gambar!');
            }
        } 
        // 2. Dragged URL (Google Images/Photos, etc.)
        else {
            let imageUrl = '';
            const htmlData = e.dataTransfer.getData('text/html');
            if (htmlData) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(htmlData, 'text/html');
                const img = doc.querySelector('img');
                if (img && img.src) {
                    imageUrl = img.src;
                }
            }
            
            if (!imageUrl) {
                imageUrl = e.dataTransfer.getData('text/plain') || e.dataTransfer.getData('URL');
            }

            if (imageUrl && (imageUrl.startsWith('data:image/') || imageUrl.startsWith('http://') || imageUrl.startsWith('https://'))) {
                handleDroppedUrl(imageUrl);
            }
        }
    });

    function handleFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            dropZonePrompt.style.display = 'none';
            dropZonePreview.style.display = 'flex';
        }
        reader.readAsDataURL(file);
    }

    function handleDroppedUrl(url) {
        dropZonePrompt.innerHTML = `
            <div class="drop-zone-icon">⏳</div>
            <div class="drop-zone-text">Mengunduh gambar...</div>
            <div class="drop-zone-subtext">Harap tunggu sebentar</div>
        `;

        if (url.startsWith('data:image/')) {
            try {
                const blob = dataURItoBlob(url);
                const file = new File([blob], "dragged_image.png", { type: blob.type });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                
                handleFile(file);
                resetPromptText();
            } catch (err) {
                alert('Gagal memproses gambar dari Google.');
                resetPromptText();
            }
        } else {
            fetch(url)
                .then(res => {
                    if (!res.ok) throw new Error();
                    return res.blob();
                })
                .then(blob => {
                    const file = new File([blob], "dragged_image.png", { type: blob.type });
                    
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    
                    handleFile(file);
                    resetPromptText();
                })
                .catch(err => {
                    const img = new Image();
                    img.crossOrigin = "anonymous";
                    img.src = url;
                    img.onload = function() {
                        try {
                            const canvas = document.createElement("canvas");
                            canvas.width = img.width;
                            canvas.height = img.height;
                            const ctx = canvas.getContext("2d");
                            ctx.drawImage(img, 0, 0);
                            canvas.toBlob((blob) => {
                                if (blob) {
                                    const file = new File([blob], "dragged_image.png", { type: blob.type || 'image/png' });
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(file);
                                    fileInput.files = dataTransfer.files;
                                    handleFile(file);
                                } else {
                                    showCorsError();
                                }
                                resetPromptText();
                            }, 'image/png');
                        } catch (e) {
                            showCorsError();
                            resetPromptText();
                        }
                    };
                    img.onerror = function() {
                        showCorsError();
                        resetPromptText();
                    };
                });
        }
    }

    function showCorsError() {
        alert('Gagal mendownload gambar langsung dari URL karena pembatasan keamanan (CORS) dari website asal. Tips: Anda bisa mendownloadnya dahulu lalu drag gambar lokal ke sini.');
    }

    function resetPromptText() {
        dropZonePrompt.innerHTML = `
            <div class="drop-zone-icon">📁</div>
            <div class="drop-zone-text">Seret & letakkan foto di sini</div>
            <div class="drop-zone-subtext">bisa geser dari Google Images / local, atau klik untuk memilih</div>
        `;
    }

    function dataURItoBlob(dataURI) {
        const byteString = atob(dataURI.split(',')[1]);
        const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
        const ab = new ArrayBuffer(byteString.length);
        const ia = new Uint8Array(ab);
        for (let i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], {type: mimeString});
    }

    removeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        fileInput.value = '';
        previewImg.src = '';
        dropZonePreview.style.display = 'none';
        dropZonePrompt.style.display = 'flex';
    });
}

function formatCurrency(input) {
    let value = input.value.replace(/[^\d]/g, '');
    if (value) {
        value = parseInt(value).toLocaleString('id-ID');
    }
    input.value = value;
}

function toggleEstimatedValue() {
    const kategoriSelect = document.getElementById('kategori');
    const estimatedValueGroup = document.getElementById('estimatedValueGroup');
    const estimatedValueInput = document.getElementById('estimated_value');
    
    if (kategoriSelect && estimatedValueGroup && estimatedValueInput) {
        if (kategoriSelect.value === 'Ruangan') {
            estimatedValueGroup.style.display = 'none';
            estimatedValueInput.value = '';
        } else {
            estimatedValueGroup.style.display = 'block';
        }
    }
}

// Listen for category changes
const kategoriSelect = document.getElementById('kategori');
if (kategoriSelect) {
    kategoriSelect.addEventListener('change', toggleEstimatedValue);
}

// On form submit, remove formatting from estimated_value
const estimatedValueInput = document.getElementById('estimated_value');
if (estimatedValueInput) {
    const form = estimatedValueInput.form;
    if (form) {
        form.addEventListener('submit', function(e) {
            if (estimatedValueInput.value) {
                estimatedValueInput.value = estimatedValueInput.value.replace(/[^\d]/g, '');
            }
        });
    }
}
</script>

@endsection
