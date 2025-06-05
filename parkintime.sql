-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2025 at 01:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkintime`
--

-- --------------------------------------------------------

--
-- Table structure for table `lahan_parkir`
--

CREATE TABLE `lahan_parkir` (
  `id` int NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis` enum('Indoor','Outdoor') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tarif_per_jam` decimal(10,2) NOT NULL,
  `status_lahan` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lahan_parkir`
--

INSERT INTO `lahan_parkir` (`id`, `nama_lokasi`, `alamat`, `jenis`, `foto`, `tarif_per_jam`, `status_lahan`, `created_at`, `updated_at`) VALUES
(1, 'Parkiran Polibatam', 'Jl. Ahmad Yani, Batam Kota, Kota Batam, Kepulauan Riau, Indonesia.', 'Outdoor', 'Polibatam.png', 2000.00, 'Aktif', '2025-05-03 19:04:24', '2025-05-06 19:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `slot_parkir`
--

CREATE TABLE `slot_parkir` (
  `id` int NOT NULL,
  `id_lahan` int NOT NULL,
  `kode_slot` varchar(10) NOT NULL,
  `status` enum('Available','Occupied','Booked') NOT NULL DEFAULT 'Available',
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slot_parkir`
--

INSERT INTO `slot_parkir` (`id`, `id_lahan`, `kode_slot`, `status`, `waktu`) VALUES
(35, 1, 'A0002', 'Available', '2025-05-03 20:24:38'),
(36, 1, 'A0003', 'Available', '2025-05-03 20:25:04'),
(37, 1, 'A0001', 'Available', '2025-05-03 20:30:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lahan_parkir`
--
ALTER TABLE `lahan_parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slot_parkir`
--
ALTER TABLE `slot_parkir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_slot` (`kode_slot`),
  ADD KEY `fk_slot_lahan` (`id_lahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lahan_parkir`
--
ALTER TABLE `lahan_parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slot_parkir`
--
ALTER TABLE `slot_parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `slot_parkir`
--
ALTER TABLE `slot_parkir`
  ADD CONSTRAINT `fk_slot_lahan` FOREIGN KEY (`id_lahan`) REFERENCES `lahan_parkir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
