-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2022 at 08:02 AM
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
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `users_nip` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `users_nip` varchar(20) NOT NULL,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lib_bidang`
--

CREATE TABLE `lib_bidang` (
  `bidang_kode` varchar(20) NOT NULL,
  `bidang_nama` varchar(30) NOT NULL,
  `opd_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lib_gedung`
--

CREATE TABLE `lib_gedung` (
  `gedung_kode` varchar(20) NOT NULL,
  `gedung_nama` varchar(30) NOT NULL,
  `opd_kode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lib_jenis_acara`
--

CREATE TABLE `lib_jenis_acara` (
  `jenis_acara_kode` varchar(20) NOT NULL,
  `jenis_acara_nama` varchar(30) NOT NULL,
  `jenis_acara_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lib_opd`
--

CREATE TABLE `lib_opd` (
  `opd_kode` varchar(20) NOT NULL,
  `opd_nama` varchar(30) NOT NULL,
  `opd_email` varchar(255) NOT NULL,
  `opd_alamat` text NOT NULL,
  `opd_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `lib_status_acara`
--

CREATE TABLE `lib_status_acara` (
  `status_acara_kode` varchar(20) NOT NULL,
  `status_acara_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lib_status_reservasi`
--

CREATE TABLE `lib_status_reservasi` (
  `status_reservasi_kode` varchar(20) NOT NULL,
  `status_reservasi_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1648524287, 1);

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
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`users_nip`),
  ADD KEY `group_id_user_id` (`group_id`,`users_nip`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`users_nip`,`permission_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `username` (`nama`),
  ADD KEY `users_bidang_kode_foreign` (`bidang_kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_users_nip_foreign` FOREIGN KEY (`users_nip`) REFERENCES `users` (`nip`);

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `users_bidang_kode_foreign` FOREIGN KEY (`bidang_kode`) REFERENCES `lib_bidang` (`bidang_kode`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
