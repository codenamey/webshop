$ErrorActionPreference = "Stop"

$root = Split-Path -Parent $PSScriptRoot
$dumpDir = Join-Path $root "database/init"
$dumpFile = if ($args.Count -gt 0) { $args[0] } else { Join-Path $dumpDir "001-webshop.sql" }

New-Item -ItemType Directory -Force $dumpDir | Out-Null

$envFile = Join-Path $root ".env"
if (-not (Test-Path $envFile)) {
    throw ".env file not found: $envFile"
}

$envVars = @{}
Get-Content $envFile | ForEach-Object {
    if ($_ -match '^\s*#' -or $_ -match '^\s*$') {
        return
    }

    $parts = $_ -split '=', 2
    if ($parts.Count -eq 2) {
        $envVars[$parts[0]] = $parts[1]
    }
}

$dbName = $envVars["WORDPRESS_DB_NAME"]
$dbUser = $envVars["WORDPRESS_DB_USER"]
$dbPassword = $envVars["WORDPRESS_DB_PASSWORD"]

if (-not $dbName -or -not $dbUser -or -not $dbPassword) {
    throw "WORDPRESS_DB_NAME, WORDPRESS_DB_USER or WORDPRESS_DB_PASSWORD missing from .env"
}

docker compose exec -T webshop-db mariadb-dump "-u$dbUser" "-p$dbPassword" $dbName | Set-Content -Encoding utf8 $dumpFile

Write-Host "Database dump written to $dumpFile"
