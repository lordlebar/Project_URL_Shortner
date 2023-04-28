-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2023 at 04:15 PM
-- Server version: 10.5.18-MariaDB-0+deb11u1
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ACQTX`
--

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`email`, `token`, `created`) VALUES
('brice_dumont@outlook.fr', '9e4ea6640c5df23497b8ed2751055289', '2023-01-22 21:31:56'),
('coco@coco.fr', 'f7dc735509a63ba9c56ffb24fe28ba13', '2023-01-23 17:06:05'),
('karimsalhi.contact@gmail.com', 'adfe88e17e082ba3ca858c6f1d351f8c', '2023-01-24 13:19:38'),
('papadiawara@hotmail.fr', 'd1e7def5b62322807ec02dabc9e7b2f5', '2023-01-24 13:20:55'),
('yacine.tazdait@epita.fr', 'a290fc0f5af4a11a3c8b550f5654b53c', '2023-01-24 13:21:16'),
('cotiphuong001@gmail.com', 'ee62163d9b462bad4f0b3d646d23ec15', '2023-01-24 13:21:42'),
('tony.blard@epita.fr', 'ae1a6d28a470d55f552067c2023b21db', '2023-01-24 13:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `short_url` varchar(255) NOT NULL,
  `long_url` text NOT NULL,
  `nb_click` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `email`, `short_url`, `long_url`, `nb_click`) VALUES
(485, NULL, '064OrQ8', 'http://corentin.lebarilier.13h37.io/21a4e09', 0),
(489, NULL, 'C7NIPxe', 'http://Salut Corentin', 1),
(492, NULL, 'ngiYTWA', 'https://www.youtube.com/channel/UCPHr0acsBghrjXCTEQDyuCw', 0),
(495, 'corentin@admin.fr', 'google67', 'https://www.google.com/', 1),
(498, NULL, 'yX3bYme', 'https://github.com/mithy45/Project_URL_Shortner', 0),
(499, 'admin@admin.fr', 'IzofD7h', 'https://www.youtube.com/', 1),
(500, 'admin@admin.fr', 'yXltaQJ', 'http://www.google.com', 0),
(501, 'admin@admin.fr', '79fJbsQ', 'https://github.com/mithy45/Project_URL_Shortner', 0),
(502, 'admin@admin.fr', 'HDqGu0S', 'http://tamere', 0),
(503, 'admin@admin.fr', 'zJs8e1X', 'http://tata', 0),
(504, 'admin@admin.fr', 'Tp8yYs6', 'https://www.youtube.com/channel/UCPHr0acsBghrjXCTEQDyuCw', 1),
(505, 'admin@admin.fr', 'mpVbgAY', 'http://corentin.lebarilier.13h37.io/21a4e09', 1),
(506, NULL, 'oySsuRe', 'https://www.youtube.com/', 1),
(507, NULL, 'lyFVDIN', 'http://corentin.lebarilier.13h37.io/Project_URL_Shortner/', 1),
(508, NULL, 'iHObgUp', 'https://www.fnac.com/Informatique/shi48966/w-4#bl=MMinfo', 1),
(509, 'papadiawara@hotmail.fr', 'twt', 'https://twitter.com/home', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `is_verified`) VALUES
(278, 'rjijiGT', 'brice_dumont@outlook.fr', '$2y$10$TqqSQfi5W.8tolFHlEwv2ulRR9F1HK.KqTScF5FnrELQsX7oO.6w.', 0, 1),
(282, 'Admin', 'admin@admin.fr', '$2y$10$BP.OXy.FFgJg7asd6Cv82OjlmpFZS/c3sFz2nbsHYDT1I2EFUVFnW', 1, 1),
(283, 'Corentin', 'corentin@admin.fr', '$2y$10$BP.OXy.FFgJg7asd6Cv82OjlmpFZS/c3sFz2nbsHYDT1I2EFUVFnW', 1, 1),
(288, 'Corentin', 'coco@coco.fr', '$2y$10$fAoBYrtL31zloN1s5Ju/Tu8Zzp7jqpYYmhjVUtTLYt7tZW2SWLQWC', 0, 1),
(289, 'Corentin', 'corentin.lebarilier@gmail.com', '$2y$10$.7EKKdMhcKmEjXlVjaCw6.3ozyGihDENFsvCswFqMDb42..btvTuK', 0, 1),
(290, 'karim', 'karimsalhi.contact@gmail.com', '$2y$10$6LOIPWDMmRySYVWbFh4AQOXa4Vj1KEjl5eMFGiLbb/5T5cRvbCBGK', 0, 1),
(291, 'pape1', 'papadiawara@hotmail.fr', '$2y$10$Kne6qia2ZigXHovgUYBsouQHxDvYb78WY8SFP3JmXeePog.gCLRgy', 0, 1),
(292, 'Tazdait', 'yacine.tazdait@epita.fr', '$2y$10$YXZnEc7shWvck2jR0hGNju7Sw30n6OvQ755HyNwuQ4yGJt3.aRfx6', 0, 1),
(293, 'phuc', 'cotiphuong001@gmail.com', '$2y$10$Sn8mX/qNweXeYcf8D0KjNuxGYZnuoK/0eNbYi4KsKmoonBo9x3KDS', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
