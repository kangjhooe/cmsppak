-- Quick fix untuk error tiktok di hosting
-- Jalankan SQL ini di database hosting

ALTER TABLE `profiles` ADD COLUMN `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`;
