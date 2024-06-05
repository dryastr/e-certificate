-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 10:42 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecertifikat`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_sertifikat` varchar(100) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `ttd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `no_sertifikat`, `deskripsi`, `tanggal`, `ttd`) VALUES
(6, 'VICKY VICTORIA SALRIUS', 'K001', 'Atas Partisiipasi 15 Tahun bekerja sebagai Karyawan Teladan di PT Basa Inti Persada', '2024-04-17', 'SAPARI'),
(8, 'Indra Bayu', '1234', 'Atas Partisipasi 15 Tahun bekerja sebagai Karyawan Teladan di PT Basa Inti Persada', '2024-04-17', 'SAPARI'),
(9, 'Elwin', '111', 'Atas Partisipasi 15 Tahun bekerja sebagai Karyawan Teladan di PT Basa Inti Persada', '2024-04-17', 'SAPARI'),
(10, 'Hanifah Syafyan', '123456', 'Atas Partisipasi 15 Tahun bekerja sebagai Karyawan Teladan di PT Basa Inti Persada', '2024-04-17', 'SAPARI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
