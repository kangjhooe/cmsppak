# Panduan Deploy CMS ke Hosting dengan Document Root di public_html

## Situasi Anda
- Document root hosting di folder `public_html`
- Tidak bisa mengubah document root
- Perlu deploy Laravel CMS ke hosting

## Solusi yang Tersedia

### 🚀 Solusi 1: Upload Semua File ke public_html (RECOMMENDED)

#### Langkah-langkah:

1. **Jalankan Script Deployment**
   ```bash
   # Windows
   deploy-to-hosting.bat
   
   # Atau manual dengan PHP
   php prepare-deployment.php
   ```

2. **Upload File ke Hosting**
   - Upload **SEMUA** file dan folder ke `public_html/`
   - Struktur akan menjadi:
   ```
   public_html/
   ├── app/
   ├── bootstrap/
   ├── config/
   ├── database/
   ├── resources/
   ├── routes/
   ├── storage/
   ├── vendor/
   ├── css/           # dari public/css/
   ├── js/            # dari public/js/
   ├── images/        # dari public/images/
   ├── build/         # dari public/build/
   ├── index.php      # sudah diupdate path
   ├── .htaccess      # sudah diupdate
   ├── .env.hosting   # template untuk hosting
   └── favicon.ico
   ```

3. **Konfigurasi Hosting**
   - Rename `.env.hosting` menjadi `.env`
   - Edit file `.env` dengan data hosting Anda:
   ```env
   APP_NAME="Pondok Pesantren Al-Falah Krui"
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

4. **Generate APP_KEY**
   ```bash
   php artisan key:generate
   ```

5. **Set Permission**
   ```bash
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   ```

6. **Import Database**
   - Buka phpMyAdmin di hosting
   - Buat database baru
   - Import file `database/cmsbq_database.sql`

### 🔧 Solusi 2: Menggunakan Subdomain

Jika hosting mendukung subdomain:
1. Buat subdomain seperti `cms.yourdomain.com`
2. Set document root subdomain ke folder `public/`
3. Upload semua file Laravel ke folder subdomain

### 🔀 Solusi 3: Menggunakan .htaccess Redirect

Buat file `.htaccess` di root `public_html`:
```apache
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/cms/
RewriteRule ^(.*)$ /cms/public/$1 [L]
```

## File yang Sudah Disiapkan

1. **`DEPLOYMENT-PUBLIC-HTML.md`** - Panduan detail deployment
2. **`prepare-deployment.php`** - Script PHP untuk persiapan
3. **`deploy-to-hosting.bat`** - Script Windows untuk persiapan
4. **`.htaccess-security`** - .htaccess dengan keamanan tambahan
5. **`env-hosting-template.txt`** - Template .env untuk hosting

## Troubleshooting

### Error 500 - Internal Server Error
- Check permission folder `storage/` dan `bootstrap/cache/`
- Pastikan file `.env` sudah benar
- Check log error di hosting

### Error 404 - Not Found
- Pastikan file `.htaccess` sudah benar
- Check apakah mod_rewrite aktif di hosting

### Database Connection Error
- Check konfigurasi database di `.env`
- Pastikan database sudah dibuat dan diimport

### File Upload Error
- Check permission folder `storage/app/public/`
- Pastikan folder `storage/` writable

## Keamanan

1. **Block Access ke File Sensitif**
   - File `.env` tidak bisa diakses langsung
   - Folder `app/`, `config/`, `database/` diblokir
   - File `composer.json`, `artisan` diblokir

2. **Security Headers**
   - X-Content-Type-Options
   - X-Frame-Options
   - X-XSS-Protection
   - Referrer-Policy

## Data Default

Setelah import database, Anda akan mendapat:
- **Admin User**: `admin@alfalahkrui.sch.id`
- **Password**: `password`
- **Database**: `cmsbq`
- **Data Sample**: Profile sekolah, berita, agenda, dll

## Support

Jika mengalami masalah:
1. Check file log di `storage/logs/`
2. Pastikan semua file sudah terupload dengan benar
3. Check permission folder
4. Verify konfigurasi database

---
**Catatan**: Gunakan Solusi 1 (Upload Semua File) untuk hasil terbaik dan paling mudah.
