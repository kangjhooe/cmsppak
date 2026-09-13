-- Script SQL Sederhana untuk Memperbaiki Alamat di Hosting
-- Jalankan di phpMyAdmin

-- 1. Update alamat dengan data lengkap
UPDATE profiles 
SET alamat = 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Provinsi Lampung'
WHERE id = 1;

-- 2. Update profil_hero_description juga
UPDATE profiles 
SET profil_hero_description = 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Provinsi Lampung'
WHERE id = 1;

-- 3. Cek hasilnya
SELECT id, nama_sekolah, alamat, profil_hero_description FROM profiles WHERE id = 1;
