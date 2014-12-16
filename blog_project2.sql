-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2014 at 10:51 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_project`
--
CREATE DATABASE IF NOT EXISTS `blog_project`;
USE `blog_project`;
-- --------------------------------------------------------

--
-- Table structure for table `blog_post_tags`
--

CREATE TABLE IF NOT EXISTS `blog_post_tags` (
  `blog_post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE IF NOT EXISTS `cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `name`) VALUES
(4, 'aaaaaaa'),
(12, 'pesho'),
(13, 'asd'),
(15, 'adw');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_name`, `content`, `post_id`) VALUES
(1, 'asdf', 'comment', 7),
(2, 'pesho', 'pesho''s comment', 7),
(3, 'NAME', 'Comment', 7),
(4, 'test', 'Logged comment', 7),
(5, 'asdf', 'asdf', 7),
(6, 'gosho', 'gosho is the best', 7),
(7, 'test', 'new comment', 7),
(8, 'test', 'i am comment from logged user', 34),
(12, 'test', 'logged comment', 35),
(13, 'Pesho  - guest', 'comment', 35);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `author` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `visits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `article`, `author`, `cat_id`, `date`, `visits`) VALUES
(34, 'Test', 'content test', 8, 4, 1418668998, 17),
(35, 'post2', 'ajiwdjwaiawjdiawjdi\r\nawjjwadoaowdj\r\ndadkoawdwak\r\nwodkwoawd', 8, 4, 1418669526, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(0, 'a'),
(0, 'b,c'),
(0, 'a'),
(0, 'b'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'jaidw'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'jiadw'),
(0, 'ajowd'),
(0, 'ajowd'),
(0, 'ajowd'),
(0, 'ajowd'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'gggg'),
(0, 'gggg'),
(0, 'ccc'),
(0, 'tag'),
(0, 'test'),
(0, 'e'),
(0, 'p'),
(0, 'g'),
(0, 'g'),
(0, 't'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, 'a'),
(0, ''),
(0, 'a'),
(0, 'aa'),
(0, 'j'),
(0, 'j'),
(0, 'adwaw'),
(0, 'adw'),
(0, 't'),
(0, 't'),
(0, 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES
(8, 'test', 'cfcd208495d565ef66e7dff9f98764da', 'test@test.bg', 0),
(9, 'aaaa', 'cfcd208495d565ef66e7dff9f98764da', 'aaaa@aaaa.bg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
