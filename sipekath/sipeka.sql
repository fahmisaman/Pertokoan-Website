-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2018 at 10:05 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sipeka`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `atasan`
--

CREATE TABLE IF NOT EXISTS `atasan` (
  `id_atasan` bigint(50) NOT NULL AUTO_INCREMENT,
  `bawahan` bigint(50) DEFAULT NULL,
  `atasan` bigint(50) DEFAULT NULL,
  PRIMARY KEY (`id_atasan`),
  KEY `pegawai_bawahan` (`bawahan`),
  KEY `pegawai_atasan` (`atasan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `atasan`
--

INSERT INTO `atasan` (`id_atasan`, `bawahan`, `atasan`) VALUES
(2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `capaian`
--

CREATE TABLE IF NOT EXISTS `capaian` (
  `id_capaian` bigint(25) NOT NULL AUTO_INCREMENT,
  `capaian` bigint(255) DEFAULT NULL,
  `id_instansi` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_capaian`),
  KEY `instansi_capaian` (`id_instansi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `capaian`
--

INSERT INTO `capaian` (`id_capaian`, `capaian`, `id_instansi`) VALUES
(2, 300, 'IN-001');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE IF NOT EXISTS `instansi` (
  `id_instansi` varchar(25) NOT NULL,
  `instansi` text,
  `alamat_instansi` text,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instansi`, `instansi`, `alamat_instansi`) VALUES
('IN-001', 'POLTEKKES KEMENKES GORONTALO', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` bigint(50) NOT NULL AUTO_INCREMENT,
  `bulan` enum('01','02','03','04','05','06','07','08','09','10','11','12') DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `id_pegawai` bigint(25) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`),
  KEY `pegawai_kategori` (`id_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `bulan`, `tahun`, `id_pegawai`) VALUES
(1, '01', 2018, 1),
(3, '01', 2018, 3);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint(25) DEFAULT NULL,
  `nm_keg` varchar(255) DEFAULT NULL,
  `tgl_keg` date DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  `persentase` double DEFAULT NULL,
  PRIMARY KEY (`id_laporan`),
  KEY `kategori_laoran` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_kategori`, `nm_keg`, `tgl_keg`, `waktu`, `persentase`) VALUES
(2, 1, 'Peninjauan Intalasi Jaringan di Lingkungan POLTEKKES Kemenkes Gorontalo dalam rangka untuk perbaikan jaringan untuk tahun kedepannya seusai aturan Presiden 20', '2018-01-01', 90, 30),
(4, 1, 'ubah', '2018-01-01', 100, 33),
(5, 1, 'aku', '2018-01-01', 5, 1.6666666666667),
(6, 1, 'apa apa yaa', '2018-01-02', 300, 100),
(7, 1, 'INstaslasi Jaringan', '2018-01-01', 20, 6.6666666666667);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` bigint(50) NOT NULL AUTO_INCREMENT,
  `id_instansi` varchar(25) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `unit` text NOT NULL,
  `status_pegawai` enum('T','Y') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_pegawai`),
  KEY `instansi_pegawai` (`id_instansi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_instansi`, `nip`, `username`, `password`, `nama`, `jabatan`, `unit`, `status_pegawai`) VALUES
(1, 'IN-001', '1234', '123', '123', 'Fahmi Saman, S.Kom', 'Sistem Informasi', '', 'Y'),
(3, 'IN-001', '12345', '12345', '12345', 'Alristo Moli', 'Staf Sistem Informasi', '', 'Y'),
(4, 'IN-001', '197203071997031004', 'tony', 'tony', 'TUMARTONY T HIOLA, S.Pd., M.Kes', 'Kepala Unit Sistem Informasi', 'Sistem Informasi', 'Y');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atasan`
--
ALTER TABLE `atasan`
  ADD CONSTRAINT `pegawai_atasan` FOREIGN KEY (`atasan`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_bawahan` FOREIGN KEY (`bawahan`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `capaian`
--
ALTER TABLE `capaian`
  ADD CONSTRAINT `instansi_capaian` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `pegawai_kategori` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `kategori_laoran` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `instansi_pegawai` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
