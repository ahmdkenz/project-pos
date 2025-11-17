-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2025 at 02:39 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `actor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama user yang melakukan aksi',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'sales, product, stock, security, danger, etc',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'CREATE, UPDATE, DELETE, LOGIN, LOGOUT, etc',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Detail aktivitas yang dilakukan',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` json DEFAULT NULL COMMENT 'Data tambahan dalam format JSON',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `actor`, `type`, `action`, `message`, `ip_address`, `user_agent`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'security', 'LOGOUT', 'keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 10:49:04', '2025-11-14 10:49:04'),
(2, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:06:44', '2025-11-14 19:06:44'),
(3, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Caddy 9.5mm (PRD-151125-AFZDOJ)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:08:35', '2025-11-14 19:08:35'),
(4, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Caddy 12.7 mm (PRD-151125-SU3JKK)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:08:58', '2025-11-14 19:08:58'),
(5, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Keyboard Eyota (PRD-151125-ZGNCUR)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:09:33', '2025-11-14 19:09:33'),
(6, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Conveter HDMI (PRD-151125-V0JR9H)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:09:57', '2025-11-14 19:09:57'),
(7, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Baterai CMOS 2032 (PRD-151125-1USQCM)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:12:29', '2025-11-14 19:12:29'),
(8, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Converter DVI to VGA (PRD-151125-RYGUCT)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:13:59', '2025-11-14 19:13:59'),
(9, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>USB Wifi (PRD-151125-DFNXWG)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:14:53', '2025-11-14 19:14:53'),
(10, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Fan Processor (PRD-151125-PMXOJP)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:15:31', '2025-11-14 19:15:31'),
(11, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>USB Bluetooth v.5.0 (PRD-151125-H0KF2T)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:15:58', '2025-11-14 19:15:58'),
(12, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>USB Wifi Wolfcase (PRD-151125-DFNXWG)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:16:10', '2025-11-14 19:16:10'),
(13, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>USB Printer (PRD-151125-1YYKAP)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:18:13', '2025-11-14 19:18:13'),
(14, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Kabel VGA (PRD-151125-OAEHBJ)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:20:06', '2025-11-14 19:20:06'),
(15, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Conveter HDMI (PRD-151125-57EN1B)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:21:32', '2025-11-14 19:21:32'),
(16, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Mouse Avan (PRD-151125-ECC9FM)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:23:26', '2025-11-14 19:23:26'),
(17, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Mouse Wireless V3000 (PRD-151125-9YXU8T)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:26:09', '2025-11-14 19:26:09'),
(18, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Thermal Paste Botol (PRD-151125-VEXQSS)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:28:16', '2025-11-14 19:28:16'),
(19, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Thermal Paste Suntik (PRD-151125-3QSKAP)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:28:48', '2025-11-14 19:28:48'),
(20, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Motherboard H61 Bulldozer (PRD-151125-UMLZ6P)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:33:40', '2025-11-14 19:33:40'),
(21, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Motherboard H81 Bulldozer (PRD-151125-VX3GRA)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:34:02', '2025-11-14 19:34:02'),
(22, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM VGEN DDR3 4GB 12800 (PRD-151125-DGU5TW)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:36:24', '2025-11-14 19:36:24'),
(23, 1, 'Admin', 'security', 'LOGOUT', 'keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:36:56', '2025-11-14 19:36:56'),
(24, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:36:59', '2025-11-14 19:36:59'),
(25, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM Visipro DDR4 4GB 19200 (PRD-151125-M6RFI5)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:38:31', '2025-11-14 19:38:31'),
(26, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM Team Group DDR4 4GB 2400 (PRD-151125-CZUWNC)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:39:34', '2025-11-14 19:39:34'),
(27, 1, 'Admin', 'danger', 'DELETE', 'menghapus produk <strong>RAM Visipro DDR4 4GB 19200 (PRD-151125-M6RFI5)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:40:57', '2025-11-14 19:40:57'),
(28, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM Visipro DDR4 4GB 19200 (PRD-151125-7WIWFA)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:41:11', '2025-11-14 19:41:11'),
(29, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM SODIMM VGEN DDR3 4GB 10600S (PRD-151125-4ZXO1L)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:46:50', '2025-11-14 19:46:50'),
(30, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM SODIMM VGEN DDR3 4GB 10600 (PRD-151125-H8OSNO)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:47:38', '2025-11-14 19:47:38'),
(31, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM SODIMM Kingston DDR3 2GB 10600S (PRD-151125-TCY53X)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:49:26', '2025-11-14 19:49:26'),
(32, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM SODIMM SKhynix DDR3 2GB 10600S (PRD-151125-OHQIHU)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:50:26', '2025-11-14 19:50:26'),
(33, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>RAM SODIMM VGEN DDR3 4GB 10600S (PRD-151125-4ZXO1L)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:50:56', '2025-11-14 19:50:56'),
(34, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>RAM SODIMM VGEN DDR3 4GB 10600 (PRD-151125-H8OSNO)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:51:16', '2025-11-14 19:51:16'),
(35, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RAM DDR4 8GB 3200AA (PRD-151125-MAQVRY)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:53:33', '2025-11-14 19:53:33'),
(36, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-2120 (PRD-151125-UIY9JG)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:57:09', '2025-11-14 19:57:09'),
(37, 1, 'Admin', 'danger', 'DELETE', 'menghapus produk <strong>Core i3-2120 (PRD-151125-UIY9JG)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:57:16', '2025-11-14 19:57:16'),
(38, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-2120 @3.30Ghz (PRD-151125-1G4KMA)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 19:58:45', '2025-11-14 19:58:45'),
(39, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i5-2320 @3.00Ghz (PRD-151125-SQDHTD)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:01:32', '2025-11-14 20:01:32'),
(40, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-4150 @3.50Ghz (PRD-151125-FXTBFW)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:02:00', '2025-11-14 20:02:00'),
(41, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-4170 @3.70Ghz (PRD-151125-MELAXR)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:02:46', '2025-11-14 20:02:46'),
(42, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-3240 @3.40 Ghz (PRD-151125-TNKAIL)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:05:38', '2025-11-14 20:05:38'),
(43, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-3240 @3.40Ghz (PRD-151125-TNKAIL)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:05:55', '2025-11-14 20:05:55'),
(44, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-4150 @3.50Ghz (PRD-151125-FXTBFW)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:06:30', '2025-11-14 20:06:30'),
(45, 1, 'Admin', 'danger', 'DELETE', 'menghapus produk <strong>Core i3-4150 @3.50Ghz (PRD-151125-FXTBFW)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:06:39', '2025-11-14 20:06:39'),
(46, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-4150 @3.50Ghz (PRD-151125-VRE9Y2)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:07:00', '2025-11-14 20:07:00'),
(47, 1, 'Admin', 'danger', 'DELETE', 'menghapus produk <strong>Core i3-4150 @3.50Ghz (PRD-151125-VRE9Y2)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:08:06', '2025-11-14 20:08:06'),
(48, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-4150 @3.50Ghz (PRD-151125-SLX4AR)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:08:16', '2025-11-14 20:08:16'),
(49, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Core i3-6100 @3.70Ghz (PRD-151125-KLII6E)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:08:52', '2025-11-14 20:08:52'),
(50, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Kaebl LAN (PRD-151125-NOICO1)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:15:56', '2025-11-14 20:15:56'),
(51, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Kabel LAN (PRD-151125-NOICO1)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:16:38', '2025-11-14 20:16:38'),
(52, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>RJ45 CAT5 (PRD-151125-P7JQRI)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:19:31', '2025-11-14 20:19:31'),
(53, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>RJ45 CAT5 (PRD-151125-P7JQRI)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 20:20:30', '2025-11-14 20:20:30'),
(54, 1, 'Admin', 'security', 'LOGOUT', 'keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 21:10:35', '2025-11-14 21:10:35'),
(55, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 21:10:39', '2025-11-14 21:10:39'),
(56, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Conveter HDMI to VGA (PRD-151125-V0JR9H)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 21:37:18', '2025-11-14 21:37:18'),
(57, 1, 'Admin', 'danger', 'DELETE', 'menghapus produk <strong>Conveter HDMI (PRD-151125-57EN1B)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 21:37:32', '2025-11-14 21:37:32'),
(58, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/005)</strong> senilai Rp 10.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 21:38:36', '2025-11-14 21:38:36'),
(59, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/006)</strong> senilai Rp 10.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(60, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-001</strong> untuk pelanggan <strong>Muhammad aldian</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 23:43:29', '2025-11-14 23:43:29'),
(61, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-001</strong> - Status: <strong>Dalam Pengerjaan</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 23:43:50', '2025-11-14 23:43:50'),
(62, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-001</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 23:44:09', '2025-11-14 23:44:09'),
(63, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-001</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 23:53:26', '2025-11-14 23:53:26'),
(64, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-001</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-14 23:58:34', '2025-11-14 23:58:34'),
(65, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-151125-PD8ZYB</strong> untuk pelanggan <strong>Ahmad</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 00:09:51', '2025-11-15 00:09:51'),
(66, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-151125-PD8ZYB</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 00:10:16', '2025-11-15 00:10:16'),
(67, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-151125-PD8ZYB</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 00:10:24', '2025-11-15 00:10:24'),
(68, 1, 'Admin', 'danger', 'DELETE', 'menghapus servis <strong>SVC-151125-PD8ZYB</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 01:23:04', '2025-11-15 01:23:04'),
(69, 1, 'Admin', 'danger', 'DELETE', 'menghapus servis <strong>SVC-001</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 01:23:08', '2025-11-15 01:23:08'),
(70, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Kabel Power Laptop (PRD-151125-JNOYFS)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 01:29:24', '2025-11-15 01:29:24'),
(71, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>HDD CASE 2.5 inch (PRD-151125-HBUC4A)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 01:52:02', '2025-11-15 01:52:02'),
(72, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Power Supply (PRD-151125-BNX2NQ)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 01:57:42', '2025-11-15 01:57:42'),
(73, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:28:08', '2025-11-15 06:28:08'),
(74, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Kuas Besar (PRD-151125-M8MVPI)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:32:47', '2025-11-15 06:32:47'),
(75, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Kuas Kecil (PRD-151125-6CRWJY)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:33:09', '2025-11-15 06:33:09'),
(76, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/007)</strong> senilai Rp 40.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(77, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-151125-3Q5L4T</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:35:12', '2025-11-15 06:35:12'),
(78, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-151125-3Q5L4T</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:35:33', '2025-11-15 06:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_records`
--

CREATE TABLE `notification_records` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contoh: low_stock',
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_stock` int NOT NULL DEFAULT '0',
  `cost_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Beli / Modal',
  `sale_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Jual',
  `min_stock_level` int NOT NULL DEFAULT '0' COMMENT 'Batas minimum stok untuk notifikasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `current_stock`, `cost_price`, `sale_price`, `min_stock_level`, `created_at`, `updated_at`) VALUES
(13, 'Caddy 9.5mm', 'PRD-151125-AFZDOJ', 2, 10000.00, 50000.00, 0, '2025-11-14 19:08:35', '2025-11-14 19:08:35'),
(14, 'Caddy 12.7 mm', 'PRD-151125-SU3JKK', 2, 10000.00, 50000.00, 0, '2025-11-14 19:08:58', '2025-11-14 19:08:58'),
(15, 'Keyboard Eyota', 'PRD-151125-ZGNCUR', 2, 31000.00, 60000.00, 0, '2025-11-14 19:09:33', '2025-11-14 19:09:33'),
(16, 'Conveter HDMI to VGA', 'PRD-151125-V0JR9H', 6, 20000.00, 50000.00, 0, '2025-11-14 19:09:57', '2025-11-14 21:37:18'),
(17, 'Baterai CMOS 2032', 'PRD-151125-1USQCM', 5, 240.00, 10000.00, 0, '2025-11-14 19:12:29', '2025-11-15 06:34:00'),
(18, 'Converter DVI to VGA', 'PRD-151125-RYGUCT', 5, 11000.00, 30000.00, 0, '2025-11-14 19:13:59', '2025-11-14 19:13:59'),
(19, 'USB Wifi Wolfcase', 'PRD-151125-DFNXWG', 4, 15000.00, 50000.00, 0, '2025-11-14 19:14:53', '2025-11-14 19:16:10'),
(20, 'Fan Processor', 'PRD-151125-PMXOJP', 2, 20000.00, 50000.00, 0, '2025-11-14 19:15:31', '2025-11-14 19:15:31'),
(21, 'USB Bluetooth v.5.0', 'PRD-151125-H0KF2T', 2, 10000.00, 30000.00, 0, '2025-11-14 19:15:58', '2025-11-14 19:15:58'),
(22, 'USB Printer', 'PRD-151125-1YYKAP', 8, 7000.00, 20000.00, 0, '2025-11-14 19:18:13', '2025-11-14 19:18:13'),
(23, 'Kabel VGA', 'PRD-151125-OAEHBJ', 10, 6500.00, 25000.00, 0, '2025-11-14 19:20:06', '2025-11-14 19:20:06'),
(25, 'Mouse Avan', 'PRD-151125-ECC9FM', 6, 10000.00, 25000.00, 0, '2025-11-14 19:23:26', '2025-11-14 19:23:26'),
(26, 'Mouse Wireless V3000', 'PRD-151125-9YXU8T', 0, 30000.00, 60000.00, 0, '2025-11-14 19:26:09', '2025-11-14 19:26:09'),
(27, 'Thermal Paste Botol', 'PRD-151125-VEXQSS', 3, 3500.00, 20000.00, 0, '2025-11-14 19:28:16', '2025-11-14 19:28:16'),
(28, 'Thermal Paste Suntik', 'PRD-151125-3QSKAP', 4, 25000.00, 10000.00, 0, '2025-11-14 19:28:48', '2025-11-14 21:39:39'),
(29, 'Motherboard H61 Bulldozer', 'PRD-151125-UMLZ6P', 2, 206000.00, 350000.00, 0, '2025-11-14 19:33:40', '2025-11-14 19:33:40'),
(30, 'Motherboard H81 Bulldozer', 'PRD-151125-VX3GRA', 1, 230000.00, 450000.00, 0, '2025-11-14 19:34:02', '2025-11-14 19:34:02'),
(31, 'RAM VGEN DDR3 4GB 12800', 'PRD-151125-DGU5TW', 3, 50000.00, 100000.00, 0, '2025-11-14 19:36:24', '2025-11-14 19:36:24'),
(33, 'RAM Team Group DDR4 4GB 2400', 'PRD-151125-CZUWNC', 1, 0.00, 200000.00, 0, '2025-11-14 19:39:34', '2025-11-14 19:39:34'),
(34, 'RAM Visipro DDR4 4GB 19200', 'PRD-151125-7WIWFA', 8, 0.00, 125000.00, 0, '2025-11-14 19:41:11', '2025-11-14 19:41:11'),
(35, 'RAM SODIMM VGEN DDR3 4GB 10600S', 'PRD-151125-4ZXO1L', 5, 0.00, 125000.00, 0, '2025-11-14 19:46:50', '2025-11-14 19:50:56'),
(36, 'RAM SODIMM VGEN DDR3 4GB 10600', 'PRD-151125-H8OSNO', 1, 0.00, 125000.00, 0, '2025-11-14 19:47:38', '2025-11-14 19:51:16'),
(37, 'RAM SODIMM Kingston DDR3 2GB 10600S', 'PRD-151125-TCY53X', 2, 0.00, 75000.00, 0, '2025-11-14 19:49:26', '2025-11-14 19:49:26'),
(38, 'RAM SODIMM SKhynix DDR3 2GB 10600S', 'PRD-151125-OHQIHU', 1, 0.00, 75000.00, 0, '2025-11-14 19:50:26', '2025-11-14 19:50:26'),
(39, 'RAM DDR4 8GB 3200AA', 'PRD-151125-MAQVRY', 1, 0.00, 200000.00, 0, '2025-11-14 19:53:33', '2025-11-14 19:53:33'),
(41, 'Core i3-2120 @3.30Ghz', 'PRD-151125-1G4KMA', 4, 0.00, 0.00, 0, '2025-11-14 19:58:45', '2025-11-14 19:58:45'),
(42, 'Core i5-2320 @3.00Ghz', 'PRD-151125-SQDHTD', 1, 0.00, 0.00, 0, '2025-11-14 20:01:32', '2025-11-14 20:01:32'),
(44, 'Core i3-4170 @3.70Ghz', 'PRD-151125-MELAXR', 1, 0.00, 0.00, 0, '2025-11-14 20:02:46', '2025-11-14 20:02:46'),
(45, 'Core i3-3240 @3.40Ghz', 'PRD-151125-TNKAIL', 1, 0.00, 0.00, 0, '2025-11-14 20:05:38', '2025-11-14 20:05:55'),
(47, 'Core i3-4150 @3.50Ghz', 'PRD-151125-SLX4AR', 2, 0.00, 0.00, 0, '2025-11-14 20:08:16', '2025-11-14 20:08:16'),
(48, 'Core i3-6100 @3.70Ghz', 'PRD-151125-KLII6E', 1, 0.00, 0.00, 0, '2025-11-14 20:08:51', '2025-11-14 20:08:51'),
(49, 'Kabel LAN', 'PRD-151125-NOICO1', 298, 296000.00, 5000.00, 0, '2025-11-14 20:15:56', '2025-11-15 06:34:00'),
(50, 'RJ45 CAT5', 'PRD-151125-P7JQRI', 36, 32000.00, 2500.00, 0, '2025-11-14 20:19:31', '2025-11-15 06:34:00'),
(51, 'Kabel Power Laptop', 'PRD-151125-JNOYFS', 4, 150000.00, 30000.00, 0, '2025-11-15 01:29:24', '2025-11-15 01:29:24'),
(52, 'HDD CASE 2.5 inch', 'PRD-151125-HBUC4A', 3, 24500.00, 50000.00, 0, '2025-11-15 01:52:02', '2025-11-15 01:52:02'),
(53, 'Power Supply', 'PRD-151125-BNX2NQ', 10, 30000.00, 60000.00, 0, '2025-11-15 01:57:42', '2025-11-15 01:57:42'),
(54, 'Kuas Besar', 'PRD-151125-M8MVPI', 1, 1000.00, 15000.00, 0, '2025-11-15 06:32:47', '2025-11-15 06:34:00'),
(55, 'Kuas Kecil', 'PRD-151125-6CRWJY', 0, 1000.00, 10000.00, 0, '2025-11-15 06:33:09', '2025-11-15 06:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_lots`
--

CREATE TABLE `purchase_lots` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity_received` int NOT NULL,
  `quantity_remaining` int NOT NULL,
  `cost_price_per_unit` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contoh: Tunai, Transfer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `total_amount`, `payment_method`, `created_at`, `updated_at`) VALUES
(6, 1, 10000.00, 'transfer', '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(7, 1, 40000.00, 'transfer', '2025-11-15 06:33:59', '2025-11-15 06:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price_per_unit` decimal(15,2) NOT NULL COMMENT 'Harga jual saat transaksi (bisa harga tawar)',
  `cost_price_per_unit` decimal(15,2) NOT NULL COMMENT 'Harga modal saat transaksi (dari purchase_lots)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `price_per_unit`, `cost_price_per_unit`, `created_at`, `updated_at`) VALUES
(2, 6, 28, 1, 10000.00, 25000.00, '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(3, 7, 49, 2, 5000.00, 296000.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(4, 7, 50, 2, 2500.00, 32000.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(5, 7, 54, 1, 15000.00, 1000.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(6, 7, 17, 1, 10000.00, 240.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `service_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contoh: SVC-001',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Laptop, PC, Printer, dll',
  `device_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Asus, Lenovo, HP, dll',
  `complaint` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Keluhan pelanggan',
  `items_included` text COLLATE utf8mb4_unicode_ci COMMENT 'Kelengkapan barang yang disertakan',
  `diagnosis` text COLLATE utf8mb4_unicode_ci COMMENT 'Hasil pengecekan teknisi',
  `action_taken` text COLLATE utf8mb4_unicode_ci COMMENT 'Tindakan yang dilakukan',
  `status` enum('pending','progress','done','picked-up') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `cost` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Biaya servis',
  `technician` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nama teknisi yang ditugaskan',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `picked_up_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_code`, `customer_name`, `customer_phone`, `device_type`, `device_brand`, `complaint`, `items_included`, `diagnosis`, `action_taken`, `status`, `cost`, `technician`, `created_by`, `completed_at`, `picked_up_at`, `created_at`, `updated_at`) VALUES
(3, 'SVC-151125-3Q5L4T', 'User', '-', 'PC', 'PC Rakitan', 'Ram kebaca 8gb dari 16gb', NULL, NULL, NULL, 'picked-up', 25000.00, NULL, 1, NULL, '2025-11-15 06:35:33', '2025-11-15 06:35:12', '2025-11-15 06:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('34oqwfEcG6OZGukrwBd3X8BdpJWwCW6AyKx3nhNv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGlTM2FBZWo2Rk5oemNCS2V5c3pEbjdCMEZTQmlienA3dlhjOVRLeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1763214500);

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL COMMENT 'Positif untuk masuk, Negatif untuk keluar',
  `reason` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contoh: sale, stock_in, adjustment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_id`, `quantity`, `reason`, `created_at`, `updated_at`) VALUES
(1, 28, -1, 'sale', '2025-11-14 21:38:36', '2025-11-14 21:38:36'),
(2, 28, -1, 'sale', '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(3, 49, -2, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(4, 50, -2, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(5, 54, -1, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(6, 17, -1, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `sync_operations`
--

CREATE TABLE `sync_operations` (
  `id` bigint UNSIGNED NOT NULL,
  `client_operation_uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'UUID unik dari PWA client',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, success, failed',
  `payload` json DEFAULT NULL COMMENT 'Data JSON dari PWA',
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mustika.com', '$2y$12$UnXubvAvHTbnJA.bkyNnJew4C0pD9ERtrJEbuNTB3mSRSlEP89POq', NULL, '2025-11-14 01:19:14', '2025-11-14 09:04:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_type_created_at_index` (`type`,`created_at`),
  ADD KEY `audit_logs_user_id_index` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_records`
--
ALTER TABLE `notification_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_records_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `purchase_lots`
--
ALTER TABLE `purchase_lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_lots_product_id_foreign` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_service_code_unique` (`service_code`),
  ADD KEY `services_created_by_foreign` (`created_by`),
  ADD KEY `services_status_index` (`status`),
  ADD KEY `services_service_code_index` (`service_code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_product_id_foreign` (`product_id`);

--
-- Indexes for table `sync_operations`
--
ALTER TABLE `sync_operations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sync_operations_client_operation_uuid_unique` (`client_operation_uuid`),
  ADD KEY `sync_operations_status_index` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_records`
--
ALTER TABLE `notification_records`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `purchase_lots`
--
ALTER TABLE `purchase_lots`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sync_operations`
--
ALTER TABLE `sync_operations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notification_records`
--
ALTER TABLE `notification_records`
  ADD CONSTRAINT `notification_records_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_lots`
--
ALTER TABLE `purchase_lots`
  ADD CONSTRAINT `purchase_lots_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
