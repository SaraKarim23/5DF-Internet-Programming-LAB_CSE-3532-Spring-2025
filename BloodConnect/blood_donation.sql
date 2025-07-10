-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2025 at 08:47 PM
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
-- Database: `blood_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `units_needed` int(11) NOT NULL,
  `urgency` enum('Normal','Urgent') NOT NULL DEFAULT 'Normal',
  `contact_number` varchar(20) NOT NULL,
  `status` enum('Active','Fulfilled','Closed') NOT NULL DEFAULT 'Active',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `user_id`, `patient_name`, `hospital`, `blood_group`, `units_needed`, `urgency`, `contact_number`, `status`, `request_date`) VALUES
(1, 3, 'Jamil Hasan', 'Metropolitan hospital', 'A+', 2, 'Urgent', '01888556644', 'Fulfilled', '2025-07-08 18:06:18'),
(2, 5, 'Jamil Hasan', 'Metropolitan hospital', 'A+', 2, 'Urgent', '01888556644', 'Active', '2025-07-08 18:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `camps`
--

CREATE TABLE `camps` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `camp_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camps`
--

INSERT INTO `camps` (`id`, `title`, `description`, `organizer`, `location`, `camp_date`, `start_time`, `end_time`, `contact_info`, `created_at`) VALUES
(1, 'Free Blood Donation - Ukhiya', 'Metropolitan Hospital arranged a free blood donation camp in ukhiya, cox\'s bazar', 'Metropolitan Hospital', 'Gec, Chittagong', '2025-07-09', '10:00:00', '17:00:00', '01855667788', '2025-07-08 18:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donation_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `user_id`, `donation_date`, `location`) VALUES
(1, 4, '2025-07-09', 'Metropolitan Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `blood_group`, `area`, `age`, `gender`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$Xa.GKreucpZ/2dup1XrzdeDb658nDs1VHWy.rE/5oDyuFL0O7IUGS', NULL, NULL, NULL, NULL, NULL, 'admin', '2025-05-02 14:29:10'),
(2, 'Sadiya Jahan', 'sadiya.jahan.du@gmail.com', '$2y$10$WbjyRvPDRSwi089tgyvEge9bMihZqBt/kCFOmSB6.NB6f.pPdG5YG', '01871128772', 'O+', 'Dhaka', 29, 'Female', 'user', '2025-05-02 14:35:17'),
(3, 'Md. Shahriar Afaz', 'shahriyarctg@gmail.com', '$2y$10$ZviXJEG7drxNeUa.YY8QOeGDqZdYzhsCqwJJ3Mqgjxj51oBJ7kdIO', '01852374557', 'O+', 'Chattogram', 25, 'Male', 'user', '2025-05-02 14:43:04'),
(4, 'Shariful Islam', 'sharifulislam775@gmail.com', '$2y$10$4hY3oa98gS6nL3tvmueIguFbowk3gUH9qv.KQhvArsKtrFF1RzhG2', '01748666567', 'A+', 'Dhaka', 30, 'Male', 'user', '2025-05-02 14:46:58'),
(5, 'Sharmin Akter', 'sharminlaboni1337@gmail.com', '$2y$10$WQrkflPN1kyaebU51Zcsx.1My2fK6A1IlPdHmlHieH7BW/vfOa2gW', '01402039382', 'A+', 'Tangail', 22, 'Female', 'user', '2025-07-08 18:26:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `camps`
--
ALTER TABLE `camps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `camps`
--
ALTER TABLE `camps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
