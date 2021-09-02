-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2021 at 06:10 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Table structure for table `book_issue`
--

DROP TABLE IF EXISTS `book_issue`;
CREATE TABLE IF NOT EXISTS `book_issue` (
  `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  `issue_status` varchar(5) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `b_id` (`b_id`),
  KEY `s_id` (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

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
DROP TRIGGER IF EXISTS `status_issued`;
DELIMITER $$
CREATE TRIGGER `status_issued` AFTER INSERT ON `book_issue` FOR EACH ROW UPDATE `book_status` SET `status` = 1
WHERE `b_id` = NEW.b_id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `status_returned`;
DELIMITER $$
CREATE TRIGGER `status_returned` AFTER UPDATE ON `book_issue` FOR EACH ROW BEGIN
  	IF(NEW.issue_status!=OLD.issue_status AND 	NEW.issue_status = 'RET') THEN
    	UPDATE book_status SET status = 0 WHERE b_id = NEW.b_id;

	END IF;    
END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
