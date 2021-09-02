-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 10, 2021 at 07:44 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`, `name`, `phone`, `email`) VALUES
(1, 'admin', 'admin', 1234567890, 'aa@aa.aa');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_name` varchar(255) NOT NULL,
  `b_description` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` int(255) NOT NULL,
  `category` varchar(2552) NOT NULL,
  `isbn` int(30) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_name`, `b_description`, `quantity`, `author`, `year`, `category`, `isbn`, `photo`, `language`) VALUES
('Let us C', 'Programming', 5, 'Yashwant Kanitker', 2010, 'Programming', 1231, 'uploads/60d79219a6bda0.90114376.png', 'English'),
('Flask', 'Programming', 8, 'KK', 2008, 'Programming', 1981, 'uploads/60d82dc79296e0.63577235.png', 'English'),
('Node.js', 'Programming', 10, 'whatever', 2010, 'Programming', 1992, 'uploads/60cefe53c5dd94.98713064.png', 'English'),
('C++', 'Programming', 5, 'KK', 2008, 'Programming', 3231, 'uploads/60d79462702902.28865575.png', 'English'),
('Django', '', 14, 'KK', 2014, 'Programming', 5555, 'uploads/60e16762dc0956.15729749.png', 'English'),
('Flask', 'Programming', 15, 'Jugantar', 2010, 'Programming', 6121, 'uploads/60ccf67f08a2e6.58247174.png', 'English'),
('Django', 'Programming', 15, 'Whomever', 2010, 'Programming', 6454, 'uploads/60ccf61f53f215.48680638.png', 'English'),
('JAva', '', 5, 'Khesari', 2018, 'Programming', 6677, 'uploads/60e1fdc6710bb8.01623630.png', 'English'),
('javascript', 'programming', 5, 'medhi', 2019, 'programming', 8222, 'uploads/60d82febf066a3.67124425.png', 'English'),
('Django', 'Programming', 3, 'whatever', 2010, 'Programming', 19998, 'uploads/60d792a40b01d4.39269158.png', 'English'),
('Let us C', 'Programming', 5, 'Whomever', 2006, 'Programming', 66666, 'uploads/60d771c0a823a3.91349448.png', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `book_issue`
--

CREATE TABLE `book_issue` (
  `transaction_id` bigint(20) NOT NULL,
  `b_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  `issue_status` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_issue`
--

INSERT INTO `book_issue` (`transaction_id`, `b_id`, `s_id`, `issue_date`, `return_date`, `issue_status`) VALUES
(1, 802267, 1447, '2021-06-01', '2021-09-01', 'RET'),
(2, 154997, 1444, '2021-03-01', '2021-06-01', 'RET'),
(3, 709298, 1444, '2021-05-01', '2021-08-01', 'RET'),
(4, 672723, 1445, '2021-05-01', '2021-08-01', 'ACQ'),
(5, 624132, 1445, '2021-06-25', '2021-09-25', 'ACQ'),
(6, 366485, 1446, '2021-04-01', '2021-07-01', 'ACQ'),
(7, 289100, 1446, '2021-06-01', '2021-09-01', 'ACQ'),
(8, 744438, 1447, '2021-04-01', '2021-07-01', 'ACQ'),
(9, 845249, 1444, '2021-07-07', '2021-10-07', 'ACQ'),
(10, 594137, 1444, '2021-07-08', '2021-10-08', 'ACQ'),
(11, 802267, 1444, '2021-07-08', '2021-10-08', 'RET'),
(12, 802267, 1444, '2021-07-08', '2021-10-08', 'ACQ');

--
-- Triggers `book_issue`
--
DELIMITER $$
CREATE TRIGGER `status_issued` AFTER INSERT ON `book_issue` FOR EACH ROW UPDATE `book_status` SET `status` = 1
WHERE `b_id` = NEW.b_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status_returned` AFTER UPDATE ON `book_issue` FOR EACH ROW BEGIN
  	IF(NEW.issue_status!=OLD.issue_status AND 	NEW.issue_status = 'RET') THEN
    	UPDATE book_status SET status = 0 WHERE b_id = NEW.b_id;

	END IF;    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book_status`
--

CREATE TABLE `book_status` (
  `b_id` int(11) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_status`
--

INSERT INTO `book_status` (`b_id`, `isbn`, `status`) VALUES
(802267, '1992', 1),
(594137, '1981', 0),
(154997, '1981', 1),
(586809, '1981', 0),
(652527, '8222', 0),
(845249, '8222', 1),
(709298, '8222', 1),
(537541, '8222', 0),
(624132, '8222', 1),
(425710, '5555', 0),
(672723, '1981', 1),
(466151, '1981', 0),
(658106, '1981', 0),
(366485, '1981', 1),
(486904, '1981', 0),
(667160, '6677', 0),
(289100, '6677', 1),
(744438, '6677', 1),
(402139, '6677', 0),
(261580, '6677', 0);

--
-- Triggers `book_status`
--
DELIMITER $$
CREATE TRIGGER `decrease_quantity_of _books` AFTER DELETE ON `book_status` FOR EACH ROW UPDATE `books` set quantity = quantity-1 where isbn = OLD.isbn
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(255) NOT NULL,
  `s_name` varchar(2552) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `s_phone` int(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `s_name`, `s_password`, `s_email`, `s_phone`, `s_address`, `department`) VALUES
(1444, 'Kaushik Medhi', 'k', 'k@m.com', 78998798, 'JKJSHkshKJSH', 'MCA'),
(1445, 'Meghna Dutta', '', 'meghna@gmail.com', 1234567, 'Assam', 'MCA'),
(1446, 'Ankur Das', '', 'ankur@gmail.com', 1234567, 'Assam', 'MCA'),
(1447, 'Anirban Sharma', '', 'anirban@gmail.com', 1234567, 'Assam', 'MCA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `book_status`
--
ALTER TABLE `book_status`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_issue`
--
ALTER TABLE `book_issue`
  MODIFY `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1448;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
