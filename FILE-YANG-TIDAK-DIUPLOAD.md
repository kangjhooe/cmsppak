# 🚫 File dan Folder yang TIDAK Perlu Diupload ke Hosting

## ❌ File yang TIDAK Perlu Diupload

### 1. File Environment
- `.env` - **JANGAN upload!** (buat baru dari `env-hosting-template.txt` di hosting)
- `.env.backup` - File backup environment
- `.env.production` - File environment production (jika ada)

### 2. File Database Lokal
- `database/database.sqlite` - Database SQLite lokal (jika ada)
- File backup database lokal lainnya

### 3. File Log
- `storage/logs/*.log` - File log aplikasi
- File log lainnya

### 4. File Development
- `node_modules/` - **JANGAN upload!** (folder besar, tidak diperlukan di hosting)
- `.git/` - Folder Git (jika menggunakan version control)
- `.gitignore` - File Git ignore
- `.vscode/` - Folder VS Code settings
- `.idea/` - Folder IDE settings
- `.phpunit.result.cache` - Cache PHPUnit
- `.phpunit.cache/` - Cache PHPUnit

### 5. File Temporary dan Backup
- `*.zip` - File zip backup (jika ada)
- `*.bak` - File backup
- `Thumbs.db` - File thumbnail Windows
- `.DS_Store` - File macOS (jika ada)

### 6. File Build Development
- `public/hot` - File Vite hot reload (jika ada)
- File temporary lainnya

### 7. File Testing
- `phpunit.xml` - File konfigurasi testing (opsional, tidak diperlukan)
- Folder `tests/` - Folder testing (opsional, tidak diperlukan)

---

## ✅ File yang WAJIB Diupload

### Folder Utama
- ✅ `app/` - **WAJIB**
- ✅ `bootstrap/` - **WAJIB**
- ✅ `config/` - **WAJIB**
- ✅ `database/` - **WAJIB** (kecuali `database.sqlite`)
- ✅ `resources/` - **WAJIB**
- ✅ `routes/` - **WAJIB**
- ✅ `storage/` - **WAJIB** (kecuali file log)
- ✅ `vendor/` - **WAJIB**
- ✅ `public/` - **WAJIB** (atau isinya jika document root di public_html)

### File Utama
- ✅ `artisan` - **WAJIB**
- ✅ `composer.json` - **WAJIB**
- ✅ `composer.lock` - **WAJIB**
- ✅ `package.json` - **WAJIB** (opsional, tapi baik diupload)
- ✅ `vite.config.js` - **WAJIB** (opsional, tapi baik diupload)

### File Public
- ✅ `public/index.php` - **WAJIB**
- ✅ `public/.htaccess` - **WAJIB**
- ✅ `public/build/` - **WAJIB** (folder build assets)
- ✅ `public/css/` - **WAJIB** (jika ada)
- ✅ `public/js/` - **WAJIB** (jika ada)
- ✅ `public/images/` - **WAJIB** (jika ada)
- ✅ `public/favicon.ico` - **WAJIB** (jika ada)

### File Deployment
- ✅ `env-hosting-template.txt` - **WAJIB** (untuk membuat .env di hosting)
- ✅ `database/cmsbq_database.sql` - **WAJIB** (untuk import database)

---

## 📋 Checklist Upload

Sebelum upload, pastikan:

- [ ] File `.env` **TIDAK** diupload
- [ ] Folder `node_modules/` **TIDAK** diupload
- [ ] File `database/database.sqlite` **TIDAK** diupload (jika ada)
- [ ] File log (`storage/logs/*.log`) **TIDAK** diupload
- [ ] Folder `.git/` **TIDAK** diupload (jika ada)
- [ ] File backup dan temporary **TIDAK** diupload
- [ ] Folder `vendor/` **DIUPLOAD** (atau install via composer di hosting)
- [ ] Folder `public/build/` **DIUPLOAD** (build assets)
- [ ] File `env-hosting-template.txt` **DIUPLOAD**
- [ ] File `database/cmsbq_database.sql` **DIUPLOAD**

---

## 💡 Tips Upload

### Opsi 1: Upload Semua, Kecuali yang Diblokir
- Upload semua file dan folder
- Pastikan file `.env` **TIDAK** terupload
- Pastikan folder `node_modules/` **TIDAK** terupload

### Opsi 2: Upload Selektif
- Upload hanya file dan folder yang ada di checklist "WAJIB"
- Lebih aman tapi lebih lama

### Opsi 3: Install Dependencies di Hosting
- Upload semua file (kecuali yang diblokir)
- Install vendor di hosting: `composer install --optimize-autoloader --no-dev`
- Tidak perlu upload folder `vendor/` (hemat bandwidth)

---

## ⚠️ Catatan Penting

1. **File `.env`** - JANGAN PERNAH upload! Buat baru di hosting dari template
2. **Folder `node_modules/`** - Tidak diperlukan di hosting (hanya untuk development)
3. **Folder `vendor/`** - Bisa diupload ATAU install via composer di hosting
4. **File log** - Tidak perlu diupload (akan dibuat otomatis)
5. **Database SQLite** - Tidak perlu diupload (gunakan MySQL di hosting)

---

## 🔍 Cara Cek Setelah Upload

Setelah upload, pastikan di hosting:

1. File `.env` **TIDAK ADA** (atau sudah dibuat baru dari template)
2. Folder `node_modules/` **TIDAK ADA**
3. Folder `vendor/` **ADA** (atau install via composer)
4. Folder `public/build/` **ADA** dan berisi file
5. File `database/cmsbq_database.sql` **ADA**

---

**Kesimpulan**: Tidak hanya `.env`, tapi juga `node_modules/`, file log, dan beberapa file development lainnya tidak perlu diupload.

