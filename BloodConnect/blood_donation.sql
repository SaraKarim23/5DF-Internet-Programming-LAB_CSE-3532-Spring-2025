-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 09:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_donation`
--
CREATE DATABASE IF NOT EXISTS `blood_donation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blood_donation`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: May 02, 2025 at 02:28 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT DELAYED IGNORE INTO `users` (`id`, `name`, `email`, `password`, `phone`, `blood_group`, `area`, `age`, `gender`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$Xa.GKreucpZ/2dup1XrzdeDb658nDs1VHWy.rE/5oDyuFL0O7IUGS', NULL, NULL, NULL, NULL, NULL, 'admin', '2025-05-02 14:29:10'),
(2, 'Sadiya Jahan', 'sadiya.jahan.du@gmail.com', '$2y$10$WbjyRvPDRSwi089tgyvEge9bMihZqBt/kCFOmSB6.NB6f.pPdG5YG', '01871128772', 'O+', 'Dhaka', 29, 'Female', 'user', '2025-05-02 14:35:17'),
(3, 'Md. Shahriar Afaz', 'shahriyarctg@gmail.com', '$2y$10$ZviXJEG7drxNeUa.YY8QOeGDqZdYzhsCqwJJ3Mqgjxj51oBJ7kdIO', '01852374557', 'O+', 'Chattogram', 25, 'Male', 'user', '2025-05-02 14:43:04'),
(4, 'Shariful Islam', 'sharifulislam775@gmail.com', '$2y$10$4hY3oa98gS6nL3tvmueIguFbowk3gUH9qv.KQhvArsKtrFF1RzhG2', '01748666567', 'A+', 'Dhaka', 30, 'Male', 'user', '2025-05-02 14:46:58');


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table users
--
-- Error reading data for table phpmyadmin.pma__column_info: #1100 - Table &#039;pma__column_info&#039; was not locked with LOCK TABLES
-- Error reading data for table phpmyadmin.pma__table_uiprefs: #1100 - Table &#039;pma__table_uiprefs&#039; was not locked with LOCK TABLES
-- Error reading data for table phpmyadmin.pma__tracking: #1100 - Table &#039;pma__tracking&#039; was not locked with LOCK TABLES

--
-- Metadata for database blood_donation
--
-- Error reading data for table phpmyadmin.pma__bookmark: #1100 - Table &#039;pma__bookmark&#039; was not locked with LOCK TABLES
-- Error reading data for table phpmyadmin.pma__relation: #1100 - Table &#039;pma__relation&#039; was not locked with LOCK TABLES
-- Error reading data for table phpmyadmin.pma__savedsearches: #1100 - Table &#039;pma__savedsearches&#039; was not locked with LOCK TABLES
-- Error reading data for table phpmyadmin.pma__central_columns: #1100 - Table &#039;pma__central_columns&#039; was not locked with LOCK TABLES
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
