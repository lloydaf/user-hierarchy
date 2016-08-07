-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2016 at 09:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dquip`
--

-- --------------------------------------------------------

--
-- Table structure for table `bas_user`
--

CREATE TABLE `bas_user` (
  `user_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bas_user`
--

INSERT INTO `bas_user` (`user_name`, `user_id`) VALUES
('Area_Manager_1', 15),
('Area_Manager_2', 16),
('CEO', 10),
('Chairman', 9),
('Salesperson_1', 11),
('Salesperson_2', 12),
('Salesperson_3', 13),
('Salesperson_4', 14);

-- --------------------------------------------------------

--
-- Table structure for table `mapping_table`
--

CREATE TABLE `mapping_table` (
  `team_member` int(11) NOT NULL,
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapping_table`
--

INSERT INTO `mapping_table` (`team_member`, `manager`) VALUES
(10, 9),
(11, 15),
(12, 16),
(15, 10),
(16, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bas_user`
--
ALTER TABLE `bas_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `mapping_table`
--
ALTER TABLE `mapping_table`
  ADD PRIMARY KEY (`team_member`,`manager`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bas_user`
--
ALTER TABLE `bas_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
