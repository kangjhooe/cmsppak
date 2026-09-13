-- Quick fix untuk kolom tiktok yang missing
-- Jalankan SQL ini di phpMyAdmin

ALTER TABLE `profiles` ADD COLUMN `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`;
ALTER TABLE `profiles` ADD COLUMN `foto_kepala_madrasah` varchar(255) DEFAULT NULL AFTER `logo`;
ALTER TABLE `profiles` ADD COLUMN `profil_hero_title` varchar(255) DEFAULT NULL;
ALTER TABLE `profiles` ADD COLUMN `profil_hero_subtitle` varchar(255) DEFAULT NULL;
ALTER TABLE `profiles` ADD COLUMN `profil_hero_description` text DEFAULT NULL;
ALTER TABLE `profiles` ADD COLUMN `profil_custom_sections` json DEFAULT NULL;
