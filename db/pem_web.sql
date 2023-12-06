-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2023 at 05:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pem_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` text DEFAULT NULL,
  `status` int(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `idKategori`, `judul`, `isi`, `gambar`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 5, 'Girona sang penantang', 'Girona yang saat ini menduduki urutan 2 klasemen di La Liga', NULL, 1, '2023-12-06 02:51:50', '2023-12-06 03:47:30'),
(5, 5, 'City vs Totenham', 'Manchester City ditahan imbang oleh Totenham Hotspur dengan skor 3-3', 'file_1701833884.jpeg', 1, '2023-12-06 03:05:57', '2023-12-06 03:47:24'),
(7, 3, 'Contoh Berita', 'Contoh isi', 'file_1701833744.jpeg', 0, '2023-12-06 03:30:34', '2023-12-06 03:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `createdAt`, `updatedAt`) VALUES
(1, 'Politik', '2023-12-06 01:45:18', '2023-12-06 02:08:31'),
(3, 'Pendidikan', '2023-12-06 01:46:12', NULL),
(5, 'Olahraga', '2023-12-06 03:47:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `jenisKelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `foto` text NOT NULL DEFAULT 'default.png',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `jenisKelamin`, `status`, `foto`, `createdAt`, `updatedAt`) VALUES
(4, 'Erling Haland', 'haland', '$2y$10$1WxQ0iBDl2L893hh82caceS3zK54GcVncN.sIoJAKJA/z7cD71aDe', 'Laki-laki', 'Aktif', 'default.png', '2023-10-23 06:51:34', '2023-11-29 13:40:05'),
(5, 'Admin', 'admin', '$2y$10$53WM6Q0bIRAsyrB3toHS8uGnKvUUFfI02WmFMxo/dD.eG34zsoP0C', 'Laki-laki', 'Aktif', 'default.png', '2023-11-01 09:49:32', '2023-11-29 13:40:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
