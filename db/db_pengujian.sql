-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 04:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_temp`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `auth_group`
--

INSERT INTO `auth_group` (`id`, `group`, `definition`) VALUES
(15, 'admin', 'Admin'),
(16, 'penguji', 'penguji'),
(17, 'pemohon', 'Pemohon');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission`
--

CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `permission`, `definition`) VALUES
(127, 'config_view_default', 'Module config'),
(128, 'config_view_logo', 'Module config'),
(129, 'config_view_sosmed', 'Module config'),
(130, 'config_view_system', 'Module config'),
(131, 'config_update_web_name', 'Module config'),
(132, 'config_update_web_domain', 'Module config'),
(133, 'config_update_web_owner', 'Module config'),
(134, 'config_update_email', 'Module config'),
(135, 'config_update_telepon', 'Module config'),
(136, 'config_update_address', 'Module config'),
(137, 'config_update_logo', 'Module config'),
(138, 'config_update_facebook', 'Module config'),
(139, 'config_update_instagram', 'Module config'),
(140, 'config_update_youtube', 'Module config'),
(141, 'config_update_twitter', 'Module config'),
(142, 'config_update_user_log_status', 'Module config'),
(143, 'config_update_maintenance_status', 'Module config'),
(144, 'menu_list', 'Module menu'),
(145, 'menu_add', 'Module menu'),
(146, 'menu_update', 'Module menu'),
(147, 'menu_delete', 'Module menu'),
(148, 'menu_drag_positions', 'Module menu'),
(149, 'user_list', 'Module user'),
(150, 'user_add', 'Module user'),
(152, 'user_update', 'Module user'),
(153, 'user_delete', 'Module user'),
(154, 'groups_list', 'Module groups'),
(155, 'groups_add', 'Module groups'),
(156, 'groups_access', 'Module groups'),
(157, 'groups_update', 'Module groups'),
(158, 'groups_delete', 'Module groups'),
(159, 'permission_list', 'Module permission'),
(160, 'permission_add', 'Module permission'),
(162, 'permission_update', 'Module permission'),
(163, 'permission_delete', 'Module permission'),
(171, 'dashboard__view_profile_user', 'Module dashboard'),
(175, 'dashboard_view_total_user', 'Module dashboard'),
(176, 'dashboard_view_total_group', 'Module dashboard'),
(178, 'user_detail', 'Module user'),
(179, 'config_update_language', 'Module config'),
(180, 'config_update_time_zone', 'Module config'),
(181, 'testing_list', 'Module testing'),
(182, 'testing_add', 'Module testing'),
(183, 'testing_update', 'Module testing'),
(184, 'testing_delete', 'Module testing'),
(185, 'testing_detail', 'Module testing'),
(186, 'profile_list', 'Module profile'),
(187, 'profile_add', 'Module profile'),
(188, 'profile_detail', 'Module profile'),
(189, 'profile_update', 'Module profile'),
(190, 'profile_delete', 'Module profile'),
(191, 'test_module_list', 'Module test'),
(192, 'test_module_add', 'Module test'),
(193, 'test_module_update', 'Module test'),
(194, 'test_module_delete', 'Module test'),
(195, 'test_module_detail', 'Module test'),
(196, 'filemanager_list', 'Module filemanager'),
(197, 'filemanager_add', 'Module filemanager'),
(198, 'filemanager_delete', 'Module filemanager'),
(212, 'sidebar_view_user', 'Module sidebar'),
(213, 'sidebar_view_groups', 'Module sidebar'),
(214, 'sidebar_view_permission', 'Module sidebar'),
(215, 'sidebar_view_config', 'Module sidebar'),
(216, 'sidebar_view_management_menu', 'Module sidebar'),
(217, 'sidebar_view_file_manager', 'Module sidebar'),
(218, 'sidebar_view_auth', 'Module sidebar'),
(219, 'sidebar_view_config_system', 'Module sidebar'),
(220, 'sidebar_view_test_module', 'Module sidebar'),
(222, 'sidebar_view_dashboard', 'Module sidebar'),
(223, 'sidebar_view_m-crud_generator', 'Module sidebar'),
(226, 'config_update_encryption_key', 'Module config'),
(227, 'config_update_encryption_url', 'Module config'),
(230, 'config_update_url_suffix', 'Module config'),
(231, 'sidebar_view_profile', 'Module sidebar'),
(232, 'sidebar_view_master_data', 'Module sidebar'),
(233, 'sidebar_view_data_karyawan', 'Module sidebar'),
(234, 'karyawan_list', 'Module karyawan'),
(235, 'karyawan_add', 'Module karyawan'),
(236, 'karyawan_detail', 'Module karyawan'),
(237, 'karyawan_update', 'Module karyawan'),
(238, 'sidebar_view_data_pemohon', 'Module sidebar'),
(239, 'pemohon_list', 'Module pemohon'),
(240, 'sidebar_view_data_tarif', 'Module sidebar'),
(241, 'tarif_list', 'Module tarif'),
(242, 'tarif_add', 'Module tarif'),
(243, 'sidebar_view_data_kendaraan', 'Module sidebar'),
(244, 'kendaraan_list', 'Module kendaraan'),
(245, 'kendaraan_add', 'Module kendaraan'),
(246, 'kendaraan_detail', 'Module kendaraan'),
(247, 'kendaraan_delete', 'Module kendaraan'),
(248, 'sidebar_view_pembayaran', 'Module sidebar'),
(249, 'pembayaran_list', 'Module pembayaran'),
(250, 'sidebar_view_data_pengujian', 'Module sidebar'),
(251, 'pengujian_list', 'Module pengujian'),
(252, 'pemohon_add', 'modul pemohon'),
(253, 'pemohon_update', 'Pemogon Update'),
(254, 'pemohon_delete', 'pemohon'),
(255, 'pemohon_detail', 'm pemohon'),
(256, 'tarif_delete', ''),
(257, 'tarif_detail', ''),
(258, 'tarif_update', ''),
(259, 'pembayaran_add', ''),
(260, 'pembayaran_update', ''),
(261, 'pembayaran_delete', ''),
(262, 'pembayaran_detail', ''),
(263, 'pengujian_add', ''),
(264, 'pengujian_update', ''),
(265, 'pengujian_delete', ''),
(266, 'pengujian_detail', ''),
(267, 'kendaraan_update', 'Module kendaraan'),
(268, 'sidebar_view_data_hasil_pengujian', 'Module sidebar'),
(269, 'sidebar_view_laporan', 'Module sidebar'),
(270, 'sidebar_view_hasil_pengujian', 'Module sidebar'),
(271, 'sidebar_view_kendaraan', 'Module sidebar'),
(272, 'sidebar_view_karyawan', 'Module sidebar'),
(273, 'sidebar_view_pemohon', 'Module sidebar');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission_to_group`
--

CREATE TABLE `auth_permission_to_group` (
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `auth_permission_to_group`
--

INSERT INTO `auth_permission_to_group` (`permission_id`, `group_id`) VALUES
(127, 6),
(128, 6),
(129, 6),
(130, 6),
(131, 6),
(132, 6),
(133, 6),
(134, 6),
(135, 6),
(136, 6),
(137, 6),
(138, 6),
(139, 6),
(140, 6),
(141, 6),
(142, 6),
(143, 6),
(179, 6),
(180, 6),
(226, 6),
(227, 6),
(230, 6),
(144, 6),
(145, 6),
(146, 6),
(147, 6),
(148, 6),
(149, 6),
(150, 6),
(152, 6),
(153, 6),
(178, 6),
(154, 6),
(155, 6),
(156, 6),
(157, 6),
(158, 6),
(159, 6),
(160, 6),
(162, 6),
(163, 6),
(171, 6),
(175, 6),
(176, 6),
(181, 6),
(182, 6),
(183, 6),
(184, 6),
(185, 6),
(186, 6),
(187, 6),
(188, 6),
(189, 6),
(190, 6),
(191, 6),
(192, 6),
(193, 6),
(194, 6),
(195, 6),
(196, 6),
(198, 6),
(212, 6),
(213, 6),
(214, 6),
(215, 6),
(216, 6),
(217, 6),
(218, 6),
(219, 6),
(220, 6),
(222, 6),
(223, 6),
(231, 6),
(171, 17),
(222, 17),
(231, 17),
(243, 17),
(268, 17),
(239, 17),
(253, 17),
(255, 17),
(244, 17),
(245, 17),
(246, 17),
(247, 17),
(267, 17),
(251, 17),
(266, 17),
(171, 16),
(175, 16),
(176, 16),
(186, 16),
(187, 16),
(188, 16),
(189, 16),
(190, 16),
(222, 16),
(243, 16),
(250, 16),
(244, 16),
(246, 16),
(251, 16),
(263, 16),
(264, 16),
(265, 16),
(266, 16),
(149, 15),
(150, 15),
(152, 15),
(153, 15),
(178, 15),
(171, 15),
(175, 15),
(176, 15),
(186, 15),
(187, 15),
(188, 15),
(189, 15),
(190, 15),
(212, 15),
(218, 15),
(222, 15),
(232, 15),
(233, 15),
(238, 15),
(240, 15),
(243, 15),
(248, 15),
(250, 15),
(269, 15),
(270, 15),
(271, 15),
(272, 15),
(273, 15),
(234, 15),
(235, 15),
(236, 15),
(237, 15),
(239, 15),
(252, 15),
(253, 15),
(254, 15),
(255, 15),
(241, 15),
(242, 15),
(256, 15),
(257, 15),
(258, 15),
(244, 15),
(245, 15),
(246, 15),
(247, 15),
(267, 15),
(249, 15),
(259, 15),
(260, 15),
(261, 15),
(262, 15),
(251, 15),
(263, 15),
(264, 15),
(265, 15),
(266, 15);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `is_delete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id_user`, `name`, `email`, `password`, `token`, `last_login`, `ip_address`, `is_active`, `created`, `modified`, `is_delete`) VALUES
(16, 'Penguji', 'penguji@user.com', '$2y$10$x0QK7PVI3I1dMr.OHWLT9OhmdgvQGvqYWs2BoJQyEtMznKStrgjvi', 'EAD4J0rnVk7cQzbrYDv8g4sSCP8qBMQq', '2021-11-27 22:36:00', '::1', '1', '2021-11-20 18:20:19', NULL, '0'),
(17, 'Admin', 'admin@gmail.com', '$2y$10$x0QK7PVI3I1dMr.OHWLT9OhmdgvQGvqYWs2BoJQyEtMznKStrgjvi', 'EAD4J0rnVk7cQzbrYDv8g4sSCP8qBMQq', '2021-11-27 22:57:00', '::1', '1', '2021-11-23 17:53:57', NULL, '0'),
(18, 'Bryand J', 'bryandj@gmail.com', '$2y$10$x0QK7PVI3I1dMr.OHWLT9OhmdgvQGvqYWs2BoJQyEtMznKStrgjvi', 'EAD4J0rnVk7cQzbrYDv8g4sSCP8qBMQq', '2021-11-27 22:35:00', '::1', '1', '2021-11-23 20:03:11', '2021-11-23 20:06:11', '0');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_to_group`
--

CREATE TABLE `auth_user_to_group` (
  `id_user` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `auth_user_to_group`
--

INSERT INTO `auth_user_to_group` (`id_user`, `id_group`) VALUES
(1, 1),
(2, 6),
(3, 2),
(7, 6),
(8, 2),
(9, 2),
(10, 6),
(11, 6),
(12, 6),
(13, 6),
(14, 6),
(15, 6),
(16, 16),
(17, 15),
(18, 17);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ci_user_log`
--

CREATE TABLE `ci_user_log` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager`
--

CREATE TABLE `filemanager` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `filemanager`
--

INSERT INTO `filemanager` (`id`, `file_name`, `ket`, `created`, `update`) VALUES
(14, '20201108015817-image-removebg-p.png', 'Di upload melalu module title', '2020-11-08 01:58:00', NULL),
(15, '20201108020110-posisi_standar_a.jpg', 'Di upload melalu module Test Module', '2020-11-08 02:01:00', NULL),
(16, '85a8fd633c-529px-BUMN_Hadir.png', 'Di upload melalui module File manager', '2020-11-09 21:39:54', NULL),
(17, 'cb5a5cf117-doctor_icon_1348.png', 'Di upload melalui module File manager', '2020-11-09 21:40:18', NULL),
(18, '533bb2b82b-1678983414.png', 'Di upload melalui module Profile', '2020-11-10 14:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `id_menu` int(11) NOT NULL,
  `is_parent` int(11) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `type` enum('controller','url') DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id_menu`, `is_parent`, `menu`, `slug`, `type`, `controller`, `target`, `icon`, `is_active`, `sort`, `created`, `modified`) VALUES
(3, 7, 'management menu', 'management-menu', 'controller', 'main_menu', '', '', '1', 21, '2020-02-15 06:48:31', '2020-11-02 13:33:26'),
(7, 0, 'config system', 'config-system', NULL, '', NULL, 'fa fa-cogs', '1', 19, '2020-02-26 06:42:29', '2020-10-27 09:10:41'),
(34, 7, 'config', 'config', 'controller', 'setting', NULL, '', '1', 20, '2020-10-19 00:25:57', '2020-10-27 09:09:20'),
(36, 0, 'dashboard', 'dashboard', 'controller', 'dashboard', '', 'mdi mdi-laptop', '1', 1, '2020-10-27 08:18:55', '2020-11-09 23:07:13'),
(37, 0, 'auth', 'auth', NULL, '', NULL, 'mdi mdi-account-settings-variant', '1', 15, '2020-10-27 08:45:17', NULL),
(38, 37, 'user', 'user', 'controller', 'user', NULL, 'mdi mdi-account-star', '1', 16, '2020-10-27 08:46:10', '2020-10-27 09:38:05'),
(39, 37, 'groups', 'groups', 'controller', 'group', NULL, '', '1', 17, '2020-10-27 08:48:28', '2020-10-27 20:24:12'),
(40, 37, 'permission', 'permission', 'controller', 'permission', NULL, '', '1', 18, '2020-10-27 08:49:49', '2020-10-29 22:47:10'),
(48, 0, 'm-crud generator', 'm-crud-generator', 'url', 'http://localhost/ci/mcrud', '_blank', 'mdi mdi-xml', '1', 23, '2020-11-01 12:23:11', '2020-11-06 18:27:33'),
(54, 7, 'file manager', 'file-manager', 'controller', 'filemanager', '', 'mdi mdi-folder-multiple-image', '1', 22, '2020-11-08 00:44:38', NULL),
(57, 0, 'data karyawan', 'data-karyawan', 'controller', 'karyawan', '', 'fa fa-address-card', '1', 3, '2021-11-20 17:18:44', NULL),
(58, 0, 'data pemohon', 'data-pemohon', 'controller', 'pemohon', '', 'fa fa-address-book-o', '1', 4, '2021-11-20 17:33:30', NULL),
(59, 0, 'data tarif', 'data-tarif', 'controller', 'tarif', '', 'ion-card', '1', 5, '2021-11-20 17:37:31', NULL),
(60, 0, 'data kendaraan', 'data-kendaraan', 'controller', 'kendaraan', '', 'ion-model-s', '1', 6, '2021-11-20 17:44:15', NULL),
(61, 0, 'pembayaran', 'pembayaran', 'controller', 'pembayaran', '', 'fa fa-handshake-o', '1', 7, '2021-11-20 17:52:25', NULL),
(62, 0, 'data hasil pengujian', 'data-hasil-pengujian', 'controller', 'pengujian', '', 'ion-social-foursquare', '1', 9, '2021-11-20 18:01:39', '2021-11-23 20:15:37'),
(63, 0, 'profile', 'profile', 'controller', 'my_profile', '', 'mdi mdi-account', '1', 2, '2021-11-23 20:14:18', '2021-11-23 20:14:45'),
(64, 0, 'data pengujian', 'data-pengujian', 'controller', 'pengujian', '', 'mdi mdi-checkbox-multiple-marked-outline', '1', 8, '2021-11-23 22:57:15', NULL),
(65, 0, 'laporan', 'laporan', 'controller', '', '', 'mdi mdi-library-books', '1', 10, '2021-11-26 12:22:34', NULL),
(66, 65, 'hasil pengujian', 'hasil-pengujian', 'controller', 'laporan_pengujian', '', 'ion-ios7-checkmark', '1', 13, '2021-11-26 12:25:46', NULL),
(67, 65, 'kendaraan', 'kendaraan', 'controller', 'laporan_kendaraan', '', 'mdi mdi-car', '1', 14, '2021-11-26 12:26:47', NULL),
(68, 65, 'karyawan', 'karyawan', 'controller', 'laporan_karyawan', '', 'fa fa-id-badge', '1', 12, '2021-11-26 12:27:29', NULL),
(69, 65, 'pemohon', 'pemohon', 'controller', 'laporan_pemohon', '', 'fa fa-vcard', '1', 11, '2021-11-26 12:28:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `group` varchar(50) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `group`, `options`, `value`) VALUES
(1, 'general', 'web_name', 'M - CODE'),
(2, 'general', 'web_domain', 'https://localhost/ci'),
(3, 'general', 'web_owner', 'mpampam'),
(4, 'general', 'email', 'mpampam5@gmail.com'),
(5, 'general', 'telepon', '085288882994'),
(6, 'general', 'address', 'Jalan Muhajirin raya kecamatan tamalate, kota makassar'),
(7, 'general', 'logo', 'logonew.png'),
(8, 'sosmed', 'facebook', 'https://facebook.com/mpampam'),
(9, 'sosmed', 'instagram', 'https://instagram/mpampam'),
(10, 'sosmed', 'youtube', 'https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA'),
(11, 'sosmed', 'twitter', 'https://twitter/m_pampam'),
(12, 'config', 'maintenance_status', 'N'),
(13, 'config', 'user_log_status', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jabatan` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id`, `nip`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `jabatan`, `alamat`, `telepon`) VALUES
(1, '09887766636353', 'Bryand', 'Laki-Laki', 'NTT', '2021-11-17', 'Kepala', 'Kupang', '099885'),
(2, '4567890-', 'ni', 'L', 'iddd', '2021-11-12', 'chd', 'dfghjklmnbvbnm', '456789');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(100) NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `no_mesin` varchar(20) NOT NULL,
  `no_rangka` varchar(10) NOT NULL,
  `mrk_kendaraan` varchar(20) NOT NULL,
  `thn_kendaraan` varchar(4) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `berat_jbkb` int(10) NOT NULL,
  `berta_kosong` int(10) NOT NULL,
  `daya_barang` int(10) NOT NULL,
  `daya_orang` int(10) NOT NULL,
  `masa_berlaku` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `no_pendaftaran`, `no_mesin`, `no_rangka`, `mrk_kendaraan`, `thn_kendaraan`, `jenis`, `berat_jbkb`, `berta_kosong`, `daya_barang`, `daya_orang`, `masa_berlaku`) VALUES
(1, '1', '123', '123', 'Honda', '2020', '1', 200, 150, 20, 2, '2021-11-30'),
(7, '1', '100', '1020', 'Susuki', '2021', '1', 200, 834, 73, 34, '2021-11-25'),
(8, '1', '123', '123', 'Honda Revo', '2000', '1', 120, 120, 2, 2, '2021-11-23'),
(9, '3', '123', '123', 'Avanza', '2015', '2', 400, 300, 100, 6, '2021-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(20) NOT NULL,
  `tgl_pembayaran` datetime NOT NULL DEFAULT current_timestamp(),
  `no_pendaftaran` int(20) NOT NULL,
  `no_kendaraan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `tgl_pembayaran`, `no_pendaftaran`, `no_kendaraan`) VALUES
(4, '2021-11-24 18:34:00', 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemohon`
--

CREATE TABLE `tb_pemohon` (
  `id` int(100) NOT NULL,
  `no_pendaftaran` int(10) NOT NULL,
  `jenis_identitas` varchar(20) NOT NULL,
  `id_identitas` int(15) NOT NULL,
  `tgl_pendaftaran` date NOT NULL DEFAULT current_timestamp(),
  `nama_pemilik` varchar(50) NOT NULL,
  `alamat_pemilik` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pemohon`
--

INSERT INTO `tb_pemohon` (`id`, `no_pendaftaran`, `jenis_identitas`, `id_identitas`, `tgl_pendaftaran`, `nama_pemilik`, `alamat_pemilik`, `jenis_kelamin`, `pekerjaan`, `username`, `email`, `password`) VALUES
(1, 1, 'KTP', 2147483647, '2021-12-16', 'Markus', 'Binjai', 'L', 'Petinju', 'sopir123', 'sopir@g.com', '12345'),
(4, 3, 'KTP', 2147483647, '2020-11-23', 'Bryand J', 'Kupang ndnisdis', 'L', 'Developer', 'Bryand', 'bryandj@gmail.com', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengujian`
--

CREATE TABLE `tb_pengujian` (
  `id` int(11) NOT NULL,
  `no_pemeriksaan` int(20) NOT NULL,
  `tgl_pemeriksaan` date NOT NULL DEFAULT current_timestamp(),
  `no_kendaraan` int(20) NOT NULL,
  `peralatan` varchar(10) NOT NULL,
  `penerangan` varchar(10) NOT NULL,
  `kemudi` varchar(10) NOT NULL,
  `suspensi` varchar(10) NOT NULL,
  `ban` varchar(10) NOT NULL,
  `rangka` varchar(10) NOT NULL,
  `rem` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengujian`
--

INSERT INTO `tb_pengujian` (`id`, `no_pemeriksaan`, `tgl_pemeriksaan`, `no_kendaraan`, `peralatan`, `penerangan`, `kemudi`, `suspensi`, `ban`, `rangka`, `rem`, `keterangan`) VALUES
(1, 1, '2021-11-11', 1, 'lengkap', 'baik', 'baik', 'baik', 'botak', 'kokoh', 'blong', 'Tidak Lulus'),
(2, 123, '2021-11-27', 9, 'Lengkap', 'Lengkap', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_jenis` int(20) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `sub_jenis` varchar(20) NOT NULL,
  `sifat` varchar(20) NOT NULL,
  `biaya` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_jenis`, `jenis_mobil`, `sub_jenis`, `sifat`, `biaya`) VALUES
(1, 'Angkot', 'angkutan kota', 'umum', '100000'),
(2, 'Sedan', 'kecil', 'Pribadi', '300000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `ci_user_log`
--
ALTER TABLE `ci_user_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `filemanager`
--
ALTER TABLE `filemanager`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`) USING BTREE;

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_pemohon`
--
ALTER TABLE `tb_pemohon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengujian`
--
ALTER TABLE `tb_pengujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_jenis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `auth_permission`
--
ALTER TABLE `auth_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ci_user_log`
--
ALTER TABLE `ci_user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `filemanager`
--
ALTER TABLE `filemanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pemohon`
--
ALTER TABLE `tb_pemohon`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pengujian`
--
ALTER TABLE `tb_pengujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_jenis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
