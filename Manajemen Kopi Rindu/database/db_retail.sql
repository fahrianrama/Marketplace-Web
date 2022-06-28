-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 01:25 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` int(3) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `kategori`, `harga_beli`, `harga_jual`, `satuan`, `stok`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('FCN', 'Fiesta Chicken Nugget', '250g', 21000, 23000, 'Pcs', 80, 1, '2021-12-16 17:59:51', 1, '2021-12-16 18:28:18'),
('FRT', 'Fiesta Ratu Tancap', '700g', 50000, 75000, 'Box', 0, 1, '2021-12-16 17:52:18', 1, '2021-12-16 17:52:18'),
('FSW', 'Fiesta Paket Spicy Wings', '500 g', 64000, 68000, 'Pcs', 15, 1, '2021-12-16 03:45:44', 1, '2021-12-16 18:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `min_support` int(11) NOT NULL,
  `min_confidence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`tanggal_awal`, `tanggal_akhir`, `min_support`, `min_confidence`) VALUES
('2021-07-06', '2021-07-31', 10, 60);

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluar`
--

CREATE TABLE `tb_keluar` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_terima` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keluar`
--

INSERT INTO `tb_keluar` (`kode_transaksi`, `tanggal_keluar`, `kode_barang`, `jumlah_keluar`, `created_user`, `created_date`, `status_terima`) VALUES
('BK-2021-0000001', '2021-12-17', 'FCN', 10, 'User Tancep Gas', '2021-12-16 18:29:03', 'terima'),
('BK-2021-0000002', '2021-12-17', 'FSW', 5, 'User Tancep Gas', '2021-12-16 18:28:30', 'tolak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masuk`
--

CREATE TABLE `tb_masuk` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_masuk`
--

INSERT INTO `tb_masuk` (`kode_transaksi`, `tanggal_masuk`, `kode_barang`, `jumlah_masuk`, `created_user`, `created_date`) VALUES
('BM-2021-0000009', '2021-12-16', 'FSW', 100, 0, '2021-12-16 13:18:04'),
('BM-2021-0000010', '2021-12-17', 'FCN', 100, 1, '2021-12-16 18:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`kode_transaksi`, `tanggal_keluar`, `kode_barang`, `jumlah_keluar`, `created_user`, `created_date`) VALUES
('BK-2021-0000003', '2021-12-17', 'FCN', 10, 'User Coba', '2021-12-17 03:40:33'),
('BK-2021-0000004', '2021-12-17', 'FSW', 5, 'User Coba', '2021-12-17 03:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_terima` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`kode_transaksi`, `tanggal_keluar`, `kode_barang`, `jumlah_keluar`, `created_user`, `created_date`, `status_terima`) VALUES
('BK-2021-0000002', '2021-12-16', 'FSW', 5, 'User Coba', '2021-12-16 13:25:06', 'terima'),
('BK-2021-0000003', '2021-12-17', 'FSW', 1, 'User Coba', '2021-12-16 17:22:35', ''),
('BK-2021-0000004', '2021-12-17', 'FSW', 1, 'User Tancep Gas', '2021-12-16 18:03:47', ''),
('BK-2021-0000005', '2021-12-17', 'FCN', 10, 'User Tancep Gas', '2021-12-16 18:30:06', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `kode_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_user` int(3) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`kode_barang`, `nama_barang`, `kategori`, `harga_beli`, `harga_jual`, `satuan`, `stok`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('FCN', 'Fiesta Chicken Nugget', '250g', 21000, 23000, 'Pcs', 0, 1, '2021-12-16 18:29:03', 1, '2021-12-16 18:30:06'),
('FSW', 'Fiesta Paket Spicy Wings', '500 g', 64000, 68000, 'Pcs', 3, 1, '2021-12-16 03:45:44', 1, '2021-12-16 18:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Agen') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Mustika Webinar', '123', 'mustika_binar@gmail.com', '081211112231', 'adult-app-developer-coding-1181244 (1).jpg', 'Super Admin', 'aktif', '2017-04-01 08:15:15', '2021-12-10 09:35:30'),
(10, 'User', 'User Coba', '123', 'user@gmail.com', '0821481241241', 'poto.png', 'Agen', 'aktif', '2021-12-16 03:14:28', '2021-12-16 03:14:28'),
(12, 'user2', 'User Tancep Gas', '123', 'tancep@gmail.com', '08365726424', 'gems-12.png', 'Agen', 'aktif', '2021-12-16 17:58:11', '2021-12-16 17:59:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tb_keluar`
--
ALTER TABLE `tb_keluar`
  ADD KEY `id_barang` (`kode_barang`);

--
-- Indexes for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_barang` (`kode_barang`),
  ADD KEY `created_user` (`created_user`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD KEY `id_barang` (`kode_barang`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD KEY `id_barang` (`kode_barang`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`hak_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
