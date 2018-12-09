-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2017 at 08:31 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appman`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_jadi`
--

CREATE TABLE `app_jadi` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_rack` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_material`
--

CREATE TABLE `app_material` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_pesan_material`
--

CREATE TABLE `app_pesan_material` (
  `id` int(11) NOT NULL,
  `nama_material` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_project`
--

CREATE TABLE `app_project` (
  `id` int(11) NOT NULL,
  `no` varchar(30) NOT NULL,
  `spesifikasi` text NOT NULL,
  `tanggal_terima` date NOT NULL,
  `deltime` date NOT NULL,
  `qty` int(10) NOT NULL,
  `customer` varchar(150) NOT NULL,
  `devisi` enum('Marketing','Engineering','Gudang') NOT NULL,
  `status` enum('Proses','OK') NOT NULL,
  `revisi` tinyint(1) NOT NULL DEFAULT '0',
  `terkirim` enum('1','2','0') NOT NULL DEFAULT '0',
  `design` varchar(200) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_project`
--

INSERT INTO `app_project` (`id`, `no`, `spesifikasi`, `tanggal_terima`, `deltime`, `qty`, `customer`, `devisi`, `status`, `revisi`, `terkirim`, `design`) VALUES
(1, 'S1/17/0001', 'First project sent by Dany!', '2017-07-01', '2017-07-29', 15, 'Hanafi', 'Marketing', 'Proses', 0, '2', 'ff29e8-20170703.png'),
(2, 'S2/17/0532', 'Projected!', '2017-02-27', '2017-03-31', 20, 'Hardianto', 'Marketing', 'Proses', 0, '2', 'e0249a-20170703.png'),
(3, 'S2/17/0002', 'Proyek baru gan', '2017-06-01', '2017-06-30', 30, 'Ferdianto', 'Marketing', 'Proses', 0, '2', '3576f1-20170703.png'),
(4, 'S3/18/0002', 'Testing aja bung', '2017-07-01', '2017-07-31', 10, 'Hanafi', 'Engineering', 'Proses', 0, '2', '3f86b9-20170703.png');

-- --------------------------------------------------------

--
-- Table structure for table `app_rack`
--

CREATE TABLE `app_rack` (
  `id` int(11) NOT NULL,
  `nama_rak` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_rack`
--

INSERT INTO `app_rack` (`id`, `nama_rak`) VALUES
(1, 'RAK 1A'),
(2, 'RAK 1B'),
(3, 'RAK 2C'),
(6, 'RAK 3F');

-- --------------------------------------------------------

--
-- Table structure for table `app_revisi`
--

CREATE TABLE `app_revisi` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `devisi` enum('Marketing','Engineering','Gudang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `username`, `password`, `devisi`) VALUES
(1, 'andi', '$2y$10$04wF4N8HQQbQYI5pNxCWFOK/AwVD7DllLc9an1ebO/pehyoUPnDOO', 'Marketing'),
(2, 'budi', '$2y$10$Vc0qrmsn1nBeyfgsuwJjp.iwP00eu5GvU01gJ7WjVmOUFfPKT5aY2', 'Engineering'),
(3, 'coki', '$2y$10$1pD7zlVZZp.y/frav485euFnjHJB3HVvLXGOWzBB1jERgb9OswPDq', 'Gudang'),
(4, 'dany', '$2y$10$GXsx.a0wNHChGl/RdbyII.zgzvlwlHR.igvMa2bqPufG5gMc2lsC6', 'Marketing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_jadi`
--
ALTER TABLE `app_jadi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_material`
--
ALTER TABLE `app_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_pesan_material`
--
ALTER TABLE `app_pesan_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_project`
--
ALTER TABLE `app_project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no` (`no`);

--
-- Indexes for table `app_rack`
--
ALTER TABLE `app_rack`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_rak` (`nama_rak`);

--
-- Indexes for table `app_revisi`
--
ALTER TABLE `app_revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_jadi`
--
ALTER TABLE `app_jadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_material`
--
ALTER TABLE `app_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_pesan_material`
--
ALTER TABLE `app_pesan_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_project`
--
ALTER TABLE `app_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `app_rack`
--
ALTER TABLE `app_rack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `app_revisi`
--
ALTER TABLE `app_revisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
