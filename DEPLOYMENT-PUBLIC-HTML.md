# Panduan Deploy ke Hosting dengan Document Root di public_html

## Situasi
- Document root hosting Anda di folder `public_html`
- Tidak bisa mengubah document root ke subfolder
- Perlu deploy Laravel CMS ke hosting

## Solusi 1: Upload Semua File ke public_html (Recommended)

### Langkah-langkah:

1. **Upload Semua File Laravel ke public_html**
   ```
   public_html/
   ├── app/
   ├── bootstrap/
   ├── config/
   ├── database/
   ├── public/          # Folder ini akan kosong
   ├── resources/
   ├── routes/
   ├── storage/
   ├── vendor/
   ├── .env
   ├── artisan
   ├── composer.json
   └── index.php        # File index.php dari folder public/
   ```

2. **Pindahkan isi folder public/ ke root public_html**
   - Copy semua file dari `public/` ke `public_html/`
   - Hapus folder `public/` yang kosong

3. **Update file index.php**
   ```php
   <?php
   
   use Illuminate\Foundation\Application;
   use Illuminate\Http\Request;
   
   define('LARAVEL_START', microtime(true));
   
   // Determine if the application is in maintenance mode...
   if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
       require $maintenance;
   }
   
   // Register the Composer autoloader...
   require __DIR__.'/vendor/autoload.php';
   
   // Bootstrap Laravel and handle the request...
   /** @var Application $app */
   $app = require_once __DIR__.'/bootstrap/app.php';
   
   $app->handleRequest(Request::capture());
   ```

4. **Update .htaccess**
   ```apache
   <IfModule mod_rewrite.c>
       <IfModule mod_negotiation.c>
           Options -MultiViews -Indexes
       </IfModule>
   
       RewriteEngine On
   
       # Handle Authorization Header
       RewriteCond %{HTTP:Authorization} .
       RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
   
       # Handle X-XSRF-Token Header
       RewriteCond %{HTTP:x-xsrf-token} .
       RewriteRule .* - [E=HTTP_X_XRF_TOKEN:%{HTTP:X-XSRF-Token}]
   
       # Redirect Trailing Slashes If Not A Folder...
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteCond %{REQUEST_URI} (.+)/$
       RewriteRule ^ %1 [L,R=301]
   
       # Send Requests To Front Controller...
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteRule ^ index.php [L]
   </IfModule>
   ```

5. **Update .env untuk hosting**
   ```env
   APP_NAME="CMS Pondok Pesantren"
   APP_ENV=production
   APP_KEY=base64:YOUR_APP_KEY_HERE
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

6. **Set Permission**
   ```bash
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   ```

## Solusi 2: Menggunakan Subdomain

Jika hosting mendukung subdomain:
1. Buat subdomain seperti `cms.yourdomain.com`
2. Set document root subdomain ke folder `public/`
3. Upload semua file Laravel ke folder subdomain

## Solusi 3: Menggunakan .htaccess Redirect

Buat file `.htaccess` di root public_html:
```apache
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/cms/
RewriteRule ^(.*)$ /cms/public/$1 [L]
```

## Catatan Penting

1. **Security**: Pastikan file `.env` tidak bisa diakses langsung
2. **Storage**: Pastikan folder `storage/` writable
3. **Cache**: Clear cache setelah deploy
4. **Database**: Import file `database/cmsbq_database.sql`

## Troubleshooting

- **500 Error**: Check permission folder storage dan bootstrap/cache
- **404 Error**: Pastikan .htaccess sudah benar
- **Database Error**: Check konfigurasi database di .env
