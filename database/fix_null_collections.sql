-- Fix untuk mengatasi error "Call to a member function count() on null"
-- Jalankan SQL ini di phpMyAdmin setelah import database utama

-- 1. Pastikan semua berita memiliki relasi dengan kategori
INSERT IGNORE INTO `berita_kategori` (`berita_id`, `kategori_id`, `created_at`, `updated_at`)
SELECT b.id, k.id, NOW(), NOW()
FROM `berita` b
CROSS JOIN `kategori` k
WHERE k.nama = 'Umum'
AND NOT EXISTS (
    SELECT 1 FROM `berita_kategori` bk 
    WHERE bk.berita_id = b.id
);

-- 2. Pastikan semua galeri memiliki items
INSERT IGNORE INTO `galeri_items` (`galeri_id`, `judul`, `deskripsi`, `file_path`, `thumbnail`, `urutan`, `created_at`, `updated_at`)
SELECT g.id, 'Item Default', 'Item default untuk galeri', 'default.jpg', 'default-thumb.jpg', 1, NOW(), NOW()
FROM `galeri` g
WHERE NOT EXISTS (
    SELECT 1 FROM `galeri_items` gi 
    WHERE gi.galeri_id = g.id
);

-- 3. Update status galeri items yang null
UPDATE `galeri_items` SET `status` = 'active' WHERE `status` IS NULL;

-- 4. Update status galeri yang null
UPDATE `galeri` SET `status` = 'active' WHERE `status` IS NULL;

-- 5. Update is_active kategori yang null
UPDATE `kategori` SET `is_active` = 1 WHERE `is_active` IS NULL;

-- 6. Update is_active downloads yang null
UPDATE `downloads` SET `is_active` = 1 WHERE `is_active` IS NULL;

-- 7. Update status guru_staf yang null
UPDATE `guru_staf` SET `status` = 'aktif' WHERE `status` IS NULL;

-- 8. Update status berita yang null
UPDATE `berita` SET `status` = 'published' WHERE `status` IS NULL;

-- 9. Update published_at berita yang null
UPDATE `berita` SET `published_at` = `created_at` WHERE `published_at` IS NULL;

-- 10. Update view_count berita yang null
UPDATE `berita` SET `view_count` = 0 WHERE `view_count` IS NULL;
