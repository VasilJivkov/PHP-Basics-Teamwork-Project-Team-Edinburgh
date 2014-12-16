-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2014 at 03:32 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Type`) VALUES
('Programming'),
('Women'),
('Common Sense'),
('Linux');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `heading`, `author`, `content`, `category`, `date`) VALUES
(1, 'something', 'none', 'bla bla bla bla', 'Programming', ''),
(2, 'sadsadsad', 'none', 'asdsdfsdfsdfsd', 'Programming', ''),
(3, 'something else', 'none', 'asdsadasdasdsadsa', 'Programming', ''),
(4, 'something else', 'none', 'asdsadasdasdsadsa', 'Women', ''),
(5, 'the new one', 'none', 'asdasdas adasd\r\nas\r\nasd\r\nsa\r\n\r\nsad', 'Common Sense', '16-12-2014'),
(6, 'chmod777', 'none', 'This is something about linux', 'Linux', '16-12-2014'),
(7, 'asdasdasdasd', 'mihayloff', 'awaeaweadsad', 'Programming', '16-12-2014'),
(8, 'asdasdasd', 'mihayloff', 'asdasdasd', 'Programming', '16-12-2014');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`) VALUES
(1, 'mihayloff', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'asd@asd.com'),
(2, 'emil4o', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'emil@emil.com'),
(3, 'qwerty', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwer@qwe.com'),
(4, 'pesho', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'pesho@pesho.pesho'),
(5, 'atanas', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'asda@adsad.com'),
(6, 'filko', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'filko@filko.com'),
(7, 'chico', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'chico@email.com'),
(8, 'svetlin4o', '827ccb0eea8a706c4c34a16891f84e7b', 'svetlin@ads.com'),
(9, 'asshole', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'asshole.com@ads.com'),
(10, 'pencho', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'pecho@asd.com'),
(11, 'asdasd', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'asdasd@ads.com'),
(12, '', 'ef32883676f047fe440842fa09b3bf1b', ''),
(13, 'aaaaaaaaaaaaaaaaaaa', 'ef32883676f047fe440842fa09b3bf1b', 'aaaaaaaaaaaaaaaaaaa@asd.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
