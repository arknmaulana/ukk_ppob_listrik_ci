-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 10:36 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_penggunaan` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_pembayaran` text NOT NULL,
  `status_pembayaran` int(11) DEFAULT '0',
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_penggunaan`, `tgl_bayar`, `bukti_pembayaran`, `status_pembayaran`, `id_admin`) VALUES
(2, 7, '2019-04-02', '7-1554165188.png', 0, NULL),
(3, 7, '2019-04-03', '7-1554165675.png', 0, NULL),
(4, 7, '2019-04-10', '7-1554167990.png', 0, NULL),
(5, 8, '2019-04-05', '8-1554169716.jpg', 1, 1),
(6, 9, '2019-04-03', '9-1554174549.png', 0, NULL),
(7, 7, '2019-04-03', '7-1554186222.png', 0, NULL),
(8, 10, '2019-04-03', '10-1554189022.png', 1, 1),
(9, 7, '2019-04-09', '7-1554189338.png', 0, NULL),
(10, 11, '2019-04-02', '11-1554191320.png', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `meteran_awal` double NOT NULL,
  `meteran_akhir` double NOT NULL,
  `biaya_admin` double NOT NULL,
  `total_bayar` double NOT NULL,
  `pg_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meteran_awal`, `meteran_akhir`, `biaya_admin`, `total_bayar`, `pg_status`) VALUES
(7, 7, 1, 2019, 5, 10, 300, 6300, 1),
(8, 7, 2, 2019, 60, 100, 2400, 50400, 2),
(9, 7, 4, 2019, 10, 20, 600, 12600, 3),
(10, 7, 5, 2019, 5, 100, 5700, 119700, 2),
(11, 22, 1, 2019, 200, 5000, 288000, 6048000, 3),
(12, 22, 2, 2019, 60, 1000, 56400, 1184400, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `daya` varchar(100) NOT NULL,
  `perkwh` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `perkwh`) VALUES
(1, '450', 1200),
(4, '900', 1200),
(5, '1200', 1200),
(6, '12000', 13000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nomor_kwh` double DEFAULT NULL,
  `alamat` text,
  `level` int(11) NOT NULL DEFAULT '3',
  `status` int(11) NOT NULL DEFAULT '0',
  `id_tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `nomor_kwh`, `alamat`, `level`, `status`, `id_tarif`) VALUES
(1, 'Admin', 'admin', '$2y$10$AMQyiUkA735KtyPbEmoxmumPqjO/VzUd/MDZt.pg4TygCZ4SKX7.2', NULL, NULL, 1, 1, NULL),
(2, 'irfan', 'irfan', '$2y$10$MkIr5cVCqlP1qH7mtOufLumP7BeNy4sQ5uChT.gVE48OuDaCdrmUG', NULL, NULL, 2, 1, NULL),
(7, 'hakim', 'hakim', '$2y$10$L5b5nCh2NnruJVcOWc4VieAZ4BRD5yjDnc/bbij3DBzvRQNhVc8Zy', 123456, 'malang', 3, 1, 1),
(14, 'jatim', 'jatim', '$2y$10$eWVKfQ1ggny1g/s.r6PKUOXzrsyCn/QNdXyATLhyh4dZzn3bICeD.', 12345, 'jatim', 3, 1, 4),
(15, 'irfanhkm', 'irfanhkm', '$2y$10$.KchLWHdkypCM83HkZoHXupcJWPPpmv/Mt6aqcorJCja.9XXuZ4Se', 123444, 'malang', 3, 1, 1),
(16, 'admin22', 'admin2', '$2y$10$7ukQiDWLRmc2YnB.Pbem7uwz8M3.j5eRWIXXxFYHpHd6gdXmyqK/e', NULL, NULL, 2, 1, NULL),
(18, 'asus', 'asus1', '$2y$10$XsUVhXS0MmFFkoG0ZJ0OK.cQiLEITsGP5zqizGzbWyEFrO94XIEem', 123322, 'malang', 3, 0, 1),
(20, 'ifann', 'ifann', '$2y$10$mkKADZ7x.eh3SXarFPN7COXp0qvUQSwEXHIK0WZxF6PGrgElwsWT2', 1231231, 'ifann', 3, 1, 1),
(21, 'momon', 'momon', '$2y$10$YgzKSurHHWyAWruo6.eRt.T4CfH6N2XUetv9LuYw4ryVhOVGCf.Ei', 1231312, 'malang', 3, 1, 1),
(22, 'sartika2', 'sartika', '$2y$10$s6YH.t4CmzqKaecLMtLDzeUtAX.0ZMIJ5oxrtwfatZTqEL0ZVroRm', 111111, 'Malang', 3, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_penggunaan` (`id_penggunaan`,`id_admin`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pelanggan_2` (`id_pelanggan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_tarif` (`id_tarif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
