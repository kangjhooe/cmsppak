@echo off
echo ========================================
echo Setup CMS Pondok Pesantren Al-Falah Krui
echo ========================================
echo.

echo 1. Installing Composer dependencies...
composer install
echo.

echo 2. Installing NPM dependencies...
npm install
echo.

echo 3. Copying environment file...
if not exist .env (
    copy .env.example .env
    echo Environment file copied.
) else (
    echo Environment file already exists.
)
echo.

echo 4. Generating application key...
php artisan key:generate
echo.

echo 5. Running database migrations...
php artisan migrate
echo.

echo 6. Running database seeders...
php artisan db:seed
echo.

echo 7. Creating storage link...
php artisan storage:link
echo.

echo 8. Building assets...
npm run build
echo.

echo ========================================
echo Setup completed successfully!
echo ========================================
echo.
echo Default accounts:
echo Admin: admin@example.com / admin123
echo Operator: operator@example.com / operator123
echo Editor: editor@example.com / editor123
echo.
echo To start the server, run: php artisan serve
echo.
pause
