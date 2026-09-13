# Panduan Migrasi dari SQLite ke MySQL

## ✅ Aplikasi Sudah Siap untuk MySQL

Aplikasi CMS Pondok Pesantren Al-Falah Krui sudah **100% siap** untuk menggunakan MySQL. Berikut alasannya:

### 1. Konfigurasi MySQL Sudah Ada
- File `config/database.php` sudah memiliki konfigurasi MySQL lengkap
- Support untuk MySQL 5.7+ dan MariaDB

### 2. Database Schema Sudah Tersedia
- File `database/cmsbq_database.sql` berisi semua tabel yang dibutuhkan
- Schema sudah dioptimalkan untuk MySQL dengan charset `utf8mb4`
- Semua tabel menggunakan engine `InnoDB`

### 3. Aplikasi Laravel Native
- Laravel secara default mendukung multiple database
- Tidak ada kode yang hardcode untuk SQLite

## 🚀 Cara Migrasi ke MySQL

### Langkah 1: Siapkan Database MySQL
```sql
-- Buat database baru
CREATE DATABASE cmsbq CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Langkah 2: Import Database Schema
```bash
# Import file SQL ke MySQL
mysql -u username -p cmsbq < database/cmsbq_database.sql
```

### Langkah 3: Update File .env
```env
# Ganti dari SQLite ke MySQL
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cmsbq
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Langkah 4: Clear Cache dan Test
```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

## 📊 Perbandingan SQLite vs MySQL

| Aspek | SQLite | MySQL |
|-------|--------|-------|
| **Penggunaan** | Development/Local | Production/Hosting |
| **Performance** | Cepat untuk data kecil | Lebih baik untuk data besar |
| **Concurrent Users** | Terbatas | Tidak terbatas |
| **Backup** | File copy | Dump/Import |
| **Hosting Support** | Terbatas | Universal |

## 🔧 Konfigurasi MySQL yang Optimal

### Untuk Hosting Shared
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cmsbq
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
```

### Untuk Hosting VPS/Dedicated
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cmsbq
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
DB_STRICT=true
```

## ⚠️ Hal yang Perlu Diperhatikan

### 1. Data Migration
Jika sudah ada data di SQLite, perlu export/import:
```bash
# Export dari SQLite (jika ada data)
sqlite3 database/database.sqlite .dump > data_export.sql

# Import ke MySQL (sesuaikan syntax jika perlu)
mysql -u username -p cmsbq < data_export.sql
```

### 2. File Upload
- Pastikan folder `storage/app/public/` ada dan writable
- Set permission 755 untuk folder storage

### 3. Environment Variables
- Pastikan `APP_KEY` sudah di-generate
- Set `APP_ENV=production` untuk hosting
- Set `APP_DEBUG=false` untuk production

## 🎯 Keuntungan Migrasi ke MySQL

1. **Kompatibilitas Hosting**: Semua hosting support MySQL
2. **Performance**: Lebih cepat untuk aplikasi dengan banyak user
3. **Scalability**: Bisa handle concurrent users lebih banyak
4. **Backup**: Lebih mudah backup dan restore
5. **Monitoring**: Tools monitoring database lebih lengkap

## 🚨 Troubleshooting

### Error: "SQLSTATE[HY000] [2002] Connection refused"
- Cek konfigurasi `DB_HOST` dan `DB_PORT`
- Pastikan MySQL service berjalan

### Error: "SQLSTATE[HY000] [1045] Access denied"
- Cek username dan password database
- Pastikan user memiliki permission untuk database

### Error: "SQLSTATE[HY000] [1049] Unknown database"
- Pastikan database sudah dibuat
- Cek nama database di konfigurasi

## 📝 Checklist Migrasi

- [ ] Database MySQL sudah dibuat
- [ ] File `cmsbq_database.sql` sudah diimport
- [ ] File `.env` sudah diupdate dengan konfigurasi MySQL
- [ ] Permission folder `storage/` sudah benar (755)
- [ ] Cache sudah di-clear
- [ ] Aplikasi sudah ditest di browser
- [ ] Login dan fitur utama sudah ditest
