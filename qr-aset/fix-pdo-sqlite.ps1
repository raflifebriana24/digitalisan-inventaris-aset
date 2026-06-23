# Script untuk memperbaiki duplikasi extension pdo_sqlite di php.ini

$phpIniPath = "C:\laragon\bin\php\php-8.3.28-nts-Win32-vs16-x64\php.ini"

Write-Host "Membaca file php.ini..." -ForegroundColor Yellow

# Baca semua baris dari file php.ini
$content = Get-Content $phpIniPath

# Cari semua baris yang mengandung pdo_sqlite
Write-Host "`nMencari duplikasi extension pdo_sqlite..." -ForegroundColor Yellow
$pdoSqliteLines = $content | Select-String -Pattern "pdo_sqlite" -CaseSensitive:$false

if ($pdoSqliteLines) {
    Write-Host "`nDitemukan baris berikut yang mengandung 'pdo_sqlite':" -ForegroundColor Cyan
    $pdoSqliteLines | ForEach-Object {
        $lineNum = $_.LineNumber
        $lineText = $_.Line
        Write-Host "Baris $lineNum : $lineText"
    }
    
    # Hitung berapa kali extension=pdo_sqlite muncul (tidak dikomentari)
    $activeExtensions = $content | Where-Object { $_ -match "^\s*extension\s*=\s*pdo_sqlite" }
    
    if ($activeExtensions.Count -gt 1) {
        Write-Host "`nDETEKSI: Extension pdo_sqlite dimuat $($activeExtensions.Count) kali!" -ForegroundColor Red
        Write-Host "Memperbaiki dengan hanya mempertahankan satu extension..." -ForegroundColor Green
        
        # Backup file asli
        $backupPath = $phpIniPath + ".backup_" + (Get-Date -Format "yyyyMMdd_HHmmss")
        Copy-Item $phpIniPath $backupPath
        Write-Host "`nBackup dibuat: $backupPath" -ForegroundColor Green
        
        # Hapus duplikasi - hanya pertahankan yang pertama
        $newContent = @()
        $foundFirst = $false
        
        foreach ($line in $content) {
            if ($line -match "^\s*extension\s*=\s*pdo_sqlite") {
                if (-not $foundFirst) {
                    # Pertahankan yang pertama
                    $newContent += $line
                    $foundFirst = $true
                } else {
                    # Komentari yang duplikat
                    $newContent += "; " + $line + " ; (commented by fix script - duplicate)"
                }
            } else {
                $newContent += $line
            }
        }
        
        # Tulis kembali ke file
        $newContent | Set-Content $phpIniPath
        Write-Host "`nFile php.ini telah diperbaiki!" -ForegroundColor Green
        Write-Host "Baris duplikat telah dikomentari." -ForegroundColor Green
        
    } else {
        Write-Host "`nTidak ada duplikasi ditemukan." -ForegroundColor Green
    }
    
} else {
    Write-Host "`nTidak ada baris yang mengandung 'pdo_sqlite'" -ForegroundColor Yellow
}

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "Selesai! Silakan restart server Laravel Anda." -ForegroundColor Green
Write-Host "========================================`n" -ForegroundColor Cyan
