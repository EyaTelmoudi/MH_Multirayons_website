-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 26 déc. 2024 à 19:57
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project-societemh`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins_logs`
--

DROP TABLE IF EXISTS `admins_logs`;
CREATE TABLE IF NOT EXISTS `admins_logs` (
  `id` int NOT NULL,
  `admin_id` int NOT NULL,
  `action` text NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  KEY `FK_cart_users` (`user_id`),
  KEY `FK_cart_products` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','shipped','delivered','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orders_users` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`) VALUES
(3, 19, 1580.00, 'delivered', '2024-12-21 18:44:46'),
(4, 19, 1680.00, 'pending', '2024-12-21 18:52:26'),
(5, 19, 2160.00, 'pending', '2024-12-21 18:55:36'),
(6, 19, 500.00, 'pending', '2024-12-21 19:05:01'),
(7, 22, 4740.00, 'pending', '2024-12-25 13:30:02'),
(8, 22, 500.00, 'pending', '2024-12-25 13:34:56'),
(9, 22, 3080.00, 'pending', '2024-12-25 15:56:38'),
(10, 22, 1500.00, 'pending', '2024-12-25 17:19:26'),
(11, 22, 1500.00, 'pending', '2024-12-25 17:54:51'),
(12, 21, 3000.00, 'pending', '2024-12-25 20:46:49'),
(13, 21, 1500.00, 'pending', '2024-12-25 20:47:33'),
(14, 22, 1500.00, 'pending', '2024-12-25 21:16:27'),
(15, 21, 1500.00, 'pending', '2024-12-25 23:26:59'),
(16, 21, 1500.00, 'pending', '2024-12-25 23:41:34'),
(17, 25, 4299.96, 'pending', '2024-12-26 00:04:22'),
(18, 25, 5799.97, 'pending', '2024-12-26 00:11:10');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_items_orders` (`order_id`),
  KEY `FK_order_items_products` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=372 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(347, 4, 3, 1, 80.00),
(345, 3, 3, 1, 80.00),
(346, 3, 2, 1, 1500.00),
(348, 4, 2, 1, 1500.00),
(349, 4, 4, 1, 100.00),
(350, 5, 3, 2, 80.00),
(351, 5, 2, 1, 1500.00),
(352, 5, 1, 1, 500.00),
(353, 6, 1, 1, 500.00),
(354, 7, 3, 3, 80.00),
(355, 7, 1, 3, 500.00),
(356, 7, 2, 2, 1500.00),
(357, 8, 1, 1, 500.00),
(358, 9, 2, 2, 1500.00),
(359, 9, 3, 1, 80.00),
(360, 10, 2, 1, 1500.00),
(361, 11, 2, 1, 1500.00),
(362, 12, 2, 2, 1500.00),
(363, 13, 2, 1, 1500.00),
(364, 14, 2, 1, 1500.00),
(365, 15, 2, 1, 1500.00),
(366, 16, 2, 1, 1500.00),
(367, 17, 13, 1, 1999.99),
(368, 17, 24, 1, 899.99),
(369, 17, 15, 2, 699.99),
(370, 18, 19, 2, 899.99),
(371, 18, 17, 1, 3999.99);

--
-- Déclencheurs `order_items`
--
DROP TRIGGER IF EXISTS `update_order_total_price`;
DELIMITER $$
CREATE TRIGGER `update_order_total_price` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
    DECLARE total DECIMAL(10, 2);

    SELECT SUM(price * quantity) INTO total
    FROM order_items
    WHERE order_id = NEW.order_id;

    UPDATE orders
    SET total_price = total
    WHERE id = NEW.order_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_products_categories` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `category_id`, `created_at`) VALUES
(13, 'Samsung Family Hub RS68A8841SL', 'Réfrigérateur connecté avec écran tactile, capacité de 617L, technologie No Frost, et distributeur d\'eau.', 1999.99, 10, 'samsung_fridge.PNG', 0, '0000-00-00 00:00:00'),
(14, 'LG InstaView Door-in-Door', 'Réfrigérateur double porte avec panneau InstaView, stockage intelligent, et compresseur linéaire.', 2499.00, 8, 'LG InstaView Door-in-Door.PNG', 0, '0000-00-00 00:00:00'),
(15, 'Haier HCE519R', 'Congélateur coffre 519L avec technologie Super Freeze pour une congélation rapide.', 699.99, 15, 'Haier HCE519R.PNG', 0, '0000-00-00 00:00:00'),
(16, 'Whirlpool WZC5422DW', 'Congélateur coffre 400L avec éclairage intérieur et serrure de sécurité.', 549.99, 12, 'Whirlpool WZC5422DW.PNG', 0, '0000-00-00 00:00:00'),
(17, 'Samsung Neo QLED 8K QN900C', 'Téléviseur 8K Ultra HD avec technologie Quantum Mini LED, HDR10+, et processeur Neural Quantum.', 3999.99, 5, 'Samsung Neo QLED 8K QN900C.PNG', 0, '0000-00-00 00:00:00'),
(18, 'LG OLED evo G3', 'Téléviseur 4K OLED avec luminosité améliorée, Dolby Vision, et technologie AI Sound Pro.', 3499.00, 7, 'LG OLED evo G3.PNG', 0, '0000-00-00 00:00:00'),
(19, 'Bosch PXE651FC1E', 'Plaque de cuisson à induction 4 zones avec PerfectFry, minuterie, et détection automatique.', 899.99, 10, 'Bosch PXE651FC1E.PNG', 0, '0000-00-00 00:00:00'),
(20, 'Siemens EX875LEC1E', 'Plaque de cuisson induction avec zones flexibles et commande tactile innovante.', 999.00, 8, 'Siemens EX875LEC1E.PNG', 0, '0000-00-00 00:00:00'),
(21, 'Samsung Dual Cook NV75K5571', 'Four encastrable avec technologie Dual Cook, nettoyage pyrolyse, et 75L.', 799.99, 12, 'Samsung Dual Cook NV75K5571.PNG', 0, '0000-00-00 00:00:00'),
(22, 'Bosch HBG6764S6', 'Four multifonction avec commandes tactiles, cuisson 4D, et fonction Home Connect.', 999.99, 6, 'Bosch HBG6764S6.PNG', 0, '0000-00-00 00:00:00'),
(24, 'Whirlpool Supreme Care FSCR10432', 'Machine à laver silencieuse avec moteur Zen, capacité 10kg, et fonction vapeur FreshCare . ', 899.99, 8, 'Whirlpool Supreme Care FSCR10432.PNG', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` tinyint NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `FK_reviews_products` (`product_id`),
  KEY `FK_reviews_users` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `role` enum('admin','client') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'wiem', 'wiem.sayeh@enis.tn', '$2y$10$1cVaX.utwctXG2vwZhVLQumDAEhWvU54D0fxsUz1NFfuPAGpXqDIO', '29681730', 'route sokra km4', 'admin', '2024-12-07 09:56:57'),
(2, 'aya', 'talmoudi@gmail.com', '$2y$10$OmBj9vspzSLl1IvVj1uWAOBGw.7ey1tVEQ9Z6XSviRg4leIjaSwJa', '25615223', 'route sokra km4', 'admin', '2024-12-07 09:58:02'),
(4, 'sayeh étudiante en génie informatique wiem', 'wiem.sayeh1@enis.tn', '$2y$10$MaPL3fks.9mhMkYtqplSTOVs16zzs6NX2eBHtMJ.FhLZVrORLrBCi', '29681730', 'route sokra km4', '', '2024-12-07 10:51:22'),
(5, 'aya', 'talmoudi12@gmail.com', '$2y$10$gYTdBZbY5ekIekF7K.9pT.cEBN7mevuke.FIr73DYAvKLEeza5HT2', '25615223', 'route sokra km4', '', '2024-12-07 11:04:44'),
(6, 'aya', 'talmoudi123@gmail.com', '$2y$10$R8f7QLguAFcfwBftsvvOmOr9Jm2iYbwV1lDNn4aa5A63PkcpIB9Na', '25615223', 'route sokra km4', '', '2024-12-07 11:05:32'),
(7, 'aya', 'talmoudia123@gmail.com', '$2y$10$ux5IEL1sq.7gKvoIt0mxIO3lbkeQnXnkqy5JYSB93fZI5q5ZMonoG', '25615223', 'route sokra km4', '', '2024-12-07 11:07:11'),
(8, 'aya', 'talmoudia1243@gmail.com', '$2y$10$CckWUrk1ARsoYku9krNthOm9j/TZBDDvgXUDeGIJYUJ1UbqsfHe..', '25615223', 'route sokra km4', '', '2024-12-07 11:12:20'),
(10, 'wiem sayeh', 'wiem.sayeh345@enis.tn', '$2y$10$nWqXrQDo4d0JqwSoD8B7fOilnPuTmRAFO7eh52XOrPe807qH6lC76', '29681730', 'route sokra km4', '', '2024-12-08 23:18:40'),
(11, 'wiem sayeh1', 'wiem.sayeh3454@enis.tn', '$2y$10$eKJUbxkunn.C/0ksmPZ89uFgva7Mb2rAXjHWA54yDP1jWdPYudLeu', '29681730', 'route sokra km4', '', '2024-12-08 23:19:37'),
(12, 'wiem sayeh1', 'wiem.sayeh3@enis.tn', '$2y$10$RxqAu.3WMyszSOGoW7rP6elr/mzlVHzsXrbWJexnYaT7cmW5lpKcq', '29681730', 'route sokra km4', '', '2024-12-09 07:35:06'),
(13, 'WIEM', 'M@gmail.com', '$2y$10$q3f/U6hNo3DUAUXRGPUZseZYZ6usJZO2dtue.6c9lah1Gb6KxShki', '25615223', 'route sokra km4', '', '2024-12-09 08:42:52'),
(14, 'WIEM', 'M1@gmail.com', '$2y$10$tLj6KUR6q9l7.RFTu0DFaeUa4HpyRxZ/IefJmwmEmqH3i/maEGnPe', '25615223', 'route sokra km4', '', '2024-12-13 11:15:27'),
(16, 'WIEM', 'M12@gmail.com', '$2y$10$O9zgillA2QCwXjvKUf2MYuLuxO6P01GslJIkdpl9GaZ3Dsqfw19Hy', '25615223', 'route sokra km4', '', '2024-12-13 21:39:45'),
(18, 'mohamed', 'mohamed@gmail.tn', '$2y$10$ZJuPV7skyjxNs8jx.uoAKumQCDSS64.VRvZt3DjymLpZ8R8a8hSbi', '29681730', 'route sokra km4', 'admin', '2024-12-13 22:59:35'),
(19, 'mohamed amine rajah', 'mohamed.amine@gmail.tn', '$2y$10$uP1X1Pyd5XHobWzyneTbd.pjDr4uGQ8ac/QvpFBFvyI7d1rrkbney', '51860088', 'Nahal Chenini gabes', '', '2024-12-21 15:32:16'),
(20, 'wiem sayeh', 'wiem@ieee.org', '$2y$10$wYU73I0IYUpb7toTGU26k.s6ZPu.4bx4haA2TAbjYcY06/mhLZmwK', '29681730', 'route sokra km4', '', '2024-12-21 15:51:32'),
(21, 'aya2', 'aya.telmoudi@enis.tn', '$2y$10$Mx.nxHOSISNN75a8uiiX/.mlIlRjfsjERPjdbMOPeikaLaKjpZchu', '25615223', '47 rue hidaya jara gabes', 'admin', '2024-12-25 07:43:01'),
(22, 'ayaUser', 'aya.user@gmail.com', '$2y$10$1q6Vca8cldrCXiHOOOJCyu3l1PyUT2iUJXdX7g5nQeeBlK0tKyPQa', '25615223', '47 rue hidaya jara gabes', '', '2024-12-25 12:35:15'),
(25, 'test ', 'test@gmail.com', '$2y$10$NriUOJ808cdfA7VMaGH1C.kPOE.Jlx.4khZRY9H6PZEqKVmxpxvWm', '25615223', '47 rue hidaya jara gabes', '', '2024-12-26 00:04:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
