-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 07:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Super Admin groups (Developer)'),
(2, 'admin', 'Admin groups (Admin OPD)'),
(3, 'user', 'User groups (User PNS)');

-- --------------------------------------------------------

--
-- Table structure for table `lib_bidang`
--

CREATE TABLE `lib_bidang` (
  `bidang_kode` varchar(20) NOT NULL,
  `bidang_nama` varchar(30) NOT NULL,
  `opd_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_bidang`
--

INSERT INTO `lib_bidang` (`bidang_kode`, `bidang_nama`, `opd_kode`) VALUES
('KOMINFO-1', 'Programmer', '19'),
('SEKDA-1', 'Sekretaris', '2'),
('SEKDA-2', 'Bendahara', '2');

-- --------------------------------------------------------

--
-- Table structure for table `lib_gedung`
--

CREATE TABLE `lib_gedung` (
  `gedung_kode` varchar(20) NOT NULL,
  `gedung_nama` varchar(30) NOT NULL,
  `opd_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_gedung`
--

INSERT INTO `lib_gedung` (`gedung_kode`, `gedung_nama`, `opd_kode`) VALUES
('INSP-1', 'Gedung Inspektorat Satu', '25'),
('KOMINFO-1', 'Gedung Kominfo Pertama', '19'),
('KOMINFO-2', 'Gedung Kominfo Kedua ', '19'),
('SEKDA-1', 'Gedung Sekda Pertama ', '2'),
('SEKDA-2', 'Gedung Sekda Kedua', '2'),
('SEKDA-3', 'Gedung Komputer', '2');

-- --------------------------------------------------------

--
-- Table structure for table `lib_jenis_acara`
--

CREATE TABLE `lib_jenis_acara` (
  `jenis_acara_kode` varchar(20) NOT NULL,
  `jenis_acara_nama` varchar(30) NOT NULL,
  `jenis_acara_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_jenis_acara`
--

INSERT INTO `lib_jenis_acara` (`jenis_acara_kode`, `jenis_acara_nama`, `jenis_acara_keterangan`) VALUES
('1', 'Rapat', ''),
('2', 'Seminar', ''),
('3', 'Workshop', ''),
('4', 'Pelatihan', ''),
('5', 'Pelantikan', ''),
('6', 'Sarasehan', '');

-- --------------------------------------------------------

--
-- Table structure for table `lib_opd`
--

CREATE TABLE `lib_opd` (
  `opd_kode` varchar(20) NOT NULL,
  `opd_nama` varchar(255) NOT NULL,
  `opd_email` varchar(255) NOT NULL,
  `opd_alamat` text NOT NULL,
  `opd_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_opd`
--

INSERT INTO `lib_opd` (`opd_kode`, `opd_nama`, `opd_email`, `opd_alamat`, `opd_telp`) VALUES
('1', 'Inspektorat Wonogiri', 'inspektorat@wonogirikab.go.id', 'Jl Pemuda I / 55 Wonogiri', '(0273) 321138'),
('10', 'Dinas Kepemudaan dan Olahraga dan Parawisata Kabupaten Wonogiri', 'dinaspdank@wonogirikab.go.id', 'Jl. Diponegoro Km. 3 Bulusulur, Kab. Wonogiri', '(0273) 321121'),
('11', 'Dinas Kesehatan Kabupaten Wonogiri', 'dinkes@wonogirikab.go.id', 'Jln. Jend. Sudirman No. 61, Wonogiri', '(0273) 321043'),
('12', 'Dinas Sosial Kabupaten Wonogiri', 'dinsos@wonogirikab.go.id', 'Jln. dr. Cipto II No.10, Wonogiri', '(0273) 321018'),
('13', 'Dinas Pengendalian Penduduk dan Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Wonogiri', 'dinasppkbdanp3a@wonogirikab.go.id', 'Jln. Jenderal Sudirman No. 147 A, Wonogiri', '(0273) 321017'),
('14', 'Dinas Kependudukan dan Pencatatan Sipil Kabupaten Wonogiri', 'disdukcapil@wonogirikab.go.id', 'Jln. Jenderal Sudirman No. 147 A, Wonogiri', '(0273) 321468'),
('15', 'Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Wonogiri', 'dinaspmdwng@gmail.com', 'Jl. Durian No. 11 Sanggrahan, Wonogiri (Gedung Barat dan Selatan)', '(0273)323553'),
('16', 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Wonogiri', '', 'Jl. Pemuda I No. 5 Wonogiri', ''),
('17', 'Dinas Koperasi, Usaha Kecil dan Menengah dan Perindustrian dan Perdagangan Kabupaten Wonogiri', '', 'Jln. Raden Mas Said No. 3, Wonogiri', '(0273) 321164'),
('18', 'Dinas Tenaga Kerja Kabupaten Wonogiri', 'nakertranswonogiri@gmail.com', 'Jln. Pemuda I No. 5, Wonogiri', '(0273) 321029'),
('19', 'Dinas Komunikasi dan Informatika Kabupaten Wonogiri', 'diskominfo@wonogirikab.go.id', 'Jln. Kabupaten No. 5, Wonogiri', '(0273) 321002'),
('2', 'Sekertariat Daerah Kabupaten Wonogiri', 'setda@wonogirikab.go.id', ' Jl. Kabupaten Nomor 4 Wonogiri', '(0273) 321002'),
('20', 'Dinas Perumahan Rakyat dan Kawasan Permukiman dan Pertanahan Kabupaten Wonogiri', 'disperakppwonogiri@gmail.com', 'Jl. Raya Wonogiri - Ngadirojo KM. 03 Bulusulur. Wonogiri', '(0273) 5328944'),
('21', 'Dinas Pekerjaan Umum Kabupaten Wonogiri', 'dpu@wonogirikab.go.id', 'Jln. Diponegoro Km 3,5 Bulusari, Bulusulur, Wonogiri', '(0273) 321795'),
('22', 'Dinas Lingkungan Hidup Kabupaten Wonogiri', '', 'Jln. Diponegoro Km 3,5 Bulusari, Bulusulur, Wonogiri', ''),
('23', 'Dinas Pertanian dan Pangan Kabupaten Wonogiri', 'dipertandanpangan@wonogirikab.go.id', 'Jln. Diponegoro Km 3,5 Bulusari, Bulusulur, Wonogiri', '(0273) 321081'),
('24', 'Dinas Kelautan dan Perikanan dan Peternakan Kabupaten Wonogiri', 'disnakperla.wng@gmail.com', 'Jln. Diponegoro No.99, Wonogiri', '(0273) 321071'),
('25', 'Dinas Kearsipan Kabupaten Wonogiri', 'dinaskearsipan@wonogirikab.go.id', 'Jl. Yudistira XIV No. 7 Wonokarto, Wonogiri', '(0273) 321303'),
('26', 'Dinas Perhubungan Kabupaten Wonogiri', 'dishub@wonogirikab.go.id', 'Jln. Raden Mas Said No. 2 Wonogiri', '(0273) 321147'),
('3', 'Sekertariat DPRD Kabupaten Wonogiri', 'sekretariatdprd@wonogirikab.go.id', 'Jalan Pemuda II No.4 Wonogiri', '(0273) 321066'),
('4', 'Badan Kepegawaian Kabupaten Wonogiri', 'bkd@wonogirikab.go.id', 'Jl. Kabupaten Nomor 5 Wonogiri', '(0273) 321002'),
('5', 'Badan Pengelolaan Keuangan Kabupaten Wonogiri', '', 'Jl. Raden Mas Said, Wonogiri', '(0273) 322804'),
('6', 'Rumah Sakit Umum Daerah dr. Soediran Mangun Soemarso Kabupaten Wonogiri', 'rsud.soediran@gmail.com', 'Jl. Jend Ahmad Yani No. 40 Wonogiri', '(0273) 321042'),
('7', 'Badang Penanggulangan Bencana Daerah Kabupaten Wonogiri', 'bpbd@wonogirikab.go.id', 'Jl. Jend Sudirman 503 Wonogiri', '(0273) 323184'),
('8', 'Satuan Polisi Pamong Praja Kabupaten Wonogiri', 'satpolppwng@gmail.com', 'Jl. Ir Soekarno Nomor 10 Wonogiri', '(0273) 321021'),
('9', 'Dinas Pendidikan dan Kebudayaan Kabupaten Wonogiri', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lib_ruang`
--

CREATE TABLE `lib_ruang` (
  `ruang_kode` varchar(20) NOT NULL,
  `ruang_nama` varchar(30) NOT NULL,
  `ruang_deskripsi` text NOT NULL,
  `ruang_kapasitas` int(11) NOT NULL,
  `gedung_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_ruang`
--

INSERT INTO `lib_ruang` (`ruang_kode`, `ruang_nama`, `ruang_deskripsi`, `ruang_kapasitas`, `gedung_kode`) VALUES
('KMNF-AULA', 'Aula Tengah', 'Aula Tengah', 23, 'KOMINFO-2'),
('KMNF-AULA-TENGAH', 'Aula Tengah', 'Aula Tengah', 25, NULL),
('KMNF-RPT-1', 'Ruang Pertemuan ', 'Ini adalah ruang untuk pertemuan', 19, 'KOMINFO-1');

-- --------------------------------------------------------

--
-- Table structure for table `lib_status_acara`
--

CREATE TABLE `lib_status_acara` (
  `status_acara_kode` varchar(20) NOT NULL,
  `status_acara_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_status_acara`
--

INSERT INTO `lib_status_acara` (`status_acara_kode`, `status_acara_nama`) VALUES
('1', 'Belum Selesai'),
('2', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `lib_status_reservasi`
--

CREATE TABLE `lib_status_reservasi` (
  `status_reservasi_kode` varchar(20) NOT NULL,
  `status_reservasi_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_status_reservasi`
--

INSERT INTO `lib_status_reservasi` (`status_reservasi_kode`, `status_reservasi_nama`) VALUES
('1', 'Diajukan'),
('2', 'Diterima'),
('3', 'Ditolak'),
('4', 'Berjalan'),
('5', 'Selesai'),
('6', 'Dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `tr_acara`
--

CREATE TABLE `tr_acara` (
  `acara_id` int(11) NOT NULL,
  `acara_nama` varchar(50) DEFAULT NULL,
  `users_nip` varchar(20) DEFAULT NULL,
  `jenis_acara_kode` varchar(20) DEFAULT NULL,
  `acara_keterangan` text NOT NULL,
  `acara_jumlah_peserta` int(11) NOT NULL,
  `status_acara_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_acara`
--

INSERT INTO `tr_acara` (`acara_id`, `acara_nama`, `users_nip`, `jenis_acara_kode`, `acara_keterangan`, `acara_jumlah_peserta`, `status_acara_kode`) VALUES
(1, 'Audit Laporan Administrasi', '0000000000000001', '1', 'Rapat Audit Laporan Administrasi ', 50, '1'),
(2, 'KOMINFO-Bertemu dengan Mahasiswa UNS', NULL, '1', 'Membahas project PBL                                        ', 10, '1'),
(3, 'Pelantikan Kepala Sekretariat Daerah', '0000000000000001', '5', 'Pelantikan Kepala Sekretariat Daerah', 100, '1'),
(5, 'Workshop Digitalisasi Administrasi OPD', '0000000000000001', '3', 'Diikuti oleh seluruh Aparatur Sipil Negara', 50, '1'),
(6, 'KOMINFO-Rapat Besar', NULL, '5', 'Rapat dengan Elon Musk, Bill Gate, Bupati, dan Presiden', 4, '1'),
(8, '', '0000000000000006', NULL, '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tr_reservasi`
--

CREATE TABLE `tr_reservasi` (
  `reservasi_id` int(11) NOT NULL,
  `ruang_kode` varchar(20) DEFAULT NULL,
  `users_nip` varchar(20) DEFAULT NULL,
  `acara_id` int(11) DEFAULT NULL,
  `reservasi_deskripsi` text NOT NULL,
  `reservasi_mulai` time NOT NULL,
  `reservasi_berakhir` time NOT NULL,
  `reservasi_tanggal` date NOT NULL,
  `reservasi_created_at` datetime NOT NULL,
  `reservasi_update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status_reservasi_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_reservasi`
--

INSERT INTO `tr_reservasi` (`reservasi_id`, `ruang_kode`, `users_nip`, `acara_id`, `reservasi_deskripsi`, `reservasi_mulai`, `reservasi_berakhir`, `reservasi_tanggal`, `reservasi_created_at`, `reservasi_update_at`, `status_reservasi_kode`) VALUES
(8, 'KMNF-RPT-1', '0000000000000001', 1, 'ini', '13:45:00', '15:45:00', '2022-05-29', '2022-05-29 01:05:33', '2022-06-04 08:38:51', '1'),
(10, 'KMNF-RPT-1', '0000000000000006', 2, 'Ini Reservasi Baru\r\n', '15:03:00', '15:03:00', '2022-05-29', '2022-05-29 03:05:28', '2022-06-02 14:16:14', '3'),
(11, 'KMNF-RPT-1', '0000000000000002', 3, 'a', '18:06:00', '20:06:00', '2022-05-29', '2022-05-29 06:05:41', '2022-06-08 04:58:54', '4'),
(12, 'KMNF-RPT-1', '0000000000000004', 1, 'Makan Makan', '11:09:00', '15:08:00', '2022-05-30', '2022-05-29 11:05:59', '2022-06-07 05:52:22', '2'),
(13, 'KMNF-RPT-1', '0000000000000004', 1, 'Ini Rapat', '11:09:00', '15:09:00', '2022-05-30', '2022-05-29 11:05:00', '2022-06-02 13:48:26', '3'),
(14, 'KMNF-RPT-1', '0000000000000002', 5, 'Keterangan', '15:10:00', '15:10:00', '2022-05-31', '2022-05-31 03:05:08', '2022-06-02 13:40:46', '2'),
(15, 'KMNF-RPT-1', '0000000000000001', 1, 'j', '12:43:00', '12:47:00', '2022-06-04', '2022-06-04 12:06:00', '2022-06-08 05:02:53', '4'),
(16, 'KMNF-RPT-1', '0000000000000001', 1, 'Reservasi', '01:35:00', '19:35:00', '2022-06-06', '2022-06-05 01:06:16', '2022-06-07 05:52:07', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nip` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `bidang_kode` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nip`, `email`, `nama`, `telp`, `alamat`, `bidang_kode`, `password_hash`, `reset_hash`, `reset_at`, `activate_hash`, `active`, `group_id`, `created_at`, `updated_at`) VALUES
('0000000000000001', 'superadmin@gmail.com', 'Superadmin ', '0823832948418', 'Jl. Ir. Sutami No.36, Kentingan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'KOMINFO-1', '$2y$10$aZU1BmYNXnPo9j17LTH0ze.CvwnN3aBYGJDiPlDC6pnRtfH5EB6ae', NULL, NULL, 'cb85a5bc1cc9fe142d663fc6c0bf478f728e4856670511214c70f9433b292917', 1, 1, '2022-04-08 12:19:18', '2022-06-02 10:03:48'),
('0000000000000002', 'admin@gmail.com', 'Admin', '0823832948418', 'Jl. Ir. Sutami No.36, Kentingan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'SEKDA-1', '$2y$10$VJdIdbwR6nuYAErP1UcW4e.ToDcwhAOEBhABhd4BZJp1VhGcjJq6u', NULL, NULL, '5997f977ebe81c7cf87cd7c33aff32438175831c0bbbc03433908acb25b94376', 1, 2, '2022-04-08 13:00:38', '2022-06-02 10:03:48'),
('0000000000000003', 'user@gmail.com', 'User PNS', '0823832948418', 'Jl. Ir. Sutami No.36, Kentingan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'SEKDA-2', '$2y$10$yDFXA/pD5Vuk6mMR3DvSHeCCIqAZZbWFS.nN61.wAIQjQmfVXqnaO', NULL, NULL, '699e5410e199df3f77f6a96a98fd8f7e4d02e2880ce24035d44a0b432b1c49c7', 1, 3, '2022-04-08 13:01:30', '2022-06-02 10:03:48'),
('0000000000000004', 'ridhofataulwan@gmail.com', 'Ridho Fata Ulwan', '0823832948418', 'Kendaga RT 04/RW 02 (Dusun Senggana)', 'KOMINFO-1', '$2y$10$YXt2m8kI/Ch9UbAd3TMX1eOTxxyTv08Pk0nJ2p877WhODx0uRwPxi', NULL, '2022-05-29 23:05:46', NULL, 1, 1, '2022-05-29 23:02:48', '2022-06-02 10:03:48'),
('0000000000000006', 'ridhofataulwan@student.uns.ac.id', 'Ridho Fata Ulwan Student', '+6282237461803', 'Kendaga, Banjarmangu, Banjarnegara', 'KOMINFO-1', '$2y$10$fRPEUEr9F/.foKcFc0nppO3KA.eE/HvndfzuzxOLTFw/MKmyu.sQ.', NULL, NULL, NULL, 1, 3, '2022-05-29 02:58:17', '2022-06-02 10:03:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lib_bidang`
--
ALTER TABLE `lib_bidang`
  ADD PRIMARY KEY (`bidang_kode`),
  ADD KEY `lib_bidang_opd_kode_foreign` (`opd_kode`);

--
-- Indexes for table `lib_gedung`
--
ALTER TABLE `lib_gedung`
  ADD PRIMARY KEY (`gedung_kode`),
  ADD KEY `lib_gedung_opd_kode_foreign` (`opd_kode`);

--
-- Indexes for table `lib_jenis_acara`
--
ALTER TABLE `lib_jenis_acara`
  ADD PRIMARY KEY (`jenis_acara_kode`);

--
-- Indexes for table `lib_opd`
--
ALTER TABLE `lib_opd`
  ADD PRIMARY KEY (`opd_kode`);

--
-- Indexes for table `lib_ruang`
--
ALTER TABLE `lib_ruang`
  ADD PRIMARY KEY (`ruang_kode`),
  ADD KEY `lib_ruang_gedung_kode_foreign` (`gedung_kode`);

--
-- Indexes for table `lib_status_acara`
--
ALTER TABLE `lib_status_acara`
  ADD PRIMARY KEY (`status_acara_kode`);

--
-- Indexes for table `lib_status_reservasi`
--
ALTER TABLE `lib_status_reservasi`
  ADD PRIMARY KEY (`status_reservasi_kode`);

--
-- Indexes for table `tr_acara`
--
ALTER TABLE `tr_acara`
  ADD PRIMARY KEY (`acara_id`),
  ADD KEY `tr_acara_jenis_acara_kode_foreign` (`jenis_acara_kode`),
  ADD KEY `tr_acara_status_acara_kode_foreign` (`status_acara_kode`),
  ADD KEY `tr_acara_users_nip_foreign` (`users_nip`);

--
-- Indexes for table `tr_reservasi`
--
ALTER TABLE `tr_reservasi`
  ADD PRIMARY KEY (`reservasi_id`),
  ADD KEY `tr_reservasi_ruang_kode_foreign` (`ruang_kode`),
  ADD KEY `tr_reservasi_acara_id` (`acara_id`),
  ADD KEY `tr_reservasi_status_reservasi_kode` (`status_reservasi_kode`),
  ADD KEY `tr_reservasi_users_nip_foreign` (`users_nip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_bidang_kode_foreign` (`bidang_kode`),
  ADD KEY `users_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tr_acara`
--
ALTER TABLE `tr_acara`
  MODIFY `acara_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tr_reservasi`
--
ALTER TABLE `tr_reservasi`
  MODIFY `reservasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lib_bidang`
--
ALTER TABLE `lib_bidang`
  ADD CONSTRAINT `lib_bidang_opd_kode_foreign` FOREIGN KEY (`opd_kode`) REFERENCES `lib_opd` (`opd_kode`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `lib_gedung`
--
ALTER TABLE `lib_gedung`
  ADD CONSTRAINT `lib_gedung_opd_kode_foreign` FOREIGN KEY (`opd_kode`) REFERENCES `lib_opd` (`opd_kode`);

--
-- Constraints for table `lib_ruang`
--
ALTER TABLE `lib_ruang`
  ADD CONSTRAINT `lib_ruang_gedung_kode_foreign` FOREIGN KEY (`gedung_kode`) REFERENCES `lib_gedung` (`gedung_kode`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tr_acara`
--
ALTER TABLE `tr_acara`
  ADD CONSTRAINT `tr_acara_jenis_acara_kode_foreign` FOREIGN KEY (`jenis_acara_kode`) REFERENCES `lib_jenis_acara` (`jenis_acara_kode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tr_acara_status_acara_kode_foreign` FOREIGN KEY (`status_acara_kode`) REFERENCES `lib_status_acara` (`status_acara_kode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tr_acara_users_nip_foreign` FOREIGN KEY (`users_nip`) REFERENCES `users` (`nip`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tr_reservasi`
--
ALTER TABLE `tr_reservasi`
  ADD CONSTRAINT `tr_reservasi_acara_id` FOREIGN KEY (`acara_id`) REFERENCES `tr_acara` (`acara_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tr_reservasi_ruang_kode_foreign` FOREIGN KEY (`ruang_kode`) REFERENCES `lib_ruang` (`ruang_kode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tr_reservasi_status_reservasi_kode` FOREIGN KEY (`status_reservasi_kode`) REFERENCES `lib_status_reservasi` (`status_reservasi_kode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tr_reservasi_users_nip_foreign` FOREIGN KEY (`users_nip`) REFERENCES `users` (`nip`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_bidang_kode_foreign` FOREIGN KEY (`bidang_kode`) REFERENCES `lib_bidang` (`bidang_kode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;