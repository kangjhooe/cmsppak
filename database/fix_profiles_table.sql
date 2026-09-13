-- Fix untuk menambahkan kolom yang missing di tabel profiles
-- Jalankan SQL ini di phpMyAdmin untuk menambahkan kolom yang dibutuhkan

-- 1. Tambahkan kolom koordinat
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `koordinat_lat` decimal(10,8) DEFAULT NULL AFTER `logo`,
ADD COLUMN IF NOT EXISTS `koordinat_lng` decimal(11,8) DEFAULT NULL AFTER `koordinat_lat`,
ADD COLUMN IF NOT EXISTS `koordinat_alt` int(11) DEFAULT NULL AFTER `koordinat_lng`;

-- 2. Tambahkan kolom statistik sekolah
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `jumlah_siswa` int(11) DEFAULT NULL AFTER `koordinat_alt`,
ADD COLUMN IF NOT EXISTS `jumlah_guru` int(11) DEFAULT NULL AFTER `jumlah_siswa`,
ADD COLUMN IF NOT EXISTS `jumlah_kelas` int(11) DEFAULT NULL AFTER `jumlah_guru`,
ADD COLUMN IF NOT EXISTS `tahun_berdiri` int(11) DEFAULT NULL AFTER `jumlah_kelas`;

-- 3. Tambahkan kolom konten
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `fasilitas` longtext DEFAULT NULL AFTER `tahun_berdiri`,
ADD COLUMN IF NOT EXISTS `prestasi` longtext DEFAULT NULL AFTER `fasilitas`,
ADD COLUMN IF NOT EXISTS `struktur_organisasi` longtext DEFAULT NULL AFTER `prestasi`;

-- 4. Tambahkan kolom social media
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `facebook` varchar(255) DEFAULT NULL AFTER `website`,
ADD COLUMN IF NOT EXISTS `instagram` varchar(255) DEFAULT NULL AFTER `facebook`,
ADD COLUMN IF NOT EXISTS `youtube` varchar(255) DEFAULT NULL AFTER `instagram`,
ADD COLUMN IF NOT EXISTS `twitter` varchar(255) DEFAULT NULL AFTER `youtube`,
ADD COLUMN IF NOT EXISTS `tiktok` varchar(255) DEFAULT NULL AFTER `twitter`,
ADD COLUMN IF NOT EXISTS `whatsapp_admin` varchar(20) DEFAULT NULL AFTER `tiktok`,
ADD COLUMN IF NOT EXISTS `jam_operasional` varchar(255) DEFAULT NULL AFTER `whatsapp_admin`;

-- 5. Tambahkan kolom foto dan hero
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `foto_kepala_madrasah` varchar(255) DEFAULT NULL AFTER `logo`,
ADD COLUMN IF NOT EXISTS `hero_image` varchar(255) DEFAULT NULL AFTER `foto_kepala_madrasah`;

-- 6. Tambahkan kolom profil frontend
ALTER TABLE `profiles` 
ADD COLUMN IF NOT EXISTS `profil_hero_title` varchar(255) DEFAULT NULL AFTER `hero_image`,
ADD COLUMN IF NOT EXISTS `profil_hero_subtitle` varchar(255) DEFAULT NULL AFTER `profil_hero_title`,
ADD COLUMN IF NOT EXISTS `profil_hero_description` text DEFAULT NULL AFTER `profil_hero_subtitle`,
ADD COLUMN IF NOT EXISTS `profil_show_statistics` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_hero_description`,
ADD COLUMN IF NOT EXISTS `profil_show_contact` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_statistics`,
ADD COLUMN IF NOT EXISTS `profil_show_social_media` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_contact`,
ADD COLUMN IF NOT EXISTS `profil_show_principal` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_social_media`,
ADD COLUMN IF NOT EXISTS `profil_show_vision_mission` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_principal`,
ADD COLUMN IF NOT EXISTS `profil_show_history` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_vision_mission`,
ADD COLUMN IF NOT EXISTS `profil_show_facilities` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_history`,
ADD COLUMN IF NOT EXISTS `profil_show_achievements` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_facilities`,
ADD COLUMN IF NOT EXISTS `profil_show_organization` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_achievements`,
ADD COLUMN IF NOT EXISTS `profil_show_emergency_contact` tinyint(1) NOT NULL DEFAULT 1 AFTER `profil_show_organization`,
ADD COLUMN IF NOT EXISTS `profil_custom_sections` json DEFAULT NULL AFTER `profil_show_emergency_contact`,
ADD COLUMN IF NOT EXISTS `profil_frontend` longtext DEFAULT NULL AFTER `profil_custom_sections`;

-- 7. Update data yang mungkin null
UPDATE `profiles` SET 
    `koordinat_lat` = -5.0371514,
    `koordinat_lng` = 103.7562727,
    `koordinat_alt` = 82,
    `jumlah_siswa` = 500,
    `jumlah_guru` = 25,
    `jumlah_kelas` = 15,
    `tahun_berdiri` = 1990,
    `facebook` = 'https://facebook.com/alfalahkrui',
    `instagram` = 'https://instagram.com/alfalahkrui',
    `youtube` = 'https://youtube.com/@alfalahkrui',
    `twitter` = 'https://twitter.com/alfalahkrui',
    `tiktok` = 'https://tiktok.com/@alfalahkrui',
    `whatsapp_admin` = '081274928879',
    `jam_operasional` = 'Senin-Jumat: 07:00-15:00 WIB, Sabtu: 07:00-12:00 WIB',
    `profil_hero_title` = 'Profil Pondok Pesantren',
    `profil_hero_subtitle` = NULL,
    `profil_hero_description` = NULL
WHERE `id` = 1;
