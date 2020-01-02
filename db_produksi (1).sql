-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 04:09 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_produksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mt_anggota`
--

CREATE TABLE IF NOT EXISTS `mt_anggota` (
  `id_anggota` varchar(25) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `password_anggota` varchar(100) NOT NULL,
  `status_anggota` varchar(25) NOT NULL,
  `grup_anggota` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_anggota`
--

INSERT INTO `mt_anggota` (`id_anggota`, `nama_anggota`, `password_anggota`, `status_anggota`, `grup_anggota`, `created_at`, `updated_at`) VALUES
('U_0001', 'admin', '93896f81754b2c5a375af5c75cfa1664', 'AKTIF', 'ADMIN', '2019-11-28 00:00:00', '2019-11-28 00:00:00'),
('U_0002', 'bakhtiar', '304566c874b426ebcee417f90551d663', 'TIDAK AKTIF', 'ANGGOTA', '2019-11-28 01:44:27', '2019-12-24 17:29:35'),
('U_0003', 'sari', '3a19a956ad4663ca486f88321244bae5', 'TIDAK AKTIF', 'ADMIN', '2019-12-24 17:36:48', '2019-12-24 17:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `mt_kandang`
--

CREATE TABLE IF NOT EXISTS `mt_kandang` (
  `id_kandang` varchar(25) NOT NULL,
  `id_lokasi` varchar(25) NOT NULL,
  `nama_kandang` varchar(100) NOT NULL,
  `kapasitas_ayam` int(11) NOT NULL,
  `status_kandang` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_kandang`),
  KEY `id_lokasi` (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_kandang`
--

INSERT INTO `mt_kandang` (`id_kandang`, `id_lokasi`, `nama_kandang`, `kapasitas_ayam`, `status_kandang`, `created_at`, `updated_at`) VALUES
('KN_0001', 'LK_0001', 'kandang 1', 1000, 'AKTIF', '2019-12-01 11:49:27', '2019-12-09 19:19:50'),
('KN_0002', 'LK_0001', 'kandang 2', 800, 'AKTIF', '2019-12-01 11:49:37', '2019-12-01 11:49:42'),
('KN_0003', 'LK_0001', 'kandang 3', 800, 'AKTIF', '2019-12-09 19:20:03', '2019-12-12 16:42:42'),
('KN_0004', 'LK_0001', 'kandang 4', 800, 'AKTIF', '2019-12-09 19:20:17', '2019-12-09 19:20:17'),
('KN_0005', 'LK_0001', 'kandang 5', 800, 'AKTIF', '2019-12-09 19:20:29', '2019-12-09 19:20:29'),
('KN_0006', 'LK_0002', 'kandang prapen 1', 700, 'AKTIF', '2019-12-09 19:20:40', '2019-12-27 16:56:06'),
('KN_0007', 'LK_0002', 'kandang 2', 700, 'AKTIF', '2019-12-09 19:20:50', '2019-12-09 19:20:50'),
('KN_0008', 'LK_0002', 'kandang 3', 700, 'AKTIF', '2019-12-09 19:20:59', '2019-12-09 19:20:59'),
('KN_0009', 'LK_0002', 'kandang 4', 700, 'AKTIF', '2019-12-09 19:21:09', '2019-12-09 19:21:09'),
('KN_0010', 'LK_0002', 'kandang 5', 700, 'AKTIF', '2019-12-09 19:21:18', '2019-12-09 19:21:18'),
('KN_0011', 'LK_0001', 'kandang 6', 700, 'TIDAK AKTIF', '2019-12-24 17:38:17', '2019-12-24 17:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `mt_lokasi`
--

CREATE TABLE IF NOT EXISTS `mt_lokasi` (
  `id_lokasi` varchar(25) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `status_lokasi` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_lokasi`
--

INSERT INTO `mt_lokasi` (`id_lokasi`, `nama_lokasi`, `status_lokasi`, `created_at`, `updated_at`) VALUES
('LK_0001', 'jemursari', 'AKTIF', '2019-11-29 14:02:01', '0000-00-00 00:00:00'),
('LK_0002', 'prapen', 'AKTIF', '2019-11-29 14:02:07', '0000-00-00 00:00:00'),
('LK_0003', 'semolowaru', 'TIDAK AKTIF', '2019-12-24 17:37:57', '2019-12-24 17:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `mt_strain`
--

CREATE TABLE IF NOT EXISTS `mt_strain` (
  `id_strain` varchar(25) NOT NULL,
  `nama_strain` varchar(100) NOT NULL,
  `status_strain` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_strain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_strain`
--

INSERT INTO `mt_strain` (`id_strain`, `nama_strain`, `status_strain`, `created_at`, `updated_at`) VALUES
('SN_0001', 'ISA BROWN', 'AKTIF', '2019-12-19 16:32:18', '0000-00-00 00:00:00'),
('SN_0002', 'brown', 'TIDAK AKTIF', '2019-12-24 17:37:08', '2019-12-24 17:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `mt_strain_nilai`
--

CREATE TABLE IF NOT EXISTS `mt_strain_nilai` (
  `id_strain_nilai` varchar(25) NOT NULL,
  `id_strain` varchar(25) NOT NULL,
  `nama_strain_nilai` varchar(100) NOT NULL,
  `minggu_strain_nilai` int(11) NOT NULL,
  `standar_strain_nilai` float NOT NULL,
  `status_strain_nilai` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_strain_nilai`),
  KEY `id_strain` (`id_strain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_strain_nilai`
--

INSERT INTO `mt_strain_nilai` (`id_strain_nilai`, `id_strain`, `nama_strain_nilai`, `minggu_strain_nilai`, `standar_strain_nilai`, `status_strain_nilai`, `created_at`, `updated_at`) VALUES
('SI_0001', 'SN_0001', 'egg mass', 1, 15.1, 'TIDAK AKTIF', '2019-12-24 17:37:27', '2019-12-24 17:37:49'),
('SI_0002', 'SN_0001', 'egg mass', 2, 19.1, 'AKTIF', '2019-12-24 17:37:39', '2019-12-24 17:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `tr_periode`
--

CREATE TABLE IF NOT EXISTS `tr_periode` (
  `id_periode` varchar(25) NOT NULL,
  `id_kandang` varchar(25) NOT NULL,
  `id_anggota` varchar(25) NOT NULL,
  `id_strain` varchar(25) NOT NULL,
  `nama_periode` varchar(100) DEFAULT NULL,
  `tanggal_masuk_kandang` datetime DEFAULT NULL,
  `tanggal_menetas` datetime NOT NULL,
  `awal_ayam_masuk` int(11) NOT NULL,
  `jumlah_seluruh_ayam` int(11) NOT NULL,
  `umur_masuk` float DEFAULT NULL,
  `asal_pullet` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status_periode` varchar(25) NOT NULL,
  `hd_periode` int(11) NOT NULL,
  PRIMARY KEY (`id_periode`),
  KEY `id_kandang` (`id_kandang`),
  KEY `id_user` (`id_anggota`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_strain` (`id_strain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_periode`
--

INSERT INTO `tr_periode` (`id_periode`, `id_kandang`, `id_anggota`, `id_strain`, `nama_periode`, `tanggal_masuk_kandang`, `tanggal_menetas`, `awal_ayam_masuk`, `jumlah_seluruh_ayam`, `umur_masuk`, `asal_pullet`, `created_at`, `updated_at`, `status_periode`, `hd_periode`) VALUES
('PR_0001', 'KN_0001', 'U_0001', 'SN_0001', 'periode jemursari kandang 1', '2019-12-10 00:00:00', '2019-12-10 00:00:00', 1000, 990, 3, 'lokal', '2019-12-23 20:08:24', '2019-12-24 17:39:52', 'AKTIF', 997),
('PR_0002', 'KN_0006', 'U_0001', 'SN_0001', 'periode prapen kandang 1', '2019-08-13 00:00:00', '2019-08-13 00:00:00', 500, 500, 3, 'lokal', '2019-12-24 17:38:58', '2019-12-24 17:39:11', 'TIDAK AKTIF', 980),
('PR_0003', 'KN_0002', 'U_0001', 'SN_0001', 'adasd', '2019-12-11 00:00:00', '2019-12-10 00:00:00', 680, 680, 3, 'sda', '2019-12-27 19:42:38', '2019-12-27 19:42:38', 'AKTIF', 980),
('PR_0004', 'KN_0003', 'U_0001', 'SN_0001', 'dasd', '2019-12-12 00:00:00', '2019-12-12 00:00:00', 700, 700, 6, 'ass', '2019-12-27 20:11:00', '2019-12-27 20:11:00', 'AKTIF', 980),
('PR_0005', 'KN_0004', 'U_0001', 'SN_0001', 'asdsa', '2019-12-14 00:00:00', '2019-12-12 00:00:00', 700, 700, 7, 'a', '2019-12-27 20:11:21', '2019-12-27 20:11:21', 'AKTIF', 980),
('PR_0006', 'KN_0006', 'U_0001', 'SN_0001', 'adasd', '2020-01-28 00:00:00', '2020-01-16 00:00:00', 700, 700, 3, 'sda', '2020-01-01 22:20:41', '2020-01-01 22:20:41', 'AKTIF', 890);

-- --------------------------------------------------------

--
-- Table structure for table `tr_produksi`
--

CREATE TABLE IF NOT EXISTS `tr_produksi` (
  `id_produksi` varchar(25) NOT NULL,
  `id_periode` varchar(25) NOT NULL,
  `id_anggota` varchar(25) NOT NULL,
  `ayam_m` int(11) NOT NULL,
  `ayam_c` int(11) NOT NULL,
  `total_ayam` int(11) NOT NULL,
  `tanggal_catat` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `suhu_pagi` float DEFAULT NULL,
  `suhu_siang` float DEFAULT NULL,
  `suhu_sore` float DEFAULT NULL,
  `suhu_malam` float DEFAULT NULL,
  `butir_jumlah` int(11) NOT NULL,
  `rusak_jumlah` int(11) NOT NULL,
  `butir_kg` float NOT NULL,
  `rusak_kg` float NOT NULL,
  `pakan_kg` float NOT NULL,
  `berat_badan` float NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `hasil_pakan_gr` float NOT NULL,
  `hasil_butir_gr` float NOT NULL,
  `hasil_rusak_gr` float NOT NULL,
  `hasil_hd_persen` float NOT NULL,
  `hasil_fcr` float NOT NULL,
  `hasil_rusak_persen` float NOT NULL,
  `hasil_hh` float NOT NULL,
  PRIMARY KEY (`id_produksi`),
  KEY `id_periode` (`id_periode`),
  KEY `id_anggota` (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_produksi`
--

INSERT INTO `tr_produksi` (`id_produksi`, `id_periode`, `id_anggota`, `ayam_m`, `ayam_c`, `total_ayam`, `tanggal_catat`, `created_at`, `updated_at`, `suhu_pagi`, `suhu_siang`, `suhu_sore`, `suhu_malam`, `butir_jumlah`, `rusak_jumlah`, `butir_kg`, `rusak_kg`, `pakan_kg`, `berat_badan`, `keterangan`, `hasil_pakan_gr`, `hasil_butir_gr`, `hasil_rusak_gr`, `hasil_hd_persen`, `hasil_fcr`, `hasil_rusak_persen`, `hasil_hh`) VALUES
('PI_0000001', 'PR_0001', 'U_0001', 2, 3, 995, '2019-12-10 00:00:00', '2019-12-24 17:12:17', '2019-12-24 17:12:17', 15, 15, 15, 15, 980, 19, 60, 1, 115, 90, 'vaksin', 115.578, 61.2245, 52.6316, 98.4925, 1.91667, 1.93878, 98.2949),
('PI_0000002', 'PR_0001', 'U_0001', 1, 1, 993, '2019-12-11 00:00:00', '2019-12-24 17:13:00', '2019-12-24 17:13:00', 17, 17, 17, 17, 965, 5, 58.5, 0.5, 105, 90, '', 105.74, 60.6218, 100, 97.1803, 1.79487, 0.518135, 96.7904),
('PI_0000003', 'PR_0001', 'U_0001', 1, 1, 990, '2019-12-12 00:00:00', '2019-12-24 17:39:52', '2019-12-24 17:39:52', 15, 15, 15, 15, 990, 14, 65, 1, 120, 90, '', 121.212, 65.6566, 71.4286, 100, 1.84615, 1.41414, 99.2979);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mt_kandang`
--
ALTER TABLE `mt_kandang`
  ADD CONSTRAINT `mt_kandang_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `mt_lokasi` (`id_lokasi`);

--
-- Constraints for table `mt_strain_nilai`
--
ALTER TABLE `mt_strain_nilai`
  ADD CONSTRAINT `mt_strain_nilai_ibfk_1` FOREIGN KEY (`id_strain`) REFERENCES `mt_strain` (`id_strain`);

--
-- Constraints for table `tr_periode`
--
ALTER TABLE `tr_periode`
  ADD CONSTRAINT `tr_periode_ibfk_1` FOREIGN KEY (`id_kandang`) REFERENCES `mt_kandang` (`id_kandang`),
  ADD CONSTRAINT `tr_periode_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `mt_anggota` (`id_anggota`),
  ADD CONSTRAINT `tr_periode_ibfk_3` FOREIGN KEY (`id_strain`) REFERENCES `mt_strain` (`id_strain`);

--
-- Constraints for table `tr_produksi`
--
ALTER TABLE `tr_produksi`
  ADD CONSTRAINT `tr_produksi_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `mt_anggota` (`id_anggota`),
  ADD CONSTRAINT `tr_produksi_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `tr_periode` (`id_periode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
