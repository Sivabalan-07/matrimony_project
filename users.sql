-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 08:13 AM
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
-- Database: `matrimony`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','others','') NOT NULL,
  `religion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `dob`, `gender`, `religion`) VALUES
(1, 'siva', 's@gmail.com', '$2y$10$BQW/f.jocQQS4RpSE2DH0ePPg9pmC0PJ/A8zIn0x3jRIO/K92c7xC', '2004-02-07', 'male', 'hindu'),
(2, 'sivabalan', 'nagarajans7224@gmail.com', '$2y$10$0bbYU6hgSzgsNqZpQn9gu.ziUdCovre7hnakonX8T7QhuWSMtQxI6', '2004-02-07', 'male', 'hindu'),
(4, 'sridhar', 'sri@gmail.com', '$2y$10$IeDwom/B7zxMNP38LRAf5.gEm3djcJZxuRaFRgko05H5bfB6JNAnO', '2002-02-17', 'male', 'hindu'),
(5, 'arul', 'a@gmail.com', '$2y$10$xA172Xza1FaczZPj32L6m.LAlJT4BljoPqlWUjsmZZe.yfD3dE5Tm', '2024-06-05', 'male', 'hindu'),
(6, 'vigenshwaran', 'vicky@gmail.com', '$2y$10$eAJVs69tFqvq7t3altkPVuhUQJbiEMcJY0McSyBlqO3JDM6iIAgB6', '2024-07-06', 'male', 'hindu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
