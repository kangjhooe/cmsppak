-- Menambahkan kolom favicon ke tabel profiles
-- Jalankan query ini jika kolom favicon belum ada di database

ALTER TABLE `profiles` 
ADD COLUMN `favicon` varchar(255) DEFAULT NULL AFTER `logo`;

