# Fix Error TikTok Column di Hosting

## Masalah
Error yang terjadi saat menyimpan profil:
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'tiktok' in 'SET'
```

## Penyebab
Kolom `tiktok` belum ada di tabel `profiles` di database hosting, padahal sudah ada di model dan migration lokal.

## Solusi

### Opsi 1: Quick Fix (Direkomendasikan)
1. Buka phpMyAdmin atau tool database hosting
2. Jalankan SQL berikut:

```sql
ALTER TABLE `profiles` ADD COLUMN `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`;
```

### Opsi 2: Menggunakan File SQL
1. Upload file `database/quick_tiktok_fix.sql` ke hosting
2. Jalankan file tersebut di database hosting

### Opsi 3: Fix Lengkap (Jika ada kolom lain yang missing)
1. Upload file `database/complete_profiles_fix_hosting.sql` ke hosting
2. Jalankan file tersebut di database hosting

## Verifikasi
Setelah menjalankan fix, cek apakah kolom sudah ada:

```sql
DESCRIBE profiles;
```

Atau:

```sql
SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'profiles' AND COLUMN_NAME = 'tiktok';
```

## Pencegahan
Untuk mencegah masalah serupa di masa depan:
1. Pastikan semua migration sudah dijalankan di hosting
2. Gunakan `php artisan migrate` di hosting jika memungkinkan
3. Atau sinkronkan struktur database dengan file SQL dump yang lengkap

## File yang Tersedia
- `database/quick_tiktok_fix.sql` - Fix cepat untuk kolom tiktok
- `database/complete_profiles_fix_hosting.sql` - Fix lengkap untuk semua kolom
- `database/fix_tiktok_column_hosting.sql` - Fix dengan IF NOT EXISTS
