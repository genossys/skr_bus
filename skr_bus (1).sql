-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 10:20 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skr_bus`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getStatusKursi` (`idjadwal` VARCHAR(15), `tanggal` DATE, `nokursi` VARCHAR(2)) RETURNS VARCHAR(15) CHARSET latin1 NO SQL
BEGIN

DECLARE temp INT(11);
DECLARE result VARCHAR(15);

SET temp = (SELECT COUNT(tb_cartpesan.idJadwal) FROM `tb_cartpesan` WHERE tb_cartpesan.idJadwal = idjadwal AND tb_cartpesan.tanggal = tanggal AND tb_cartpesan.kursi = nokursi);

IF (temp > 0) THEN
	SET result = 'isi';
ELSE
	SET result = 'kosong';
END IF;

RETURN result;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bus`
--

CREATE TABLE `tb_bus` (
  `kdBus` varchar(5) NOT NULL,
  `namaBus` varchar(75) NOT NULL,
  `kursi` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bus`
--

INSERT INTO `tb_bus` (`kdBus`, `namaBus`, `kursi`, `created_at`, `updated_at`) VALUES
('KD01', 'Bus 1', 55, NULL, NULL),
('KD02', 'Bus 2', 59, NULL, NULL),
('KD03', 'Bus 3', 56, NULL, NULL),
('KD04', 'Bus 4', 33, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cartpesan`
--

CREATE TABLE `tb_cartpesan` (
  `id` int(11) NOT NULL,
  `noTrans` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `idJadwal` int(11) NOT NULL,
  `kursi` varchar(2) NOT NULL,
  `namaPenumpang` varchar(75) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cartpesan`
--

INSERT INTO `tb_cartpesan` (`id`, `noTrans`, `tanggal`, `username`, `idJadwal`, `kursi`, `namaPenumpang`, `harga`, `created_at`, `updated_at`) VALUES
(8, 111113, '2019-09-04', 'username1', 2, '1', 'aku', 250000, '2019-09-04 02:09:56', '2019-09-04 02:09:56'),
(9, 111115, '2019-09-04', 'username1', 2, '2', 'penumpang 1', 250000, '2019-09-04 14:32:45', '2019-09-04 14:32:45'),
(10, 111115, '2019-09-04', 'username1', 2, '6', 'penumpang 2', 250000, '2019-09-04 14:33:13', '2019-09-04 14:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `idJadwal` int(11) NOT NULL,
  `kdBus` varchar(5) NOT NULL,
  `asal` varchar(5) NOT NULL,
  `tujuan` varchar(5) NOT NULL,
  `jam` time NOT NULL,
  `harga` bigint(21) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`idJadwal`, `kdBus`, `asal`, `tujuan`, `jam`, `harga`, `created_at`, `updated_at`) VALUES
(2, 'KD01', 'KD01', 'KD03', '13:00:00', 250000, '2019-09-03 00:00:00', '2019-09-03 22:23:37'),
(3, 'KD01', 'KD01', 'KD03', '15:00:00', 300000, '2019-09-03 00:00:00', '2019-09-03 00:00:00'),
(4, 'KD01', 'KD01', 'KD04', '13:00:00', 100000, '2019-09-03 21:36:15', '2019-09-03 22:24:06'),
(5, 'KD01', 'KD01', 'KD04', '15:00:00', 200000, '2019-09-03 22:24:32', '2019-09-03 22:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kota`
--

CREATE TABLE `tb_kota` (
  `kdKota` varchar(5) NOT NULL,
  `namaKota` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kota`
--

INSERT INTO `tb_kota` (`kdKota`, `namaKota`) VALUES
('BDG', 'Bandung'),
('BYL', 'Boyolali'),
('JGJ', 'Jogja'),
('KLT', 'Klaten'),
('KRA', 'Karanganyar'),
('SBY', 'Surabaya'),
('SLO', 'Solo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `username`, `email`, `password`, `nohp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'username1', 'bagus.yanuar613@gmail.com', '$2y$10$HSNJbFJjX4aUfR6qH37IB.Ml0gcQ/.LbP7X55d9oZFme9RuE8I79K', '8920209120', 'jagalan Solo', '2019-09-02 14:15:43', '2019-09-02 14:15:43'),
(2, 'bagus1', 'genossys2019@gmail.com', '$2y$10$/FlFYWGq7l87XIksYSrRH.EKT5hTey42OwkDESRkDwp4JjTouzQuu', '192380', NULL, '2019-09-03 12:49:59', '2019-09-03 12:49:59'),
(3, 'pradana', 'pradana@gmail.com', '$2y$10$Vl6cV/8XVYeSPq5VBNlbIO7z6UdBOUqhG9B95Ye6ITxX2sf9oQb0G', '091823940', 'serengan', '2019-09-03 15:03:24', '2019-09-03 15:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `noTrans` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bank` varchar(25) NOT NULL,
  `status` enum('Pending','Terima','Tolak') NOT NULL,
  `urlFoto` varchar(191) NOT NULL,
  `alasan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `noTrans`, `tanggal`, `bank`, `status`, `urlFoto`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 111113, '2019-09-04', 'BCA', 'Terima', '111113.png', 'Terima', '2019-09-04 11:17:38', '2019-09-04 12:08:22'),
(3, 111115, '2019-09-04', 'BCA', 'Pending', '111115.png', 'menunggu', '2019-09-04 14:50:31', '2019-09-04 14:50:31');

--
-- Triggers `tb_pembayaran`
--
DELIMITER $$
CREATE TRIGGER `AIpembayaran` AFTER INSERT ON `tb_pembayaran` FOR EACH ROW BEGIN

UPDATE tb_pemesanan SET tb_pemesanan.confirmed = '1' WHERE tb_pemesanan.noTrans = NEW.noTrans;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `noTrans` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(25) NOT NULL,
  `total` bigint(21) NOT NULL,
  `confirmed` enum('0','1') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`noTrans`, `tanggal`, `username`, `total`, `confirmed`, `created_at`, `updated_at`) VALUES
(111113, '2019-09-04', 'bagus', 250000, '1', '2019-09-04 10:38:21', '2019-09-04 10:38:21'),
(111115, '2019-09-04', 'username1', 500000, '1', '2019-09-04 14:35:39', '2019-09-04 14:35:39');

--
-- Triggers `tb_pemesanan`
--
DELIMITER $$
CREATE TRIGGER `AIpesan` AFTER INSERT ON `tb_pemesanan` FOR EACH ROW BEGIN

UPDATE tb_cartpesan SET tb_cartpesan.noTrans = NEW.noTrans WHERE tb_cartpesan.username = NEW.username AND tb_cartpesan.noTrans IS NULL;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_terminal`
--

CREATE TABLE `tb_terminal` (
  `kdTerminal` varchar(5) NOT NULL,
  `namaTerminal` varchar(75) NOT NULL,
  `kdKota` varchar(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_terminal`
--

INSERT INTO `tb_terminal` (`kdTerminal`, `namaTerminal`, `kdKota`, `created_at`, `updated_at`) VALUES
('KD01', 'Terminal 1', 'SLO', NULL, NULL),
('KD02', 'Terminal 2', 'SLO', NULL, NULL),
('KD03', 'Terminal 3', 'JGJ', NULL, NULL),
('KD04', 'Terminal 4', 'BYL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `hakakses` enum('admin','pimpinan') NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password`, `hakakses`, `nohp`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$9IfnPYQJLO3ptKswJVSWAuWTsULwWQJL1HaIt/8jTXmGZctJHKRPu', 'admin', '089673266623', '2019-09-02 00:00:00', '2019-09-02 00:00:00'),
(3, 'novi', 'novi@gmail.com', '$2y$10$BQpvv71qjiZbi7go.8dOouGmS8A3N14/xfhP5DmKgU/3yjTm/3kbu', 'pimpinan', '08920910', '2019-09-03 15:02:22', '2019-09-03 15:02:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bus`
--
ALTER TABLE `tb_bus`
  ADD PRIMARY KEY (`kdBus`);

--
-- Indexes for table `tb_cartpesan`
--
ALTER TABLE `tb_cartpesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noTrans` (`noTrans`),
  ADD KEY `username` (`username`),
  ADD KEY `idJadwal` (`idJadwal`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`idJadwal`),
  ADD KEY `kdBus` (`kdBus`),
  ADD KEY `asal` (`asal`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indexes for table `tb_kota`
--
ALTER TABLE `tb_kota`
  ADD PRIMARY KEY (`kdKota`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `noTrans_2` (`noTrans`),
  ADD KEY `noTrans` (`noTrans`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`noTrans`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tb_terminal`
--
ALTER TABLE `tb_terminal`
  ADD PRIMARY KEY (`kdTerminal`),
  ADD KEY `kdKota` (`kdKota`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cartpesan`
--
ALTER TABLE `tb_cartpesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `idJadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `noTrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111116;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cartpesan`
--
ALTER TABLE `tb_cartpesan`
  ADD CONSTRAINT `tb_cartpesan_ibfk_2` FOREIGN KEY (`username`) REFERENCES `tb_member` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cartpesan_ibfk_3` FOREIGN KEY (`idJadwal`) REFERENCES `tb_jadwal` (`idJadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_cartpesan_ibfk_4` FOREIGN KEY (`noTrans`) REFERENCES `tb_pemesanan` (`noTrans`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`kdBus`) REFERENCES `tb_bus` (`kdBus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`asal`) REFERENCES `tb_terminal` (`kdTerminal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_3` FOREIGN KEY (`tujuan`) REFERENCES `tb_terminal` (`kdTerminal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`noTrans`) REFERENCES `tb_pemesanan` (`noTrans`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_terminal`
--
ALTER TABLE `tb_terminal`
  ADD CONSTRAINT `tb_terminal_ibfk_1` FOREIGN KEY (`kdKota`) REFERENCES `tb_kota` (`kdKota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
