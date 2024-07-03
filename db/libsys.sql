-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 11:00 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(250) NOT NULL,
  `AdminEmail` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mdname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `confirm_password` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `birth` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `AdminEmail`, `name`, `mdname`, `lname`, `username`, `password`, `confirm_password`, `mobile`, `birth`, `address`, `gender`, `photo`) VALUES
(1, 'admin@admin.com', 'Admininstrator', '', '', 'admin', '123456', '123456', '09292679197', '2001-06-04', 'Suba,Manjuyod,Negros Oriental', 'Male', '../profile/libhub-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(250) NOT NULL,
  `cat_name` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `status`, `created_at`, `upd_date`) VALUES
(14, 'Literature', '', '2024-04-27 16:57:03', '2024-04-27 16:57:41'),
(15, 'Fictions', '', '2024-04-27 16:57:29', '0000-00-00 00:00:00'),
(16, 'Programming', '', '2024-04-27 16:57:45', '0000-00-00 00:00:00'),
(18, 'Dictionary', '', '2024-04-27 16:57:54', '0000-00-00 00:00:00'),
(19, 'Kids', '', '2024-05-04 08:26:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(250) NOT NULL,
  `sub_name` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upd_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `sub_name`, `status`, `created_at`, `upd_date`) VALUES
(2, 'Math', '', '2024-04-20 12:24:56', '0000-00-00 00:00:00'),
(3, 'English', '', '2024-04-20 14:37:19', '0000-00-00 00:00:00'),
(5, 'Filipino', '', '2024-04-27 16:48:24', '0000-00-00 00:00:00'),
(6, 'Science', '', '2024-04-27 16:48:31', '0000-00-00 00:00:00'),
(9, 'History', '', '2024-04-27 16:53:00', '0000-00-00 00:00:00'),
(10, 'Filipino', '', '2024-05-04 08:27:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `book_image` varchar(250) NOT NULL,
  `isbnno` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `publisher` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `year` varchar(250) NOT NULL,
  `edition` varchar(250) NOT NULL,
  `volume` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `short_desc` varchar(1000) NOT NULL,
  `availability` tinyint(4) NOT NULL COMMENT '1=available, 0=not available',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`id`, `book_name`, `book_image`, `isbnno`, `author`, `publisher`, `quantity`, `category`, `year`, `edition`, `volume`, `subject`, `short_desc`, `availability`, `created_at`) VALUES
(35, 'El Filibusterismo', '../uploads/elfili.jpg', '923-541-009-12', 'Emerlinda G. Cruz', 'Publishing', '37', 'Literatures', '2009', '3', '1', 'English', ' The present volume focuses on myths, simply defines as sacred narratives explaining how the world and man came to be in their present form.', 0, '2024-05-04 08:59:16'),
(36, 'The Myths Book', '../uploads/themyths.jpg', '971-542-019-2', 'Damiana L. Eugenio', 'University of the Philippines ', '2', 'Novels', '1993', '3a', '10', 'Math', ' The present volume focuses on myths, simply defines as sacred narratives explaining how the world and man came to be in their present form.', 0, '2024-05-01 14:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue`
--

CREATE TABLE `tbl_issue` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `issue_date` varchar(250) NOT NULL,
  `due_date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT '0' COMMENT '3=returned, 1=accept, 2=reject',
  `fine` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `return_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issue`
--

INSERT INTO `tbl_issue` (`id`, `book_id`, `user_id`, `name`, `email`, `issue_date`, `due_date`, `status`, `fine`, `created_at`, `return_date`) VALUES
(39, 35, 221, 'Cyrhil John Cabalida', 'cyrhilcabalida@gmail.com', '2024-05-01', '2024-05-03', '1', 'PAID', '2024-05-04 08:26:13', ''),
(47, 35, 232, 'Cyrhil Cabalida', 'cyrhilcabalida@gmail.com', '2024-05-04', '2024-05-08', '3', '', '2024-05-04 08:59:16', '2024-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif`
--

CREATE TABLE `tbl_notif` (
  `id` int(250) NOT NULL,
  `book_id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notif`
--

INSERT INTO `tbl_notif` (`id`, `book_id`, `user_id`, `message`, `date`, `status`) VALUES
(311, 35, 221, 'Succesfully Requested a Book', '2024-04-28', ''),
(312, 35, 221, 'Admin Succesfully Accepted Your Book Request', '2024-04-28', ''),
(313, 35, 221, 'Succesfully Requested a Book', '2024-04-28', ''),
(317, 36, 221, 'Succesfully Requested a Book', '2024-04-28', ''),
(318, 36, 221, 'Admin Succesfully Accepted Your Book Request', '2024-04-28', ''),
(319, 35, 221, 'Succesfully Requested a Book', '2024-04-29', ''),
(320, 35, 221, 'Admin Succesfully Accepted Your Book Request', '2024-04-29', ''),
(321, 36, 221, 'Succesfully Requested a Book', '2024-04-29', ''),
(322, 36, 221, 'You Succesfully Returned Your Book ', '2024-04-29', ''),
(323, 36, 221, 'Admin Succesfully Accepted Your Book Request', '2024-04-29', ''),
(324, 36, 221, 'Succesfully Requested a Book', '2024-05-01', ''),
(325, 36, 221, 'Succesfully Requested a Book', '2024-05-01', ''),
(326, 36, 221, 'Admin Succesfully Accepted Your Book Request', '2024-05-01', ''),
(327, 89, 221, 'Succesfully Requested a Book', '2024-05-01', ''),
(328, 89, 221, 'Admin Succesfully Accepted Your Book Request', '2024-05-01', ''),
(329, 36, 221, 'You Succesfully Returned Your Book ', '2024-05-01', ''),
(330, 89, 221, 'You Succesfully Returned Your Book ', '2024-05-01', ''),
(331, 89, 221, 'Succesfully Requested a Book', '2024-05-01', ''),
(332, 89, 221, 'Admin Succesfully Accepted Your Book Request', '2024-05-01', ''),
(333, 35, 221, 'Succesfully Requested a Book', '2024-05-01', ''),
(334, 35, 221, 'Admin Succesfully Accepted Your Book Request', '2024-05-01', ''),
(335, 90, 221, 'Succesfully Requested a Book', '2024-05-04', ''),
(336, 90, 221, 'Succesfully Requested a Book', '2024-05-04', ''),
(337, 89, 221, 'Succesfully Requested a Book', '2024-05-04', ''),
(338, 89, 221, 'Admin Rejected Your Book Request', '2024-05-04', ''),
(339, 90, 230, 'Succesfully Requested a Book', '2024-05-04', ''),
(340, 35, 230, 'Succesfully Requested a Book', '2024-05-04', ''),
(341, 35, 230, 'Succesfully Requested a Book', '2024-05-04', ''),
(342, 90, 230, 'Admin Succesfully Accepted Your Book Request', '2024-05-04', ''),
(343, 36, 230, 'Succesfully Requested a Book', '2024-05-04', ''),
(344, 35, 230, 'Admin Succesfully Accepted Your Book Request', '2024-05-04', ''),
(345, 35, 230, 'Admin Rejected Your Book Request', '2024-05-04', ''),
(346, 35, 232, 'Succesfully Requested a Book', '2024-05-04', ''),
(347, 35, 232, 'Admin Succesfully Accepted Your Book Request', '2024-05-04', ''),
(348, 35, 232, 'You Succesfully Returned Your Book ', '2024-05-04', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `lib_id` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mdname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `year_level` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `photo` varchar(5000) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `up_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `lib_id`, `password`, `email`, `mdname`, `lname`, `fname`, `year_level`, `mobile`, `address`, `photo`, `gender`, `regdate`, `up_date`) VALUES
(232, 'MAN2020071', '123', 'cyrhilcabalida@gmail.com', '', 'Cabalida', 'Cyrhil', '11', '09079020200', 'suba,manjuyod', '../profile/images.jpg', 'Male', '2024-05-04 08:55:03', '0000-00-00 00:00:00'),
(233, 'MAN200201', '123', 'cabanag@gmail.com', '', 'Cabanag', 'Norman', '', '', 'San Isidro,', '../profile/elfili.jpg', 'Male', '2024-05-04 08:58:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_issue`
--
ALTER TABLE `tbl_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `tbl_issue`
--
ALTER TABLE `tbl_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
