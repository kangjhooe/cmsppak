@echo off
echo ========================================
echo    Pre-Deployment Check
echo    CMS Pondok Pesantren Al-Falah Krui
echo ========================================
echo.

set ERRORS=0

echo [1/6] Memeriksa build assets...
if not exist "public\build" (
    echo    [ERROR] Folder public\build tidak ditemukan!
    echo    [INFO] Jalankan: npm run build
    set /a ERRORS+=1
) else (
    if not exist "public\build\manifest.json" (
        echo    [ERROR] File manifest.json tidak ditemukan!
        echo    [INFO] Jalankan: npm run build
        set /a ERRORS+=1
    ) else (
        echo    [OK] Build assets ditemukan
    )
)

echo.
echo [2/6] Memeriksa file environment template...
if not exist "env-hosting-template.txt" (
    echo    [ERROR] File env-hosting-template.txt tidak ditemukan!
    set /a ERRORS+=1
) else (
    echo    [OK] File env-hosting-template.txt ditemukan
)

echo.
echo [3/6] Memeriksa file database SQL...
if not exist "database\cmsbq_database.sql" (
    echo    [WARNING] File database\cmsbq_database.sql tidak ditemukan!
    echo    [INFO] Pastikan file database SQL siap untuk diimport
) else (
    echo    [OK] File database SQL ditemukan
)

echo.
echo [4/6] Memeriksa file penting...
if not exist "artisan" (
    echo    [ERROR] File artisan tidak ditemukan!
    set /a ERRORS+=1
) else (
    echo    [OK] File artisan ditemukan
)

if not exist "composer.json" (
    echo    [ERROR] File composer.json tidak ditemukan!
    set /a ERRORS+=1
) else (
    echo    [OK] File composer.json ditemukan
)

if not exist "public\index.php" (
    echo    [ERROR] File public\index.php tidak ditemukan!
    set /a ERRORS+=1
) else (
    echo    [OK] File public\index.php ditemukan
)

echo.
echo [5/6] Memeriksa folder penting...
if not exist "app" (
    echo    [ERROR] Folder app tidak ditemukan!
    set /a ERRORS+=1
) else (
    echo    [OK] Folder app ditemukan
)

if not exist "vendor" (
    echo    [WARNING] Folder vendor tidak ditemukan!
    echo    [INFO] Jalankan: composer install --optimize-autoloader --no-dev
) else (
    echo    [OK] Folder vendor ditemukan
)

if not exist "storage" (
    echo    [ERROR] Folder storage tidak ditemukan!
    set /a ERRORS+=1
) else (
    echo    [OK] Folder storage ditemukan
)

echo.
echo [6/6] Memeriksa file yang tidak boleh diupload...
if exist ".env" (
    echo    [WARNING] File .env ditemukan!
    echo    [INFO] JANGAN upload file .env ke hosting!
    echo    [INFO] Gunakan env-hosting-template.txt sebagai gantinya
)

if exist "database\database.sqlite" (
    echo    [INFO] File database.sqlite ditemukan (tidak perlu diupload)
)

echo.
echo ========================================
if %ERRORS% EQU 0 (
    echo    CHECK SELESAI - SIAP UNTUK DEPLOYMENT!
    echo ========================================
    echo.
    echo Langkah selanjutnya:
    echo 1. Jalankan: deploy-to-hosting.bat (jika menggunakan public_html)
    echo 2. Upload semua file ke hosting
    echo 3. Ikuti checklist di CHECKLIST-DEPLOYMENT.md
    echo.
) else (
    echo    CHECK SELESAI - DITEMUKAN %ERRORS% ERROR!
    echo ========================================
    echo.
    echo [ERROR] Silakan perbaiki error di atas sebelum deployment!
    echo.
)
pause

