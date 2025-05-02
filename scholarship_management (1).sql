-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 02:15 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `roll_no` varchar(50) NOT NULL,
  `student_online_id` varchar(50) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` enum('I','II','III','IV','V') NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `father_guardian_name` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `bank_account_no` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `micr_code` varchar(20) DEFAULT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `sex` enum('Male','Female','Other') NOT NULL,
  `umis_no` varchar(50) DEFAULT NULL,
  `aadhaar_no` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `community` varchar(100) NOT NULL,
  `sub_caste` varchar(100) DEFAULT NULL,
  `date_of_joining` date NOT NULL,
  `student_mobile` varchar(15) NOT NULL,
  `parent_mobile` varchar(15) DEFAULT NULL,
  `student_email` varchar(255) NOT NULL,
  `received_other_scholarship` enum('YES','NO') NOT NULL,
  `hosteller` enum('YES','NO') NOT NULL,
  `application_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `student_id`, `roll_no`, `student_online_id`, `course`, `year`, `student_name`, `father_guardian_name`, `occupation`, `address`, `bank_account_no`, `bank_name`, `branch_name`, `micr_code`, `ifsc_code`, `sex`, `umis_no`, `aadhaar_no`, `date_of_birth`, `community`, `sub_caste`, `date_of_joining`, `student_mobile`, `parent_mobile`, `student_email`, `received_other_scholarship`, `hosteller`, `application_status`, `created_at`) VALUES
(1, 1, '2239020005', 'I22171024', 'm.sc.information technology', 'III', 'prasanna', 'santhanam', 'former', '204,ambethkar strret,kayalpaatu,cuddalore 608801', '366145778677', 'canara bank', 'periyapattu', '4563789', 'cnrb00727', 'Male', '9002456373', '247551141633', '2025-03-15', 'sc', 'adidravidar', '0000-00-00', '9360190563', '3544543545', 'prasanna101200@gmail.com', 'NO', '', 'Pending', '2025-03-15 11:35:55'),
(2, 2, '2239020027', '2', 'm.sc.information technology', '', 'raj prasad', 'raj kumar', 'painter', 'chennai', '543672865469', 'indian bank', 'annamalai nagar', '6745385', 'ind9807', 'Male', '9006353478', '866543989258', '2025-03-16', 'sc', 'adidiravidar', '0000-00-00', '9123597726', '6785438906', 'prasadraj084@gmail.com', 'YES', '', 'Pending', '2025-03-16 12:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `document_type` enum('Identity Card','Bonafide Certificate','10th Marksheet','12th Marksheet','Income Certificate','Community Certificate','Bank Passbook','Tuition Fee Challan','Aadhaar Card','Hostel Certificate','Attendance Certificate','First Graduate Certificate') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `application_id`, `document_type`, `file_path`, `uploaded_at`) VALUES
(7, 1, 'Identity Card', 'uploads/1742038555_Screenshot (10).png', '2025-03-15 11:35:55'),
(8, 2, 'Identity Card', 'uploads/1742128178_Screenshot (10).png', '2025-03-16 12:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `eligibility` text DEFAULT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `name`, `description`, `amount`, `eligibility`, `deadline`, `created_at`) VALUES
(1, 'Merit-Based Scholarship', 'For students with 90%+ marks', '50000.00', '90%+ in last exam', '2025-06-30', '2025-03-12 11:33:47'),
(2, 'post metric Scholarship', 'the Government have ordered to grant Post Matric\nScholarship to SC/SCA/ST And BC,MBC,DNC,OBC candidates and SC/SCA converted Christians, whose\nparental annual income is less than Rs. 2,50,000/- from all the sources shall only\nbe eligible. ', '30000.00', 'Annual income < ₹2,00,000', '2025-07-15', '2025-03-12 11:33:47'),
(3, 'first graduate scholarship', 'The first graduate certificate is eligible only when there are no graduates in the family, including siblings who were not benefited by the first graduate scholarship or fee concession. The Tahsildar under the Tamil Nadu Government grants the First Graduate Certificate.', '50000.00', '90%+ in last exam', '2025-06-30', '2025-03-14 13:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'prasanna', 'prasanna101200@gmail.com', '$2y$10$RyD.LRZhemxhd8fEN4NdiudxplJz.bYFo73C7lKDcydu8Nj8wdD7C', '9360190563', '2025-03-08 10:49:41'),
(2, 'raj prasad', 'prasadraj084@gmail.com', '$2y$10$r7ZCwwIwlb6mUXx4jNAUq.yVy7dMjzYkSBNvG9Ie8JPcMsXvJ2v76', '9123597726', '2025-03-14 13:27:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
