-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2026 at 03:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipcr_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_periods`
--

CREATE TABLE `login_periods` (
  `id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_periods`
--

INSERT INTO `login_periods` (`id`, `month`, `year`) VALUES
(1, 'January', 2025),
(2, 'February', 2025),
(3, 'March', 2025),
(4, 'April', 2025),
(5, 'May', 2025),
(6, 'June', 2025),
(7, 'December', 2026),
(8, 'January', 2026),
(9, 'February', 2026),
(10, 'November', 2025),
(11, 'April', 2026),
(12, 'August', 2026),
(13, 'September', 2026),
(14, 'November', 2026);

-- --------------------------------------------------------

--
-- Table structure for table `rating_matrix`
--

CREATE TABLE `rating_matrix` (
  `id` int(11) NOT NULL,
  `category` enum('Q','E','T') NOT NULL,
  `input_value` varchar(100) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_matrix`
--

INSERT INTO `rating_matrix` (`id`, `category`, `input_value`, `rating`) VALUES
(1, 'Q', 'with no error', 5),
(2, 'Q', 'with minor error', 3),
(3, 'Q', 'with major error', 1),
(4, 'E', '100%', 5),
(5, 'E', '90-99.99%', 4),
(6, 'E', '80-89.99%', 3),
(7, 'T', 'once a day', 3),
(8, 'T', '1 hour', 4),
(9, 'T', '30 minutes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_code` varchar(10) NOT NULL,
  `task_title` text NOT NULL,
  `output_category` varchar(255) DEFAULT NULL,
  `success_indicator` text DEFAULT NULL,
  `qet_quality` varchar(100) DEFAULT NULL,
  `qet_efficiency` varchar(100) DEFAULT NULL,
  `qet_timeliness` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_code`, `task_title`, `output_category`, `success_indicator`, `qet_quality`, `qet_efficiency`, `qet_timeliness`) VALUES
(1, '1.1', 'Check WAN, LAN and telephone system connectivity', 'Network Uptime', '100% of the WAN, LAN and telephone system connectivity were checked once a day.', '100%', 'once a day', 'N/A'),
(2, '1.2', 'Resolve WAN, LAN and telephone system connectivity errors', 'Network Uptime', '100% of WAN, LAN and telephone system connectivity errors were resolved within two (2) hours.', '100%', '2 hours', 'N/A'),
(3, '1.3', 'Escalate unresolved connectivity issues to DITSO', 'Network Uptime', '100% of unresolved WAN, LAN and telephone system connectivity issues were escalated to DITSO within one (1) hour.', '100%', '1 hour', 'N/A'),
(4, '2.1', 'Prepare and submit Computer Preventive Maintenance notifications', 'Preventive Maintenance', '100% of preventive maintenance notifications were prepared and submitted within three (3) working days.', '100%', '3 working days', 'N/A'),
(5, '2.2', 'Fill-up and submit Computer Preventive Maintenance checklists', 'Preventive Maintenance', '100% of preventive maintenance checklists were properly filled-up and submitted within three (3) working days with minor error.', '100%', '3 working days', 'minor error'),
(6, '2.3', 'Report PM issues to DITSO for further assessment', 'Preventive Maintenance', '100% of preventive maintenance issues were reported to DITSO within one (1) hour.', '100%', '1 hour', 'N/A'),
(7, '2.4', 'Isolate and resolve problems encountered during PM', 'Preventive Maintenance', '100% of problems encountered during preventive maintenance were isolated and resolved within one (1) working day.', '100%', '1 working day', 'N/A'),
(8, '3.1', 'Log reported incidents in IT Help Desk or Job Sheet Logbook', 'Resolved ICT Problems', '100% of reported incidents were logged in the IT Help Desk or Job Sheet Logbook within one (1) hour.', '100%', '1 hour', 'N/A'),
(9, '3.2', 'Investigate, troubleshoot or refer incidents to DITSO', 'Resolved ICT Problems', '100% of incidents were investigated, troubleshooted, or referred to DITSO within three (3) hours with minor error.', '100%', '3 hours', 'minor error'),
(10, '3.3', 'Escalate unresolved problems to DITSO', 'Resolved ICT Problems', '100% of unresolved incidents were escalated to DITSO within one (1) hour.', '100%', '1 hour', 'N/A'),
(11, '3.4', 'Resolve logged incidents after initial check', 'Resolved ICT Problems', '100% of resolved incidents were properly documented and closed.', '100%', '1 working day', 'N/A'),
(12, '4.1', 'Log application systems and software installation/update requests', 'Application Systems', '100% of ICT equipment requests were assessed and acted upon within one (1) working day.', '100%', '1 hour', 'N/A'),
(13, '4.2', 'Act upon logged application system requests per DITSO discretion', 'Application Systems', '100% of ICT equipment installations were completed within one (1) working day.', '100%', '3 hours', 'N/A'),
(14, '4.3', 'Accomplish application system installation/update requests', 'Application Systems', '100% of ICT equipment repairs were completed within three (3) working days.', '100%', '1 hour', 'minor error'),
(15, '5.1', 'Log requests for intranet, internet, and email access', 'ICT Service Requests', '100% of ICT equipment inventory records were updated and maintained.', '100%', '1 hour', 'N/A'),
(16, '5.2', 'Log training room and virtual conference setup requests', 'ICT Service Requests', '100% of ICT equipment issued were properly documented.', '100%', '1 hour', 'N/A'),
(17, '5.3', 'Facilitate setup of equipment for training and online meetings', 'ICT Service Requests', '100% of ICT equipment inventory reports were prepared and submitted.', '100%', 'as scheduled', 'N/A'),
(18, '6.1', 'Conduct biometric database backup and maintenance', 'Database Backup', '100% of system user accounts were created, modified, or disabled within one (1) working day.', '100%', 'daily', 'as scheduled'),
(19, '6.2', 'Transfer biometric database backups to external storage', 'Database Backup', '100% of system access issues were resolved within one (1) working day.', '100%', 'daily', 'as scheduled'),
(20, '6.3', 'Conduct backup and maintenance of eNGAS and e-Budget databases', 'Database Backup', '100% of system backups were completed as scheduled.', '100%', 'daily', 'as scheduled'),
(21, '6.4', 'Transfer eNGAS and e-Budget backups to external storage', 'Database Backup', '100% of system restoration requests were completed successfully.', '100%', 'daily', 'as scheduled'),
(22, '7.1', 'Log requests for IT equipment and software specifications', 'ICT Acquisition', '100% of website content updates were implemented within one (1) working day.', '100%', '1 hour', 'N/A'),
(23, '7.2', 'Assist in inspection of newly delivered IT equipment', 'ICT Acquisition', '100% of website structure updates were implemented within one (1) working day.', '100%', '1 hour', 'N/A'),
(24, '7.3', 'Assist in inspection and preparation of ICT disposal report', 'ICT Acquisition', '100% of website content issues were resolved within one (1) working day.', '100%', '1 hour', 'N/A'),
(25, '8.1', 'Assist in preparation of Inspection Reports', 'Reports', '100% of official email account requests were created and configured within one (1) working day.', '100%', 'on deadline', 'minor error'),
(26, '8.2', 'Update Server and Network Monitoring Reports', 'Reports', '100% of official email requests were created, configured, or updated within one (1) working day.', '100%', 'on deadline', 'minor error'),
(27, '8.3', 'Accomplish Preventive Maintenance Reports for servers and networks', 'Reports', '100% of email account issues were resolved within one (1) working day.', '100%', 'on deadline', 'minor error'),
(28, '8.4', 'Update Preventive Maintenance Reports for workstations', 'Reports', '100% of email configuration updates were completed within one (1) working day.', '100%', 'on deadline', 'minor error'),
(29, '8.5', 'Encode Job Sheets to Help Desk Reports', 'Reports', '100% of email-related issues were resolved within one (1) working day.', '100%', 'on deadline', 'minor error'),
(30, '8.6', 'Update Application Systems Implementation Reports', 'Reports', '100% of email system issues were escalated to DITSO when necessary.', '100%', 'on deadline', 'minor error'),
(31, '8.7', 'Update ICT Equipment Inventory Reports', 'Reports', '100% of unresolved email system issues were escalated to DITSO.', '100%', 'on deadline', 'minor error'),
(32, '8.8', 'Update ICT Software Inventory Reports', 'Reports', '100% of official email advisories were disseminated accurately and on time.', '100%', 'on deadline', 'minor error'),
(33, '9.1', 'Forward ICT purchase requests and procurement documents', 'Procurement', '100% of ICT-related requests were properly recorded and monitored.', '100%', '1 hour', 'minor error'),
(34, '9.2', 'Assist in pre-evaluation of RFQs', 'Procurement', '100% of required ICT reports were prepared and submitted on time.', '100%', '1 hour', 'minor error'),
(35, '9.3', 'Forward pre-evaluated RFQs to DITSO', 'Procurement', '100% of ICT status reports were prepared and submitted on time.', '100%', '1 hour', 'minor error'),
(36, '9.4', 'Assist in pre-evaluation of bidding documents', 'Procurement', '100% of ICT monitoring reports were prepared accurately.', '100%', '1 hour', 'minor error'),
(37, '9.5', 'Forward pre-evaluated bidding documents to DITSO', 'Procurement', '100% of required ICT documentation were prepared and submitted.', '100%', '1 hour', 'minor error'),
(38, '9.6', 'Log IT Evaluation Slips and Post Qualification Reports', 'Procurement', '100% of ICT accomplishment reports were prepared accurately and submitted on schedule.', '100%', '1 hour', 'N/A'),
(39, '9.7', 'Forward Memorandum Requests to Obligate to DITSO', 'Procurement', '100% of ICT accomplishment data were consolidated accurately.', '100%', '1 hour', 'minor error'),
(40, '9.8', 'Assist in conducting Consolidated Market Survey', 'Procurement', '100% of ICT-related documentation were properly filed and maintained.', '100%', 'on deadline', 'minor error'),
(41, '9.9', 'Forward Consolidated Certification on Market Survey to DITSO', 'Procurement', '100% of ICT records were updated and kept current.', '100%', 'on deadline', 'minor error'),
(42, '10.1', 'Conduct fuel availability check in Power House', 'Preventive Maintenance', '100% of ICT equipment maintenance activities were performed as scheduled.', '100%', 'monthly', 'N/A'),
(43, '10.2', 'Conduct Generator Set operation history inspection', 'Preventive Maintenance', '100% of ICT equipment issues were diagnosed and resolved within one (1) working day.', '100%', 'monthly', 'N/A'),
(44, '10.3', 'Conduct PM of air conditioning units', 'Preventive Maintenance', '100% of ICT equipment service requests were attended to promptly.', '100%', 'quarterly', 'N/A'),
(45, '10.4', 'Conduct scheduled battery check-up of UPS', 'Preventive Maintenance', '100% of ICT equipment inspection activities were completed.', '100%', 'monthly', 'N/A'),
(46, '10.5', 'Refer UPS battery issues to DITSO', 'Preventive Maintenance', '100% of ICT equipment repair requests were documented properly.', '100%', '1 hour', 'N/A'),
(47, '10.6', 'Conduct scheduled cleaning of network facility', 'Preventive Maintenance', '100% of ICT equipment replacement activities were coordinated properly.', '100%', 'monthly', 'N/A'),
(48, '10.7', 'Conduct network cable check and maintenance', 'Preventive Maintenance', '100% of ICT equipment status updates were recorded accurately.', '100%', 'monthly', 'good quality'),
(49, '10.8', 'Check Wireless Access Points for alerts or tampering', 'Preventive Maintenance', '100% of ICT equipment disposal activities were documented properly.', '100%', 'monthly', 'N/A'),
(50, '10.9', 'Check CCTV cameras for alerts or tampering', 'Preventive Maintenance', '100% of ICT equipment maintenance reports were prepared and submitted.', '100%', 'monthly', 'N/A'),
(51, '11.1', 'Log ICT-related documents and communications', 'Communications', '100% of technical assistance requests were attended to within one (1) working day.', '100%', '1 hour', 'N/A'),
(52, '12.1', 'Inspect and report defective IT equipment for warranty claims', 'Warranty Claims', '100% of ICT data and records were maintained accurately and securely.', '100%', '1 hour', 'minor error'),
(53, '13.1', 'Log received IT equipment for inspection', 'Equipment Inspection', '100% of ICT-related training activities were attended and completed.', '100%', '1 hour', 'N/A'),
(54, '13.2', 'Inspect equipment and issue Inspection Report', 'Equipment Inspection', '100% of ICT knowledge-sharing activities were conducted or participated in.', '100%', '1 hour', 'minor error'),
(55, '14.1', 'Forward requests for CCTV footage to DITSO', 'CCTV & PA Requests', '100% of PA System operational checks were conducted as scheduled.', '100%', '1 hour', 'N/A'),
(56, '14.2', 'Forward requests for Public Address announcements to DITSO', 'CCTV & PA Requests', '100% of PA System issues were resolved within one (1) working day.', '100%', '1 hour', 'N/A'),
(57, '14.3', 'Execute Public Service Announcement via PA System', 'CCTV & PA Requests', '100% of Public Service Announcements were executed through the PA System within one (1) hour.', '100%', '1 hour', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `task_accomplishments`
--

CREATE TABLE `task_accomplishments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `q_input` varchar(100) DEFAULT NULL,
  `e_input` varchar(100) DEFAULT NULL,
  `t_input` varchar(100) DEFAULT NULL,
  `q_rating` tinyint(4) DEFAULT NULL,
  `e_rating` tinyint(4) DEFAULT NULL,
  `t_rating` tinyint(4) DEFAULT NULL,
  `final_rating` decimal(3,2) DEFAULT NULL,
  `actual_accomplishment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_performance_standards`
--

CREATE TABLE `task_performance_standards` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `rating_level` int(11) NOT NULL,
  `accomplishment_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `role` enum('admin','moderator','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `role`, `created_at`) VALUES
(1, 'Rey L. Patlunag', 'user', '2026-02-01 03:29:18'),
(2, 'Victoria June T. Felias', 'user', '2026-02-01 03:29:18'),
(3, 'Aulmonjay F. Romo', 'user', '2026-02-01 03:29:18'),
(4, 'Lykah W. Tiu', 'user', '2026-02-01 03:29:18'),
(5, 'JAN MARK S. GUIBONE', 'moderator', '2026-02-01 03:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_tasks`
--

CREATE TABLE `user_tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tasks`
--

INSERT INTO `user_tasks` (`id`, `user_id`, `task_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 13),
(13, 1, 14),
(14, 1, 17),
(15, 1, 19),
(16, 1, 20),
(17, 1, 21),
(18, 1, 26),
(19, 1, 30),
(20, 1, 40),
(21, 1, 41),
(4, 1, 52),
(5, 1, 57),
(32, 2, 1),
(36, 2, 5),
(37, 2, 6),
(38, 2, 7),
(39, 2, 9),
(40, 2, 10),
(41, 2, 11),
(42, 2, 13),
(43, 2, 14),
(44, 2, 17),
(45, 2, 23),
(46, 2, 25),
(47, 2, 27),
(48, 2, 28),
(49, 2, 31),
(50, 2, 33),
(51, 2, 39),
(33, 2, 42),
(34, 2, 49),
(35, 2, 57),
(66, 3, 4),
(67, 3, 6),
(68, 3, 9),
(69, 3, 17),
(70, 3, 18),
(71, 3, 27),
(72, 3, 29),
(63, 3, 42),
(64, 3, 49),
(65, 3, 52),
(80, 4, 9),
(81, 4, 12),
(82, 4, 15),
(83, 4, 16),
(84, 4, 18),
(85, 4, 22),
(86, 4, 29),
(87, 4, 34),
(88, 4, 38),
(78, 4, 51),
(79, 4, 55),
(93, 5, 1),
(94, 5, 2),
(95, 5, 3),
(112, 5, 4),
(113, 5, 5),
(114, 5, 6),
(115, 5, 7),
(116, 5, 8),
(117, 5, 9),
(118, 5, 10),
(119, 5, 11),
(120, 5, 12),
(121, 5, 13),
(122, 5, 14),
(123, 5, 15),
(124, 5, 16),
(125, 5, 17),
(126, 5, 18),
(127, 5, 19),
(128, 5, 20),
(129, 5, 21),
(130, 5, 22),
(131, 5, 23),
(132, 5, 24),
(133, 5, 25),
(134, 5, 26),
(135, 5, 27),
(136, 5, 28),
(137, 5, 29),
(138, 5, 30),
(139, 5, 31),
(140, 5, 32),
(141, 5, 33),
(142, 5, 34),
(143, 5, 35),
(144, 5, 36),
(145, 5, 37),
(146, 5, 38),
(147, 5, 39),
(148, 5, 40),
(149, 5, 41),
(96, 5, 42),
(97, 5, 43),
(98, 5, 44),
(99, 5, 45),
(100, 5, 46),
(101, 5, 47),
(102, 5, 48),
(103, 5, 49),
(104, 5, 50),
(105, 5, 51),
(106, 5, 52),
(107, 5, 53),
(108, 5, 54),
(109, 5, 55),
(110, 5, 56),
(111, 5, 57);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_periods`
--
ALTER TABLE `login_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_matrix`
--
ALTER TABLE `rating_matrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `task_code` (`task_code`);

--
-- Indexes for table `task_accomplishments`
--
ALTER TABLE `task_accomplishments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`task_id`,`period_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `period_id` (`period_id`);

--
-- Indexes for table `task_performance_standards`
--
ALTER TABLE `task_performance_standards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `full_name` (`full_name`);

--
-- Indexes for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`task_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_periods`
--
ALTER TABLE `login_periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rating_matrix`
--
ALTER TABLE `rating_matrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `task_accomplishments`
--
ALTER TABLE `task_accomplishments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_performance_standards`
--
ALTER TABLE `task_performance_standards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task_accomplishments`
--
ALTER TABLE `task_accomplishments`
  ADD CONSTRAINT `task_accomplishments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `task_accomplishments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `task_accomplishments_ibfk_3` FOREIGN KEY (`period_id`) REFERENCES `login_periods` (`id`);

--
-- Constraints for table `task_performance_standards`
--
ALTER TABLE `task_performance_standards`
  ADD CONSTRAINT `task_performance_standards_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD CONSTRAINT `user_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
