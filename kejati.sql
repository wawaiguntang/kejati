-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 11:33 AM
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
-- Table structure for table `detail_tugas`
--

CREATE TABLE `detail_tugas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `dibuka` int(1) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
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
(1, 'II A', '2022-04-14 10:57:36', NULL, NULL),
(2, 'II B', '2022-04-14 10:57:41', NULL, NULL),
(3, 'II C', '2022-04-14 10:57:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_data`
--

CREATE TABLE `hasil_data` (
  `id` int(11) NOT NULL,
  `detail_tugas_id` int(11) NOT NULL,
  `hasil_kegiatan_id` int(11) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kegiatan`
--

CREATE TABLE `hasil_kegiatan` (
  `id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `hasil` varchar(255) NOT NULL,
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
(1, 'JAKSA FUNGSIONAL', '2022-04-14 11:02:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jaksa_tugas`
--

CREATE TABLE `jaksa_tugas` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `leader` tinyint(1) NOT NULL DEFAULT 0,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'JAKSA MADYA', '2022-04-14 10:58:35', NULL, NULL);

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
(1, 'Diki Rahmad Sandi', '1807122006990005001002', '38f6e3c3f3f9667ad3484d405466c287.png', 1, 1, 1, 36, '2022-04-14 11:28:27', '2022-04-14 07:04:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_detail_tugas`
--

CREATE TABLE `pegawai_detail_tugas` (
  `id` int(11) NOT NULL,
  `jaksa_tugas_id` int(11) NOT NULL,
  `detail_tugas_id` int(11) NOT NULL,
  `pengupload` int(1) NOT NULL,
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
(47, 'DKEGIATAN', 'Hapus kegiatan', 8, '2022-02-26 02:53:01', NULL, NULL);

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
(1, 'Super Admin', '2022-02-26 03:06:51', NULL, NULL);

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
(120, 47, 1, '2022-04-14 14:13:13', NULL, NULL);

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
(1, 36, 1, '2022-02-26 03:19:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sop`
--

CREATE TABLE `sop` (
  `id` int(11) NOT NULL,
  `sop` varchar(255) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sop`
--

INSERT INTO `sop` (`id`, `sop`, `waktu`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'PELAKSANAAN TUGAS PENGAYAAN INFORMASI /DATA', '', '2022-04-14 16:30:00', NULL, NULL),
(2, 'NOTA PENDAPAT TINDAKAN PENYELIDIKAN', '', '2022-04-14 16:30:04', NULL, NULL),
(3, 'PERMINTAAN KETERANGAN', '', '2022-04-14 16:30:07', NULL, NULL),
(4, 'PERMINTAAN DAN PENERIMAAN DOKUMEN', '', '2022-04-14 16:30:10', NULL, NULL);

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
  `tipe_sop` enum('penyelidikan','penyidikan') NOT NULL,
  `pengaduan_id` int(11) DEFAULT NULL,
  `no_nota_dinas` varchar(100) NOT NULL,
  `tanggal_nota_dinas` datetime NOT NULL,
  `perihal_nota_dinas` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
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
(36, 'Super Admin', NULL, 'su@mail.com', '$2y$10$gcyea6ojs.giz4zRA3V5Uewlucm2aHOp1ULakUd8GhBXAb0xF6eC6', 1, '2022-02-26 03:18:28', '2022-03-24 13:32:26', NULL);

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
-- Indexes for table `hasil_data`
--
ALTER TABLE `hasil_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`),
  ADD KEY `hasil_kegiatan_id` (`hasil_kegiatan_id`);

--
-- Indexes for table `hasil_kegiatan`
--
ALTER TABLE `hasil_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jaksa_tugas`
--
ALTER TABLE `jaksa_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `tugas_id` (`tugas_id`);

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
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`moduleCode`);

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
  ADD KEY `jaksa_tugas_id` (`jaksa_tugas_id`),
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
-- AUTO_INCREMENT for table `detail_tugas`
--
ALTER TABLE `detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hasil_data`
--
ALTER TABLE `hasil_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_kegiatan`
--
ALTER TABLE `hasil_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jaksa_tugas`
--
ALTER TABLE `jaksa_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `moduleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `rpCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `ruCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sop`
--
ALTER TABLE `sop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tembusan`
--
ALTER TABLE `tembusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  ADD CONSTRAINT `hasil_data_ibfk_2` FOREIGN KEY (`hasil_kegiatan_id`) REFERENCES `hasil_kegiatan` (`id`);

--
-- Constraints for table `hasil_kegiatan`
--
ALTER TABLE `hasil_kegiatan`
  ADD CONSTRAINT `hasil_kegiatan_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`);

--
-- Constraints for table `jaksa_tugas`
--
ALTER TABLE `jaksa_tugas`
  ADD CONSTRAINT `jaksa_tugas_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `jaksa_tugas_ibfk_2` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

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
  ADD CONSTRAINT `pegawai_detail_tugas_ibfk_1` FOREIGN KEY (`jaksa_tugas_id`) REFERENCES `jaksa_tugas` (`id`),
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
