-- Fix sederhana untuk kolom yang missing di tabel profiles
-- Berdasarkan error yang terjadi

ALTER TABLE `profiles` ADD COLUMN `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`;
ALTER TABLE `profiles` ADD COLUMN `foto_kepala_madrasah` varchar(255) DEFAULT NULL AFTER `logo`;
ALTER TABLE `profiles` ADD COLUMN `profil_hero_title` varchar(255) DEFAULT NULL;
ALTER TABLE `profiles` ADD COLUMN `profil_hero_subtitle` varchar(255) DEFAULT NULL;
ALTER TABLE `profiles` ADD COLUMN `profil_hero_description` text DEFAULT NULL;
ALTER TABLE `profiles` ADD COLUMN `profil_custom_sections` json DEFAULT NULL;
