-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.20
-- PHP Version: 5.5.15

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
-- Структура на таблица `blog_post_tags`
--

CREATE TABLE IF NOT EXISTS `blog_post_tags` (
  `blog_post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `cat`
--

CREATE TABLE IF NOT EXISTS `cat` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Схема на данните от таблица `cat`
--

INSERT INTO `cat` (`id`, `name`) VALUES
(4, 'aaaaaaa'),
(12, 'pesho'),
(13, 'asd'),
(15, 'adw');

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Схема на данните от таблица `comments`
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
-- Структура на таблица `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `author` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `visits` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Схема на данните от таблица `posts`
--

INSERT INTO `posts` (`id`, `title`, `article`, `author`, `cat_id`, `date`, `visits`) VALUES
(34, 'Test', 'content test', 8, 4, 1418668998, 17),
(35, 'post2', 'ajiwdjwaiawjdiawjdi\r\nawjjwadoaowdj\r\ndadkoawdwak\r\nwodkwoawd', 8, 4, 1418669526, 2),
(36, 'sda', 'sad', 8, 4, 1418732244, 0);

-- --------------------------------------------------------

--
-- Структура на таблица `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Схема на данните от таблица `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'dshj'),
(2, 'jksjd'),
(3, 'jdskjd'),
(4, 'dshj'),
(5, 'jksjd'),
(6, 'jdskjd');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES
(8, 'test', 'cfcd208495d565ef66e7dff9f98764da', 'test@test.bg', 0),
(9, 'aaaa', 'cfcd208495d565ef66e7dff9f98764da', 'aaaa@aaaa.bg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
