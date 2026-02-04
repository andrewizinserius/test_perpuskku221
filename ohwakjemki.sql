-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2026 at 12:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohwakjemki`
--

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1szY9TPxknMXtIXyHGJopqeFKtjYDd5qAr108COM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTJjNzR1eFVoME9vYk00bGZNTGpZbnZGYU1QbG1kTlhrd0J1OTNraSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1738507314),
('u9pxyuZ9XqwN7poGzjRake6MrrJGpxIqwc9RtgDq', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajk3QUtYTVNVUlJXNnd2YnlKdkxpUW5sVkVVaXpyYkl1czlzM0RPTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hbmdnb3RhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1738506919),
('Vl89BMv3SHb4pBdTlD7kzYwBF3LP0EkuqLeC5mUR', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 OPR/125.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSTRsOFUwRzhqN3REZ0FPWEtMdFdXV045Mk9Fa3ZlY2gxUmVIU3BEUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZW5nYXJhbmcvY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1769404513),
('wZ7LXixxQ92fz2fSwugHYv5sxrB0RKyKul5a1iNh', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 OPR/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNUZyYkJOcFNoNEFZQ05LNGdaRklYcXJEU3FiRjFHOGY3YkdGWjBXRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZW5nYXJhbmcvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1769489610);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` bigint UNSIGNED NOT NULL,
  `id_jenis_anggota` bigint UNSIGNED NOT NULL,
  `kode_anggota` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_anggota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `masa_aktif` date NOT NULL,
  `fa` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `id_jenis_anggota`, `kode_anggota`, `nama_anggota`, `tempat`, `tgl_lahir`, `alamat`, `no_telp`, `email`, `tgl_daftar`, `masa_aktif`, `fa`, `keterangan`, `foto`, `username`, `password`) VALUES
(2, 3, 'ADM001', 'Admin Pustakawan', 'Jakarta', '1980-01-01', 'Jl. Kebon Jeruk No. 1', '081234567890', 'admin@library.com', '2025-01-03', '2030-01-03', 'Y', 'Akun pustakawan dengan hak akses penuh', '', 'admin', '$2y$12$NWebRG9kL5zWJTuXZL8.heuiI85PJShi/LnTyGpXXSr9c5L5JKxhC'),
(3, 2, '001', 'Insan Nur', 'Jakarta', '2025-01-06', 'Sidoarjo', '0895364788918', 'insangeming74@gmail.com', '2025-01-06', '2025-01-06', 'Y', 'Siswa Ganteng', NULL, 'sanzgeming', '$2y$12$TSmJ0KQy.sMDgbH.3Yyy7OQP2RXTvXsX9Z6BDPKeJp5kUN1WqDmby'),
(6, 1, '2', 'Insan Nur Rifqi', 'Sidoarjo', '2025-01-15', 'Bekasi', '0895364788918', 'insannurrifqi29@gmail.com', '2025-01-15', '2026-01-15', 'T', NULL, '', 'insangeming', '$2y$12$qweSFa7AaiiEEomZDuU.F.mUc9tKgO/3KUwbh3qmfh6ksWSiAzbxa'),
(7, 2, '003', 'Afrian', 'Sidoarjo', '2028-07-06', 'Sidoarjo', '0895372819', 'afrian@gmail.com', '2025-01-20', '2028-06-06', 'Y', 'Belum Ada', NULL, 'afrian', '$2y$12$snicVG4JDc/ER9CQ2KNbpujxlPb57Gs1dyQFdDgdfIcX0EFlwxsKO'),
(8, 1, '4', 'Rifqi Hidayat', 'Sidoarjo', '2007-01-01', 'Sidoarjo', '08953647843', 'insannurrifqi30@gmail.com', '2025-02-02', '2026-02-02', 'T', NULL, 'anggota_photos/TEPX8I3z2EIL0SSk8Dn9CsBSdSswTYob7GRVknoQ.jpg', 'insannur', '$2y$12$sXx0E5VYsZDmXOSsqo6JluD5mqxa69decQknusoUmnEuIN3m96uFi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ddc`
--

CREATE TABLE `tbl_ddc` (
  `id_ddc` bigint UNSIGNED NOT NULL,
  `id_rak` bigint UNSIGNED NOT NULL,
  `kode_ddc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ddc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_ddc`
--

INSERT INTO `tbl_ddc` (`id_ddc`, `id_rak`, `kode_ddc`, `ddc`, `keterangan`) VALUES
(1, 1, '813', 'Fiksi Indonesia', 'Ilmu Pengetahuan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_format`
--

CREATE TABLE `tbl_format` (
  `id_format` bigint UNSIGNED NOT NULL,
  `kode_format` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_format`
--

INSERT INTO `tbl_format` (`id_format`, `kode_format`, `format`, `keterangan`) VALUES
(1, 'FIS', 'Buku Fisik', 'Buku cetak yang tersedia di rak'),
(2, 'EBOOK', 'E-Book', 'Format digital, akses via app'),
(3, 'THESIS', 'Tesis/Disertasi', 'Karya ilmiah mahasiswa atau dosen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_anggota`
--

CREATE TABLE `tbl_jenis_anggota` (
  `id_jenis_anggota` bigint UNSIGNED NOT NULL,
  `kode_jenis_anggota` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_anggota` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_pinjam` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jenis_anggota`
--

INSERT INTO `tbl_jenis_anggota` (`id_jenis_anggota`, `kode_jenis_anggota`, `jenis_anggota`, `max_pinjam`, `keterangan`) VALUES
(1, '01', 'Siswa', '5', 'Batas pinjaman maksimal 5 buku'),
(2, '02', 'Guru', '10', 'Batas pinjaman maksimal 10 buku'),
(3, '03', 'Pustakawan', '100', 'Hak akses penuh'),
(5, '04', 'Pelajar', '10', 'GOBLOK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerbit`
--

CREATE TABLE `tbl_penerbit` (
  `id_penerbit` int NOT NULL,
  `kode_penerbit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerbit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_penerbit` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_penerbit`
--

INSERT INTO `tbl_penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `alamat_penerbit`, `no_telp`, `email`, `fax`, `website`, `kontak`) VALUES
(1, 'PN001', 'Penerbit Nusantara', 'Jl. Merdeka No. 45', '081234567890', 'info@nusantarabooks.com', '021123456', 'https://www.nusantarabooks.com', 'Andi Rahman'),
(2, 'PN002', 'Gramedia', 'Jl. Sudiman No. 10', '081987654321', 'contact@gramedia.com', '021987654', 'https://www.gramedia.com', 'Siti Lestari'),
(4, 'PN003', 'anjay', 'omah', '086527352', 'sedotwc@gmail.com', 'aseli', 'youtube.com', 'aadhwad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengarang`
--

CREATE TABLE `tbl_pengarang` (
  `id_pengarang` int NOT NULL,
  `kode_pengarang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gelar_depan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pengarang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_belakang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biografi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pengarang`
--

INSERT INTO `tbl_pengarang` (`id_pengarang`, `kode_pengarang`, `gelar_depan`, `nama_pengarang`, `kelamin`, `gelar_belakang`, `no_telp`, `email`, `website`, `biografi`, `keterangan`) VALUES
(1, 'PG001', 'Dr .', 'Bambang Susilo', 'L', 'M.Sc', '081234567890', 'bambang.susilo@gmail.com', 'https://www.bambangsusilo.com', 'Bambang Susilo adalah seorang penulis', 'Penulis Senior'),
(2, 'PG002', 'Prof', 'Siti Aminah', 'L', 'Ph.D', '081987654321', 'siti.aminah@yahoo.com', 'https://www.sitiaminah.id', 'Siti Aminah adalah seorang profesor literatur', 'Akademisi'),
(3, 'PG003', 'dr', 'PUJIONO', 'L', 'M.sc', '0987654321', 'sigma@gmail.com', 'https://www.sitiaminah.id', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa'),
(4, 'PG004', 'Prof', 'mirzah', 'P', 'Ph.D', '0987654321', 'adsadsada@gmail.com', 'https://www.youtube.com', 'adasdsadasdsadsadsa', 'dsadsadsadsadsad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perpustakaan`
--

CREATE TABLE `tbl_perpustakaan` (
  `id_perpustakaan` bigint UNSIGNED NOT NULL,
  `nama_perpustakaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pustakawan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pustaka`
--

CREATE TABLE `tbl_pustaka` (
  `id_pustaka` bigint UNSIGNED NOT NULL,
  `kode_pustaka` bigint UNSIGNED NOT NULL,
  `id_ddc` bigint UNSIGNED NOT NULL,
  `id_format` bigint UNSIGNED NOT NULL,
  `id_penerbit` bigint UNSIGNED NOT NULL,
  `id_pengarang` bigint UNSIGNED NOT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_pustaka` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_fisik` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstraksi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_buku` int NOT NULL,
  `kondisi_buku` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fp` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_pinjam` tinyint NOT NULL,
  `denda_terlambat` int NOT NULL,
  `denda_hilang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pustaka`
--

INSERT INTO `tbl_pustaka` (`id_pustaka`, `kode_pustaka`, `id_ddc`, `id_format`, `id_penerbit`, `id_pengarang`, `isbn`, `judul_pustaka`, `tahun_terbit`, `keyword`, `keterangan_fisik`, `keterangan_tambahan`, `abstraksi`, `gambar`, `harga_buku`, `kondisi_buku`, `fp`, `jml_pinjam`, `denda_terlambat`, `denda_hilang`) VALUES
(7, 1, 1, 1, 1, 1, '9783161484100', 'Don Quixote', '1605', 'sastra, spanyol', '500 halaman, hardcover', 'Buku ini berasal dari Spanyol', 'Don Quixote dianggap sebagai salah satu karya literatur dari Era Keemasan Spanyol dan kesusastraan Spanyol yang paling berpengaruh sepanjang masa. Sebagai salah satu novel pertama dalam kanon sastra Barat modern, novel ini sering muncul dalam daftar karya fiksi terbaik sepanjang masa, seperti Bokklubben World Library yang mengutip Don Quixote sebagai pilihan penulis untuk \"karya literatur terbaik yang pernah ditulis\".', 'pustaka/mGuiN9W4ie7q82phErZKUCBrJQM5w33f5WSYqwRS.png', 25000, 'Bagus', '1', 1, 20000, 30000),
(8, 2, 1, 2, 2, 1, '9786020', 'The Poppy War', '2019', 'sastra, spanyol, korea', '500 halaman, hardcover', 'Buku ini berasal dari Spanyol', 'Buku ini bagus banget', 'pustaka/JaAoSK8Evpa6PcgtFpXcHJNp4qiWVphiYrUGkCDA.jpg', 25000, 'Bagus, Baru', '1', 1, 5000, 30000),
(9, 3, 1, 1, 2, 2, '9789797809928', 'Fur Immer Dein Ian', '2022', 'sastra, spanyol', '500 halaman, hardcover', 'Buku ini berasal dari German', 'Apakah ada yang lebih menyebalkan dari menyembunyikan perasaan atas nama pertemanan? Saling berdekatan tetapi harus menjaga jarak aman. Semata-mata agar yang kita cintai tetap merasa nyaman.', 'pustaka/grxvrnKFHMOL7mWCKRWbof8kCmMxOhIfqsBFMwjm.jpg', 99000, 'Bagus, Baru', '1', 20, 5000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` bigint UNSIGNED NOT NULL,
  `kode_rak` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rak` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `kode_rak`, `rak`, `keterangan`) VALUES
(1, 'RAK-001', 'RAK A', 'Buku Sains dan Teknologi'),
(3, 'RAK-002', 'RAK B', 'Buku Fiksi dan Fabel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int NOT NULL,
  `id_pustaka` bigint UNSIGNED NOT NULL,
  `id_anggota` bigint UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `fp` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_pustaka`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `tgl_pengembalian`, `fp`, `keterangan`) VALUES
(1, 7, 7, '2026-01-26', '2026-02-02', NULL, '0', 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `tbl_anggota_kode_anggota_unique` (`kode_anggota`),
  ADD UNIQUE KEY `tbl_anggota_nama_anggota_unique` (`nama_anggota`),
  ADD UNIQUE KEY `tbl_anggota_username_unique` (`username`),
  ADD KEY `tbl_anggota_id_jenis_anggota_foreign` (`id_jenis_anggota`);

--
-- Indexes for table `tbl_ddc`
--
ALTER TABLE `tbl_ddc`
  ADD PRIMARY KEY (`id_ddc`),
  ADD UNIQUE KEY `tbl_ddc_kode_ddc_unique` (`kode_ddc`),
  ADD KEY `tbl_ddc_id_rak_foreign` (`id_rak`);

--
-- Indexes for table `tbl_format`
--
ALTER TABLE `tbl_format`
  ADD PRIMARY KEY (`id_format`),
  ADD UNIQUE KEY `tbl_format_kode_format_unique` (`kode_format`);

--
-- Indexes for table `tbl_jenis_anggota`
--
ALTER TABLE `tbl_jenis_anggota`
  ADD PRIMARY KEY (`id_jenis_anggota`),
  ADD UNIQUE KEY `tbl_jenis_anggota_kode_jenis_anggota_unique` (`kode_jenis_anggota`);

--
-- Indexes for table `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
  ADD PRIMARY KEY (`id_penerbit`),
  ADD UNIQUE KEY `tbl_penerbit_kode_penerbit_unique` (`kode_penerbit`),
  ADD UNIQUE KEY `tbl_penerbit_nama_penerbit_unique` (`nama_penerbit`);

--
-- Indexes for table `tbl_pengarang`
--
ALTER TABLE `tbl_pengarang`
  ADD PRIMARY KEY (`id_pengarang`),
  ADD UNIQUE KEY `tbl_pengarang_kode_pengarang_unique` (`kode_pengarang`),
  ADD UNIQUE KEY `tbl_pengarang_nama_pengarang_unique` (`nama_pengarang`);

--
-- Indexes for table `tbl_perpustakaan`
--
ALTER TABLE `tbl_perpustakaan`
  ADD PRIMARY KEY (`id_perpustakaan`),
  ADD UNIQUE KEY `tbl_perpustakaan_nama_perpustakaan_unique` (`nama_perpustakaan`),
  ADD UNIQUE KEY `tbl_perpustakaan_email_unique` (`email`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
  MODIFY `id_penerbit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pengarang`
--
ALTER TABLE `tbl_pengarang`
  MODIFY `id_pengarang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
