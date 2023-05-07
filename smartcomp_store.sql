-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Bulan Mei 2023 pada 15.24
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
('KBS00000006', 'TSV00000005', 'Barang 1', 'casan, laptop', 'tidak bisa hidup', '2023-03-10 09:58:26', '2023-03-10 09:58:26'),
('KBS00000007', 'TSV00000007', 'dgfsd', 'gvsd', 'dgvs', '2023-04-07 08:42:39', '2023-04-07 08:42:39');

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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_servis`
--

INSERT INTO `data_servis` (`no_transaksi`, `nama_pelanggan`, `alamat_pelanggan`, `no_telp_pelanggan`, `status`, `teknisi`, `total_biaya`, `created_at`, `updated_at`) VALUES
('TSV00000002', 'fros Gaming', 'ferw', '6282376434754', 'selesai', 1, 12000, '2023-02-23 15:19:41', '2023-02-26 13:19:24'),
('TSV00000003', 'fros Gaming', 'iooijo', '6282376434754', 'dibatalkan', 1, 0, '2023-02-24 15:13:23', '2023-02-26 13:19:52'),
('TSV00000005', 'fros Gaming', 'sdaf', '622342', NULL, NULL, 0, '2023-03-02 14:38:41', '2023-03-02 14:38:41'),
('TSV00000006', 'fsda', 'asdfasdfads', '6282376434754', 'selesai', 1, 2147483647, '2023-03-10 09:49:34', '2023-03-10 09:54:22'),
('TSV00000007', 'fros Gaming', 'jl.ljj\r\n', '6282376434754', 'selesai', 1, 10000, '2023-04-07 08:42:05', '2023-04-07 08:45:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa_servis`
--

CREATE TABLE `jasa_servis` (
  `id_jasa_servis` int NOT NULL,
  `nama_jasa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `biaya_jasa` int NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jasa_servis`
--

INSERT INTO `jasa_servis` (`id_jasa_servis`, `nama_jasa`, `biaya_jasa`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Jasa 1', 10000, 'Laptop', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Jasa 2', 12000, 'Komputer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Jasa 3', 10000, 'Laptop', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Install ulang', 2147483647, 'Laptop', '2023-03-10 09:49:01', '2023-03-10 09:49:01');

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
(1, 'PBR00000003', 'Nama Admin 2', 'bri', 11111, '1683038169_ac6adf5b18b6eada4ff3.jpeg', '2023-05-02 14:36:09', '2023-05-02 14:36:09');

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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tujuan`, `ekspedisi`, `total_berat`, `ongkir`, `total_pembelian`, `status_pembelian`, `no_resi`, `created_at`, `updated_at`) VALUES
('PBR00000001', 5, 'kljoiajiof asf as, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 4642, 'Dibatalkan', '', '2023-04-26 14:15:31', '2023-04-29 02:20:29'),
('PBR00000002', 5, 'alamat lengkap, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 6864, 'Dibatalkan', '', '2023-04-26 14:51:57', '2023-04-29 02:20:29'),
('PBR00000003', 5, 'alamat lengkap ku, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 1111, 'Dikemas', '', '2023-04-26 15:19:19', '2023-05-02 14:36:09'),
('PBR00000004', 5, 'alamat lengkap saya sendiri, Jambi, Jambi', 'JNE City Courier (CTC)', 2, 10000, 1500000, 'Dibatalkan', '', '2023-05-02 13:46:37', '2023-05-02 14:46:40');

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
(10, 'PBR00000004', 108, 1, 1500000, '2023-05-02 13:46:37', '2023-05-02 13:46:37');

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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `kondisi_produk`, `deskripsi_produk`, `stok_produk`, `berat_produk`, `created_at`, `updated_at`) VALUES
(102, 'Laptop Asus', 175000, '1682693730_857b82b7d1cd887d2296.jpeg', 'Baru', 'Technical Specifications of Asus X441M Intel N4000 DDR4 4GB 1TB 14 Inch Windows 10\nProcessor Type\n1.10 GHz - 2.70 GHz, 4 MB\nProcessor Onboard\nIntel Pentium N4000\nStandard Memory\n4GB DDR4\nDisplay Size\n14 Inch\nAudio Type\nIntegrated\nSpeakers Type\nIntegrated\nHard Drive Type\nHDD 1TB\nKeyboard Type\nStandard Keyboard\nCard Reader Provided\nYes\nInterface Provided\n1 x COMBO audio jack\n1 x VGA port\n1 x Type C USB3.0 (USB3.1 GEN1)\n1 x Type A USB3.0 (USB3.1 GEN1)\n1 x USB 2.0 port(s)\n1 x RJ45 LAN Jack for LAN insert\n1 x HDMI\n1 x AC adapter plug\n1 x SD Card Slot\n3 bulan part, 1 tahun servis', 5, 1, '2023-03-15 08:07:23', '2023-04-28 15:36:18'),
(107, 'Laptop Acer', 1500000, '1682693762_0747e89aa1d66d36195a.jpeg', 'Second', '<p id=\"isPasted\" style=\"line-height: 1;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1;\">Intel N4000&nbsp;</p><p style=\"line-height: 1;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1;\">14 Inch&nbsp;</p><p style=\"line-height: 1;\">Windows 10</p><p style=\"line-height: 1;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1;\">Display Size14 Inch</p><p style=\"line-height: 1;\">Audio TypeIntegrated</p><p style=\"line-height: 1;\">Speakers TypeIntegrated</p><p style=\"line-height: 1;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1;\">1 x COMBO audio jack</p><p style=\"line-height: 1;\">1 x VGA port</p><p style=\"line-height: 1;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1;\">1 x HDMI</p><p style=\"line-height: 1;\">1 x AC adapter plug</p><p style=\"line-height: 1;\">1 x SD Card Slot</p><p style=\"line-height: 1;\">3 bulan part, 1 tahun servis</p>', 4, 4, '2023-03-14 14:54:41', '2023-04-28 15:36:26'),
(108, 'Laptop Lenovo', 1500000, '1682693781_5e8d14265d0a08e94501.jpeg', 'Baru', '<p id=\"isPasted\" style=\"line-height: 1;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1;\">Intel N4000&nbsp;</p><p style=\"line-height: 1;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1;\">14 Inch&nbsp;</p><p style=\"line-height: 1;\">Windows 10</p><p style=\"line-height: 1;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1;\">Display Size14 Inch</p><p style=\"line-height: 1;\">Audio TypeIntegrated</p><p style=\"line-height: 1;\">Speakers TypeIntegrated</p><p style=\"line-height: 1;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1;\">1 x COMBO audio jack</p><p style=\"line-height: 1;\">1 x VGA port</p><p style=\"line-height: 1;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1;\">1 x HDMI</p><p style=\"line-height: 1;\">1 x AC adapter plug</p><p style=\"line-height: 1;\">1 x SD Card Slot</p><p style=\"line-height: 1;\">3 bulan part, 1 tahun servis</p>', 35, 2, '2023-03-15 14:19:41', '2023-05-02 14:46:40'),
(109, 'Laptop Hp', 15000000, '1682693800_318cc361982ab3cc9de6.jpeg', 'Baru', '<p id=\"isPasted\" style=\"line-height: 1.15;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1.15;\">Intel N4000&nbsp;</p><p style=\"line-height: 1.15;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1.15;\">14 Inch&nbsp;</p><p style=\"line-height: 1.15;\">Windows 10</p><p style=\"line-height: 1.15;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1.15;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1.15;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1.15;\">Display Size14 Inch</p><p style=\"line-height: 1.15;\">Audio TypeIntegrated</p><p style=\"line-height: 1.15;\">Speakers TypeIntegrated</p><p style=\"line-height: 1.15;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1.15;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1.15;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1.15;\">1 x COMBO audio jack</p><p style=\"line-height: 1.15;\">1 x VGA port</p><p style=\"line-height: 1.15;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1.15;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1.15;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1.15;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1.15;\">1 x HDMI</p><p style=\"line-height: 1.15;\">1 x AC adapter plug</p><p style=\"line-height: 1.15;\">1 x SD Card Slot</p><p style=\"line-height: 1.15;\">3 bulan part, 1 tahun servis</p>', 73, 2, '2023-03-23 11:53:08', '2023-04-29 02:47:42');

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
('KBS00000003', 2, 12000, '2023-02-23 15:21:10', '2023-02-23 15:21:10'),
('KBS00000004', 2, 12000, '2023-02-25 07:40:09', '2023-02-25 07:40:09'),
('KBS00000005', 8, 2147483647, '2023-03-10 09:51:04', '2023-03-10 09:51:04'),
('KBS00000005', 1, 10000, '2023-03-10 09:51:11', '2023-03-10 09:51:11'),
('KBS00000007', 1, 10000, '2023-04-07 08:43:58', '2023-04-07 08:43:58'),
('KBS00000006', 8, 2147483647, '2023-04-07 08:47:36', '2023-04-07 08:47:36'),
('KBS00000006', 2, 12000, '2023-04-07 08:47:43', '2023-04-07 08:47:43');

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
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

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
-- Indeks untuk tabel `servis`
--
ALTER TABLE `servis`
  ADD KEY `kd_barang_servis` (`kd_barang_servis`),
  ADD KEY `id_jasa_servis` (`id_jasa_servis`);

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
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

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
  ADD CONSTRAINT `servis_ibfk_2` FOREIGN KEY (`id_jasa_servis`) REFERENCES `jasa_servis` (`id_jasa_servis`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
