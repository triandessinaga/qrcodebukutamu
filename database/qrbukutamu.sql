-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 02:16 AM
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
-- Database: `qrbukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_id` int(11) DEFAULT NULL,
  `admin_nama` varchar(255) DEFAULT NULL,
  `admin_telepon` varchar(255) DEFAULT NULL,
  `admin_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_tujuan` varchar(255) DEFAULT NULL,
  `kategori_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `kategori_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_tujuan`, `kategori_created_at`, `kategori_updated_at`) VALUES
(2, 'Keuangan', '2023-06-15 21:59:39', '2023-06-15 21:59:39'),
(3, 'Administras', '2023-06-15 21:59:56', '2023-06-15 21:59:56'),
(4, 'Fungsional', '2023-06-15 22:02:21', '2023-06-15 22:02:21'),
(5, 'Ketua', '2023-06-15 22:03:38', '2023-06-15 22:03:38'),
(6, 'data yes', '2023-06-15 22:19:51', '2023-06-15 22:19:51'),
(7, 'test data', '2023-06-16 01:12:08', '2023-06-16 01:12:08'),
(8, 'tester', '2023-06-29 10:19:15', '2023-06-29 10:19:15'),
(10, 'Tes', '2023-06-29 10:50:52', '2023-06-29 10:50:52'),
(12, 'terere', '2023-06-29 11:01:42', '2023-06-29 11:01:42'),
(13, 'testerere', '2023-06-29 19:04:22', '2023-06-29 19:04:22'),
(14, 'Pengadaan', '2023-07-01 20:07:53', '2023-07-01 20:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `tamu_id` int(11) NOT NULL,
  `tamu_user_id` int(11) DEFAULT NULL,
  `tamu_kategori_id` int(11) DEFAULT NULL,
  `tamu_nama` varchar(255) DEFAULT NULL,
  `tamu_instansi` varchar(255) DEFAULT NULL,
  `tamu_telepon` varchar(255) DEFAULT NULL,
  `tamu_keperluan` varchar(255) DEFAULT NULL,
  `tamu_tujuan` varchar(255) DEFAULT NULL,
  `tamu_feedback` varchar(255) DEFAULT NULL,
  `tamu_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tamu_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`tamu_id`, `tamu_user_id`, `tamu_kategori_id`, `tamu_nama`, `tamu_instansi`, `tamu_telepon`, `tamu_keperluan`, `tamu_tujuan`, `tamu_feedback`, `tamu_created_at`, `tamu_updated_at`) VALUES
(12, 15, 2, 'Rere', 'Mahasiswa', '08535674678', 'Pengajuan proposal', 'Keuangan', 'yakin', '2023-06-30 16:49:57', '2023-07-06 05:24:51'),
(14, 15, 2, 'Roma', 'Mahasiswa', '085276545678', 'Tugas Akhir', 'Keuangan', 'teststest', '2023-06-30 17:15:32', '2023-07-06 05:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_username`, `user_password`, `user_role`, `user_created_at`, `user_updated_at`) VALUES
(4, 'roma@gmail.com', 'roma', '$2b$10$RmU.A/8a8d9PLLE7bR9nVO6.9LfBWk6aAB7JCHUoPpSkeoQBcKJFi', 'admin', '2023-06-15 00:06:16', '2023-06-15 00:06:16'),
(5, 'rara@gmail.com', 'rara', '$2b$10$hPP0juCN1Vtkzo/j0WERSe5PeBIU7hki416IAiYxwWXO.7clo2zpu', 'tamu', '2023-06-15 00:07:30', '2023-06-15 00:07:30'),
(6, 'romian@gmail.com', 'romian', '$2y$10$LfDaYkPcSxkY6HE.RLRdfOV5XnJpLZ9IfBz0mkrudBRSLXT7Gr56e', 'admin', '2023-06-27 23:31:22', '2023-06-27 23:31:22'),
(7, 'rita@gmail.com', 'rita', '$2y$10$DsMl.GdREfYWM7FEy8nA4Opxm9YNdMt6Kzz/4yrvUNPSiMIJUr5NW', 'tamu', '2023-06-28 19:27:40', '2023-06-28 19:27:40'),
(8, 'rini@gmail.com', 'rini', '$2y$10$dSEOeosUv5blaxvBjms4gOXYS7xfycpfFOO.mPDxA5plNh29nsIvi', 'admin', '2023-06-28 21:16:25', '2023-06-28 21:16:25'),
(9, 'rian@gmail.com', 'Rian', '$2y$10$3uln.5SAcDprXLpxWct4t.ZAoWynb24S72f5p0d5zN4M3A7EkNmmm', 'admin', '2023-06-28 21:25:32', '2023-06-28 21:25:32'),
(10, 'rere@gmail.com', 'rere', '$2y$10$8khEcWCLB92OjvYowchBPu/BzGNAD4i4.7pHLASJHcd79wYeg.c62', 'tamu', '2023-06-29 05:09:37', '2023-06-29 05:09:37'),
(11, 'roro@gmail.com', 'roro', '$2y$10$H9/PA1rYBrdrJhgltCoyuOD2K7C9ZiYD023A7x1.RLChQXBWwVM7a', 'tamu', '2023-06-29 09:16:52', '2023-06-29 09:16:52'),
(15, 'ctriandes@gmail.com', NULL, '$2y$10$f.538jCthBl3CviFoYEAqOzNII/CPzUGnQK9lShR8yDikpUKOT/Uy', 'tamu', '2023-06-29 10:03:51', '2023-06-29 10:03:51'),
(17, 'anto@gmail.com', 'anto', '$2y$10$1kJwytGdX0l3yfqEZnJf0eCEtMWR8tXYA3typPngHV4qTQGv4nHRa', 'tamu', '2023-06-30 18:16:56', '2023-06-30 18:16:56'),
(18, 'ctriandes12@gmail.com', NULL, '$2y$10$MW1KFl9TXe2NtkBzSJ3UkubH4QZWVYzC3CvWhTjy.wvIUFwyGOdba', 'tamu', '2023-07-05 23:59:23', '2023-07-05 23:59:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_user_id` (`admin_user_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`tamu_id`),
  ADD KEY `tamu_user_id` (`tamu_user_id`),
  ADD KEY `tamu_kategori_id` (`tamu_kategori_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `tamu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `tamu`
--
ALTER TABLE `tamu`
  ADD CONSTRAINT `tamu_ibfk_1` FOREIGN KEY (`tamu_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `tamu_ibfk_2` FOREIGN KEY (`tamu_kategori_id`) REFERENCES `kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
