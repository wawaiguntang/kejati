-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2022 at 11:15 AM
-- Server version: 10.3.35-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmanfqxr_kejati`
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
  `deleteAt` datetime DEFAULT NULL,
  `catatan` text NOT NULL,
  `umum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'IVA', '2022-05-11 12:02:17', NULL, NULL);

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
(12, 'Surat perintah tugas pengayaan informasi/ data diterima', 10, '2022-05-23 19:27:22', NULL, NULL),
(13, 'Notulen rapat', 11, '2022-05-23 19:28:15', NULL, NULL),
(14, 'Rencana kegiatan pelaksanaan tugas  pengayaan informasi / data', 11, '2022-05-23 19:28:34', NULL, NULL),
(15, 'Nota dinas laporan hasil pelaksanaan tugas pengayaan informasi/data', 22, '2022-05-23 19:47:51', NULL, NULL),
(16, 'Laporan hasil pelaksanaan tugas pengayaan informasi/data diterima', 23, '2022-05-23 19:50:50', NULL, NULL),
(17, 'Surat   perintah penyelidikan', 24, '2022-05-23 19:54:07', NULL, NULL),
(18, 'Nota dinas telaahan atas laporan pengaduan Masyarakat diterima', 24, '2022-05-23 19:54:07', NULL, NULL),
(19, 'Notulen rapat', 25, '2022-05-23 19:56:07', NULL, NULL),
(20, 'Rencana penyelidikan', 25, '2022-05-23 19:56:07', NULL, NULL),
(21, 'Nota pendapat untuk melakukan tindakan penyelidikan', 26, '2022-05-23 20:02:42', NULL, NULL),
(22, 'Nota pendapat untuk melakukan tindakan penyelidikan terkirim', 27, '2022-05-23 20:04:20', NULL, NULL),
(23, 'Disposisi atas nota pendapat tindakan permintaan keterangan diterima.', 28, '2022-05-23 20:07:21', NULL, NULL),
(24, 'Notulen rapat tim penyelidik', 29, '2022-05-23 20:09:36', NULL, NULL),
(25, 'Surat panggilan permintaan keterangan', 29, '2022-05-23 20:09:36', NULL, NULL),
(26, 'Surat Perintah Tugas Pengelolaan BBE diterima', 30, '2022-05-24 00:27:11', NULL, NULL),
(27, 'Barang Bukti Elektronik', 32, '2022-05-24 00:31:02', NULL, NULL),
(28, 'Barang Bukti Elektronik Terinventarisasi dalam Daftar', 33, '2022-05-24 00:33:37', NULL, NULL),
(29, 'Barang Bukti Elektronik terklasifikasi menurut jenis', 34, '2022-05-24 00:37:25', NULL, NULL),
(30, ' jumlah dan kondisi barang bukti  dalam Daftar Klasifikasi Barang Bukti', 34, '2022-05-24 00:37:25', NULL, NULL),
(31, 'Barang Bukti Elektronik Terkelola', 35, '2022-05-24 00:42:43', NULL, NULL),
(32, 'Tugas dan Kewenangan Pengelolaan Barang Bukti Elektronik', 36, '2022-05-24 00:44:48', NULL, NULL),
(33, 'Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti Elektronik', 37, '2022-05-24 00:47:15', NULL, NULL),
(34, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti ELektronik diterima Pengendali s', 38, '2022-05-24 00:52:04', NULL, NULL),
(35, 'Surat Perintah Pengelolaan Barang Bukti diterima', 40, '2022-05-24 00:55:49', NULL, NULL),
(36, 'Daftar hadir saksi', 39, '2022-05-24 00:56:06', NULL, NULL),
(37, 'Jadwal Pengelolaan Barang Bukti ', 41, '2022-05-24 00:57:37', NULL, NULL),
(38, 'Saksi mengerti tentang maksud dan tujuan saksi diperiksa', 42, '2022-05-24 00:58:05', NULL, NULL),
(39, 'Barang Bukti ', 43, '2022-05-24 00:59:01', NULL, NULL),
(40, 'Daftar Barang Bukti ', 43, '2022-05-24 00:59:01', NULL, NULL),
(41, 'Blanko data informasi saksi terisi', 44, '2022-05-24 00:59:12', NULL, NULL),
(42, 'Barang Bukti Terinventarisasi dalam daftar Inventaris Barang Bukti ', 45, '2022-05-24 01:00:39', NULL, NULL),
(43, 'Barang Bukti terklasifikasi menurut jenis', 46, '2022-05-24 01:02:56', NULL, NULL),
(44, ' jumlah dan kondisi barang bukti dalam Daftar Klasifikasi Barang Bukti', 46, '2022-05-24 01:02:56', NULL, NULL),
(45, 'Berita acara pemeriksaan saksi', 47, '2022-05-24 01:02:59', NULL, NULL),
(46, 'Berita acara pemeriksaan saksi terperiksa', 48, '2022-05-24 01:04:29', NULL, NULL),
(47, 'Berita acara pemeriksaan saksi tercetak', 49, '2022-05-24 01:06:10', NULL, NULL),
(48, 'Barang Bukti Terkelola', 50, '2022-05-24 01:07:44', NULL, NULL),
(49, 'Berita acara pemeriksaan saksi ditandatangan oleh saksi dan penyidik', 51, '2022-05-24 01:07:44', NULL, NULL),
(50, 'Tugas dan Kewenangan ', 52, '2022-05-24 01:08:57', NULL, NULL),
(51, 'Ahli mengerti tentang tujuan pemeriksaan saksi', 53, '2022-05-24 01:09:55', NULL, NULL),
(52, 'Berita Acara Pengambilan Sumpah/Janji Orang Ahli', 54, '2022-05-24 01:10:38', NULL, NULL),
(53, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti ', 55, '2022-05-24 01:10:55', NULL, NULL),
(54, 'Berita  Acara pemeriksaan ahli', 56, '2022-05-24 01:13:12', NULL, NULL),
(55, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti diterima oleh Pengendali secara ', 57, '2022-05-24 01:13:29', NULL, NULL),
(56, 'Berita acara pemeriksaan saksi terkoreksi', 58, '2022-05-24 01:14:10', NULL, NULL),
(57, 'Berita Acara pemeriksaan  Ahli tercetak', 59, '2022-05-24 01:15:16', NULL, NULL),
(58, 'Disposisi atas Nota Pendapat Untuk Melakukan Tindakan Hukum Penyidikan diterima', 60, '2022-05-24 01:17:06', NULL, NULL),
(59, 'Berita Acara Pemeriksaan Ahli ditandatangani oleh ahli', 61, '2022-05-24 01:17:15', NULL, NULL),
(60, ' Penasihat hukum dan penyidik', 61, '2022-05-24 01:17:15', NULL, NULL),
(61, 'Berita Acara Koordinasi', 62, '2022-05-24 01:18:31', NULL, NULL),
(62, 'Daftar hadir tersangka', 63, '2022-05-24 01:18:57', NULL, NULL),
(63, 'Dokumen/Benda hasil pelaksanaan tindakan hukum lainnya', 64, '2022-05-24 01:20:02', NULL, NULL),
(64, 'Tersangka mengerti tentang hak-hak tersangka', 65, '2022-05-24 01:20:54', NULL, NULL),
(65, 'Blangko data informasi tersangka terisi', 66, '2022-05-24 01:21:41', NULL, NULL),
(66, 'Nota Dinas Laporan Pelaksanaan Tindakan Hukum Lainnya ', 67, '2022-05-24 01:22:00', NULL, NULL),
(67, 'Nota Dinas Laporan Pelaksanaan Tindakan Hukum Lainnya terkirim', 68, '2022-05-24 01:23:17', NULL, NULL),
(68, 'Berita Acara pemeriksaan tersangka', 69, '2022-05-24 01:24:51', NULL, NULL),
(69, 'Berita acara pemeriksaan tersangka terkoreksi', 70, '2022-05-24 01:26:39', NULL, NULL),
(70, 'Surat perintah Penahanan(T-2) atau', 71, '2022-05-24 01:27:43', NULL, NULL),
(71, 'Surat Perpanjangan Penahanan(T-4) atau', 71, '2022-05-24 01:27:43', NULL, NULL),
(72, 'Penetapan Perpanjangan Penahanan dariKetua PN diterima', 71, '2022-05-24 01:27:43', NULL, NULL),
(73, 'berita acara pemeriksaan tersangka tercetak', 72, '2022-05-24 01:28:24', NULL, NULL),
(74, 'Berita Acara Koordinasi', 73, '2022-05-24 01:29:50', NULL, NULL),
(75, 'Berita Acara Pemeriksaan Tersangka ditandatangani oleh tersangka', 74, '2022-05-24 01:30:07', NULL, NULL),
(76, ' Penasihat hukum dan penyidik', 74, '2022-05-24 01:30:07', NULL, NULL),
(77, 'Surat Perintah Penahanan (T-2) / Surat Perpanjangan Penahanan (T-4) / Penetapan Perpanjangan Penahan', 75, '2022-05-24 01:31:11', NULL, NULL),
(78, 'Surat perintah penyidikan diterima', 76, '2022-05-24 01:32:16', NULL, NULL),
(79, 'Notulen rapat', 77, '2022-05-24 01:33:40', NULL, NULL),
(80, 'Mendapatkan surat keterangan sehat dari dokter', 78, '2022-05-24 01:34:13', NULL, NULL),
(81, 'Nota pendapat untuk melakukan tindakan hukum penyidikan', 79, '2022-05-24 01:35:22', NULL, NULL),
(82, 'Berita Penahanan (BA- 10)', 80, '2022-05-24 01:36:29', NULL, NULL),
(83, 'Berita Acara menolak menandatangani Berita Acara Penahanan', 80, '2022-05-24 01:36:29', NULL, NULL),
(84, 'Berita Acara Penolakan menandatangani Berita Acara Penahanan dan Berita Acara menolak menandatangani', 80, '2022-05-24 01:36:29', NULL, NULL),
(85, 'Tersangka memakai rompi dan diborgol', 81, '2022-05-24 01:37:16', NULL, NULL),
(86, 'Foto Tersangka', 82, '2022-05-24 01:38:02', NULL, NULL),
(87, 'Surat panggilan permintaan keterangan diterima', 83, '2022-05-24 01:38:53', NULL, NULL),
(88, 'Nota Pendapat untuk melakuka tindakan hukum penyidikan terkirim', 84, '2022-05-24 01:38:55', NULL, NULL),
(89, 'Tersangka Sampai ke Rutan', 85, '2022-05-24 01:39:15', NULL, NULL),
(90, 'Tersangka Masu ke Rutan', 86, '2022-05-24 01:39:57', NULL, NULL),
(91, 'Surat Perintah Tugas Pelacakan Aset Tahap Penyidikan diterima', 87, '2022-05-24 01:41:16', NULL, NULL),
(92, 'Berita Acara ditandatangani dan administrasi penahanan diterima oleh petugas rutan', 88, '2022-05-24 01:41:48', NULL, NULL),
(93, 'Jadwal Pelacakan Aset', 89, '2022-05-24 01:42:47', NULL, NULL),
(94, 'Surat Perintah Penahanan (T-2)', 90, '2022-05-24 01:43:34', NULL, NULL),
(95, 'Surat Perpanjangan Penahanan (T-4)', 90, '2022-05-24 01:43:34', NULL, NULL),
(96, 'Penetapan Perpanjangan Penahanandari Ketua PN diterima oleh keluarga tersangka', 90, '2022-05-24 01:43:34', NULL, NULL),
(97, 'Berita acara permintaan keterangan ditandatangani', 92, '2022-05-24 01:45:14', NULL, NULL),
(98, 'Nota  Dinas  Laporan pelaksanaan Tindakan Penahanan', 93, '2022-05-24 01:45:29', NULL, NULL),
(99, 'Berita acara permintaan keterangan ditandatangani', 94, '2022-05-24 01:47:25', NULL, NULL),
(100, 'Nota Dinas Laporan Pelaksanaan Tindakan Penahanan Terkirim', 95, '2022-05-24 01:47:29', NULL, NULL),
(101, 'Disposisi atas nota pendapat tindakan permintaan dokumen diterima.', 98, '2022-05-24 01:51:00', NULL, NULL),
(102, ' Surat perintah Pengalihan Jenis Penahanan Tahap Penyidikan (T-2) atau  Surat Perintah Penangguhan P', 99, '2022-05-24 01:52:36', NULL, NULL),
(103, 'Notulen rapat tim penyelidik', 100, '2022-05-24 01:53:10', NULL, NULL),
(104, 'Harta/Aset Kekayaan Tersangka', 97, '2022-05-24 01:53:22', NULL, NULL),
(105, 'Berita Acara Koordinasi', 101, '2022-05-24 01:54:25', NULL, NULL),
(106, 'Surat permintaan dokumen diterima.', 102, '2022-05-24 01:56:00', NULL, NULL),
(107, 'Surat Perintah Pengalihan', 103, '2022-05-24 01:56:04', NULL, NULL),
(108, 'Informasi   dan   Data   tentang harta benda/ aset', 104, '2022-05-24 01:56:30', NULL, NULL),
(109, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pelacakan Aset Tahap Penyidikan', 105, '2022-05-24 01:57:49', NULL, NULL),
(110, 'Berita acara Pengalihan Penahanan Tahap Penyidikan (BA-11) atau Berita Acara Penangguhan Penahanan (', 106, '2022-05-24 01:57:57', NULL, NULL),
(111, 'Tahanan ke luar dari rutan', 107, '2022-05-24 01:59:08', NULL, NULL),
(112, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pelacakan Aset Tahap Penyidikan diterima', 108, '2022-05-24 01:59:37', NULL, NULL),
(113, 'Tanda penerimaan dokumen foto/rekaman', 109, '2022-05-24 02:00:12', NULL, NULL),
(114, 'Nota Dinas Laporan pelaksanaan Tindakan Pengalihan Penahanan Tahap Penyidikan atau Penangguhan Penah', 110, '2022-05-24 02:01:06', NULL, NULL),
(115, 'Surat Perintah Penggeledahan diterima', 111, '2022-05-24 02:01:08', NULL, NULL),
(116, 'Nota Dinas Laporan pelaksanaan Pengalihan Penahanan Tahap Penyidikan atau Penangguhan Penahanan atau', 112, '2022-05-24 02:01:57', NULL, NULL),
(117, 'Tanda terima dokumen', 113, '2022-05-24 02:02:05', NULL, NULL),
(118, 'notulen rapat', 114, '2022-05-24 02:02:30', NULL, NULL),
(119, 'Rencana penggeledahan', 114, '2022-05-24 02:02:30', NULL, NULL),
(120, 'Nota dinas laporan hasil permintaan dan penerimaan dokumen', 115, '2022-05-24 02:03:36', NULL, NULL),
(121, 'Dokumentasi lokasi penggeledahan', 116, '2022-05-24 02:03:36', NULL, NULL),
(122, 'Berita acara koordinasi', 116, '2022-05-24 02:03:36', NULL, NULL),
(123, 'Surat Perintah Pengalihan Penahanan Tahap Penyidikan (T-2)', 117, '2022-05-24 02:05:11', NULL, NULL),
(124, 'Surat Perintah Pencabutan Penangguhan Penahanan (T-8)', 117, '2022-05-24 02:05:11', NULL, NULL),
(125, 'Surat Perintah Pencabutan Pembantaran Penahanan diterima', 117, '2022-05-24 02:05:11', NULL, NULL),
(126, 'Berita Acara Penggeledahan', 118, '2022-05-24 02:05:58', NULL, NULL),
(127, 'Nota dinas laporan hasil permintaan / penyerahan dokumen diterima', 119, '2022-05-24 02:05:58', NULL, NULL),
(128, 'Berita Acara kooordinasi', 120, '2022-05-24 02:07:08', NULL, NULL),
(129, 'Nota Dinas Laporan pelaksanaan tindakan penggeledahan', 121, '2022-05-24 02:07:11', NULL, NULL),
(130, 'Nota pendapat tindakan pemeriksaan setempat dan surat perintah tugas diterima.', 122, '2022-05-24 02:07:51', NULL, NULL),
(131, 'Nota Dinas Laporan pelaksanaan tindakan penggeledahan terkirim', 123, '2022-05-24 02:08:19', NULL, NULL),
(132, 'Surat           Perintah Penahanan   (T-2)   / Surat  Perpanjangan Penahanan   (T-4)   / Penetapan P', 124, '2022-05-24 02:08:50', NULL, NULL),
(133, 'Surat Perintah Penyitaan diterima', 125, '2022-05-24 02:10:35', NULL, NULL),
(134, 'Mendapatkan surat keterangan sehat dari dokter', 126, '2022-05-24 02:11:29', NULL, NULL),
(135, 'Berita Acara Pencabutan Penangguhan Penahanan', 127, '2022-05-24 02:13:07', NULL, NULL),
(136, 'Berita Acara pengalihan penahanan', 127, '2022-05-24 02:13:07', NULL, NULL),
(137, 'Berita Acara Pencabutan Pembantaran Penahanan dicetak', 127, '2022-05-24 02:13:07', NULL, NULL),
(138, 'Tersangka memakai rompi dan diborgol', 128, '2022-05-24 02:13:38', NULL, NULL),
(139, 'rencana tindakan penyitaan', 129, '2022-05-24 02:13:52', NULL, NULL),
(140, 'Notuleh rapat', 129, '2022-05-24 02:13:52', NULL, NULL),
(141, 'Tersangka Sampai ke Rutan', 130, '2022-05-24 02:14:29', NULL, NULL),
(142, 'Dokumentasi lokasi penyitaan', 131, '2022-05-24 02:14:59', NULL, NULL),
(143, 'Berita acara koordinasi', 131, '2022-05-24 02:14:59', NULL, NULL),
(144, 'Tersangka masuk kerutan', 132, '2022-05-24 02:15:08', NULL, NULL),
(145, 'Notulensi rapat', 133, '2022-05-24 02:15:30', NULL, NULL),
(146, 'Berita Acara ditandatangani dan administrasi penahanan diterima oleh petugas Rutan', 134, '2022-05-24 02:16:58', NULL, NULL),
(147, 'papan control barang bukti', 135, '2022-05-24 02:17:58', NULL, NULL),
(148, 'Kartu Barang Bukti', 135, '2022-05-24 02:17:58', NULL, NULL),
(149, 'Label Barang Bukti', 135, '2022-05-24 02:17:58', NULL, NULL),
(150, 'Berita Acara Penyitaan', 135, '2022-05-24 02:17:58', NULL, NULL),
(151, 'Laporan hasil koordinasi permintaan setempat.', 136, '2022-05-24 02:17:59', NULL, NULL),
(152, 'Nota DInas Laporan Pelaksanaan Pengalihan Penahanan Tahap Penyidikan atau Pencabutan Penangguhan Pen', 137, '2022-05-24 02:18:45', NULL, NULL),
(153, 'Nota  Dinas Laporan pelaksanaan tindakan penyitaan', 138, '2022-05-24 02:18:54', NULL, NULL),
(154, 'Nota  DInas  Laporan Pelaksanaan Pengalihan Penahanan     Tahap Penyidikan         atau Pelaksanaan ', 139, '2022-05-24 02:19:41', NULL, NULL),
(155, 'Nota  Dinas Laporan pelaksanaan tindakan  penyitaan terkirim', 140, '2022-05-24 02:19:55', NULL, NULL),
(156, 'Data/dokumen', 141, '2022-05-24 02:21:29', NULL, NULL),
(157, 'Foto/video/rekaman ', 141, '2022-05-24 02:21:29', NULL, NULL),
(158, 'Berita acara pemeriksaan setempat', 141, '2022-05-24 02:21:29', NULL, NULL),
(159, 'Resume/Catatan Penyidikan', 142, '2022-05-24 02:22:05', NULL, NULL),
(160, 'Nota dinas laporan hasil pemeriksaan setempat', 143, '2022-05-24 02:23:05', NULL, NULL),
(161, 'Nota  Dinas  Laporan Perkembangan Penyidikan', 144, '2022-05-24 02:23:20', NULL, NULL),
(162, 'Surat Perintah Penyegelan diterima', 145, '2022-05-24 02:23:20', NULL, NULL),
(163, 'Nota  Dinas  Laporan Perkembangan Penyidikan terkirim', 146, '2022-05-24 02:24:12', NULL, NULL),
(164, 'Daftar tempat/Barang/ dokumen yang akan dilakukan penyegelan', 147, '2022-05-24 02:24:21', NULL, NULL),
(165, 'Berita  acara penyegelan', 148, '2022-05-24 02:25:54', NULL, NULL),
(166, 'Tempat/Barang/ Dokumen tersegel', 148, '2022-05-24 02:25:54', NULL, NULL),
(167, 'Nota Laporan Dinas Pelaksanaan Penyegelan', 149, '2022-05-24 02:26:37', NULL, NULL),
(168, 'Surat               Perintah Penghentian Penyidikan', 150, '2022-05-24 02:26:38', NULL, NULL),
(169, 'Notulen Rapat', 151, '2022-05-24 02:27:06', NULL, NULL),
(170, 'Nota  Dinas Laporan Pelaksanaan Penyegelan terkirim', 152, '2022-05-24 02:27:33', NULL, NULL),
(171, 'Berita            Acara Pelaksanaan Penghentian Penyidikan', 153, '2022-05-24 02:28:42', NULL, NULL),
(172, 'Berita            Acara Pengembalian Barang     Bukti     / Benda Sitaan', 153, '2022-05-24 02:28:42', NULL, NULL),
(173, 'Nota    Dinas    Laporan pelaksanaan Penghentian Penyidikan', 154, '2022-05-24 02:29:14', NULL, NULL),
(174, 'Surat Perintah Penitipan Barang Bukti / Benda Sitaan diterima', 155, '2022-05-24 02:29:44', NULL, NULL),
(175, 'Nota    Dinas    Laporan pelaksanaan Penghentian Penyidikan terkirim', 156, '2022-05-24 02:30:01', NULL, NULL),
(176, 'Daftar Barang Bukti/Benda Sitaan yang  akan dilakukan penitipan', 157, '2022-05-24 02:31:14', NULL, NULL),
(177, 'Surat         Perintah Menyerahkan Tanggung     Jawab Tersangka        dan Barang Bukti (P-15)', 158, '2022-05-24 02:31:56', NULL, NULL),
(178, 'Nota              Dinas pengantar penyerahan tanggung       jawab tersangka         dan barang bukti', 158, '2022-05-24 02:31:56', NULL, NULL),
(179, 'Berita  acara penyegelan', 159, '2022-05-24 02:32:47', NULL, NULL),
(180, 'Tempat/Barang/ Dokumen tersegel', 159, '2022-05-24 02:32:47', NULL, NULL),
(181, 'Nota Dinas Laporan Pelaksanaan Penitipan Barang Bukti/Benda Sitaan', 160, '2022-05-24 02:33:59', NULL, NULL),
(182, 'Berita             acara koordinasi', 161, '2022-05-24 02:34:38', NULL, NULL),
(183, 'Surat     keterangan sehat', 161, '2022-05-24 02:34:38', NULL, NULL),
(184, 'Surat  pengeluaran tahanan dari rutan', 161, '2022-05-24 02:34:38', NULL, NULL),
(185, 'Nota Dinas Laporan Pelaksanaan Penitipan Barang Bukti/Benda Sitaan terkirim', 162, '2022-05-24 02:35:39', NULL, NULL),
(186, 'Salinan          Berita Acara   Penerimaan dan          Penelitian Tersangka (BA-15)', 163, '2022-05-24 02:35:48', NULL, NULL),
(187, 'Salinan          Berita Acara   Penerimaan dan          Penelitian Barang Sitaan/Barang Bukti (BA-18', 163, '2022-05-24 02:35:48', NULL, NULL),
(188, 'Nota     Dinas     Laporan pelaksanaan  penyerahan tanggung                jawab tersangka    dan   ', 164, '2022-05-24 02:36:58', NULL, NULL),
(189, 'Nota     Dinas     Laporan pelaksanaan  penyerahan tanggung                jawab tersangka    dan   ', 165, '2022-05-24 02:38:13', NULL, NULL),
(190, 'Surat perintah tugas pelacakan aset tahap penyelidikan diterima', 166, '2022-05-24 10:48:38', NULL, NULL),
(191, 'Jadwal pelacakan aset', 167, '2022-05-24 10:50:32', NULL, NULL),
(192, 'Informasi dan data tetang indentitas para pihak', 168, '2022-05-24 10:52:10', NULL, NULL),
(193, 'Konfirmasi identitas dan hubungan keluarga (kartu keluarga) para pihak', 169, '2022-05-24 10:56:19', NULL, NULL),
(194, 'Informasi paspor tentang negara yang sering dikunjungi oleh para pihak', 169, '2022-05-24 10:56:19', NULL, NULL),
(195, 'Jenis harta benda/ aset tanah atau kendaraan terkait dengan tahun perolehan', 169, '2022-05-24 10:56:19', NULL, NULL),
(196, ' jumlah', 169, '2022-05-24 10:56:19', NULL, NULL),
(197, ' bukti/ dokumen kepemilikan', 169, '2022-05-24 10:56:19', NULL, NULL),
(198, ' harta kekayaan dikuasai/ disimpan oleh siapa serta lokasi tempat keberadaan harta benda tersebut.', 169, '2022-05-24 10:56:19', NULL, NULL),
(199, 'Informasi financial penukaran mata uang asing', 169, '2022-05-24 10:56:19', NULL, NULL),
(200, 'Informasi tentang kepemilikan saham', 169, '2022-05-24 10:56:19', NULL, NULL),
(201, 'Informasi kepemilikan perusahaan atau afiliasi', 169, '2022-05-24 10:56:19', NULL, NULL),
(202, 'Harta/aset kekayaan', 170, '2022-05-24 10:59:37', NULL, NULL),
(203, 'Informasi dan harta benda/aset', 171, '2022-05-24 11:01:06', NULL, NULL),
(204, 'Nota dinas laporan hasil pelaksanaan tugas pelacakan aset tahap penyelidikan ', 172, '2022-05-24 11:02:20', NULL, NULL),
(205, 'Nota dinas laporan hasil pelaksanaan tugas pelacakan aset diterima pengendali', 173, '2022-05-24 11:03:52', NULL, NULL);

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
(2, 'Kepala Seksi Penyelidikan', '2022-05-11 12:01:40', NULL, NULL);

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
(10, 8, '<p>Menerima surat perintah tugas pengayaan informasi/data</p>', '10', 'menit', '', '2022-05-23 19:22:28', NULL, NULL),
(11, 8, '<p>Melakukan rapat koordinasi pelaksanaan tugas pengayaan informasi /data</p>', '120', 'menit', '', '2022-05-23 19:24:12', NULL, NULL),
(22, 8, '<p>Melaksanakan tugas pengayaan Informasi/Data:</p><ol><li>Melakukan penelusuran dan pengumpulan informasi/data secara online maupun offline berkaitan dengan objek laporan dan pengaduan masyarakat.</li><li>Melakukan pengamatan langsung atas tempat/lokasi, dan/atau objek antara lain berupa barang/ aset/alat/ dokumen dan/ atau situasi dan kondisi setempat yang dilaporkan.</li><li>Mendokumentasi situasi, fakta, kondisi fisik objek laporan atau copy dokumen yang berkaitan dengan materi laporan dengan foto/video dan mencatatnya dalam berita acara.</li><li>Melakukan wawancara dengan narasumber dari pihak-pihak terkait dengan tujuan memperdalam&nbsp;<br>Segala kejadian/peristiwa yang berhubungan dengan objek laporan, dan didokumentasikan.</li></ol>', '3', 'hari', '', '2022-05-23 19:47:51', NULL, NULL),
(23, 8, '<p>Menyerahkan nota dinas atas laporan laporan hasil pelaksanaan tugas pengayaan informasi/data kepada pengendali secara berjenjang.</p>', '10', 'menit', 'Sebagai input sop pengendalian secara berjenjang.', '2022-05-23 19:50:50', NULL, NULL),
(24, 9, '<p>Menerima surat perintah penyelidikan</p>', '10', 'menit', '', '2022-05-23 19:54:07', NULL, NULL),
(25, 9, '<p>Melakukan rapat tim membahas tentang rencana tindakan penyelidikan, terkait alasan atau argumentasi yuridis dilakukannya tindakan penyelidikan</p>', '180', 'menit', '', '2022-05-23 19:56:07', NULL, NULL),
(26, 9, '<p>Menyusun nota pendapat untuk melakukan tindakan penyelidikan</p>', '120', 'menit', '', '2022-05-23 20:02:42', NULL, NULL),
(27, 9, '<p>Menyerahkan nota dinas pendapat untuk melakukan tindakan penyelidikan kepada pengendali secara berjenjang.</p>', '10', 'menit', 'Sebagai input SOP pengendalian  secara berjenjang', '2022-05-23 20:04:20', NULL, NULL),
(28, 10, '<p>Menerima disposisi atas nota pendapat tindakan permintaan keterangan</p>', '10', 'menit', '', '2022-05-23 20:07:21', NULL, NULL),
(29, 10, '<p>Melakukan rapat tindakan permintaan keterangan</p>', '120', 'menit', '', '2022-05-23 20:09:36', NULL, NULL),
(30, 11, '<p>Menerima Surat Perintah Tugas Pengelolaan BBE</p>', '20', 'menit', '', '2022-05-23 20:35:13', NULL, NULL),
(31, 11, '<p>Melakukan Koordinasi Dengan Tim Jaksa Penyidik</p>', '120', 'menit', '', '2022-05-24 00:29:15', NULL, NULL),
(32, 11, '<p>Menerima &nbsp;Barang &nbsp;Bukti &nbsp;Elektronik &nbsp;dari &nbsp;Tim Jaksa Penyidik</p>', '120', 'menit', '', '2022-05-24 00:31:02', NULL, NULL),
(33, 11, '<p>Mendata &nbsp;dan &nbsp;menginventarisir &nbsp;barang &nbsp;bukti mengenai :<br>1.Jumlah BBE&nbsp;<br>2.Kepemilikan BBE<br>3.Jenis BBE<br>4.Tempat/keberadaan BBE&nbsp;<br>5.Penguasaan BBE saat ini&nbsp;<br>6.Tahun pembelian BBE</p>', '8', 'jam', '', '2022-05-24 00:33:37', NULL, NULL),
(34, 11, '<p>Mengklasifikasikan jenis barang bukti Elektronik dengan mengidentifikasi dan verifikasi media elektronik yang dinilai dapat menjadi sumber data dan tidak terbatas pada media &nbsp;penyimpanan &nbsp;data &nbsp;seperti &nbsp;hard &nbsp;disk, flash disk, CD, kartu memori dan log aktifitas jaringan dari penyedia internet.</p>', '120', 'menit', '', '2022-05-24 00:37:25', NULL, NULL),
(35, 11, '<p>Melakukan &nbsp; &nbsp; &nbsp;pengelolaan &nbsp; &nbsp; &nbsp;barang &nbsp; &nbsp; &nbsp;bukti elektronik dengan cara :<br>1. &nbsp; Menjaga &nbsp;dan &nbsp;menyimpan &nbsp;barang &nbsp;bukti pada tempat penyimpanan BBE<br>2. &nbsp; Melabel &nbsp;barang &nbsp;bukti &nbsp;dalam &nbsp;pengelolaan Subdit PA &amp; PBB<br>3. &nbsp; Melakukan permintaan bantuan perawatan &nbsp; berkala &nbsp; kepada &nbsp; pihak-pihak berkompeten<br>4. &nbsp; Mengawasi perawatan BBE secara berkala &nbsp;yang &nbsp;dilaksanakan oleh pihak- pihak yang berkompeten<br>5. &nbsp; Mengeluarkan dan memasukkan kembali BBE &nbsp;yang &nbsp;dipakai &nbsp;oleh &nbsp;Penyidik untuk keperluan penyidikan<br>6. &nbsp; Merekomendasikan kepada Penyidik terhadap data &nbsp; &nbsp; barang bukti untuk dimasukkan ke Daftar Barang Bukti<br>berkas perkara (Penyerahan Tahap I)</p>', '8', 'jam', 'Perawatan berkala kepada pihak-pihak berkompeten dikarenakan sifat dari bukti elektronik yang berbeda dari bukti lainnya dan mempunyai karakteristik  yang  mudah rapuh, mudah dimodifikasi dan rentan terhadap kondisi lingkungan fisik seperti medan magnet, kelembaban dan suhu, perlu dilakukan penanganan khusus BBE', '2022-05-24 00:41:46', NULL, NULL),
(36, 11, '<p>Mendampingi dan menyerahkan barang bukti elektronik kepada Penyidik pada saat Penyerahan Tahap II</p>', '8', 'jam', '', '2022-05-24 00:44:48', '2022-05-24 00:47:54', NULL),
(37, 11, '<p>Menyusun Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti Elektronik</p>', '120', 'menit', '', '2022-05-24 00:47:15', NULL, NULL),
(38, 11, '<p>Menyerahkan &nbsp; Laporan &nbsp; Hasil &nbsp; Pelaksanaan Tugas &nbsp;Pengelolaan &nbsp;Barang &nbsp;Bukti &nbsp;Elektronik dalam bentuk Nota Dinas kepada Pengendali secara berjenjang.</p>', '10', 'menit', 'Sebagai input SOP Pengendalian secara berjenjang', '2022-05-24 00:52:04', NULL, NULL),
(39, 12, '<p>Menerima saksi yang akan diperiksa</p>', '10', 'menit', '', '2022-05-24 00:53:55', '2022-05-24 00:55:26', NULL),
(40, 13, '<p>Menerima Surat Perintah Tugas Pengelolaan Barang Bukti</p>', '20', 'menit', '', '2022-05-24 00:55:49', NULL, NULL),
(41, 13, '<p>Melakukan Penyidik Koordinasi dengan Tim Jaksa</p>', '8', 'jam', '', '2022-05-24 00:57:37', NULL, NULL),
(42, 12, '<p>Menjelaskan maksud dan tujuan pemeriksaan saksi</p>', '10', 'menit', '', '2022-05-24 00:58:05', NULL, NULL),
(43, 13, '<p>Menerima Penyidik Barang Bukti dan Tim Jaksa</p>', '120', 'menit', '', '2022-05-24 00:59:01', NULL, NULL),
(44, 12, '<p>Melakukan pengisian blangko data informasi saksi</p>', '10', 'menit', '', '2022-05-24 00:59:12', NULL, NULL),
(45, 13, '<p>Mendata &nbsp;dan &nbsp;menginventarisir &nbsp;barang &nbsp;bukti mengenai :<br>1.Jumlah barang bukti&nbsp;<br>2.Kepemilikan barang bukti&nbsp;<br>3.Jenis barang bukti<br>4.Tempat/keberadaan barang bukti&nbsp;<br>5.Penguasaan barang bukti saat ini 6.Tahun pembelian barang bukti</p>', '8', 'jam', '', '2022-05-24 01:00:39', NULL, NULL),
(46, 13, '<p>Mengklasifikasikan jenis barang bukti :<br>1. &nbsp; Barang bukti bergerak<br>2. &nbsp; Barang bukti tidak bergerak.</p>', '8', 'jam', '', '2022-05-24 01:02:56', NULL, NULL),
(47, 12, '<p>Melakukan pemeriksaan saksi :</p><ol><li>Mengisi waktu dan tempat pemeriksaan saksi</li><li>Mengisi identitas saksi</li><li>Menanyakan kondisi kesehatan saksi dan menanyakan kesediaan saksi untuk diperiksa</li><li>Menanyakan kepada saksi tentang berbagai hal yang terkait dengan dugaan Tindak Pidana yang sedang ditangani</li><li>Mengkonfirmasi keterangan saksi dengan Menunjukkan surat-surat / barang bukti dan keterangan saksi-saksi yang lain/tersangka dan alat bukti lainnya.</li><li>Meyakinkan saksi dalam memberikan keterangan tidak ada ada tekanan atau paksaan dari penyidik atau pun pihak lain</li></ol>', '8', 'jam', '', '2022-05-24 01:02:59', '2022-05-24 01:04:50', NULL),
(48, 12, '<p>Memberikan kesempatan kepada saksi untuk membaca atau membacakan isi Berita Acara Pemeriksaan kepada saksi</p>', '10', 'menit', '', '2022-05-24 01:04:29', NULL, NULL),
(49, 12, '<p>Mencetak Berita Acara Pemeriksaan Saksi</p>', '30', 'menit', '', '2022-05-24 01:06:10', NULL, NULL),
(50, 13, '<p>Melakukan pengelolaan barang bukti dengan cara :<br>1. &nbsp;Menjaga dan menyimpan barang bukti pada tempat penyimpanan barang bukti<br>2. &nbsp;Melabel barang bukti bergerak<br>3. &nbsp;Melakukan pemasangan papan plang pengelolaan barang &nbsp; bukti &nbsp;pada barang bukti tidak bergerak (Tanah dan bangunan)<br>4. &nbsp;Melakukan permintaan bantuan perawatan berkala kepada &nbsp; pihak-pihak berkompeten<br>5. &nbsp;Mengawasi perawatan barang bukti secara berkala &nbsp;yang &nbsp;dilaksanakan oleh pihak-pihak yang berkompeten<br>6. &nbsp;Mengeluarkan dan memasukkan kembali barang bukti yang &nbsp;dipakai oleh Penyidik untuk keperluan penyidikan<br>7. &nbsp;Merekomendasikan kepada Penyidik terhadap data &nbsp; &nbsp; barang bukti untuk dimasukkan ke Daftar Barang Bukti berkas perkara (Penyerahan Tahap I)</p>', '24', 'jam', 'Perawatan berkala terhadap barang  bukti yang mempunyai nilai ekonomis tinggi atau barang mewah yang membutuhkan perawatan khusus', '2022-05-24 01:07:44', NULL, NULL),
(51, 12, '<p>Menandatangani berita acara pemeriksaan</p>', '10', 'menit', '', '2022-05-24 01:07:44', NULL, NULL),
(52, 13, '<p>Mendampingi dan menyerahkan barang bukti kepada &nbsp; Penyidik pada saat Penyerahan Tahap II</p>', '8', 'jam', '', '2022-05-24 01:08:57', NULL, NULL),
(53, 14, '<p>Menjelaskan maksud dan tujuan pemeriksaan ahli</p>', '10', 'menit', '', '2022-05-24 01:09:55', NULL, NULL),
(54, 14, '<p>Mengambil sumpah/Janji ahli</p>', '10', 'menit', '', '2022-05-24 01:10:38', NULL, NULL),
(55, 13, '<p>Menyusun Nota DinasLaporan Hasil Pelaksanaan Tugas &nbsp; Pengelolaan Barang Bukti</p>', '120', 'menit', '', '2022-05-24 01:10:55', '2022-05-24 01:11:20', NULL),
(56, 14, '<p>Melakukan pemeriksaan saksi :</p><ol><li>Mengisi waktu dan tempat Pemeriksaan Ahli</li><li>Mengisi identitas ahli&nbsp;</li><li>Menanyakan kondisi kesehatan ahli dan menanyakan kesediaan ahli untuk diperiksa&nbsp;</li><li>Menanyakan pendapat ahli tentang suatu yang diperlukan untuk membuat terang tindak pidana yang terjadi&nbsp;</li><li>Mengkonfirmasi pendapat ahli terhadap alat bukti lainnya &nbsp;</li><li>Meyakinkan ahli dalam memberikan keterangan tidak ada ada tekanan atau paksaan dari penyidik ataupun pihak lain surat-surat / barang bukti dan alat bukti lainnya.</li></ol>', '8', 'jam', '', '2022-05-24 01:13:12', NULL, NULL),
(57, 13, '<p>Menyerahkan Laporan Hasil Pelaksanaan Tugas Pengelolaan &nbsp; Barang Bukti dalam bentuk Nota Dinas kepada &nbsp; &nbsp;Pengendali secara berjenjang</p>', '10', 'menit', 'Sebagai Input SOP Pengendalian secara berjenjang', '2022-05-24 01:13:29', NULL, NULL),
(58, 14, '<p>Memberikan kesempatan kepada ahli untuk membaca atau membacakan isi Berita Acara Pemeriksaan</p>', '10', 'menit', '', '2022-05-24 01:14:10', NULL, NULL),
(59, 14, '<p>Mencetak Berita Acara Pemeriksaan Ahli</p>', '30', 'menit', '', '2022-05-24 01:15:16', NULL, NULL),
(60, 15, '<p>Menerima Disposisi atas Nota Pendapat Untuk Melakukan Tindakan Hukum Penyidikan</p>', '15', 'menit', '', '2022-05-24 01:17:06', NULL, NULL),
(61, 14, '<p>Menandatangani Berita Acara Pemeriksaan</p>', '10', 'menit', '', '2022-05-24 01:17:15', NULL, NULL),
(62, 15, '<p>Melakukan koordinasi dengan pihak terkait akan dilakukannya tindakan hukum lainnya</p>', '8', 'jam', '', '2022-05-24 01:18:31', NULL, NULL),
(63, 16, '<p>Menerima tersangka yang akan diperiksa</p>', '10', 'menit', 'Penyidik memperkenalkan diri serta mengucapkan terima kasih atas kehadiran tersangka', '2022-05-24 01:18:57', '2022-05-24 01:19:47', NULL),
(64, 15, '<p>Melakukan &nbsp;tindakan &nbsp;hukum &nbsp;lain &nbsp;antara &nbsp;lain berupa &nbsp;:<br>1. &nbsp; Tindakan penangkapan;<br>2. &nbsp; Tindakan &nbsp;pencegahan &nbsp;bepergian &nbsp;ke &nbsp;luar negeri;<br>3. &nbsp; Tindakan permintaan pembukaan/pemeriksaan/pemblokiran rekening tersangka;<br>4. &nbsp; Tindakan permintaan data transaksi keuangan;<br>5. &nbsp; Tindakan permintaan pemblokiran hak atas tanah/bangunan/barang-barang &nbsp;ter- register atau tercatat;<br>6. &nbsp; Tindakan permintaan data/dokumen berkaitan perpajakan;<br>7. &nbsp; Tindakan permintaan penghitungan kerugian keuangan Negara;<br>8. &nbsp; Tindakan permintaan pemeriksaan &nbsp;atau penilaian teknis obyek tertentu;<br>9. &nbsp; Tindakan upaya paksa terhadap saksi/tersangka yang tidak memenuhi panggila secara sah</p>', '8', 'jam', '', '2022-05-24 01:20:02', '2022-05-24 09:57:37', NULL),
(65, 16, '<p>Menjelaskan hak-hak tersangka</p>', '10', 'menit', '', '2022-05-24 01:20:54', NULL, NULL),
(66, 16, '<p>Melakukan pengisian blangko data informasi tersangka</p>', '10', 'menit', '', '2022-05-24 01:21:40', NULL, NULL),
(67, 15, '<p>Membuat &nbsp;Nota &nbsp;Dinas &nbsp;Laporan &nbsp;pelaksanaan Tindakan Hukum Lainnya</p>', '120', 'menit', '', '2022-05-24 01:22:00', NULL, NULL),
(68, 15, '<p>Menyerahkan Nota Dinas Laporan pelaksanaan Tindakan Hukum Lainnya kepada Pengendali secara berjenjang</p>', '15', 'menit', 'Sebagai input SOP Pengendalian secara berjenjang', '2022-05-24 01:23:17', '2022-05-24 09:58:11', NULL),
(69, 16, '<p>Melakukan pemeriksaan tersangka :&nbsp;</p><ol><li>Mengisi waktu dan tempat Pemeriksaan Tersangka&nbsp;</li><li>Mengisi identitas tersangka&nbsp;</li><li>Menanyakan kondisi kesehatan tersangka dan menanyakan kesediaan tersangka untuk diperiksa&nbsp;</li><li>Menanyakan apakah didampingi Penasihat Hukum&nbsp;</li><li>Menanyakan kepada tersangka tentang berbagai hal yang terkait dengan dugaan Tindak Pidana yang sedang ditangani&nbsp;</li><li>Mengkonfirmasi keterangan tersangka dengan Menunjukkan surat-surat / barang bukti dan keterangan tersangka-tersangka yang lain/tersangka dan alat bukti lainnya.</li><li>Menanyakan apakah akan menghadirkan saksi dan/atau ahli yang menguntungkan&nbsp;</li><li>Menanyakan tentang harta kekayaan tersangka, istri/suami dan anak tersangka&nbsp;</li><li>Meyakinkan tersangka dalam memberikan keterangan tidak ada ada tekanan atau paksaan dari penyidik ataupun pihak lain</li></ol>', '8', 'jam', '', '2022-05-24 01:24:51', NULL, NULL),
(70, 16, '<p>Memberikan kesempatan kepada tersangka untuk membaca atau membacakan isi Berita Acara Pemeriksaan kepada tersangka</p>', '10', 'menit', '', '2022-05-24 01:26:39', NULL, NULL),
(71, 17, '<p>Menerima &nbsp;Surat &nbsp;perintah &nbsp;Penahanan &nbsp;(T-2) &nbsp;/ Surat &nbsp; &nbsp;Perpanjangan &nbsp; &nbsp;Penahanan &nbsp; &nbsp;(T-4) &nbsp; &nbsp;/ Penetapan &nbsp;Perpanjangan &nbsp;Penahanan &nbsp; &nbsp; dari Ketua PN</p>', '10', 'menit', '', '2022-05-24 01:27:43', NULL, NULL),
(72, 16, '<p>Mencetak berita acara pemeriksaan tersangka</p>', '30', 'menit', '', '2022-05-24 01:28:24', NULL, NULL),
(73, 17, '<p>Melakukan koordinasi :</p><ul><li>Pihak &nbsp;Rutan &nbsp;dimana &nbsp;tersangka &nbsp;akan &nbsp;di tahan (jika akanditahan di rutan)</li><li>Kamdal &nbsp; dan/atau &nbsp; pihak &nbsp; kepolisian &nbsp; untuk meminta bantuan &nbsp;pengawalan &nbsp;membawa tahanan ke rutan<br></li><li>Rumah &nbsp; sakit, &nbsp; Puskesmas &nbsp; atau &nbsp; poliklinik terdekat untuk pemeriksaan kesehatan</li></ul>', '15', 'menit', 'Tidak dilakukan untuk perpanjangan penahanan', '2022-05-24 01:29:50', NULL, NULL),
(74, 16, '<p>Menandatangani berita acara pemeriksaan</p>', '10', 'menit', '', '2022-05-24 01:30:07', NULL, NULL),
(75, 17, '<p>Menyampaikan &nbsp; Surat &nbsp; perintah &nbsp; Penahanan (T-2) / Surat Perpanjangan Penahanan (T-4) / Penetapan &nbsp; Perpanjangan &nbsp; Penahanan &nbsp; dari Ketua PN kepada tersangka</p>', '15', 'menit', '', '2022-05-24 01:31:11', NULL, NULL),
(76, 18, '<p>Menerima Surat Perintah Penyidikan</p>', '10', 'menit', '', '2022-05-24 01:32:16', NULL, NULL),
(77, 18, '<p>Melakukan rapat tim membahas tentang rencana tindakan hukum, terkait alasan atau argumentasi yuridis dilakukannya tindakan hukum</p>', '60', 'menit', '', '2022-05-24 01:33:40', NULL, NULL),
(78, 17, '<p>Membawa &nbsp; &nbsp; tersangka &nbsp; &nbsp; ke &nbsp; &nbsp; Rumah &nbsp; &nbsp; sakit, Puskesmas &nbsp; &nbsp;atau &nbsp; &nbsp;poliklinik &nbsp; &nbsp;terdekat &nbsp; &nbsp;atau mengundang &nbsp; &nbsp; dokter &nbsp; &nbsp; untuk &nbsp; &nbsp; pemeriksaan kesehatan tersangka</p>', '30', 'menit', '', '2022-05-24 01:34:13', NULL, NULL),
(79, 18, '<p>Menyusun Nota Pendapat untuk melakukan tindakan hukum penyidikan</p>', '180', 'menit', '', '2022-05-24 01:35:22', NULL, NULL),
(80, 17, '<p>Menyiapkan Berita Acara sebagai berikut :<br>1. &nbsp;Berita Acara Penahanan (BA-10);<br>2. &nbsp;Berita &nbsp; &nbsp;Acara &nbsp; &nbsp;menolak &nbsp; &nbsp;menandatangani Berita Acara Penahanan; dan<br>3. &nbsp;Berita &nbsp; Acara &nbsp; Penolakan &nbsp; menandatangani Berita &nbsp;Acara &nbsp;Penahanan &nbsp;dan &nbsp;Berita &nbsp;Acara menolak &nbsp; &nbsp;menandatangani &nbsp; &nbsp;Berita &nbsp; &nbsp;Acara Penahanan</p>', '1', 'jam', 'tersangka / penasihat hukum melalui penyidik', '2022-05-24 01:36:29', NULL, NULL),
(81, 17, '<p>Memakaikan &nbsp;rompi &nbsp;tahanan &nbsp;dan &nbsp;memborgol tangan &nbsp;tersangka &nbsp;sebelum &nbsp;keluar &nbsp;dari &nbsp;ruang pemeriksaan</p>', '10', 'menit', '', '2022-05-24 01:37:16', NULL, NULL),
(82, 17, '<p>Mengambil foto tersangka</p>', '5', 'menit', '', '2022-05-24 01:38:02', NULL, NULL),
(83, 10, '<p>Melakukan pemanggilan permintaan keterangan dan koordinasi permintaan keterangan</p>', '3', 'hari', 'Surat panggilan permintaan keterangan diterima oleh orang yang akan dimintai keterangan paling lambat 3 (tiga) hari', '2022-05-24 01:38:53', NULL, NULL),
(84, 18, '<p>Menyerahkan Nota Dinas Pendapat untuk melakukan tindakan hukum penyidikan kepada Pengendali secara berjenjang.</p>', '10', 'menit', '', '2022-05-24 01:38:55', NULL, NULL),
(85, 17, '<p>Membawa &nbsp; &nbsp;tersangka &nbsp; &nbsp;ke &nbsp; &nbsp;Rutan &nbsp; &nbsp;dengan pengawalan dari Kamdal dan polisi</p>', '30', 'menit', 'Disesuaikan jarak dari kantor ke rutan', '2022-05-24 01:39:15', NULL, NULL),
(86, 17, '<p>Memasukan tersangka ke Rutan</p>', '10', 'menit', '', '2022-05-24 01:39:57', NULL, NULL),
(87, 19, '<p>Menerima Surat Perintah Tugas Pelacakan Aset Tahap Penyidikan</p>', '20', 'menit', '', '2022-05-24 01:41:16', NULL, NULL),
(88, 17, '<p>Menyelesaikan administrasi penahanan :</p><ul><li>menyerahkan &nbsp;Surat &nbsp;Perintah &nbsp;Penahanan dan &nbsp;surat &nbsp;keterangan &nbsp;sehat &nbsp;dari &nbsp;dokter kepada petugas rutan</li><li>Menandatangani Berita Acara Penahanan (BA-10) &nbsp; &nbsp;atau &nbsp; &nbsp;Berita &nbsp; &nbsp;Acara &nbsp; &nbsp;Menolak menandatangani Berita Acara Penahanan atau &nbsp; Penolakan &nbsp; menandatangani &nbsp; Berita Acara &nbsp; &nbsp;Penahanan &nbsp; &nbsp;dan &nbsp; &nbsp;Berita &nbsp; &nbsp;Acara Menolak &nbsp; menandatangani &nbsp; Berita &nbsp; Acara Penahanan.<br></li><li>Menandatangai &nbsp;Berita &nbsp;Acara &nbsp;serah &nbsp;terima tahanan</li></ul>', '30', 'menit', '', '2022-05-24 01:41:48', NULL, NULL),
(89, 19, '<p>Melakukan koordinasi dengan Tim Jaksa Penyidik</p>', '60', 'menit', '', '2022-05-24 01:42:47', NULL, NULL),
(90, 17, '<p>Menyampaikan &nbsp; &nbsp; &nbsp;salinan &nbsp; &nbsp; &nbsp;Surat &nbsp; &nbsp; &nbsp;Perintah Penahanan &nbsp; &nbsp;(T-2) &nbsp; &nbsp;/ &nbsp; &nbsp;Surat &nbsp; &nbsp;Perpanjangan Penahanan &nbsp;(T-4) &nbsp;/ &nbsp;Penetapan &nbsp;Perpanjangan Penahanan &nbsp;dari &nbsp;Ketua &nbsp;PN &nbsp;kepada &nbsp;keluarga tersangka.</p>', '15', 'menit', 'Paling lambat 1 (satu) hari setelah dilakukan penahanan.', '2022-05-24 01:43:34', '2022-05-24 01:45:47', NULL),
(91, 19, '<p>Mempelajari, menginventarisir, profiling baik nama atau identitas tersangka yang akan di PA maupun lokasi/ instansi yang akan dilakukan PA</p>', '8', 'jam', '', '2022-05-24 01:44:35', NULL, NULL),
(92, 10, '<p>Melaksanakan Permintaan Keterangan :&nbsp;</p><ol><li>Berjabat tangan dengan seseorang yang dimintai keterangan dan memperkenalkan diri serta mengucapkan terima kasih atas kehadirannya.</li><li>Menjelaskan maksud dan tujuan kepada seseorang yang dimintai keterangan.</li><li>Mencatat Identitas orang yang dimintai keterangan secara lengkap dan mengisi blanko data harta kekayaan.</li><li>Menanyakan Kondisi kesehatan dan kesediaan memberi keterangan dari yang bersangkutan.</li><li>Menanyakan kepada saksi tentang berbagai hal yang terkait dengan materi penyelidikan sesuai laporan pengaduan masyarakat.</li><li>Mengkonfirmasi keterangan yang bersangkutan dengan menunjukkan dokumen/ surat-surat / bukti dan keterangan yang lain terkait dugaan adanya peristiwa pidana.</li><li>Klarifikasi atas transaksi keuangan, kepemilikan/ penguasaan aset baik sebagai alat maupun sebagai hasil tindak pidana.</li><li>Hasil Permintaan Keterangan dibuat dalam bentuk Berita Acara Permintaan Keterangan.</li><li>Berita Acara Permintaan Keterangan dibaca dan dikoreksi.</li><li>Menandatangani Berita Acara Permintaan Keterangan ditandatangani.</li></ol>', '8', 'jam', 'Format berita acara permintaan keterangan sesuai pidsus-8', '2022-05-24 01:45:14', NULL, NULL),
(93, 17, '<p>Membuat &nbsp; Laporan &nbsp; pelaksanaan &nbsp; Tindakan Penahanan dalam bentuk Nota Dinas</p>', '120', 'menit', '', '2022-05-24 01:45:29', NULL, NULL),
(94, 10, '<p>Membuat laporan hasil permintaan keterangan dalam bentuk nota dinas</p>', '60', 'menit', 'Format berita acara permintaan keterangan sesuai pidsus-8', '2022-05-24 01:47:25', NULL, NULL),
(95, 17, '<p>Menyerahkan &nbsp; &nbsp; &nbsp; Nota &nbsp; &nbsp; &nbsp; Dinas &nbsp; &nbsp; &nbsp; Laporan pelaksanaan &nbsp;Tindakan &nbsp;Penahanan &nbsp;ditujukan kepada pengendali secara berjenjang</p>', '15', 'menit', 'Sebagai  input SOP Pengendalian secara berjenjang', '2022-05-24 01:47:29', NULL, NULL),
(96, 19, '<p>Melakukan koordinasi dengan pihak-pihak terkait yang berkaitan dengan informasi dan data keberadaan, jenis dan jumlah barang/ harta benda/ aset milik tersangkabeserta dokumen-dokumen kepemilikan</p>', '24', 'jam', '', '2022-05-24 01:47:55', NULL, NULL),
(97, 19, '<p>Melakukan pelacakan aset terhadap barang/ harta benda milik tersangka berupa jenis/ tahun perolehan, jumlah, bukti/dokumen kepemilikan, Harta kekayaan dikuasai/ disimpan oleh siapa serta lokasi tempat keberadaan harta benda tersebut.</p>', '40', 'jam', '', '2022-05-24 01:49:33', '2022-05-24 01:50:52', NULL),
(98, 20, '<p>Menerima disposisi atas nota pendapat tindakan permintaan dokumen</p>', '10', 'menit', '', '2022-05-24 01:51:00', NULL, NULL),
(99, 21, '<p>Menerima &nbsp; &nbsp; &nbsp;Surat &nbsp; &nbsp; &nbsp;perintah &nbsp; &nbsp; &nbsp;Pengalihan Penahanan Tahap Penyidikan (T-2) / Perintah Penangguhan &nbsp; &nbsp;Penahanan &nbsp; &nbsp;(T-8) &nbsp; &nbsp;/ &nbsp; &nbsp;Surat Perintah Pembantaran Penahanan</p>', '10', 'menit', 'Untuk pengalihan penahanan Rutan menjadi penahanan Rumah     atau Kota', '2022-05-24 01:52:36', NULL, NULL),
(100, 20, '<p>Melakukan rapat tindakan permintaan dokumen</p>', '60', 'menit', '', '2022-05-24 01:53:10', NULL, NULL),
(101, 21, '<p>Melakukan koordinasi :</p><ul><li>&nbsp;Pihak Rutan dimana tersangka ditahan<br></li><li>Kamdal &nbsp; dan/atau &nbsp; pihak &nbsp; kepolisian &nbsp; untuk meminta &nbsp;bantuan &nbsp;pengawalan &nbsp;membawa tahanan ke luar rutan<br></li><li>Rumah &nbsp; sakit, &nbsp; Puskesmas &nbsp; atau &nbsp; poliklinik terdekat untuk pemeriksaan kesehatan</li></ul>', '15', 'menit', 'Tidak dilakukan untuk perpanjangan penahanan', '2022-05-24 01:54:25', NULL, NULL),
(102, 20, '<p>Melakukan permintaan dokumen dan koordinasi permintaan dokumen</p>', '3', 'hari', '', '2022-05-24 01:56:00', NULL, NULL),
(103, 21, '<p>Menyampaikan &nbsp; Surat &nbsp; perintah &nbsp; Pengalihan Penahanan Tahap Penyidikan (T-2) / Perintah Penangguhan &nbsp; &nbsp;Penahanan &nbsp; &nbsp;(T-8) &nbsp; &nbsp;/ &nbsp; &nbsp;Surat Perintah &nbsp; Pembantaran &nbsp; Penahanan &nbsp; kepada tersangka</p>', '15', 'menit', '', '2022-05-24 01:56:04', NULL, NULL),
(104, 19, '<p>Melakukan pengolahan data dan informasi atas harta benda/ aset milik tersangka yang didapatkanbaik berupa foto harta benda aset, keberadaan aset serta jumlah dan kondisi aset serta Menginventarisir/ memilah/ mendata barang/ harta benda tersebut</p>', '120', 'menit', '', '2022-05-24 01:56:30', NULL, NULL),
(105, 19, '<p>Menyusun Nota Dinas Laporan Hasil Pelaksanaan Tugas Pelacakan Aset Tahap Penyidikan</p>', '8', 'jam', '', '2022-05-24 01:57:49', NULL, NULL),
(106, 21, '<p>Menandatangani &nbsp; Berita &nbsp; acara &nbsp; Pengalihan Penahanan &nbsp; Tahap &nbsp; &nbsp;Penyidikan &nbsp; (BA-11) &nbsp; &nbsp;/ Berita &nbsp;Acara &nbsp;Penangguhan &nbsp;Penahanan &nbsp;(BA- 12) / Berita Acara Pembantaran Penahanan</p>', '30', 'menit', '', '2022-05-24 01:57:57', NULL, NULL),
(107, 21, '<p>Mengeluarkan &nbsp;tahanan &nbsp;dari &nbsp;rutan &nbsp;dan/atau Membawa tersangka ke Rumah sakit dengan pengawalan</p>', '1', 'jam', 'Untuk pembantaran penahanan tahanan dibawa ke rumah sakit untuk menjalani perawatan', '2022-05-24 01:59:08', NULL, NULL),
(108, 19, '<p>Menyerahkan Laporan Hasil Pelaksanaan Tugas Pelacakan Aset tahap Penyidikan dalam bentuk Nota Dinas kepada Pengendali secara berjenjang</p>', '10', 'menit', '', '2022-05-24 01:59:37', NULL, NULL),
(109, 20, '<p>Menerima penyerahan dokumen, dengan cara:&nbsp;</p><ol><li>Melakukan penelitian dan verifikasi atas dokumen yang akan diserahkan.</li><li>Membuat tanda terima dokumen disertai keterangan sesuai hasil verifikasi, dan dicetak/copy sesuai dengan kebutuhan</li><li>Menandatangani Tanda Terima Dokumen, dan masing-masing mendapat satu rangkap</li><li>Serah terima dokumen selesai dan diakhiri dengan ucapan terima kasih dari Tim Jaksa Penyelidik.</li></ol>', '8', 'jam', '', '2022-05-24 02:00:12', NULL, NULL),
(110, 21, '<p>Membuat &nbsp; Laporan &nbsp; pelaksanaan &nbsp; Tindakan Pengalihan &nbsp; Penahanan &nbsp; Tahap &nbsp; Penyidikan atau &nbsp; &nbsp; &nbsp;Penangguhan &nbsp; &nbsp; &nbsp;Penahanan &nbsp; &nbsp; &nbsp;atau Pembantaran Penahanan dalam bentuk Nota Dinas</p>', '30', 'menit', '', '2022-05-24 02:01:06', NULL, NULL),
(111, 22, '<p>Menerima Surat Perintah Penggeledahan</p>', '10', 'menit', '', '2022-05-24 02:01:08', NULL, NULL),
(112, 21, '<p>Menyerahkan &nbsp; &nbsp; &nbsp; Nota &nbsp; &nbsp; &nbsp; Dinas &nbsp; &nbsp; &nbsp; Laporan pelaksanaan &nbsp;Pengalihan &nbsp;Penahanan &nbsp;Tahap Penyidikan &nbsp; atau &nbsp; Penangguhan &nbsp; Penahanan atau &nbsp; &nbsp;Pembantaran &nbsp; &nbsp;Penahanan &nbsp; &nbsp;ditujukan kepada pengendali secara berjenjang</p>', '30', 'menit', '', '2022-05-24 02:01:57', NULL, NULL),
(113, 20, '<p>Menyerahkan dokumen dan tanda terima kepada sekretaris tim penyelidik</p>', '30', 'menit', '', '2022-05-24 02:02:05', NULL, NULL),
(114, 22, '<p>Melakukan Rapat Tim Penyidik untuk Mendata dan menginventarisir Barang/ dokumen yang menjadi obyek penggeledahan</p>', '120', 'menit', '', '2022-05-24 02:02:30', NULL, NULL),
(115, 20, '<p>Membuat nota dinas laporan hasil permintaan dan penerimaan dokumen</p>', '60', 'menit', '', '2022-05-24 02:03:36', NULL, NULL),
(116, 22, '<p>Melakukan pengamatan dan penggambaran lokasi penggeledahan serta melakukan koordinasi dengan aparat keamanan/instansi terkait</p>', '8', 'jam', '', '2022-05-24 02:03:36', NULL, NULL),
(117, 23, '<p>Menerima &nbsp; &nbsp; &nbsp;Surat &nbsp; &nbsp; &nbsp;Perintah &nbsp; &nbsp; &nbsp;Pengalihan Penahanan &nbsp;Tahap &nbsp;Penyidikan &nbsp;(T-2) &nbsp;/ &nbsp;Surat Perintah &nbsp; &nbsp; &nbsp; &nbsp; Pencabutan &nbsp; &nbsp; &nbsp; &nbsp; Penangguhan Penahanan (T-8) / Surat Perintah Pencabutan Pembantaran Penahanan</p>', '10', 'menit', 'Untuk Pengalihan Penahanan Rumah/Kota menjadi Penahanan Rutan', '2022-05-24 02:05:11', NULL, NULL),
(118, 22, '<p>Melakukan tindakan penggeledahan :&nbsp;</p><ol><li>Mendatangi tempat penggeledahan didampingi oleh petugas keamanan dan 2 (dua) orang saksi&nbsp;</li><li>Menunjukkan Surat Perintah Penggeledahan / Penetapan Izin Penggeledahan dari Ketua PN serta tanda pengenal&nbsp;</li><li>Menjelaskan maksud dan tujuan penggeledahan&nbsp;</li><li>Memerintahkan penutupan akses keluar masuk tempat penggeledahan</li><li>Melarang orang yang dianggap perlu meninggalkan tempat dan memerintahkan untuk menghentikan sementara kegiatan yang sedang dilakukan&nbsp;</li><li>Mencari dan mencatat barang/dokumen yang ada kaitannya dengan tindak pidana yang disangkakan&nbsp;</li><li>Memeriksa pakaian dan/atau badan orang yang diduga melakukan tindak pidana&nbsp;</li><li>Mendokumentasikan seluruh proses penggeledahan&nbsp;</li><li>Menumpulkan barang/dokumen yang ada kaitannya dengan tindak pidana yang disangkakan untuk selanjutnya dilakukan Tindakan Penyitaan&nbsp;</li><li>Membuat dan menandatangani berita acara penggeledahan oleh penyidik, yang menguasai tempat dan 2 (dua) orang saksi</li></ol>', '8', 'jam', '', '2022-05-24 02:05:58', NULL, NULL),
(119, 20, '<p>Menyerahkan nota dinas laporan hasil permintaan dan penerimaan dokumen kepada pengendali secara berjenjang.</p>', '10', 'menit', 'Sebagai Input SOP pengendalian secara berjenjang.', '2022-05-24 02:05:58', NULL, NULL),
(120, 23, '<p>Melakukan koordinasi :</p><ul><li>Pihak &nbsp;Rutan &nbsp;dimana &nbsp;tersangka &nbsp;akan &nbsp;di tahan (jika akanditahan di rutan)<br></li><li>Kamdal &nbsp; dan/atau &nbsp; pihak &nbsp; kepolisian &nbsp; untuk meminta &nbsp;bantuan &nbsp;pengawalan &nbsp;membawa tahanan ke rutan<br></li><li>Rumah &nbsp; sakit, &nbsp; Puskesmas &nbsp; atau &nbsp; poliklinik terdekat untuk pemeriksaan kesehatan</li></ul>', '15', 'menit', 'Tidak dilakukan untuk perpanjangan penahanan', '2022-05-24 02:07:08', NULL, NULL),
(121, 22, '<p>Membuat laporan pelaksanaan Tindakan Penggeledahan dalam bentuk Nota Dinas</p>', '120', 'menit', '', '2022-05-24 02:07:11', NULL, NULL),
(122, 24, '<p>Menerima disposisi atas nota pendapat tindakan pemeriksaan setempat dan surat perintah tugas</p>', '4', 'menit', '', '2022-05-24 02:07:51', '2022-05-24 02:09:01', NULL),
(123, 22, '<p>Menyerahkan Nota Dinas Laporan pelaksanaan tindakan penggeledahan ditujukan kepada pengendali secara berjenjang</p>', '15', 'menit', '', '2022-05-24 02:08:19', NULL, NULL),
(124, 23, '<p>Menyampaikan &nbsp; Surat &nbsp; Perintah &nbsp; Pengalihan Penahanan &nbsp; Tahap &nbsp; Penyidikan &nbsp; (T-2) &nbsp; atau Surat &nbsp; Perintah &nbsp; Pencabutan &nbsp; Penangguhan Penahanan &nbsp; &nbsp; (T-8) &nbsp; &nbsp; atau &nbsp; &nbsp; Surat &nbsp; &nbsp; Perintah Pencabutan &nbsp; &nbsp; &nbsp; Pembantaran &nbsp; &nbsp; &nbsp; Penahanan kepada tersangka</p>', '15', 'menit', '', '2022-05-24 02:08:50', NULL, NULL),
(125, 26, '<p>Menerima Surat Perintah Penyitaan</p>', '10', 'menit', '', '2022-05-24 02:10:35', NULL, NULL),
(126, 23, '<p>Membawa &nbsp; &nbsp; tersangka &nbsp; &nbsp; ke &nbsp; &nbsp; Rumah &nbsp; &nbsp; sakit, Puskesmas &nbsp; &nbsp;atau &nbsp; &nbsp;poliklinik &nbsp; &nbsp;terdekat &nbsp; &nbsp;atau mengundang &nbsp; &nbsp; dokter &nbsp; &nbsp; untuk &nbsp; &nbsp; pemeriksaan kesehatan tersangka</p>', '30', 'menit', 'Tidak dilakukan dalam         hal pencabutan pembantaran penahanan karena laporan keterangan sehat  menjadi dasar pencabutan pembantaran penahanan', '2022-05-24 02:11:29', NULL, NULL),
(127, 23, '<p>Menyiapkan Berita Acara sebagai berikut :<br>1. &nbsp;Berita &nbsp; Acara &nbsp; Pencabutan &nbsp; Penangguhan Penahanan;<br>2. &nbsp;Berita Acara pengalihan penahanan; atau<br>3. &nbsp;Berita &nbsp; &nbsp;Acara &nbsp; &nbsp;Pencabutan &nbsp; &nbsp;Pembantaran Penahanan</p>', '1', 'jam', '', '2022-05-24 02:13:07', NULL, NULL),
(128, 23, '<p>Memakaikan &nbsp;rompi &nbsp;tahanan &nbsp;dan &nbsp;memborgol tangan tersangka</p>', '10', 'menit', '', '2022-05-24 02:13:38', NULL, NULL),
(129, 26, '<p>Melakukan Rapat Tim Penyidik untuk Mendata dan menginventarisir Barang/ dokumen yang menjadi obyek penyitaan</p>', '120', 'menit', '', '2022-05-24 02:13:52', NULL, NULL),
(130, 23, '<p>Membawa &nbsp; &nbsp;tersangka &nbsp; &nbsp;ke &nbsp; &nbsp;Rutan &nbsp; &nbsp;dengan pengawalan dari Kamdal dan polisi</p>', '30', 'menit', 'Waktu Disesuaikan jarak dari kantor ke rutan', '2022-05-24 02:14:29', NULL, NULL),
(131, 26, '<p>Melakukan pengamatan dan penggambaran lokasi penyitaan serta melakukan koordinasi dengan aparat keamanan/instansi terkait</p>', '8', 'jam', '', '2022-05-24 02:14:59', NULL, NULL),
(132, 23, '<p>Memasukkan tersangka ke Rutan</p>', '10', 'menit', 'Disesuaikan jarak dari kantor ke rutan', '2022-05-24 02:15:08', NULL, NULL),
(133, 24, '<p>Melakukan rapat tindakan pemeriksaan setempat</p>', '60', 'menit', '', '2022-05-24 02:15:30', NULL, NULL),
(134, 23, '<p>Menyelesaikan administrasi penahanan :</p><ul><li>Menandatangani Berita Acara Pencabutan Penangguhan Penahanan; atau Berita Acara pengalihan penahanan; atau Berita Acara Pencabutan Pembantaran Penahanan<br></li><li>&nbsp;menyerahkan &nbsp;Surat &nbsp;Perintah &nbsp;Pengalihan Penahanan &nbsp; Tahap &nbsp; Penyidikan &nbsp; (T-2) &nbsp; / Surat Perintah Pencabutan Penangguhan Penahanan &nbsp; &nbsp;(T-8) &nbsp; &nbsp;/ &nbsp; &nbsp;Surat &nbsp; &nbsp;Perintah Pencabutan &nbsp; &nbsp;Pembantaran &nbsp; &nbsp;Penahanan beserta &nbsp; &nbsp; Berita &nbsp; &nbsp; Acaranya &nbsp; &nbsp; dan &nbsp; &nbsp; surat keterangan &nbsp; &nbsp;sehat &nbsp; &nbsp;dari &nbsp; &nbsp;dokter &nbsp; &nbsp;kepada petugas Rutan<br></li><li>&nbsp;Menandatangai &nbsp;Berita &nbsp;Acara &nbsp;serah &nbsp;terima<br>tahanan</li></ul>', '30', 'menit', '', '2022-05-24 02:16:58', NULL, NULL),
(135, 26, '<p>Melakukan tindakan penyitaan :&nbsp;</p><ol><li>Mendatangi tempat penyitaan didampingi oleh petugas keamanan dan 2 (dua) orang saksi&nbsp;</li><li>Menunjukkan Surat Perintah Penyitaan / Penetapan Izin Penyitaan dari Ketua PN serta tanda pengenal&nbsp;</li><li>Menjelaskan maksud dan tujuan penyitaan&nbsp;</li><li>Memerintahkan penutupan akses keluar masuk tempat penyitaan&nbsp;</li><li>Mencari dan mencatat barang-barang yang ada kaitannya dengan tindak pidana yang disangkakan&nbsp;</li><li>Mendokumentasikan seluruh proses penyitaan&nbsp;</li><li>Menumpulkan barang/dokumen yang ada kaitannya dengan tindak pidana yang disangkakan untuk selanjutnya dilakukan Tindakan Penyitaan&nbsp;</li><li>Memberikan label dan kartu barang buktui&nbsp;</li><li>Membuat dan menandatangani berita acara penyitaan oleh penyidik, oang yang menguasai barang/dokumen dan 2 (dua) orang saksi&nbsp;</li><li>Menyimpan barang/dokumen di tempat barang bukti dan mencatat pada papan kontrol barang bukti</li></ol>', '8', 'jam', '', '2022-05-24 02:17:58', NULL, NULL),
(136, 24, '<p>Melakukan koordinasi pemeriksaan setempat dengan pihak internal dan pihak eksternal</p>', '180', 'menit', '', '2022-05-24 02:17:59', NULL, NULL),
(137, 23, '<p>Membuat &nbsp;Laporan &nbsp;Pelaksanaan &nbsp;Pengalihan Penahanan &nbsp; &nbsp; &nbsp; Tahap &nbsp; &nbsp; &nbsp; Penyidikan atau Pelaksanaan &nbsp; &nbsp; &nbsp;Pencabutan &nbsp; &nbsp; &nbsp;Penangguhan Penahanan &nbsp;atau &nbsp;Pencabutan Pembantaran Penahanan dalam bentuk Nota Dinas</p>', '120', 'menit', '', '2022-05-24 02:18:45', NULL, NULL),
(138, 26, '<p>Membuat laporan pelaksanaan Tindakan Penyitaan dalam bentuk Nota Dinas</p>', '120', 'menit', '', '2022-05-24 02:18:54', NULL, NULL),
(139, 23, '<p>Menyerahkan &nbsp; &nbsp; &nbsp; Nota &nbsp; &nbsp; &nbsp; DInas &nbsp; &nbsp; &nbsp; Laporan Pelaksanaan &nbsp;Pengalihan &nbsp;Penahanan &nbsp;Tahap Penyidikan &nbsp; atau &nbsp; Pelaksanaan &nbsp; Pencabutan Penangguhan &nbsp;Penahanan &nbsp;atau &nbsp;Pencabutan Pembantaran &nbsp;Penahanan &nbsp;ditujukan &nbsp;kepada pengendali secara berjenjang</p>', '15', 'menit', 'Sebagai  input SOP Pengendalian secara berjenjang', '2022-05-24 02:19:41', NULL, NULL),
(140, 26, '<p>Menyerahkan Nota Dinas Laporan pelaksanaan tindakan penyitaan ditujukan kepada pengendali secara berjenjang</p>', '15', 'menit', '', '2022-05-24 02:19:55', NULL, NULL),
(141, 24, '<p>Melakukan pemeriksaan setempat:&nbsp;</p><ol><li>Melakukan penelitian dan verifikasi atas tempat/lokasi, dan/atau objek antara lain berupa barang/ aset/alat/ dokumendan/ atau situasi dan kondisi daerah setempat</li><li>Mencatat dan mendokumentasikan peristiwa, fakta, kondisi fisik objek pemeriksaan setempat atau copy dokumen yang berkaitan dengan materi penyelidikan, (foto/video) dalam Berita Acara Pemeriksaan Setempat&nbsp;</li><li>Melakukan wawancara dengan pihak-pihak terkait dengan tujuan memperdalam segala kejadian/peristiwa yang berhubungan dengan objek pemeriksaan setempat, dan didokumentasikan dalam bentuk rekaman suara jika bersedia dan pokok-pokok keterangan dituangkan dalam Berita Acara Pemeriksaan Setempat&nbsp;</li><li>Dalam hal pemeriksaan setempat melibatkan Ahli maka Ahli melakukan tindakan-tindakan sesuai dengan keahliannya dan dicatat dalam Kertas Kerja Ahli. Kertas Kerja Ahli diketahui / disetujui oleh Tim Penyelidik dan Pihak yang terkait.&nbsp;</li><li>Pemeriksaan Setempat selesai dengan penandatanganan Berita Acara Pemeriksaan Setempat oleh Tim Penyelidik dan Pihak yang terkait, dan diakhiri ucapan terima kasih dari Tim Jaksa Penyelidik.</li></ol>', '3', 'hari', '', '2022-05-24 02:21:29', NULL, NULL),
(142, 30, '<p>Mempelajari seluruh hasil Tindakan Penyidikan</p>', '15', 'menit', '', '2022-05-24 02:22:05', NULL, NULL),
(143, 24, '<p>Membuat laporan hasil pelaksanaan pemeriksaan setempat dalam bentuk nota dinas</p>', '60', 'menit', '', '2022-05-24 02:23:05', NULL, NULL),
(144, 30, '<p>Menyusun Nota Dinas Laporan Perkembangan Penyidikan yang pada pokoknya memuat :<br>1. &nbsp; ringkasan keterangan saksi<br>2. &nbsp; ringkasan keterangan ahli<br>3. &nbsp; surat<br>4. &nbsp; Petunjuk / benda sitaan<br>5. &nbsp; keterangan tersangka (jika tersangka sudah pernah diperiksa)<br>6. &nbsp; barang bukti<br>7. &nbsp; Laporan &nbsp; &nbsp; Hasil &nbsp; &nbsp; Perhitungan &nbsp; &nbsp; Kerugian Kuangan Negara<br>8. &nbsp; Fakta Hukum<br>9. &nbsp; Pembahasan Yuridis<br>10. &nbsp;Problema / Hambatan<br>11. &nbsp;Kesimpulan<br>12. &nbsp;Saran / Pendapat</p>', '24', 'jam', 'Format     P-12     dimodifikasi dalam bentuk nota dinas', '2022-05-24 02:23:20', NULL, NULL),
(145, 29, '<p>Menerima Surat Perintah Penyegelan</p>', '10', 'menit', '', '2022-05-24 02:23:20', NULL, NULL),
(146, 30, '<p>Menyerahkan &nbsp; &nbsp; &nbsp; &nbsp;Nota &nbsp; &nbsp; &nbsp; &nbsp;Dinas &nbsp; &nbsp; &nbsp; &nbsp;Laporan Perkembangan Penyidikan kepada Pengendali secara berjenjang</p>', '15', 'menit', 'Sebagai         input         SOP pengendalian               secara berjenjang', '2022-05-24 02:24:12', NULL, NULL),
(147, 29, '<p>Mendata dan menginventarisir tempat/Barang/dokumen yang akan dilakukan Penyegelan</p>', '120', 'menit', '', '2022-05-24 02:24:21', NULL, NULL),
(148, 29, '<p>Melakukan Penyegelan tempat / Barang / dokumen :&nbsp;</p><ol><li>Memasang gembok/kunci</li><li>Memasang Segel pengaman (Kejaksaan Line)&nbsp;</li><li>Memasang pengumuman penyegelan&nbsp;</li><li>Mendokumentasikan tindakan penyegelan&nbsp;</li><li>Membuat dan Menandatangani Berita Acara Penyegelan</li></ol>', '180', 'menit', '', '2022-05-24 02:25:54', NULL, NULL),
(149, 29, '<p>Membuat penyegelan laporan pelaksananaan</p>', '180', 'menit', '', '2022-05-24 02:26:37', NULL, NULL),
(150, 31, '<p>Menerima Surat Perintah Penghentian Penyidikan</p>', '15', 'menit', '', '2022-05-24 02:26:38', '2022-05-24 10:02:21', NULL),
(151, 31, '<p>Melakukan Rapat Tim Penyidik terkait rencana pelaksanaan &nbsp; pengehentian &nbsp; penyidikan &nbsp; &nbsp;dan pengamatan situasi dan kondisi yang berkaitan dengan penghentian penyidikan</p>', '8', 'jam', '', '2022-05-24 02:27:06', NULL, NULL),
(152, 29, '<p>Menyerahkan Nota Dinas Laporan Pelaksanaan Penyegelan kepada pengendali secara berjenjang</p>', '10', 'menit', '', '2022-05-24 02:27:33', NULL, NULL),
(153, 31, '<p>Melakukan &nbsp;tindakan &nbsp;penghentian &nbsp;penyidikan dengan langkah-langkah sebagai berikut:<br>1. &nbsp; Menyerahkan &nbsp; &nbsp;salinan &nbsp; &nbsp;Surat &nbsp; &nbsp;Perintah Penghentian &nbsp; &nbsp; &nbsp; &nbsp; Penyidikan &nbsp; &nbsp; &nbsp; &nbsp; kepada Tersangka &nbsp; atau &nbsp; Terlapor, &nbsp; Pelapor &nbsp; dan Penuntut Umum<br>2. &nbsp; Mengambalikan &nbsp; barang &nbsp; bukti &nbsp; / &nbsp; benda sitaaan kepada siapa barang atau benda tersebut disita<br>3. &nbsp; Membuat &nbsp; &nbsp;Berita &nbsp; &nbsp;Acara &nbsp; &nbsp;Pelaksanaan Penghentian Penyidikan dan Berita Acara Pengembalian &nbsp; Barang &nbsp; Bukti &nbsp; / &nbsp; Benda Sitaan</p>', '8', 'jam', 'Dalam   hal   penghentian penyidikan   karena   satu atau   lebih   unsur   tindak pidana      korupsi      tidak terdapat cukup bukti atau tersangka          meninggal dunia,  sedangkan  secara nyata       ada       kerugian keuangan  Negara,  maka Berkas      perkara      dan barang   bukti   diserahkan kepada  Jaksa  Pengacara Negara    dengan    Berita Acara      Serah      Terima Berkas Perkara', '2022-05-24 02:28:42', NULL, NULL),
(154, 31, '<p>Membuat &nbsp;Nota &nbsp;Dinas &nbsp;Laporan &nbsp;pelaksanaan Penghentian Penyidikan</p>', '120', 'menit', '', '2022-05-24 02:29:14', NULL, NULL),
(155, 32, '<p>Menerima Surat Perintah Penitipan Barang Bukti / Benda Sitaan</p>', '10', 'menit', '', '2022-05-24 02:29:44', NULL, NULL),
(156, 31, '<p>Menyerahkan Nota Dinas Laporan pelaksanaan Penghentian Penyidikan kepada Pengendali secara berjenjang</p>', '15', 'menit', 'Sebagai input SOP Pengendalian secara berjenjang', '2022-05-24 02:30:01', '2022-05-24 09:59:24', NULL),
(157, 32, '<p>Mendata dan menginventarisir dan mengkaji status Barang Bukti / Benda Sitaan yang akan dititipkan</p>', '120', 'menit', '', '2022-05-24 02:31:14', NULL, NULL),
(158, 33, '<p>Membuat &nbsp; Nota &nbsp; Dinas &nbsp; Laporan &nbsp; pelaksanaan penyerahan &nbsp; tanggung &nbsp; jawab &nbsp; tersangka &nbsp; dan barang bukti</p>', '15', 'menit', '', '2022-05-24 02:31:56', NULL, NULL),
(159, 32, '<p>Melakukan Penitipan Barang Bukti / Benda Sitaan :&nbsp;</p><ol><li>Melakukan koordinasi dengan orang/instansi yang menguasai Barang Bukti / Benda Sitaan&nbsp;</li><li>Menyerahkan Barang Bukti / Benda Sitaan dengan membuat berita acara penitpan Barang Bukti / Benda Sitaan&nbsp;</li><li>Menandatangani berita acara Penitipan Barang Bukti / Benda Sitaan dengan pihak yang menerima titipan Barang Bukti / Benda Sitaan disaksikan oleh 2 (dua) orang saksi</li></ol>', '180', 'menit', '', '2022-05-24 02:32:47', NULL, NULL),
(160, 32, '<p>Membuat laporan pelaksananaan Penitipan Barang Bukti / Benda Sitaan</p>', '180', 'menit', '', '2022-05-24 02:33:59', NULL, NULL),
(161, 33, '<p>Melakukan koordinasi :</p><ul><li>Rumah Tahanan Negara dalam rangka meminjam tahanan<br></li><li>Penuntut Umum<br></li><li>Pengelola Barang Bukti<br></li><li>Kejaksaan negeri setempat<br></li><li>pihak &nbsp; &nbsp;Kepolisian &nbsp; &nbsp;untuk &nbsp; &nbsp;meminta bantuan pengawalan<br></li><li>Rumah sakit, Puskesmas atau poliklinik terdekat untuk pemeriksaan kesehatan</li></ul>', '8', 'jam', '', '2022-05-24 02:34:38', NULL, NULL),
(162, 32, '<p>Menyerahkan Nota Dinas Laporan Pelaksanaan Nota Dinas Laporan Pelaksanaan Penitipan Barang Bukti / Benda Sitaan kepada pengendali secara berjenjang</p>', '10', 'menit', '', '2022-05-24 02:35:39', '2022-05-24 02:39:45', NULL),
(163, 33, '<p>Melakukan &nbsp; &nbsp;serah &nbsp; &nbsp;terima &nbsp; &nbsp;tersangka &nbsp; &nbsp;dan barang bukti :<br>1. &nbsp; Menjemput tersangka di Rutan (dalam hal tersangka &nbsp; &nbsp; ditahan &nbsp; &nbsp; di &nbsp; &nbsp; rutan) &nbsp; &nbsp; atau menunggu &nbsp; tersangka &nbsp; hadir &nbsp; (dalam &nbsp; hal tersangka tidak ditahan)<br>2. &nbsp; Mengecek kesehatan tersangka<br>3. &nbsp; Bersama-sama &nbsp; &nbsp; &nbsp; &nbsp; Penuntut &nbsp; &nbsp; &nbsp; &nbsp; Umum melakukan &nbsp;penelitian &nbsp;barang &nbsp;bukti &nbsp;dan tersangka<br>4. &nbsp; Menerima salinan Berita Acara Penerimaan dan &nbsp; Penelitian &nbsp; Tersangka &nbsp; (BA-15) &nbsp; serta Berita &nbsp; Acara &nbsp; Penerimaan &nbsp; dan &nbsp; Penelitian Barang &nbsp;Sitaan/Barang &nbsp;Bukti &nbsp;(BA-18) &nbsp;yang dibuat oleh Penuntut Umum</p>', '8', 'jam', 'Dalam    hal    penahanan tahap     penyidikan     dan tahap      penuntutan      di Rutan      yang      berbeda diperlukan      pengecekan kesehatan tersangka', '2022-05-24 02:35:48', '2022-05-24 02:38:46', NULL),
(164, 33, '<p>Membuat &nbsp; Nota &nbsp; Dinas &nbsp; Laporan &nbsp; pelaksanaan penyerahan &nbsp; tanggung &nbsp; jawab &nbsp; tersangka &nbsp; dan barang bukti</p>', '120', 'menit', '', '2022-05-24 02:36:58', NULL, NULL),
(165, 33, '<p>Menyerahkan Nota Dinas Laporan pelaksanaan penyerahan &nbsp; tanggung &nbsp; jawab &nbsp; tersangka &nbsp; dan barang &nbsp; &nbsp;bukti &nbsp; &nbsp;kepada &nbsp; &nbsp;Pengendali &nbsp; &nbsp;secara berjenjang</p>', '15', 'menit', 'Nota     Dinas     Laporan pelaksanaan  penyerahan tanggung                jawab tersangka    dan    barang bukti terkirim', '2022-05-24 02:38:13', NULL, NULL),
(166, 34, '<p>Menerima surat perintah tugas pelacakan aset tahap penyelidikan</p>', '10', 'menit', '', '2022-05-24 10:48:38', NULL, NULL),
(167, 34, '<p>Melakukan kordinasi dengan tim jaksa penyelidik</p>', '60', 'menit', 'Koordinasi dalam hal untuk mengetahui pihak- pihak yang terkait guna menentukan penyesuaian jadwal', '2022-05-24 10:50:32', NULL, NULL),
(168, 34, '<p>Mempelajari, menginventarisir, profiling baik nama atau identitas pihak yang akan di PA maupun lokasi/ instansi yang akan dilakukan PA</p>', '8', 'jam', '', '2022-05-24 10:52:10', NULL, NULL),
(169, 34, '<p>Melakukan koordinasi dengan pihak-pihak terkait yang berkaitan dengan informasi dan data keberadaan, jenis dan jumlah aset barang/ harta benda beserta dokumen- dokumen kepemilikan</p>', '24', 'jam', '', '2022-05-24 10:56:19', NULL, NULL),
(170, 34, '<p>Melakukan pelacakan aset terhadap barang/ harta benda berupa jenis/ tahun perolehan, jumlah, bukti/ dokumen kepemilikan, harta kekayaan dikuasai/ disimpan oleh siapa serta lokasi tempat keberadaan harta benda tersebut.</p>', '40', 'jam', 'Bahan keterangan dan data tentang harta benda/ aset baik bergerak maupun tidak bergerak baik jenis, jumlah, bukti/ dokumen kepemilikan,dan tahun perolehan. Harta kekayaan dikuasai/ disimpan oleh siapa serta lokasi tempat keberadaan harta benda tersebut.', '2022-05-24 10:59:37', NULL, NULL),
(171, 34, '<p>Melakukan pengolahan data dan informasi atas harta benda/aset yang didapatkan baik berupa foto harta benda aset, keberadaan aset serta jumlah dan kondisi aset serta menginventarisir/memilah/mendata barang/harta benda tersebut</p>', '120', 'menit', '', '2022-05-24 11:01:06', NULL, NULL),
(172, 34, '<p>Menyusun nota dinas laporan hasil pelaksanaan tugas pelacakan aset tahap penyelidikan&nbsp;</p>', '8', 'jam', '', '2022-05-24 11:02:20', NULL, NULL),
(173, 34, '<p>Menyerahkan hasil pelaksanaan tugas pelacakan aset tahap penyelidikan dalam bentuk nota dinas kepada pengendali secara berjenjang.</p>', '10', 'menit', 'Sebagai input sop pengendalian secara berjenjang', '2022-05-24 11:03:52', NULL, NULL);

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
(17, 10, 'Surat perintah tugas', '2022-05-23 19:26:33', NULL, NULL),
(18, 10, 'Nota dinas telaahan', '2022-05-23 19:26:50', NULL, NULL),
(19, 10, 'Laporan dan pengaduan masyarakat', '2022-05-23 19:27:06', NULL, NULL),
(20, 11, 'Surat perintah tugas', '2022-05-23 19:26:33', NULL, NULL),
(21, 11, 'Nota dinas telaahan', '2022-05-23 19:26:50', NULL, NULL),
(22, 11, 'Laporan dan pengaduan masyarakat', '2022-05-23 19:27:06', NULL, NULL),
(23, 22, 'Surat perintah jaksa penelaah / disposisi', '2022-05-23 19:47:51', NULL, NULL),
(24, 22, 'Laporan dan pengaduan masyarakat', '2022-05-23 19:47:51', NULL, NULL),
(25, 22, 'Catatan atas laporan dan pengaduan masyarakat', '2022-05-23 19:47:51', NULL, NULL),
(26, 22, 'Peraturan perundang- undangan terkait', '2022-05-23 19:47:51', NULL, NULL),
(27, 22, 'Dokumen/data/informasi terkait laporan dan pengaduan masyarakat', '2022-05-23 19:47:51', NULL, NULL),
(28, 23, 'Laporan hasil pelaksanaan tugas pengayaan informasi/data', '2022-05-23 19:50:50', NULL, NULL),
(29, 23, 'Buku ekspedisi', '2022-05-23 19:50:50', NULL, NULL),
(30, 24, 'Surat perintah penyelidikan', '2022-05-23 19:54:07', NULL, NULL),
(31, 24, 'Nota dinas telaahan atas laporan pengaduan masyarakat', '2022-05-23 19:54:07', NULL, NULL),
(32, 25, 'Surat perintah penyelidikan', '2022-05-23 19:56:07', NULL, NULL),
(33, 25, 'Nota dinas telaahan atas laporan pengaduan masyarakat', '2022-05-23 19:56:07', NULL, NULL),
(34, 25, 'Laporan pengaduan masyarakat', '2022-05-23 19:56:07', NULL, NULL),
(35, 26, 'Notulen rapat', '2022-05-23 20:02:42', NULL, NULL),
(36, 26, 'Rencana penyelidikan', '2022-05-23 20:02:42', NULL, NULL),
(37, 27, 'Nota pendapat untuk melakukan tindakan penyelidikan', '2022-05-23 20:04:20', NULL, NULL),
(38, 27, 'Buku ekspedisi', '2022-05-23 20:04:20', NULL, NULL),
(39, 28, 'Surat perintah penyelidikan', '2022-05-23 20:07:21', NULL, NULL),
(40, 28, 'Rencana penyelidikan', '2022-05-23 20:07:21', NULL, NULL),
(41, 28, 'Disposisi atas nota pendapat tindakan permintaan keterangan', '2022-05-23 20:07:21', NULL, NULL),
(42, 29, 'Surat perintah penyelidikan', '2022-05-23 20:09:36', NULL, NULL),
(43, 29, 'Rencana penyelidikan', '2022-05-23 20:09:36', NULL, NULL),
(44, 29, 'Disposisi atas nota pendapat tindakan permintaan keterangan', '2022-05-23 20:09:36', NULL, NULL),
(45, 30, 'Surat  Perintah  Tugas Pengelolaan BBE', '2022-05-23 20:35:13', NULL, NULL),
(46, 32, 'Jadwal Pengelolaan BBE', '2022-05-24 00:31:02', NULL, NULL),
(47, 32, 'Keberadaan BBE', '2022-05-24 00:31:02', NULL, NULL),
(48, 32, 'Jumlah dan Jenis BBE', '2022-05-24 00:31:02', NULL, NULL),
(49, 32, 'Kondisi BBE', '2022-05-24 00:31:02', NULL, NULL),
(50, 33, 'Barang Bukti Elektronik ', '2022-05-24 00:33:37', NULL, NULL),
(51, 33, 'Daftar Barang Bukti', '2022-05-24 00:33:37', NULL, NULL),
(52, 34, 'Daftar Inventarisasi Barang Bukti', '2022-05-24 00:37:25', NULL, NULL),
(53, 34, 'Barang Bukti Elektronik', '2022-05-24 00:37:25', NULL, NULL),
(54, 35, 'Daftar Klasifikasi Barang Bukti Elektronik', '2022-05-24 00:41:46', NULL, NULL),
(55, 35, 'Barang Bukti Elektronik', '2022-05-24 00:41:46', NULL, NULL),
(56, 36, 'Barang Bukti Elektronik', '2022-05-24 00:44:48', NULL, NULL),
(57, 37, 'Hasil Pengelolaan Barang Bukti Elektronik', '2022-05-24 00:47:15', NULL, NULL),
(58, 38, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti Elektronik', '2022-05-24 00:52:04', NULL, NULL),
(59, 39, 'Surat panggilan saksi', '2022-05-24 00:53:55', NULL, NULL),
(60, 40, 'Surat Perintah Pengelolaan Bukti Tugas Barang', '2022-05-24 00:55:49', NULL, NULL),
(61, 39, 'Fotocopy identitas saksi', '2022-05-24 00:55:53', NULL, NULL),
(62, 41, 'Surat Perintah Pengelolaan Bukti Tugas Barang', '2022-05-24 00:57:37', NULL, NULL),
(63, 42, 'Surat perintah penyidikan', '2022-05-24 00:58:05', NULL, NULL),
(64, 42, 'Daftar hadir saksi', '2022-05-24 00:58:05', NULL, NULL),
(65, 42, 'peraturan perundang-undangan', '2022-05-24 00:58:05', NULL, NULL),
(66, 43, 'Jadwal Pengelolaan Barang Bukti ', '2022-05-24 00:59:01', NULL, NULL),
(67, 44, 'Blanko data informasi saksi', '2022-05-24 00:59:12', NULL, NULL),
(68, 45, 'Barang Bukti ', '2022-05-24 01:00:39', NULL, NULL),
(69, 45, 'Daftar Barang Bukti', '2022-05-24 01:00:39', NULL, NULL),
(70, 46, 'Barang Bukti ', '2022-05-24 01:02:56', NULL, NULL),
(71, 46, 'Daftar Inventarisasi Barang Bukti ', '2022-05-24 01:02:56', NULL, NULL),
(72, 47, 'Surat perintah penyidikan', '2022-05-24 01:02:59', NULL, NULL),
(73, 47, 'Daftar hadir saksi', '2022-05-24 01:02:59', NULL, NULL),
(74, 47, 'Peraturan perundang-undangan', '2022-05-24 01:02:59', NULL, NULL),
(75, 47, 'Surat-surat/dokumen', '2022-05-24 01:02:59', NULL, NULL),
(76, 47, 'Alat bukti lainnya', '2022-05-24 01:02:59', NULL, NULL),
(77, 48, 'Berita acara pemeriksaan saksi', '2022-05-24 01:04:29', NULL, NULL),
(78, 49, 'Berita acara pemeriksaan saksi terkoreksi', '2022-05-24 01:06:10', NULL, NULL),
(79, 50, 'Daftar Klasifikasi Barang Bukti ', '2022-05-24 01:07:44', NULL, NULL),
(80, 50, 'Barang Bukti ', '2022-05-24 01:07:44', NULL, NULL),
(81, 51, 'Berita acara pemeriksaan saksi tercetak', '2022-05-24 01:07:44', NULL, NULL),
(82, 52, 'Barang Bukti Terkelola', '2022-05-24 01:08:57', NULL, NULL),
(83, 53, 'Surat perintah penyidikan', '2022-05-24 01:09:55', NULL, NULL),
(84, 53, 'Daftar hadir ahli', '2022-05-24 01:09:55', NULL, NULL),
(85, 53, 'Peraturan perundang-undangan', '2022-05-24 01:09:55', NULL, NULL),
(86, 54, 'Kitab suci', '2022-05-24 01:10:38', NULL, NULL),
(87, 55, 'Hasil Pengelolaan Barang Bukti', '2022-05-24 01:10:55', NULL, NULL),
(88, 56, 'Surat Perintah Penyidikan', '2022-05-24 01:13:12', NULL, NULL),
(89, 56, 'Daftar hadir ahli', '2022-05-24 01:13:12', NULL, NULL),
(90, 56, 'Peraturan perundang-undangan', '2022-05-24 01:13:12', NULL, NULL),
(91, 56, 'Surat-surat/dokumen', '2022-05-24 01:13:12', NULL, NULL),
(92, 56, 'alat bukti lainnya', '2022-05-24 01:13:12', NULL, NULL),
(93, 57, 'Nota Dinas Laporan Hasil Pelaksanaan Tugas Pengelolaan Barang Bukti', '2022-05-24 01:13:29', NULL, NULL),
(94, 57, 'Buku Ekspedisi', '2022-05-24 01:13:29', NULL, NULL),
(95, 58, 'Berita acara pemeriksaan saksi', '2022-05-24 01:14:10', NULL, NULL),
(96, 59, 'Berita      Acara terkoreksi pemeriksaan ahli', '2022-05-24 01:15:16', NULL, NULL),
(97, 60, 'Surat Perintah Penyidikan ', '2022-05-24 01:17:06', NULL, NULL),
(98, 60, 'Disposisi atas ota Pendapat Utuk Melakukan Tindak Hukum Penyidikan', '2022-05-24 01:17:06', NULL, NULL),
(99, 61, ' Berita Acara pemeriksaan ahli tercetak', '2022-05-24 01:17:15', NULL, NULL),
(100, 62, 'Disposisi atas Nota Pendapat Untuk Melakukan Tindakan Hukum Penyidikan diterima', '2022-05-24 01:18:31', NULL, NULL),
(101, 63, 'Surat Panggilan tersangka', '2022-05-24 01:18:57', NULL, NULL),
(102, 63, 'Fotocopi identitas tersangka', '2022-05-24 01:18:57', NULL, NULL),
(103, 64, 'Berita acara koordinasi', '2022-05-24 01:20:02', NULL, NULL),
(104, 64, 'Surat Keterangan Sehat', '2022-05-24 01:20:02', NULL, NULL),
(105, 64, 'Surat Pengeluaran tahanan dari rutan', '2022-05-24 01:20:02', NULL, NULL),
(106, 64, 'Buku ekspedisi', '2022-05-24 01:20:02', NULL, NULL),
(107, 65, 'Surat Perintah Penyidikan', '2022-05-24 01:20:54', NULL, NULL),
(108, 65, 'Daftar hadir tersangka', '2022-05-24 01:20:54', NULL, NULL),
(109, 65, 'Peraturan perundang-undangan', '2022-05-24 01:20:54', NULL, NULL),
(110, 66, 'Blangko data informasi tersangka', '2022-05-24 01:21:40', NULL, NULL),
(111, 67, 'Nota Dinas Laporan Pelaksanaan Tindakan Hukum Lainnya', '2022-05-24 01:22:00', NULL, NULL),
(112, 68, 'Nota Dinas Laporan Pelaksanaan Tindakan Hukum Lainnya', '2022-05-24 01:23:17', NULL, NULL),
(113, 68, 'Buku Ekspedisi ', '2022-05-24 01:23:17', NULL, NULL),
(114, 69, 'Surat Perintah Penyidikan', '2022-05-24 01:24:51', NULL, NULL),
(115, 69, 'Daftar hadir tersangka', '2022-05-24 01:24:51', NULL, NULL),
(116, 69, ' Peraturan perundang-undangan', '2022-05-24 01:24:51', NULL, NULL),
(117, 69, ' Peraturan perundang-undangan', '2022-05-24 01:24:51', NULL, NULL),
(118, 69, 'Surat-surat/dokumen', '2022-05-24 01:24:51', NULL, NULL),
(119, 70, 'Berita acara pemeriksaan tersangka', '2022-05-24 01:26:39', NULL, NULL),
(120, 71, 'Surat perintah Penahanan (T-2) atau', '2022-05-24 01:27:43', NULL, NULL),
(121, 71, 'Surat Perpanjangan Penahanan (T-4) atau', '2022-05-24 01:27:43', NULL, NULL),
(122, 71, 'Penetapan Perpanjangan Penahanan dari Ketua PN', '2022-05-24 01:27:43', NULL, NULL),
(123, 72, 'berita acara pemeriksaan tersangka terkoreksi', '2022-05-24 01:28:24', NULL, NULL),
(124, 73, 'Surat perintah Penahanan(T-2)', '2022-05-24 01:29:50', NULL, NULL),
(125, 73, 'Surat permintaan bantuan pengawalan ke kamdal/kepolisian (Pidsus 20A/B)', '2022-05-24 01:29:50', NULL, NULL),
(126, 73, 'Surat permintaan pemeriksaan kesehatan tersangka', '2022-05-24 01:29:50', NULL, NULL),
(127, 74, 'Berita   Acara   pemeriksaan   tersangka tercetak', '2022-05-24 01:30:07', NULL, NULL),
(128, 75, 'Buku Ekspedisi', '2022-05-24 01:31:11', NULL, NULL),
(129, 76, 'Surat perintah penyidikan', '2022-05-24 01:32:16', NULL, NULL),
(130, 77, 'Surat perintah penyidikan', '2022-05-24 01:33:40', NULL, NULL),
(131, 77, 'Berkas perkara hasil penyelidikan', '2022-05-24 01:33:40', NULL, NULL),
(132, 78, 'Surat perintah Penahanan(T-2)', '2022-05-24 01:34:13', NULL, NULL),
(133, 78, 'Surat        permintaan        pemeriksaan kesehatan tersangka', '2022-05-24 01:34:13', NULL, NULL),
(134, 79, 'Notulen rapat', '2022-05-24 01:35:22', NULL, NULL),
(135, 80, 'Berita Acara Penahanan (BA-10)', '2022-05-24 01:36:29', NULL, NULL),
(136, 80, 'Berita Acara menolak menandatangani Berita Acara Penahanan', '2022-05-24 01:36:29', NULL, NULL),
(137, 80, 'Berita Acara Penolakan menandatangani Berita Acara Penahanan dan Berita Acara menolak menandatangani Berita Acara Penahanan', '2022-05-24 01:36:29', NULL, NULL),
(138, 81, 'Rompi Tahanan dan Borgol', '2022-05-24 01:37:16', NULL, NULL),
(139, 82, 'Kamera', '2022-05-24 01:38:02', NULL, NULL),
(140, 83, 'Surat perintah penyelidikan', '2022-05-24 01:38:53', NULL, NULL),
(141, 83, 'Disposisi atas nota pendapat tindakan permintaan keterangan', '2022-05-24 01:38:53', NULL, NULL),
(142, 83, 'Surat penggilan permintaan keterangan', '2022-05-24 01:38:53', NULL, NULL),
(143, 83, 'Buku ekspedisi', '2022-05-24 01:38:53', NULL, NULL),
(144, 84, 'Buku ekspedisi', '2022-05-24 01:38:55', NULL, NULL),
(145, 84, 'Nota Pendapat untuk indakan hukum penyidikan', '2022-05-24 01:38:55', NULL, NULL),
(146, 85, 'Mobil Tahanan', '2022-05-24 01:39:15', NULL, NULL),
(147, 87, 'Surat Perintah Tugas Pelacakan Aset Tahap Penyidikan', '2022-05-24 01:41:16', NULL, NULL),
(148, 88, 'Surat   Perintah   Penahanan   dan   surat keterangan   sehat   dari   dokter   kepada petugas rutan', '2022-05-24 01:41:48', NULL, NULL),
(149, 88, 'Berita  Acara  Penahanan  (BA-10)  atau Berita  Acara  Menolak  menandatangani Berita       Acara       Penahanan       atau Penolakan menandatangani Berita Acara Penahanan  dan  Berita  Acara  Menolak menandatangani          Berita          Acara Penahan', '2022-05-24 01:41:48', NULL, NULL),
(150, 89, 'Identitas Tersangka', '2022-05-24 01:42:47', NULL, NULL),
(151, 89, 'Surat Perintah Tugas Pelacakan Aset Tahap Penyidikan', '2022-05-24 01:42:47', NULL, NULL),
(152, 90, 'Surat Perintah Penahanan (T-2) / Surat Perpanjangan Penahanan (T-4) / Penetapan Perpanjangan Penahanan dari Ketua PN', '2022-05-24 01:43:34', NULL, NULL),
(153, 90, 'Buku Ekspedisi', '2022-05-24 01:43:34', NULL, NULL),
(154, 91, ' Jadwal PelacakanAset', '2022-05-24 01:44:35', NULL, NULL),
(155, 91, 'Identitas tersangka (KTP atau KK)', '2022-05-24 01:44:35', NULL, NULL),
(156, 92, 'Surat perintah penyelidikan', '2022-05-24 01:45:14', NULL, NULL),
(157, 92, 'Laporan dan Pengaduan Masyarakat', '2022-05-24 01:45:14', NULL, NULL),
(158, 92, 'Catatan atas laporan dan pengaduan masyarakat', '2022-05-24 01:45:14', NULL, NULL),
(159, 92, 'Peraturan perundang-undangan terkait.', '2022-05-24 01:45:14', NULL, NULL),
(160, 92, 'Dokumen/data/informasi terkait laporan dan pengaduan masyarakat', '2022-05-24 01:45:14', NULL, NULL),
(161, 92, 'Surat panggilan permintaan keterangan', '2022-05-24 01:45:14', NULL, NULL),
(162, 92, 'Fotocopi identitas', '2022-05-24 01:45:14', NULL, NULL),
(163, 92, 'Blanko data nik/kelurga dan harta kekayaan.', '2022-05-24 01:45:14', NULL, NULL),
(164, 93, 'Nota    Dinas    Laporan    pelaksanaan Tindakan Penahanan', '2022-05-24 01:45:29', NULL, NULL),
(165, 93, 'Berita Acara Penahanan', '2022-05-24 01:45:29', NULL, NULL),
(166, 94, 'Berita acara permintaan keterangan', '2022-05-24 01:47:25', NULL, NULL),
(167, 95, 'Nota Dinas Laporan Pelaksanaan Tindakan Penahanan  ', '2022-05-24 01:47:29', NULL, NULL),
(168, 95, 'Buku Ekspedisi', '2022-05-24 01:47:29', NULL, NULL),
(169, 96, 'Informasi dan data tentang indentitas tersangka dan keluarga tersangka', '2022-05-24 01:47:55', NULL, NULL),
(170, 97, 'informasi dan data', '2022-05-24 01:49:33', NULL, NULL),
(171, 98, 'Surat perintah penyelidikan', '2022-05-24 01:51:00', NULL, NULL),
(172, 98, 'Rencana penyelidikan', '2022-05-24 01:51:00', NULL, NULL),
(173, 98, 'Disposisi atas nota pendapat tindakan permintaan dokumen', '2022-05-24 01:51:00', NULL, NULL),
(174, 99, 'Surat perintah Pengalihan Jenis Penahanan Tahap Penyidikan (T-2)', '2022-05-24 01:52:36', NULL, NULL),
(175, 99, 'Surat Perintah Penangguhan Penahanan (T-8)', '2022-05-24 01:52:36', NULL, NULL),
(176, 99, 'Surat Perintah Pembantaran Penahanan', '2022-05-24 01:52:36', NULL, NULL),
(177, 100, 'Surat perintah penyelidikan', '2022-05-24 01:53:10', NULL, NULL),
(178, 100, 'Rencana penyelidikan', '2022-05-24 01:53:10', NULL, NULL),
(179, 100, 'Disposisi atas nota pendapat tindakan permintaan dokumen', '2022-05-24 01:53:10', NULL, NULL),
(180, 101, 'Surat perintah Pengalihan Jenis Penahanan Tahap Penyidikan (T-2)', '2022-05-24 01:54:25', NULL, NULL),
(181, 101, 'Surat Perintah Penangguhan Penahanan (T-8)', '2022-05-24 01:54:25', NULL, NULL),
(182, 101, 'Surat Perintah Pembantaran Penahanan', '2022-05-24 01:54:25', NULL, NULL),
(183, 102, 'Surat perintah penyelidikan', '2022-05-24 01:56:00', NULL, NULL),
(184, 102, 'Rencana penyelidikan', '2022-05-24 01:56:00', NULL, NULL),
(185, 102, 'Disposisi atas nota pendapat tindakan permintaan dokumen', '2022-05-24 01:56:00', NULL, NULL),
(186, 102, 'Notulen rapat tim penyelidik', '2022-05-24 01:56:00', NULL, NULL),
(187, 103, ' Buku ekspedisi', '2022-05-24 01:56:04', NULL, NULL),
(188, 104, 'Harta/Aset kekayaan tersangka', '2022-05-24 01:56:30', NULL, NULL),
(189, 105, 'Informasi dan Data', '2022-05-24 01:57:49', NULL, NULL),
(190, 106, 'Berita   acara   Pengalihan   Penahanan Tahap Penyidikan (BA-11) atau Berita  Acara Penangguhan  Penahanan (BA-12) atau Berita Acara Pembantaran Penahanan', '2022-05-24 01:57:57', NULL, NULL),
(191, 107, 'Berita   acara   Pengalihan   Penahanan Tahap Penyidikan (BA-11) atau', '2022-05-24 01:59:08', NULL, NULL),
(192, 107, 'Berita  Acara Penangguhan  Penahanan (BA-12) atau', '2022-05-24 01:59:08', NULL, NULL),
(193, 107, 'Berita Acara Pembantaran Penahanan', '2022-05-24 01:59:08', NULL, NULL),
(194, 108, 'Buku Ekspedisi', '2022-05-24 01:59:37', NULL, NULL),
(195, 108, 'Nota    Dinas    Laporan Hasil        Pelaksanaan Tugas  Pelacakan  Aset Tahap Penyidikan', '2022-05-24 01:59:37', NULL, NULL),
(196, 109, 'Surat perintah penyelidikan', '2022-05-24 02:00:12', NULL, NULL),
(197, 109, 'Rencana penyelidikan', '2022-05-24 02:00:12', NULL, NULL),
(198, 109, 'Disposisi atas nota pendapat tindakan permintaan dokumen', '2022-05-24 02:00:12', NULL, NULL),
(199, 109, 'Notulen rapat tim penyelidik', '2022-05-24 02:00:12', NULL, NULL),
(200, 110, 'Nota    Dinas    Laporan    pelaksanaan Tindakan      Pengalihan      Penahanan Tahap  Penyidikan  atau  Penangguhan Penahanan        atau        Pembantaran Penahanan', '2022-05-24 02:01:06', NULL, NULL),
(201, 110, 'Berita   Acara   pelaksanaan   Tindakan Pengalihan        Penahanan        Tahap Penyidikan        atau        Penangguhan Penahanan        atau        Pembantaran Penahanan', '2022-05-24 02:01:06', NULL, NULL),
(202, 111, 'Penetapan izin/persetujuan penggeledahan', '2022-05-24 02:01:08', NULL, NULL),
(203, 111, 'Surat Perintah Penggeledahan', '2022-05-24 02:01:08', NULL, NULL),
(204, 112, 'Nota    Dinas    Laporan    pelaksanaan Pengalihan        Penahanan        Tahap Penyidikan        atau        Penangguhan Penahanan        atau        Pembantaran Penahanan', '2022-05-24 02:01:57', NULL, NULL),
(205, 112, 'Buku Ekspedisi', '2022-05-24 02:01:57', NULL, NULL),
(206, 113, 'Tanda penerimaan dokumen ', '2022-05-24 02:02:05', NULL, NULL),
(207, 113, 'Dokumen /data', '2022-05-24 02:02:05', NULL, NULL),
(208, 113, 'Benda', '2022-05-24 02:02:05', NULL, NULL),
(209, 114, 'Surat perintah penggeledahan', '2022-05-24 02:02:30', NULL, NULL),
(210, 115, 'Tanda terima dokumen', '2022-05-24 02:03:36', NULL, NULL),
(211, 116, 'Rencana kegiatan pengeledahan', '2022-05-24 02:03:36', NULL, NULL),
(212, 117, 'Surat Perintah Pengalihan Penahanan Tahap Penyidikan (T-2)', '2022-05-24 02:05:11', NULL, NULL),
(213, 117, 'Surat Perintah Pencabutan Penangguhan Penahanan (T-8)', '2022-05-24 02:05:11', NULL, NULL),
(214, 117, 'Surat Perintah Pencabutan Pembantaran Penahanan', '2022-05-24 02:05:11', NULL, NULL),
(215, 118, 'Dokumentasi    lokasi penggeledahan', '2022-05-24 02:05:58', NULL, NULL),
(216, 118, 'Berita acara koordinasi', '2022-05-24 02:05:58', NULL, NULL),
(217, 118, 'Penetapan izin/persetujuan penggeledahan', '2022-05-24 02:05:58', NULL, NULL),
(218, 118, 'Surat   Perintah Penggeledahan', '2022-05-24 02:05:58', NULL, NULL),
(219, 119, 'Nota dinas laporan hasil permintaan dan penerimaan dokumen', '2022-05-24 02:05:58', NULL, NULL),
(220, 120, 'Surat  Perintah  Pengalihan  Penahanan Tahap Penyidikan (T-2)', '2022-05-24 02:07:08', NULL, NULL),
(221, 120, 'Surat            Perintah            Pencabutan Penangguhan Penahanan (T-8)', '2022-05-24 02:07:08', NULL, NULL),
(222, 120, 'Surat            Perintah            Pencabutan Pembantaran Penahanan', '2022-05-24 02:07:08', NULL, NULL),
(223, 120, 'Surat  permintaan  bantuan  pengawalan ke kamdal/kepolisian (Pidsus 20A/B)', '2022-05-24 02:07:08', NULL, NULL),
(224, 120, 'Surat         permintaan         pemeriksaan kesehatan tersangka', '2022-05-24 02:07:08', NULL, NULL),
(225, 121, 'daftar barang hasil penggeledahan', '2022-05-24 02:07:11', NULL, NULL),
(226, 121, 'Berita Acara penggeledahan', '2022-05-24 02:07:11', NULL, NULL),
(227, 123, ' Buku ekspedisi', '2022-05-24 02:08:19', NULL, NULL),
(228, 123, 'Nota Dinas Laporan pelaksanaan tindakan penggeledahan', '2022-05-24 02:08:19', NULL, NULL),
(229, 124, 'Surat Perintah Pengalihan Penahanan Tahap Penyidikan (T-2) atau Surat Perintah Pencabutan Penangguhan Penahanan (T-8) atau Surat Perintah Pencabutan Pembantaran Penahanan atau Buku ekspedisi', '2022-05-24 02:08:50', NULL, NULL),
(230, 125, 'Berita  Acara Penggeledahan', '2022-05-24 02:10:35', NULL, NULL),
(231, 125, 'Penetapan izin/persetujuan penyitaan', '2022-05-24 02:10:35', NULL, NULL),
(232, 125, 'Surat Perintah Penyitaan', '2022-05-24 02:10:35', NULL, NULL),
(233, 126, 'Surat Perintah Pengalihan Penahanan Tahap Penyidikan (T-2) atau Surat Perintah Pencabutan Penangguhan Penahanan (T-8) atau  Surat Perintah Pencabutan Pembantaran Penahanan', '2022-05-24 02:11:29', NULL, NULL),
(234, 126, 'Surat        permintaan        pemeriksaan kesehatan tersangka', '2022-05-24 02:11:29', NULL, NULL),
(235, 122, 'Surat perintah penyelidikan', '2022-05-24 02:11:46', NULL, NULL),
(236, 122, 'Rencana penyelidikan', '2022-05-24 02:12:01', NULL, NULL),
(237, 122, 'Nota pendapat tindakan pemeriksaan setempat', '2022-05-24 02:12:30', NULL, NULL),
(238, 122, 'Surat perintah tugas', '2022-05-24 02:12:49', NULL, NULL),
(239, 127, 'Berita Acara Pencabutan Penangguhan Penahanan', '2022-05-24 02:13:07', NULL, NULL),
(240, 127, 'Berita Acara pengalihan penahanan', '2022-05-24 02:13:07', NULL, NULL),
(241, 127, 'Berita Acara Pencabutan Pembantaran Penahanan', '2022-05-24 02:13:07', NULL, NULL),
(242, 128, ' Rompi Tahanan dan Borgol', '2022-05-24 02:13:38', NULL, NULL),
(243, 129, 'Berita Acara Penggeledahan', '2022-05-24 02:13:52', NULL, NULL),
(244, 129, 'Penetapan izin/persetujuan penyitaan', '2022-05-24 02:13:52', NULL, NULL),
(245, 129, 'Surat Perintah Penyitaan', '2022-05-24 02:13:52', NULL, NULL),
(246, 130, 'Mobil Tahanan', '2022-05-24 02:14:29', NULL, NULL),
(247, 131, 'Rencana   tindakan penyitaan', '2022-05-24 02:14:59', NULL, NULL),
(248, 133, 'Nota pendapat tindakan pemeriksaan setempat', '2022-05-24 02:15:30', NULL, NULL),
(249, 133, 'Surat perintah tugas', '2022-05-24 02:15:30', NULL, NULL),
(250, 134, 'Surat  Perintah  Pengalihan  Penahanan Tahap Penyidikan (T-2) / Surat Perintah Pencabutan  Penangguhan  Penahanan (T-8)    /    Surat    Perintah    Pencabutan Pembantaran Penahanan', '2022-05-24 02:16:58', NULL, NULL),
(251, 134, 'Berita Acara Pencabutan Penangguhan Penahanan;      atau      Berita      Acara pengalihan penahanan; atau Berita Acara Pencabutan Pembantaran Penahanan', '2022-05-24 02:16:58', NULL, NULL),
(252, 134, 'Surat keterangan Sehat dari dokter', '2022-05-24 02:16:58', NULL, NULL),
(253, 134, 'Berita Acara serah terima tahanan', '2022-05-24 02:16:58', NULL, NULL),
(254, 135, 'Kartu Barang Bukti', '2022-05-24 02:17:58', NULL, NULL),
(255, 135, 'Label Barang Bukti', '2022-05-24 02:17:58', NULL, NULL),
(256, 135, 'Berita Acara Koordinasi  Lokasi Penyitaan', '2022-05-24 02:17:58', NULL, NULL),
(257, 135, 'Penetapan Izin/Persetujuan Penyitaan', '2022-05-24 02:17:58', NULL, NULL),
(258, 135, 'Surat Perintah Penyitaan', '2022-05-24 02:17:58', NULL, NULL),
(259, 136, 'Surat perintah penyelidikan', '2022-05-24 02:17:59', NULL, NULL),
(260, 136, 'Rencana penyelidikan', '2022-05-24 02:17:59', NULL, NULL),
(261, 136, 'Surat perintah tugas', '2022-05-24 02:17:59', NULL, NULL),
(262, 136, 'Notulen rapat', '2022-05-24 02:17:59', NULL, NULL),
(263, 137, 'Nota    DInas    Laporan    Pelaksanaan Pengalihan        Penahanan        Tahap Penyidikan         atau         Pelaksanaan Pencabutan Penangguhan Penahanan atau        Pencabutan        Pembantaran Penahanan', '2022-05-24 02:18:45', NULL, NULL),
(264, 137, 'Berita  Acara  Pelaksanaan  Pengalihan Penahanan   Tahap   Penyidikan   atau Berita Acara Pelaksanaan Pencabutan Penangguhan  Penahanan  atau  Berita Acara      Pencabutan      Pembantaran Penahanan Penahanan', '2022-05-24 02:18:45', NULL, NULL),
(265, 138, 'Kartu Barang Bukti', '2022-05-24 02:18:54', NULL, NULL),
(266, 138, 'Label Barang Bukti', '2022-05-24 02:18:54', NULL, NULL),
(267, 138, 'Berita Acara penyitaan', '2022-05-24 02:18:54', NULL, NULL),
(268, 139, 'Nota    DInas    Laporan    Pelaksanaan Pengalihan        Penahanan        Tahap Penyidikan         atau         Pelaksanaan Pencabutan Penangguhan Penahanan atau        Pencabutan        Pembantaran Penahanan', '2022-05-24 02:19:41', NULL, NULL),
(269, 139, 'Buku ekspedisi', '2022-05-24 02:19:41', NULL, NULL),
(270, 140, 'Buku ekspedisi', '2022-05-24 02:19:55', NULL, NULL),
(271, 140, 'Z6RFKHDHIRCPFXD7D5PKXIAP545BAPBW7T5LP2FBIZXF4OEBUP7W5PIARM', '2022-05-24 02:19:55', NULL, NULL),
(272, 141, 'Surat perintah penyelidikan', '2022-05-24 02:21:29', NULL, NULL),
(273, 141, 'Rencana penyelidikan ', '2022-05-24 02:21:29', NULL, NULL),
(274, 141, 'Surat perintah tugas ', '2022-05-24 02:21:29', NULL, NULL),
(275, 142, 'Surat Perintah', '2022-05-24 02:22:05', NULL, NULL),
(276, 142, 'Berita Acara', '2022-05-24 02:22:05', NULL, NULL),
(277, 142, 'Surat-surat Lainnya', '2022-05-24 02:22:05', NULL, NULL),
(278, 144, 'Surat Perintah', '2022-05-24 02:23:20', NULL, NULL),
(279, 144, 'Berita Acara', '2022-05-24 02:23:20', NULL, NULL),
(280, 144, 'Surat-surat Lainnya', '2022-05-24 02:23:20', NULL, NULL),
(281, 144, 'Resume/Catatan hasil Penyidikan', '2022-05-24 02:23:20', NULL, NULL),
(282, 145, 'Surat Penyegelan Perintah', '2022-05-24 02:23:20', NULL, NULL),
(283, 146, 'Nota              Dinas Laporan Perkembangan Penyidikan', '2022-05-24 02:24:12', NULL, NULL),
(284, 146, 'Buku ekspedisi', '2022-05-24 02:24:12', NULL, NULL),
(285, 147, 'Surat Perintah Penyegelan', '2022-05-24 02:24:21', NULL, NULL),
(286, 148, 'Daftar tempat/Barang/ dokumen yang akan dilakukan penyegelan', '2022-05-24 02:25:54', NULL, NULL),
(287, 148, 'Surat Perintah Penyegelan', '2022-05-24 02:25:54', NULL, NULL),
(288, 143, 'Berita acara pemeriksaan setempat', '2022-05-24 02:26:30', NULL, NULL),
(289, 149, 'Berita Acara Penyegelan', '2022-05-24 02:26:37', NULL, NULL),
(290, 149, 'Barang Bukti', '2022-05-24 02:26:37', NULL, NULL),
(291, 150, 'Surat  Perintah Penyidikan', '2022-05-24 02:26:38', NULL, NULL),
(292, 150, 'Laporan Perkembangan Penyidikan', '2022-05-24 02:26:38', NULL, NULL),
(293, 150, 'Surat              Perintah Penghentian Penyidikan', '2022-05-24 02:26:38', NULL, NULL),
(294, 143, 'Foto /video/rekaman', '2022-05-24 02:26:44', NULL, NULL),
(295, 143, 'Data/dokumen', '2022-05-24 02:26:56', NULL, NULL),
(296, 151, 'Disposisi       atas       Nota Pendapat                  Untuk Melakukan           Tindakan Hukum              Penyidikan diterima', '2022-05-24 02:27:06', NULL, NULL),
(297, 152, 'Buku Ekspedisi', '2022-05-24 02:27:33', NULL, NULL),
(298, 152, 'Nota Dinas Laporan Pelaksanaan Penyegelan', '2022-05-24 02:27:33', NULL, NULL),
(299, 153, 'Surat              Perintah Penyidikan', '2022-05-24 02:28:42', NULL, NULL),
(300, 153, 'Surat              Perintah Penghentian Penyidikan', '2022-05-24 02:28:42', NULL, NULL),
(301, 153, 'Berkas Perkara', '2022-05-24 02:28:42', NULL, NULL),
(302, 153, 'Notulen Rapat', '2022-05-24 02:28:42', NULL, NULL),
(303, 154, 'Nota   Dinas   Nota   Dinas Laporan         pelaksanaan Penghentian Penyidikan', '2022-05-24 02:29:14', NULL, NULL),
(304, 155, 'Surat Perintah Penitipa Barang Bukti / Benda Sitaan', '2022-05-24 02:29:44', NULL, NULL),
(305, 156, 'Nota   Dinas   Laporan pelaksanaan Penghentian Penyidikan', '2022-05-24 02:30:01', NULL, NULL),
(306, 156, 'Buku Ekspedisi', '2022-05-24 02:30:01', NULL, NULL),
(307, 157, 'Surat Perintah Penitipan Barang Bukti/Benda Sitaan diterima', '2022-05-24 02:31:14', NULL, NULL),
(308, 158, 'Membuat   Nota   Dinas   Laporan   pelaksanaan penyerahan   tanggung   jawab   tersangka   dan barang bukti', '2022-05-24 02:31:56', NULL, NULL),
(309, 159, 'Daftar tempat/Barang/dokumen yang akan dilakukan penyegelan', '2022-05-24 02:32:47', NULL, NULL),
(310, 160, 'Berita Acara Penyegelan', '2022-05-24 02:33:59', NULL, NULL),
(311, 161, 'Surat               Perintah Menyerahkan Tanggung           Jawab Tersangka dan Barang Bukti (P-15)', '2022-05-24 02:34:38', NULL, NULL),
(312, 161, 'Nota  Dinas  pengantar penyerahan    tanggung jawab   tersangka   dan barang bukti', '2022-05-24 02:34:38', NULL, NULL),
(313, 161, 'Surat             Panggilan Tahanan (T-13)', '2022-05-24 02:34:38', NULL, NULL),
(314, 161, 'Surat             Panggilan Tersangka (P-9)', '2022-05-24 02:34:38', NULL, NULL),
(315, 161, 'bantuan     pengawalan (Pidsus-20B)', '2022-05-24 02:34:38', NULL, NULL),
(316, 161, 'Surat   permintaan   cek kesehatan tersangka', '2022-05-24 02:34:38', NULL, NULL),
(317, 161, 'Surat         permohonan pengeluaran tahanan', '2022-05-24 02:34:38', NULL, NULL),
(318, 162, 'Buku Ekspedisi', '2022-05-24 02:35:39', NULL, NULL),
(319, 162, 'Nota Dinas Laporan Pelaksanaan Penitipan Barang Bukti/Benda Sitaan', '2022-05-24 02:35:39', NULL, NULL),
(320, 163, 'Berita acara koordinasi', '2022-05-24 02:35:48', NULL, NULL),
(321, 163, 'Surat keterangan sehat', '2022-05-24 02:35:48', NULL, NULL),
(322, 163, 'Surat         pengeluaran tahanan dari rutan', '2022-05-24 02:35:48', NULL, NULL),
(323, 163, 'Buku ekspedisi', '2022-05-24 02:35:48', NULL, NULL),
(324, 164, 'Surat perintah', '2022-05-24 02:36:58', NULL, NULL),
(325, 164, 'Salinan   Berita   Acara Penerimaan           dan Penelitian    Tersangka (BA-15)', '2022-05-24 02:36:58', NULL, NULL),
(326, 164, 'Salinan   Berita   Acara Penerimaan           dan Penelitian         Barang Sitaan/Barang      Bukti (BA-18)', '2022-05-24 02:36:58', NULL, NULL),
(327, 165, 'Nota    Dinas    Laporan pelaksanaan penyerahan    tanggung jawab   tersangka   dan barang bukti', '2022-05-24 02:38:13', NULL, NULL),
(328, 165, 'Buku ekspedisi', '2022-05-24 02:38:13', NULL, NULL),
(329, 166, 'Surat perintah tugas pelacakan aset tahap penyelidikan', '2022-05-24 10:48:38', NULL, NULL),
(330, 167, 'Surat perintah tugas pelacakan aset tahap penyelidikan', '2022-05-24 10:50:32', NULL, NULL),
(331, 167, 'Identitas para pihak', '2022-05-24 10:50:32', NULL, NULL),
(332, 168, 'Jadwal pelacakan aset', '2022-05-24 10:52:10', NULL, NULL),
(333, 168, 'Identitas para pihak (KTP atau KK)', '2022-05-24 10:52:10', NULL, NULL),
(334, 169, 'Informasi dan data tentang indentitas para pihak', '2022-05-24 10:56:19', NULL, NULL),
(335, 170, 'Informasi dan data', '2022-05-24 10:59:37', NULL, NULL),
(336, 171, 'Harta/aset kekayaan', '2022-05-24 11:01:06', NULL, NULL),
(337, 172, 'Informasi dan data tentang harta benda/ aset', '2022-05-24 11:02:20', NULL, NULL),
(338, 173, 'Laporan hasil pelaksanaan tugas pelacakan aset', '2022-05-24 11:03:52', NULL, NULL),
(339, 173, 'Buku ekspedisi', '2022-05-24 11:03:52', NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `pegawai_detail_tugas_id` int(11) NOT NULL,
  `tipe` int(1) NOT NULL,
  `judul` varchar(255) NOT NULL DEFAULT '',
  `deskripsi` varchar(255) NOT NULL DEFAULT '',
  `waktu_mulai` datetime NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` datetime DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Jaksa Utama', '2022-05-11 12:01:55', NULL, NULL);

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
(74, 'RDETAILTUGASSELF', 'Lihat detail tugas (jaksa)', 8, '2022-04-24 22:43:58', NULL, NULL),
(75, 'RDETAILPENYELIDIKAN', 'Lihat semua detail tugas penyelidikan', 8, '2022-04-24 22:43:58', NULL, NULL),
(76, 'RTUGASSELF', 'Lihat tugas (jaksa)', 8, '2022-04-24 22:43:58', NULL, NULL),
(77, 'RDETAILPENYIDIKAN', 'Lihat semua detail tugas penyidikan', 8, '2022-04-24 22:43:58', NULL, NULL),
(78, 'RDASHSELF', 'Lihat dashboard (jaksa)', 8, '2022-04-24 22:43:58', NULL, NULL),
(79, 'RDASH', 'Lihat dashboard', 8, '2022-04-24 22:43:58', NULL, NULL);

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
(3, 'Jaksa', '2022-04-28 13:15:51', NULL, NULL);

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
(168, 79, 3, '2022-05-23 12:59:49', NULL, NULL),
(169, 78, 3, '2022-05-23 12:59:55', NULL, NULL);

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
(17, 48, 2, '2022-05-11 16:36:20', NULL, '2022-05-11 16:36:24');

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
(8, 'Pelaksanaan tugas pengayaan informasi /data', 'Penyelidikan', '4460', '2022-05-23 19:18:03', NULL, NULL),
(9, 'Nota pendapat tindakan penyelidikan', 'Penyelidikan', '320', '2022-05-23 19:51:54', NULL, NULL),
(10, 'Permintaan keterangan', 'Penyelidikan', '4990', '2022-05-23 20:05:17', NULL, NULL),
(11, 'Pengelolaan Barang Bukti Elektronik', 'Penyidikan', '1950', '2022-05-23 20:33:29', NULL, NULL),
(12, 'Pemeriksaan Saksi', 'Penyidikan', '560', '2022-05-24 00:52:17', NULL, NULL),
(13, 'Pengelolaan Barang Bukti', 'Penyidikan', '3630', '2022-05-24 00:53:26', NULL, NULL),
(14, 'Pemeriksaan Ahli', 'Penyidikan', '550', '2022-05-24 01:08:13', NULL, NULL),
(15, 'Pelaksanaan Tindakan Hukum Lainnya', 'Penyidikan', '1110', '2022-05-24 01:15:04', NULL, NULL),
(16, 'Pemeriksaan Tersangka', 'Penyidikan', '560', '2022-05-24 01:18:02', NULL, NULL),
(17, 'Tindakan Penahanan Tahap Penyidikan', 'Penyidikan', '365', '2022-05-24 01:25:45', NULL, NULL),
(18, 'Nota Pendapat Tindakan Humum Penyidikan', 'Penyidikan', '260', '2022-05-24 01:31:22', NULL, NULL),
(19, 'Pelacakan Aset Tahap Penyidikan', 'Penyidikan', '5010', '2022-05-24 01:39:25', NULL, NULL),
(20, 'Permintaan dan penerimaan dokumen', 'Penyelidikan', '4970', '2022-05-24 01:48:43', NULL, NULL),
(21, 'Penangguhan/Pengalihan/Pembantaran Penahanan Tahap Penyidikan', 'Penyidikan', '190', '2022-05-24 01:49:03', NULL, NULL),
(22, 'Penggeledahan', 'Penyidikan', '1225', '2022-05-24 02:00:10', NULL, NULL),
(23, 'Pencabutan Penangguhan/Pengalihan/Pembantaran Tahap Penyidikan', 'Penyidikan', '345', '2022-05-24 02:03:54', NULL, NULL),
(24, 'Pemeriksaan setempat tahap penyelidikan', 'Penyelidikan', '4624', '2022-05-24 02:06:34', NULL, NULL),
(25, 'Tidur weeeeeeeeeyyy hahah', 'Penyelidikan', '', '2022-05-24 02:09:08', NULL, '2022-05-24 08:57:47'),
(26, 'Penyitaan', 'Penyidikan', '1225', '2022-05-24 02:09:34', '2022-05-24 02:12:20', NULL),
(27, 'ngantuk asu', 'Penyelidikan', '', '2022-05-24 02:11:48', NULL, '2022-05-24 08:57:41'),
(28, 'Nanggung wkwk', 'Penyelidikan', '', '2022-05-24 02:20:12', NULL, '2022-05-24 08:57:35'),
(29, 'Penyegelan', 'Penyidikan', '500', '2022-05-24 02:20:25', NULL, NULL),
(30, 'Penyusunan Laporan Perkembangan Penyidikan', 'Penyidikan', '1470', '2022-05-24 02:21:01', NULL, NULL),
(31, 'Tindak Penghentian Penyidikan', 'Penyidikan', '1110', '2022-05-24 02:25:07', NULL, NULL),
(32, 'Penitipan Barang Bukti / Benda Sitaan', 'Penyidikan', '500', '2022-05-24 02:28:20', NULL, NULL),
(33, 'Penyerahan Tersangka dan Barang Bukti', 'Penyidikan', '1110', '2022-05-24 02:30:51', NULL, NULL),
(34, 'Pelacakan aset tahap penyidikan', 'Penyelidikan', '5000', '2022-05-24 10:47:02', NULL, NULL);

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
(49, 'Diki', NULL, 'diki@mail.com', '$2y$10$zxk9oWi4ijpx9hAFnW3L/.px7hZICAS17YUk/GWdm4mwWNya3Nf/q', 1, '2022-05-11 12:00:52', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `hasil_data`
--
ALTER TABLE `hasil_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `moduleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `rpCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `ruCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sop`
--
ALTER TABLE `sop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tembusan`
--
ALTER TABLE `tembusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
