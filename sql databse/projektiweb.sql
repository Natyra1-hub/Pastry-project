-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 12:58 AM
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
(1, '2a50bfb2cdf2c39fe085dcad591cfc96.jpg'),
(2, '9a4bb6b30038787264a61199bc5820df.jpg'),
(3, '34d57f0ba5f44ce4c893100aa8bd41b4.jpg'),
(4, '40f990477891f278439e530735ebd6d4.jpg'),
(5, 'd0e55363394c4f91c47c7e947bdbe6cb.jpg'),
(6, 'f669b1a4181462011ca30742ea0e241e.jpg'),
(7, '98c30780601eccd6796affe9582efb3a.jpg'),
(8, '0118ea03e338268f6b30ea9d08189392.jpg');

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
(1, 'Strawberry Dream Panna Cotta', 'A creamy vanilla panna cotta with fresh strawberry sauce.', 20.00, '3c5074ca3ee53693117c6821fcaeeb38.jpg'),
(2, 'Strawberry Cheesecake', 'Smooth cream cheese filling over a buttery biscuit base.', 20.00, '887efef5f98cdbd3096c083b6e060965.jpg'),
(3, 'Strawberry Cream Roll', 'Light sponge cake filled with smooth vanilla cream.', 20.00, '7592f63569bd1843c6d80d929ad4a3e7.jpg'),
(4, 'Strawberry & Whipped Cream Cake', 'Soft vanilla sponge with fluffy whipped cream layers.', 20.00, 'c334c7df3cbcfc399d24dba517d1853c.jpg'),
(5, 'White Chocolate Raspberry', 'Traditional red velvet with vanilla-mascarpone cream.', 20.00, 'd312dbb215ff5b2e6497e4f1fa5f0a45.jpg'),
(6, 'Pink Chocolate Cake', 'Moist chocolate cake with delicate pink frosting.', 20.00, 'fc30d87d3c662cd522993234b5323994.jpg'),
(7, 'Cherry Chip Sponge Cake', 'Sponge cake with sweet cherry chips and almond whip.', 20.00, 'd0bee7e73ff3cd54e30c86728ddd5fbd.jpg'),
(8, 'Strawberry Chocolate Cake', 'Chocolate sponge layered with fresh strawberries.', 20.00, '642517be65141ddc1e1a9c3f2012280f.jpg'),
(9, 'Test Cake', 'Pershkrim test', 20.00, 'download.png');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `pershkrimi` text DEFAULT NULL,
  `cmimi` decimal(10,2) NOT NULL,
  `imazhi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `emri`, `pershkrimi`, `cmimi`, `imazhi`) VALUES
(1, 'CROISSANT WITH ICE CREAM', 'Indulge in the perfect treat with Croissant with Ice Cream...', 1.49, '1.png'),
(2, 'COFFEE MACAROONS', 'Enjoy the perfect bite with Coffee Macaroons...', 4.49, '2.png'),
(3, 'ICE CREAM AND FRENCH TOAST', 'Indulge in the ultimate sweet treat...', 1.49, '3.png'),
(4, 'Tiramisu', 'An Italian favorite with layers of coffee-soaked ladyfingers...', 7.49, '4.png'),
(5, 'TEA WITH BISCUIT', 'Tea with Biscuit is a simple yet comforting combination...', 1.49, '5.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `madhesia` varchar(50) DEFAULT NULL,
  `shija_biskotes` varchar(100) DEFAULT NULL,
  `mbushja` varchar(100) DEFAULT NULL,
  `mbishkrimi` varchar(255) DEFAULT NULL,
  `cmimi` decimal(10,2) DEFAULT NULL,
  `data_porosise` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `madhesia`, `shija_biskotes`, `mbushja`, `mbishkrimi`, `cmimi`, `data_porosise`) VALUES
(1, '20', 'vanilje', 'krem-vanilje', '', 65.00, '2026-01-31 09:23:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birthday_cakes`
--
ALTER TABLE `birthday_cakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birthday_cakes`
--
ALTER TABLE `birthday_cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
