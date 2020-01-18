-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2019 at 03:33 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin', '2019-03-19 10:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `num_bottles` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `package_status` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `num_bottles`, `type_id`, `price`, `package_status`, `status`, `created_at`) VALUES
(1, 'Home Package (4)', '4 bottles per week economy package for designed for home users', 4, 1, '2.4', 1, 1, '2019-03-17 18:26:27'),
(2, '', '', 8, 2, '6', 1, 1, '2019-03-19 11:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `sun` int(11) NOT NULL,
  `mon` int(11) NOT NULL,
  `tue` int(11) NOT NULL,
  `wed` int(11) NOT NULL,
  `thu` int(11) NOT NULL,
  `fri` int(11) NOT NULL,
  `sat` int(11) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `special_request` text NOT NULL,
  `total` varchar(255) NOT NULL DEFAULT '0',
  `user_name` varchar(255) NOT NULL,
  `user_contact` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `subscriptions_status` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `package_id`, `user_id`, `duration`, `start_date`, `expire_date`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `delivery_time`, `special_request`, `total`, `user_name`, `user_contact`, `user_address`, `subscriptions_status`, `status`, `created_at`) VALUES
(4, 1, 1, 'month', '2019-03-29 00:00:00', '2019-04-29 00:00:00', 1, 0, 1, 1, 0, 0, 1, '8:00PM', '', '8.64', 'Mohammad Anas', '36547521', 'GUDAIBIYA, ROAD 2107, BUILDING 622, FLAT 22. KINGDOM OF BAHRAIN', 0, 1, '2019-03-19 09:25:34'),
(5, 2, 2, 'week', '2019-03-28 00:00:00', '2019-04-04 00:00:00', 2, 1, 1, 1, 1, 2, 0, '10:00AM', '', '6', 'Ebrahim', '35088525', 'House No. 254, Road 4582, Block 0985, Hamad Town', 1, 1, '2019-03-19 18:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `address`, `status`, `created_at`) VALUES
(1, 'Mohammad Anas', 'anas@mail.com', '123', '36547500', 'GUDAIBIYA, ROAD 2107, BUILDING 622, FLAT 22. KINGDOM OF BAHRAIN', 1, '2019-03-16 16:41:15'),
(2, 'Ebrahim', 'ebrahim@mail.com', '123', '35088525', 'House No. 254, Road 4582, Block 0985, Hamad Town', 1, '2019-03-19 18:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `water_types`
--

CREATE TABLE `water_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `water_types`
--

INSERT INTO `water_types` (`id`, `name`, `is_active`, `status`, `created_at`) VALUES
(1, 'Economy', 1, 1, '2019-03-17 18:19:27'),
(2, 'Standard', 1, 1, '2019-03-17 18:22:42'),
(3, 'Premium', 1, 1, '2019-03-17 18:22:42'),
(4, 'Gold', 1, 0, '2019-03-19 10:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_schedules`
--

CREATE TABLE `weekly_schedules` (
  `id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `sun` int(11) NOT NULL,
  `mon` int(11) NOT NULL,
  `tue` int(11) NOT NULL,
  `wed` int(11) NOT NULL,
  `thu` int(11) NOT NULL,
  `fri` int(11) NOT NULL,
  `sat` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_types`
--
ALTER TABLE `water_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_schedules`
--
ALTER TABLE `weekly_schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `water_types`
--
ALTER TABLE `water_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weekly_schedules`
--
ALTER TABLE `weekly_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
