-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 08:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ingredients` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `ingredients`, `image`, `created_by`, `created_at`) VALUES
(1, 'Strawberry Surprise', 'Soft vanilla cake with fresh strawberry filling and vanilla buttercream.', '<h2>For the Vanilla Cake</h2>\r\n   <ul>\r\n     <li>2 ½ cups (315 g) all-purpose flour</li>\r\n     <li>2 ½ tsp baking powder</li>\r\n     <li>½ tsp salt</li>\r\n     <li>1 ½ cups (300 g) sugar</li>\r\n     <li>¾ cup (170 g) unsalted butter, room temperature</li>\r\n     <li>4 large eggs</li>\r\n     <li>1 cup (240 ml) milk</li>\r\n     <li>2 tsp vanilla extract</li>\r\n   </ul>\r\n   <h2>For the Strawberry Filling</h2>\r\n   <ul>\r\n     <li>400 g fresh strawberries, chopped</li>\r\n     <li>⅓ cup (70 g) sugar</li>\r\n     <li>1 tbsp lemon juice</li>\r\n     <li>1 tbsp cornstarch + 2 tbsp water</li>\r\n   </ul>\r\n   <h2>For the Vanilla Buttercream</h2>\r\n   <ul>\r\n     <li>1 ½ cups (340 g) unsalted butter, room temperature</li>\r\n     <li>4 cups (480 g) powdered sugar</li>\r\n     <li>2–3 tbsp heavy cream or milk</li>\r\n     <li>2 tsp vanilla extract</li>\r\n   </ul>', 'homepage/photo3.jpg', 2, '2026-02-01 17:37:54'),
(3, 'Red Velvet', 'Classic Red Velvet cake with cream cheese frosting and optional strawberry filling.', '<h2>For the Red Velvet Cake</h2>\r\n   <ul>\r\n     <li>2 ½ cups (315 g) all-purpose flour</li>\r\n     <li>2 tbsp cocoa powder</li>\r\n     <li>1 ½ cups (300 g) sugar</li>\r\n     <li>1 tsp baking soda</li>\r\n     <li>1 tsp salt</li>\r\n     <li>2 large eggs</li>\r\n     <li>1 cup (240 ml) vegetable oil</li>\r\n     <li>1 cup (240 ml) buttermilk</li>\r\n     <li>2 tbsp red food coloring</li>\r\n     <li>1 tsp vanilla extract</li>\r\n     <li>1 tsp white vinegar</li>\r\n   </ul>\r\n   <h2>For the Cream Cheese Frosting</h2>\r\n   <ul>\r\n     <li>500 g cream cheese, room temperature</li>\r\n     <li>1 cup (225 g) unsalted butter, room temperature</li>\r\n     <li>3 cups (360 g) powdered sugar</li>\r\n     <li>2 tsp vanilla extract</li>\r\n   </ul>\r\n   <h2>For the Strawberry Filling (optional but recommended)</h2>\r\n   <ul>\r\n     <li>300 g strawberries, chopped</li>\r\n     <li>2–3 tbsp sugar</li>\r\n     <li>1 tsp lemon juice</li>\r\n   </ul>', 'homepage/photo2.jpg', 2, '2026-02-01 18:13:18'),
(4, 'Raspberry Rose', 'Delicate vanilla cake with raspberry filling and raspberry drip ganache.', '<h2>For the Vanilla Cake</h2>\r\n   <ul>\r\n     <li>2 ½ cups (315 g) all-purpose flour</li>\r\n     <li>2 ½ tsp baking powder</li>\r\n     <li>½ tsp salt</li>\r\n     <li>1 ½ cups (300 g) sugar</li>\r\n     <li>¾ cup (170 g) unsalted butter, room temperature</li>\r\n     <li>4 large eggs</li>\r\n     <li>1 cup (240 ml) milk</li>\r\n     <li>2 tsp vanilla extract</li>\r\n   </ul>\r\n   <h2>For the Raspberry Filling</h2>\r\n   <ul>\r\n     <li>400 g fresh raspberries (or mixed berries), chopped</li>\r\n     <li>⅓ cup (70 g) sugar</li>\r\n     <li>1 tbsp lemon juice</li>\r\n     <li>1 tbsp cornstarch + 2 tbsp water</li>\r\n   </ul>\r\n   <h2>For the Raspberry Drip Ganache</h2>\r\n   <ul>\r\n     <li>½ cup (120 ml) heavy cream</li>\r\n     <li>½ cup (90 g) fresh raspberries</li>\r\n     <li>100 g white chocolate</li>\r\n   </ul>', 'homepage/photo8.jpg', 2, '2026-02-01 18:14:12'),
(5, 'Fruity Dream', 'Cheesecake with a fruity topping, creamy filling, and a graham cracker crust.', '<h2>For the Cheesecake Crust</h2>\r\n   <ul>\r\n     <li>1 ½ cups (150 g) graham cracker crumbs (or crushed cookies)</li>\r\n     <li>⅓ cup (70 g) unsalted butter, melted</li>\r\n     <li>2 tbsp sugar</li>\r\n   </ul>\r\n   <h2>For the Cheesecake Filling</h2>\r\n   <ul>\r\n     <li>500 g cream cheese, room temperature</li>\r\n     <li>1 cup (200 g) sugar</li>\r\n     <li>3 large eggs</li>\r\n     <li>1 tsp vanilla extract</li>\r\n     <li>½ cup (120 ml) sour cream or heavy cream</li>\r\n   </ul>\r\n   <h2>For the Fruit Topping</h2>\r\n   <ul>\r\n     <li>400 g fresh or frozen fruits (berries, cherries, mango, or mixed fruits)</li>\r\n     <li>⅓ cup (70 g) sugar</li>\r\n     <li>1 tbsp lemon juice</li>\r\n     <li>1 tbsp cornstarch + 2 tbsp water</li>\r\n   </ul>', 'homepage/photo10.jpg', 2, '2026-02-01 18:15:06'),
(6, 'Cherry Chocolate Delight', 'Rich chocolate cake with cherry flavor, chocolate ganache, and fresh cherries for decoration.', '<h2>For the Cherry Chocolate Cake</h2>\r\n   <ul>\r\n     <li>1 ¾ cups (220 g) all-purpose flour</li>\r\n     <li>¾ cup (75 g) cocoa powder</li>\r\n     <li>2 cups (400 g) sugar</li>\r\n     <li>1 ½ tsp baking powder</li>\r\n     <li>1 ½ tsp baking soda</li>\r\n     <li>1 tsp salt</li>\r\n     <li>2 large eggs</li>\r\n     <li>1 cup (240 ml) milk</li>\r\n     <li>½ cup (120 ml) vegetable oil</li>\r\n     <li>2 tsp vanilla extract</li>\r\n     <li>1 cup (240 ml) hot water or hot coffee</li>\r\n   </ul>\r\n   <h2>For the Chocolate Ganache (Drip & Filling)</h2>\r\n   <ul>\r\n     <li>1 cup (240 ml) heavy cream</li>\r\n     <li>200 g dark chocolate, chopped</li>\r\n   </ul>\r\n   <h2>For Decoration</h2>\r\n   <ul>\r\n     <li>Fresh cherries with stems</li>\r\n     <li>Powdered sugar (for dusting)</li>\r\n   </ul>', 'homepage/photo9.jpg', 2, '2026-02-01 18:16:55'),
(7, 'Cherry Kiss', 'Delicious vanilla cake with cherry filling and cherry glaze drip.', '<h2>For the Vanilla Cake</h2>\r\n   <ul>\r\n     <li>2 ½ cups (315 g) all-purpose flour</li>\r\n     <li>2 ½ tsp baking powder</li>\r\n     <li>½ tsp salt</li>\r\n     <li>1 ½ cups (300 g) sugar</li>\r\n     <li>¾ cup (170 g) unsalted butter, room temperature</li>\r\n     <li>4 large eggs</li>\r\n     <li>1 cup (240 ml) milk</li>\r\n     <li>2 tsp vanilla extract</li>\r\n   </ul>\r\n   <h2>For the Cherry Filling</h2>\r\n   <ul>\r\n     <li>400 g fresh or frozen cherries, pitted and chopped</li>\r\n     <li>⅓ cup (70 g) sugar</li>\r\n     <li>1 tbsp lemon juice</li>\r\n     <li>1 tbsp cornstarch + 2 tbsp water</li>\r\n   </ul>\r\n   <h2>For the Cherry Glaze Drip</h2>\r\n   <ul>\r\n     <li>½ cup (120 ml) cherry juice or cherry syrup</li>\r\n     <li>2 tbsp sugar</li>\r\n     <li>1 tsp cornstarch</li>\r\n   </ul>', 'homepage/photo4.jpg', 2, '2026-02-01 18:18:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
