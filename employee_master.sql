-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 09:19 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_emp_base`
--

CREATE TABLE `mst_emp_base` (
  `id` bigint(11) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `adddress` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `profile_pic` text,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_emp_base`
--

INSERT INTO `mst_emp_base` (`id`, `emp_name`, `adddress`, `email`, `phone`, `dob`, `profile_pic`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 'sagar bhore', 'satara maharashtra', 'sagar@test.in', '9090909094', '2020-05-04', 'Jellyfish.jpg', '2020-09-06 10:50:56', 1, '2020-09-07 12:05:01', 1),
(6, 'karan', 'karan', 'karan@test.in', '9090909090', '2020-05-05', 'Desert.jpg', '2020-09-06 10:50:23', 1, '2020-09-06 10:50:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id`, `name`, `email`, `user_id`, `password`, `status`, `role`) VALUES
(1, 'admin', 'admiin@test.in', '9998887771', 'e10adc3949ba59abbe56e057f20f883e', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_emp_base`
--
ALTER TABLE `mst_emp_base`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `emp_name` (`emp_name`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_emp_base`
--
ALTER TABLE `mst_emp_base`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
