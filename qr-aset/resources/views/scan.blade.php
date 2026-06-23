@extends('layout')
@section('content')

<div style="text-align: center; margin-bottom: 2rem;">
    <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">Scan QR Code</h2>
    <p style="color: var(--text-secondary); font-size: 0.9375rem;">Arahkan kamera ke QR code aset untuk melihat detailnya</p>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <!-- Scanner Container -->
    <div style="background: var(--bg-primary); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid var(--border-light); margin-bottom: 1.5rem;">
        <div id="reader" style="width: 100%; border-radius: var(--radius-md); overflow: hidden; border: 2px solid var(--border);"></div>
    </div>

    <!-- Instructions -->
    <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: var(--radius-lg); padding: 1.5rem; border: 1px solid #93c5fd;">
        <h3 style="font-size: 1rem; font-weight: 600; color: #1e40af; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            Cara Menggunakan
        </h3>
        <ul style="list-style: none; padding: 0; margin: 0; color: #1e40af; font-size: 0.9375rem;">
            <li style="padding: 0.5rem 0; display: flex; align-items: start; gap: 0.75rem;">
                <span style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; flex-shrink: 0;">1</span>
                <span>Izinkan akses kamera saat diminta oleh browser</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start; gap: 0.75rem;">
                <span style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; flex-shrink: 0;">2</span>
                <span>Arahkan kamera ke QR code pada label aset</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start; gap: 0.75rem;">
                <span style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; flex-shrink: 0;">3</span>
                <span>Tunggu hingga QR code terdeteksi (otomatis)</span>
            </li>
            <li style="padding: 0.5rem 0; display: flex; align-items: start; gap: 0.75rem;">
                <span style="background: #3b82f6; color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; flex-shrink: 0;">4</span>
                <span>Anda akan diarahkan ke halaman detail aset</span>
            </li>
        </ul>
    </div>

    <!-- Back Button -->
    <div style="margin-top: 1.5rem; text-align: center;">
        <a href="{{ route('assets.index') }}" class="btn btn-secondary">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali ke Daftar Aset
        </a>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Redirect to asset detail page
        window.location.href = `/assets/search/${decodedText}`;
    }

    function onScanFailure(error) {
        // Handle scan failure silently
        // console.warn(`QR code scan error: ${error}`);
    }

    // Initialize QR Code Scanner
    const html5QrCode = new Html5Qrcode("reader");
    const config = { 
        fps: 10, 
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
    };

    // Start the camera
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            // Prefer back camera if available (for mobile)
            let cameraId = devices[0].id;
            if (devices.length > 1) {
                // Try to find back camera
                const backCamera = devices.find(device => 
                    device.label.toLowerCase().includes('back') || 
                    device.label.toLowerCase().includes('rear')
                );
                if (backCamera) {
                    cameraId = backCamera.id;
                }
            }

            html5QrCode.start(
                cameraId,
                config,
                onScanSuccess,
                onScanFailure
            ).catch(err => {
                console.error("Error starting camera:", err);
                alert("Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.");
            });
        } else {
            alert("Tidak ada kamera yang terdeteksi pada perangkat ini.");
        }
    }).catch(err => {
        console.error("Error getting cameras:", err);
        alert("Error mengakses kamera: " + err);
    });
</script>

@endsection