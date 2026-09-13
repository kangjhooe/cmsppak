-- Fix untuk menambahkan kolom tiktok yang missing di hosting
-- Jalankan file ini di database hosting untuk mengatasi error "Unknown column 'tiktok'"

-- Tambahkan kolom tiktok jika belum ada
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`;

-- Update data jika diperlukan (opsional)
-- UPDATE `profiles` SET `tiktok` = NULL WHERE `tiktok` IS NULL;
