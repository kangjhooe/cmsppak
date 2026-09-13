-- Database CMS BQ - Pondok Pesantren Al-Falah Krui
-- File untuk import ke phpMyAdmin
-- Tanggal: 2025-01-27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: cmsbq
CREATE DATABASE IF NOT EXISTS `cmsbq` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cmsbq`;

-- Tabel users
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel profiles
CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `sejarah` longtext NOT NULL,
  `kepala_sekolah` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `koordinat_lat` decimal(10,8) DEFAULT NULL,
  `koordinat_lng` decimal(11,8) DEFAULT NULL,
  `koordinat_alt` int(11) DEFAULT NULL,
  `jumlah_siswa` int(11) DEFAULT NULL,
  `jumlah_guru` int(11) DEFAULT NULL,
  `jumlah_kelas` int(11) DEFAULT NULL,
  `tahun_berdiri` int(11) DEFAULT NULL,
  `fasilitas` longtext DEFAULT NULL,
  `prestasi` longtext DEFAULT NULL,
  `struktur_organisasi` longtext DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `whatsapp_admin` varchar(20) DEFAULT NULL,
  `jam_operasional` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel guru_staf
CREATE TABLE `guru_staf` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `mata_pelajaran` varchar(255) DEFAULT NULL,
  `biodata` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel berita
CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ringkasan` text NOT NULL,
  `konten` longtext NOT NULL,
  `gambar_utama` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `kategori` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `berita_slug_unique` (`slug`),
  KEY `berita_user_id_foreign` (`user_id`),
  CONSTRAINT `berita_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel agenda
CREATE TABLE `agenda` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `peserta` text DEFAULT NULL,
  `jenis` enum('akademik','non_akademik','umum') NOT NULL,
  `status` enum('upcoming','ongoing','completed','cancelled') NOT NULL DEFAULT 'upcoming',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel galeri
CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenis` enum('foto','video') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel buku_tamu
CREATE TABLE `buku_tamu` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status` enum('unread','read','replied') NOT NULL DEFAULT 'unread',
  `balasan` text DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel downloads
CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `tipe_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) NOT NULL,
  `jumlah_download` int(11) NOT NULL DEFAULT 0,
  `kategori` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel kategori
CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel comments
CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `berita_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_berita_id_foreign` (`berita_id`),
  CONSTRAINT `comments_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel password_reset_tokens
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel sessions
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel cache
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel cache_locks
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel jobs
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel job_batches
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel failed_jobs
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel migrations
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data sample
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin CMS', 'admin@alfalahkrui.sch.id', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, '2025-01-27 00:00:00', '2025-01-27 00:00:00');

INSERT INTO `profiles` (`id`, `nama_sekolah`, `npsn`, `alamat`, `telepon`, `email`, `website`, `visi`, `misi`, `sejarah`, `kepala_sekolah`, `logo`, `koordinat_lat`, `koordinat_lng`, `koordinat_alt`, `jumlah_siswa`, `jumlah_guru`, `jumlah_kelas`, `tahun_berdiri`, `fasilitas`, `prestasi`, `struktur_organisasi`, `facebook`, `instagram`, `youtube`, `twitter`, `whatsapp_admin`, `jam_operasional`, `created_at`, `updated_at`) VALUES
(1, 'Pondok Pesantren Al-Falah Krui', '12345678', 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat', '081274928879', 'info@alfalahkrui.sch.id', 'https://alfalahkrui.sch.id', 'Menjadi Pondok Pesantren yang unggul dalam pendidikan Islam dan sains modern', 'Menyelenggarakan pendidikan yang mengintegrasikan nilai-nilai Islam dengan ilmu pengetahuan modern', 'Pondok Pesantren Al-Falah Krui didirikan pada tahun 1990 dengan tujuan memberikan pendidikan yang berkualitas tinggi...', 'Dr. H. Ahmad Fauzi, M.Pd.', NULL, -5.0371514, 103.7562727, 82, 500, 25, 15, 1990, '<h3>Fasilitas Utama</h3><ul><li>Masjid dengan kapasitas 500 jamaah</li><li>Perpustakaan dengan koleksi 10.000+ buku</li><li>Laboratorium Komputer dengan 30 PC</li></ul>', '<h3>Prestasi Akademik</h3><ul><li>Juara 1 Olimpiade Sains tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Cerdas Cermat tingkat Provinsi (2023)</li></ul>', '<h3>Struktur Organisasi Sekolah</h3><div style="text-align: center;"><h4>Kepala Sekolah</h4><p><strong>Dr. H. Ahmad Fauzi, M.Pd.</strong></p></div>', 'https://facebook.com/alfalahkrui', 'https://instagram.com/alfalahkrui', 'https://youtube.com/@alfalahkrui', 'https://twitter.com/alfalahkrui', '081274928879', 'Senin-Jumat: 07:00-15:00 WIB, Sabtu: 07:00-12:00 WIB', '2025-01-27 00:00:00', '2025-01-27 00:00:00');

INSERT INTO `guru_staf` (`id`, `nip`, `nama_lengkap`, `jabatan`, `mata_pelajaran`, `biodata`, `foto`, `email`, `telepon`, `status`, `created_at`, `updated_at`) VALUES
(1, '196501011990031001', 'Dr. H. Ahmad Fauzi, M.Pd.', 'Kepala Sekolah', 'Pendidikan Agama Islam', 'Kepala Sekolah Pondok Pesantren Al-Falah Krui dengan pengalaman 20 tahun di bidang pendidikan', NULL, 'kepsek@alfalahkrui.sch.id', '081274928880', 'aktif', '2025-01-27 00:00:00', '2025-01-27 00:00:00'),
(2, '197203151995032002', 'Siti Aminah, S.Pd.', 'Wakil Kepala Sekolah', 'Matematika', 'Wakil Kepala Sekolah bidang kurikulum dengan spesialisasi matematika', NULL, 'wakakur@alfalahkrui.sch.id', '081274928881', 'aktif', '2025-01-27 00:00:00', '2025-01-27 00:00:00'),
(3, '198005201998031003', 'Muhammad Rizki, S.Pd.', 'Kepala Tata Usaha', 'Administrasi', 'Kepala Tata Usaha dengan pengalaman 15 tahun di bidang administrasi sekolah', NULL, 'tu@alfalahkrui.sch.id', '081274928882', 'aktif', '2025-01-27 00:00:00', '2025-01-27 00:00:00');

INSERT INTO `berita` (`id`, `user_id`, `judul`, `slug`, `ringkasan`, `konten`, `gambar_utama`, `status`, `published_at`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 1, 'Selamat Datang di Pondok Pesantren Al-Falah Krui', 'selamat-datang-di-pondok-pesantren-alfalah-krui', 'Selamat datang di website resmi Pondok Pesantren Al-Falah Krui. Kami berkomitmen memberikan pendidikan terbaik untuk generasi muda.', '<p>Selamat datang di website resmi Pondok Pesantren Al-Falah Krui. Kami berkomitmen memberikan pendidikan terbaik untuk generasi muda.</p>', NULL, 'published', '2025-01-27 00:00:00', 0, '2025-01-27 00:00:00', '2025-01-27 00:00:00'),
(2, 1, 'Penerimaan Siswa Baru Tahun Ajaran 2025/2026', 'penerimaan-siswa-baru-tahun-ajaran-2025-2026', 'Pondok Pesantren Al-Falah Krui membuka pendaftaran siswa baru untuk tahun ajaran 2025/2026. Segera daftarkan putra-putri Anda.', '<p>Pondok Pesantren Al-Falah Krui membuka pendaftaran siswa baru untuk tahun ajaran 2025/2026. Segera daftarkan putra-putri Anda.</p>', NULL, 'published', '2025-01-27 00:00:00', 0, '2025-01-27 00:00:00', '2025-01-27 00:00:00');

INSERT INTO `agenda` (`id`, `judul`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `waktu_mulai`, `waktu_selesai`, `lokasi`, `jenis`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Upacara Hari Kemerdekaan', 'Upacara bendera dalam rangka memperingati Hari Kemerdekaan RI', '2025-08-17', '2025-08-17', '07:00:00', '08:00:00', 'Lapangan Sekolah', 'umum', 'upcoming', '2025-01-27 00:00:00', '2025-01-27 00:00:00'),
(2, 'Ujian Akhir Semester', 'Pelaksanaan UAS untuk semua kelas', '2025-06-01', '2025-06-15', '07:30:00', '12:00:00', 'Ruang Kelas', 'akademik', 'upcoming', '2025-01-27 00:00:00', '2025-01-27 00:00:00');

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', 'pendidikan', 'Berita seputar dunia pendidikan', '2025-01-27 00:00:00', '2025-01-27 00:00:00'),
(2, 'Olahraga', 'olahraga', 'Berita seputar kegiatan olahraga', '2025-01-27 00:00:00', '2025-01-27 00:00:00'),
(3, 'Umum', 'umum', 'Berita umum sekolah', '2025-01-27 00:00:00', '2025-01-27 00:00:00');

COMMIT;
