-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Bulan Mei 2022 pada 07.14
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

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
-- Struktur dari tabel `detail_konsultasi`
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
-- Struktur dari tabel `detail_tugas`
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

--
-- Dumping data untuk tabel `detail_tugas`
--

INSERT INTO `detail_tugas` (`id`, `tugas_id`, `kegiatan_id`, `status`, `waktu`, `satuan`, `waktu_mulai`, `waktu_selesai`, `dibuka`, `createAt`, `updateAt`, `deleteAt`, `catatan`, `umum`) VALUES
(1, 1, 6, 'Diterima', '60', 'menit', '2022-05-11 14:20:39', '2022-05-11 14:29:11', 2, '2022-05-11 14:19:59', NULL, NULL, '', ''),
(2, 2, 6, 'Diterima', '60', 'menit', '2022-05-11 16:46:09', '2022-05-11 16:49:46', 2, '2022-05-11 16:43:52', NULL, NULL, '', ''),
(3, 3, 7, 'Dalam proses', '24', 'jam', NULL, NULL, 0, '2022-05-23 12:13:13', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id` int(11) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id`, `golongan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'III A', '2022-05-11 12:02:07', NULL, NULL),
(2, 'IVA', '2022-05-11 12:02:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
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
-- Dumping data untuk tabel `hasil`
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
(11, 'Ini Hsil', 7, '2022-05-23 12:11:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_data`
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
-- Dumping data untuk tabel `hasil_data`
--

INSERT INTO `hasil_data` (`id`, `detail_tugas_id`, `hasil_id`, `dokumen`, `tipe`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 9, 'd023671a053883608e1cafb1bbbe8a1a.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(2, 1, 10, '7567dcd19994e390d0b85b1bd2d7f94d.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(3, 2, 9, '6eff59c217537aec29e37a12a024a9fc.png', 'image/png', '2022-05-11 16:43:52', NULL, NULL),
(4, 3, 11, NULL, NULL, '2022-05-23 12:13:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Jaksa Fungsional', '2022-05-11 12:01:31', NULL, NULL),
(2, 'Kepala Seksi Penyelidikan', '2022-05-11 12:01:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
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
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `sop_id`, `kegiatan`, `waktu`, `satuan`, `keterangan`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 4, 'Melakukan rapt tindakan permintaan dokumen', '60', 'menit', 'a', '2022-05-11 12:27:32', NULL, '2022-05-11 12:29:20'),
(2, 4, 'Melakukan rapt tindakan permintaan dokumen', '60', 'menit', 'a', '2022-05-11 12:28:03', NULL, '2022-05-11 12:29:24'),
(3, 4, 'qasa', '12', 'menit', '12', '2022-05-11 12:29:16', NULL, '2022-05-11 12:29:27'),
(4, 5, 'Melakukan rapat tindakan permintaan dokumen', '60', 'menit', 'aaa', '2022-05-11 14:14:48', NULL, '2022-05-11 14:15:49'),
(5, 5, 'Melakukan rapat tindakan permintaan dokumen', '60', 'menit', 'aaa', '2022-05-11 14:14:58', NULL, '2022-05-11 14:15:46'),
(6, 5, 'Melakukan rapt tindakan permintaan dokumen', '60', 'menit', 'aaa', '2022-05-11 14:16:38', NULL, NULL),
(7, 6, 'Upload FIle', '24', 'jam', 'Wajib !!', '2022-05-23 12:10:04', '2022-05-23 12:11:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelengkapan`
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
-- Dumping data untuk tabel `kelengkapan`
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
(16, 7, 'Ini Kelengkapan', '2022-05-23 12:11:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelengkapan_data`
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
-- Dumping data untuk tabel `kelengkapan_data`
--

INSERT INTO `kelengkapan_data` (`id`, `detail_tugas_id`, `kelengkapan_id`, `dokumen`, `tipe`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 14, '072f0a2d809a8109dcc58ac1f7389f0c.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(2, 1, 15, '6f680dd3defa5a0081c54391cbb89d8d.PNG', 'image/png', '2022-05-11 14:19:59', NULL, NULL),
(3, 2, 14, '57585ca12d68e4f7c90f1384d3f8e1a8.png', 'image/png', '2022-05-11 16:43:52', NULL, NULL),
(4, 2, 15, '268a64419cbe510bfc88c0fc98cafede.png', 'image/png', '2022-05-11 16:43:52', NULL, NULL),
(5, 3, 16, '2320d46b31dedc78f1b219d514a6cd78.PNG', 'image/png', '2022-05-23 12:13:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `pegawai_detail_tugas_id` int(11) NOT NULL,
  `tipe` int(1) NOT NULL,
  `judul` int(11) NOT NULL,
  `deskripsi` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` datetime DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `module`
--

CREATE TABLE `module` (
  `moduleCode` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `module`
--

INSERT INTO `module` (`moduleCode`, `module`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Management User', '2022-02-26 02:43:35', '2022-03-24 09:12:18', NULL),
(7, 'Dashboard', '2022-03-24 13:42:33', '2022-03-26 09:45:26', NULL),
(8, 'Kejati', '2022-04-13 10:20:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
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
-- Dumping data untuk tabel `notifikasi`
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
(14, 48, 49, 1, 'Anda diberi tugas oleh ketua tim dalam kegiatan Melakukan rapt tindakan permintaan dokumen dengan no surat tugas TUG-001', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:47:38', NULL, NULL),
(15, 49, 48, 1, 'Diki mengunggah dokumen Hasil Wawancara dalam kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:48:33', NULL, NULL),
(16, 48, 47, 1, 'sukijo mengirim hasil dokumen kegiatan Melakukan rapt tindakan permintaan dokumen', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/penyelidikan\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:49:46', NULL, NULL),
(17, 47, 48, 1, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:52:04', NULL, NULL),
(18, 47, 49, 1, 'Dokumen hasil kegiatan Melakukan rapt tindakan permintaan dokumen diterima oleh atasan ', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDIpOw%3D%3D\",\"action\":\"detail(2);\"}', '2022-05-11 16:52:04', NULL, NULL),
(19, 47, 49, 0, 'Anda diberi tugas sebagai anggota tim dengan no surat tugas ZxZ dari no pengaduan pe123 untuk melakukan kegiatan penyidikan Upload FIle', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-23 12:13:13', NULL, NULL),
(20, 47, 48, 0, 'Anda diberi tugas sebagai ketua tim dengan no surat tugas ZxZ dari no pengaduan pe123 untuk melakukan kegiatan penyidikan Upload FIle', '{\"link\":\"http:\\/\\/localhost\\/kejati\\/kejati\\/tugas\\/index\\/ZGV0YWlsKDMpOw%3D%3D\",\"action\":\"detail(3);\"}', '2022-05-23 12:13:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkat`
--

CREATE TABLE `pangkat` (
  `id` int(11) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pangkat`
--

INSERT INTO `pangkat` (`id`, `pangkat`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Jaksa Madya', '2022-05-11 12:01:49', NULL, NULL),
(2, 'Jaksa Utama', '2022-05-11 12:01:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
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
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `nip`, `foto`, `jabatan_id`, `pangkat_id`, `golongan_id`, `userCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Ageng', '1139278', '5609c9e93917229302043a1bbef4ccf1.PNG', 2, 2, 1, 47, '2022-05-11 12:02:48', NULL, '2022-05-11 12:03:57'),
(2, 'sukijo', '1244244', '44d93be80503820a09e0ae8d601e5c2e.PNG', 1, 1, 2, 48, '2022-05-11 12:03:13', NULL, '2022-05-11 12:14:13'),
(3, 'Diki', '213452', 'f1927d161241f10eb57646a1cbef5976.PNG', 1, 1, 2, 49, '2022-05-11 12:03:34', '2022-05-11 12:14:06', '2022-05-11 12:14:16'),
(4, 'ageng', '1234244', '0cad15c4dacfe38d33ed5ebd2ee1ff49.PNG', 2, 2, 1, 47, '2022-05-11 12:15:27', NULL, NULL),
(5, 'sukijo', '3124111', '5eb1665c6d2ecbbe31776973b02bd004.PNG', 1, 1, 2, 48, '2022-05-11 12:15:55', NULL, NULL),
(6, 'Diki', '341243445', '58d0f655f28fdc03071121e346dc1aa1.PNG', 1, 1, 2, 49, '2022-05-11 12:16:23', '2022-05-11 12:24:24', '2022-05-11 12:24:33'),
(7, 'Diki', '313124214', '556212dbbfd84a192f661f1d4bb470e1.PNG', 1, 1, 2, 49, '2022-05-11 12:25:08', NULL, '2022-05-11 14:10:29'),
(8, 'Diki', '1242145', '7a4fb7060d5075d9a9c5978a59413b29.PNG', 1, 1, 2, 49, '2022-05-11 14:11:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai_detail_tugas`
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
-- Dumping data untuk tabel `pegawai_detail_tugas`
--

INSERT INTO `pegawai_detail_tugas` (`id`, `pegawai_id`, `detail_tugas_id`, `leader`, `tugas`, `dokumen`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 5, 1, 1, NULL, NULL, '2022-05-11 14:19:59', NULL, NULL),
(2, 8, 1, 0, 'rev rapat tindakan', '[{\"nama\":\"hasil rapat\",\"dokumen\":\"7c270dc8513babe61972a9bde496324f.PNG\"},{\"nama\":\"rev hasil rapat\",\"dokumen\":\"dd38ba9a4cdfd60fc1653b051743d90a.PNG\"}]', '2022-05-11 14:19:59', NULL, NULL),
(3, 5, 2, 1, NULL, NULL, '2022-05-11 16:43:52', NULL, NULL),
(4, 8, 2, 0, 'Buat hasil wawancara', '[{\"nama\":\"Hasil Wawancara\",\"dokumen\":\"3d5aad670fae6ef1473bd5e441efe73e.png\"}]', '2022-05-11 16:43:52', NULL, NULL),
(5, 8, 3, 0, NULL, NULL, '2022-05-23 12:13:13', NULL, NULL),
(6, 5, 3, 1, NULL, NULL, '2022-05-23 12:13:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
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
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `no`, `tanggal_surat`, `tanggal_terima`, `asal_surat`, `perihal`, `isi`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'pe123', '2022-05-10 00:00:00', '2022-05-11 00:00:00', 'dinas aaa', 'ini perihall surat', 'isi surat', '2022-05-11 14:17:36', NULL, NULL),
(2, 'PENG-001', '2022-05-16 00:00:00', '2022-05-14 00:00:00', 'Departement Hukum', 'Perihal pengaduan KDRT', 'Membutuhkan tindak lanjut untuk masalah KDRT', '2022-05-11 16:39:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission`
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
-- Dumping data untuk tabel `permission`
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
(77, 'RDETAILPENYIDIKAN', 'Lihat semua detail tugas penyidikan', 8, '2022-04-24 22:43:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `roleCode` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT NULL,
  `deleteAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`roleCode`, `role`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Super Admin', '2022-02-26 03:06:51', NULL, NULL),
(2, 'Pimpinan', '2022-04-28 13:15:44', NULL, NULL),
(3, 'Jaksa', '2022-04-28 13:15:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_permission`
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
-- Dumping data untuk tabel `role_permission`
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
(167, 74, 3, '2022-05-02 22:17:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
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
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`ruCode`, `userCode`, `roleCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 36, 1, '2022-02-26 03:19:11', NULL, NULL),
(14, 47, 2, '2022-05-11 12:00:27', NULL, NULL),
(15, 48, 3, '2022-05-11 12:01:00', NULL, NULL),
(16, 49, 3, '2022-05-11 12:01:10', NULL, NULL),
(17, 48, 2, '2022-05-11 16:36:20', NULL, '2022-05-11 16:36:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sop`
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
-- Dumping data untuk tabel `sop`
--

INSERT INTO `sop` (`id`, `sop`, `kategori`, `waktu`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '', '2022-05-11 12:16:54', NULL, '2022-05-11 12:21:47'),
(3, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '', '2022-05-11 12:21:54', '2022-05-11 12:22:01', '2022-05-11 12:24:03'),
(4, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '0', '2022-05-11 12:25:35', NULL, '2022-05-11 14:10:36'),
(5, 'Permintaan dan penerimaan Dokumen', 'Penyelidikan', '60', '2022-05-11 14:12:53', NULL, NULL),
(6, 'Test Untuk Penyidikan', 'Penyidikan', '1440', '2022-05-23 12:07:50', '2022-05-23 12:12:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tembusan`
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
-- Dumping data untuk tabel `tembusan`
--

INSERT INTO `tembusan` (`id`, `tugas_id`, `tembusan`, `no_urut`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 1, 'aa', 1, '2022-05-11 14:19:59', NULL, NULL),
(2, 2, '', 1, '2022-05-11 16:43:52', NULL, NULL),
(3, 3, 'xczzx', 1, '2022-05-23 12:13:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
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
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id`, `sop_id`, `no_surat_tugas`, `pengaduan_id`, `no_nota_dinas`, `tanggal_nota_dinas`, `perihal_nota_dinas`, `status`, `userCode`, `createAt`, `updateAt`, `deleteAt`) VALUES
(1, 5, 'ST01', 1, '123', '2022-05-11 00:00:00', 'ini perihal', 'Dalam proses', 47, '2022-05-11 14:19:59', NULL, NULL),
(2, 5, 'TUG-001', 2, 'TUG-001-DIN', '2022-05-19 00:00:00', 'Tugas nota dinas', 'Dalam proses', 47, '2022-05-11 16:43:52', NULL, NULL),
(3, 6, 'ZxZ', 1, 'ZXZzxZX', '2022-05-25 00:00:00', 'ZXzxz', 'Dalam proses', 47, '2022-05-23 12:13:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userCode`, `name`, `photo`, `email`, `password`, `isActive`, `createAt`, `updateAt`, `deleteAt`) VALUES
(36, 'Super Admin', NULL, 'su@mail.com', '$2y$10$gcyea6ojs.giz4zRA3V5Uewlucm2aHOp1ULakUd8GhBXAb0xF6eC6', 1, '2022-02-26 03:18:28', '2022-03-24 13:32:26', NULL),
(47, 'ageng', NULL, 'ageng@mail.com', '$2y$10$WefoZjJLah1Sgq.3AeZtAe64P2iVUEoOzXE5yNc9AKMePv2JI2sou', 1, '2022-05-11 12:00:18', NULL, NULL),
(48, 'sukijo', NULL, 'sukijo@mail.com', '$2y$10$icny1UwW0gUju3Z.bjSkyeOXoJgIX/A3Y74eRK.fZH53J6S.xxCeG', 1, '2022-05-11 12:00:40', NULL, NULL),
(49, 'Diki', NULL, 'diki@mail.com', '$2y$10$zxk9oWi4ijpx9hAFnW3L/.px7hZICAS17YUk/GWdm4mwWNya3Nf/q', 1, '2022-05-11 12:00:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_permission`
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
-- Indeks untuk tabel `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_tugas`
--
ALTER TABLE `detail_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_data`
--
ALTER TABLE `hasil_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`),
  ADD KEY `hasil_kegiatan_id` (`hasil_id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sop_id` (`sop_id`);

--
-- Indeks untuk tabel `kelengkapan`
--
ALTER TABLE `kelengkapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indeks untuk tabel `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`),
  ADD KEY `kelengkapan_id` (`kelengkapan_id`);

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`moduleCode`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_id` (`jabatan_id`),
  ADD KEY `pangkat_id` (`pangkat_id`),
  ADD KEY `golongan_id` (`golongan_id`);

--
-- Indeks untuk tabel `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaksa_tugas_id` (`pegawai_id`),
  ADD KEY `detail_tugas_id` (`detail_tugas_id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permissionCode`),
  ADD KEY `moduleCode` (`moduleCode`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleCode`);

--
-- Indeks untuk tabel `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`rpCode`),
  ADD KEY `permissionCode` (`permissionCode`),
  ADD KEY `roleCode` (`roleCode`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`ruCode`),
  ADD KEY `userCode` (`userCode`),
  ADD KEY `roleCode` (`roleCode`);

--
-- Indeks untuk tabel `sop`
--
ALTER TABLE `sop`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tembusan`
--
ALTER TABLE `tembusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sop_id` (`sop_id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userCode`);

--
-- Indeks untuk tabel `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`upCode`),
  ADD KEY `userCode` (`userCode`),
  ADD KEY `permissionCode` (`permissionCode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_tugas`
--
ALTER TABLE `detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `hasil_data`
--
ALTER TABLE `hasil_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelengkapan`
--
ALTER TABLE `kelengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `module`
--
ALTER TABLE `module`
  MODIFY `moduleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `roleCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `rpCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `ruCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `sop`
--
ALTER TABLE `sop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tembusan`
--
ALTER TABLE `tembusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `upCode` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_tugas`
--
ALTER TABLE `detail_tugas`
  ADD CONSTRAINT `detail_tugas_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`),
  ADD CONSTRAINT `detail_tugas_ibfk_2` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `hasil_data`
--
ALTER TABLE `hasil_data`
  ADD CONSTRAINT `hasil_data_ibfk_1` FOREIGN KEY (`detail_tugas_id`) REFERENCES `detail_tugas` (`id`),
  ADD CONSTRAINT `hasil_data_ibfk_2` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id`);

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`sop_id`) REFERENCES `sop` (`id`);

--
-- Ketidakleluasaan untuk tabel `kelengkapan`
--
ALTER TABLE `kelengkapan`
  ADD CONSTRAINT `kelengkapan_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `kelengkapan_data`
--
ALTER TABLE `kelengkapan_data`
  ADD CONSTRAINT `kelengkapan_data_ibfk_1` FOREIGN KEY (`detail_tugas_id`) REFERENCES `detail_tugas` (`id`),
  ADD CONSTRAINT `kelengkapan_data_ibfk_2` FOREIGN KEY (`kelengkapan_id`) REFERENCES `kelengkapan` (`id`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`pangkat_id`) REFERENCES `pangkat` (`id`),
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`golongan_id`) REFERENCES `golongan` (`id`);

--
-- Ketidakleluasaan untuk tabel `pegawai_detail_tugas`
--
ALTER TABLE `pegawai_detail_tugas`
  ADD CONSTRAINT `pegawai_detail_tugas_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `pegawai_detail_tugas_ibfk_2` FOREIGN KEY (`detail_tugas_id`) REFERENCES `detail_tugas` (`id`);

--
-- Ketidakleluasaan untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`moduleCode`) REFERENCES `module` (`moduleCode`);

--
-- Ketidakleluasaan untuk tabel `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`),
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`);

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`roleCode`) REFERENCES `role` (`roleCode`);

--
-- Ketidakleluasaan untuk tabel `tembusan`
--
ALTER TABLE `tembusan`
  ADD CONSTRAINT `tembusan_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`sop_id`) REFERENCES `sop` (`id`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_permission`
--
ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_ibfk_1` FOREIGN KEY (`userCode`) REFERENCES `user` (`userCode`),
  ADD CONSTRAINT `user_permission_ibfk_2` FOREIGN KEY (`permissionCode`) REFERENCES `permission` (`permissionCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
