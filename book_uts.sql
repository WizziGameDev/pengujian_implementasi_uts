-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 10, 2025 at 09:57 PM
-- Server version: 8.1.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_uts`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `year` int NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `category`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', 2005, 'Novel'),
(2, 'Negeri 5 Menara', 'Ahmad Fuadi', 2009, 'Novel'),
(3, 'Bumi Manusia', 'Pramoedya Ananta Toer', 1980, 'Sejarah'),
(4, 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 2004, 'Religi'),
(5, 'Filosofi Teras', 'Henry Manampiring', 2018, 'Pengembangan Diri'),
(6, 'Atomic Habits', 'James Clear', 2018, 'Motivasi'),
(7, 'Sapiens', 'Yuval Noah Harari', 2011, 'Sejarah'),
(8, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 1997, 'Keuangan'),
(9, 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', 2016, 'Psikologi'),
(10, 'Think and Grow Rich', 'Napoleon Hill', 1937, 'Bisnis'),
(11, 'test update', 'test', 2023, 'Shoes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$D9O9KhbJzC1EosfKbztuV.FuScQ8F8JzQORgU4OQf9HL71JYFG07i', 'admin'),
(2, 'adam', 'adam@student.com', '$2y$10$nR./xYDy3EsyixMSeT1/E./GNNkPDYi5m0SSaJreGuQ3W4JSe1Q5.', 'user'),
(4, 'adminbook', 'admin@admin.com', '$2y$10$jJ2zSL/7m2KVnUN3z8/6ROz5XRb0MIa7COBqT7TSU5YodTSm23pi2', 'admin'),
(5, 'bangadmin', 'adam@admin.com', '$2y$10$M9Vwj6jN0sxZ7A8HN7ANSOndnhbTQ/CFxKylvH389LN.Yh49lIOoC', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
