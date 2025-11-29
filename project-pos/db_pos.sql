-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Nov 2025 pada 16.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `actor` varchar(255) DEFAULT NULL COMMENT 'Nama user yang melakukan aksi',
  `type` varchar(50) NOT NULL COMMENT 'sales, product, stock, security, danger, etc',
  `action` varchar(255) NOT NULL COMMENT 'CREATE, UPDATE, DELETE, LOGIN, LOGOUT, etc',
  `message` text NOT NULL COMMENT 'Detail aktivitas yang dilakukan',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Data tambahan dalam format JSON' CHECK (json_valid(`metadata`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `audit_logs`
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
(78, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-151125-3Q5L4T</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-15 06:35:33', '2025-11-15 06:35:33'),
(79, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-16 22:32:32', '2025-11-16 22:32:32'),
(80, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/008)</strong> senilai Rp 25.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-16 22:33:18', '2025-11-16 22:33:18'),
(81, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/009)</strong> senilai Rp 350.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-16 22:33:27', '2025-11-16 22:33:27'),
(82, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Baterai CMOS 2032 (PRD-151125-1USQCM)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 00:15:42', '2025-11-17 00:15:42'),
(83, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Kabel LAN (PRD-151125-NOICO1)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 00:16:30', '2025-11-17 00:16:30'),
(84, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Kuas Kecil (PRD-151125-6CRWJY)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 00:17:09', '2025-11-17 00:17:09'),
(85, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-4170 @3.70Ghz (PRD-151125-MELAXR)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 02:58:52', '2025-11-17 02:58:52'),
(86, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-6100 @3.70Ghz (PRD-151125-KLII6E)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 02:59:16', '2025-11-17 02:59:16'),
(87, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-4150 @3.50Ghz (PRD-151125-SLX4AR)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 02:59:35', '2025-11-17 02:59:35'),
(88, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-2120 @3.30Ghz (PRD-151125-1G4KMA)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 02:59:55', '2025-11-17 02:59:55'),
(89, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i3-3240 @3.40Ghz (PRD-151125-TNKAIL)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:00:06', '2025-11-17 03:00:06'),
(90, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Core i5-2320 @3.00Ghz (PRD-151125-SQDHTD)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:00:41', '2025-11-17 03:00:41'),
(91, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Kabel Power PC Second (PRD-171125-PXTXVG)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:05:26', '2025-11-17 03:05:26'),
(92, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Adaptor Monitor (PRD-171125-7TN9P1)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:06:56', '2025-11-17 03:06:56'),
(93, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Tas Laptop \"14 Inch (PRD-171125-ZPF0SB)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:08:06', '2025-11-17 03:08:06'),
(94, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Keyboard Logitech Second (PRD-171125-RTKVB0)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:17:51', '2025-11-17 03:17:51'),
(95, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Fan Cooler \"14 inch (PRD-171125-HMHAEG)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:18:33', '2025-11-17 03:18:33'),
(96, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>SSD 128GB (PRD-171125-NSBTH2)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:20:14', '2025-11-17 03:20:14'),
(97, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>SSD 256GB (PRD-171125-5G3VV2)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:20:33', '2025-11-17 03:20:33'),
(98, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>SSD 512GB (PRD-171125-MUU5PZ)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:20:46', '2025-11-17 03:20:46'),
(99, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>HDD 500GB (PRD-171125-JHMKTW)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:21:15', '2025-11-17 03:21:15'),
(100, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>HDD 1TB (PRD-171125-LAFZTD)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:21:34', '2025-11-17 03:21:34'),
(101, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>HDD \"2.5 inch 320GB (PRD-171125-ZJA8NO)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:22:54', '2025-11-17 03:22:54'),
(102, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>HDD \"2.5 inch 500GB (PRD-171125-PQSLTM)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:23:11', '2025-11-17 03:23:11'),
(103, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>HDD \"2.5 inch 320GB (PRD-171125-ZJA8NO)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:23:27', '2025-11-17 03:23:27'),
(104, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/010)</strong> senilai Rp 75.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 03:57:09', '2025-11-17 03:57:09'),
(105, 1, 'Admin', 'security', 'LOGOUT', 'keluar dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 04:33:12', '2025-11-17 04:33:12'),
(106, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 04:33:16', '2025-11-17 04:33:16'),
(107, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-171125-KT5WUX</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 06:29:46', '2025-11-17 06:29:46'),
(108, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-171125-KT5WUX</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 06:29:56', '2025-11-17 06:29:56'),
(109, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 21:07:40', '2025-11-17 21:07:40'),
(110, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 23:17:02', '2025-11-17 23:17:02'),
(111, 1, 'Admin', 'stock', 'RESTOCK', 'menambahkan stok untuk <strong>Kabel LAN (305 unit)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', NULL, '2025-11-17 23:22:53', '2025-11-17 23:22:53'),
(112, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 00:58:31', '2025-11-18 00:58:31'),
(113, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 04:34:32', '2025-11-18 04:34:32'),
(114, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-181125-HD903K</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 06:29:42', '2025-11-18 06:29:42'),
(115, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-181125-HD903K</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 06:29:55', '2025-11-18 06:29:55'),
(116, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 20:11:07', '2025-11-18 20:11:07'),
(117, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 20:11:07', '2025-11-18 20:11:07'),
(118, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-18 20:30:15', '2025-11-18 20:30:15'),
(119, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-20 02:12:10', '2025-11-20 02:12:10'),
(120, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-201125-JVX7WL</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-20 02:13:00', '2025-11-20 02:13:00'),
(121, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-201125-JVX7WL</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-20 02:13:17', '2025-11-20 02:13:17'),
(122, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-20 02:59:10', '2025-11-20 02:59:10'),
(123, 1, 'Admin', 'stock', 'RESTOCK', 'menambahkan stok untuk <strong>RJ45 CAT5 (100 unit)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-20 03:00:05', '2025-11-20 03:00:05'),
(124, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-21 05:14:15', '2025-11-21 05:14:15'),
(125, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-21 08:28:15', '2025-11-21 08:28:15'),
(126, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-211125-ZR24P7</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-21 08:29:09', '2025-11-21 08:29:09'),
(127, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-211125-ZR24P7</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-21 08:29:20', '2025-11-21 08:29:20'),
(128, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-23 19:46:09', '2025-11-23 19:46:09'),
(129, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-23 23:01:52', '2025-11-23 23:01:52'),
(130, NULL, 'System', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-241125-X0B8WJ</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-24 03:27:22', '2025-11-24 03:27:22'),
(131, NULL, 'System', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-241125-X0B8WJ</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-24 03:27:43', '2025-11-24 03:27:43'),
(132, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-24 07:53:36', '2025-11-24 07:53:36'),
(133, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-241125-PGO2EY</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-24 07:54:23', '2025-11-24 07:54:23'),
(134, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-241125-PGO2EY</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-24 07:54:38', '2025-11-24 07:54:38'),
(135, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 03:41:04', '2025-11-25 03:41:04'),
(136, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/011)</strong> senilai Rp 20.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 03:41:55', '2025-11-25 03:41:55'),
(137, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 06:09:32', '2025-11-25 06:09:32'),
(138, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 10:04:06', '2025-11-25 10:04:06'),
(139, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>USB Bluetooth v.5.0 (PRD-151125-H0KF2T)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 10:13:24', '2025-11-25 10:13:24'),
(140, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 20:33:04', '2025-11-25 20:33:04'),
(141, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-25 20:42:28', '2025-11-25 20:42:28'),
(142, NULL, 'System', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-261125-NF0S45</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:06:28', '2025-11-26 04:06:28'),
(143, NULL, 'System', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-NF0S45</strong> - Status: <strong>Dalam Pengerjaan</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:06:41', '2025-11-26 04:06:41'),
(144, NULL, 'System', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-261125-V2FLY3</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:08:10', '2025-11-26 04:08:10'),
(145, NULL, 'System', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-V2FLY3</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:08:23', '2025-11-26 04:08:23'),
(146, NULL, 'System', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-261125-51U2SJ</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:09:19', '2025-11-26 04:09:19'),
(147, NULL, 'System', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-51U2SJ</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:09:49', '2025-11-26 04:09:49'),
(148, NULL, 'System', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-261125-5ENXLB</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:12:01', '2025-11-26 04:12:01'),
(149, NULL, 'System', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-5ENXLB</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 04:12:12', '2025-11-26 04:12:12'),
(150, NULL, 'System', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-NF0S45</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 07:01:59', '2025-11-26 07:01:59'),
(151, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 07:02:33', '2025-11-26 07:02:33'),
(152, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-5ENXLB</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-26 07:54:56', '2025-11-26 07:54:56'),
(153, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:10:00', '2025-11-27 00:10:00'),
(154, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-V2FLY3</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:11:43', '2025-11-27 00:11:43'),
(155, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-51U2SJ</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:12:12', '2025-11-27 00:12:12'),
(156, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-271125-XSBRTK</strong> untuk pelanggan <strong>Bunda Grosir</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:13:43', '2025-11-27 00:13:43'),
(157, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-XSBRTK</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:13:53', '2025-11-27 00:13:53'),
(158, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-271125-IXENHV</strong> untuk pelanggan <strong>Bunda Grosir</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:14:35', '2025-11-27 00:14:35'),
(159, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-IXENHV</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:14:54', '2025-11-27 00:14:54'),
(160, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-XSBRTK</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:15:15', '2025-11-27 00:15:15'),
(161, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-IXENHV</strong> - Status: <strong>Selesai (Siap Ambil)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:15:24', '2025-11-27 00:15:24'),
(162, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-IXENHV</strong> - Status: <strong>Dalam Pengerjaan</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:16:55', '2025-11-27 00:16:55'),
(163, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-XSBRTK</strong> - Status: <strong>Dalam Pengerjaan</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:17:15', '2025-11-27 00:17:15'),
(164, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Adaptor ASUS X441 (PRD-271125-T8QKSO)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 00:18:11', '2025-11-27 00:18:11'),
(165, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 06:10:17', '2025-11-27 06:10:17'),
(166, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/012)</strong> senilai Rp 100.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 06:10:48', '2025-11-27 06:10:48'),
(167, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 10:41:53', '2025-11-27 10:41:53');
INSERT INTO `audit_logs` (`id`, `user_id`, `actor`, `type`, `action`, `message`, `ip_address`, `user_agent`, `metadata`, `created_at`, `updated_at`) VALUES
(168, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-XSBRTK</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 10:42:40', '2025-11-27 10:42:40'),
(169, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-271125-IXENHV</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 10:42:48', '2025-11-27 10:42:48'),
(170, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-51U2SJ</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 10:43:03', '2025-11-27 10:43:03'),
(171, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-51U2SJ</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 10:43:03', '2025-11-27 10:43:03'),
(172, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-27 23:06:17', '2025-11-27 23:06:17'),
(173, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-28 10:32:03', '2025-11-28 10:32:03'),
(174, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/013)</strong> senilai Rp 70.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-28 10:32:28', '2025-11-28 10:32:28'),
(175, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-28 12:03:33', '2025-11-28 12:03:33'),
(176, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 01:39:23', '2025-11-29 01:39:23'),
(177, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 02:55:20', '2025-11-29 02:55:20'),
(178, 1, 'Admin', 'product', 'CREATE', 'menambahkan produk baru <strong>Adaptor Lenovo (PRD-291125-SXFOEV)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 02:59:16', '2025-11-29 02:59:16'),
(179, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>Adaptor Lenovo Ideapad 320/330 (PRD-291125-SXFOEV)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 03:00:11', '2025-11-29 03:00:11'),
(180, 1, 'Admin', 'stock', 'RESTOCK', 'menambahkan stok untuk <strong>Adaptor ASUS X441 (1 unit)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 03:01:09', '2025-11-29 03:01:09'),
(181, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 03:02:52', '2025-11-29 03:02:52'),
(182, 1, 'Admin', 'product', 'UPDATE', 'mengedit produk <strong>HDD CASE 2.5 inch (PRD-151125-HBUC4A)</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 03:03:21', '2025-11-29 03:03:21'),
(183, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 04:57:32', '2025-11-29 04:57:32'),
(184, 1, 'Admin', 'product', 'CREATE', 'menambahkan servis baru <strong>SVC-291125-L5IZGE</strong> untuk pelanggan <strong>User</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 05:54:59', '2025-11-29 05:54:59'),
(185, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-291125-L5IZGE</strong> - Status: <strong>Dalam Pengerjaan</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 05:55:16', '2025-11-29 05:55:16'),
(186, 1, 'Admin', 'security', 'LOGIN', 'berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 06:44:09', '2025-11-29 06:44:09'),
(187, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/014)</strong> senilai Rp 50.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 06:57:30', '2025-11-29 06:57:30'),
(188, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-291125-L5IZGE</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 06:57:50', '2025-11-29 06:57:50'),
(189, 1, 'Admin', 'product', 'UPDATE', 'mengupdate servis <strong>SVC-261125-V2FLY3</strong> - Status: <strong>Sudah Diambil</strong>', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 07:29:35', '2025-11-29 07:29:35'),
(190, 1, 'Admin', 'sales', 'CREATE', 'memproses penjualan baru <strong>(INV/2025/11/015)</strong> senilai Rp 10.000', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', NULL, '2025-11-29 07:30:32', '2025-11-29 07:30:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification_records`
--

CREATE TABLE `notification_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'Contoh: low_stock',
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `cost_price` decimal(15,2) NOT NULL DEFAULT 0.00 COMMENT 'Harga Beli / Modal',
  `sale_price` decimal(15,2) NOT NULL DEFAULT 0.00 COMMENT 'Harga Jual',
  `min_stock_level` int(11) NOT NULL DEFAULT 0 COMMENT 'Batas minimum stok untuk notifikasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `current_stock`, `cost_price`, `sale_price`, `min_stock_level`, `created_at`, `updated_at`) VALUES
(13, 'Caddy 9.5mm', 'PRD-151125-AFZDOJ', 2, 10000.00, 50000.00, 0, '2025-11-14 19:08:35', '2025-11-14 19:08:35'),
(14, 'Caddy 12.7 mm', 'PRD-151125-SU3JKK', 2, 10000.00, 50000.00, 0, '2025-11-14 19:08:58', '2025-11-14 19:08:58'),
(15, 'Keyboard Eyota', 'PRD-151125-ZGNCUR', 2, 31000.00, 60000.00, 0, '2025-11-14 19:09:33', '2025-11-14 19:09:33'),
(16, 'Conveter HDMI to VGA', 'PRD-151125-V0JR9H', 6, 20000.00, 50000.00, 0, '2025-11-14 19:09:57', '2025-11-14 21:37:18'),
(17, 'Baterai CMOS 2032', 'PRD-151125-1USQCM', 34, 240.00, 10000.00, 0, '2025-11-14 19:12:29', '2025-11-29 07:30:32'),
(18, 'Converter DVI to VGA', 'PRD-151125-RYGUCT', 5, 11000.00, 30000.00, 0, '2025-11-14 19:13:59', '2025-11-14 19:13:59'),
(19, 'USB Wifi Wolfcase', 'PRD-151125-DFNXWG', 4, 15000.00, 50000.00, 0, '2025-11-14 19:14:53', '2025-11-14 19:16:10'),
(20, 'Fan Processor', 'PRD-151125-PMXOJP', 2, 20000.00, 50000.00, 0, '2025-11-14 19:15:31', '2025-11-14 19:15:31'),
(21, 'USB Bluetooth v.5.0', 'PRD-151125-H0KF2T', 3, 10000.00, 30000.00, 0, '2025-11-14 19:15:58', '2025-11-25 10:13:24'),
(22, 'USB Printer', 'PRD-151125-1YYKAP', 6, 7000.00, 20000.00, 0, '2025-11-14 19:18:13', '2025-11-28 10:32:28'),
(23, 'Kabel VGA', 'PRD-151125-OAEHBJ', 10, 6500.00, 25000.00, 0, '2025-11-14 19:20:06', '2025-11-14 19:20:06'),
(25, 'Mouse Avan', 'PRD-151125-ECC9FM', 5, 10000.00, 25000.00, 0, '2025-11-14 19:23:26', '2025-11-16 22:33:18'),
(26, 'Mouse Wireless V3000', 'PRD-151125-9YXU8T', 0, 30000.00, 60000.00, 0, '2025-11-14 19:26:09', '2025-11-14 19:26:09'),
(27, 'Thermal Paste Botol', 'PRD-151125-VEXQSS', 3, 3500.00, 20000.00, 0, '2025-11-14 19:28:16', '2025-11-14 19:28:16'),
(28, 'Thermal Paste Suntik', 'PRD-151125-3QSKAP', 4, 25000.00, 10000.00, 0, '2025-11-14 19:28:48', '2025-11-14 21:39:39'),
(29, 'Motherboard H61 Bulldozer', 'PRD-151125-UMLZ6P', 1, 206000.00, 350000.00, 0, '2025-11-14 19:33:40', '2025-11-16 22:33:27'),
(30, 'Motherboard H81 Bulldozer', 'PRD-151125-VX3GRA', 1, 230000.00, 450000.00, 0, '2025-11-14 19:34:02', '2025-11-14 19:34:02'),
(31, 'RAM VGEN DDR3 4GB 12800', 'PRD-151125-DGU5TW', 3, 50000.00, 100000.00, 0, '2025-11-14 19:36:24', '2025-11-14 19:36:24'),
(33, 'RAM Team Group DDR4 4GB 2400', 'PRD-151125-CZUWNC', 1, 0.00, 200000.00, 0, '2025-11-14 19:39:34', '2025-11-14 19:39:34'),
(34, 'RAM Visipro DDR4 4GB 19200', 'PRD-151125-7WIWFA', 8, 0.00, 125000.00, 0, '2025-11-14 19:41:11', '2025-11-14 19:41:11'),
(35, 'RAM SODIMM VGEN DDR3 4GB 10600S', 'PRD-151125-4ZXO1L', 5, 0.00, 125000.00, 0, '2025-11-14 19:46:50', '2025-11-14 19:50:56'),
(36, 'RAM SODIMM VGEN DDR3 4GB 10600', 'PRD-151125-H8OSNO', 1, 0.00, 125000.00, 0, '2025-11-14 19:47:38', '2025-11-14 19:51:16'),
(37, 'RAM SODIMM Kingston DDR3 2GB 10600S', 'PRD-151125-TCY53X', 2, 0.00, 75000.00, 0, '2025-11-14 19:49:26', '2025-11-14 19:49:26'),
(38, 'RAM SODIMM SKhynix DDR3 2GB 10600S', 'PRD-151125-OHQIHU', 1, 0.00, 75000.00, 0, '2025-11-14 19:50:26', '2025-11-14 19:50:26'),
(39, 'RAM DDR4 8GB 3200AA', 'PRD-151125-MAQVRY', 1, 0.00, 200000.00, 0, '2025-11-14 19:53:33', '2025-11-14 19:53:33'),
(41, 'Core i3-2120 @3.30Ghz', 'PRD-151125-1G4KMA', 4, 0.00, 150000.00, 0, '2025-11-14 19:58:45', '2025-11-17 02:59:55'),
(42, 'Core i5-2320 @3.00Ghz', 'PRD-151125-SQDHTD', 1, 150000.00, 250000.00, 0, '2025-11-14 20:01:32', '2025-11-17 03:00:41'),
(44, 'Core i3-4170 @3.70Ghz', 'PRD-151125-MELAXR', 1, 0.00, 150000.00, 0, '2025-11-14 20:02:46', '2025-11-17 02:58:52'),
(45, 'Core i3-3240 @3.40Ghz', 'PRD-151125-TNKAIL', 1, 0.00, 150000.00, 0, '2025-11-14 20:05:38', '2025-11-17 03:00:05'),
(47, 'Core i3-4150 @3.50Ghz', 'PRD-151125-SLX4AR', 2, 0.00, 150000.00, 0, '2025-11-14 20:08:16', '2025-11-17 02:59:35'),
(48, 'Core i3-6100 @3.70Ghz', 'PRD-151125-KLII6E', 1, 0.00, 200000.00, 0, '2025-11-14 20:08:51', '2025-11-17 02:59:16'),
(49, 'Kabel LAN', 'PRD-151125-NOICO1', 315, 296000.00, 5000.00, 0, '2025-11-14 20:15:56', '2025-11-17 23:22:53'),
(50, 'RJ45 CAT5', 'PRD-151125-P7JQRI', 136, 32000.00, 2500.00, 0, '2025-11-14 20:19:31', '2025-11-20 03:00:05'),
(51, 'Kabel Power Laptop', 'PRD-151125-JNOYFS', 4, 150000.00, 30000.00, 0, '2025-11-15 01:29:24', '2025-11-15 01:29:24'),
(52, 'HDD CASE 2.5 inch', 'PRD-151125-HBUC4A', 1, 24500.00, 50000.00, 0, '2025-11-15 01:52:02', '2025-11-29 03:03:20'),
(53, 'Power Supply', 'PRD-151125-BNX2NQ', 10, 30000.00, 60000.00, 0, '2025-11-15 01:57:42', '2025-11-15 01:57:42'),
(54, 'Kuas Besar', 'PRD-151125-M8MVPI', 1, 1000.00, 15000.00, 0, '2025-11-15 06:32:47', '2025-11-15 06:34:00'),
(55, 'Kuas Kecil', 'PRD-151125-6CRWJY', 2, 1000.00, 10000.00, 0, '2025-11-15 06:33:09', '2025-11-17 00:17:09'),
(56, 'Kabel Power PC Second', 'PRD-171125-PXTXVG', 5, 0.00, 25000.00, 0, '2025-11-17 03:05:26', '2025-11-17 03:05:26'),
(57, 'Adaptor Monitor', 'PRD-171125-7TN9P1', 3, 35000.00, 90000.00, 0, '2025-11-17 03:06:56', '2025-11-17 03:06:56'),
(58, 'Tas Laptop \"14 Inch', 'PRD-171125-ZPF0SB', 2, 10000.00, 35000.00, 0, '2025-11-17 03:08:06', '2025-11-17 03:08:06'),
(59, 'Keyboard Logitech Second', 'PRD-171125-RTKVB0', 4, 0.00, 125000.00, 0, '2025-11-17 03:17:51', '2025-11-17 03:17:51'),
(60, 'Fan Cooler \"14 inch', 'PRD-171125-HMHAEG', 2, 0.00, 50000.00, 0, '2025-11-17 03:18:33', '2025-11-29 06:57:30'),
(61, 'SSD 128GB', 'PRD-171125-NSBTH2', 0, 0.00, 250000.00, 0, '2025-11-17 03:20:13', '2025-11-17 03:20:13'),
(62, 'SSD 256GB', 'PRD-171125-5G3VV2', 0, 0.00, 350000.00, 0, '2025-11-17 03:20:33', '2025-11-17 03:20:33'),
(63, 'SSD 512GB', 'PRD-171125-MUU5PZ', 0, 0.00, 450000.00, 0, '2025-11-17 03:20:46', '2025-11-17 03:20:46'),
(64, 'HDD 500GB', 'PRD-171125-JHMKTW', 0, 0.00, 150000.00, 0, '2025-11-17 03:21:15', '2025-11-17 03:21:15'),
(65, 'HDD 1TB', 'PRD-171125-LAFZTD', 0, 0.00, 250000.00, 0, '2025-11-17 03:21:34', '2025-11-17 03:21:34'),
(66, 'HDD \"2.5 inch 320GB', 'PRD-171125-ZJA8NO', 1, 0.00, 175000.00, 0, '2025-11-17 03:22:54', '2025-11-17 03:23:27'),
(67, 'HDD \"2.5 inch 500GB', 'PRD-171125-PQSLTM', 0, 0.00, 275000.00, 0, '2025-11-17 03:23:11', '2025-11-17 03:23:11'),
(68, 'Adaptor ASUS X441', 'PRD-271125-T8QKSO', 1, 55000.00, 100000.00, 0, '2025-11-27 00:18:11', '2025-11-29 03:01:09'),
(69, 'Adaptor Lenovo Ideapad 320/330', 'PRD-291125-SXFOEV', 1, 0.00, 100000.00, 0, '2025-11-29 02:59:16', '2025-11-29 03:00:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_lots`
--

CREATE TABLE `purchase_lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_received` int(11) NOT NULL,
  `quantity_remaining` int(11) NOT NULL,
  `cost_price_per_unit` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchase_lots`
--

INSERT INTO `purchase_lots` (`id`, `product_id`, `quantity_received`, `quantity_remaining`, `cost_price_per_unit`, `created_at`, `updated_at`) VALUES
(1, 49, 305, 305, 278000.00, '2025-11-17 23:22:52', '2025-11-17 23:22:52'),
(2, 50, 100, 100, 0.00, '2025-11-20 03:00:05', '2025-11-20 03:00:05'),
(3, 68, 1, 1, 55000.00, '2025-11-29 03:01:09', '2025-11-29 03:01:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL COMMENT 'Contoh: Tunai, Transfer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `total_amount`, `payment_method`, `created_at`, `updated_at`) VALUES
(6, 1, 10000.00, 'transfer', '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(7, 1, 40000.00, 'transfer', '2025-11-15 06:33:59', '2025-11-15 06:33:59'),
(8, 1, 25000.00, 'cash', '2025-11-16 22:33:18', '2025-11-16 22:33:18'),
(9, 1, 350000.00, 'transfer', '2025-11-16 22:33:27', '2025-11-16 22:33:27'),
(10, 1, 75000.00, 'cash', '2025-11-17 03:57:09', '2025-11-17 03:57:09'),
(11, 1, 20000.00, 'cash', '2025-11-25 03:41:55', '2025-11-25 03:41:55'),
(12, 1, 100000.00, 'cash', '2025-11-27 06:10:48', '2025-11-27 06:10:48'),
(13, 1, 70000.00, 'cash', '2025-11-28 10:32:28', '2025-11-28 10:32:28'),
(14, 1, 50000.00, 'cash', '2025-11-29 06:57:30', '2025-11-29 06:57:30'),
(15, 1, 10000.00, 'cash', '2025-11-29 07:30:31', '2025-11-29 07:30:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(15,2) NOT NULL COMMENT 'Harga jual saat transaksi (bisa harga tawar)',
  `cost_price_per_unit` decimal(15,2) NOT NULL COMMENT 'Harga modal saat transaksi (dari purchase_lots)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `price_per_unit`, `cost_price_per_unit`, `created_at`, `updated_at`) VALUES
(2, 6, 28, 1, 10000.00, 25000.00, '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(3, 7, 49, 2, 5000.00, 296000.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(4, 7, 50, 2, 2500.00, 32000.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(5, 7, 54, 1, 15000.00, 1000.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(6, 7, 17, 1, 10000.00, 240.00, '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(7, 8, 25, 1, 25000.00, 10000.00, '2025-11-16 22:33:18', '2025-11-16 22:33:18'),
(8, 9, 29, 1, 350000.00, 206000.00, '2025-11-16 22:33:27', '2025-11-16 22:33:27'),
(9, 10, 49, 25, 3000.00, 296000.00, '2025-11-17 03:57:09', '2025-11-17 03:57:09'),
(10, 11, 22, 1, 20000.00, 7000.00, '2025-11-25 03:41:55', '2025-11-25 03:41:55'),
(11, 12, 68, 1, 100000.00, 55000.00, '2025-11-27 06:10:48', '2025-11-27 06:10:48'),
(12, 13, 22, 1, 20000.00, 7000.00, '2025-11-28 10:32:28', '2025-11-28 10:32:28'),
(13, 13, 52, 1, 50000.00, 24500.00, '2025-11-28 10:32:28', '2025-11-28 10:32:28'),
(14, 14, 60, 1, 50000.00, 0.00, '2025-11-29 06:57:30', '2025-11-29 06:57:30'),
(15, 15, 17, 1, 10000.00, 240.00, '2025-11-29 07:30:32', '2025-11-29 07:30:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_code` varchar(255) NOT NULL COMMENT 'Contoh: SVC-001',
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) NOT NULL COMMENT 'Laptop, PC, Printer, dll',
  `device_brand` varchar(255) DEFAULT NULL COMMENT 'Asus, Lenovo, HP, dll',
  `complaint` text NOT NULL COMMENT 'Keluhan pelanggan',
  `items_included` text DEFAULT NULL COMMENT 'Kelengkapan barang yang disertakan',
  `diagnosis` text DEFAULT NULL COMMENT 'Hasil pengecekan teknisi',
  `action_taken` text DEFAULT NULL COMMENT 'Tindakan yang dilakukan',
  `status` enum('pending','progress','done','picked-up') NOT NULL DEFAULT 'pending',
  `cost` decimal(15,2) NOT NULL DEFAULT 0.00 COMMENT 'Biaya servis',
  `technician` varchar(255) DEFAULT NULL COMMENT 'Nama teknisi yang ditugaskan',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `picked_up_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `service_code`, `customer_name`, `customer_phone`, `device_type`, `device_brand`, `complaint`, `items_included`, `diagnosis`, `action_taken`, `status`, `cost`, `technician`, `created_by`, `completed_at`, `picked_up_at`, `created_at`, `updated_at`) VALUES
(3, 'SVC-151125-3Q5L4T', 'User', '-', 'PC', 'PC Rakitan', 'Ram kebaca 8gb dari 16gb', NULL, NULL, NULL, 'picked-up', 25000.00, NULL, 1, NULL, '2025-11-15 06:35:33', '2025-11-15 06:35:12', '2025-11-15 06:35:33'),
(4, 'SVC-171125-KT5WUX', 'User', '-', 'Laptop', 'Lenovo', 'Aktivasi Windows', NULL, NULL, NULL, 'picked-up', 50000.00, NULL, 1, NULL, '2025-11-17 06:29:56', '2025-11-17 06:29:46', '2025-11-17 06:29:56'),
(5, 'SVC-181125-HD903K', 'User', '-', 'Laptop', 'ASUS X441N', 'Windows blacksreen', NULL, NULL, NULL, 'picked-up', 100000.00, NULL, 1, NULL, '2025-11-18 06:29:55', '2025-11-18 06:29:42', '2025-11-18 06:29:55'),
(6, 'SVC-201125-JVX7WL', 'User', '-', 'PC', 'Rakitan', 'Windows Rusak', NULL, NULL, NULL, 'picked-up', 100000.00, NULL, 1, NULL, '2025-11-20 02:13:16', '2025-11-20 02:13:00', '2025-11-20 02:13:16'),
(7, 'SVC-211125-ZR24P7', 'User', '-', 'PC', 'Rakitan', 'Install, Cleaning, Repasta', NULL, NULL, NULL, 'picked-up', 150000.00, NULL, 1, NULL, '2025-11-21 08:29:19', '2025-11-21 08:29:09', '2025-11-21 08:29:19'),
(8, 'SVC-241125-X0B8WJ', 'User', '-', 'Laptop', 'Rakitan', 'Cek PC bluescreen', NULL, NULL, NULL, 'picked-up', 25000.00, NULL, NULL, NULL, '2025-11-24 03:27:43', '2025-11-24 03:27:22', '2025-11-24 03:27:43'),
(9, 'SVC-241125-PGO2EY', 'User', '-', 'Laptop', 'Rakitan', 'Install Windows', NULL, NULL, NULL, 'picked-up', 125000.00, NULL, 1, NULL, '2025-11-24 07:54:37', '2025-11-24 07:54:23', '2025-11-24 07:54:37'),
(10, 'SVC-261125-NF0S45', 'User', '-', 'Laptop', 'ASUS X441B', 'Install windows. Adaptor', NULL, NULL, NULL, 'picked-up', 200000.00, NULL, NULL, NULL, '2025-11-26 07:01:59', '2025-11-26 04:06:28', '2025-11-26 07:01:59'),
(11, 'SVC-261125-V2FLY3', 'User', '-', 'Laptop', 'Acer Aspire 4147', 'HDD Rusak', NULL, NULL, NULL, 'picked-up', 225000.00, NULL, NULL, '2025-11-26 04:08:23', '2025-11-29 07:29:34', '2025-11-26 04:08:10', '2025-11-29 07:29:34'),
(12, 'SVC-261125-51U2SJ', 'User', '-', 'Laptop', 'Lenovo Slim 1 14IGL7', 'SSD Rusak', NULL, NULL, NULL, 'picked-up', 325000.00, NULL, NULL, '2025-11-26 04:09:49', '2025-11-27 10:43:02', '2025-11-26 04:09:18', '2025-11-27 10:43:02'),
(13, 'SVC-261125-5ENXLB', 'User', '-', 'PC', 'Rakitan', 'Cek HDD/SSD, Windows Rusak', NULL, NULL, NULL, 'picked-up', 100000.00, NULL, NULL, '2025-11-26 04:12:12', '2025-11-26 07:54:56', '2025-11-26 04:12:01', '2025-11-26 07:54:56'),
(14, 'SVC-271125-XSBRTK', 'Bunda Grosir', '-', 'PC', 'Rakitan', 'Port Usb, Port Lan, Aktivasi', NULL, NULL, NULL, 'picked-up', 100000.00, NULL, 1, '2025-11-27 00:13:53', '2025-11-27 10:42:40', '2025-11-27 00:13:43', '2025-11-27 10:42:40'),
(15, 'SVC-271125-IXENHV', 'Bunda Grosir', '-', 'Laptop', 'Rakitan', 'Aktivasi, Cleaning', NULL, NULL, NULL, 'picked-up', 75000.00, NULL, 1, '2025-11-27 00:14:54', '2025-11-27 10:42:48', '2025-11-27 00:14:35', '2025-11-27 10:42:48'),
(16, 'SVC-291125-L5IZGE', 'User', '-', 'Laptop', 'Acer', 'Windows Rusak', NULL, NULL, NULL, 'picked-up', 100000.00, NULL, 1, NULL, '2025-11-29 06:57:50', '2025-11-29 05:54:59', '2025-11-29 06:57:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9Cl4yYpHrPkTjv8butYywmOtb5ltGBmCn7jx6fIW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTmJ1NW1jYmNWcE1PbTZ0UHNZcjljT3kyV0w2ZVZxUnJBREdUOFhmUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9tdXN0aWthLmxvY2FsL3NlcnZpY2VzLzExIjtzOjU6InJvdXRlIjtzOjEzOiJzZXJ2aWNlcy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764429999);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'Positif untuk masuk, Negatif untuk keluar',
  `reason` varchar(50) NOT NULL COMMENT 'Contoh: sale, stock_in, adjustment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_id`, `quantity`, `reason`, `created_at`, `updated_at`) VALUES
(1, 28, -1, 'sale', '2025-11-14 21:38:36', '2025-11-14 21:38:36'),
(2, 28, -1, 'sale', '2025-11-14 21:39:39', '2025-11-14 21:39:39'),
(3, 49, -2, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(4, 50, -2, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(5, 54, -1, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(6, 17, -1, 'sale', '2025-11-15 06:34:00', '2025-11-15 06:34:00'),
(7, 25, -1, 'sale', '2025-11-16 22:33:18', '2025-11-16 22:33:18'),
(8, 29, -1, 'sale', '2025-11-16 22:33:27', '2025-11-16 22:33:27'),
(9, 49, -25, 'sale', '2025-11-17 03:57:09', '2025-11-17 03:57:09'),
(10, 49, 305, 'stock_in', '2025-11-17 23:22:53', '2025-11-17 23:22:53'),
(11, 50, 100, 'stock_in', '2025-11-20 03:00:05', '2025-11-20 03:00:05'),
(12, 22, -1, 'sale', '2025-11-25 03:41:55', '2025-11-25 03:41:55'),
(13, 68, -1, 'sale', '2025-11-27 06:10:48', '2025-11-27 06:10:48'),
(14, 22, -1, 'sale', '2025-11-28 10:32:28', '2025-11-28 10:32:28'),
(15, 52, -1, 'sale', '2025-11-28 10:32:28', '2025-11-28 10:32:28'),
(16, 68, 1, 'stock_in', '2025-11-29 03:01:09', '2025-11-29 03:01:09'),
(17, 60, -1, 'sale', '2025-11-29 06:57:30', '2025-11-29 06:57:30'),
(18, 17, -1, 'sale', '2025-11-29 07:30:32', '2025-11-29 07:30:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sync_operations`
--

CREATE TABLE `sync_operations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_operation_uuid` varchar(36) NOT NULL COMMENT 'UUID unik dari PWA client',
  `status` varchar(20) NOT NULL DEFAULT 'pending' COMMENT 'pending, success, failed',
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Data JSON dari PWA' CHECK (json_valid(`payload`)),
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mustika.com', '$2y$12$UnXubvAvHTbnJA.bkyNnJew4C0pD9ERtrJEbuNTB3mSRSlEP89POq', NULL, '2025-11-14 01:19:14', '2025-11-14 09:04:04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_type_created_at_index` (`type`,`created_at`),
  ADD KEY `audit_logs_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notification_records`
--
ALTER TABLE `notification_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_records_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indeks untuk tabel `purchase_lots`
--
ALTER TABLE `purchase_lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_lots_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_service_code_unique` (`service_code`),
  ADD KEY `services_created_by_foreign` (`created_by`),
  ADD KEY `services_status_index` (`status`),
  ADD KEY `services_service_code_index` (`service_code`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sync_operations`
--
ALTER TABLE `sync_operations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sync_operations_client_operation_uuid_unique` (`client_operation_uuid`),
  ADD KEY `sync_operations_status_index` (`status`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notification_records`
--
ALTER TABLE `notification_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `purchase_lots`
--
ALTER TABLE `purchase_lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `sync_operations`
--
ALTER TABLE `sync_operations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `notification_records`
--
ALTER TABLE `notification_records`
  ADD CONSTRAINT `notification_records_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase_lots`
--
ALTER TABLE `purchase_lots`
  ADD CONSTRAINT `purchase_lots_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
