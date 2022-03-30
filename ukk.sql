-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 02:28 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `content` text NOT NULL,
  `image` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `tweet_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `image`, `file`, `tweet_id`, `user_id`, `tags`) VALUES
(15, 'aaaaa ', NULL, NULL, 20, 1, 'kk ,aaaaaaaa'),
(16, 'bbbbbbbb ', NULL, NULL, 22, 1, 'b ,nnnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(255) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`) VALUES
(47, 'a '),
(48, 'b '),
(49, 'c'),
(50, 'd'),
(52, 'nnnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(255) NOT NULL,
  `content` text NOT NULL,
  `image` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `content`, `image`, `file`, `user_id`, `tags`) VALUES
(22, 'aaaaaaaa ', NULL, NULL, 1, 'bbbbbbbb'),
(23, 'bbbbb ', NULL, NULL, 1, 'h'),
(25, 'test ', NULL, NULL, 1, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `bio` text DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `bio`, `image`) VALUES
(1, 'user', 'user@gmail.com', '$2a$12$zYqWCY88V8JpgOqHvlA1ZOdOSfmoQPR5q/KCvHuL2lrmTp/OZcEFW', 'lorem', '1648622277.jpg'),
(2, 'Erick', 'erick@gmail.com', '$2y$10$lwyRU2vtQFMM9NsQ0qBswOMdAIMx1iNgdxATQmN8o3J5xc2JQ3fDi', NULL, NULL),
(9, 'aaa', 'aaa@gmail.com', '$2y$10$rXa6qUykiu5g4rR4nWg1JuKg3./TVNBb4BPtswgKlGXaqyWo7nv.S', NULL, NULL),
(10, 'aaa', 'aaa@gmial,', '$2y$10$2mPu6CxIfUDAf0tMLV0b7.5kgOu8aF9NxaiYsjYS8tVow2NaJJGpa', NULL, NULL),
(11, 'm@gmail.com', 'm@gmail.com', '$2y$10$9pI/fxeccHfs8Lv9cM.sHOeXNItvYf3Ut8xkz.IAaooZfs6LaA1X6', NULL, NULL),
(12, 'ttt', 'ttt@gmail.com', '$2y$10$mddITc7WUHt8ODbB3pVqFOvTV2M2aYLI94EPeNAojWe8CaCgLZOuq', NULL, NULL),
(13, 'evo@gmail.com', 'evo@gmail.com', '$2y$10$8u.Yp4WBu1aMx3pKvA9jAekLKmk/rQver9TTXyDlJwikNyz11dz2i', 'j', '1648623585.jpg'),
(14, 'Erick', 'erickk@gmail.com', '$2y$10$BiD8AWMeoYpzTsbYI6oIteLFporDpTAmi3015LVoypT6c3.UhRmey', 'test', '1648625306.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
