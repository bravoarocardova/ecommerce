-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Mar 2023 pada 21.59
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
('KBS00000006', 'TSV00000005', 'Barang 1', 'casan, laptop', 'tidak bisa hidup', '2023-03-10 09:58:26', '2023-03-10 09:58:26');

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
('TSV00000006', 'fsda', 'asdfasdfads', '6282376434754', 'selesai', 1, 2147483647, '2023-03-10 09:49:34', '2023-03-10 09:54:22');

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
(102, 'minolta ', 175000, 'produk-2212021669981651.jpg', 'Baru', 'Kamera Analog Minolta x700\r\n\r\nkamera analog x700 + lensa mc rokkor 28mm f2.8 ', 1, 1, '0000-00-00 00:00:00', '2023-03-15 14:55:53'),
(107, 'f aja', 2134, '1678805681_1800e8f96d2dab4ea2b9.png', 'Second', '23123', 1, 0, '2023-03-14 14:54:41', '2023-03-15 14:41:40'),
(108, 'fdsa', 2321, '1678889981_05b7d128fd1de1c75a7b.png', 'Baru', '1234', 12, 0, '2023-03-15 14:19:41', '2023-03-15 14:19:41');

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
('KBS00000005', 1, 10000, '2023-03-10 09:51:11', '2023-03-10 09:51:11');

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
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

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
