# Fix Logo dan Foto Pimpinan di Hosting

## Masalah
Setelah update ke hosting, logo dan foto pimpinan tidak muncul di:
- Halaman profil (public)
- Halaman login
- Navbar

## Penyebab
1. **Path storage tidak sesuai** dengan struktur hosting
2. **Symbolic link storage** belum dibuat atau rusak
3. **Konfigurasi .env** belum disesuaikan untuk hosting
4. **Permission folder** storage tidak sesuai

## Solusi

### 1. Jalankan Script Otomatis (Recommended)

#### Untuk Windows:
```bash
fix-hosting-paths.bat
```

#### Untuk Linux/Mac:
```bash
chmod +x fix-hosting-paths.bat
./fix-hosting-paths.bat
```

### 2. Manual Fix

#### Step 1: Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

#### Step 2: Create Storage Link
```bash
php artisan storage:link
```

#### Step 3: Set Permissions (Linux/Mac)
```bash
chmod -R 755 storage/
chmod -R 755 public/storage/
```

#### Step 4: Update .env File
Pastikan file `.env` memiliki konfigurasi berikut:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
FILESYSTEM_DISK=local
```

#### Step 5: Test URL Generation
Jalankan script diagnostic:
```bash
php fix-hosting-paths.php
```

### 3. Upload Ulang Logo dan Foto

1. **Login ke Admin Panel**
2. **Buka menu Profile**
3. **Upload ulang logo** (format: PNG/JPG, max 2MB)
4. **Upload ulang foto pimpinan** (format: PNG/JPG, max 2MB)
5. **Save perubahan**

### 4. Verifikasi

#### Cek File Storage
Pastikan file ada di:
- `storage/app/public/logos/` (untuk logo)
- `storage/app/public/photos/` (untuk foto pimpinan)

#### Cek Symbolic Link
Pastikan ada link di:
- `public/storage/` → `storage/app/public/`

#### Test URL
Buka URL berikut di browser:
- `https://yourdomain.com/storage/logos/[nama-file-logo]`
- `https://yourdomain.com/storage/photos/[nama-file-foto]`

## Troubleshooting

### Logo/Foto Masih Tidak Muncul

1. **Cek Console Browser**
   - Buka Developer Tools (F12)
   - Lihat tab Console untuk error 404
   - Lihat tab Network untuk failed requests

2. **Cek File Permission**
   ```bash
   ls -la storage/app/public/
   ls -la public/storage/
   ```

3. **Cek .htaccess**
   Pastikan file `.htaccess` di `public/` tidak memblokir akses ke folder `storage/`

4. **Cek Server Configuration**
   - Pastikan server mendukung symbolic links
   - Pastikan mod_rewrite aktif (Apache)
   - Pastikan PHP memiliki permission untuk membuat symbolic links

### Error "Storage Link Already Exists"

```bash
# Hapus link yang ada
rm public/storage

# Buat link baru
php artisan storage:link
```

### Error Permission Denied

```bash
# Set ownership (ganti 'www-data' dengan user server)
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data public/storage/

# Set permissions
sudo chmod -R 755 storage/
sudo chmod -R 755 public/storage/
```

## File yang Diperbaiki

1. **app/Helpers/StorageHelper.php** - Fixed path generation untuk hosting
2. **fix-hosting-paths.php** - Script diagnostic dan perbaikan
3. **fix-hosting-paths.bat** - Script Windows untuk perbaikan otomatis

## Support

Jika masih ada masalah, periksa:
1. Log error di `storage/logs/laravel.log`
2. Konfigurasi server hosting
3. PHP version compatibility
4. Laravel version compatibility

---
**Dibuat untuk CMS PPAK v1.1**  
**Update: Januari 2025**
