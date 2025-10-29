-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2024 at 03:56 PM
-- Server version: 8.0.29
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `verification_code` varchar(255) DEFAULT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `address`, `phone`, `dob`, `gender`, `user_type`, `is_verified`, `verification_code`, `resettoken`, `resettokenexpire`, `Image`) VALUES
(80, 'Sujan', 'np03cs4s220101@heraldcollege.edu.np', 'Sujan@32', 'Jorpati', '9823548051', '2022-02-04', 'male', NULL, 0, '0f460b1edcd2173580eabed4c4c9e0d350bfa68be856a40f28d286dbe0971a1e', NULL, NULL, NULL),
(100, 'Admin', 'jubingc15@gmail.com', 'pass123', 'Kathmanduu', '9823548051', '2002-02-19', 'male', 'admin', 1, 'ABC12345', NULL, NULL, 'User_profile/admin.png'),
(118, 'Nikunja', 'nk.lamsal7@gmail.com', 'Nikunj1', 'Imadol', '9805894899', '2024-05-06', 'male', NULL, 0, 'e85fa5913ead61baf2dcdf82a870c578681fa13707215bbbf88b320d8c33e31c', NULL, NULL, NULL),
(119, 'Jubin Ghimire', 'niraulaabhinav@gmail.com', 'abhinav123', 'Bhaktapur', '9823548053', '2024-05-12', 'male', NULL, 0, 'f7da654b5d0d51f5eb17ca9b203f13df07766a9e391ea427cc24c12dc3b8f5ee', NULL, NULL, NULL),
(120, 'Doctor', 'doctor@gmail.com', 'Doctor@567', 'Kathmandu', '9810114707', '1995-06-16', 'male', 'doctor', 1, '0cca51a938acdf00452183091c307d8d792f2c7bb0c697c8c6a98b97d332c943', NULL, NULL, 'User_profile/photo.jpg'),
(139, 'Shristi Ghimire', 'shritsi555@gmail.com', 'aaa', 'Itahari', '9823548022', '2024-05-21', 'male', NULL, 1, '52e9b30b790fed83a781f93c417d698e250521a23e721681920c4aca97a300a7', NULL, NULL, 'User_profile/young-smiling-young-woman-showing-copy-space.jpg'),
(140, 'Ram Khadka', 'np03cs4s220194@heraldcollege.edu.np', '123', 'Kathmandu', '9823548050', '2024-05-21', 'male', NULL, 1, '52a5bd5d1c937dc55fcdcd510d64d7db1e1591f5ed3f82e2953bbf13a4885909', NULL, NULL, 'User_profile/photo.jpg'),
(149, 'Sunil Gautam', 'sudin@gmail.com', '123', 'Jorpati', '9823548011', '2024-05-22', 'male', NULL, 0, '418ef9a671e8482aa2a89db8ef3e76ec0ffda9789c751052e307da8664669baa', NULL, NULL, NULL),
(150, 'Sunil Gautam', 'ddvvhv@gmail.com', '123', 'Kathmandu', '9823548050', '2024-05-22', 'male', NULL, 0, 'e66be8609b6c93ddfdd6a527ff598c8809e3a6b778558bf10fb2deda52cfdba0', NULL, NULL, NULL),
(152, 'Sujan Sitaula', 'dentalapp20@gmail.com', 'sunil@123', 'Kathmandu', '9823548011', '2009-01-22', 'male', NULL, 1, '21864b196ccdbba9b5388ce0d0d72feb357394a526fb86cf22310d9dfa2e9932', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_form`
--

CREATE TABLE `appointment_form` (
  `appointment_id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `appointment_date` datetime(6) NOT NULL,
  `Symptoms` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Preferred_doctor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Payment Status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Fee` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_form`
--

INSERT INTO `appointment_form` (`appointment_id`, `first_name`, `last_name`, `email`, `phone`, `appointment_date`, `Symptoms`, `Preferred_doctor`, `Status`, `Payment Status`, `Fee`, `token`, `transaction_id`) VALUES
(66, 'Milan', 'Dhoj', 'dentalapp20@gmail.com', '9869322304', '2024-05-21 12:45:00.000000', 'fillings', 'Dr. Shaloni Shilpi', 'booked', NULL, NULL, NULL, NULL),
(76, 'Sujan', 'Gautam', 'dentalapp20@gmail.com', '9823548051', '2024-05-24 08:41:00.000000', 'Scaling', 'Dr. Shreeya Aryal', 'Canceled', NULL, NULL, NULL, NULL),
(114, 'Roshan', 'Ghimire', 'dentalapp20@gmail.com', '9823548011', '2024-05-21 15:10:00.000000', 'need to add braces', 'Dr. Saloni Shilphi', 'booked', NULL, NULL, NULL, NULL),
(147, 'Deepak', 'Lama', 'np03cs4s220194@heraldcollege.edu.np', '9823548011', '2024-05-25 07:05:00.000000', 'need to add braces', 'Dr. Sama Pradhan', 'completed', NULL, NULL, NULL, NULL),
(152, 'John', 'Lama', 'dentalapp20@gmail.com', '9823548022', '2024-05-24 22:51:00.000000', 'cavity issue', 'Dr. Shreeya Aryal', 'completed', NULL, NULL, NULL, NULL),
(154, 'Sunil', 'Gotiya', 'dentalapp20@gmail.com', '9823548011', '2024-05-30 15:01:00.000000', 'Dying', 'Dr. Sama Pradhan', 'Pending', NULL, NULL, NULL, NULL),
(155, 'Deepak', 'Ghimire', 'dentalapp20@gmail.com', '9823548050', '2024-05-22 23:03:00.000000', 'scaling', 'Dr. Sama Pradhan', 'Canceled', NULL, NULL, NULL, NULL),
(162, 'Sunil', 'Cena', 'np03cs4s220194@heraldcollege.edu.np', '9823548011', '2024-05-25 07:13:00.000000', 'Dying', 'Dr. Sama Pradhan', 'Pending', NULL, NULL, NULL, NULL),
(163, 'Shristi', 'Ghimire', 'shritsi555@gmail.com', '9841586032', '2024-05-24 07:29:00.000000', 'scaling', 'Dr. Sama Pradhan', 'Pending', NULL, NULL, NULL, NULL),
(164, 'Shristi', 'Ghimire', 'shritsi555@gmail.com', '9823548011', '2024-05-24 07:24:00.000000', 'Dying', 'Dr. Sama Pradhan', 'Pending', NULL, NULL, NULL, NULL),
(165, 'Roshan', 'Cena', 'shritsi555@gmail.com', '9823548011', '2024-05-24 07:38:00.000000', 'Dying', 'Dr. Sama Pradhan', 'completed', NULL, NULL, NULL, NULL),
(166, 'Dental', 'Boy', 'dentalapp20@gmail.com', '9823548051', '2024-05-22 13:37:00.000000', 'im ok', 'Dr. Shreeya Aryal', 'Canceled', NULL, NULL, NULL, NULL),
(167, 'John', 'Cena', 'dentalapp20@gmail.com', '9823548022', '2024-05-22 16:20:00.000000', 'tooth pain', 'Dr. Kushal Bimb', 'Pending', NULL, NULL, NULL, NULL),
(168, 'Sujan', 'Sitaula', 'dentalapp20@gmail.com', '9823548051', '2024-05-23 15:30:00.000000', 'toothache', 'Dr. Shaloni Shilpi', 'completed', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` date NOT NULL,
  `is_read` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `email`, `name`, `message`, `timestamp`, `is_read`) VALUES
(1, 'shritsi555@gmail.com', 'snesnc', 'ehbdjkw', '2024-05-21', 1),
(2, 'np03cs4s220194@heraldcollege.edu.np', 'Ram  Khadka', 'Your appointment has been booked for 2024-05-22T17:19.', '2024-05-21', 1),
(36, 'dentalapp20@gmail.com', 'Your Boy', 'Your appointment has been booked for 2024-05-24T22:49. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-21', 0),
(37, 'dentalapp20@gmail.com', 'John Lama', 'Your appointment has been booked for 2024-05-24T22:51. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-21', 0),
(45, 'np03cs4s220194@heraldcollege.edu.np', 'Deepak l', 'Your appointment has been booked for 2024-05-22T22:19. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0),
(46, 'np03cs4s220194@heraldcollege.edu.np', 'John Cena', 'Your appointment has been booked for 2024-05-24T00:14. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0),
(47, 'np03cs4s220194@heraldcollege.edu.np', 'Sunil Cena', 'Your appointment has been booked for 2024-05-25T07:13. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0),
(48, 'shritsi555@gmail.com', 'Shristi Ghimire', 'Your appointment has been booked for 2024-05-24T07:29. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0),
(49, 'shritsi555@gmail.com', 'Shristi Ghimire', 'Your appointment has been booked for 2024-05-24T07:24. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0),
(50, 'shritsi555@gmail.com', 'Roshan Cena', 'Your appointment has been booked for 2024-05-23T07:31. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0),
(51, 'dentalapp20@gmail.com', 'Dental Boy', 'Your appointment has been booked for 2024-05-25T13:33. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 1),
(52, 'dentalapp20@gmail.com', 'John Cena', 'Your appointment has been booked for 2024-05-22T16:20. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 1),
(53, 'dentalapp20@gmail.com', 'Sujan Sitaula', 'Your appointment has been booked for 2024-05-23T15:30. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.', '2024-05-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `email`, `user_id`, `transaction_id`, `token`, `payment_date`, `amount`) VALUES
(1, 'np03cs4s220194@heraldcollege.edu.np', 140, '0', 'vRjXq8dQH9FVA223QMHzbe', '2024-05-21 18:58:00', 10.00),
(2, 'np03cs4s220194@heraldcollege.edu.np', 140, 'N4c6H9BGur6iyDJi5Ae7rV', 'taWD2oZczQJ4Bung7jTtHb', '2024-05-21 18:59:59', 10.00),
(3, 'np03cs4s220194@heraldcollege.edu.np', 140, 'mxUAFvSRGqtU6UWEtJZjm4', 'qyasdf5DWGWW27mhwYKd9f', '2024-05-21 19:13:54', 10.00),
(4, 'np03cs4s220194@heraldcollege.edu.np', 140, '6FtKVR3f97boY9RrwSZ4Na', '5XdsWNoCvER58bddEDFTxa', '2024-05-21 21:21:40', 10.00),
(5, 'np03cs4s220194@heraldcollege.edu.np', 140, 'dTAUWirajqbMLmQ5WSqCmV', 'Fva2TrDVXy5g32SkmcVvc2', '2024-05-21 22:02:40', 10.00),
(6, 'np03cs4s220194@heraldcollege.edu.np', 140, 'TZXyoLtr43zurpSv9CNjuZ', 'YDM93CbqWwWSLaoftof4mL', '2024-05-21 22:10:00', 10.00),
(7, 'np03cs4s220194@heraldcollege.edu.np', 140, '5YWwBwrYieiDDaKmrT9qD6', '9dRVgTq4J3jbcsaZxxhvCb', '2024-05-21 22:29:30', 10.00),
(8, 'np03cs4s220194@heraldcollege.edu.np', 140, 'xmyU29b6NUgepPpQFtEABW', 'g9eUNgRFdWtCVrgwn2BxvD', '2024-05-21 22:33:33', 10.00),
(9, 'np03cs4s220194@heraldcollege.edu.np', 140, 'qE9htbryTDTks8rxXc2odc', 'bq3zfgKkxokNEk5NDkiM4M', '2024-05-21 22:38:48', 10.00),
(10, 'np03cs4s220194@heraldcollege.edu.np', 140, 'dT4B4vn2tJEu46gV9Ca3JT', 'y8kPoKMy4Z4TZdHekfqzLT', '2024-05-21 22:42:51', 10.00),
(11, 'dentalapp20@gmail.com', 82, 'AmMBiq5EbfuNvRvadDPfVH', '46YCv9rF6dkcXQecbzTz3m', '2024-05-21 22:50:04', 10.00),
(12, 'dentalapp20@gmail.com', 82, '3jXUQtfiP3N3q7GUd3N9Lg', 'EtgBcRkZSZ74m2XqNCncVV', '2024-05-21 22:51:24', 10.00),
(13, 'dentalapp20@gmail.com', 82, 'ELSqUTRtT54VXLkEDXLmTM', 'XXjrCJjFJhoLaZZNTz3pKX', '2024-05-21 23:03:43', 10.00),
(14, 'np03cs4s220194@heraldcollege.edu.np', 140, 'v5yjXjY7Y5RnyTVenngYED', 'CjBk2V62nb3BMaTNezta5e', '2024-05-21 23:18:09', 10.00),
(15, 'np03cs4s220194@heraldcollege.edu.np', 140, 'WPpuZ34eQLwrj7YrzzXw75', 'uyrMWzGTRPshYvjMe9R5SD', '2024-05-21 23:20:44', 10.00),
(16, 'shritsi555@gmail.com', 139, 'pJNbj8gLRS36vWbAC7DerA', 'iJDZbkjXz9GEho2nXhueae', '2024-05-22 07:32:13', 10.00),
(17, 'dentalapp20@gmail.com', 151, 'yivbRoYk9oH4UfsQ3yhMm8', 'D6a2DYMp4Ctqx8WpHBB9hS', '2024-05-22 13:31:41', 10.00),
(18, 'dentalapp20@gmail.com', 152, 'CQbAiMiwxC4Y8UwKaGMkL2', 'DbrtiEmYrbFfSfhG53ka8S', '2024-05-22 15:30:52', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` varchar(225) NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'asda', 4, 'jhgig', '0000-00-00'),
(2, 'pradhanaacaa', 4, 'sabawas', '0000-00-00'),
(3, 'pradhanaacaa', 4, 'sabawas', '0000-00-00'),
(4, 'ramu', 5, 'hiiiiii', '0000-00-00'),
(5, 'ramu', 5, 'hiiiiii', '2023-04-30'),
(6, 'abhinav', 4, 'hello ahsdoua', '2023-04-30'),
(7, 'nick', 4, 'asfavawva', '2023-04-30'),
(8, 'dikesh', 2, 'skdhpaheva', '2023-04-30'),
(9, 'dikesh', 2, 'skdhpaheva', '2023-04-30'),
(10, 'sdafa', 1, 'sa;khd[ahn', '2023-04-30'),
(11, 'sdafa', 5, 'sa;khd[ahn', '2023-04-30'),
(12, 'anil', 2, 'asgdoacawcav', '2023-04-30'),
(13, 'jubin', 4, 'hello', '2023-04-30'),
(14, 'ramchadra', 5, 'jayshreeram', '2023-05-01'),
(15, 'chandra', 5, 'pradhan', '2023-05-01'),
(16, 'asda', 5, 'wdadwadawd', '2023-05-01'),
(17, 'britika', 4, 'sdavaadkasfpawd', '2023-05-01'),
(18, 'britika', 4, 'sdavaadkasfpawd', '2023-05-01'),
(19, 'britika', 5, 'aknapdnapwdnawd', '2023-05-01'),
(20, 'amid', 4, 'askdapwd', '2023-05-01'),
(21, 'amod', 2, 'khai ta', '2023-05-02'),
(22, 'babu', 5, 'nanu', '2023-05-03'),
(23, 'mukesh', 1, 'mera naam mukesh haii\n', '2023-05-03'),
(24, 'kaji', 1, 'kaji paji', '2023-05-03'),
(25, 'paji', 3, 'kajivai', '2023-05-03'),
(26, 'britika', 3, 'thikai xa vanum', '2023-05-03'),
(27, 'amod', 5, 'nice one', '2023-05-03'),
(28, 'kali', 1, 'ok', '2023-05-03'),
(29, 'masu', 1, 'k xa dost', '2023-05-08'),
(30, 'Someone', 3, 'Decent', '2023-05-08'),
(31, 'Abhinav Niraula', 4, 'quite friendly in nature', '2023-05-09'),
(32, 'jj', 0, 'ramro', '2024-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `review_table1`
--

CREATE TABLE `review_table1` (
  `review_id` int NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` varchar(225) NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `review_table1`
--

INSERT INTO `review_table1` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'abhaeflujgauosj', 4, 'asjhdaipwhd', '2023-05-05'),
(2, 'Abhinav Niraula', 5, 'ramro vamos!', '2024-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `review_table2`
--

CREATE TABLE `review_table2` (
  `review_id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` varchar(225) NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `review_table2`
--

INSERT INTO `review_table2` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'mani', 1, 'thikai xa', '2023-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `review_table3`
--

CREATE TABLE `review_table3` (
  `review_id` int NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` varchar(225) NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `review_table3`
--

INSERT INTO `review_table3` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'aiwhdaw', 1, 'asdljhawd', '2023-05-05'),
(2, 'Jubin', 3, 'Good', '2023-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int NOT NULL,
  `Doctor` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `Doctor`, `email`, `password`, `sname`) VALUES
(2, 'Dr. Kushal Bimb', 'doctor@gmail.com', NULL, 'endodontics'),
(3, 'Dr. Shaloni Shilpi', 'doctor@gmail.com', NULL, 'Prosthodontics'),
(4, 'Dr. Shreeya Aryal', 'doctor@gmail.com', NULL, 'Orthodontics'),
(8, 'Dr. Sama Pradhan', 'doctor@gmail.com', NULL, 'endodontics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_form`
--
ALTER TABLE `appointment_form`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `review_table1`
--
ALTER TABLE `review_table1`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `review_table2`
--
ALTER TABLE `review_table2`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `review_table3`
--
ALTER TABLE `review_table3`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `appointment_form`
--
ALTER TABLE `appointment_form`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `review_table1`
--
ALTER TABLE `review_table1`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review_table2`
--
ALTER TABLE `review_table2`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_table3`
--
ALTER TABLE `review_table3`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
