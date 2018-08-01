-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2018 at 03:53 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `monitoringdetakjantung`
--
CREATE DATABASE IF NOT EXISTS `monitoringdetakjantung` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `monitoringdetakjantung`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `kode_admin` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `telepon` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE latin1_general_ci NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`kode_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`kode_admin`, `username`, `password`, `telepon`, `email`, `gambar`, `status`) VALUES
('ADM1803001', 'a', 'a', '0234567845678', 'admin@yahoo.com', 'wifi.png', 'Aktif'),
('ADM1807001', 'annisaprati', 'pratiwi', '082112700022', 'annsprtws@gmail.com', 'A.jpg', 'Aktif'),
('ADM1807002', 'sarahnajm', 'sarah', '082112700033', 'sarahnajmanita@gmail.com', 'Screenshot_1.png', 'Aktif'),
('ADM1807003', 'merdhika', 'ikaika', '089213462789', 'merdhika17@gmail.com', 'Screenshot_2.png', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE IF NOT EXISTS `tb_dokter` (
  `kode_dokter` varchar(15) NOT NULL,
  `nama_dokter` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`kode_dokter`, `nama_dokter`, `email`, `telepon`, `username`, `password`, `status`) VALUES
('DTR1803004', 'Ulima Larisa Syafwi', 'ulimalarisa@gmail.co', '087780152006', 'ulimalari', 'ulima', 'Aktif'),
('DTR1803005', 'Nurmiadha Nisa Kharimah', 'nurmiadhanisa@gmail.', '085772132524', 'nurmiadhan', 'kharimah', 'Aktif'),
('DTR1806001', 'b', 'b@b.b', '021021', 'b', 'b', 'Aktif'),
('DTR1807001', 'Nabila Shaffa Bestari', 'nabilashafffa@gmail.', '087877421328', 'nabilabil', 'nabila', 'Tidak Aktif'),
('DTR1807002', 'Muhammad Irvan Maulana', 'irvanmaulana@gmail.c', '087887707423', 'irvankotak', 'kotak', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE IF NOT EXISTS `tb_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_perawatan` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `detak_jantung` int(5) NOT NULL,
  `detak_jantung2` int(5) NOT NULL,
  `note` int(1) NOT NULL DEFAULT '0',
  `peak` int(1) NOT NULL DEFAULT '0',
  `sts` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE IF NOT EXISTS `tb_pasien` (
  `kode_pasien` varchar(15) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `catatan` text NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`kode_pasien`, `nama_pasien`, `jenis_kelamin`, `alamat`, `telepon`, `catatan`, `status`) VALUES
('PSN1803002', 'Riza Reidista', 'Laki-laki', 'jl. pinang 2 nomor 301 RT. 002 RW 008, Jakarta Barat.', '088808304338', 'Gangguan Serebrovaskular ', 'Aktif'),
('PSN1803003', 'Trixia zranita', 'Perempuan', 'perumahan kampung lipi 2 blok A1 nomor 104, Jakarta.', '08889091234', 'Gangguan Serebrovaskular ', 'Aktif'),
('PSN1807001', 'rezky aditya', 'Laki-laki', 'jl. kepompong Raya nomor 23, Jakarta pusat.', '082234588881', 'Check Out', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perawatan`
--

CREATE TABLE IF NOT EXISTS `tb_perawatan` (
  `kode_perawatan` varchar(15) NOT NULL,
  `nama_perawatan` varchar(15) NOT NULL,
  `kode_pasien` varchar(15) NOT NULL,
  `kode_dokter` varchar(15) NOT NULL,
  `uraian` text NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perawatan`
--

INSERT INTO `tb_perawatan` (`kode_perawatan`, `nama_perawatan`, `kode_pasien`, `kode_dokter`, `uraian`, `status`) VALUES
('RWT1804001', 'Perawatan 1', 'PSN1803002', 'DTR1803004', 'Setelah Operasi', 'Aktif'),
('RWT1803003', 'Perawatan 1', 'PSN1803003', 'DTR1803005', '-', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `kode_user` varchar(15) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`kode_user`, `nama_user`, `telepon`, `username`, `password`, `status`) VALUES
('RWT1803005', 'Gena Pradita', '082113357528', 'genapra', 'gena', 'Aktif'),
('RWT1806001', 'Rayhan Nirmala', '082211327913', 'nirmala', 'mala', 'Aktif'),
('RWT1807001', 'Milatu Fadilla', '082297007402', 'milatu', 'milatu', 'Tidak Aktif');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
