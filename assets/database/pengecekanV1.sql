-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2019 at 10:50 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengecekan`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist_ac`
--

CREATE TABLE `checklist_ac` (
  `id_checklist_ac` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `sts_ac_pagi` varchar(10) NOT NULL,
  `temp_pagi` int(5) NOT NULL,
  `pic_pagi` varchar(25) NOT NULL,
  `keterangan_pagi` text NOT NULL,
  `sts_ac_malam` varchar(10) NOT NULL,
  `temp_malam` int(5) NOT NULL,
  `pic_malam` varchar(25) NOT NULL,
  `keterangan_malam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_ac`
--

INSERT INTO `checklist_ac` (`id_checklist_ac`, `id_ruangan`, `tanggal`, `sts_ac_pagi`, `temp_pagi`, `pic_pagi`, `keterangan_pagi`, `sts_ac_malam`, `temp_malam`, `pic_malam`, `keterangan_malam`) VALUES
(5, 7, '2019-01-22', 'ok', 15, 'Purnomo Yulianto', '', 'ok', 16, 'Imam Khumaidi', '');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_pc`
--

CREATE TABLE `checklist_pc` (
  `id_checklist_pc` int(11) NOT NULL,
  `pc_id` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` enum('pagi','malam') NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `M1` enum('cek','kosong') NOT NULL,
  `M2` enum('cek','kosong') NOT NULL,
  `CPU` enum('cek','kosong') NOT NULL,
  `TL` varchar(50) NOT NULL,
  `IT` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_pc`
--

INSERT INTO `checklist_pc` (`id_checklist_pc`, `pc_id`, `tanggal`, `shift`, `nama_petugas`, `M1`, `M2`, `CPU`, `TL`, `IT`, `keterangan`) VALUES
(1, '1', '2019-01-16', 'pagi', 'Purnomo Yulianto', 'kosong', 'cek', 'cek', 'asd', 'asd', 'asd'),
(3, '2', '2019-01-22', 'malam', 'Ahmad Hariri', 'cek', 'cek', 'kosong', 'm', 'nol', 'alsdp'),
(5, '4', '2019-01-22', 'pagi', 'Imam Khumaidi', 'kosong', 'kosong', 'cek', 'sd', '', ''),
(6, '10', '2019-01-22', 'malam', 'Imam Khumaidi', 'cek', 'cek', 'cek', 'a', 'a', 'good'),
(7, '10', '2019-01-22', 'malam', 'Purnomo Yulianto', 'cek', 'cek', 'cek', '', '', ''),
(8, '9', '2019-01-22', 'pagi', 'Purnomo Yulianto', 'cek', 'cek', 'kosong', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_ups`
--

CREATE TABLE `checklist_ups` (
  `id_checklist_ups` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(25) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `input` int(11) NOT NULL,
  `output` int(11) NOT NULL,
  `baterai_time` int(11) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_ups`
--

INSERT INTO `checklist_ups` (`id_checklist_ups`, `tanggal`, `lokasi`, `merk`, `type`, `input`, `output`, `baterai_time`, `petugas`, `keterangan`) VALUES
(1, '2019-01-22', 'AF', 'hp', '007', 1, 2, 1, 'Ahmad Hariri', 'ntap'),
(2, '2019-01-22', 'lol', 'lol', 'lol', 1, 1, 1, 'Imam Khumaidi', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `check_cctv`
--

CREATE TABLE `check_cctv` (
  `id_check_cctv` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `shift` enum('pagi','sore','malam') NOT NULL,
  `tanggal` date NOT NULL,
  `tgl01` enum('baik','tidak') NOT NULL,
  `tgl02` enum('baik','tidak') NOT NULL,
  `tgl03` enum('baik','tidak') NOT NULL,
  `tgl04` enum('baik','tidak') NOT NULL,
  `tgl05` enum('baik','tidak') NOT NULL,
  `tgl06` enum('baik','tidak') NOT NULL,
  `tgl07` enum('baik','tidak') NOT NULL,
  `tgl08` enum('baik','tidak') NOT NULL,
  `tgl09` enum('baik','tidak') NOT NULL,
  `tgl10` enum('baik','tidak') NOT NULL,
  `tgl11` enum('baik','tidak') NOT NULL,
  `tgl12` enum('baik','tidak') NOT NULL,
  `tgl13` enum('baik','tidak') NOT NULL,
  `tgl14` enum('baik','tidak') NOT NULL,
  `tgl15` enum('baik','tidak') NOT NULL,
  `tgl16` enum('baik','tidak') NOT NULL,
  `tgl17` enum('baik','tidak') NOT NULL,
  `tgl18` enum('baik','tidak') NOT NULL,
  `tgl19` enum('baik','tidak') NOT NULL,
  `tgl20` enum('baik','tidak') NOT NULL,
  `tgl21` enum('baik','tidak') NOT NULL,
  `tgl22` enum('baik','tidak') NOT NULL,
  `tgl23` enum('baik','tidak') NOT NULL,
  `tgl24` enum('baik','tidak') NOT NULL,
  `tgl25` enum('baik','tidak') NOT NULL,
  `tgl26` enum('baik','tidak') NOT NULL,
  `tgl27` enum('baik','tidak') NOT NULL,
  `tgl28` enum('baik','tidak') NOT NULL,
  `tgl29` enum('baik','tidak') NOT NULL,
  `tgl30` enum('baik','tidak') NOT NULL,
  `tgl31` enum('baik','tidak') NOT NULL,
  `keterangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `check_cctv`
--

INSERT INTO `check_cctv` (`id_check_cctv`, `id_ruangan`, `shift`, `tanggal`, `tgl01`, `tgl02`, `tgl03`, `tgl04`, `tgl05`, `tgl06`, `tgl07`, `tgl08`, `tgl09`, `tgl10`, `tgl11`, `tgl12`, `tgl13`, `tgl14`, `tgl15`, `tgl16`, `tgl17`, `tgl18`, `tgl19`, `tgl20`, `tgl21`, `tgl22`, `tgl23`, `tgl24`, `tgl25`, `tgl26`, `tgl27`, `tgl28`, `tgl29`, `tgl30`, `tgl31`, `keterangan`) VALUES
(1, 1, 'pagi', '2019-01-01', 'baik', 'tidak', 'baik', 'tidak', 'tidak', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'tidak', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'lol'),
(2, 2, 'pagi', '2019-01-01', 'baik', 'baik', '', '', '', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', ''),
(3, 3, 'pagi', '2019-01-01', '', '', '', '', '', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', ''),
(4, 4, 'pagi', '2019-01-01', '', '', '', '', '', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', ''),
(5, 5, 'pagi', '2019-01-01', '', '', '', '', '', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', ''),
(6, 6, 'pagi', '2019-01-01', '', '', '', '', '', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', ''),
(7, 1, 'sore', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 2, 'sore', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 3, 'sore', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 4, 'sore', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 5, 'sore', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 6, 'sore', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 1, 'malam', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'baik', '', '', '', '', '', '', '', ''),
(14, 2, 'malam', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 3, 'malam', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 4, 'malam', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 5, 'malam', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 6, 'malam', '2019-01-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(133, 1, 'pagi', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(134, 2, 'pagi', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(135, 3, 'pagi', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(136, 4, 'pagi', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(137, 5, 'pagi', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(138, 6, 'pagi', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(139, 1, 'sore', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(140, 2, 'sore', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(141, 3, 'sore', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(142, 4, 'sore', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(143, 5, 'sore', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(144, 6, 'sore', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(145, 1, 'malam', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(146, 2, 'malam', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(147, 3, 'malam', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(148, 4, 'malam', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(149, 5, 'malam', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(150, 6, 'malam', '2019-02-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`) VALUES
(1, 'Imam Khumaidi'),
(2, 'Purnomo Yulianto'),
(3, 'Ahmad Hariri');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(25) NOT NULL,
  `lantai` int(11) NOT NULL,
  `bagian` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `lantai`, `bagian`) VALUES
(1, 'Loby Layanan', 4, 'cctv'),
(2, 'Layanan TAM', 4, 'cctv'),
(3, 'Loby Layanan', 6, 'cctv'),
(4, 'Layanan 147', 6, 'cctv'),
(5, 'Loby Layanan', 7, 'cctv'),
(6, 'Layanan 147', 7, 'cctv'),
(7, 'Server', 7, 'ac'),
(8, 'UPS', 7, 'ac'),
(9, 'UPS', 6, 'ac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist_ac`
--
ALTER TABLE `checklist_ac`
  ADD PRIMARY KEY (`id_checklist_ac`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `checklist_pc`
--
ALTER TABLE `checklist_pc`
  ADD PRIMARY KEY (`id_checklist_pc`);

--
-- Indexes for table `checklist_ups`
--
ALTER TABLE `checklist_ups`
  ADD PRIMARY KEY (`id_checklist_ups`);

--
-- Indexes for table `check_cctv`
--
ALTER TABLE `check_cctv`
  ADD PRIMARY KEY (`id_check_cctv`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist_ac`
--
ALTER TABLE `checklist_ac`
  MODIFY `id_checklist_ac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `checklist_pc`
--
ALTER TABLE `checklist_pc`
  MODIFY `id_checklist_pc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `checklist_ups`
--
ALTER TABLE `checklist_ups`
  MODIFY `id_checklist_ups` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `check_cctv`
--
ALTER TABLE `check_cctv`
  MODIFY `id_check_cctv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklist_ac`
--
ALTER TABLE `checklist_ac`
  ADD CONSTRAINT `checklist_ac_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `check_cctv`
--
ALTER TABLE `check_cctv`
  ADD CONSTRAINT `check_cctv_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
