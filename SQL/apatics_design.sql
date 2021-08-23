-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 06:23 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apatics_design`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `user_name` varchar(256) DEFAULT NULL,
  `company` varchar(256) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `data_integrity` varchar(50) DEFAULT NULL,
  `network_detection` varchar(50) DEFAULT NULL,
  `consultation_demonstration` varchar(50) DEFAULT NULL,
  `e_news_bulletin` varchar(50) DEFAULT NULL,
  `page_type` varchar(25) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `user_name`, `company`, `phone_no`, `email`, `city`, `state`, `data_integrity`, `network_detection`, `consultation_demonstration`, `e_news_bulletin`, `page_type`, `created_at`) VALUES
(11, 'Kalpit Belani', 'Plutus technologies private limited', '7283837399', 'kalpit.belani@plutustec.com', 'San Francisco', 'California', 'Schedule a FREE provider network data integrity sc', '', 'Schedule a consultation and demonstration', '', 'contact_page', '2021-08-20 22:13:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
