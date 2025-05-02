-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 06:37 PM
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
(1, 'prasanna', '$2y$10$sAvw4ggb51Rp2FB4dTXI4eLKkNe.4zQXEB0QD5yoih6OZUyt8MDPq');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `student_online_id` varchar(50) NOT NULL,
  `college` varchar(255) DEFAULT NULL,
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
  `scholarship_name` enum('Post Metric Scholarship','Merit Based Scholarship') DEFAULT NULL,
  `hosteller` enum('YES','NO') NOT NULL,
  `application_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `scholarship_amount` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `student_id`, `roll_no`, `student_online_id`, `college`, `course`, `year`, `student_name`, `father_guardian_name`, `occupation`, `address`, `bank_account_no`, `bank_name`, `branch_name`, `micr_code`, `ifsc_code`, `sex`, `umis_no`, `aadhaar_no`, `date_of_birth`, `community`, `sub_caste`, `date_of_joining`, `student_mobile`, `parent_mobile`, `student_email`, `received_other_scholarship`, `scholarship_name`, `hosteller`, `application_status`, `created_at`, `scholarship_amount`) VALUES
(1, 2, '2239020005', 'I22171024', 'ANNAMALAI UNIVERSITY', 'M.SC INFORMATION TECHNOLOGY', 'III', 'PRASANNA', 'SANTHANAM', 'FARMER', '204,ambethkar street,kayalpattu,cuddalore,608801', '366145778677', 'canara bank', 'PERIYAPATTU', '4563789', 'cnrb00727', 'Male', '9006353478', '247551141633', '2006-04-28', 'SC', 'ADIDRAVIDAR', '2024-07-03', '9360190563', '6785438906', 'prasanna101200@gmail.com', 'NO', 'Post Metric Scholarship', 'NO', 'Approved', '2025-04-23 07:15:32', '20000.00'),
(2, 4, '2239020027', 'I22171027', 'ANNAMALAI UNIVERSITY', 'M.SC INFORMATION TECHNOLOGY', 'III', 'RAJ PRASAD', 'RAJ KUMAR', 'PAINTER', '400,CHENNAI', '543672865469', 'indian bank', 'CHENNAI', '6745385', 'ind9807', 'Male', '9006353478', '8784637463646', '2004-10-23', 'SC', 'ADIDRAVIDAR', '2024-07-03', '9123597726', '6785438906', 'prasadraj084@gmail.com', 'YES', 'Post Metric Scholarship', 'NO', 'Pending', '2025-04-23 16:32:26', '0.00');

--
-- Triggers `applications`
--
DELIMITER $$
CREATE TRIGGER `before_insert_applications` BEFORE INSERT ON `applications` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    -- Get the maximum current application_id, or start from 0 if table is empty
    SELECT IFNULL(MAX(application_id), 0) INTO max_id FROM applications;
    -- Set the new application_id as max_id + 1
    SET NEW.application_id = max_id + 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `student_id`, `document_type`, `file_path`, `uploaded_at`) VALUES
(1, 2, 'Income Certificate', 'uploads/1745392532_Screenshot (25).png', '2025-04-23 07:15:32'),
(2, 2, 'Community Certificate', 'uploads/1745392532_Screenshot (24).png', '2025-04-23 07:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`) VALUES
(2, 'i missed this upload documents ', 'directly contact admin', '2025-04-14 15:07:21'),
(3, ' How do I apply for a scholarship?', ' Login to your student account, browse available scholarships, and click on \'Apply\' next to your chosen scholarship. Fill out the application form and upload the required documents.', '2025-04-14 15:18:46'),
(4, 'Can I edit my application after submission?', 'No, once submitted, the application cannot be edited. Please review all information carefully before submitting.', '2025-04-14 15:19:26'),
(5, ' Is there any application fee?', 'No, applying for scholarships through the portal is completely free of charge.', '2025-04-14 15:20:13'),
(6, ' Who can I contact for support?', 'You can reach out to the support team through the \'Help & Support\' section in your dashboard or email us at support@scholarshipsystem.com.', '2025-04-14 15:21:07'),
(7, 'What happens if I submit incorrect information? ', 'Submitting false or incorrect information may lead to application rejection or cancellation of the awarded scholarship.', '2025-04-14 15:21:45');

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
(1, 'Merit-Based Scholarship', 'For students with 90%+ marks', '50000.00', 'only college students and 90 % marks are required', '2025-06-29', '2025-03-12 11:33:47'),
(2, 'post metric Scholarship', 'the Government have ordered to grant Post Matric\nScholarship to SC/SCA/ST And BC,MBC,DNC,OBC candidates and SC/SCA converted Christians, whose\nparental annual income is less than Rs. 2,50,000/- from all the sources shall only\nbe eligible. ', '30000.00', 'Annual income < ₹2,00,000', '2025-07-15', '2025-03-12 11:33:47');

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
(2, 'raj prasad', 'prasadraj084@gmail.com', '$2y$10$r7ZCwwIwlb6mUXx4jNAUq.yVy7dMjzYkSBNvG9Ie8JPcMsXvJ2v76', '9123597726', '2025-03-14 13:27:33'),
(4, 'muhafil', 'muhafil123@gmail.com', '$2y$10$UdVIljmxa6loKgDDyV4u6.N6kPsGiEnPDPK0OEp2ClAU7RewdcjNG', '9677349891', '2025-04-17 12:18:44'),
(5, 'kakkan', 'kakkan123@gmail.com', '$2y$10$4BhEhqWoqFITsQuQ1lOz6..SVLtaNbUz2PJjcMFM2.66sxMSIH7ia', '9123597726', '2025-04-17 12:21:10');

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
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `applications` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
