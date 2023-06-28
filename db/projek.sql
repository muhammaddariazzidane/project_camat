-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2023 at 02:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int NOT NULL,
  `nomor_dokumen` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dokumen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_dokumen` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `nomor_dokumen`, `nama_dokumen`, `keterangan`, `file_dokumen`, `tgl_dibuat`) VALUES
(31, '0123', 'Akta Tanah A', 'Akta Tanah A', '82c7772ed97f1f36620a1300444413e5.pdf', '2023-06-25'),
(33, '8873', 'dokumen b', 'Ini dokumen B', 'c7a91a5f16761fed113914e7358b603c.pdf', '2023-06-27'),
(36, '0821', 'dokumen au', 'Ini dokumen Au', '89cb0607a27f975a92a23ec62079d327.pdf', '2023-06-27'),
(40, '834', 'dokumen C', 'Ini dokumen C', '87c501da0caa653a83c8c4bf7cde455b.pdf', '2023-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int NOT NULL,
  `dokumen_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `status` int NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `alasan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `printed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pengajuan`
--

CREATE TABLE `riwayat_pengajuan` (
  `pengajuan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `created_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `role_id`, `created_at`) VALUES
(6, 'admin', 'admin@gmail.com', '$2y$10$mXwEw6YhPe/dveniuA1nFel5IG2K.J7k.JyNEfBCeMcKDTLg9gLfC', 1, 1687241136),
(7, 'petugas', 'petugas@gmail.com', '$2y$10$vPRXqSS.u2JSOGSOdUI6/On7YchlbbhnXB36m86fV4YbhvEap.qpi', 2, 1687241172),
(8, 'user', 'user@gmail.com', '$2y$10$IYkQQgQEcd74m322RhQ9eOEOPjJe0DlrMqRvyWmy75JtMUcv7xUW2', 3, 1687241190),
(9, 'user dua', 'userdua@gmail.com', '$2y$10$hJnHESf7LVUD9.C6032O1und9NeSHJEbTVzdTLreSxYX4f.bW82lC', 3, 1687248907),
(10, 'sdjh', 'huy@gmail.com', '$2y$10$as6neyUQdbYH/wuOOTI15emiwYltFBWaaKEMoljAnFy.D2RAddvQi', 1, 1687697715);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Camat'),
(2, 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
