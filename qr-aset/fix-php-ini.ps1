$ini = "C:\laragon\bin\php\php-8.3.28-nts-Win32-vs16-x64\php.ini"
$lines = Get-Content $ini
$found = $false
$newLines = @()

foreach ($line in $lines) {
    $trimmed = $line.Trim()
    if ($trimmed -eq 'extension=pdo_sqlite') {
        if (-not $found) {
            $found = $true
            $newLines += $line
        }
    }
    elseif ($trimmed -like '; extension=pdo_sqlite*') {
        # skip commented duplicates
    }
    else {
        $newLines += $line
    }
}

$newLines | Set-Content $ini -Encoding UTF8
Write-Host "Done. Kept 1 extension=pdo_sqlite line. Total lines: $($newLines.Count)"
