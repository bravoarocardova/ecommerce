-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Bulan Mei 2023 pada 14.06
-- Versi server: 8.0.32-0ubuntu0.22.04.2
-- Versi PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartcomp_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.jpg',
  `role` enum('admin','kasir','teknisi') COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama`, `email`, `no_telp`, `password`, `foto`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Nama Admin', 'admin@gmail.com', '08323332323', '$2y$10$7/F1.JfpZ/BEfxxL6ma3GuX7QuFxYFl4RHxTvIiQer/dow1O/Fn3G', '1677687132_8001c2b7637622304203.png', 'admin', '1', '2023-02-25 13:59:10', '2023-03-12 14:13:50'),
(2, 'kasir', 'Nama Kasir', 'kasir@gmail.com', '0008323332323', '$2y$10$reMgvX2Y89fkzQ7FI9OT2.5GZotpcn6nZE9f6lJgMPvstjPfJRoU6', '1678891178_4f5e0b49866c3d947d0d.png', 'kasir', '1', '2023-02-25 13:59:10', '2023-03-15 14:39:38'),
(3, 'teknisi', 'Nama Teknisi', 'teknisi@gmail.com', '08323332323', '$2y$10$MPLiipuiWyWLgn9C8SxcVuEIkHr9DaeNp3nHRS8xo0PNQ9xMG5Oum', 'default.jpg', 'teknisi', '1', '2023-02-25 13:59:10', '2023-03-12 14:18:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_servis`
--

CREATE TABLE `barang_servis` (
  `kd_barang_servis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `no_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang_servis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kelengkapan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kerusakan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_servis`
--

INSERT INTO `barang_servis` (`kd_barang_servis`, `no_transaksi`, `nama_barang_servis`, `kelengkapan`, `kerusakan`, `created_at`, `updated_at`) VALUES
('KBS00000003', 'TSV00000002', 'Barang 12', '1234', '1234', '2023-02-23 15:20:58', '2023-02-23 15:20:58'),
('KBS00000004', 'TSV00000003', 'Barang 1', 'casan, tas, laptop', 'tidak bisa hidup', '2023-02-24 15:14:09', '2023-02-24 15:14:09'),
('KBS00000005', 'TSV00000006', 'Barang 1', 'casan, laptop', 'tidak bisa hidup', '2023-03-10 09:49:54', '2023-03-10 09:49:54'),
('KBS00000007', 'TSV00000007', 'dgfsd', 'gvsd', 'dgvs', '2023-04-07 08:42:39', '2023-04-07 08:42:39'),
('KBS00000008', 'TSV00000008', 'Barang 12', 'casan, tas, laptop', 'tidak bisa hidup', '2023-05-21 10:22:34', '2023-05-21 10:22:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_servis`
--

CREATE TABLE `data_servis` (
  `no_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pelanggan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_pelanggan` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp_pelanggan` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` set('menunggu konfirmasi','diproses','selesai','dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teknisi` int DEFAULT NULL,
  `total_biaya` int NOT NULL,
  `estimasi_servis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_servis`
--

INSERT INTO `data_servis` (`no_transaksi`, `nama_pelanggan`, `alamat_pelanggan`, `no_telp_pelanggan`, `status`, `teknisi`, `total_biaya`, `estimasi_servis`, `created_at`, `updated_at`) VALUES
('TSV00000002', 'fros Gaming', 'ferw', '6282376434754', 'selesai', 1, 12000, '', '2023-02-23 15:19:41', '2023-02-26 13:19:24'),
('TSV00000003', 'fros Gaming', 'iooijo', '6282376434754', 'dibatalkan', 1, 0, '', '2023-02-24 15:13:23', '2023-02-26 13:19:52'),
('TSV00000006', 'fsda', 'asdfasdfads', '6282376434754', 'selesai', 1, 2147483647, '3 Hari', '2023-03-10 09:49:34', '2023-03-10 09:54:22'),
('TSV00000007', 'fros Gaming', 'jl.ljj\r\n', '6282376434754', 'selesai', 1, 10000, '', '2023-04-07 08:42:05', '2023-04-07 08:45:55'),
('TSV00000008', 'fros Gaming', 'adfada', '6282376434754', 'selesai', 1, 556973, '3 hari', '2023-05-21 10:20:26', '2023-05-21 15:32:09'),
('TSV00000009', 'sdfafsd', 'fdas', '6233242342', NULL, NULL, 0, '3 hari', '2023-05-21 13:51:22', '2023-05-21 13:51:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa_servis`
--

CREATE TABLE `jasa_servis` (
  `id_jasa_servis` int NOT NULL,
  `nama_jasa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `biaya_jasa` int NOT NULL,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jasa_servis`
--

INSERT INTO `jasa_servis` (`id_jasa_servis`, `nama_jasa`, `biaya_jasa`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Jasa 1', 10000, 'Laptop', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Install ulang', 214740, 'Laptop', '2023-03-10 09:49:01', '2023-05-21 15:21:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `part_produk`
--

CREATE TABLE `part_produk` (
  `id_part_produk` int NOT NULL,
  `nama_part` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `biaya_part` int NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `part_produk`
--

INSERT INTO `part_produk` (`id_part_produk`, `nama_part`, `biaya_part`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Jasa 1', 10000, 'Laptop', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Install ulang', 214742, 'Laptop', '2023-03-10 09:49:01', '2023-05-21 15:21:44'),
(9, 'Ram 4gb 2300mhz', 342233, 'Laptop', '2023-05-21 13:44:15', '2023-05-21 15:21:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `part_servis`
--

CREATE TABLE `part_servis` (
  `kd_barang_servis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_part_produk` int NOT NULL,
  `biaya_part_servis` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `part_servis`
--

INSERT INTO `part_servis` (`kd_barang_servis`, `id_part_produk`, `biaya_part_servis`, `created_at`, `updated_at`) VALUES
('KBS00000005', 8, 2147483647, '2023-03-10 09:51:04', '2023-03-10 09:51:04'),
('KBS00000005', 1, 10000, '2023-03-10 09:51:11', '2023-03-10 09:51:11'),
('KBS00000007', 1, 10000, '2023-04-07 08:43:58', '2023-04-07 08:43:58'),
('KBS00000006', 8, 2147483647, '2023-04-07 08:47:36', '2023-04-07 08:47:36'),
('KBS00000008', 9, 342233, '2023-05-21 15:10:44', '2023-05-21 15:10:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `username_pelanggan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_pelanggan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon_pelanggan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_pelanggan` varchar(100) NOT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username_pelanggan`, `email_pelanggan`, `password`, `nama_pelanggan`, `telepon_pelanggan`, `foto_pelanggan`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'fros', 'fros@gmail.com', '$2y$10$21l.ie1oGl4QXh9ov1Am1OWQCFNXjG4ZmItFUiWPw4s/nyzt0w2Ka', 'fros Gaming', '08909093', '1679929742_a07244d3c68a666b327b.png', '1', '2022-11-14 14:09:20', '2023-03-27 15:09:02'),
(9, 'arnio', 'arnio@gmail.com', '$2y$10$7/F1.JfpZ/BEfxxL6ma3GuX7QuFxYFl4RHxTvIiQer/dow1O/Fn3G', 'arnio', '082349844', 'default.jpg', '1', '2022-12-02 12:37:23', '2023-03-27 14:46:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int NOT NULL,
  `nama_pemasok` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `jumlah_beli` int NOT NULL,
  `id_produk` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `harga_beli`, `jumlah_beli`, `id_produk`, `total`, `created_at`, `updated_at`) VALUES
(4, 'pemasok', 34324234, 23, 114, 789457382, '2023-05-27 02:38:26', '2023-05-27 02:38:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_pembelian` varchar(100) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `bukti`, `created_at`, `updated_at`) VALUES
(1, 'PBR00000003', 'Nama Admin 2', 'bri', 11111, '1683038169_ac6adf5b18b6eada4ff3.jpeg', '2023-05-02 14:36:09', '2023-05-02 14:36:09'),
(2, 'PBR00000006', 'Nama Admin 2', 'bri', 28510000, '1685169666_73a2600e917995e255ad.jpg', '2023-05-27 06:41:06', '2023-05-27 06:41:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pelanggan` int NOT NULL,
  `tujuan` text COLLATE utf8mb4_general_ci NOT NULL,
  `ekspedisi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `total_berat` int NOT NULL,
  `ongkir` int NOT NULL,
  `total_pembelian` int NOT NULL,
  `status_pembelian` enum('Belum Bayar','Dibatalkan','Dikemas','Dikirim','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_resi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_admin` int DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tujuan`, `ekspedisi`, `total_berat`, `ongkir`, `total_pembelian`, `status_pembelian`, `no_resi`, `id_admin`, `created_at`, `updated_at`) VALUES
('PBR00000001', 5, 'kljoiajiof asf as, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 4642, 'Dibatalkan', '', NULL, '2023-04-26 14:15:31', '2023-04-29 02:20:29'),
('PBR00000002', 5, 'alamat lengkap, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 6864, 'Dibatalkan', '', NULL, '2023-04-26 14:51:57', '2023-04-29 02:20:29'),
('PBR00000003', 5, 'alamat lengkap ku, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 1111, 'Selesai', 'sdaf', NULL, '2023-04-26 15:19:19', '2023-05-07 13:34:27'),
('PBR00000004', 5, 'alamat lengkap saya sendiri, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 1500000, 'Dibatalkan', '', NULL, '2023-05-02 13:46:37', '2023-05-02 14:46:40'),
('PBR00000005', 5, 'alamat, Jambi, Jambi', 'JNE City Courier (CTCYES)', 2, 14000, 1500000, 'Dibatalkan', '', NULL, '2023-05-20 13:57:43', '2023-05-20 14:58:19'),
('PBR00000006', 5, 'sdafsdf, Jambi, Jambi', 'JNE City Courier (CTC)', 6, 10000, 28500000, 'Selesai', 'sdaf', 1, '2023-05-27 06:16:40', '2023-05-27 07:04:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int NOT NULL,
  `id_pembelian` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(5, 'PBR00000001', 108, 1, 4642, '2023-04-26 14:15:31', '2023-04-29 01:31:40'),
(7, 'PBR00000002', 109, 2, 2222, '2023-04-26 14:51:57', '2023-04-29 01:31:40'),
(8, 'PBR00000002', 108, 2, 4642, '2023-04-26 14:51:57', '2023-04-29 01:31:40'),
(9, 'PBR00000003', 109, 4, 1111, '2023-04-26 15:19:19', '2023-04-29 01:31:40'),
(10, 'PBR00000004', 108, 1, 1500000, '2023-05-02 13:46:37', '2023-05-02 13:46:37'),
(11, 'PBR00000005', 108, 1, 1500000, '2023-05-20 13:57:43', '2023-05-20 13:57:43'),
(12, 'PBR00000006', 109, 2, 27000000, '2023-05-27 06:16:40', '2023-05-27 06:16:40'),
(13, 'PBR00000006', 108, 1, 1500000, '2023-05-27 06:16:40', '2023-05-27 06:16:40');

--
-- Trigger `pembelian_produk`
--
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER INSERT ON `pembelian_produk` FOR EACH ROW BEGIN

   UPDATE produk SET stok_produk = stok_produk - NEW.jumlah

   WHERE id_produk = NEW.id_produk;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `kondisi_produk` set('Baru','Second') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int NOT NULL,
  `berat_produk` int NOT NULL,
  `garansi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `diskon` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `kondisi_produk`, `deskripsi_produk`, `stok_produk`, `berat_produk`, `garansi`, `diskon`, `created_at`, `updated_at`) VALUES
(102, 'Laptop Asus', 175000, '1682693730_857b82b7d1cd887d2296.jpeg', 'Baru', '<p>Technical Specifications of Asus X441M Intel N4000 DDR4 4GB 1TB 14 Inch Windows 10\r\nProcessor Type\r\n1.10 GHz - 2.70 GHz, 4 MB\r\nProcessor Onboard\r\nIntel Pentium N4000\r\nStandard Memory\r\n4GB DDR4\r\nDisplay Size\r\n14 Inch\r\nAudio Type\r\nIntegrated\r\nSpeakers Type\r\nIntegrated\r\nHard Drive Type\r\nHDD 1TB\r\nKeyboard Type\r\nStandard Keyboard\r\nCard Reader Provided\r\nYes\r\nInterface Provided\r\n1 x COMBO audio jack\r\n1 x VGA port\r\n1 x Type C USB3.0 (USB3.1 GEN1)\r\n1 x Type A USB3.0 (USB3.1 GEN1)\r\n1 x USB 2.0 port(s)\r\n1 x RJ45 LAN Jack for LAN insert\r\n1 x HDMI\r\n1 x AC adapter plug\r\n1 x SD Card Slot\r\n3 bulan part, 1 tahun servis</p>', 5, 1, '1 Tahun Distributor', 0, '2023-03-15 08:07:23', '2023-05-27 02:27:55'),
(107, 'Laptop Acer', 1500000, '1682693762_0747e89aa1d66d36195a.jpeg', 'Second', '<p id=\"isPasted\" style=\"line-height: 1;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1;\">Intel N4000&nbsp;</p><p style=\"line-height: 1;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1;\">14 Inch&nbsp;</p><p style=\"line-height: 1;\">Windows 10</p><p style=\"line-height: 1;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1;\">Display Size14 Inch</p><p style=\"line-height: 1;\">Audio TypeIntegrated</p><p style=\"line-height: 1;\">Speakers TypeIntegrated</p><p style=\"line-height: 1;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1;\">1 x COMBO audio jack</p><p style=\"line-height: 1;\">1 x VGA port</p><p style=\"line-height: 1;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1;\">1 x HDMI</p><p style=\"line-height: 1;\">1 x AC adapter plug</p><p style=\"line-height: 1;\">1 x SD Card Slot</p><p style=\"line-height: 1;\">3 bulan part, 1 tahun servis</p>', 4, 4, '1 Tahun Distributor', 0, '2023-03-14 14:54:41', '2023-05-27 03:04:08'),
(108, 'Laptop Lenovo', 1500000, '1682693781_5e8d14265d0a08e94501.jpeg', 'Baru', '<p id=\"isPasted\" style=\"line-height: 1;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1;\">Intel N4000&nbsp;</p><p style=\"line-height: 1;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1;\">14 Inch&nbsp;</p><p style=\"line-height: 1;\">Windows 10</p><p style=\"line-height: 1;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1;\">Display Size14 Inch</p><p style=\"line-height: 1;\">Audio TypeIntegrated</p><p style=\"line-height: 1;\">Speakers TypeIntegrated</p><p style=\"line-height: 1;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1;\">1 x COMBO audio jack</p><p style=\"line-height: 1;\">1 x VGA port</p><p style=\"line-height: 1;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1;\">1 x HDMI</p><p style=\"line-height: 1;\">1 x AC adapter plug</p><p style=\"line-height: 1;\">1 x SD Card Slot</p><p style=\"line-height: 1;\">3 bulan part, 1 tahun servis</p>', 34, 2, '1 Tahun Distributor', 0, '2023-03-15 14:19:41', '2023-05-27 02:32:44'),
(109, 'Laptop Hp', 15000000, '1682693800_318cc361982ab3cc9de6.jpeg', 'Baru', '<p id=\"isPasted\" style=\"line-height: 1.15;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1.15;\">Intel N4000&nbsp;</p><p style=\"line-height: 1.15;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1.15;\">14 Inch&nbsp;</p><p style=\"line-height: 1.15;\">Windows 10</p><p style=\"line-height: 1.15;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1.15;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1.15;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1.15;\">Display Size14 Inch</p><p style=\"line-height: 1.15;\">Audio TypeIntegrated</p><p style=\"line-height: 1.15;\">Speakers TypeIntegrated</p><p style=\"line-height: 1.15;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1.15;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1.15;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1.15;\">1 x COMBO audio jack</p><p style=\"line-height: 1.15;\">1 x VGA port</p><p style=\"line-height: 1.15;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1.15;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1.15;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1.15;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1.15;\">1 x HDMI</p><p style=\"line-height: 1.15;\">1 x AC adapter plug</p><p style=\"line-height: 1.15;\">1 x SD Card Slot</p><p style=\"line-height: 1.15;\">3 bulan part, 1 tahun servis</p>', 75, 2, '1 Tahun Distributor', 10, '2023-03-23 11:53:08', '2023-05-27 03:06:12'),
(115, 'Laptop Asus', 2343, '1685156281_1bb8d0554838585b34ba.jpg', 'Second', '<p>eraweerwae</p>', 23, 2, '1 Tahun Distributor', 2, '2023-05-27 02:58:01', '2023-05-27 02:58:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promosi`
--

CREATE TABLE `promosi` (
  `id_promosi` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_promosi` set('gambar','text') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `promosi`
--

INSERT INTO `promosi` (`id_promosi`, `gambar`, `text`, `tipe_promosi`, `created_at`, `updated_at`) VALUES
(2, '', 'text', 'text', '2023-05-21 10:44:25', '2023-05-21 10:44:25'),
(8, '1684668711_174c756c9691fa7e9868.jpeg', '', 'gambar', '2023-05-21 11:31:51', '2023-05-21 11:31:51'),
(9, '1684668760_cddd07ba0283383fdbff.jpeg', '', 'gambar', '2023-05-21 11:32:40', '2023-05-21 11:32:40'),
(10, '', 'sdaf', 'text', '2023-05-21 11:40:36', '2023-05-21 11:40:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `servis`
--

CREATE TABLE `servis` (
  `kd_barang_servis` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_jasa_servis` int NOT NULL,
  `biaya_servis` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `servis`
--

INSERT INTO `servis` (`kd_barang_servis`, `id_jasa_servis`, `biaya_servis`, `created_at`, `updated_at`) VALUES
('KBS00000005', 8, 2147483647, '2023-03-10 09:51:04', '2023-03-10 09:51:04'),
('KBS00000005', 1, 10000, '2023-03-10 09:51:11', '2023-03-10 09:51:11'),
('KBS00000007', 1, 10000, '2023-04-07 08:43:58', '2023-04-07 08:43:58'),
('KBS00000008', 8, 214740, '2023-05-21 15:11:54', '2023-05-21 15:11:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int NOT NULL,
  `nama_aplikasi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_aplikasi`, `alamat`, `telepon`, `email`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Smartcomp Store', 'Jl. RB Siagian, Kec Pal Merah. Sari, Kec. Kota Jambi, Jambi', '6282376434754', 'smartcompstore@gmail.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1615.0479025418338!2d103.6419543300081!3d-1.623708126507803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588b204a20577%3A0x9bf71b5d8026acad!2sJl.%20RB.%20Siagian%2C%20Kec.%20Jambi%20Sel.%2C%20Kota%20Jambi%2C%20Jambi!5e0!3m2!1sid!2sid!4v1671179941959!5m2!1sid!2sid', '2023-05-20 15:43:33', '2023-05-21 09:53:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang_servis`
--
ALTER TABLE `barang_servis`
  ADD PRIMARY KEY (`kd_barang_servis`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indeks untuk tabel `data_servis`
--
ALTER TABLE `data_servis`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `teknisi` (`teknisi`);

--
-- Indeks untuk tabel `jasa_servis`
--
ALTER TABLE `jasa_servis`
  ADD PRIMARY KEY (`id_jasa_servis`);

--
-- Indeks untuk tabel `part_produk`
--
ALTER TABLE `part_produk`
  ADD PRIMARY KEY (`id_part_produk`);

--
-- Indeks untuk tabel `part_servis`
--
ALTER TABLE `part_servis`
  ADD KEY `kd_barang_servis` (`kd_barang_servis`),
  ADD KEY `id_jasa_servis` (`id_part_produk`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `promosi`
--
ALTER TABLE `promosi`
  ADD PRIMARY KEY (`id_promosi`);

--
-- Indeks untuk tabel `servis`
--
ALTER TABLE `servis`
  ADD KEY `kd_barang_servis` (`kd_barang_servis`),
  ADD KEY `id_jasa_servis` (`id_jasa_servis`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jasa_servis`
--
ALTER TABLE `jasa_servis`
  MODIFY `id_jasa_servis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `part_produk`
--
ALTER TABLE `part_produk`
  MODIFY `id_part_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `promosi`
--
ALTER TABLE `promosi`
  MODIFY `id_promosi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_servis`
--
ALTER TABLE `barang_servis`
  ADD CONSTRAINT `barang_servis_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `data_servis` (`no_transaksi`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `servis`
--
ALTER TABLE `servis`
  ADD CONSTRAINT `servis_ibfk_1` FOREIGN KEY (`kd_barang_servis`) REFERENCES `barang_servis` (`kd_barang_servis`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `servis_ibfk_2` FOREIGN KEY (`id_jasa_servis`) REFERENCES `part_produk` (`id_part_produk`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
