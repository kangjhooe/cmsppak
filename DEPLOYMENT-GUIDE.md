# Panduan Deployment ke Hosting

## Masalah yang Sering Terjadi

### 1. File Environment (.env)
- **Masalah**: File `.env` tidak ada atau konfigurasi salah
- **Solusi**: 
  - Upload file `env-hosting-template.txt` ke hosting
  - Rename menjadi `.env`
  - Edit konfigurasi database dan URL

### 2. Database Configuration
- **Masalah**: Aplikasi default menggunakan SQLite, hosting perlu MySQL
- **Solusi**:
  - Import file `database/cmsbq_database.sql` ke database hosting
  - Set `DB_CONNECTION=mysql` di file `.env`
  - Konfigurasi database credentials

### 3. Permission File dan Folder
- **Masalah**: Permission folder tidak sesuai
- **Solusi**:
  ```bash
  chmod -R 755 storage/
  chmod -R 755 bootstrap/cache/
  chmod 644 .env
  ```

### 4. Dependencies dan Composer
- **Masalah**: Dependencies tidak terinstall atau PHP version tidak support
- **Solusi**:
  ```bash
  composer install --optimize-autoloader --no-dev
  php artisan key:generate
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

### 5. Web Server Configuration
- **Masalah**: Document root tidak di folder `public/`
- **Solusi**:
  - Set document root ke folder `public/`
  - Pastikan file `.htaccess` ada di folder `public/`

## Langkah-langkah Deployment

### 1. Upload File
- Upload semua file ke hosting
- Pastikan folder `vendor/` terupload (atau jalankan `composer install`)

### 2. Konfigurasi Environment
- Copy `env-hosting-template.txt` menjadi `.env`
- Edit konfigurasi database dan URL

### 3. Database Setup
- Import `database/cmsbq_database.sql` ke database hosting
- Pastikan koneksi database berhasil

### 4. Set Permission
- Set permission folder `storage/` dan `bootstrap/cache/` ke 755
- Set permission file `.env` ke 644

### 5. Generate Key dan Cache
```bash
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Test Aplikasi
- Buka URL aplikasi di browser
- Test login dan fitur utama

## Troubleshooting

### Error 500
- Cek log error di `storage/logs/`
- Pastikan permission folder benar
- Pastikan file `.env` ada dan konfigurasi benar

### Database Connection Error
- Cek konfigurasi database di `.env`
- Pastikan database sudah diimport
- Cek kredensial database

### File Not Found
- Pastikan document root di folder `public/`
- Cek file `.htaccess` ada di folder `public/`

### Permission Denied
- Set permission folder `storage/` dan `bootstrap/cache/` ke 755
- Set permission file `.env` ke 644
