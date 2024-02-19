-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 08:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `gejalas`
--

CREATE TABLE `gejalas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_gejala` varchar(255) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejalas`
--

INSERT INTO `gejalas` (`id`, `kode_gejala`, `nama_gejala`, `created_at`, `updated_at`) VALUES
(1, 'G01', 'Terdapat miselium cendawan berwarna putih menyelimuti akar', NULL, NULL),
(2, 'G02', 'Akar tanaman membusuk', NULL, NULL),
(3, 'G03', 'Daun melipat/kaku', NULL, NULL),
(4, 'G04', 'Terjadi pembungaan dan pembuahan dini diluar musim', NULL, NULL),
(5, 'G05', 'Daun pucat dan menguning', NULL, NULL),
(6, 'G06', 'Daun gugur', NULL, NULL),
(7, 'G07', 'Tanaman tumbang dan mati', NULL, NULL),
(8, 'G08', 'Membentuk struktur bertahan (badan buah berwarna orange)', NULL, NULL),
(9, 'G09', 'Misellia cendawan berwarna putih diatas irisan sadap', NULL, NULL),
(10, 'G10', 'Miselium berubah warna menjadi abu dan hitam', NULL, NULL),
(11, 'G11', 'Luka sampai cambium', NULL, NULL),
(12, 'G12', 'Kulit pulihan berbenjol', NULL, NULL),
(13, 'G13', 'Kudis pada batang dan cabang tanaman', NULL, NULL),
(14, 'G14', 'Terbentuknya pustul (titik busuk)', NULL, NULL),
(15, 'G15', 'Retak kulit dan keluar lateks (bleeding)', NULL, NULL),
(16, 'G16', 'Mati pucuk (dieback)', NULL, NULL),
(17, 'G17', 'Tanaman patah', NULL, NULL),
(18, 'G18', 'Gejala sarang laba-laba', NULL, NULL),
(19, 'G19', 'Adanya lapisan berjamur yang berwarna merah muda', NULL, NULL),
(20, 'G20', 'Kulit membusuk', NULL, NULL),
(21, 'G21', 'Bagian kulit yang meneteskan lateks berwarna hitam', NULL, NULL),
(22, 'G22', 'Tajuk mati', NULL, NULL),
(23, 'G23', 'Pada daun muda terdapat bercak hitam', NULL, NULL),
(24, 'G24', 'Daun muda pucat dan lemas', NULL, NULL),
(25, 'G25', 'Bagian ujung daun muda mati atau menggulung', NULL, NULL),
(26, 'G26', 'Pada daun tua terdapat bercak hitam yang berkembang menyirip seperti tulang ikan', NULL, NULL),
(27, 'G27', 'Warna daun menguning karena adanya toksin', NULL, NULL),
(28, 'G28', 'Daun muda mengeriput dan menggulung', NULL, NULL),
(29, 'G29', 'Daun muda gugur', NULL, NULL),
(30, 'G30', 'Pada daun tua, bercak berwarna hitam dan nonjol', NULL, NULL),
(31, 'G31', 'Ujung daun tua mengeriput dan mati', NULL, NULL),
(32, 'G32', 'Daun tua gugur', NULL, NULL),
(33, 'G33', 'Miselia putih seperti tepung pada permukaan bawah daun', NULL, NULL),
(34, 'G34', 'Daun tua terdapat bekas tepung berupa bercak transparan', NULL, NULL),
(35, 'G35', 'Bercak bulat berwarna coklat', NULL, NULL),
(36, 'G36', 'Daun berubah warna menjadi kuning/oranye', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `kode_penyakit` varchar(5) NOT NULL,
  `persentase` double(8,2) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE `penggunas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `umur` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_diagnosis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyakits`
--

CREATE TABLE `penyakits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_penyakit` varchar(5) NOT NULL,
  `nama_penyakit` varchar(255) NOT NULL,
  `definisi` varchar(255) DEFAULT NULL,
  `solusi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakits`
--

INSERT INTO `penyakits` (`id`, `kode_penyakit`, `nama_penyakit`, `definisi`, `solusi`, `created_at`, `updated_at`) VALUES
(1, 'P01', 'Jamur Akar Putih (Rigidoporus microporus)', '', NULL, NULL, NULL),
(2, 'P02', 'Bidang Sadap Mouldy Rot (Ceratocystis fimbriata)', '', 'Pengolesa Fungisida : bahan aktif benomyl, hesakonazol, carbendazim, mankozeb, dsb.\r\nPisau sadap dicelup dalam larutan fungisida untuk mencegah penularan penyakit.', NULL, NULL),
(3, 'P03', 'Lapuk Batang dan Cabang (Botryodiplodia theobromae)', '', NULL, NULL, NULL),
(4, 'P04', 'Jamur Upas (Corticium salmonicolor)', '', NULL, NULL, NULL),
(5, 'P05', 'Gugur Daun Corynespora (Corynespora Cassiicola)', '', NULL, NULL, NULL),
(6, 'P06', 'Gugur Daun Colletotrichum (Colletotrichum spp.)', '', NULL, NULL, NULL),
(7, 'P07', 'Gugur Daun Oidium (Oidium heveae)', '', NULL, NULL, NULL),
(8, 'P08', 'Gugur Daun Pestalotiopsis (Pestalotiopsis sp.)', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gejala_id` bigint(20) UNSIGNED NOT NULL,
  `penyakit_id` bigint(20) UNSIGNED NOT NULL,
  `value` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `gejala_id`, `penyakit_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1.00, '2023-11-14 11:02:40', '2023-11-14 11:02:40'),
(2, 2, 1, 0.80, '2023-11-14 11:04:52', '2023-11-14 11:04:52'),
(3, 3, 1, 0.40, '2023-11-14 11:05:09', '2023-11-14 11:05:09'),
(4, 4, 1, 0.40, '2023-11-14 11:05:21', '2023-11-14 11:05:21'),
(5, 5, 1, 0.40, '2023-11-14 11:05:46', '2023-11-14 11:05:46'),
(6, 6, 1, 0.40, '2023-11-14 11:05:56', '2023-11-14 11:05:56'),
(7, 7, 1, 0.40, '2023-11-14 11:06:18', '2023-11-14 11:06:18'),
(8, 8, 1, 0.20, '2023-11-14 11:06:29', '2023-11-14 11:06:29'),
(9, 9, 2, 1.00, '2023-11-14 11:06:39', '2023-11-14 11:06:39'),
(10, 10, 2, 0.80, '2023-11-14 11:06:49', '2023-11-14 11:06:49'),
(11, 11, 2, 0.60, '2023-11-14 11:06:59', '2023-11-14 11:06:59'),
(12, 12, 2, 0.60, '2023-11-14 11:07:14', '2023-11-14 11:07:14'),
(13, 13, 3, 0.80, '2023-11-14 11:07:35', '2023-11-14 11:07:35'),
(14, 14, 3, 0.60, '2023-11-14 11:07:48', '2023-11-14 11:07:48'),
(15, 15, 3, 0.60, '2023-11-14 11:08:09', '2023-11-14 11:08:09'),
(16, 16, 3, 0.60, '2023-11-14 11:08:20', '2023-11-14 11:08:20'),
(17, 17, 3, 0.40, '2023-11-14 11:08:31', '2023-11-14 11:08:31'),
(18, 17, 4, 0.40, '2023-11-14 11:08:46', '2023-11-14 11:08:46'),
(19, 18, 4, 0.80, '2023-11-14 11:08:55', '2023-11-14 11:08:55'),
(20, 19, 4, 1.00, '2023-11-14 11:09:14', '2023-11-14 11:09:14'),
(21, 20, 4, 0.80, '2023-11-14 11:09:26', '2023-11-14 11:09:26'),
(22, 21, 4, 0.60, '2023-11-14 11:09:41', '2023-11-14 11:09:41'),
(23, 22, 4, 0.40, '2023-11-14 11:09:50', '2023-11-14 11:09:50'),
(24, 6, 5, 0.80, '2023-11-14 11:10:01', '2023-11-14 11:10:01'),
(25, 23, 5, 0.40, '2023-11-14 11:10:17', '2023-11-14 11:10:17'),
(26, 24, 5, 0.40, '2023-11-14 11:10:58', '2023-11-14 11:10:58'),
(27, 25, 5, 0.60, '2023-11-14 11:11:10', '2023-11-14 11:11:10'),
(28, 26, 5, 0.80, '2023-11-14 11:11:31', '2023-11-14 11:11:31'),
(29, 27, 5, 0.80, '2023-11-14 11:11:41', '2023-11-14 11:11:41'),
(30, 28, 6, 0.80, '2023-11-14 11:11:59', '2023-11-14 11:11:59'),
(31, 29, 6, 0.80, '2023-11-14 11:12:08', '2023-11-15 02:23:20'),
(32, 30, 6, 0.80, '2023-11-14 11:12:18', '2023-11-14 11:12:18'),
(33, 31, 6, 0.60, '2023-11-14 11:12:30', '2023-11-14 11:12:30'),
(34, 32, 6, 0.40, '2023-11-14 11:12:42', '2023-11-14 11:12:42'),
(35, 29, 7, 0.60, '2023-11-14 11:12:56', '2023-11-14 11:12:56'),
(36, 32, 7, 0.40, '2023-11-14 11:13:10', '2023-11-14 11:13:10'),
(37, 33, 7, 1.00, '2023-11-14 11:13:28', '2023-11-14 11:13:28'),
(38, 34, 7, 0.80, '2023-11-14 11:13:39', '2023-11-14 11:13:39'),
(39, 6, 8, 0.80, '2023-11-14 11:13:50', '2023-11-14 11:13:50'),
(40, 35, 8, 1.00, '2023-11-14 11:14:01', '2023-11-14 11:14:01'),
(41, 36, 8, 0.60, '2023-11-14 11:14:09', '2023-11-14 11:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '$2y$10$QljS1iec0LLg.5FUiE1gROtA0yuAYQkqQmpWy3eEJISGy9mP.e/7G', NULL, NULL),
(2, 'fadly', '$2y$10$83cD11nPS4rW9AT.1H/sQeyKc13PkJFRR.sHU8mvI5yRdtaPks0bS', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejalas`
--
ALTER TABLE `gejalas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggunas`
--
ALTER TABLE `penggunas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyakits`
--
ALTER TABLE `penyakits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gejalas`
--
ALTER TABLE `gejalas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penggunas`
--
ALTER TABLE `penggunas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyakits`
--
ALTER TABLE `penyakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
