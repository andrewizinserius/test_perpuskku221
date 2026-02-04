-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2025 pada 15.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemperpussekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_02_191737_create_library_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1szY9TPxknMXtIXyHGJopqeFKtjYDd5qAr108COM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTJjNzR1eFVoME9vYk00bGZNTGpZbnZGYU1QbG1kTlhrd0J1OTNraSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1738507314),
('u9pxyuZ9XqwN7poGzjRake6MrrJGpxIqwc9RtgDq', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajk3QUtYTVNVUlJXNnd2YnlKdkxpUW5sVkVVaXpyYkl1czlzM0RPTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hbmdnb3RhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1738506919);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` bigint(20) UNSIGNED NOT NULL,
  `id_jenis_anggota` bigint(20) UNSIGNED NOT NULL,
  `kode_anggota` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `masa_aktif` date NOT NULL,
  `fa` enum('Y','T') NOT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `foto` longtext DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `id_jenis_anggota`, `kode_anggota`, `nama_anggota`, `tempat`, `tgl_lahir`, `alamat`, `no_telp`, `email`, `tgl_daftar`, `masa_aktif`, `fa`, `keterangan`, `foto`, `username`, `password`) VALUES
(2, 3, 'ADM001', 'Admin Pustakawan', 'Jakarta', '1980-01-01', 'Jl. Kebon Jeruk No. 1', '081234567890', 'admin@library.com', '2025-01-03', '2030-01-03', 'Y', 'Akun pustakawan dengan hak akses penuh', '', 'admin', '$2y$12$NWebRG9kL5zWJTuXZL8.heuiI85PJShi/LnTyGpXXSr9c5L5JKxhC'),
(3, 2, '001', 'Insan Nur', 'Jakarta', '2025-01-06', 'Sidoarjo', '0895364788918', 'insangeming74@gmail.com', '2025-01-06', '2025-01-06', 'Y', 'Siswa Ganteng', NULL, 'sanzgeming', '$2y$12$TSmJ0KQy.sMDgbH.3Yyy7OQP2RXTvXsX9Z6BDPKeJp5kUN1WqDmby'),
(6, 1, '2', 'Insan Nur Rifqi', 'Sidoarjo', '2025-01-15', 'Bekasi', '0895364788918', 'insannurrifqi29@gmail.com', '2025-01-15', '2026-01-15', 'T', NULL, '', 'insangeming', '$2y$12$qweSFa7AaiiEEomZDuU.F.mUc9tKgO/3KUwbh3qmfh6ksWSiAzbxa'),
(7, 2, '003', 'Afrian', 'Sidoarjo', '2028-07-06', 'Sidoarjo', '0895372819', 'afrian@gmail.com', '2025-01-20', '2028-06-06', 'Y', 'Belum Ada', NULL, 'afrian', '$2y$12$snicVG4JDc/ER9CQ2KNbpujxlPb57Gs1dyQFdDgdfIcX0EFlwxsKO'),
(8, 1, '4', 'Rifqi Hidayat', 'Sidoarjo', '2007-01-01', 'Sidoarjo', '08953647843', 'insannurrifqi30@gmail.com', '2025-02-02', '2026-02-02', 'T', NULL, 'anggota_photos/TEPX8I3z2EIL0SSk8Dn9CsBSdSswTYob7GRVknoQ.jpg', 'insannur', '$2y$12$sXx0E5VYsZDmXOSsqo6JluD5mqxa69decQknusoUmnEuIN3m96uFi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ddc`
--

CREATE TABLE `tbl_ddc` (
  `id_ddc` bigint(20) UNSIGNED NOT NULL,
  `id_rak` bigint(20) UNSIGNED NOT NULL,
  `kode_ddc` varchar(10) NOT NULL,
  `ddc` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_ddc`
--

INSERT INTO `tbl_ddc` (`id_ddc`, `id_rak`, `kode_ddc`, `ddc`, `keterangan`) VALUES
(1, 1, '813', 'Fiksi Indonesia', 'Ilmu Pengetahuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_format`
--

CREATE TABLE `tbl_format` (
  `id_format` bigint(20) UNSIGNED NOT NULL,
  `kode_format` varchar(10) NOT NULL,
  `format` varchar(25) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_format`
--

INSERT INTO `tbl_format` (`id_format`, `kode_format`, `format`, `keterangan`) VALUES
(1, 'FIS', 'Buku Fisik', 'Buku cetak yang tersedia di rak'),
(2, 'EBOOK', 'E-Book', 'Format digital, akses via app'),
(3, 'THESIS', 'Tesis/Disertasi', 'Karya ilmiah mahasiswa atau dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_anggota`
--

CREATE TABLE `tbl_jenis_anggota` (
  `id_jenis_anggota` bigint(20) UNSIGNED NOT NULL,
  `kode_jenis_anggota` varchar(2) NOT NULL,
  `jenis_anggota` varchar(15) NOT NULL,
  `max_pinjam` varchar(5) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_jenis_anggota`
--

INSERT INTO `tbl_jenis_anggota` (`id_jenis_anggota`, `kode_jenis_anggota`, `jenis_anggota`, `max_pinjam`, `keterangan`) VALUES
(1, '01', 'Siswa', '5', 'Batas pinjaman maksimal 5 buku'),
(2, '02', 'Guru', '10', 'Batas pinjaman maksimal 10 buku'),
(3, '03', 'Pustakawan', '100', 'Hak akses penuh'),
(5, '04', 'Pelajar', '10', 'GOBLOK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penerbit`
--

CREATE TABLE `tbl_penerbit` (
  `id_penerbit` bigint(20) UNSIGNED NOT NULL,
  `kode_penerbit` varchar(10) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `alamat_penerbit` varchar(150) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `website` varchar(50) NOT NULL,
  `kontak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_penerbit`
--

INSERT INTO `tbl_penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `alamat_penerbit`, `no_telp`, `email`, `fax`, `website`, `kontak`) VALUES
(1, 'PN001', 'Penerbit Nusantara', 'Jl. Merdeka No. 45', '081234567890', 'info@nusantarabooks.com', '021123456', 'https://www.nusantarabooks.com', 'Andi Rahman'),
(2, 'PN002', 'Gramedia', 'Jl. Sudiman No. 10', '081987654321', 'contact@gramedia.com', '021987654', 'https://www.gramedia.com', 'Siti Lestari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengarang`
--

CREATE TABLE `tbl_pengarang` (
  `id_pengarang` bigint(20) UNSIGNED NOT NULL,
  `kode_pengarang` varchar(10) NOT NULL,
  `gelar_depan` varchar(10) DEFAULT NULL,
  `nama_pengarang` varchar(50) NOT NULL,
  `gelar_belakang` varchar(10) DEFAULT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `website` varchar(50) NOT NULL,
  `biografi` longtext NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_pengarang`
--

INSERT INTO `tbl_pengarang` (`id_pengarang`, `kode_pengarang`, `gelar_depan`, `nama_pengarang`, `gelar_belakang`, `no_telp`, `email`, `website`, `biografi`, `keterangan`) VALUES
(1, 'PG001', 'Dr .', 'Bambang Susilo', 'M.Sc', '081234567890', 'bambang.susilo@gmail.com', 'https://www.bambangsusilo.com', 'Bambang Susilo adalah seorang penulis', 'Penulis Senior'),
(2, 'PG002', 'Prof', 'Siti Aminah', 'Ph.D', '081987654321', 'siti.aminah@yahoo.com', 'https://www.sitiaminah.id', 'Siti Aminah adalah seorang profesor literatur', 'Akademisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perpustakaan`
--

CREATE TABLE `tbl_perpustakaan` (
  `id_perpustakaan` bigint(20) UNSIGNED NOT NULL,
  `nama_perpustakaan` varchar(100) NOT NULL,
  `nama_pustakawan` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pustaka`
--

CREATE TABLE `tbl_pustaka` (
  `id_pustaka` bigint(20) UNSIGNED NOT NULL,
  `kode_pustaka` bigint(20) UNSIGNED NOT NULL,
  `id_ddc` bigint(20) UNSIGNED NOT NULL,
  `id_format` bigint(20) UNSIGNED NOT NULL,
  `id_penerbit` bigint(20) UNSIGNED NOT NULL,
  `id_pengarang` bigint(20) UNSIGNED NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `judul_pustaka` varchar(100) NOT NULL,
  `tahun_terbit` varchar(5) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `keterangan_fisik` varchar(100) NOT NULL,
  `keterangan_tambahan` varchar(100) NOT NULL,
  `abstraksi` longtext NOT NULL,
  `gambar` longtext NOT NULL,
  `harga_buku` int(11) NOT NULL,
  `kondisi_buku` varchar(15) NOT NULL,
  `fp` enum('0','1') NOT NULL,
  `jml_pinjam` tinyint(4) NOT NULL,
  `denda_terlambat` int(11) NOT NULL,
  `denda_hilang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_pustaka`
--

INSERT INTO `tbl_pustaka` (`id_pustaka`, `kode_pustaka`, `id_ddc`, `id_format`, `id_penerbit`, `id_pengarang`, `isbn`, `judul_pustaka`, `tahun_terbit`, `keyword`, `keterangan_fisik`, `keterangan_tambahan`, `abstraksi`, `gambar`, `harga_buku`, `kondisi_buku`, `fp`, `jml_pinjam`, `denda_terlambat`, `denda_hilang`) VALUES
(7, 1, 1, 1, 1, 1, '9783161484100', 'Don Quixote', '1605', 'sastra, spanyol', '500 halaman, hardcover', 'Buku ini berasal dari Spanyol', 'Don Quixote dianggap sebagai salah satu karya literatur dari Era Keemasan Spanyol dan kesusastraan Spanyol yang paling berpengaruh sepanjang masa. Sebagai salah satu novel pertama dalam kanon sastra Barat modern, novel ini sering muncul dalam daftar karya fiksi terbaik sepanjang masa, seperti Bokklubben World Library yang mengutip Don Quixote sebagai pilihan penulis untuk \"karya literatur terbaik yang pernah ditulis\".', 'pustaka/mGuiN9W4ie7q82phErZKUCBrJQM5w33f5WSYqwRS.png', 25000, 'Bagus', '1', 1, 20000, 30000),
(8, 2, 1, 2, 2, 1, '9786020', 'The Poppy War', '2019', 'sastra, spanyol, korea', '500 halaman, hardcover', 'Buku ini berasal dari Spanyol', 'Buku ini bagus banget', 'pustaka/JaAoSK8Evpa6PcgtFpXcHJNp4qiWVphiYrUGkCDA.jpg', 25000, 'Bagus, Baru', '1', 1, 5000, 30000),
(9, 3, 1, 1, 2, 2, '9789797809928', 'Fur Immer Dein Ian', '2022', 'sastra, spanyol', '500 halaman, hardcover', 'Buku ini berasal dari German', 'Apakah ada yang lebih menyebalkan dari menyembunyikan perasaan atas nama pertemanan? Saling berdekatan tetapi harus menjaga jarak aman. Semata-mata agar yang kita cintai tetap merasa nyaman.', 'pustaka/grxvrnKFHMOL7mWCKRWbof8kCmMxOhIfqsBFMwjm.jpg', 99000, 'Bagus, Baru', '1', 20, 5000, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` bigint(20) UNSIGNED NOT NULL,
  `kode_rak` varchar(10) NOT NULL,
  `rak` varchar(25) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `kode_rak`, `rak`, `keterangan`) VALUES
(1, 'RAK-001', 'RAK A', 'Buku Sains dan Teknologi'),
(3, 'RAK-002', 'RAK B', 'Buku Fiksi dan Fabel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_pustaka` bigint(20) UNSIGNED NOT NULL,
  `id_anggota` bigint(20) UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `fp` enum('0','1') NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `tbl_anggota_kode_anggota_unique` (`kode_anggota`),
  ADD UNIQUE KEY `tbl_anggota_nama_anggota_unique` (`nama_anggota`),
  ADD UNIQUE KEY `tbl_anggota_username_unique` (`username`),
  ADD KEY `tbl_anggota_id_jenis_anggota_foreign` (`id_jenis_anggota`);

--
-- Indeks untuk tabel `tbl_ddc`
--
ALTER TABLE `tbl_ddc`
  ADD PRIMARY KEY (`id_ddc`),
  ADD UNIQUE KEY `tbl_ddc_kode_ddc_unique` (`kode_ddc`),
  ADD KEY `tbl_ddc_id_rak_foreign` (`id_rak`);

--
-- Indeks untuk tabel `tbl_format`
--
ALTER TABLE `tbl_format`
  ADD PRIMARY KEY (`id_format`),
  ADD UNIQUE KEY `tbl_format_kode_format_unique` (`kode_format`);

--
-- Indeks untuk tabel `tbl_jenis_anggota`
--
ALTER TABLE `tbl_jenis_anggota`
  ADD PRIMARY KEY (`id_jenis_anggota`),
  ADD UNIQUE KEY `tbl_jenis_anggota_kode_jenis_anggota_unique` (`kode_jenis_anggota`);

--
-- Indeks untuk tabel `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
  ADD PRIMARY KEY (`id_penerbit`),
  ADD UNIQUE KEY `tbl_penerbit_kode_penerbit_unique` (`kode_penerbit`),
  ADD UNIQUE KEY `tbl_penerbit_nama_penerbit_unique` (`nama_penerbit`);

--
-- Indeks untuk tabel `tbl_pengarang`
--
ALTER TABLE `tbl_pengarang`
  ADD PRIMARY KEY (`id_pengarang`),
  ADD UNIQUE KEY `tbl_pengarang_kode_pengarang_unique` (`kode_pengarang`),
  ADD UNIQUE KEY `tbl_pengarang_nama_pengarang_unique` (`nama_pengarang`);

--
-- Indeks untuk tabel `tbl_perpustakaan`
--
ALTER TABLE `tbl_perpustakaan`
  ADD PRIMARY KEY (`id_perpustakaan`),
  ADD UNIQUE KEY `tbl_perpustakaan_nama_perpustakaan_unique` (`nama_perpustakaan`),
  ADD UNIQUE KEY `tbl_perpustakaan_email_unique` (`email`);

--
-- Indeks untuk tabel `tbl_pustaka`
--
ALTER TABLE `tbl_pustaka`
  ADD PRIMARY KEY (`id_pustaka`),
  ADD KEY `tbl_pustaka_id_ddc_foreign` (`id_ddc`),
  ADD KEY `tbl_pustaka_id_format_foreign` (`id_format`),
  ADD KEY `tbl_pustaka_id_penerbit_foreign` (`id_penerbit`),
  ADD KEY `tbl_pustaka_id_pengarang_foreign` (`id_pengarang`);

--
-- Indeks untuk tabel `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id_rak`),
  ADD UNIQUE KEY `tbl_rak_kode_rak_unique` (`kode_rak`),
  ADD UNIQUE KEY `tbl_rak_rak_unique` (`rak`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `tbl_transaksi_id_pustaka_foreign` (`id_pustaka`),
  ADD KEY `tbl_transaksi_id_anggota_foreign` (`id_anggota`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `id_anggota` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_ddc`
--
ALTER TABLE `tbl_ddc`
  MODIFY `id_ddc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_format`
--
ALTER TABLE `tbl_format`
  MODIFY `id_format` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_anggota`
--
ALTER TABLE `tbl_jenis_anggota`
  MODIFY `id_jenis_anggota` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_penerbit`
--
ALTER TABLE `tbl_penerbit`
  MODIFY `id_penerbit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengarang`
--
ALTER TABLE `tbl_pengarang`
  MODIFY `id_pengarang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_perpustakaan`
--
ALTER TABLE `tbl_perpustakaan`
  MODIFY `id_perpustakaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pustaka`
--
ALTER TABLE `tbl_pustaka`
  MODIFY `id_pustaka` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id_rak` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD CONSTRAINT `tbl_anggota_id_jenis_anggota_foreign` FOREIGN KEY (`id_jenis_anggota`) REFERENCES `tbl_jenis_anggota` (`id_jenis_anggota`);

--
-- Ketidakleluasaan untuk tabel `tbl_ddc`
--
ALTER TABLE `tbl_ddc`
  ADD CONSTRAINT `tbl_ddc_id_rak_foreign` FOREIGN KEY (`id_rak`) REFERENCES `tbl_rak` (`id_rak`);

--
-- Ketidakleluasaan untuk tabel `tbl_pustaka`
--
ALTER TABLE `tbl_pustaka`
  ADD CONSTRAINT `tbl_pustaka_id_ddc_foreign` FOREIGN KEY (`id_ddc`) REFERENCES `tbl_ddc` (`id_ddc`),
  ADD CONSTRAINT `tbl_pustaka_id_format_foreign` FOREIGN KEY (`id_format`) REFERENCES `tbl_format` (`id_format`),
  ADD CONSTRAINT `tbl_pustaka_id_penerbit_foreign` FOREIGN KEY (`id_penerbit`) REFERENCES `tbl_penerbit` (`id_penerbit`),
  ADD CONSTRAINT `tbl_pustaka_id_pengarang_foreign` FOREIGN KEY (`id_pengarang`) REFERENCES `tbl_pengarang` (`id_pengarang`);

--
-- Ketidakleluasaan untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_id_anggota_foreign` FOREIGN KEY (`id_anggota`) REFERENCES `tbl_anggota` (`id_anggota`),
  ADD CONSTRAINT `tbl_transaksi_id_pustaka_foreign` FOREIGN KEY (`id_pustaka`) REFERENCES `tbl_pustaka` (`id_pustaka`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
