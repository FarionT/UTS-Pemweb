-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 11:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngoding_cuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `tanggal`, `jam`, `id_post`, `id_user`) VALUES
(1, 'manteb bang kevin', '2022-10-09', '09:56:15', 1, 4),
(3, 'okee siap', '2022-10-09', '11:15:11', 1, 5),
(4, 'dapat hubungi saya jika ada pertanyaan', '2022-10-09', '11:21:02', 4, 5),
(7, 'test', '2022-10-11', '04:32:43', 4, 1),
(8, 'manteb', '2022-10-11', '04:33:11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likecomment`
--

CREATE TABLE `likecomment` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likecomment`
--

INSERT INTO `likecomment` (`id`, `id_comment`, `id_user`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `likepost`
--

CREATE TABLE `likepost` (
  `id` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likepost`
--

INSERT INTO `likepost` (`id`, `id_post`, `id_user`) VALUES
(12, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `konten` varchar(255) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `subject`, `konten`, `kategori`, `tanggal`, `jam`, `id_user`) VALUES
(1, 'Bahasa C', 'Bahasa C adalah bahasa yang direkomendasikan untuk dipelajari pertama kali sebelum masuk ke dunia pemograman.', 'C', '2022-10-09', '09:54:33', 3),
(3, 'Bahasa paling diminati', 'Python adalah bahasa yang paling diminati untuk masa sekarang.', 'Python', '2022-10-09', '11:03:02', 5),
(4, 'Menentukan Ganjil Genap di C', 'int a;\r\nif(a % 2 == 0) {\r\nprintf(\"Genap\");\r\nelse\r\nprintf(\"Ganjil\");\r\n\r\nTadi adalah code untuk menentukan ganijl dan genap', 'C', '2022-10-09', '11:17:14', 5),
(5, 'Bahasa yang fleksibel', 'Bahasa yang paling fleksibel adalah bahasa javascript.', 'Javascript', '2022-10-10', '12:23:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namadepan` varchar(30) NOT NULL,
  `namabelakang` varchar(30) DEFAULT NULL,
  `pekerjaan` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tanggallahir` date DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `tanggalban` date DEFAULT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `namadepan`, `namabelakang`, `pekerjaan`, `email`, `tanggallahir`, `role`, `tanggalban`, `profile`) VALUES
(1, 'admin', '$2y$10$Ushco4PQRYEmPV/o7WLtbOmHw0bjw.4AN8Oo3fi5kG8uy8/gotv2a', 'admin', NULL, 'Admin NgodingCoy', 'ngoding.coy@gmail.com', '2022-10-07', 'admin', NULL, 'profile/admin.png'),
(3, 'kevin', '$2y$10$Hx45In5F6QNykv3ae3U.GucPIc5aZ3bLhaRWBlKPMu44iNgn1BmTy', 'Kevin', 'Andrelia', 'Meminta Maaf', 'kevin.andreli@gmail.com', '2003-11-19', 'user', NULL, 'profile/conan.jpg'),
(4, 'yoga', '$2y$10$WyAR9J1xb4wIP3xE66KTDO3GpCmPDcR4tFuFiJi2MJFZgWz75R8n6', 'Pra Yoga', 'Wijaya', 'Baca Manga', 'pra.yoga@gmail.com', '2004-02-13', 'user', NULL, 'profile/default.png'),
(5, 'ivan', '$2y$10$1uXmdhyxTexVu2Og.aAsFuHOuI8yFwYR6r3ytmSzHv24iiWM4rbrC', 'Ivandy', 'Wijaya', 'Turu', 'ivandy.wijaya@gmail.com', '2003-09-20', 'user', NULL, 'profile/bambang.jfif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `likecomment`
--
ALTER TABLE `likecomment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comment` (`id_comment`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `likepost`
--
ALTER TABLE `likepost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `likecomment`
--
ALTER TABLE `likecomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likepost`
--
ALTER TABLE `likepost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `postingan` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `likecomment`
--
ALTER TABLE `likecomment`
  ADD CONSTRAINT `likecomment_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `likecomment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `likepost`
--
ALTER TABLE `likepost`
  ADD CONSTRAINT `likepost_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `postingan` (`id`),
  ADD CONSTRAINT `likepost_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `postingan`
--
ALTER TABLE `postingan`
  ADD CONSTRAINT `postingan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
