-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 10:23 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_fbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE IF NOT EXISTS `alat` (
`id_alat` int(15) NOT NULL,
  `nm_alat` varchar(50) NOT NULL,
  `harga` int(30) NOT NULL,
  `id_petani` int(15) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nm_alat`, `harga`, `id_petani`, `deskripsi`) VALUES
(7, 'Cangkul', 100000, 2, 'gggg');

-- --------------------------------------------------------

--
-- Table structure for table `lahan`
--

CREATE TABLE IF NOT EXISTS `lahan` (
`id_lahan` int(15) NOT NULL,
  `nm_lahan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `luas` double NOT NULL,
  `jenis_lahan` varchar(35) NOT NULL,
  `fasilitas` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lahan`
--

INSERT INTO `lahan` (`id_lahan`, `nm_lahan`, `alamat`, `luas`, `jenis_lahan`, `fasilitas`, `deskripsi`) VALUES
(1, 'Ladang', 'Rn 1, Seputih Raman, Lampung Tengah', 500, 'Ladang untuk padi', 'air sungai', 'GGg'),
(3, 'Sawah ', 'Rn 5 Seputih Raman, Lampung Tengah, Lampung', 1000, 'Lahan Untuk Padi', 'air sungai', 'gg lah ya');

-- --------------------------------------------------------

--
-- Table structure for table `petani`
--

CREATE TABLE IF NOT EXISTS `petani` (
`idpetani` int(10) NOT NULL,
  `nmpetani` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(10) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_regional` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petani`
--

INSERT INTO `petani` (`idpetani`, `nmpetani`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `id_regional`, `id_user`, `foto`) VALUES
(2, 'I Gede Arya Surya Gita', '1998-02-01', 'L', 'HINDU', '082280190125', 2, 1, 'laki keren.png'),
(50, 'M Reyhan Dirgantara', '2018-06-03', 'L', 'hindu', '0821xxxx', 1, 2, '20170824_113903.jpg'),
(52, 'I Gede Arya Surya Gita', '1998-01-02', 'L', 'HINDU', '082280190125', 1, 4, 'laki keren.png');

-- --------------------------------------------------------

--
-- Table structure for table `regional`
--

CREATE TABLE IF NOT EXISTS `regional` (
`id_regional` int(15) NOT NULL,
  `nm_regional` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regional`
--

INSERT INTO `regional` (`id_regional`, `nm_regional`) VALUES
(1, 'Lampung'),
(2, 'Palembang'),
(3, 'Jawa Barat'),
(5, 'Aceh'),
(6, 'Bali'),
(7, 'Banten'),
(8, ' Bengkulu'),
(9, ' Gorontalo'),
(10, ' Jakarta'),
(11, ' Jambi	'),
(12, 'Jawa Barat'),
(13, 'Jawa Tengah'),
(14, 'Jawa Timur'),
(15, ' Kalimantan Barat'),
(16, ' Kalimantan Tengah'),
(17, ' Kalimantan Timur'),
(18, ' Kalimantan selatan'),
(19, ' Kalimantan Utara'),
(20, ' Kepulauan Bangka Belitung'),
(21, ' Kepulauan Riau'),
(22, 'Maluku'),
(23, 'Maluku Utara'),
(24, 'Nusa Tenggara Barat'),
(25, 'Nusa Tenggara Barat Timur'),
(26, 'Papua'),
(27, 'Papua Barat'),
(28, ' Riau'),
(29, ' Sulawesi Barat'),
(30, ' Sulawesi Tengah'),
(31, ' Sulawesi Tenggara'),
(32, ' Sulawesi Selatan'),
(33, ' Sumatera Barat'),
(34, ' Sumatera Selatan'),
(35, ' Sumatera Utara'),
(36, 'Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`id_transaksi` int(15) NOT NULL,
  `nm_transaksi` varchar(50) NOT NULL,
  `jenis_transaksi` enum('Pemasukan','Pengeluaran') NOT NULL,
  `jumlah` int(30) NOT NULL,
  `id_usaha` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nm_transaksi`, `jenis_transaksi`, `jumlah`, `id_usaha`, `tanggal`, `deskripsi`) VALUES
(1, 'Pembelian Pupuk', 'Pengeluaran', 1000000, 1, '2018-06-01', 'Beli pupuk urea dan Poska'),
(2, 'Pembelian Obat Hama 2', 'Pengeluaran', 200000, 2, '2018-06-02', 'obat hama wereng'),
(3, 'Modal Awal', 'Pemasukan', 2000000, 1, '2018-06-01', 'Uang yang direncanakan untuk keperluan usaha'),
(4, 'Pembelian Pupuk', 'Pengeluaran', 1000000, 3, '2018-05-01', 'Pembelian pupuk untuk kebutuhan pertumbuhan padi'),
(5, 'Pembelian Herbisida ', 'Pengeluaran', 300000, 3, '2018-05-07', 'Untuk membasmi gulma yang mengganggu pertumbuhan padi'),
(8, 'Panen Awal ', 'Pemasukan', 200000, 3, '2018-05-11', 'Panen Awal'),
(9, 'Pembelian Obat Hama', 'Pengeluaran', 0, 1, '2018-04-04', 'gg'),
(10, 'Pembelian Obat Hama', 'Pemasukan', 0, 1, '2018-04-05', 'gg');

-- --------------------------------------------------------

--
-- Table structure for table `usaha`
--

CREATE TABLE IF NOT EXISTS `usaha` (
`id_usaha` int(15) NOT NULL,
  `nm_usaha` varchar(50) NOT NULL,
  `jenis_usaha` varchar(30) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `id_petani` int(15) NOT NULL,
  `id_lahan` int(15) NOT NULL,
  `deksripsi` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usaha`
--

INSERT INTO `usaha` (`id_usaha`, `nm_usaha`, `jenis_usaha`, `tgl_mulai`, `tgl_selesai`, `id_petani`, `id_lahan`, `deksripsi`) VALUES
(1, 'Pertanian Padi Musim 1 2018', 'Pertanian Padi', '2018-06-01', '2018-06-15', 2, 1, 'gg'),
(2, 'Pertanian Padi Musim 2 2018', 'Pertanian Padi', '2018-06-01', '2018-06-30', 2, 1, 'ppa'),
(3, 'Pertanian Padi Musim 1 2019', 'Pertanian Padi', '2018-06-07', '2018-07-31', 50, 3, 'ffff'),
(4, 'Pertanian Padi Musim 2 2019', 'Pertanian Padi', '2018-06-01', '2018-08-31', 50, 3, 'Pertanian Yang Indah'),
(5, 'Pertanian Sayuran Hiroponik musim 1 2018', 'Pertanian Sayur', '2018-06-01', '2018-06-30', 52, 3, 'Penanaman Sayuran dengan metode hiroponik yang merupakan pertama kali dilakukan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level_user` enum('admin','user') NOT NULL,
  `status` enum('aktif','non aktif') NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level_user`, `status`, `email`) VALUES
(1, 'gede', '123', 'user', 'aktif', ''),
(2, 'reyhan', '123', 'user', 'non aktif', ''),
(4, 'admin', '123', 'admin', 'aktif', 'igedearya359@gmail.com'),
(5, 'gede123', 'gede123', 'admin', 'aktif', 'test@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
 ADD PRIMARY KEY (`id_alat`), ADD KEY `id_petani` (`id_petani`);

--
-- Indexes for table `lahan`
--
ALTER TABLE `lahan`
 ADD PRIMARY KEY (`id_lahan`);

--
-- Indexes for table `petani`
--
ALTER TABLE `petani`
 ADD PRIMARY KEY (`idpetani`), ADD KEY `id_regional` (`id_regional`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `regional`
--
ALTER TABLE `regional`
 ADD PRIMARY KEY (`id_regional`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`id_transaksi`), ADD KEY `id_usaha` (`id_usaha`);

--
-- Indexes for table `usaha`
--
ALTER TABLE `usaha`
 ADD PRIMARY KEY (`id_usaha`), ADD KEY `id_petani` (`id_petani`), ADD KEY `id_lahan` (`id_lahan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
MODIFY `id_alat` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lahan`
--
ALTER TABLE `lahan`
MODIFY `id_lahan` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `petani`
--
ALTER TABLE `petani`
MODIFY `idpetani` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `regional`
--
ALTER TABLE `regional`
MODIFY `id_regional` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `id_transaksi` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usaha`
--
ALTER TABLE `usaha`
MODIFY `id_usaha` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
ADD CONSTRAINT `alat_ibfk_1` FOREIGN KEY (`id_petani`) REFERENCES `petani` (`idpetani`);

--
-- Constraints for table `petani`
--
ALTER TABLE `petani`
ADD CONSTRAINT `petani_ibfk_1` FOREIGN KEY (`id_regional`) REFERENCES `regional` (`id_regional`),
ADD CONSTRAINT `petani_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_usaha`) REFERENCES `usaha` (`id_usaha`);

--
-- Constraints for table `usaha`
--
ALTER TABLE `usaha`
ADD CONSTRAINT `usaha_ibfk_1` FOREIGN KEY (`id_petani`) REFERENCES `petani` (`idpetani`),
ADD CONSTRAINT `usaha_ibfk_2` FOREIGN KEY (`id_lahan`) REFERENCES `lahan` (`id_lahan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
