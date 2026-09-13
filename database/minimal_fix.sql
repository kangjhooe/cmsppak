-- Fix minimal untuk error tiktok
ALTER TABLE `profiles` ADD COLUMN `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`;
