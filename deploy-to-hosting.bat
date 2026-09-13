@echo off
echo ========================================
echo    CMS Deployment ke Hosting
echo ========================================
echo.

echo Memersiapkan file untuk deployment...
echo.

REM 1. Copy file dari public/ ke root
echo [1/5] Menyalin file dari public/ ke root...
if not exist "css" mkdir css
if not exist "js" mkdir js
if not exist "images" mkdir images
if not exist "build" mkdir build

xcopy "public\*" "." /E /I /Y >nul
echo    ✓ File dari public/ berhasil disalin

REM 2. Update index.php
echo [2/5] Mengupdate index.php...
powershell -Command "(Get-Content 'public\index.php') -replace '__DIR__\.''/\.\./', '__DIR__.''/' | Set-Content 'index.php'"
echo    ✓ index.php berhasil diupdate

REM 3. Copy .htaccess
echo [3/5] Membuat .htaccess...
copy "public\.htaccess" ".htaccess" >nul
echo    ✓ .htaccess berhasil dibuat

REM 4. Buat .env untuk hosting
echo [4/5] Membuat .env untuk hosting...
copy "env-hosting-template.txt" ".env.hosting" >nul
echo    ✓ .env.hosting berhasil dibuat

REM 5. Buat file info deployment
echo [5/5] Membuat file deployment info...
echo === DEPLOYMENT INFO === > DEPLOYMENT-INFO.txt
echo Tanggal: %date% %time% >> DEPLOYMENT-INFO.txt
echo. >> DEPLOYMENT-INFO.txt
echo File yang perlu diupload ke public_html: >> DEPLOYMENT-INFO.txt
echo - Semua file dan folder di root project >> DEPLOYMENT-INFO.txt
echo - Ganti .env.hosting menjadi .env >> DEPLOYMENT-INFO.txt
echo - Set permission: chmod -R 755 storage/ bootstrap/cache/ >> DEPLOYMENT-INFO.txt
echo - Import database: database/cmsbq_database.sql >> DEPLOYMENT-INFO.txt
echo. >> DEPLOYMENT-INFO.txt
echo Langkah-langkah: >> DEPLOYMENT-INFO.txt
echo 1. Upload semua file ke public_html >> DEPLOYMENT-INFO.txt
echo 2. Rename .env.hosting menjadi .env >> DEPLOYMENT-INFO.txt
echo 3. Edit .env dengan data hosting Anda >> DEPLOYMENT-INFO.txt
echo 4. Generate APP_KEY dengan: php artisan key:generate >> DEPLOYMENT-INFO.txt
echo 5. Set permission folder storage dan bootstrap/cache >> DEPLOYMENT-INFO.txt
echo 6. Import database cmsbq_database.sql >> DEPLOYMENT-INFO.txt
echo    ✓ DEPLOYMENT-INFO.txt berhasil dibuat

echo.
echo ========================================
echo    DEPLOYMENT SELESAI!
echo ========================================
echo.
echo File siap untuk diupload ke hosting!
echo Lihat DEPLOYMENT-INFO.txt untuk instruksi lengkap.
echo.
pause
