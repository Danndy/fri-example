-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 15.Okt 2014, 13:25
-- Verzia serveru: 5.6.20
-- Verzia PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `fri_sandbox`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `article`
--

CREATE TABLE IF NOT EXISTS `article` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `published` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Sťahujem dáta pre tabuľku `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `published`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet consectetuer nec tincidunt rhoncus dolor nibh. Pretium ligula enim sed pellentesque orci pretium Maecenas vel semper eget. Pellentesque consectetuer leo laoreet tincidunt semper Nulla nulla non ligula semper. Neque sed Maecenas Integer tortor mollis velit laoreet eu orci non. Orci convallis non magnis et orci eu Sed.\r\n\r\n', '2014-10-01 00:00:00'),
(2, 'Accumsan ligula et enim lacinia', 'Accumsan ligula et enim lacinia Sed condimentum Phasellus convallis neque consectetuer. Suspendisse porttitor facilisis Aliquam urna hendrerit euismod at vitae interdum elit. Nulla Curabitur adipiscing congue et rhoncus montes sociis urna eget ultrices. Adipiscing Phasellus tempor adipiscing consequat enim et purus In nunc venenatis. Tincidunt metus libero Nam mus consequat eget Curabitur ut quis consectetuer. Sit dignissim quis malesuada Nam porta ante rutrum nulla dignissim nunc. Turpis adipiscing In.', '2014-10-02 00:00:00'),
(3, 'Dolor lorem orci consequat nibh', 'Dolor lorem orci consequat nibh tincidunt tellus vitae ligula interdum cursus. Semper congue mattis ac velit nunc at pretium in pellentesque laoreet. Nulla turpis vitae condimentum eget Aenean Aliquam Phasellus Lorem mollis Nunc. Et pretium nulla Donec magnis consequat consectetuer pede convallis ligula faucibus. Pellentesque ac gravida orci elit netus Vestibulum Nullam vel nibh turpis. Eros pede id fames vel at venenatis turpis.', '2014-10-03 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
