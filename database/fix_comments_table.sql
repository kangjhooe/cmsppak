-- Fix untuk menambahkan kolom yang missing di tabel comments
-- Jalankan SQL ini di phpMyAdmin jika tabel comments sudah ada tapi missing kolom

-- 1. Tambahkan kolom user_id jika belum ada
ALTER TABLE `comments` 
ADD COLUMN IF NOT EXISTS `user_id` bigint(20) UNSIGNED DEFAULT NULL AFTER `berita_id`;

-- 2. Tambahkan kolom parent_id jika belum ada
ALTER TABLE `comments` 
ADD COLUMN IF NOT EXISTS `parent_id` bigint(20) UNSIGNED DEFAULT NULL AFTER `user_id`;

-- 3. Tambahkan foreign key untuk user_id
ALTER TABLE `comments` 
ADD CONSTRAINT `comments_user_id_foreign` 
FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

-- 4. Tambahkan foreign key untuk parent_id
ALTER TABLE `comments` 
ADD CONSTRAINT `comments_parent_id_foreign` 
FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

-- 5. Tambahkan index untuk performa
ALTER TABLE `comments` 
ADD INDEX IF NOT EXISTS `comments_user_id_foreign` (`user_id`);

ALTER TABLE `comments` 
ADD INDEX IF NOT EXISTS `comments_parent_id_foreign` (`parent_id`);

-- 6. Update data yang mungkin null
UPDATE `comments` SET `user_id` = NULL WHERE `user_id` IS NULL;
UPDATE `comments` SET `parent_id` = NULL WHERE `parent_id` IS NULL;
