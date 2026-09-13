-- Script SQL untuk Mengosongkan Field Alamat
-- Jalankan di phpMyAdmin

-- 1. Kosongkan field alamat
UPDATE profiles 
SET alamat = NULL
WHERE id = 1;

-- 2. Kosongkan field profil_hero_description
UPDATE profiles 
SET profil_hero_description = NULL
WHERE id = 1;

-- 3. Verifikasi hasil
SELECT id, nama_sekolah, alamat, profil_hero_description FROM profiles WHERE id = 1;
