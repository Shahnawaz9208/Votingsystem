-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2019 at 08:56 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_24866129_vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_password`, `username`, `password`, `email`, `phone`) VALUES
(1, 'dcc4f94d34148e53e04783e78895d3a4', 'NULL', 'NULL', 'NULL', 'NULL'),
(2, 'NULL', 'ahadwasim', '7f495caf5bd168ff788ee9d0ebe62054', 'ahadsts@gmail.com', '8266971153'),
(12, 'NULL', '123', '202cb962ac59075b964b07152d234b70', '123@gmail.com', '8266971153');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `enrollment_number` varchar(255) NOT NULL,
  `faculty_number` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `voting_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `name`, `enrollment_number`, `faculty_number`, `department`, `voting_status`) VALUES
(1, 'Ahad', 'GH3517', '17DPCE178', 'Polytechnic', 'Voted'),
(2, 'Hasan ', 'GK9056', '17DPCE181', 'Polytechnic', 'Not Voted'),
(3, 'Ibrahim', 'GK4587', '17DPCE188', 'Polytechnic', 'Not Voted'),
(4, 'Ahmad', 'GK2346', '17DPCE169', 'Polytechnic', 'Not Voted'),
(5, 'Saad', 'GK9067', '17DPCE182', 'Polytechnic', 'Not Voted'),
(6, 'Arsalan Khan', 'GJ7625', '17DPCE167', 'Polytechnic', 'Not Voted');

-- --------------------------------------------------------

--
-- Table structure for table `tb_candidates`
--

CREATE TABLE `tb_candidates` (
  `candidates_id` int(5) NOT NULL,
  `candidates_name` varchar(45) NOT NULL,
  `candidates_position` varchar(45) NOT NULL,
  `candidates_email` varchar(50) NOT NULL,
  `candidates_pic` varchar(255) NOT NULL,
  `candidate_cvotes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_candidates`
--

INSERT INTO `tb_candidates` (`candidates_id`, `candidates_name`, `candidates_position`, `candidates_email`, `candidates_pic`, `candidate_cvotes`) VALUES
(1, 'Osama Khan', 'President', 'osama@gmail.com', '', 7),
(2, 'Fasal Khan', 'President', 'fasal@gmail.com', '2.jfif', 2),
(5, 'Hasan Ali', 'Secretary', 'hasan@gmail.com', 'img2.jpg', 2),
(6, 'Arsalan', 'Secretary', 'arsalan@gmail.com', 'img3.jpg', 4),
(7, 'Shujaat Ali', 'Cabinet', 'shujaat@gmail.com', '5.jfif', 20),
(8, 'Umair Khan', 'Cabinet', 'umair@gmail.com', '5.jfif', 22),
(9, 'Ahmad', 'Cabinet', 'ahmad@gmail.com', '5.jfif', 18),
(10, 'Farrukh Hasan', 'Court Member', 'farrukh.Hasan@gmail.com', '', 15),
(11, 'Cabinet', 'Cabinet', 'cabinet@gmail.com', '8.png', 0),
(12, 'Ahad', 'Court Member', 'ahadsts@gmail.com', '1.png', 19),
(13, 'Ibrahim', 'Vice President', 'ibrahim@gmail.com', '6.jfif', 0),
(14, 'Ahad Wasim', 'President', 'ahadsts@gmail.com', '496.gif', 14),
(15, 'Zehan Khan', 'Vice President', 'zehankhan@gmail.com', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_positions`
--

CREATE TABLE `tb_positions` (
  `positions_id` int(5) NOT NULL,
  `positions_name` varchar(45) NOT NULL,
  `positions_limit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_positions`
--

INSERT INTO `tb_positions` (`positions_id`, `positions_name`, `positions_limit`) VALUES
(2, 'President', '0'),
(3, 'Vice President', '0'),
(4, 'Secretary', '0'),
(5, 'Court Member', '0'),
(6, 'Cabinet', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_vote`
--

CREATE TABLE `tb_vote` (
  `id` int(11) NOT NULL,
  `voter` varchar(60) NOT NULL,
  `position` varchar(60) NOT NULL,
  `candidate` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_vote`
--

INSERT INTO `tb_vote` (`id`, `voter`, `position`, `candidate`) VALUES
(6, 'GH3517', 'President', 'Osama Khan'),
(7, 'GH3517', 'Secretary', 'Hasan Ali'),
(8, 'GH3517', 'Court Member', 'Farrukh Hasan'),
(9, 'GH3517', 'Cabinet', 'Shujaat Ali, Cabinet'),
(13, 'GH3517', 'Vice President', 'Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `enrollment` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `trn_date` datetime NOT NULL,
  `otp` varchar(20) NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `enrollment`, `phone`, `trn_date`, `otp`, `verify`) VALUES
(1, 'gk6545', '918266971153', '2019-09-30 19:40:23', 'OTP: 97796', 1),
(2, 'dh3517', '918266971153', '2019-09-10 18:42:24', 'OTP: 42037', 1),
(3, 'GK1619', '918868977656', '2019-09-11 08:52:55', 'OTP: 11824', 1),
(4, 'gk1619', '918868977656', '2019-09-12 10:15:49', 'OTP: 92066', 1),
(5, 'squ782', '918266971153', '2019-09-12 10:12:59', 'OTP: 60067', 1),
(6, 'gh3517', '918266971153', '2019-09-23 06:26:49', 'OTP: 54483', 1),
(7, 'dh3514', '918266971153', '2019-10-03 11:02:56', 'OTP: 18092', 1),
(8, 'gh3516', '919411854211', '2019-10-03 11:04:04', 'OTP: 52279', 1),
(9, 'GK9056', '918266971153', '2019-10-28 12:58:35', 'OTP: 71629', 1),
(10, 'GH3517', '918266971153', '2019-11-20 17:52:20', 'OTP: 31457', 1),
(11, 'KO1234', '911234567890', '2019-11-14 07:46:53', 'OTP: 58239', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_candidates`
--
ALTER TABLE `tb_candidates`
  ADD PRIMARY KEY (`candidates_id`);

--
-- Indexes for table `tb_positions`
--
ALTER TABLE `tb_positions`
  ADD PRIMARY KEY (`positions_id`);

--
-- Indexes for table `tb_vote`
--
ALTER TABLE `tb_vote`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_vote`
--
ALTER TABLE `tb_vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
