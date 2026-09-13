# ✅ Checklist Deployment ke Hosting

## 📋 Persiapan Sebelum Upload

### 1. Build Assets (WAJIB)
```bash
npm run build
```
- [ ] Assets sudah di-build (`public/build/` ada dan berisi file)
- [ ] Tidak ada error saat build
- [ ] File CSS dan JS ter-generate dengan benar

### 2. Environment Configuration
- [ ] File `env-hosting-template.txt` sudah ada
- [ ] Siapkan informasi database hosting:
  - [ ] Database name
  - [ ] Database username
  - [ ] Database password
  - [ ] Database host (biasanya `localhost`)
- [ ] Siapkan domain/URL aplikasi

### 3. Database
- [ ] File `database/cmsbq_database.sql` siap untuk diimport
- [ ] Database sudah dibuat di hosting (jika perlu)
- [ ] Backup database lokal (jika ada data penting)

### 4. File yang Perlu Diupload
- [ ] Semua folder: `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`, `storage/`, `vendor/`
- [ ] File: `artisan`, `composer.json`, `composer.lock`
- [ ] Folder `public/` (atau isinya jika menggunakan document root di public_html)
- [ ] File `.htaccess` dari `public/`

### 5. Security Check
- [ ] File `.env` TIDAK diupload (akan dibuat di hosting)
- [ ] File `database/database.sqlite` TIDAK diupload (jika ada)
- [ ] File log (`storage/logs/*.log`) TIDAK diupload
- [ ] Folder `node_modules/` TIDAK diupload

---

## 🚀 Langkah-langkah Deployment

### Step 1: Persiapan File Lokal
```bash
# Build assets
npm run build

# Jalankan script deployment (jika menggunakan public_html)
deploy-to-hosting.bat
```

- [ ] Assets sudah di-build
- [ ] Script deployment sudah dijalankan (jika perlu)

### Step 2: Upload ke Hosting

#### Opsi A: Document Root di `public/` (RECOMMENDED)
- [ ] Upload SEMUA file dan folder ke root hosting
- [ ] Pastikan struktur folder tetap sama
- [ ] Set document root hosting ke folder `public/`

#### Opsi B: Document Root di `public_html/`
- [ ] Jalankan `deploy-to-hosting.bat` terlebih dahulu
- [ ] Upload SEMUA file dan folder ke `public_html/`
- [ ] Pastikan file `index.php` sudah diupdate path-nya

### Step 3: Konfigurasi Environment
- [ ] Upload file `env-hosting-template.txt` ke hosting
- [ ] Rename menjadi `.env`
- [ ] Edit file `.env` dengan data hosting:
  ```env
  APP_NAME="Pondok Pesantren Al-Falah Krui"
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=https://yourdomain.com
  
  DB_CONNECTION=mysql
  DB_HOST=localhost
  DB_PORT=3306
  DB_DATABASE=nama_database_anda
  DB_USERNAME=username_database_anda
  DB_PASSWORD=password_database_anda
  ```

### Step 4: Generate APP_KEY
```bash
php artisan key:generate
```
- [ ] APP_KEY sudah di-generate
- [ ] APP_KEY sudah tersimpan di file `.env`

### Step 5: Set Permission
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```
- [ ] Permission folder `storage/` sudah di-set (755)
- [ ] Permission folder `bootstrap/cache/` sudah di-set (755)
- [ ] Permission file `.env` sudah di-set (644)

### Step 6: Import Database
- [ ] Buka phpMyAdmin di hosting
- [ ] Buat database baru (jika belum ada)
- [ ] Import file `database/cmsbq_database.sql`
- [ ] Pastikan import berhasil tanpa error

### Step 7: Setup Storage Link
```bash
php artisan storage:link
```
- [ ] Storage link sudah dibuat
- [ ] Folder `public/storage` sudah ter-link ke `storage/app/public`

### Step 8: Clear & Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```
- [ ] Cache sudah di-clear
- [ ] Cache sudah di-generate ulang

---

## 🧪 Testing Setelah Deployment

### 1. Test Halaman Utama
- [ ] Homepage bisa diakses
- [ ] Tidak ada error 500
- [ ] CSS dan JS ter-load dengan benar
- [ ] Gambar ter-load dengan benar

### 2. Test Admin Panel
- [ ] Halaman login bisa diakses (`/admin/login`)
- [ ] Bisa login dengan akun admin
- [ ] Dashboard admin bisa diakses
- [ ] Menu navigasi berfungsi

### 3. Test Fitur Utama
- [ ] Halaman profil bisa diakses
- [ ] Halaman berita bisa diakses
- [ ] Halaman galeri bisa diakses
- [ ] Halaman agenda bisa diakses
- [ ] Upload file berfungsi (jika ada)

### 4. Test Database
- [ ] Data bisa dibaca dari database
- [ ] Data bisa ditulis ke database
- [ ] Upload file tersimpan dengan benar

---

## 🔧 Troubleshooting

### Error 500 - Internal Server Error
**Solusi:**
1. Cek log error: `storage/logs/laravel.log`
2. Pastikan permission folder benar
3. Pastikan file `.env` ada dan konfigurasi benar
4. Pastikan `APP_KEY` sudah di-generate
5. Cek PHP version (minimal PHP 8.2)

### Error 404 - Not Found
**Solusi:**
1. Pastikan file `.htaccess` ada di folder `public/`
2. Pastikan mod_rewrite aktif di hosting
3. Pastikan document root di-set ke folder `public/`
4. Cek konfigurasi route: `php artisan route:list`

### Database Connection Error
**Solusi:**
1. Cek konfigurasi database di `.env`
2. Pastikan database sudah dibuat dan diimport
3. Cek kredensial database (username, password)
4. Cek host database (biasanya `localhost`)
5. Pastikan user database memiliki permission

### CSS/JS Tidak Ter-load
**Solusi:**
1. Pastikan `npm run build` sudah dijalankan
2. Cek folder `public/build/` ada dan berisi file
3. Cek file `public/build/manifest.json` ada
4. Clear browser cache
5. Cek console browser untuk error

### File Upload Error
**Solusi:**
1. Cek permission folder `storage/app/public/` (755)
2. Pastikan folder `storage/` writable
3. Cek ukuran file upload (max upload size di PHP)
4. Pastikan `storage:link` sudah dijalankan

### Permission Denied
**Solusi:**
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

---

## 📝 Informasi Penting

### Akun Default (Setelah Import Database)
- **Email**: `admin@alfalahkrui.sch.id`
- **Password**: `password`
- **⚠️ PENTING**: Ganti password setelah login pertama kali!

### File yang TIDAK Perlu Diupload
- `node_modules/` (folder besar, tidak diperlukan)
- `.env` (akan dibuat di hosting)
- `database/database.sqlite` (jika ada)
- `storage/logs/*.log` (file log)
- `.git/` (jika menggunakan git)
- File backup dan temporary

### File yang WAJIB Diupload
- Semua folder: `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`, `storage/`, `vendor/`
- File: `artisan`, `composer.json`, `composer.lock`
- Folder `public/` atau isinya
- File `.htaccess`

---

## ✅ Final Checklist

Sebelum menandai deployment selesai, pastikan:

- [ ] Semua langkah di atas sudah dilakukan
- [ ] Aplikasi bisa diakses di browser
- [ ] Login admin berhasil
- [ ] Fitur utama berfungsi
- [ ] Tidak ada error di log
- [ ] CSS dan JS ter-load dengan benar
- [ ] File upload berfungsi (jika ada)
- [ ] Password admin sudah diganti

---

## 🎉 Deployment Selesai!

Jika semua checklist sudah ditandai, aplikasi Anda siap digunakan di hosting!

**Catatan**: Simpan file checklist ini untuk referensi di masa depan.

