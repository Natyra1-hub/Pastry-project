-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 10:35 PM
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
(1, 'CROISSANT WITH ICE CREAM', 'Indulge in the perfect treat with Croissant with Ice Cream...', 1.49, 'offerspage/1.png'),
(2, 'COFFEE MACAROONS', 'Enjoy the perfect bite with Coffee Macaroons...', 4.49, 'offerspage/2.png'),
(3, 'ICE CREAM AND FRENCH TOAST', 'Indulge in the ultimate sweet treat...', 1.49, 'offerspage/3.png'),
(4, 'Tiramisu', 'An Italian favorite with layers of coffee-soaked ladyfingers...', 7.49, 'offerspage/4.png'),
(5, 'TEA WITH BISCUIT', 'Tea with Biscuit is a simple yet comforting combination...', 1.49, 'offerspage/5.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
