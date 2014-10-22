-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2014 at 10:32 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fri_sandbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `published` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `published`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet consectetuer nec tincidunt rhoncus dolor nibh. Pretium ligula enim sed pellentesque orci pretium Maecenas vel semper eget. Pellentesque consectetuer leo laoreet tincidunt semper Nulla nulla non ligula semper. Neque sed Maecenas Integer tortor mollis velit laoreet eu orci non. Orci convallis non magnis et orci eu Sed.\r\n\r\n', '2014-10-01 00:00:00'),
(2, 'Accumsan ligula et enim lacinia', 'Accumsan ligula et enim lacinia Sed condimentum Phasellus convallis neque consectetuer. Suspendisse porttitor facilisis Aliquam urna hendrerit euismod at vitae interdum elit. Nulla Curabitur adipiscing congue et rhoncus montes sociis urna eget ultrices. Adipiscing Phasellus tempor adipiscing consequat enim et purus In nunc venenatis. Tincidunt metus libero Nam mus consequat eget Curabitur ut quis consectetuer. Sit dignissim quis malesuada Nam porta ante rutrum nulla dignissim nunc. Turpis adipiscing In.', '2014-10-02 00:00:00'),
(3, 'Dolor lorem orci consequat nibh', 'Dolor lorem orci consequat nibh tincidunt tellus vitae ligula interdum cursus. Semper congue mattis ac velit nunc at pretium in pellentesque laoreet. Nulla turpis vitae condimentum eget Aenean Aliquam Phasellus Lorem mollis Nunc. Et pretium nulla Donec magnis consequat consectetuer pede convallis ligula faucibus. Pellentesque ac gravida orci elit netus Vestibulum Nullam vel nibh turpis. Eros pede id fames vel at venenatis turpis.', '2014-10-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_slovak_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `name`, `description`) VALUES
(1, '5Z123', 'Skupina studentov 5Z123'),
(2, '5w4s214', 'Skupina studentov 5w4s214');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `surname`, `email`, `password`, `age`, `last_login`) VALUES
(3, 'Danndy', 'Dvonc', 'sk8danny@azet.sk', '$2y$10$qdbN7jqQAJol2fANI.5zyeaO8jMKhquuBiKRM7Sbm02ouGs2FkEZG', 23, '0000-00-00 00:00:00'),
(4, 'dsa', 'dsa', 'daniel.dvonc355@gmail.com', '$2y$10$XqbRVVe0mc4lX3Brh6XI9.nb/de5X/sjbbojU1NsMx4qjxpwNSvle', 15, '2014-10-20 22:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
