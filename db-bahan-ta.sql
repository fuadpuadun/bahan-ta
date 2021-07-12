-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 03:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbakademis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kodebrg` int(10) NOT NULL,
  `namabrg` varchar(100) NOT NULL,
  `id_harga` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `berat` float NOT NULL,
  `fileGambar` varchar(100) NOT NULL,
  `status_kursi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kodebrg`, `namabrg`, `id_harga`, `harga`, `stok`, `berat`, `fileGambar`, `status_kursi`) VALUES
(1, 'Tiket Ekonomi A1', 1, 25000, 28, 0, '1.jpg', 0),
(2, 'Tiket Ekonomi A2', 1, 25000, 19, 0, '1.jpg', 0),
(3, 'Tiket Ekonomi A3', 1, 25000, 10, 0, '1.jpg', 0),
(4, 'Tiket Reguler B1', 2, 50000, 30, 0, '1.jpg', 0),
(5, 'Tiket Reguler B2', 2, 50000, 20, 0, '1.jpg', 0),
(6, 'Tiket Reguler B3', 2, 50000, 10, 0, '1.jpg', 0),
(7, 'Tiket VIP C1', 3, 75000, 10, 0, '1.jpg', 0),
(8, 'Tiket VIP C2', 3, 75000, 10, 0, '1.jpg', 0),
(9, 'Tiket VIP C3', 3, 75000, 10, 0, '1.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(10) NOT NULL,
  `jml_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `jml_harga`) VALUES
(1, 25000),
(2, 50000),
(3, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `idPenjualan` int(10) NOT NULL,
  `kodebrg` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`idPenjualan`, `kodebrg`, `harga`, `jumlah`) VALUES
(9, 1, 25000, 1),
(10, 1, 25000, 1),
(10, 2, 25000, 1),
(11, 2, 25000, 1),
(12, 1, 25000, 1),
(12, 4, 50000, 1),
(12, 7, 75000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `kecamatanAsal` varchar(255) NOT NULL,
  `kecamatanTujuan` varchar(255) NOT NULL,
  `tarif` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`kecamatanAsal`, `kecamatanTujuan`, `tarif`) VALUES
('Karawang Barat, Karawang', 'Banyumanik, Semarang', 16000),
('Karawang Barat, Karawang', 'Kemayoran, Jakarta Pusat', 10000),
('Karawang Barat, Karawang', 'Parongpong, Bandung Barat', 14000),
('Karawang Barat, Karawang', 'Tegalsari, Surabaya', 19000);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `idPembeli` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `kodepos` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idPenjualan` int(10) NOT NULL,
  `tglTransaksi` date NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kecamatanTujuan` varchar(255) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `total` int(10) NOT NULL,
  `ongkir` int(10) NOT NULL,
  `status_pemesanan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idPenjualan`, `tglTransaksi`, `nama`, `alamat`, `kecamatanTujuan`, `hp`, `total`, `ongkir`, `status_pemesanan`) VALUES
(9, '2021-02-08', 'Fuad Sheri Firdaus', 'Polban Bookstore', '', '1234', 25000, 0, 0),
(10, '2021-02-08', 'Fuad Sheri Fis', '2112', '', '23121', 50000, 0, 0),
(11, '2021-02-08', 'Ivan Eka P', 'Polban Bookstore', '', '12', 25000, 0, 0),
(12, '2021-02-08', 'Ichwan', 'dimaan@dimana.com', '', '21212', 150000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(2, 'fuad', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kodebrg`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`idPenjualan`,`kodebrg`),
  ADD KEY `kodebrg` (`kodebrg`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`idPembeli`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idPenjualan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kodebrg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `idPembeli` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idPenjualan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
