-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Jun 2023 pada 22.36
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
(1, 'Ganti Hardisk', 50000, 'Laptop', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Install ulang', 150000, 'Laptop', '2023-03-10 09:49:01', '2023-05-21 15:21:36');

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
(1, 'LCD Acer', 1000000, 'Laptop', '0000-00-00 00:00:00', '2023-06-06 15:35:51'),
(8, 'Harddisk 320 gb', 300000, 'Laptop', '2023-03-10 09:49:01', '2023-05-21 15:21:44'),
(9, 'Ram 4gb 2300mhz', 350000, 'Laptop', '2023-05-21 13:44:15', '2023-05-21 15:21:53');

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
  `id_province` int NOT NULL,
  `id_city` int NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username_pelanggan`, `email_pelanggan`, `password`, `nama_pelanggan`, `telepon_pelanggan`, `foto_pelanggan`, `id_province`, `id_city`, `alamat_pelanggan`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'fros', 'fros@gmail.com', '$2y$10$21l.ie1oGl4QXh9ov1Am1OWQCFNXjG4ZmItFUiWPw4s/nyzt0w2Ka', 'fros Gaming', '08909093', '1679929742_a07244d3c68a666b327b.png', 8, 156, 'simpang rimbo, Jambi, Provinsi Jambi', '1', '2022-11-14 14:09:20', '2023-06-06 15:29:40'),
(9, 'arnio', 'arnio@gmail.com', '$2y$10$7/F1.JfpZ/BEfxxL6ma3GuX7QuFxYFl4RHxTvIiQer/dow1O/Fn3G', 'arnio', '082349844', 'default.jpg', 8, 156, 'sdafasdf, Jambi, Jambi', '1', '2022-12-02 12:37:23', '2023-03-27 14:46:46');

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
(108, 'Laptop Lenovo', 1500000, '1682693781_5e8d14265d0a08e94501.jpeg', 'Baru', '<p id=\"isPasted\" style=\"line-height: 1;\">Technical Specifications of Asus X441M&nbsp;</p><p style=\"line-height: 1;\">Intel N4000&nbsp;</p><p style=\"line-height: 1;\">DDR4 4GB 1TB&nbsp;</p><p style=\"line-height: 1;\">14 Inch&nbsp;</p><p style=\"line-height: 1;\">Windows 10</p><p style=\"line-height: 1;\">Processor Type1.10 GHz - 2.70 GHz, 4 MB</p><p style=\"line-height: 1;\">Processor OnboardIntel Pentium N4000</p><p style=\"line-height: 1;\">Standard Memory4GB DDR4</p><p style=\"line-height: 1;\">Display Size14 Inch</p><p style=\"line-height: 1;\">Audio TypeIntegrated</p><p style=\"line-height: 1;\">Speakers TypeIntegrated</p><p style=\"line-height: 1;\">Hard Drive TypeHDD 1TB</p><p style=\"line-height: 1;\">Keyboard TypeStandard Keyboard</p><p style=\"line-height: 1;\">Card Reader ProvidedYesInterface Provided</p><p style=\"line-height: 1;\">1 x COMBO audio jack</p><p style=\"line-height: 1;\">1 x VGA port</p><p style=\"line-height: 1;\">1 x Type C USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x Type A USB3.0 (USB3.1 GEN1)</p><p style=\"line-height: 1;\">1 x USB 2.0 port(s)</p><p style=\"line-height: 1;\">1 x RJ45 LAN Jack for LAN insert</p><p style=\"line-height: 1;\">1 x HDMI</p><p style=\"line-height: 1;\">1 x AC adapter plug</p><p style=\"line-height: 1;\">1 x SD Card Slot</p><p style=\"line-height: 1;\">3 bulan part, 1 tahun servis</p>', 33, 2, '1 Tahun Distributor', 0, '2023-03-15 14:19:41', '2023-05-27 02:32:44'),
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
(10, '', 'sdaf', 'text', '2023-05-21 11:40:36', '2023-05-21 11:40:36'),
(11, '1685268750_010eae4074e781c6aec6.jpg', '', 'gambar', '2023-05-28 10:12:30', '2023-05-28 10:12:30');

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
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id_pembelian_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `promosi`
--
ALTER TABLE `promosi`
  MODIFY `id_promosi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
