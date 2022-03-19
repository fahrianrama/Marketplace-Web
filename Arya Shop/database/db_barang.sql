-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 01:17 AM
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
-- Database: `db_barang`
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
('BU00002', 'Sajiku Bumbu', 'Bumbu', 1000, 1200, 'Pcs', 130, 1, '2021-07-20 11:34:51', 1, '2021-07-21 15:54:41'),
('MB00002', 'Fortunate Taste Ayam Bakar', 'Makanan Basah', 7000, 8000, 'Pcs', 5, 1, '2021-07-20 09:38:32', 1, '2021-12-14 17:15:27'),
('MK00001', 'Fortunate Taste Bakso', 'Makanan Kering', 5000, 5500, 'Pcs', 110, 1, '2021-07-20 07:16:21', 1, '2021-12-14 17:23:04'),
('MK00002', 'Kopi Kapal Api', 'Makanan Kering', 1000, 1500, 'Pcs', 39, 1, '2021-07-20 22:21:57', 1, '2021-12-14 17:22:25');

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
-- Table structure for table `tb_itemset`
--

CREATE TABLE `tb_itemset` (
  `item` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `support` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_itemset`
--

INSERT INTO `tb_itemset` (`item`, `jumlah`, `support`) VALUES
('Sajiku Bumbu', 9, 50),
('Fortunate Taste Ayam Bakar', 10, 56),
('Fortunate Taste Bakso', 9, 50),
('Kopi Kapal Api', 6, 33);

-- --------------------------------------------------------

--
-- Table structure for table `tb_itemset2`
--

CREATE TABLE `tb_itemset2` (
  `item1` varchar(50) NOT NULL,
  `item2` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `support` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_itemset2`
--

INSERT INTO `tb_itemset2` (`item1`, `item2`, `jumlah`, `support`) VALUES
('Sajiku Bumbu', 'Kopi Kapal Api', 2, 34),
('Sajiku Bumbu', 'Fortunate Taste Bakso', 1, 17),
('Fortunate Taste Ayam Bakar', 'Fortunate Taste Bakso', 2, 34),
('Fortunate Taste Bakso', 'Kopi Kapal Api', 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tb_itemset3`
--

CREATE TABLE `tb_itemset3` (
  `item1` varchar(50) NOT NULL,
  `item2` varchar(50) NOT NULL,
  `item3` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `support` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_itemset3`
--

INSERT INTO `tb_itemset3` (`item1`, `item2`, `item3`, `jumlah`, `support`) VALUES
('Fortunate Taste Ayam Bakar', 'Fortunate Taste Bakso', 'Sajiku Bumbu', 3, 60),
('Fortunate Taste Bakso', 'Kopi Kapal Api', 'Sajiku Bumbu', 1, 20),
('Kopi Kapal Api', 'Fortunate Taste Ayam Bakar', 'Sajiku Bumbu', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluar`
--

CREATE TABLE `tb_keluar` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keluar`
--

INSERT INTO `tb_keluar` (`kode_transaksi`, `tanggal_keluar`, `kode_barang`, `jumlah_keluar`, `created_user`, `created_date`) VALUES
('BK-2021-0000002', '2021-07-20', 'MK00001', 12, 1, '2021-07-20 07:36:42'),
('BK-2021-0000003', '2021-07-20', 'MB00002', 5, 1, '2021-07-20 10:32:56'),
('BK-2021-0000004', '2021-07-20', 'MB00002', 23, 1, '2021-07-20 11:28:04'),
('BK-2021-0000005', '2021-07-20', 'MB00002', 24, 1, '2021-07-20 11:35:23'),
('BK-2021-0000006', '2021-07-20', 'MB00002', 23, 1, '2021-07-20 11:37:53'),
('BK-2021-0000006', '2021-07-20', 'MK00001', 23, 1, '2021-07-20 11:37:53'),
('BK-2021-0000006', '2021-07-20', 'BU00002', 23, 1, '2021-07-20 11:37:53'),
('BK-2021-0000007', '2021-07-20', 'MB00002', 2, 1, '2021-07-20 12:00:23'),
('BK-2021-0000007', '2021-07-20', 'MK00001', 2, 1, '2021-07-20 12:00:23'),
('BK-2021-0000007', '2021-07-20', 'BU00002', 2, 1, '2021-07-20 12:00:23'),
('BK-2021-0000008', '2021-07-20', 'MB00002', 12, 1, '2021-07-20 12:01:05'),
('BK-2021-0000008', '2021-07-20', 'MK00001', 28, 1, '2021-07-20 12:01:05'),
('BK-2021-0000008', '2021-07-20', 'BU00002', 12, 1, '2021-07-20 12:01:05'),
('BK-2021-0000009', '2021-07-28', 'MB00002', 20, 1, '2021-07-20 19:03:41'),
('BK-2021-0000010', '2021-07-21', 'MB00002', 10, 1, '2021-07-20 21:08:21'),
('BK-2021-0000010', '2021-07-21', 'MK00001', 20, 1, '2021-07-20 21:08:21'),
('BK-2021-0000011', '2021-07-21', 'BU00002', 13, 1, '2021-07-20 21:09:40'),
('BK-2021-0000011', '2021-07-21', 'MK00001', 20, 1, '2021-07-20 21:09:40'),
('BK-2021-0000012', '2021-07-23', 'MK00002', 80, 1, '2021-07-20 22:22:42'),
('BK-2021-0000013', '2021-07-21', 'BU00002', 20, 1, '2021-07-21 10:22:15'),
('BK-2021-0000013', '2021-07-21', 'MK00002', 20, 1, '2021-07-21 10:22:15'),
('BK-2021-0000014', '2021-07-21', 'MB00002', 2, 1, '2021-07-21 10:26:10'),
('BK-2021-0000014', '2021-07-21', 'MK00001', 2, 1, '2021-07-21 10:26:10'),
('BK-2021-0000015', '2021-07-21', 'BU00002', 20, 1, '2021-07-21 11:47:53'),
('BK-2021-0000015', '2021-07-21', 'MK00002', 10, 1, '2021-07-21 11:47:53'),
('BK-2021-0000016', '2021-07-21', 'MK00002', 10, 1, '2021-07-21 12:20:13'),
('BK-2021-0000016', '2021-07-21', 'MB00002', 2, 1, '2021-07-21 12:20:14'),
('BK-2021-0000016', '2021-07-21', 'BU00002', 10, 1, '2021-07-21 12:20:14'),
('BK-2021-0000017', '2021-07-21', 'MK00001', 8, 1, '2021-07-21 15:54:10'),
('BK-2021-0000017', '2021-07-21', 'MK00002', 10, 1, '2021-07-21 15:54:10'),
('BK-2021-0000017', '2021-07-21', 'BU00002', 50, 1, '2021-07-21 15:54:10'),
('BK-2021-0000018', '2021-07-21', 'MK00001', 10, 1, '2021-07-21 15:54:30'),
('BK-2021-0000018', '2021-07-21', 'MK00002', 10, 1, '2021-07-21 15:54:30'),
('BK-2021-0000019', '2021-07-21', 'BU00002', 20, 1, '2021-07-21 15:54:41'),
('BK-2021-0000020', '2021-12-15', 'MK00001', 10, 1, '2021-12-14 17:15:26'),
('BK-2021-0000020', '2021-12-15', 'MB00002', 1, 1, '2021-12-14 17:15:26'),
('BK-2021-0000020', '2021-12-15', 'MK00002', 20, 1, '2021-12-14 17:15:26'),
('BK-2021-0000021', '2021-12-15', 'MK00001', 10, 1, '2021-12-14 17:22:25'),
('BK-2021-0000021', '2021-12-15', 'MK00002', 1, 1, '2021-12-14 17:22:25');

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
('BM-2021-0000001', '2021-04-21', 'B000002', 1000, 1, '2021-04-21 05:59:00'),
('BM-2021-0000002', '2021-07-20', 'MK00001', 15, 1, '2021-07-20 07:16:54'),
('BM-2021-0000003', '2021-07-20', 'MB00002', 20, 1, '2021-07-20 09:41:55'),
('BM-2021-0000004', '2021-07-20', 'MB00002', 100, 1, '2021-07-20 10:33:29'),
('BM-2021-0000005', '2021-07-20', 'MK00001', 200, 1, '2021-07-20 10:33:52'),
('BM-2021-0000006', '2021-07-20', 'BU00002', 250, 1, '2021-07-20 11:35:05'),
('BM-2021-0000007', '2021-07-21', 'MK00002', 200, 1, '2021-07-20 22:22:25'),
('BM-2021-0000008', '2021-07-21', 'BU00002', 50, 1, '2021-07-21 15:52:58'),
('BM-2021-0000009', '2021-12-15', 'MK00001', 20, 1, '2021-12-14 17:15:41'),
('BM-2021-0000010', '2021-12-15', 'MK00001', 20, 1, '2021-12-14 17:23:04');

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
  `hak_akses` enum('Super Admin','Manajer','Gudang') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Rama vito', '123', 'ramavitobks@gmail.com', '081211112231', 'adult-app-developer-coding-1181244 (1).jpg', 'Super Admin', 'aktif', '2017-04-01 08:15:15', '2021-05-25 14:28:33');

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
  ADD KEY `id_barang` (`kode_barang`),
  ADD KEY `created_user` (`created_user`);

--
-- Indexes for table `tb_masuk`
--
ALTER TABLE `tb_masuk`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_barang` (`kode_barang`),
  ADD KEY `created_user` (`created_user`);

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
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
