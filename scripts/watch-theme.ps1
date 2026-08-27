<#
.SYNOPSIS
    Vigila cambios en el directorio de desarrollo del tema y sincroniza
    automaticamente al directorio de Local WP.

.DESCRIPTION
    Usa polling con Get-FileHash para detectar cambios (mas confiable que
    FileSystemWatcher en Background Jobs de PowerShell).

    Vigila:
      C:\Users\DeadW\dev\Pagina-277\wp-theme\virtud-y-victoria\
    y sincroniza a:
      C:\Users\DeadW\Local Sites\virtud-y-victoria-277\app\public\wp-content\themes\virtud-y-victoria\

.PARAMETER IntervalSeconds
    Segundos entre cada verificacion. Default: 2

.EXAMPLE
    .\watch-theme.ps1
    Inicia el watcher (Ctrl+C para detener)

.NOTES
    Manten esta ventana abierta mientras editas. Para detener, presiona Ctrl+C.

    Problema que resuelve: Ver KNOWLEDGE.md, seccion "Archivos Duplicados: Local vs Server"
#>

param(
    [int]$IntervalSeconds = 2
)

$ErrorActionPreference = 'Stop'

# === Configuracion ===
$DevPath    = "C:\Users\DeadW\dev\Pagina-277\wp-theme\virtud-y-victoria"
$ServerPath = "C:\Users\DeadW\Local Sites\virtud-y-victoria-277\app\public\wp-content\themes\virtud-y-victoria"

# === Validar rutas ===
if (-not (Test-Path $DevPath)) {
    Write-Error "Directorio de desarrollo no existe: $DevPath"
    exit 1
}
if (-not (Test-Path $ServerPath)) {
    Write-Error "Directorio del servidor no existe: $ServerPath"
    exit 1
}

# === Funcion para generar hash de un directorio ===
function Get-DirectoryHash($path) {
    $files = Get-ChildItem -Path $path -Recurse -File -ErrorAction SilentlyContinue |
             Where-Object { $_.FullName -notmatch '\\(\.git|node_modules)\\' } |
             Sort-Object FullName

    $hashInput = ""
    foreach ($f in $files) {
        $relPath = $f.FullName.Substring($path.Length).TrimStart('\')
        $hashInput += "$relPath|$($f.LastWriteTime.Ticks)|$($f.Length)`n"
    }
    $bytes = [System.Text.Encoding]::UTF8.GetBytes($hashInput)
    $md5 = [System.Security.Cryptography.MD5]::Create()
    $hash = $md5.ComputeHash($bytes)
    return [BitConverter]::ToString($hash) -replace '-', ''
}

# === Funcion de sincronizacion ===
function Sync-Theme {
    param($Source, $Dest)

    $timestamp = Get-Date -Format "HH:mm:ss"
    Write-Host ""
    Write-Host "[$timestamp] [SYNC] Sincronizando..." -ForegroundColor Cyan

    try {
        $output = & robocopy $Source $Dest /MIR /R:0 /W:0 /MT:8 /XD ".git" "node_modules" /NJH /NJS /NDL /NFL 2>&1
        $code = $LASTEXITCODE
        if ($code -in 0,1,2,3) {
            Write-Host "[$timestamp] [OK] Sincronizado" -ForegroundColor Green
        } else {
            Write-Host "[$timestamp] [ERROR] robocopy codigo: $code" -ForegroundColor Red
        }
    } catch {
        Write-Host "[$timestamp] [ERROR] $_" -ForegroundColor Red
    }

    Write-Host "[$timestamp] Vigilando... (Ctrl+C para salir)" -ForegroundColor DarkGray
}

# === Banner ===
Clear-Host
Write-Host "================================================" -ForegroundColor Cyan
Write-Host "  Watcher de tema Virtud y Victoria (polling)" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Vigilando:  $DevPath" -ForegroundColor Yellow
Write-Host "Destino:    $ServerPath" -ForegroundColor Yellow
Write-Host "Intervalo:  ${IntervalSeconds}s" -ForegroundColor Yellow
Write-Host ""
Write-Host "Presiona Ctrl+C para detener." -ForegroundColor DarkGray
Write-Host ""

# === Loop principal: polling ===
$lastHash = Get-DirectoryHash $DevPath
$timestamp = Get-Date -Format "HH:mm:ss"
Write-Host "[$timestamp] [BOOT] Watcher iniciado. Hash inicial: $($lastHash.Substring(0,8))..." -ForegroundColor DarkGray
Write-Host "[$timestamp] Vigilando... " -NoNewline -ForegroundColor DarkGray

try {
    while ($true) {
        Start-Sleep -Seconds $IntervalSeconds
        $currentHash = Get-DirectoryHash $DevPath
        if ($currentHash -ne $lastHash) {
            $lastHash = $currentHash
            Sync-Theme -Source $DevPath -Dest $ServerPath
        }
    }
} finally {
    Write-Host ""
    Write-Host "Watcher detenido." -ForegroundColor Yellow
}
