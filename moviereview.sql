-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2019 at 08:45 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moviereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `m_id` int(10) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `poster` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`m_id`, `m_name`, `genre`, `poster`) VALUES
(1, 'A Beautiful Mind', 'Drama', 'abeautifulmind.jpg'),
(2, 'Forrest Gump', 'Drama', 'forestgump.jpg'),
(3, 'The Godfather', 'Drama', 'thegodfather.jpg'),
(4, 'The Dark Knight', 'Thriller', 'thedarkknight.jpg'),
(6, 'The Shawshank Redemption', 'Drama', 'shawshank.jpg'),
(7, 'Titanic', 'Drama', 'shawshank1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `r_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `post` longtext,
  `rating` tinyint(3) unsigned NOT NULL,
  `point` int(11) DEFAULT NULL,
  `approve` tinyint(1) NOT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`r_id`, `u_id`, `post`, `rating`, `point`, `approve`, `m_id`) VALUES
(66, 2, 'A Nice Movie!!!!!!!', 0, 1, 1, 4),
(67, 3, 'A Famous movie!!!', 0, 0, 1, 2),
(68, 14, 'A Nice Movie!!!!!!!', 0, 1, 1, 1),
(69, 5, 'A Excellent Movie!!', 0, 1, 1, 3),
(70, 1, 'A Nice Movie', 0, 1, 1, 6),
(71, 1, 'A Excellent Movie!!', 0, 1, 1, 1),
(72, 1, 'On July 6, 1994, Paramount unveiled Robert Zemeckis'' Forrest Gump in theaters. The Tom Hanks satire would go on to win six Oscars at the 67th Academy Awards, including best picture. The Hollywood Reporter''s original review is below:  Forrest Gump is not stupid. Although his IQ is 75, he sees the world far clearer than most. Through his decent, childlike eyes, we too see things in a less confused and muddled way. In this cheerfully straight-arrow moral tale, Tom Hanks stars as the "wise fool" Forrest Gump and delivers yet another Oscar-level performance. Paramount will win sensational box office with this Robert Zemeckis-directed film. ', 0, 1, 1, 2),
(73, 1, 'A Nice Movie!!!!!!!', 0, 0, 1, 1),
(74, 2, 'A Nice Movie!!!!!!!', 0, 0, 1, 3),
(75, 1, 'A Excellent Movie!!', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE IF NOT EXISTS `reviewer` (
  `u_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pwd` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`u_id`, `name`, `email`, `pwd`) VALUES
(1, 'dawood', 'daw@mail.com', 1234),
(2, 'daw', 'dawm@mail.com', 1234),
(3, 'qwe', 'qwe@gmail.com', 1234),
(4, 'asd', 'asd@gmail.com', 1234),
(5, 'dawoodw', 'dawoodw@gmail.com', 1234),
(13, 'qwer', 'qwer@gmail.com', 1234),
(14, 'qwere', 'qwere@gmail.com', 123),
(15, 'asdf', 'asdf@gmail.com', 123),
(16, 'asdw', 'asdw@gmail.com', 1234),
(17, 'asdu', 'asdu@gmail.com', 1234),
(18, 'asdfq', 'asdfq@gmail.com', 1234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`r_id`), ADD KEY `u_id` (`u_id`), ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`u_id`), ADD UNIQUE KEY `name` (`name`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `m_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `reviewer` (`u_id`),
ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`m_id`) REFERENCES `movie` (`m_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
