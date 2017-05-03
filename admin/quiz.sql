-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2017 at 06:52 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `answer_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `answers` varchar(250) NOT NULL,
  `correct_answer` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`answer_id`, `quiz_id`, `question_id`, `answers`, `correct_answer`) VALUES
(1, 1, 1, 'Dhaka', 1),
(2, 1, 1, 'Sylhet', 0),
(3, 1, 1, 'Khulna', 0),
(4, 1, 1, 'Rajshahi', 0),
(5, 1, 2, 'Kishoreganj', 1),
(6, 1, 2, 'Habiganj', 0),
(7, 1, 2, 'Jhinaidhah', 0),
(8, 1, 2, 'Bhula', 0),
(9, 2, 3, 'Mashrafi', 1),
(10, 2, 3, 'Dhuni', 0),
(11, 2, 3, 'Shebag', 0),
(12, 2, 3, 'Afridi', 0),
(13, 2, 4, 'P', 0),
(14, 2, 4, 'D', 0),
(15, 2, 4, 'O', 1),
(16, 2, 4, 'K', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_participant`
--

CREATE TABLE `tbl_participant` (
  `participant_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(14) NOT NULL,
  `ip_address` int(20) DEFAULT NULL,
  `correct_answers` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_participant`
--

INSERT INTO `tbl_participant` (`participant_id`, `quiz_id`, `name`, `address`, `email`, `phone`, `ip_address`, `correct_answers`) VALUES
(1, 2, 'Palash', 'MIrpur', 'palash@gmail.com', 25893358, NULL, '3:10,4:14'),
(2, 2, 'Rakib', 'Mirpur', 'rakib@yahoo.com', 258963587, NULL, '3:9,4:15'),
(3, 2, 'Mithun', 'Mohammadpur', 'mithun@yahoo.com', 2147483647, NULL, '3:10,4:14'),
(4, 2, 'Rabbi', 'Mirpur', 'rabbi@gmail.com', 14785247, NULL, '3:11,4:15'),
(5, 1, 'Rakib', 'Mirpur', 'rakib@yahoo.com', 258963587, NULL, '1:1,2:5'),
(6, 1, 'Palash', 'Mirpur', 'palash@gmail.com', 258963587, NULL, '1:1,2:5'),
(7, 1, 'Boro Polash', 'Farmgate', 'bpolash@yahoo.com', 987456321, NULL, '1:3,2:7'),
(8, 1, 'Mithun', 'Mohammadpur', 'mithun@yahoo.com', 2147483647, NULL, '1:4,2:7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `question_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `question` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`question_id`, `quiz_id`, `question`, `created_at`, `updated_at`) VALUES
(1, 1, 'Division of Bangladesh', '2016-12-05 06:59:11', '0000-00-00 00:00:00'),
(2, 1, 'District of Dhaka?', '2016-12-05 07:00:23', '2016-12-06 03:28:21'),
(3, 2, 'Player of Bangladesh', '2016-12-05 07:01:38', '0000-00-00 00:00:00'),
(4, 2, 'Which is vowel?', '2016-12-05 07:02:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE `tbl_quiz` (
  `quiz_id` int(10) NOT NULL,
  `quiz_title` text NOT NULL,
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `conditions` tinyint(4) NOT NULL DEFAULT '1',
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`quiz_id`, `quiz_title`, `start_date`, `end_date`, `conditions`, `remarks`) VALUES
(1, 'Quiz-1', '2016-12-05 00:00:00', '2016-12-30 00:00:00', 1, 'A'),
(2, 'Quiz-2', '2016-12-07 00:00:00', '2016-12-30 00:00:00', 1, 'B'),
(3, 'Test', '2017-03-13 00:00:00', '2017-03-16 00:00:00', 0, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `tbl_participant`
--
ALTER TABLE `tbl_participant`
  ADD PRIMARY KEY (`participant_id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `answer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_participant`
--
ALTER TABLE `tbl_participant`
  MODIFY `participant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  MODIFY `quiz_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
