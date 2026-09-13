# 🚀 Quick Deployment Guide

Panduan cepat untuk deployment aplikasi CMS ke hosting.

## ⚡ Langkah Cepat (5 Menit)

### 1. Build Assets
```bash
npm run build
```

### 2. Jalankan Pre-Check
```bash
pre-deployment-check.bat
```

### 3. Siapkan untuk Upload
**Jika document root di `public_html/`:**
```bash
deploy-to-hosting.bat
```

**Jika document root di `public/`:**
- Upload semua file langsung

### 4. Upload ke Hosting
- Upload **SEMUA** file dan folder ke hosting
- Jangan upload: `.env`, `node_modules/`, `.git/`

### 5. Konfigurasi di Hosting

#### a. Buat File `.env`
```bash
# Upload env-hosting-template.txt, rename menjadi .env
# Edit dengan data hosting Anda
```

#### b. Generate APP_KEY
```bash
php artisan key:generate
```

#### c. Set Permission
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

#### d. Import Database
- Buka phpMyAdmin
- Import `database/cmsbq_database.sql`

#### e. Setup Storage Link
```bash
php artisan storage:link
```

#### f. Clear & Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Test
- Buka URL aplikasi di browser
- Login dengan: `admin@alfalahkrui.sch.id` / `password`
- **GANTI PASSWORD** setelah login pertama!

---

## 📋 Checklist Cepat

- [ ] `npm run build` sudah dijalankan
- [ ] Pre-check tidak ada error
- [ ] File sudah diupload ke hosting
- [ ] File `.env` sudah dibuat dan dikonfigurasi
- [ ] `APP_KEY` sudah di-generate
- [ ] Permission folder sudah di-set
- [ ] Database sudah diimport
- [ ] Storage link sudah dibuat
- [ ] Cache sudah di-clear dan di-generate
- [ ] Aplikasi bisa diakses
- [ ] Login berhasil
- [ ] Password sudah diganti

---

## 🔧 Troubleshooting Cepat

### Error 500
```bash
# Cek log
tail -f storage/logs/laravel.log

# Fix permission
chmod -R 755 storage/ bootstrap/cache/
```

### CSS/JS Tidak Load
```bash
# Rebuild assets
npm run build

# Upload ulang folder public/build/
```

### Database Error
- Cek konfigurasi di `.env`
- Pastikan database sudah diimport
- Cek kredensial database

---

## 📞 Informasi Penting

**Akun Default:**
- Email: `admin@alfalahkrui.sch.id`
- Password: `password`

**File Database:**
- `database/cmsbq_database.sql`

**Template Environment:**
- `env-hosting-template.txt`

---

Untuk panduan lengkap, lihat: `CHECKLIST-DEPLOYMENT.md`

