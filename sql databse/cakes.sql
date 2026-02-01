-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 10:36 PM
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
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `id` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `pershkrimi` text DEFAULT NULL,
  `cmimi` decimal(10,2) NOT NULL,
  `imazhi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`id`, `emri`, `pershkrimi`, `cmimi`, `imazhi`) VALUES
(1, 'Strawberry Dream Panna Cotta', 'A creamy vanilla panna cotta...', 40.00, 'photocakes/3c5074ca3ee53693117c6821fcaeeb38.jpg'),
(2, 'Strawberry Cheesecake', 'Smooth cream cheese filling...', 50.00, 'photocakes/887efef5f98cdbd3096c083b6e060965.jpg'),
(3, 'Strawberry Cream Roll', 'Light sponge cake filled...', 30.00, 'photocakes/7592f63569bd1843c6d80d929ad4a3e7.jpg'),
(4, 'Strawberry & Whipped Cream Cake', 'Soft vanilla sponge...', 20.00, 'photocakes/c334c7df3cbcfc399d24dba517d1853c.jpg'),
(5, 'White Chocolate Raspberry', 'Traditional red velvet...', 10.00, 'photocakes/d312dbb215ff5b2e6497e4f1fa5f0a45.jpg'),
(6, 'Pink Chocolate Cake', 'Moist chocolate cake...', 40.00, 'photocakes/fc30d87d3c662cd522993234b5323994.jpg'),
(7, 'Cherry Chip Sponge Cake', 'Sponge cake with sweet cherry chips...', 20.00, 'photocakes/d0bee7e73ff3cd54e30c86728ddd5fbd.jpg'),
(8, 'Strawberry Chocolate Cake', 'Chocolate sponge layered...', 20.00, 'photocakes/642517be65141ddc1e1a9c3f2012280f.jpg'),
(9, 'Test Cake', 'Pershkrim test', 20.00, 'photocakes/download.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
