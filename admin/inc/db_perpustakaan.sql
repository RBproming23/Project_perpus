-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 07:44 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(100) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `id_kategori` int(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `gambar` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `id_kategori`, `stock`, `gambar`, `keterangan`) VALUES
(1, 'sejarah 1', 1, 1, 'sejarah 1.jpg', 'buku sejarah kelas 10'),
(2, 'sejarah 2', 1, 1, 'sejarah 2.jpg', 'buku sejarah kelas 10 semester 2'),
(3, 'sejarah 3', 1, 1, 'sejarah 3.jpg', 'buku sejarah kelas 11 '),
(4, 'sejarah 4', 1, 1, 'sejarah 4.jpg', 'buku sejarah kelas 11 semester 2'),
(5, 'sejarah 5', 1, 1, 'sejarah 5.jpg', 'buku sejarah kelas 12'),
(6, 'ipa 1', 2, 1, 'ipa 1.jpg', 'buku ipa kelas 10'),
(7, 'ipa 2', 2, 1, 'ipa 2.jpg', 'buku ipa kelas 10 semester 2'),
(8, 'ipa 3', 2, 1, 'ipa 3.jpg', 'buku ipa  kelas 11'),
(9, 'ipa 4', 2, 1, 'ipa 4.jpg', 'buku sejarah kelas 11 semester 2'),
(10, 'ipa 5', 2, 1, 'ipa 5.jpg', 'buku sejarah kelas 12'),
(11, 'pkn 1', 3, 1, 'pkn 1.jpg', 'buku pkn kelas 10'),
(12, 'pkn 2', 3, 1, 'pkn 2.jpg', 'buku pkn kelas 10 semester 2'),
(13, 'pkn 3', 3, 1, 'pkn 3.jpg', 'buku pkn kelas 11 '),
(14, 'pkn 4', 3, 1, 'pkn 4.jpg', 'buk pkn kelas 11 semester 2'),
(15, 'pkn 5', 3, 1, 'pkn 5.jpg', 'buku pkn kelas 12'),
(16, 'bahasa 1', 4, 1, 'bahasa 1.jpg', 'buku bahasa kelas 10'),
(17, 'bahasa 2', 4, 1, 'bahasa 2.jpg', 'buku bahasa kelas 10 semester 2'),
(18, 'bahasa 3', 4, 1, 'bahasa 3.jpg', 'buku bahasa kelas 11'),
(19, 'bahasa 4', 4, 1, 'bahasa 4.jpg', 'buku bahasa kelas 11 semester 2'),
(20, 'bahasa 5', 4, 1, 'bahasa 5.jpg', 'buku bahasa kelas 12'),
(21, 'motivasi 1', 5, 1, 'motivasi 1.jpg', 'buku motivasi'),
(22, 'motivasi 2', 5, 1, 'motivasi 2.jpg', 'buku motivasi belajar'),
(23, 'motivasi 3', 5, 1, 'motivasi 3.jpg', 'buku motivasi giat belajar'),
(24, 'motivasi 4', 5, 1, 'motivasi 4.jpg', 'buku motivasi hidup'),
(25, 'motivasi 5', 5, 1, 'motivasi 5.jpg', 'buku motivasi sukses'),
(28, '', 1, 1, 'work.png', 'hehe');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'sejarah'),
(2, 'ipa'),
(3, 'pkn'),
(4, 'bahasa'),
(5, 'motivasi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_buku` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `status`) VALUES
(1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `NIS` int(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `NIS`, `nama_user`, `telepon`, `username`, `password`, `role`) VALUES
(1, 260919, 'admin', '081358260919', 'admin', 'fdfe3d5ec2e5b4de87192f089cb06f94', 1),
(2, 231103, 'reza', '081323456787', 'reza', 'fdfe3d5ec2e5b4de87192f089cb06f94', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
