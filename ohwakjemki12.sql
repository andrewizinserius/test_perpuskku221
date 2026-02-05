-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 05, 2026 at 01:18 AM
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
-- Database: `ohwakjemki12`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('kpyEPDyREQLGkgfVKOjJicChSyCfzEciQwsRkwg8', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHBhQVRMOEZ5QzJ1TDJtd2ZzZGdUcVVJZWtRZ2p3VzBCT0dldW52eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1770252432),
('WKuo8YU9DG9ubkkaFgr6oF2OsxPY90nUOSpPuiwB', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidm5rNnpEcHI0RWpsOGYxTFFqMmhxQWJOdDBiMEFwZlZ3b0hUNEpFSiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3B1c3Rha2EiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3B1c3Rha2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1770254259);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` bigint UNSIGNED NOT NULL,
  `id_jenis_anggota` bigint UNSIGNED NOT NULL,
  `kode_anggota` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_anggota` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `masa_aktif` date NOT NULL,
  `fa` enum('Y','T') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `id_jenis_anggota`, `kode_anggota`, `nama_anggota`, `tempat`, `tgl_lahir`, `alamat`, `no_telp`, `email`, `tgl_daftar`, `masa_aktif`, `fa`, `keterangan`, `foto`, `username`, `password`) VALUES
(1, 3, 'ADM001', 'Admin Pustakawan', 'Jakarta', '1980-01-01', 'Jl. Kebon Jeruk No. 1', '081234567890', 'admin@library.com', '2025-01-03', '2030-01-03', 'Y', 'Akun pustakawan dengan hak akses penuh', '', 'admin', '$2y$12$NWebRG9kL5zWJTuXZL8.heuiI85PJShi/LnTyGpXXSr9c5L5JKxhC'),
;
-- --------------------------------------------------------

--
-- Table structure for table `tbl_ddc`
--

CREATE TABLE `tbl_ddc` (
  `id_ddc` bigint UNSIGNED NOT NULL,
  `id_rak` bigint UNSIGNED NOT NULL,
  `kode_ddc` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ddc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
  `kode_format` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
  `kode_jenis_anggota` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_anggota` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_pinjam` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
  `kode_penerbit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerbit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_penerbit` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
  `kode_pengarang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gelar_depan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pengarang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_belakang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biografi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pengarang`
--

INSERT INTO `tbl_pengarang` (`id_pengarang`, `kode_pengarang`, `gelar_depan`, `nama_pengarang`, `kelamin`, `gelar_belakang`, `no_telp`, `email`, `website`, `biografi`, `keterangan`) VALUES
(1, 'PG001', 'Dr .', 'Bambang Susilo', 'L', 'M.Sc', '081234567890', 'bambang.susilo@gmail.com', 'https://www.bambangsusilo.com', 'Bambang Susilo adalah seorang penulis', 'Penulis Senior'),
(2, 'PG002', 'Prof', 'Siti Aminah', 'L', 'Ph.D', '081987654321', 'siti.aminah@yahoo.com', 'https://www.sitiaminah.id', 'Siti Aminah adalah seorang profesor literatur', 'Akademisi'),
(3, 'PG003', 'dr', 'PUJIONO', 'P', 'M.sc', '0987654321', 'sigma@gmail.com', 'https://www.sitiaminah.id', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa'),
(4, 'PG004', 'Prof', 'mirzah', 'P', 'Ph.D', '0987654321', 'adsadsada@gmail.com', 'https://www.youtube.com', 'adasdsadasdsadsadsa', 'dsadsadsadsadsad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perpustakaan`
--

CREATE TABLE `tbl_perpustakaan` (
  `id_perpustakaan` bigint UNSIGNED NOT NULL,
  `nama_perpustakaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pustakawan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pustaka`
--

CREATE TABLE `tbl_pustaka` (
  `id_pustaka` int NOT NULL,
  `kode_pustaka` bigint UNSIGNED NOT NULL,
  `id_ddc` bigint UNSIGNED NOT NULL,
  `id_format` bigint UNSIGNED NOT NULL,
  `id_penerbit` bigint UNSIGNED NOT NULL,
  `id_pengarang` bigint UNSIGNED NOT NULL,
  `isbn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_pustaka` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_fisik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstraksi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_buku` int NOT NULL,
  `kondisi_buku` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_book` int NOT NULL,
  `fp` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_pinjam` int NOT NULL DEFAULT '0',
  `denda_terlambat` int NOT NULL,
  `denda_hilang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pustaka`
--

INSERT INTO `tbl_pustaka` (`id_pustaka`, `kode_pustaka`, `id_ddc`, `id_format`, `id_penerbit`, `id_pengarang`, `isbn`, `judul_pustaka`, `tahun_terbit`, `keyword`, `keterangan_fisik`, `keterangan_tambahan`, `abstraksi`, `gambar`, `harga_buku`, `kondisi_buku`, `jml_book`, `fp`, `jml_pinjam`, `denda_terlambat`, `denda_hilang`) VALUES
(7, 1, 1, 1, 1, 1, '9783161484100', 'Don Quixote', '1605', 'sastra, spanyol', '500 halaman, hardcover', 'Buku ini berasal dari Spanyol', 'Don Quixote dianggap sebagai salah satu karya literatur dari Era Keemasan Spanyol dan kesusastraan Spanyol yang paling berpengaruh sepanjang masa. Sebagai salah satu novel pertama dalam kanon sastra Barat modern, novel ini sering muncul dalam daftar karya fiksi terbaik sepanjang masa, seperti Bokklubben World Library yang mengutip Don Quixote sebagai pilihan penulis untuk \"karya literatur terbaik yang pernah ditulis\".', 'pustaka/mGuiN9W4ie7q82phErZKUCBrJQM5w33f5WSYqwRS.png', 25000, 'Bagus', 51, '1', 1, 20000, 30000),
(8, 2, 1, 2, 2, 1, '9786020', 'The Poppy War', '2019', 'sastra, spanyol, korea', '500 halaman, hardcover', 'Buku ini berasal dari Spanyol', 'Buku ini bagus banget', 'pustaka/JaAoSK8Evpa6PcgtFpXcHJNp4qiWVphiYrUGkCDA.jpg', 25000, 'Bagus, Baru', 49, '1', 1, 5000, 30000),
(9, 3, 1, 1, 2, 2, '9789797809928', 'Fur Immer Dein Ian', '2022', 'sastra, spanyol', '500 halaman, hardcover', 'Buku ini berasal dari German', 'Apakah ada yang lebih menyebalkan dari menyembunyikan perasaan atas nama pertemanan? Saling berdekatan tetapi harus menjaga jarak aman. Semata-mata agar yang kita cintai tetap merasa nyaman.', 'pustaka/grxvrnKFHMOL7mWCKRWbof8kCmMxOhIfqsBFMwjm.jpg', 99000, 'Bagus, Baru', 53, '1', 20, 5000, 100000),
(10, 12313, 1, 1, 1, 3, '13123', 'sdadsasda', '1212', 'adadada', 'ada', 'adada', 'adasda', 'pustaka/0U3uoMKrB7OBrbEl1ZuEgtrKHBwiv6yRK8VLoe1t.jpg', 12345, 'elek', 111, '1', 0, 1100, 6000000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` bigint UNSIGNED NOT NULL,
  `kode_rak` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rak` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
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
  `fp` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda_telat` int DEFAULT '0',
  `denda_hilang` int DEFAULT '0',
  `total_denda` int DEFAULT '0',
  `denda_dibayar` tinyint(1) DEFAULT '0',
  `tgl_bayar_denda` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_pustaka`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`, `tgl_pengembalian`, `fp`, `keterangan`, `denda_telat`, `denda_hilang`, `total_denda`, `denda_dibayar`, `tgl_bayar_denda`) VALUES
(1, 9, 2, '2026-02-01', '2026-02-05', '2026-02-11', '1', 'ada', 0, 0, 0, 1, NULL);

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

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_laporan_denda`
-- (See below for the actual view)
--
CREATE TABLE `view_laporan_denda` (
`id_transaksi` int
,`tgl_pinjam` date
,`tgl_kembali` date
,`tgl_pengembalian` date
,`status` varchar(8)
,`nama_anggota` varchar(100)
,`judul_pustaka` varchar(100)
,`denda_telat` int
,`denda_hilang` int
,`total_denda` int
,`status_denda` varchar(15)
,`tgl_bayar_denda` date
,`hari_terlambat` int
);

-- --------------------------------------------------------

--
-- Structure for view `view_laporan_denda`
--
DROP TABLE IF EXISTS `view_laporan_denda`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_laporan_denda`  AS SELECT `t`.`id_transaksi` AS `id_transaksi`, `t`.`tgl_pinjam` AS `tgl_pinjam`, `t`.`tgl_kembali` AS `tgl_kembali`, `t`.`tgl_pengembalian` AS `tgl_pengembalian`, (case when (`t`.`fp` = 0) then 'Dipinjam' when (`t`.`fp` = 1) then 'Selesai' when (`t`.`fp` = 2) then 'Hilang' end) AS `status`, `a`.`nama_anggota` AS `nama_anggota`, `p`.`judul_pustaka` AS `judul_pustaka`, `t`.`denda_telat` AS `denda_telat`, `t`.`denda_hilang` AS `denda_hilang`, `t`.`total_denda` AS `total_denda`, (case when (`t`.`denda_dibayar` = 1) then 'Lunas' when (`t`.`total_denda` > 0) then 'Belum Dibayar' else 'Tidak Ada Denda' end) AS `status_denda`, `t`.`tgl_bayar_denda` AS `tgl_bayar_denda`, (case when (`t`.`tgl_pengembalian` > `t`.`tgl_kembali`) then (to_days(`t`.`tgl_pengembalian`) - to_days(`t`.`tgl_kembali`)) else 0 end) AS `hari_terlambat` FROM ((`tbl_transaksi` `t` join `tbl_anggota` `a` on((`t`.`id_anggota` = `a`.`id_anggota`))) join `tbl_pustaka` `p` on((`t`.`id_pustaka` = `p`.`id_pustaka`))) WHERE ((`t`.`total_denda` > 0) OR (`t`.`denda_dibayar` = 1))  ;

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
-- Indexes for table `tbl_pustaka`
--
ALTER TABLE `tbl_pustaka`
  ADD PRIMARY KEY (`id_pustaka`);

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
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `id_anggota` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
