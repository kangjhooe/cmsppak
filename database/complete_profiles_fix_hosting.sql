-- Fix lengkap untuk tabel profiles di hosting
-- Jalankan file ini di database hosting untuk mengatasi semua error kolom yang missing

-- Tambahkan kolom-kolom yang mungkin missing
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`,
ADD COLUMN IF NOT EXISTS `whatsapp_admin` varchar(20) DEFAULT NULL AFTER `tiktok`,
ADD COLUMN IF NOT EXISTS `jam_operasional` varchar(100) DEFAULT NULL AFTER `whatsapp_admin`,
ADD COLUMN IF NOT EXISTS `koordinat_lat` decimal(10,8) DEFAULT NULL AFTER `logo`,
ADD COLUMN IF NOT EXISTS `koordinat_lng` decimal(11,8) DEFAULT NULL AFTER `koordinat_lat`,
ADD COLUMN IF NOT EXISTS `koordinat_alt` decimal(8,2) DEFAULT NULL AFTER `koordinat_lng`,
ADD COLUMN IF NOT EXISTS `jumlah_siswa` int(11) DEFAULT NULL AFTER `kepala_sekolah`,
ADD COLUMN IF NOT EXISTS `jumlah_guru` int(11) DEFAULT NULL AFTER `jumlah_siswa`,
ADD COLUMN IF NOT EXISTS `jumlah_kelas` int(11) DEFAULT NULL AFTER `jumlah_guru`,
ADD COLUMN IF NOT EXISTS `tahun_berdiri` int(11) DEFAULT NULL AFTER `jumlah_kelas`,
ADD COLUMN IF NOT EXISTS `fasilitas` longtext DEFAULT NULL AFTER `tahun_berdiri`,
ADD COLUMN IF NOT EXISTS `prestasi` longtext DEFAULT NULL AFTER `fasilitas`,
ADD COLUMN IF NOT EXISTS `struktur_organisasi` longtext DEFAULT NULL AFTER `prestasi`,
ADD COLUMN IF NOT EXISTS `facebook` varchar(255) DEFAULT NULL AFTER `website`,
ADD COLUMN IF NOT EXISTS `instagram` varchar(255) DEFAULT NULL AFTER `facebook`,
ADD COLUMN IF NOT EXISTS `youtube` varchar(255) DEFAULT NULL AFTER `instagram`,
ADD COLUMN IF NOT EXISTS `twitter` varchar(255) DEFAULT NULL AFTER `youtube`,
ADD COLUMN IF NOT EXISTS `foto_kepala_madrasah` varchar(255) DEFAULT NULL AFTER `logo`,
ADD COLUMN IF NOT EXISTS `hero_image` varchar(255) DEFAULT NULL AFTER `foto_kepala_madrasah`,
ADD COLUMN IF NOT EXISTS `profil_hero_title` varchar(255) DEFAULT NULL AFTER `hero_image`,
ADD COLUMN IF NOT EXISTS `profil_hero_subtitle` varchar(255) DEFAULT NULL AFTER `profil_hero_title`,
ADD COLUMN IF NOT EXISTS `profil_hero_description` text DEFAULT NULL AFTER `profil_hero_subtitle`,
ADD COLUMN IF NOT EXISTS `profil_show_statistics` tinyint(1) DEFAULT 1 AFTER `profil_hero_description`,
ADD COLUMN IF NOT EXISTS `profil_show_contact` tinyint(1) DEFAULT 1 AFTER `profil_show_statistics`,
ADD COLUMN IF NOT EXISTS `profil_show_social_media` tinyint(1) DEFAULT 1 AFTER `profil_show_contact`,
ADD COLUMN IF NOT EXISTS `profil_show_principal` tinyint(1) DEFAULT 1 AFTER `profil_show_social_media`,
ADD COLUMN IF NOT EXISTS `profil_show_vision_mission` tinyint(1) DEFAULT 1 AFTER `profil_show_principal`,
ADD COLUMN IF NOT EXISTS `profil_show_history` tinyint(1) DEFAULT 1 AFTER `profil_show_vision_mission`,
ADD COLUMN IF NOT EXISTS `profil_show_facilities` tinyint(1) DEFAULT 1 AFTER `profil_show_history`,
ADD COLUMN IF NOT EXISTS `profil_show_achievements` tinyint(1) DEFAULT 1 AFTER `profil_show_facilities`,
ADD COLUMN IF NOT EXISTS `profil_show_organization` tinyint(1) DEFAULT 1 AFTER `profil_show_achievements`,
ADD COLUMN IF NOT EXISTS `profil_show_emergency_contact` tinyint(1) DEFAULT 1 AFTER `profil_show_organization`,
ADD COLUMN IF NOT EXISTS `profil_custom_sections` json DEFAULT NULL AFTER `profil_show_emergency_contact`;

-- Verifikasi bahwa kolom sudah ditambahkan
SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'profiles' 
AND TABLE_SCHEMA = DATABASE()
ORDER BY ORDINAL_POSITION;
