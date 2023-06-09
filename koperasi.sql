-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for koperasi
CREATE DATABASE IF NOT EXISTS `koperasi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `koperasi`;

-- Dumping structure for table koperasi.anggsuran
CREATE TABLE IF NOT EXISTS `anggsuran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pinjaman` int NOT NULL,
  `id_anggota` int NOT NULL,
  `angsuran` int NOT NULL,
  `lunas` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tanggal_jatuh_tempo` date NOT NULL,
  `status_telat` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.anggsuran: ~3 rows (approximately)
INSERT INTO `anggsuran` (`id`, `id_pinjaman`, `id_anggota`, `angsuran`, `lunas`, `tanggal_jatuh_tempo`, `status_telat`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 7, 676667, '1', '2023-06-15', '0', NULL, '7', NULL, '2023-05-14 22:40:37'),
	(2, 1, 7, 676667, '0', '2023-07-15', '0', NULL, NULL, NULL, NULL),
	(3, 1, 7, 676667, '0', '2023-08-15', '0', NULL, NULL, NULL, NULL);

-- Dumping structure for table koperasi.data_anggota
CREATE TABLE IF NOT EXISTS `data_anggota` (
  `id` int NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_anggota_nik_unique` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.data_anggota: ~2 rows (approximately)
INSERT INTO `data_anggota` (`id`, `nik`, `npwp`, `tanggal_masuk`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `nomor_hp`, `alamat`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
	(6, '213123123', NULL, '2023-05-15', 'ades', 'Malang', '2023-05-15', 'laki-laki', '081231232132', 'asdasdsad', 'image/anggota/HVR2JzORo4JCyIpuz42vfcWSrFvWurirCsQQxrN3.png', '1', NULL, NULL),
	(7, '123123123', NULL, '2023-05-15', 'egif', 'Malang', '2023-05-15', 'laki-laki', '08123213213123', 'malang', 'image/anggota/onQzd5JpvXGcyo8oRkIoazK45hkam4dDcvTeXE39.png', '1', NULL, NULL),
	(8, '3213213123123', '12121212', '2023-05-15', 'david', 'Malang', '2023-05-15', 'laki-laki', '0812312321313', 'adasdas', NULL, '0', NULL, '2023-05-14 22:39:13');

-- Dumping structure for table koperasi.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table koperasi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(94, '2014_10_12_000000_create_users_table', 1),
	(95, '2014_10_12_100000_create_password_resets_table', 1),
	(96, '2019_08_19_000000_create_failed_jobs_table', 1),
	(97, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(98, '2023_04_17_024836_create_data_anggotas_table', 1),
	(99, '2023_04_29_004819_create_unit_usahas_table', 1),
	(100, '2023_04_29_023931_create_pinjamen_table', 1),
	(101, '2023_04_29_025755_create_anggsurans_table', 1),
	(102, '2023_05_07_021754_create_simpanans_table', 1),
	(103, '2023_05_07_022950_create_riwayat_transaksis_table', 1);

-- Dumping structure for table koperasi.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.password_resets: ~0 rows (approximately)

-- Dumping structure for table koperasi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table koperasi.pinjaman
CREATE TABLE IF NOT EXISTS `pinjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_nama_anggota` int NOT NULL,
  `jumlah_pinjman_diajukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pinjman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jangka_waktu` int NOT NULL,
  `tujuan_pinjaman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bunga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.pinjaman: ~4 rows (approximately)
INSERT INTO `pinjaman` (`id`, `id_nama_anggota`, `jumlah_pinjman_diajukan`, `jumlah_pinjman`, `jangka_waktu`, `tujuan_pinjaman`, `bunga`, `acc`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 7, 'Rp. 2.000.000', NULL, 3, 'coba', '1.5', '1', '1', 'egif', NULL, NULL, '2023-05-14 22:39:53'),
	(2, 1, 'Rp. 2.000.000', NULL, 1, 'sadasdasdasd', '1.5', '0', '1', 'egif', NULL, NULL, NULL),
	(3, 1, 'Rp. 2.000.000', NULL, 1, 'asa', '1.5', '0', '1', 'egif', NULL, NULL, NULL),
	(4, 6, 'Rp. 100.000', NULL, 1, 'asas', '1.5', '0', '1', 'egif', NULL, NULL, NULL);

-- Dumping structure for table koperasi.riwayat_transaksi
CREATE TABLE IF NOT EXISTS `riwayat_transaksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` int NOT NULL,
  `nominal` int NOT NULL,
  `jenis` enum('penarikan','setor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'setor',
  `jenis_simpanan` enum('pokok','wajib','sukarela') COLLATE utf8mb4_unicode_ci DEFAULT 'pokok',
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.riwayat_transaksi: ~8 rows (approximately)
INSERT INTO `riwayat_transaksi` (`id`, `id_anggota`, `nominal`, `jenis`, `jenis_simpanan`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(4, 7, 100000, 'setor', 'pokok', '1', 'egif', NULL, '2023-05-15 06:05:35', NULL),
	(5, 7, 100000, 'setor', 'pokok', '1', 'egif', NULL, '2023-05-15 06:05:36', NULL),
	(6, 7, 10000, 'penarikan', 'pokok', '1', 'egif', NULL, '2023-05-15 06:05:36', NULL),
	(7, 7, 100000, 'setor', 'sukarela', '1', 'egif', NULL, '2023-05-15 06:05:37', NULL),
	(8, 7, 10000, 'penarikan', 'sukarela', '1', 'egif', NULL, '2023-05-15 06:05:37', NULL),
	(9, 7, 10000, 'setor', 'wajib', '1', 'egif', NULL, '2023-05-15 06:05:38', NULL),
	(10, 7, 100000, 'setor', 'wajib', '1', 'egif', NULL, '2023-05-15 06:05:38', NULL),
	(11, 7, 10000, 'penarikan', 'wajib', '1', 'egif', NULL, '2023-05-15 06:05:39', NULL),
	(12, 7, 10000, 'penarikan', 'wajib', '1', 'egif', NULL, '2023-05-15 06:08:22', NULL);

-- Dumping structure for table koperasi.simpanan
CREATE TABLE IF NOT EXISTS `simpanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` int NOT NULL,
  `saldo` int NOT NULL,
  `jenis` enum('pokok','wajib','sukarela') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pokok',
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.simpanan: ~8 rows (approximately)
INSERT INTO `simpanan` (`id`, `id_anggota`, `saldo`, `jenis`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(6, 6, 0, 'pokok', '1', 'alvin', NULL, NULL, NULL),
	(7, 6, 0, 'wajib', '1', 'alvin', NULL, NULL, NULL),
	(8, 6, 0, 'sukarela', '1', 'alvin', NULL, NULL, NULL),
	(9, 7, 190000, 'pokok', '1', 'alvin', NULL, NULL, '2023-05-14 21:31:55'),
	(10, 7, 90000, 'wajib', '1', 'alvin', NULL, NULL, '2023-05-14 23:08:22'),
	(11, 7, 90000, 'sukarela', '1', 'alvin', NULL, NULL, '2023-05-14 21:33:32'),
	(12, 8, 0, 'pokok', '1', 'alvin', NULL, NULL, NULL),
	(13, 8, 0, 'wajib', '1', 'alvin', NULL, NULL, NULL),
	(14, 8, 0, 'sukarela', '1', 'alvin', NULL, NULL, NULL);

-- Dumping structure for table koperasi.unit_usaha
CREATE TABLE IF NOT EXISTS `unit_usaha` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pemesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` enum('jasa','barang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'jasa',
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.unit_usaha: ~0 rows (approximately)

-- Dumping structure for table koperasi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','pengawas','ketua','sekretaris','bendahara','anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `is_active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table koperasi.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'alvin', 'alvinade998@gmail.com', NULL, '$2y$10$L.PbtbNPrXOdKVyOOFy3kOXgfoQ1dTg1Mcb7otDqWyeamxjfNQbpO', 'superadmin', '1', 'alvin', NULL, NULL, NULL, NULL),
	(6, 'ades', 'alvinade@gmail.com', NULL, '$2y$10$55TkdTeNbKcj7CKt6gB9uOMnhltzSOXUnuhDRjtD6m7HFe.VkB16i', 'ketua', '1', 'alvin', NULL, NULL, NULL, NULL),
	(7, 'egif', 'egif@gmail.com', NULL, '$2y$10$3Zu/hNnk4ctVZaJjxR02r.AD2uO.32/NueS1p5ozA0z2ciqskM4cm', 'bendahara', '1', 'alvin', NULL, NULL, NULL, NULL),
	(8, 'david', 'david@gmail.com', NULL, '$2y$10$VRIJT6pjGGSOtkfePt9RZu/0bwXGBxeFygyuwfxB/QdeU96EBwW66', 'ketua', '0', 'alvin', 'alvin', NULL, NULL, '2023-05-14 22:39:13');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
