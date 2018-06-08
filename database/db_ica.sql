-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 08:31 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ica`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courseapp`
--

CREATE TABLE `tbl_courseapp` (
  `id` int(10) UNSIGNED NOT NULL,
  `a_name` varchar(250) NOT NULL,
  `a_surname` varchar(250) NOT NULL,
  `a_dob` date NOT NULL,
  `a_idnumber` varchar(15) NOT NULL,
  `a_address` varchar(150) NOT NULL,
  `a_mobile` int(11) NOT NULL,
  `a_email` varchar(300) NOT NULL,
  `a_nationality` varchar(30) NOT NULL,
  `tbl_courses_id` mediumint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_courseapp`
--

INSERT INTO `tbl_courseapp` (`id`, `a_name`, `a_surname`, `a_dob`, `a_idnumber`, `a_address`, `a_mobile`, `a_email`, `a_nationality`, `tbl_courses_id`) VALUES
(1, 'johnny', 'borg', '1997-10-22', '123467', 'big street', 99460017, 'yannickfarrugia@gmail.com', 'Malta', 1),
(4, 'Yannick', 'Farrugia', '1997-10-22', '413297m', 'Triq Ic- Ciefa, 10', 79221097, 'yannick@gmail.com', 'Malta', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `id` mediumint(5) UNSIGNED NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_code` varchar(10) NOT NULL,
  `c_duration` tinyint(4) NOT NULL,
  `c_mqf` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`id`, `c_name`, `c_code`, `c_duration`, `c_mqf`) VALUES
(1, 'Bachelor of Arts (Honours) in Interactive Media', 'AD6-05-15', 3, '6'),
(2, 'MCAST Advanced Diploma in Creative Media Production', 'AD4-02-15', 2, '4'),
(3, 'Bachelor of Arts (Honours) in Fine Art', 'AD6-02-15', 3, '5'),
(4, 'MCAST Advanced Diploma in Art and Design', 'CA4-05-17', 3, '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job`
--

CREATE TABLE `tbl_job` (
  `id` int(10) UNSIGNED NOT NULL,
  `j_name` varchar(45) NOT NULL,
  `j_desc` varchar(1000) NOT NULL,
  `j_url` varchar(500) NOT NULL,
  `tbl_jroles_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_job`
--

INSERT INTO `tbl_job` (`id`, `j_name`, `j_desc`, `j_url`, `tbl_jroles_id`) VALUES
(1, 'Temporary Admissions Clerks', 'The Malta College of Arts, Science and Technology is seeking to appoint Clerks for the summer of 2018 who would be providing administrative and clerical support in the Registrar’s office. Selected candidates are expected to provide a high standard/quality of work and service throughout the office.', 'http://jobs.mcast.edu.mt/en/job/30a3354228(3(773b-481e-a0(2(481e-a08a-23726da(66', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jtype`
--

CREATE TABLE `tbl_jtype` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_jtype`
--

INSERT INTO `tbl_jtype` (`id`, `name`) VALUES
(1, 'internal'),
(2, 'public');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `email`, `password`, `salt`, `role_id`) VALUES
(2, 'db@mail.com', '$2y$10$XUIKlyDzRhpS5N771ZNQk.2EHCROPsgdyQnbFe/QzWwoYFR6JkxZC', 'eb415e5cb74674fd', 2),
(4, 'DC@gmail.com', '$2y$10$Seu2ge/dTjMZ6uFdDYEptuue4zcHuTjsSqsxs8x4vFEru8ZC8GA8K', 'e45fda757db67d3e', 3),
(5, 'yannickfarrugia@gmail.com', '$2y$10$SiKyDWEiM/ysNcboQGMNYeSXFmj/u1xLOoxvkknjdxpoXNzO8tyDy', 'a498a624246396ad', 1),
(7, 'lp@gmail.com', '$2y$10$iCSRmwGNMsYn2wGLHB.qGuUFJmNaWNpC32Sc3zaB0jQblCZKiVVCS', 'b59b28c87621a266', 3),
(8, 'la@gmail.com', '$2y$10$wv5UYklUTr/i.R6MSxQji.7e1YzaxIlmWXbKJDPHQtUimZOZLrWdW', 'c80fb053b03ecb4f', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_info`
--

CREATE TABLE `tbl_login_info` (
  `login_time` int(11) UNSIGNED NOT NULL,
  `persistence` varchar(100) DEFAULT NULL,
  `tbl_Login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_login_info`
--

INSERT INTO `tbl_login_info` (`login_time`, `persistence`, `tbl_Login_id`) VALUES
(1528475130, '27413014752b8bbd737c36dbc269e0ec', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Students');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sick`
--

CREATE TABLE `tbl_sick` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_date` int(10) UNSIGNED DEFAULT NULL,
  `tbl_Login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userdetails`
--

CREATE TABLE `tbl_userdetails` (
  `name` varchar(250) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `about` varchar(500) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `tbl_Login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_userdetails`
--

INSERT INTO `tbl_userdetails` (`name`, `surname`, `about`, `mobile`, `tbl_Login_id`) VALUES
('Darren', 'Black', '', '', 2),
('Daniel', 'Cassar', 'I like to create games for funnnnn!!!!!! I have a long beard :)', '99460017', 4),
('Yannick ', 'Farrugia', 'I am a student studying Interactive media. I like to create websites and games. I love playing video games and that was what aspired me to continue on this course.', '79221097', 5),
('Luke', 'Parnis', 'Hello I am Luke. I am a Graphic design student and I like to create logos.', '99460017', 7),
('Lorella', 'Aquilina', 'I am lorella and I like to play video games. I am an interactive media student and I love creating 3D models', '99422017', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_in_course`
--

CREATE TABLE `tbl_user_in_course` (
  `tbl_Login_id` int(11) NOT NULL,
  `tbl_courses_id` mediumint(5) UNSIGNED NOT NULL,
  `course_year` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_courseapp`
--
ALTER TABLE `tbl_courseapp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_courseapp_tbl_courses_idx` (`tbl_courses_id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_job_tbl_jroles1_idx` (`tbl_jroles_id`);

--
-- Indexes for table `tbl_jtype`
--
ALTER TABLE `tbl_jtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_Login_tbl_roles1_idx` (`role_id`);

--
-- Indexes for table `tbl_login_info`
--
ALTER TABLE `tbl_login_info`
  ADD KEY `fk_login_info_tbl_Login1_idx` (`tbl_Login_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sick`
--
ALTER TABLE `tbl_sick`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_sick_tbl_Login1_idx` (`tbl_Login_id`);

--
-- Indexes for table `tbl_userdetails`
--
ALTER TABLE `tbl_userdetails`
  ADD KEY `fk_tbl_userdetails_tbl_Login1_idx` (`tbl_Login_id`);

--
-- Indexes for table `tbl_user_in_course`
--
ALTER TABLE `tbl_user_in_course`
  ADD KEY `fk_tbl_Login_has_tbl_courses_tbl_courses1_idx` (`tbl_courses_id`),
  ADD KEY `fk_tbl_Login_has_tbl_courses_tbl_Login1_idx` (`tbl_Login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_courseapp`
--
ALTER TABLE `tbl_courseapp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `id` mediumint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_job`
--
ALTER TABLE `tbl_job`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jtype`
--
ALTER TABLE `tbl_jtype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sick`
--
ALTER TABLE `tbl_sick`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_courseapp`
--
ALTER TABLE `tbl_courseapp`
  ADD CONSTRAINT `fk_tbl_courseapp_tbl_courses` FOREIGN KEY (`tbl_courses_id`) REFERENCES `tbl_courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD CONSTRAINT `fk_tbl_job_tbl_jroles1` FOREIGN KEY (`tbl_jroles_id`) REFERENCES `tbl_jtype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `fk_tbl_Login_tbl_roles1` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_login_info`
--
ALTER TABLE `tbl_login_info`
  ADD CONSTRAINT `fk_login_info_tbl_Login1` FOREIGN KEY (`tbl_Login_id`) REFERENCES `tbl_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sick`
--
ALTER TABLE `tbl_sick`
  ADD CONSTRAINT `fk_tbl_sick_tbl_Login1` FOREIGN KEY (`tbl_Login_id`) REFERENCES `tbl_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_userdetails`
--
ALTER TABLE `tbl_userdetails`
  ADD CONSTRAINT `fk_tbl_userdetails_tbl_Login1` FOREIGN KEY (`tbl_Login_id`) REFERENCES `tbl_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_in_course`
--
ALTER TABLE `tbl_user_in_course`
  ADD CONSTRAINT `fk_tbl_Login_has_tbl_courses_tbl_Login1` FOREIGN KEY (`tbl_Login_id`) REFERENCES `tbl_login` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_Login_has_tbl_courses_tbl_courses1` FOREIGN KEY (`tbl_courses_id`) REFERENCES `tbl_courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
