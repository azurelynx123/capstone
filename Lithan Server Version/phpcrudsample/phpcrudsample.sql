-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 13, 2018 at 05:27 PM
-- Server version: 5.6.39-log
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpcrudsample`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_feedback`
--

CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comments` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tb_feedback`
--

INSERT INTO `tb_feedback` (`id`, `firstname`, `lastname`, `email`, `comments`) VALUES
(3, 'efefd', 'efrfr4f', 'wong@hotmail.com', 'efervrv'),
(4, 'wong', 'lee', 'ww@hotmail.com', 'complain about ...'),
(6, 'wong', 'lee', 'ww@hotmail.com', 'complain about ...'),
(7, 'dsadas', 'asddasads', 'asddasd@gmail.com', 'ctyiftupogyu'),
(8, 'Md Nur Erfan', 'Md Nassir', 'mdnurerfan@gmail.com', 'commmentssssssss'),
(9, 'Md Nur Erfan', 'Md Nassir', 'mderfan@gmail.com', '2nd Commmentssss'),
(10, 'Md Nur Erfan', 'Md Nassir', 'mderfan@gmail.com', '3rd Comment'),
(11, 'Md Nur Erfan', 'Md Nassir', 'mdnurerfan105@gmail.com', '4th Comment'),
(12, 'Lizzy', 'Maguire', 'LizzyM@gmail.com', 'The Comment'),
(13, 'Lizzy', 'Maguire', 'LizzyM@gmail.com', 'The Comment');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `account_creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) DEFAULT NULL,
  `subscription` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `firstname`, `lastname`, `email`, `password`, `account_creation_time`, `role`, `subscription`) VALUES
(2, 'Muhammad Nur Erfan Bin', 'Nassir', 'mdnurerfan105@gmail.com', '$2y$10$p2ARYTDmeu43fDWz67owKer2I6KqWkQN9PCRcBMZvlLktC4GSO/jq', '2018-03-31 14:17:37', 'admin', 1),
(4, 'Md Nur Erfan', 'Md Nassir', 'temporesta@gmail.com', '$2y$10$xrsz1l6Q50aakesT43CmV.umgjqu0R/2cjjC7GqAgWocNIEfqCwwG', '2018-04-01 18:09:07', 'user', 1),
(5, 'New', 'User2', 'newuser2@gmail.com', '$2y$10$hq80t.tSLjnhOHamILq0VuBPreINjwpYiXcUscq2PFsdUZN56yLju', '2018-04-03 16:58:49', 'user', 1),
(7, 'New', 'User4', 'newuser4@gmail.com', '$2y$10$3BAMiLFE5eHPsoLZu31cjeGytpRpYQMIZdah6T5tpYdbk2/qZ5pFy', '2018-04-03 17:00:13', 'user', 0),
(9, 'Adam', 'Lambert', 'AdamL@gmail.com', '$2y$10$vwAg3.cCG1yx6ut97xwL1OyJL6LyX1r1WcZIqUwRdTNd9JGg6d84q', '2018-04-06 09:44:32', 'user', 1),
(10, 'Victoria', 'Ice', 'IcyVic@gmail.com', '$2y$10$4rZNn64EtnHKJh0mXbJS7.GZ4jT7FWHEcUWHgz.iSIMBU8TBqNAy2', '2018-04-30 09:07:13', 'user', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
