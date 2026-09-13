# Setup MySQL di XAMPP untuk Development Lokal

## 🚀 Langkah-langkah Setup MySQL di XAMPP

### 1. Pastikan XAMPP MySQL Berjalan
1. Buka **XAMPP Control Panel**
2. Start **Apache** dan **MySQL**
3. Pastikan status MySQL menunjukkan "Running"

### 2. Buat Database MySQL
1. Buka browser dan akses: `http://localhost/phpmyadmin`
2. Klik **"New"** untuk membuat database baru
3. Nama database: `cmsbq`
4. Collation: `utf8mb4_unicode_ci`
5. Klik **"Create"**

### 3. Import Database Schema
1. Di phpMyAdmin, pilih database `cmsbq`
2. Klik tab **"Import"**
3. Klik **"Choose File"** dan pilih file `database/cmsbq_database.sql`
4. Klik **"Go"** untuk import

### 4. Setup File .env
1. Copy file `env-local-mysql.txt` menjadi `.env`
2. Edit file `.env` dan sesuaikan konfigurasi:

```env
# Database Configuration - MySQL Local (XAMPP)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cmsbq
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

### 7. Test Aplikasi
1. Buka browser dan akses: `http://localhost/cmsppak/public`
2. Pastikan aplikasi berjalan tanpa error
3. Test login dan fitur utama

## 🔧 Konfigurasi XAMPP untuk MySQL

### Default MySQL Settings di XAMPP:
- **Host**: `127.0.0.1` atau `localhost`
- **Port**: `3306`
- **Username**: `root`
- **Password**: (kosong)
- **phpMyAdmin**: `http://localhost/phpmyadmin`

### Jika MySQL Port Berbeda:
Jika MySQL menggunakan port lain (misal 3307), update di file `.env`:
```env
DB_PORT=3307
```

## 📊 Keuntungan MySQL di Local

### vs SQLite:
- ✅ **Konsistensi**: Sama dengan production
- ✅ **Features**: Full MySQL features
- ✅ **Testing**: Test dengan database yang sama
- ✅ **Performance**: Lebih baik untuk data besar
- ✅ **Tools**: phpMyAdmin untuk management

### vs SQLite:
- ❌ **Setup**: Lebih kompleks
- ❌ **Resource**: Lebih banyak memory
- ❌ **Portability**: Tidak bisa copy file database

## 🚨 Troubleshooting

### Error: "SQLSTATE[HY000] [2002] Connection refused"
**Solusi:**
1. Pastikan MySQL service berjalan di XAMPP
2. Cek port MySQL (default 3306)
3. Restart XAMPP MySQL service

### Error: "SQLSTATE[HY000] [1045] Access denied"
**Solusi:**
1. Cek username dan password di file `.env`
2. Default XAMPP: username `root`, password kosong
3. Jika ada password, update di file `.env`

### Error: "SQLSTATE[HY000] [1049] Unknown database"
**Solusi:**
1. Pastikan database `cmsbq` sudah dibuat
2. Import file `database/cmsbq_database.sql`
3. Cek nama database di file `.env`

### Error: "Class 'PDO' not found"
**Solusi:**
1. Pastikan extension `pdo_mysql` aktif di PHP
2. Edit file `php.ini` dan uncomment:
   ```ini
   extension=pdo_mysql
   ```
3. Restart Apache di XAMPP

## 📝 Checklist Setup

- [ ] XAMPP MySQL service berjalan
- [ ] Database `cmsbq` sudah dibuat
- [ ] File `database/cmsbq_database.sql` sudah diimport
- [ ] File `.env` sudah dikonfigurasi untuk MySQL
- [ ] Application key sudah di-generate
- [ ] Cache sudah di-clear
- [ ] Aplikasi berjalan di browser
- [ ] Login dan fitur utama sudah ditest

## 🔄 Rollback ke SQLite (Jika Perlu)

Jika ingin kembali ke SQLite:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Kemudian clear cache:
```bash
php artisan config:clear
php artisan cache:clear
```
