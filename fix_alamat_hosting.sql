-- Script SQL untuk memperbaiki masalah alamat di hosting
-- Jalankan script ini di phpMyAdmin

-- 1. Periksa struktur tabel profiles terlebih dahulu
DESCRIBE profiles;

-- 2. Periksa data alamat yang ada
SELECT id, nama_sekolah, alamat, LENGTH(alamat) as panjang_alamat FROM profiles;

-- 3. Perbaiki struktur field alamat jika diperlukan (ubah dari varchar ke text)
-- Hapus komentar di bawah ini jika field alamat masih varchar dengan panjang terbatas
-- ALTER TABLE profiles MODIFY COLUMN alamat TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 4. Update alamat dengan data lengkap (sesuaikan dengan alamat yang benar)
UPDATE profiles 
SET alamat = 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Provinsi Lampung'
WHERE id = 1;

-- 5. Update profil_hero_description jika kosong atau terpotong
UPDATE profiles 
SET profil_hero_description = 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Provinsi Lampung'
WHERE id = 1 AND (profil_hero_description IS NULL OR LENGTH(profil_hero_description) < 10);

-- 6. Verifikasi hasil update
SELECT id, nama_sekolah, alamat, LENGTH(alamat) as panjang_alamat, profil_hero_description, LENGTH(profil_hero_description) as panjang_deskripsi 
FROM profiles;

-- 7. Jika masih ada masalah, coba update dengan data yang lebih spesifik
-- Ganti 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Provinsi Lampung'
-- dengan alamat yang sebenarnya

-- 8. Script alternatif jika ada masalah encoding
-- SET NAMES utf8mb4;
-- UPDATE profiles 
-- SET alamat = CONVERT('Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Provinsi Lampung' USING utf8mb4)
-- WHERE id = 1;

-- 9. Script untuk memastikan charset database benar
-- ALTER DATABASE nama_database_anda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- ALTER TABLE profiles CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
