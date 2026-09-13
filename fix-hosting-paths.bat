@echo off
echo ========================================
echo    FIX HOSTING PATHS - CMS PPAK
echo ========================================
echo.
echo Memperbaiki masalah logo dan foto pimpinan...
echo.

REM Clear cache
echo 1. Clearing cache...
php artisan cache:clear
php artisan config:clear
php artisan view:clear
echo    Cache cleared!
echo.

REM Create storage link
echo 2. Creating storage symbolic link...
php artisan storage:link
echo    Storage link created!
echo.

REM Run PHP fix script
echo 3. Running diagnostic script...
php fix-hosting-paths.php
echo.

REM Set permissions (if on Linux/Mac)
echo 4. Setting permissions...
echo    Note: On Windows, permissions are usually OK
echo    On Linux/Mac, run: chmod -R 755 storage/
echo.

echo ========================================
echo    FIX COMPLETED
echo ========================================
echo.
echo Langkah selanjutnya:
echo 1. Pastikan file .env sudah dikonfigurasi dengan benar
echo 2. Upload ulang logo dan foto pimpinan melalui admin panel
echo 3. Test website di browser
echo.
pause
