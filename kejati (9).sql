-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2022 at 05:25 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kejati`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `id` int(11) NOT NULL,
  `konsultasi_id` int(11) NOT NULL,
  `dari` int(11) NOT NULL COMMENT 'pegawai_id',
  `untuk` int(11) NOT NULL COMMENT 'pegawai_id',
  `dibaca` int(11) NOT NULL DEFAULT 0,
  `pesan` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_tugas`
--

CREATE TABLE `detail_tugas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `dibuka` int(1) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_tugas`
--

INSERT INTO `detail_tugas` (`id`, `tugas_id`, `kegiatan_id`, `status`, `waktu`, `satuan`, `waktu_mulai`, `waktu_selesai`, `dibuka`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 6, 'Diterima', '60', 'menit', '2022-05-11 14:20:39', '2022-05-11 14:29:11', 2, '2022-05-11 14:19:59', NULL, NULL),
(2, 2, 6, 'Diterima', '60', 'menit', '2022-05-11 16:46:09', '2022-05-11 16:49:46', 2, '2022-05-11 16:43:52', NULL, NULL),
(3, 3, 7, 'Diterima', '10', 'menit', '2022-05-13 11:35:07', '2022-05-13 11:39:00', 2, '2022-05-13 11:15:16', NULL, NULL),
(4, 4, 7, 'Diterima', '10', 'menit', '2022-05-13 11:44:46', '2022-05-13 11:46:45', 2, '2022-05-13 11:44:20', NULL, NULL),
(5, 3, 8, 'Dalam proses', '11', 'menit', '2022-05-13 13:50:54', NULL, 1, '2022-05-13 13:50:02', NULL, NULL),
(6, 5, 6, 'Dalam proses', '60', 'menit', '2022-05-13 15:19:06', NULL, 1, '2022-05-13 15:02:24', NULL, NULL),
(7, 6, 6, 'Diterima', '60', 'menit', '2022-05-13 16:05:31', NULL, 2, '2022-05-13 15:48:01', NULL, NULL),
(8, 6, 33, 'Diterima', '12', 'menit', '2022-05-13 16:05:31', '2022-05-13 16:36:37', 2, '2022-05-13 15:50:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id` int(11) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id`, `golongan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'III A', '2022-05-11 12:02:07', NULL, NULL),
(2, 'IVA', '2022-05-11 12:02:17', NULL, NULL),
(3, 'III D', '2022-05-13 10:26:34', NULL, NULL),
(4, 'III B', '2022-05-13 10:43:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `hasil` varchar(100) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `hasil`, `kegiatan_id`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Notulen rapat', 1, '2022-05-11 12:27:32', NULL, NULL),
(2, '', 1, '2022-05-11 12:27:32', NULL, NULL),
(3, 'Notulen rapat', 2, '2022-05-11 12:28:03', NULL, NULL),
(4, '', 2, '2022-05-11 12:28:03', NULL, NULL),
(5, 'ar', 3, '2022-05-11 12:29:16', NULL, NULL),
(6, 'notulen rapat tim penyidik', 4, '2022-05-11 14:14:48', NULL, NULL),
(7, 'notulen rapat tim penyidik', 5, '2022-05-11 14:14:58', NULL, NULL),
(8, '', 5, '2022-05-11 14:14:58', NULL, NULL),
(9, 'notulen rapat tim penyidik', 6, '2022-05-11 14:16:38', NULL, NULL),
(10, 'aaa', 6, '2022-05-11 14:16:38', NULL, '2022-05-11 16:42:16'),
(11, 'Surat Perintah Tugas Pengayaan Informasi/ Data diterima', 7, '2022-05-12 13:50:35', NULL, NULL),
(12, 'weaswdaswde', 8, '2022-05-12 13:52:04', NULL, NULL),
(13, 'asdasdada', 8, '2022-05-12 13:52:04', NULL, NULL),
(14, 'asdasd', 9, '2022-05-12 13:52:29', NULL, NULL),
(15, 'asdasda', 9, '2022-05-12 13:52:29', NULL, NULL),
(16, 'asdasd', 9, '2022-05-12 13:52:29', NULL, NULL),
(17, '12321312', 10, '2022-05-12 13:54:23', NULL, NULL),
(18, '12321312', 11, '2022-05-12 13:54:37', NULL, NULL),
(19, '', 12, '2022-05-12 13:57:20', NULL, '2022-05-12 13:57:31'),
(20, '', 13, '2022-05-12 14:00:49', NULL, '2022-05-12 14:00:56'),
(21, 'test 2', 19, '2022-05-12 14:06:49', NULL, NULL),
(22, 'asd', 33, '2022-05-13 15:50:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_data`
--

CREATE TABLE `hasil_data` (
  `id` int(11) NOT NULL,
  `detail_tugas_id` int(11) NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_data`
--

INSERT INTO `hasil_data` (`id`, `detail_tugas_id`, `hasil_id`, `dokumen`, `tipe`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 9, 'd023671a053883608e1cafb1bbbe8a1a.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(2, 1, 10, '7567dcd19994e390d0b85b1bd2d7f94d.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(3, 2, 9, '6eff59c217537aec29e37a12a024a9fc.png', 'image/png', '2022-05-11 16:43:52', NULL, NULL),
(4, 3, 11, 'f3dc8fd343e2f90d18aa54eb813a777c.PNG', 'image/png', '2022-05-13 11:15:16', NULL, NULL),
(5, 4, 11, '32e81528704dfc5e679904c9ebba889f.jpg', 'image/jpeg', '2022-05-13 11:44:20', NULL, NULL),
(6, 5, 12, NULL, NULL, '2022-05-13 13:50:02', NULL, NULL),
(7, 5, 13, NULL, NULL, '2022-05-13 13:50:02', NULL, NULL),
(8, 6, 9, NULL, NULL, '2022-05-13 15:02:24', NULL, NULL),
(9, 7, 9, 'b8189756022b9704f45e55a342a7056d.png', 'image/png', '2022-05-13 15:48:01', NULL, NULL),
(10, 8, 22, 'e4d7886444c236efe9d16c9ef9cb5122.png', 'image/png', '2022-05-13 15:50:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Jaksa Fungsional', '2022-05-11 12:01:31', NULL, NULL),
(2, 'Kepala Seksi Penyelidikan', '2022-05-11 12:01:40', NULL, NULL),
(3, 'Kepala Sub Bagian Kepegawaian', '2022-05-13 10:26:02', NULL, '2022-05-13 10:42:01'),
(4, 'Kepala Sub Bagian Kepegawaian', '2022-05-13 10:43:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `sop_id` int(11) NOT NULL,
  `kegiatan` longtext NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `keterangan` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `sop_id`, `kegiatan`, `waktu`, `satuan`, `keterangan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 4, 'Melakukan rapt tindakan permintaan dokumen', '60', 'menit', 'a', '2022-05-11 12:27:32', NULL, '2022-05-11 12:29:20'),
(2, 4, 'Melakukan rapt tindakan permintaan dokumen', '60', 'menit', 'a', '2022-05-11 12:28:03', NULL, '2022-05-11 12:29:24'),
(3, 4, 'qasa', '12', 'menit', '12', '2022-05-11 12:29:16', NULL, '2022-05-11 12:29:27'),
(4, 5, 'Melakukan rapat tindakan permintaan dokumen', '60', 'menit', 'aaa', '2022-05-11 14:14:48', NULL, '2022-05-11 14:15:49'),
(5, 5, 'Melakukan rapat tindakan permintaan dokumen', '60', 'menit', 'aaa', '2022-05-11 14:14:58', NULL, '2022-05-11 14:15:46'),
(6, 5, 'Melakukan rapt tindakan permintaan dokumen', '60', 'menit', 'aaa', '2022-05-11 14:16:38', NULL, NULL),
(7, 6, 'Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '10', 'menit', '', '2022-05-12 13:50:35', NULL, NULL),
(8, 6, 'Melakukan Rapat Koordinasi    pelaksanaan tugas Pengayaan Informasi /Data', '11', 'menit', 'asda', '2022-05-12 13:52:04', NULL, NULL),
(9, 6, 'asdasdasd', '11', 'menit', 'asdasdasd', '2022-05-12 13:52:29', NULL, NULL),
(10, 7, 'asddasd', '11', 'menit', '123131', '2022-05-12 13:54:23', NULL, NULL),
(11, 7, 'asddasd', '11', 'menit', '123131', '2022-05-12 13:54:37', NULL, NULL),
(12, 7, 'Menerima Surat Perintah Tugas Pengayaan Informasi/Data', '12', 'menit', 'asdad', '2022-05-12 13:57:20', NULL, '2022-05-12 13:57:37'),
(13, 7, 'Menerima Surat Perintah Tugas Pengayaan Informasi/Data', '12', 'menit', '123', '2022-05-12 14:00:49', NULL, '2022-05-12 14:01:24'),
(17, 8, 'Menerima Surat Perintah Tugas Pengayaan Informasi/Data', '12', 'menit', 'sd', '2022-05-12 14:05:45', NULL, NULL),
(18, 8, 'Menerima Surat Perintah Tugas Pengayaan Informasi/Data', '12', 'menit', 'sd', '2022-05-12 14:06:24', NULL, NULL),
(19, 8, 'asdasdv asd', '21', 'menit', 'aswd', '2022-05-12 14:06:41', NULL, NULL),
(20, 8, 'Menerima Surat Perintah Tugas Pengayaan Informasi/Data', '12', 'menit', '12', '2022-05-12 14:18:59', NULL, NULL),
(21, 9, 'Kegiatan 1', '40', 'menit', 'sa', '2022-05-13 10:28:45', NULL, NULL),
(22, 10, 'Kegiatan 1', '120', 'menit', 'a', '2022-05-13 10:48:14', NULL, NULL),
(23, 11, 'Melakukan Rapat Kordinasi', '120', 'menit', '', '2022-05-13 10:52:29', NULL, NULL),
(24, 11, 'Melaksanakan Tugas Pengayaan Informasi/Data', '3', 'hari', '', '2022-05-13 10:53:53', NULL, NULL),
(25, 12, 'asdasd', '12', 'jam', 'asdasd', '2022-05-13 11:21:47', NULL, NULL),
(26, 13, 'Melakukan Rapat Kordinasi', '120', 'menit', '', '2022-05-13 11:23:29', NULL, NULL),
(27, 13, 'Menyusun Nota Pendapat untuk tindakan penyelidikan', '180', 'menit', '', '2022-05-13 11:24:40', NULL, NULL),
(28, 14, 'Melakukan rapat tindakan permintaan keterangan', '120', 'menit', '', '2022-05-13 11:28:37', NULL, NULL),
(29, 14, 'Melakukan Pemanggilan permintaan keterangan dan kordinasi permintaan keterangan', '3', 'hari', '', '2022-05-13 11:30:04', NULL, NULL),
(30, 15, 'Menerima saksi yang akan di periksa', '10', 'menit', 'Penyidik memperkenalkan diri serta mengucapkan terimaksaih atas kehadiran saksi', '2022-05-13 14:15:45', NULL, NULL),
(31, 15, 'Menjelaskan maksud dan tujuan pemeriksaan saksi', '10', 'menit', '', '2022-05-13 14:17:46', NULL, NULL),
(32, 15, 'Melakukan pengisian blanko data informasi saksi', '10', 'menit', '', '2022-05-13 14:19:04', NULL, NULL),
(33, 5, 'test', '12', 'menit', '', '2022-05-13 15:49:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelengkapan`
--

CREATE TABLE `kelengkapan` (
  `id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `kelengkapan` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelengkapan`
--

INSERT INTO `kelengkapan` (`id`, `kegiatan_id`, `kelengkapan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 'surat perintah penyelidikan', '2022-05-11 12:27:32', NULL, NULL),
(2, 1, 'rencana penyelidikan', '2022-05-11 12:27:32', NULL, NULL),
(3, 2, 'surat perintah penyelidikan', '2022-05-11 12:28:03', NULL, NULL),
(4, 2, 'rencana penyelidikan', '2022-05-11 12:28:03', NULL, NULL),
(5, 2, '', '2022-05-11 12:28:03', NULL, NULL),
(6, 3, 'we', '2022-05-11 12:29:16', NULL, NULL),
(7, 3, 'er', '2022-05-11 12:29:16', NULL, NULL),
(8, 4, 'surat perintah penyelidikan', '2022-05-11 14:14:48', NULL, NULL),
(9, 4, 'rencana penyelidikan', '2022-05-11 14:14:48', NULL, NULL),
(10, 4, 'disposisi atas nota pendapat tindakan permintaan dok', '2022-05-11 14:14:48', NULL, NULL),
(11, 5, 'surat perintah penyelidikan', '2022-05-11 14:14:58', NULL, NULL),
(12, 5, 'rencana penyelidikan', '2022-05-11 14:14:58', NULL, NULL),
(13, 5, 'disposisi atas nota pendapat tindakan permintaan dok', '2022-05-11 14:14:58', NULL, NULL),
(14, 6, 'surat perintah penyelidikan', '2022-05-11 14:16:38', NULL, NULL),
(15, 6, 'rencana penyidikan', '2022-05-11 14:16:38', NULL, NULL),
(16, 7, 'Surat Perintah Tugas', '2022-05-12 13:50:35', NULL, NULL),
(17, 7, 'Nota Dinas Telaahan ', '2022-05-12 13:50:35', NULL, NULL),
(18, 7, 'Laporan dan Pengaduan Masyarakat', '2022-05-12 13:50:35', NULL, NULL),
(19, 8, 'Surat Perintah Tugas', '2022-05-12 13:52:04', NULL, NULL),
(20, 8, 'adsa', '2022-05-12 13:52:04', NULL, NULL),
(21, 8, 'asdasdasda', '2022-05-12 13:52:04', NULL, NULL),
(22, 9, 'sdasadsdasda', '2022-05-12 13:52:29', NULL, NULL),
(23, 9, 'asdasda', '2022-05-12 13:52:29', NULL, NULL),
(24, 10, 'Surat Perintah Tugas', '2022-05-12 13:54:23', NULL, NULL),
(25, 11, 'Surat Perintah Tugas', '2022-05-12 13:54:37', NULL, NULL),
(26, 12, '', '2022-05-12 13:57:20', NULL, '2022-05-12 13:57:30'),
(27, 13, '', '2022-05-12 14:00:49', NULL, '2022-05-12 14:00:54'),
(28, 19, 'test 2', '2022-05-12 14:06:53', NULL, NULL),
(29, 33, 'asd', '2022-05-13 15:50:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelengkapan_data`
--

CREATE TABLE `kelengkapan_data` (
  `id` int(11) NOT NULL,
  `detail_tugas_id` int(11) DEFAULT NULL,
  `kelengkapan_id` int(11) DEFAULT NULL,
  `dokumen` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelengkapan_data`
--

INSERT INTO `kelengkapan_data` (`id`, `detail_tugas_id`, `kelengkapan_id`, `dokumen`, `tipe`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 14, '072f0a2d809a8109dcc58ac1f7389f0c.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(2, 1, 15, '6f680dd3defa5a0081c54391cbb89d8d.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(3, 2, 14, '57585ca12d68e4f7c90f1384d3f8e1a8.png', 'image/png', '2022-05-11 16:43:52', NULL, NULL),
(4, 2, 15, '268a64419cbe510bfc88c0fc98cafede.png', 'image/png', '2022-05-11 16:43:52', NULL, NULL),
(5, 3, 16, 'dffd13eb29db59212069c2bc01de185b.PNG', 'image/png', '2022-05-13 11:15:16', NULL, NULL),
(6, 3, 17, 'b1e778189c43e1bb71364a3aa0b6e5ca.PNG', 'image/png', '2022-05-13 11:15:16', NULL, NULL),
(7, 3, 18, '74548c58fbc37c79cf4ec6ac3ab4c480.PNG', 'image/png', '2022-05-13 11:15:16', NULL, NULL),
(8, 4, 16, '4f7be01b91f1fe38fcdf4e9dec5cecde.PNG', 'image/png', '2022-05-13 11:44:20', NULL, NULL),
(9, 4, 17, '3f66415ba5c42ea887907c0905720399.PNG', 'image/png', '2022-05-13 11:44:20', NULL, NULL),
(10, 4, 18, '602525ad42c54f744bdce1bfaea166c2.PNG', 'image/png', '2022-05-13 11:44:20', NULL, NULL),
(11, 5, 19, 'f7bde85e7731b6e29de84a9988017afa.png', 'image/png', '2022-05-13 13:50:02', NULL, NULL),
(12, 5, 20, '2f75df0db84e882135090d62b7ee7313.png', 'image/png', '2022-05-13 13:50:02', NULL, NULL),
(13, 5, 21, 'c9bd170dedc071107b4d436dc8ee7a21.png', 'image/png', '2022-05-13 13:50:02', NULL, NULL),
(14, 6, 14, 'a5489f494adb8f3a02292f1f531f4698.png', 'image/png', '2022-05-13 15:02:24', NULL, NULL),
(15, 6, 15, 'd2a0855a84d596bf621a2250b5a55b22.png', 'image/png', '2022-05-13 15:02:24', NULL, NULL),
(16, 7, 14, '00593f310ae0a665d3a0da152cd4684e.png', 'image/png', '2022-05-13 15:48:01', NULL, NULL),
(17, 7, 15, 'a97a5fd41dd235ecabc0bb7250ccb3ce.png', 'image/png', '2022-05-13 15:48:01', NULL, NULL),
(18, 8, 29, 'abf46dfb20c55e19c80b78cd0935603b.png', 'image/png', '2022-05-13 15:50:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `pegawai_detail_tugas_id` int(11) NOT NULL,
  `tipe` int(1) NOT NULL,
  `judul` longtext NOT NULL,
  `deskripsi` longtext NOT NULL,
  `waktu_mulai` datetime NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` datetime DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `pegawai_detail_tugas_id`, `tipe`, `judul`, `deskripsi`, `waktu_mulai`, `waktu_selesai`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 14, 0, 'Format dokumen', 'Format dokumen yang tidak di tentukan', '2022-05-12 15:53:44', '2022-05-13 17:42:02', '2022-05-12 15:53:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `moduleCode` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`moduleCode`, `module`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Management User', '2022-02-26 02:43:35', '2022-03-24 09:12:18', NULL),
(7, 'Dashboard', '2022-03-24 13:42:33', '2022-03-26 09:45:26', NULL),
(8, 'Kejati', '2022-04-13 10:20:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `isRead` int(11) NOT NULL DEFAULT 0,
  `description` longtext NOT NULL,
  `data` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `from`, `to`, `isRead`, `description`, `data`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 47, 48, 1, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas ST01 dari no pengaduan pe123 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"https:\\/\\/192.168.1.46\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:19:59', NULL, NULL),
(2, 47, 49, 0, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas ST01 dari no pengaduan pe123 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"https:\\/\\/192.168.1.46\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:19:59', NULL, NULL),
(3, 48, 49, 1, 'Anda diberi tugas oleh ketua tim dalam kegiatan Melakukan rapt tindakan permintaan dokumen dengan no surat tugas ST01', '{\"link\":\"https:\\/\\/192.168.1.46\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:21:34', NULL, NULL),
(4, 49, 48, 1, 'Diki mengunggah dokumen hasil rapat dalam kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"https:\\/\\/192.168.1.46\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:22:38', NULL, NULL),
(5, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:26:12', NULL, NULL),
(6, 47, 48, 1, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen ditolak oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:26:43', NULL, NULL),
(7, 47, 49, 1, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen ditolak oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:26:43', NULL, NULL),
(8, 49, 48, 1, 'Diki mengunggah dokumen rev hasil rapat dalam kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:28:19', NULL, NULL),
(9, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:29:11', NULL, NULL),
(10, 47, 48, 1, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:29:42', NULL, NULL),
(11, 47, 49, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.6\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDEpOw%3D%3D\",\"action\":\"detail(1);\"}', '2022-05-11 14:29:42', NULL, NULL),
(12, 47, 48, 1, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas TUG-001 dari no pengaduan PENG-001 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:43:52', NULL, NULL),
(13, 47, 49, 1, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas TUG-001 dari no pengaduan PENG-001 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:43:52', NULL, NULL),
(14, 48, 49, 0, 'Anda diberi tugas oleh ketua tim dalam kegiatan Melakukan rapt tindakan permintaan dokumen dengan no surat tugas TUG-001', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:47:38', NULL, NULL),
(15, 49, 48, 1, 'Diki mengunggah dokumen Hasil Wawancara dalam kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:48:33', NULL, NULL),
(16, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:49:46', NULL, NULL),
(17, 47, 48, 1, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:52:04', NULL, NULL),
(18, 47, 49, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:52:04', NULL, NULL),
(19, 47, 48, 1, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas Tug-02 dari no pengaduan Pe-02 untuk melakukan kegiatan penyelidikan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:15:16', NULL, NULL),
(20, 47, 49, 0, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas Tug-02 dari no pengaduan Pe-02 untuk melakukan kegiatan penyelidikan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:15:16', NULL, NULL),
(21, 47, 51, 0, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas Tug-02 dari no pengaduan Pe-02 untuk melakukan kegiatan penyelidikan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:15:16', NULL, NULL),
(22, 48, 49, 1, 'Anda diberi tugas oleh ketua tim dalam kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data dengan no surat tugas Tug-02', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:36:01', NULL, NULL),
(23, 48, 51, 0, 'Anda diberi tugas oleh ketua tim dalam kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data dengan no surat tugas Tug-02', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:36:01', NULL, NULL),
(24, 49, 48, 1, 'Diki mengunggah dokumen hasil kegiatan 1 dalam kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:37:11', NULL, NULL),
(25, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:39:00', NULL, NULL),
(26, 47, 48, 0, 'Dokumen hasil kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:39:58', NULL, NULL),
(27, 47, 49, 0, 'Dokumen hasil kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:39:58', NULL, NULL),
(28, 47, 51, 1, 'Dokumen hasil kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:39:58', NULL, NULL),
(29, 51, 48, 1, 'Fauzi mengunggah dokumen aas dalam kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-13 11:41:00', NULL, NULL),
(30, 47, 48, 1, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas peng-03 dari no pengaduan Pe-02 untuk melakukan kegiatan penyelidikan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:44:20', NULL, NULL),
(31, 47, 49, 0, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas peng-03 dari no pengaduan Pe-02 untuk melakukan kegiatan penyelidikan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:44:20', NULL, NULL),
(32, 48, 49, 1, 'Anda diberi tugas oleh ketua tim dalam kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data dengan no surat tugas peng-03', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:45:18', NULL, NULL),
(33, 49, 48, 1, 'Diki mengunggah dokumen hasil kegiatan 1 dalam kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:46:00', NULL, NULL),
(34, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:46:45', NULL, NULL),
(35, 47, 48, 0, 'Dokumen hasil kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:47:15', NULL, NULL),
(36, 47, 49, 0, 'Dokumen hasil kegiatan Menerima     Surat     Perintah      Tugas     Pengayaan Informasi/Data diterima oleh atasan ', '{\"link\":\"https:\\/\\/192.168.1.41\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDQpOw%3D%3D\",\"action\":\"detail(4);\"}', '2022-05-13 11:47:15', NULL, NULL),
(37, 47, 48, 0, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas 23 dari no pengaduan pe123 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDYpOw%3D%3D\",\"action\":\"detail(6);\"}', '2022-05-13 15:02:24', NULL, NULL),
(38, 47, 48, 0, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas sad dari no pengaduan pe123 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 15:48:01', NULL, NULL),
(39, 47, 49, 1, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas sad dari no pengaduan pe123 untuk melakukan kegiatan penyelidikan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 15:48:01', NULL, NULL),
(40, 48, 49, 0, 'Anda diberi tugas oleh ketua tim dalam kegiatan Melakukan rapt tindakan permintaan dokumen dengan no surat tugas sad', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:12:51', NULL, NULL),
(41, 48, 49, 1, 'Anda diberi tugas oleh ketua tim dalam kegiatan test dengan no surat tugas sad', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDgpOw%3D%3D\",\"action\":\"detail(8);\"}', '2022-05-13 16:13:08', NULL, NULL),
(42, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDYpOw%3D%3D\",\"action\":\"detail(6);\"}', '2022-05-13 16:36:34', NULL, NULL),
(43, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan test', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDYpOw%3D%3D\",\"action\":\"detail(6);\"}', '2022-05-13 16:36:37', NULL, NULL),
(44, 47, 48, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen ditolak oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:37:00', NULL, NULL),
(45, 47, 49, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen ditolak oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:37:00', NULL, NULL),
(46, 47, 48, 0, 'Dokumen hasil kegiatan test diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDgpOw%3D%3D\",\"action\":\"detail(8);\"}', '2022-05-13 16:37:03', NULL, NULL),
(47, 47, 49, 0, 'Dokumen hasil kegiatan test diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDgpOw%3D%3D\",\"action\":\"detail(8);\"}', '2022-05-13 16:37:03', NULL, NULL),
(48, 47, 48, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:39:39', NULL, NULL),
(49, 47, 49, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:39:39', NULL, NULL),
(50, 47, 48, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:40:12', NULL, NULL),
(51, 47, 49, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:40:12', NULL, NULL),
(52, 47, 48, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:41:23', NULL, NULL),
(53, 47, 49, 0, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 16:41:23', NULL, NULL),
(54, 49, 48, 0, 'Diki mengunggah dokumen asdadas dalam kegiatan test', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDgpOw%3D%3D\",\"action\":\"detail(8);\"}', '2022-05-13 17:22:59', NULL, NULL),
(55, 49, 48, 0, 'Diki mengunggah dokumen asd dalam kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDcpOw%3D%3D\",\"action\":\"detail(7);\"}', '2022-05-13 17:23:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id` int(11) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id`, `pangkat`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Jaksa Madya', '2022-05-11 12:01:49', NULL, NULL),
(2, 'Jaksa Utama', '2022-05-11 12:01:55', NULL, NULL),
(3, 'Jaksa Utama Muda', '2022-05-13 10:26:21', NULL, '2022-05-13 10:42:06'),
(4, 'Jaksa Utama Muda', '2022-05-13 10:43:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `pangkat_id` int(11) DEFAULT NULL,
  `golongan_id` int(11) DEFAULT NULL,
  `userCode` int(11) DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `nip`, `foto`, `jabatan_id`, `pangkat_id`, `golongan_id`, `userCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Ageng', '1139278', '5609c9e93917229302043a1bbef4ccf1.PNG', 2, 2, 1, 47, '2022-05-11 12:02:48', NULL, '2022-05-11 12:03:57'),
(2, 'sukijo', '1244244', '44d93be80503820a09e0ae8d601e5c2e.PNG', 1, 1, 2, 48, '2022-05-11 12:03:13', NULL, '2022-05-11 12:14:13'),
(3, 'Diki', '213452', 'f1927d161241f10eb57646a1cbef5976.PNG', 1, 1, 2, 49, '2022-05-11 12:03:34', '2022-05-11 12:14:06', '2022-05-11 12:14:16'),
(4, 'ageng', '1234244', '0cad15c4dacfe38d33ed5ebd2ee1ff49.PNG', 2, 2, 1, 47, '2022-05-11 12:15:27', NULL, NULL),
(5, 'sukijo', '3124111', '5eb1665c6d2ecbbe31776973b02bd004.PNG', 1, 1, 2, 48, '2022-05-11 12:15:55', NULL, NULL),
(6, 'Diki', '341243445', '58d0f655f28fdc03071121e346dc1aa1.PNG', 1, 1, 2, 49, '2022-05-11 12:16:23', '2022-05-11 12:24:24', '2022-05-11 12:24:33'),
(7, 'Diki', '313124214', '556212dbbfd84a192f661f1d4bb470e1.PNG', 1, 1, 2, 49, '2022-05-11 12:25:08', NULL, '2022-05-11 14:10:29'),
(8, 'Diki', '1242145', '7a4fb7060d5075d9a9c5978a59413b29.PNG', 1, 1, 2, 49, '2022-05-11 14:11:48', NULL, NULL),
(9, 'Fauzi', '122444', '333b61d3ea14f93f91e9ac63ba932b92.PNG', 3, 3, 3, 51, '2022-05-13 10:27:16', NULL, '2022-05-13 10:42:14'),
(10, 'Fauzi', '32335656', '2ad58d6c891da5f4182d2ae59d4d1fe0.PNG', 4, 4, 4, 51, '2022-05-13 10:44:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_detail_tugas`
--

CREATE TABLE `pegawai_detail_tugas` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `detail_tugas_id` int(11) NOT NULL,
  `leader` int(1) NOT NULL,
  `tugas` longtext DEFAULT NULL,
  `dokumen` longtext DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai_detail_tugas`
--

INSERT INTO `pegawai_detail_tugas` (`id`, `pegawai_id`, `detail_tugas_id`, `leader`, `tugas`, `dokumen`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 5, 1, 1, NULL, NULL, '2022-05-11 14:19:59', NULL, NULL),
(2, 8, 1, 0, 'rev rapat tindakan', '[{\"nama\":\"hasil rapat\",\"dokumen\":\"7c270dc8513babe61972a9bde496324f.PNG\"},{\"nama\":\"rev hasil rapat\",\"dokumen\":\"dd38ba9a4cdfd60fc1653b051743d90a.PNG\"}]', '2022-05-11 14:19:59', NULL, NULL),
(3, 5, 2, 1, NULL, NULL, '2022-05-11 16:43:52', NULL, NULL),
(4, 8, 2, 0, 'Buat hasil wawancara', '[{\"nama\":\"Hasil Wawancara\",\"dokumen\":\"3d5aad670fae6ef1473bd5e441efe73e.png\"}]', '2022-05-11 16:43:52', NULL, NULL),
(5, 5, 3, 1, NULL, NULL, '2022-05-13 11:15:16', NULL, NULL),
(6, 8, 3, 0, 'kerjakan kegiatan 1', '[{\"nama\":\"hasil kegiatan 1\",\"dokumen\":\"d1015e857e1da7577822448c57477a36.PNG\"}]', '2022-05-13 11:15:16', NULL, NULL),
(7, 10, 3, 0, 'Kerjakan Kegiatan 2', '[{\"nama\":\"aas\",\"dokumen\":\"f757125bead0c19d5ec4f0f8d5163744.PNG\"}]', '2022-05-13 11:15:16', NULL, NULL),
(8, 5, 4, 1, NULL, NULL, '2022-05-13 11:44:20', NULL, NULL),
(9, 8, 4, 0, 'Kerjakan kegiatan 1', '[{\"nama\":\"hasil kegiatan 1\",\"dokumen\":\"6fd2e98ef7647a8647280092f80eb970.jpg\"}]', '2022-05-13 11:44:20', NULL, NULL),
(10, 5, 5, 1, NULL, NULL, '2022-05-13 13:50:02', NULL, NULL),
(11, 8, 5, 0, NULL, NULL, '2022-05-13 13:50:02', NULL, NULL),
(12, 5, 6, 1, NULL, NULL, '2022-05-13 15:02:24', NULL, NULL),
(13, 5, 7, 1, NULL, NULL, '2022-05-13 15:48:01', NULL, NULL),
(14, 8, 7, 0, 'buat laporan 2', '[{\"nama\":\"asd\",\"dokumen\":\"b0290ece6d92a4704f8df9a9ec84c1e6.png\"}]', '2022-05-13 15:48:01', NULL, NULL),
(15, 5, 8, 1, NULL, NULL, '2022-05-13 15:50:44', NULL, NULL),
(16, 8, 8, 0, 'Buat laporan 3', '[{\"nama\":\"asdadas\",\"dokumen\":\"8aaa705d8616a2d895652267d5fd6b62.png\"}]', '2022-05-13 15:50:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `no` varchar(100) NOT NULL,
  `tanggal_surat` datetime NOT NULL,
  `tanggal_terima` datetime NOT NULL,
  `asal_surat` varchar(100) NOT NULL,
  `perihal` longtext NOT NULL,
  `isi` longtext NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `no`, `tanggal_surat`, `tanggal_terima`, `asal_surat`, `perihal`, `isi`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'pe123', '2022-05-10 00:00:00', '2022-05-11 00:00:00', 'dinas aaa', 'ini perihall surat', 'isi surat', '2022-05-11 14:17:36', NULL, NULL),
(2, 'PENG-001', '2022-05-16 00:00:00', '2022-05-14 00:00:00', 'Departement Hukum', 'Perihal pengaduan KDRT', 'Membutuhkan tindak lanjut untuk masalah KDRT', '2022-05-11 16:39:10', NULL, NULL),
(3, 'Peng-02', '2022-05-10 00:00:00', '2022-05-13 00:00:00', 'Departement Hukum', 'Pembunuhan Berencana', 'Mohon Segera di tindak Lanjuti', '2022-05-13 10:58:34', NULL, '2022-05-13 10:59:26'),
(4, 'Peng-02', '2022-05-09 00:00:00', '2022-05-13 00:00:00', 'Departement Hukum', 'Pembunuhan Berencana', 'Segera Ditindak Lanjuti', '2022-05-13 11:00:21', NULL, '2022-05-13 11:01:57'),
(5, 'Pe-02', '2022-05-09 00:00:00', '2022-05-13 00:00:00', 'Departement Hukum', 'Pembunuhan Berencana', 'Membutuhkan Tindak Lanjut', '2022-05-13 11:02:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permissionCode` int(11) NOT NULL,
  `permission` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `moduleCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permissionCode`, `permission`, `description`, `moduleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'RU', 'See user', 1, '2022-02-26 02:53:01', '2022-03-24 09:13:33', NULL),
(2, 'CU', 'Create user', 1, '2022-02-26 02:53:01', NULL, NULL),
(3, 'UU', 'Update user', 1, '2022-02-26 02:54:08', NULL, NULL),
(4, 'DU', 'Delete user', 1, '2022-02-26 02:54:08', NULL, NULL),
(5, 'RR', 'See role', 1, '2022-02-26 02:53:01', '2022-03-24 09:15:58', NULL),
(6, 'CR', 'Create role', 1, '2022-02-26 02:53:01', '2022-03-24 09:15:58', NULL),
(7, 'UR', 'Update role', 1, '2022-02-26 02:54:08', '2022-03-24 09:15:58', NULL),
(8, 'DR', 'Delete role', 1, '2022-02-26 02:54:08', '2022-03-24 09:15:58', NULL),
(9, 'RRU', 'See all role of user', 1, '2022-02-26 02:53:01', '2022-03-24 09:15:58', NULL),
(10, 'CRU', 'Add role of user', 1, '2022-02-26 02:53:01', '2022-03-28 13:10:19', NULL),
(12, 'DRU', 'Delete role of user', 1, '2022-02-26 02:54:08', '2022-03-24 09:15:58', NULL),
(13, 'RRP', 'See all role permission', 1, '2022-02-26 02:53:01', '2022-03-24 09:15:58', NULL),
(14, 'CRP', 'Add role permission', 1, '2022-02-26 02:53:01', '2022-03-28 13:10:26', NULL),
(16, 'DRP', 'Delete role permission', 1, '2022-02-26 02:54:08', '2022-03-24 09:15:58', NULL),
(17, 'RUP', 'See all special permission of user', 1, '2022-02-26 02:53:01', '2022-03-25 14:43:01', NULL),
(18, 'CUP', 'Add special permission of user', 1, '2022-02-26 02:53:01', '2022-03-28 13:10:35', NULL),
(20, 'DUP', 'Delete special permission of user', 1, '2022-02-26 02:54:08', '2022-03-24 12:03:52', NULL),
(22, 'RP', 'See permission', 1, '2022-03-24 09:15:04', NULL, NULL),
(23, 'RDASH', 'See dashboard', 7, '2022-03-24 13:42:54', '2022-03-25 14:43:07', NULL),
(24, 'RJABATAN', 'Lihat semua jabatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(25, 'RPANGKAT', 'Lihat semua pangkat', 8, '2022-02-26 02:53:01', NULL, NULL),
(26, 'RGOLONGAN', 'Lihat semua golongan', 8, '2022-02-26 02:53:01', NULL, NULL),
(27, 'CGOLONGAN', 'Tambah golongan', 8, '2022-02-26 02:53:01', NULL, NULL),
(28, 'UGOLONGAN', 'Ubah golongan', 8, '2022-02-26 02:53:01', NULL, NULL),
(29, 'DGOLONGAN', 'Hapus golongan', 8, '2022-02-26 02:53:01', NULL, NULL),
(30, 'CPANGKAT', 'Tambah pangkat', 8, '2022-02-26 02:53:01', NULL, NULL),
(31, 'UPANGKAT', 'Ubah pangkat', 8, '2022-02-26 02:53:01', NULL, NULL),
(32, 'DPANGKAT', 'Hapus pangkat', 8, '2022-02-26 02:53:01', NULL, NULL),
(33, 'CJABATAN', 'Tambah jabatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(34, 'UJABATAN', 'Ubah jabatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(35, 'DJABATAN', 'Hapus jabatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(36, 'RPEGAWAI', 'Lihat semua pegawai', 8, '2022-02-26 02:53:01', NULL, NULL),
(37, 'CPEGAWAI', 'Tambah pegawai', 8, '2022-02-26 02:53:01', NULL, NULL),
(38, 'UPEGAWAI', 'Ubah pegawai', 8, '2022-02-26 02:53:01', NULL, NULL),
(39, 'DPEGAWAI', 'Hapus pegawai', 8, '2022-02-26 02:53:01', NULL, NULL),
(40, 'RSOP', 'Lihat semua SOP', 8, '2022-02-26 02:53:01', NULL, NULL),
(41, 'CSOP', 'Tambah SOP', 8, '2022-02-26 02:53:01', NULL, NULL),
(42, 'USOP', 'Ubah SOP', 8, '2022-02-26 02:53:01', NULL, NULL),
(43, 'DSOP', 'Hapus SOP', 8, '2022-02-26 02:53:01', NULL, NULL),
(44, 'RKEGIATAN', 'Lihat semua kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(45, 'CKEGIATAN', 'Tambah kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(46, 'UKEGIATAN', 'Ubah kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(47, 'DKEGIATAN', 'Hapus kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(48, 'RPENYELIDIKAN', 'Lihat semua penyelidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(49, 'CPENYELIDIKAN', 'Tambah penyelidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(50, 'UPENYELIDIKAN', 'Ubah penyelidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(51, 'DPENYELIDIKAN', 'Hapus penyelidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(52, 'RPENGADUAN', 'Lihat semua pengaduan', 8, '2022-02-26 02:53:01', NULL, NULL),
(53, 'CPENGADUAN', 'Tambah pengaduan', 8, '2022-02-26 02:53:01', NULL, NULL),
(54, 'UPENGADUAN', 'Ubah pengaduan', 8, '2022-02-26 02:53:01', NULL, NULL),
(55, 'DPENGADUAN', 'Hapus pengaduan', 8, '2022-02-26 02:53:01', NULL, NULL),
(56, 'RPENYIDIKAN', 'Lihat semua penyidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(57, 'CPENYIDIKAN', 'Tambah penyidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(58, 'UPENYIDIKAN', 'Ubah penyidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(59, 'DPENYIDIKAN', 'Hapus penyidikan', 8, '2022-02-26 02:53:01', NULL, NULL),
(60, 'RDETAILKEGIATAN', 'Lihat semua detail kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(61, 'CDETAILKEGIATAN', 'Tambah detail kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(62, 'UDETAILKEGIATAN', 'Ubah detail kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(63, 'DDETAILKEGIATAN', 'Hapus detail kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(64, 'RKELENGKAPANKEGIATAN', 'Lihat semua kelengkapan kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(65, 'CKELENGKAPANKEGIATAN', 'Tambah kelengkapan kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(66, 'UKELENGKAPANKEGIATAN', 'Ubah kelengkapan kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(67, 'DKELENGKAPANKEGIATAN', 'Hapus kelengkapan kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(68, 'RHASILKEGIATAN', 'Lihat semua hasil kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(69, 'CHASILKEGIATAN', 'Tambah hasil kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(70, 'UHASILKEGIATAN', 'Ubah hasil kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(71, 'DHASILKEGIATAN', 'Hapus hasil kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL),
(74, 'RDETAILTUGASSELF', 'Lihat detail tugas untuk jaksa', 8, '2022-04-24 22:43:58', NULL, NULL),
(75, 'RDETAILPENYELIDIKAN', 'Lihat semua detail tugas penyelidikan', 8, '2022-04-24 22:43:58', NULL, NULL),
(76, 'RTUGASSELF', 'Lihat tugas untuk jaksa', 8, '2022-04-24 22:43:58', NULL, NULL),
(77, 'RDETAILPENYIDIKAN', 'Lihat semua detail tugas penyidikan', 8, '2022-04-24 22:43:58', NULL, NULL),
(78, 'RDASHSELF', 'Lihat dashboard untuk jaksa', 8, '2022-04-24 22:43:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleCode` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleCode`, `role`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Super Admin', '2022-02-26 03:06:51', NULL, NULL),
(2, 'Pimpinan', '2022-04-28 13:15:44', NULL, NULL),
(3, 'Jaksa', '2022-04-28 13:15:51', NULL, NULL),
(4, 'Jaksa Muda', '2022-05-13 09:57:09', NULL, '2022-05-13 10:23:15'),
(5, 'Jaksa Muda', '2022-05-13 10:23:33', NULL, '2022-05-13 15:04:10'),
(6, 'Jaksa Muda', '2022-05-13 15:05:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `rpCode` int(11) NOT NULL,
  `permissionCode` int(11) NOT NULL,
  `roleCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`rpCode`, `permissionCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(78, 1, 1, '2022-04-11 14:32:14', NULL, NULL),
(79, 2, 1, '2022-04-11 14:32:14', NULL, NULL),
(80, 3, 1, '2022-04-11 14:32:14', NULL, NULL),
(81, 4, 1, '2022-04-11 14:32:14', NULL, NULL),
(82, 5, 1, '2022-04-11 14:32:14', NULL, NULL),
(83, 6, 1, '2022-04-11 14:32:14', NULL, NULL),
(84, 7, 1, '2022-04-11 14:32:14', NULL, NULL),
(85, 8, 1, '2022-04-11 14:32:14', NULL, NULL),
(86, 9, 1, '2022-04-11 14:32:14', NULL, NULL),
(87, 10, 1, '2022-04-11 14:32:14', NULL, NULL),
(88, 12, 1, '2022-04-11 14:32:14', NULL, NULL),
(89, 13, 1, '2022-04-11 14:32:14', NULL, NULL),
(90, 14, 1, '2022-04-11 14:32:14', NULL, NULL),
(91, 16, 1, '2022-04-11 14:32:14', NULL, NULL),
(92, 17, 1, '2022-04-11 14:32:14', NULL, NULL),
(93, 18, 1, '2022-04-11 14:32:14', NULL, NULL),
(94, 20, 1, '2022-04-11 14:32:14', NULL, NULL),
(95, 22, 1, '2022-04-11 14:32:14', NULL, NULL),
(96, 23, 1, '2022-04-11 14:32:14', NULL, NULL),
(97, 24, 1, '2022-04-13 10:22:52', NULL, NULL),
(98, 25, 1, '2022-04-13 10:22:57', NULL, NULL),
(99, 26, 1, '2022-04-13 10:23:01', NULL, NULL),
(100, 27, 1, '2022-04-13 14:46:37', NULL, NULL),
(101, 28, 1, '2022-04-13 14:46:42', NULL, NULL),
(102, 29, 1, '2022-04-13 14:46:47', NULL, NULL),
(103, 30, 1, '2022-04-13 14:46:53', NULL, NULL),
(104, 31, 1, '2022-04-13 14:46:57', NULL, NULL),
(105, 32, 1, '2022-04-13 14:47:06', NULL, NULL),
(106, 33, 1, '2022-04-13 14:47:21', NULL, NULL),
(107, 34, 1, '2022-04-13 14:47:25', NULL, NULL),
(108, 35, 1, '2022-04-13 14:47:29', NULL, NULL),
(109, 36, 1, '2022-04-14 10:22:29', NULL, NULL),
(110, 37, 1, '2022-04-14 10:22:37', NULL, NULL),
(111, 38, 1, '2022-04-14 10:22:43', NULL, NULL),
(112, 39, 1, '2022-04-14 10:22:50', NULL, NULL),
(113, 40, 1, '2022-04-14 13:30:37', NULL, NULL),
(114, 41, 1, '2022-04-14 13:30:43', NULL, NULL),
(115, 42, 1, '2022-04-14 13:30:50', NULL, NULL),
(116, 43, 1, '2022-04-14 13:30:57', NULL, NULL),
(117, 44, 1, '2022-04-14 14:12:53', NULL, NULL),
(118, 45, 1, '2022-04-14 14:12:59', NULL, NULL),
(119, 46, 1, '2022-04-14 14:13:08', NULL, NULL),
(120, 47, 1, '2022-04-14 14:13:13', NULL, NULL),
(121, 48, 1, '2022-04-22 08:45:06', NULL, NULL),
(122, 49, 1, '2022-04-22 08:45:15', NULL, NULL),
(123, 51, 1, '2022-04-22 08:45:22', NULL, NULL),
(124, 50, 1, '2022-04-22 08:45:34', NULL, NULL),
(125, 52, 1, '2022-04-22 08:48:19', NULL, NULL),
(126, 53, 1, '2022-04-22 08:48:26', NULL, NULL),
(127, 54, 1, '2022-04-22 08:48:33', NULL, NULL),
(128, 55, 1, '2022-04-22 08:48:39', NULL, NULL),
(129, 56, 1, '2022-04-24 10:56:16', NULL, NULL),
(130, 57, 1, '2022-04-24 10:56:25', NULL, NULL),
(131, 58, 1, '2022-04-24 10:56:33', NULL, NULL),
(132, 59, 1, '2022-04-24 10:56:46', NULL, NULL),
(133, 60, 1, '2022-04-24 11:03:52', NULL, NULL),
(134, 61, 1, '2022-04-24 11:04:00', NULL, NULL),
(135, 62, 1, '2022-04-24 11:04:08', NULL, NULL),
(136, 63, 1, '2022-04-24 11:04:16', NULL, NULL),
(137, 64, 1, '2022-04-24 11:08:13', NULL, NULL),
(138, 65, 1, '2022-04-24 11:08:21', NULL, NULL),
(139, 66, 1, '2022-04-24 11:08:28', NULL, NULL),
(140, 67, 1, '2022-04-24 11:08:35', NULL, NULL),
(141, 68, 1, '2022-04-24 11:08:42', NULL, NULL),
(142, 69, 1, '2022-04-24 11:08:50', NULL, NULL),
(143, 70, 1, '2022-04-24 11:08:56', NULL, NULL),
(144, 71, 1, '2022-04-24 11:09:05', NULL, NULL),
(145, 75, 1, '2022-04-24 22:44:29', NULL, NULL),
(146, 76, 1, '2022-04-25 01:09:40', NULL, NULL),
(147, 77, 1, '2022-04-26 13:04:15', NULL, NULL),
(148, 74, 1, '2022-04-26 13:53:52', NULL, NULL),
(149, 23, 2, '2022-04-28 13:16:03', NULL, NULL),
(150, 48, 2, '2022-04-28 13:16:25', NULL, NULL),
(151, 49, 2, '2022-04-28 13:16:41', NULL, NULL),
(152, 50, 2, '2022-04-28 13:16:49', NULL, NULL),
(153, 51, 2, '2022-04-28 13:16:59', NULL, NULL),
(154, 52, 2, '2022-04-28 13:17:16', NULL, NULL),
(155, 53, 2, '2022-04-28 13:17:25', NULL, NULL),
(156, 54, 2, '2022-04-28 13:17:35', NULL, NULL),
(157, 55, 2, '2022-04-28 13:17:44', NULL, NULL),
(158, 56, 2, '2022-04-28 13:17:52', NULL, NULL),
(159, 57, 2, '2022-04-28 13:18:01', NULL, NULL),
(160, 58, 2, '2022-04-28 13:18:08', NULL, NULL),
(161, 59, 2, '2022-04-28 13:18:15', NULL, NULL),
(162, 77, 2, '2022-04-28 13:18:22', NULL, NULL),
(163, 75, 2, '2022-04-28 13:18:29', NULL, NULL),
(164, 76, 3, '2022-04-28 13:18:49', NULL, NULL),
(165, 77, 3, '2022-04-28 13:18:55', NULL, NULL),
(166, 23, 3, '2022-04-28 13:28:44', NULL, NULL),
(167, 74, 3, '2022-05-02 22:17:24', NULL, NULL),
(168, 23, 4, '2022-05-13 09:57:27', NULL, NULL),
(169, 76, 4, '2022-05-13 09:57:52', NULL, NULL),
(170, 76, 5, '2022-05-13 10:23:51', NULL, NULL),
(171, 23, 5, '2022-05-13 10:23:59', NULL, NULL),
(172, 25, 5, '2022-05-13 10:24:08', NULL, NULL),
(173, 78, 3, '2022-05-13 12:48:05', NULL, NULL),
(174, 23, 6, '2022-05-13 15:06:34', NULL, '2022-05-13 15:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `ruCode` int(11) NOT NULL,
  `userCode` int(11) NOT NULL,
  `roleCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`ruCode`, `userCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 36, 1, '2022-02-26 03:19:11', NULL, NULL),
(14, 47, 2, '2022-05-11 12:00:27', NULL, NULL),
(15, 48, 3, '2022-05-11 12:01:00', NULL, NULL),
(16, 49, 3, '2022-05-11 12:01:10', NULL, NULL),
(17, 48, 2, '2022-05-11 16:36:20', NULL, '2022-05-11 16:36:24'),
(18, 50, 3, '2022-05-13 09:56:31', NULL, NULL),
(19, 51, 3, '2022-05-13 10:22:48', NULL, NULL),
(20, 52, 3, '2022-05-13 14:48:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sop`
--

CREATE TABLE `sop` (
  `id` int(11) NOT NULL,
  `sop` varchar(255) NOT NULL,
  `kategori` enum('Penyelidikan','Penyidikan') NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sop`
--

INSERT INTO `sop` (`id`, `sop`, `kategori`, `waktu`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '', '2022-05-11 12:16:54', NULL, '2022-05-11 12:21:47'),
(3, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '', '2022-05-11 12:21:54', '2022-05-11 12:22:01', '2022-05-11 12:24:03'),
(4, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '0', '2022-05-11 12:25:35', NULL, '2022-05-11 14:10:36'),
(5, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '72', '2022-05-11 14:12:53', NULL, NULL),
(6, 'PELAKSANAAN TUGAS PENGAYAAN INFORMASI /DATA', 'Penyelidikan', '32', '2022-05-12 13:48:37', NULL, NULL),
(7, 'PELAKSANAAN TUGAS PENGAYAAN INFORMASI /DATA', 'Penyelidikan', '22', '2022-05-12 13:54:02', NULL, NULL),
(8, 'PELAKSANAAN TUGAS PENGAYAAN INFORMASI /DATA', 'Penyelidikan', '57', '2022-05-12 14:01:29', NULL, NULL),
(9, 'Pelaksaan Penyidikan', 'Penyidikan', '40', '2022-05-13 10:27:40', NULL, '2022-05-13 10:42:19'),
(10, 'Pelaksanaan Penyidikan', 'Penyidikan', '120', '2022-05-13 10:47:17', NULL, NULL),
(11, 'Pelaksanaan Pengayaan Informasi/Data', 'Penyelidikan', '4440', '2022-05-13 10:51:21', NULL, '2022-05-13 11:10:49'),
(12, 'Nota Pendapat Tindakan Penyelidikan', 'Penyelidikan', '720', '2022-05-13 11:20:14', NULL, '2022-05-13 11:22:13'),
(13, 'Nota Pendapat Tindakan Penyelidikan', 'Penyelidikan', '300', '2022-05-13 11:22:39', NULL, NULL),
(14, 'Permintaan Keterangan', 'Penyelidikan', '4440', '2022-05-13 11:27:40', NULL, NULL),
(15, 'Pemeriksaan Saksi', 'Penyidikan', '30', '2022-05-13 14:13:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tembusan`
--

CREATE TABLE `tembusan` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `tembusan` varchar(100) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tembusan`
--

INSERT INTO `tembusan` (`id`, `tugas_id`, `tembusan`, `no_urut`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 'aa', 1, '2022-05-11 14:19:59', NULL, NULL),
(2, 2, '', 1, '2022-05-11 16:43:52', NULL, NULL),
(3, 3, '', 1, '2022-05-13 11:15:16', NULL, NULL),
(4, 4, '', 1, '2022-05-13 11:44:20', NULL, NULL),
(5, 5, '', 1, '2022-05-13 15:02:24', NULL, NULL),
(6, 6, '', 1, '2022-05-13 15:48:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `sop_id` int(11) NOT NULL,
  `no_surat_tugas` varchar(100) NOT NULL,
  `pengaduan_id` int(11) DEFAULT NULL,
  `no_nota_dinas` varchar(100) NOT NULL,
  `tanggal_nota_dinas` datetime NOT NULL,
  `perihal_nota_dinas` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `userCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `sop_id`, `no_surat_tugas`, `pengaduan_id`, `no_nota_dinas`, `tanggal_nota_dinas`, `perihal_nota_dinas`, `status`, `userCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 5, 'ST01', 1, '123', '2022-05-11 00:00:00', 'ini perihal', 'Dalam proses', 47, '2022-05-11 14:19:59', NULL, NULL),
(2, 5, 'TUG-001', 2, 'TUG-001-DIN', '2022-05-19 00:00:00', 'Tugas nota dinas', 'Dalam proses', 47, '2022-05-11 16:43:52', NULL, NULL),
(3, 6, 'Tug-02', 5, 'No 1221', '2022-05-13 00:00:00', 'ini perihal', 'Dalam proses', 47, '2022-05-13 11:15:16', NULL, NULL),
(4, 6, 'peng-03', 5, 'no134', '2022-05-13 00:00:00', 'ini perihal', 'Dalam proses', 47, '2022-05-13 11:44:20', NULL, NULL),
(5, 5, '23', 1, '123', '2022-05-21 00:00:00', 'asd', 'Dalam proses', 47, '2022-05-13 15:02:24', NULL, NULL),
(6, 5, 'sad', 1, 'asd', '2022-05-14 00:00:00', 'asd', 'Dalam proses', 47, '2022-05-13 15:48:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userCode` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userCode`, `name`, `photo`, `email`, `password`, `isActive`, `createAt`, `updateAt`, `deleteAt`) VALUES
(36, 'Super Admin', NULL, 'su@mail.com', '$2y$10$gcyea6ojs.giz4zRA3V5Uewlucm2aHOp1ULakUd8GhBXAb0xF6eC6', 1, '2022-02-26 03:18:28', '2022-03-24 13:32:26', NULL),
(47, 'ageng', NULL, 'ageng@mail.com', '$2y$10$WefoZjJLah1Sgq.3AeZtAe64P2iVUEoOzXE5yNc9AKMePv2JI2sou', 1, '2022-05-11 12:00:18', NULL, NULL),
(48, 'sukijo', NULL, 'sukijo@mail.com', '$2y$10$icny1UwW0gUju3Z.bjSkyeOXoJgIX/A3Y74eRK.fZH53J6S.xxCeG', 1, '2022-05-11 12:00:40', NULL, NULL),
(49, 'Diki', NULL, 'diki@mail.com', '$2y$10$zxk9oWi4ijpx9hAFnW3L/.px7hZICAS17YUk/GWdm4mwWNya3Nf/q', 1, '2022-05-11 12:00:52', NULL, NULL),
(50, 'Fauzi', NULL, 'fa@mail.com', '$2y$10$mkMi2HTzZVJaJJMl0hgUleNUqmxBYxvhnAQW5kZBNIvfEmrWoP8RS', 1, '2022-05-13 09:56:17', NULL, '2022-05-13 10:21:26'),
(51, 'fauzi', NULL, 'fau@mail.com', '$2y$10$eFgqARfEcANVodIjmbgazOmgSm0Da2qF4x4hIlZf9ha.qAMMsLt.C', 1, '2022-05-13 10:22:37', NULL, NULL),
(52, 'Achmad', NULL, 'ac@mail.com', '$2y$10$3YrYFX0TSP1tV/PHkpP3dOOiLzGili04CvOYYWziYbGBUn.VoHF4.', 1, '2022-05-13 14:48:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `upCode` int(11) NOT NULL,
  `userCode` int(11) NOT NULL,
  `permissionCode` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_data`
--
ALTER TABLE `hasil_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`),
  ADD KEY `hasil_kegiatan_id` (`hasil_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sop_id` (`sop_id`);

--
-- Indexes for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`),
  ADD KEY `kelengkapan_id` (`kelengkapan_id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`moduleCode`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_id` (`jabatan_id`),
  ADD KEY `pangkat_id` (`pangkat_id`),
  ADD KEY `golongan_id` (`golongan_id`);

--
-- Indexes for table `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaksa_tugas_id` (`pegawai_id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permissionCode`),
  ADD KEY `moduleCode` (`moduleCode`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleCode`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`rpCode`),
  ADD KEY `permissionCode` (`permissionCode`),
  ADD KEY `roleCode` (`roleCode`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`ruCode`),
  ADD KEY `userCode` (`userCode`),
  ADD KEY `roleCode` (`roleCode`);

--
-- Indexes for table `sop`
--
ALTER TABLE `sop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tembusan`
--
ALTER TABLE `tembusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sop_id` (`sop_id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userCode`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`upCode`),
  ADD KEY `userCode` (`userCode`),
  ADD KEY `permissionCode` (`permissionCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hasil_data`
--
ALTER TABLE `hasil_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `moduleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `rpCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `ruCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sop`
--
ALTER TABLE `sop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tembusan`
--
ALTER TABLE `tembusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `upCode` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  ADD CONSTRAINT `detail_tugas_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`),
  ADD CONSTRAINT `detail_tugas_ibfk_2` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`);

--
-- Constraints for table `hasil_data`
--
ALTER TABLE `hasil_data`
  ADD CONSTRAINT `hasil_data_ibfk_1` FOREIGN KEY (`detail_tugas_id`) REFERENCES `detail_tugas` (`id`),
  ADD CONSTRAINT `hasil_data_ibfk_2` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id`);

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`sop_id`) REFERENCES `sop` (`id`);

--
-- Constraints for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  ADD CONSTRAINT `kelengkapan_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`);

--
-- Constraints for table `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  ADD CONSTRAINT `kelengkapan_data_ibfk_1` FOREIGN KEY (`detail_tugas_id`) REFERENCES `detail_tugas` (`id`),
  ADD CONSTRAINT `kelengkapan_data_ibfk_2` FOREIGN KEY (`kelengkapan_id`) REFERENCES `kelengkapan` (`id`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`pangkat_id`) REFERENCES `pangkat` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`golongan_id`) REFERENCES `golongan` (`id`);

--
-- Constraints for table `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  ADD CONSTRAINT `pegawai_detail_tugas_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `pegawai_detail_tugas_ibfk_2` FOREIGN KEY (`detail_tugas_id`) REFERENCES `detail_tugas` (`id`);

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`moduleCode`) REFERENCES `module` (`moduleCode`);

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`),
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`);

--
-- Constraints for table `tembusan`
--
ALTER TABLE `tembusan`
  ADD CONSTRAINT `tembusan_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`sop_id`) REFERENCES `sop` (`id`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`);

--
-- Constraints for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  ADD CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
