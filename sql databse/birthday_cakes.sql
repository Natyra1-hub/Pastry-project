-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 10:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday_cakes`
--

CREATE TABLE `birthday_cakes` (
  `id` int(11) NOT NULL,
  `imazhi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birthday_cakes`
--

INSERT INTO `birthday_cakes` (`id`, `imazhi`) VALUES
(1, 'photocakes/2a50bfb2cdf2c39fe085dcad591cfc96.jpg'),
(2, 'photocakes/9a4bb6b30038787264a61199bc5820df.jpg'),
(3, 'photocakes/34d57f0ba5f44ce4c893100aa8bd41b4.jpg'),
(4, 'photocakes/40f990477891f278439e530735ebd6d4.jpg'),
(5, 'photocakes/d0e55363394c4f91c47c7e947bdbe6cb.jpg'),
(6, 'photocakes/f669b1a4181462011ca30742ea0e241e.jpg'),
(7, 'photocakes/98c30780601eccd6796affe9582efb3a.jpg'),
(8, 'photocakes/0118ea03e338268f6b30ea9d08189392.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birthday_cakes`
--
ALTER TABLE `birthday_cakes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birthday_cakes`
--
ALTER TABLE `birthday_cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
