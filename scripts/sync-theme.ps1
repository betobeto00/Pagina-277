<#
.SYNOPSIS
    Sincroniza el tema Virtud y Victoria desde el directorio de desarrollo
    al directorio de Local WP (donde nginx sirve los archivos).

.DESCRIPTION
    Este script copia los archivos modificados de:
      C:\Users\DeadW\dev\Pagina-277\wp-theme\virtud-y-victoria\
    a:
      C:\Users\DeadW\Local Sites\virtud-y-victoria-277\app\public\wp-content\themes\virtud-y-victoria\

    Los archivos se copian con /mir (mirror) para que el destino sea idéntico
    al origen. Los archivos en el destino que no existan en el origen se eliminan.

.PARAMETER Direction
    'toServer' (default): dev/ -> Local Sites/ (caso normal de desarrollo)
    'toDev':              Local Sites/ -> dev/ (para traer cambios hechos via wp-admin)

.PARAMETER ShowDiff
    Muestra los archivos que se copiarán antes de hacerlo.

.EXAMPLE
    .\sync-theme.ps1
    Sincroniza dev/ -> Local Sites/

.EXAMPLE
    .\sync-theme.ps1 -Direction toDev
    Sincroniza Local Sites/ -> dev/

.EXAMPLE
    .\sync-theme.ps1 -ShowDiff
    Muestra qué archivos se copiarán sin hacerlo

.NOTES
    Autor: opencode + DeadW
    Fecha: 27/08/2026
    Problema que resuelve: Ver KNOWLEDGE.md, sección "Archivos Duplicados: Local vs Server"
#>

param(
    [ValidateSet('toServer', 'toDev')]
    [string]$Direction = 'toServer',

    [switch]$ShowDiff,
    
    [switch]$Backup,      # Crear backup antes de sincronizar
    [switch]$SafeMode     # Modo seguro: más validaciones y confirmaciones
)

$ErrorActionPreference = 'Stop'

# === Configuración ===
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

# === Función de Backup ===
function Create-Backup {
    param(
        [string]$Path,
        [string]$Direction
    )
    
    $backupDir = "C:\Users\DeadW\dev\Pagina-277\backups"
    $timestamp = Get-Date -Format "yyyyMMdd-HHmmss"
    $backupName = "theme-backup-$Direction-$timestamp"
    $backupPath = Join-Path $backupDir $backupName
    
    # Crear directorio de backups si no existe
    if (-not (Test-Path $backupDir)) {
        New-Item -ItemType Directory -Path $backupDir -Force | Out-Null
        Write-Host "[BACKUP] Directorio de backups creado: $backupDir" -ForegroundColor Cyan
    }
    
    # Crear backup
    Write-Host "[BACKUP] Creando backup de $Path..." -ForegroundColor Yellow
    try {
        Copy-Item -Path $Path -Destination $backupPath -Recurse -Force
        Write-Host "[BACKUP] Backup creado exitosamente: $backupPath" -ForegroundColor Green
        
        # Mantener solo los últimos 5 backups
        $backups = Get-ChildItem $backupDir -Directory | Sort-Object LastWriteTime -Descending
        if ($backups.Count -gt 5) {
            $backups[5..($backups.Count - 1)] | ForEach-Object {
                Remove-Item $_.FullName -Recurse -Force
                Write-Host "[BACKUP] Backup antiguo eliminado: $($_.Name)" -ForegroundColor DarkGray
            }
        }
        
        return $backupPath
    } catch {
        Write-Error "[ERROR] Error al crear backup: $_"
        exit 1
    }
}

# === Crear backup si se solicita ===
if ($Backup) {
    $targetPath = if ($Direction -eq 'toServer') { $ServerPath } else { $DevPath }
    $backupPath = Create-Backup -Path $targetPath -Direction $Direction
}

# === Determinar origen y destino ===
if ($Direction -eq 'toServer') {
    $Source = $DevPath
    $Dest   = $ServerPath
    Write-Host "[->] Sincronizando: dev/ -> Local Sites/" -ForegroundColor Cyan
} else {
    $Source = $ServerPath
    $Dest   = $DevPath
    Write-Host "[<-] Sincronizando: Local Sites/ -> dev/" -ForegroundColor Cyan
}

# === Mostrar diff (opcional) ===
if ($ShowDiff -or $SafeMode) {
    Write-Host ""
    Write-Host "=== ANÁLISIS DE CAMBIOS ===" -ForegroundColor Cyan
    Write-Host "Archivos en origen que no coinciden con destino:" -ForegroundColor Yellow
    
    $robocopyDiff = & robocopy $Source $Dest /MIR /L /NJH /NJS /NDL /NFL /NC /NS 2>&1
    $changesFound = $false
    
    $robocopyDiff | ForEach-Object {
        if ($_ -match '^\s*(\S+.*)$') {
            $file = $matches[1].Trim()
            $ext  = [System.IO.Path]::GetExtension($file)
            # Filtrar líneas vacías y separadores
            if ($file -and ($ext -in '.php','.css','.js','.png','.jpg','.svg','.json','.md','.txt','.html')) {
                Write-Host "  • $file" -ForegroundColor Gray
                $changesFound = $true
            }
        }
    }
    
    if (-not $changesFound) {
        Write-Host "  (No hay cambios detectados)" -ForegroundColor Green
    }
    
    Write-Host ""
    
    # En modo seguro, siempre pedir confirmación
    if ($SafeMode) {
        $confirm = Read-Host "¿Aplicar estos cambios? (s/N)"
        if ($confirm -ne 's' -and $confirm -ne 'S') {
            Write-Host "Cancelado por el usuario." -ForegroundColor Yellow
            exit 0
        }
    } elseif ($ShowDiff) {
        $confirm = Read-Host "¿Aplicar estos cambios? (s/N)"
        if ($confirm -ne 's' -and $confirm -ne 'S') {
            Write-Host "Cancelado." -ForegroundColor Yellow
            exit 0
        }
    }
}

# === Ejecutar sync con robocopy /MIR ===
# /MIR  = mirror (espejo: copia nuevos, actualiza modificados, elimina en destino los que no estén en origen)
# /R:0  = sin reintentos
# /W:0  = sin espera entre reintentos
# /XD   = excluir directorios
# /XF   = excluir archivos
# /MT:8 = multi-thread (8 hilos)

Write-Host "Sincronizando archivos..." -ForegroundColor Cyan
Write-Host "  Origen:  $Source" -ForegroundColor DarkGray
Write-Host "  Destino: $Dest" -ForegroundColor DarkGray

# Validación adicional en modo seguro
if ($SafeMode) {
    Write-Host "[SAFE MODE] Validando integridad de archivos críticos..." -ForegroundColor Yellow
    $criticalFiles = @('functions.php', 'style.css', 'header.php', 'footer.php')
    foreach ($file in $criticalFiles) {
        $sourceFile = Join-Path $Source $file
        if (Test-Path $sourceFile) {
            $content = Get-Content $sourceFile -Raw
            # Verificar que no haya corrupción básica
            if ([string]::IsNullOrEmpty($content)) {
                Write-Error "[SAFE MODE] Archivo crítico vacío o corrupto: $file"
                exit 1
            }
        }
    }
    Write-Host "[SAFE MODE] Validación completada" -ForegroundColor Green
}

$result = & robocopy $Source $Dest /MIR /R:0 /W:0 /MT:8 /XD ".git" "node_modules" 2>&1

# === Reportar resultado ===
$exitCode = $LASTEXITCODE
if ($exitCode -eq 0) {
    Write-Host "[OK] Sin cambios necesarios" -ForegroundColor Green
} elseif ($exitCode -eq 1) {
    Write-Host "[OK] Archivos copiados correctamente" -ForegroundColor Green
} elseif ($exitCode -eq 2 -or $exitCode -eq 3) {
    Write-Host "[OK] Archivos copiados + archivos extra eliminados" -ForegroundColor Green
} elseif ($exitCode -ge 8) {
    Write-Host "[ERROR] Error en robocopy (codigo: $exitCode)" -ForegroundColor Red
    Write-Host $result
    exit $exitCode
} else {
    Write-Host "[OK] Sincronizacion completada (codigo: $exitCode)" -ForegroundColor Green
}

Write-Host ""
Write-Host "Origen: $Source" -ForegroundColor Gray
Write-Host "Destino: $Dest" -ForegroundColor Gray
Write-Host ""
Write-Host "Tip: Ejecuta con -ShowDiff para ver los cambios antes de aplicarlos." -ForegroundColor DarkGray
