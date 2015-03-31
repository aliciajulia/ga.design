-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 06 feb 2015 kl 10:47
-- Serverversion: 5.6.20
-- PHP-version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `ga`
--
CREATE DATABASE IF NOT EXISTS `ga` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ga`;

-- --------------------------------------------------------

--
-- Tabellstruktur `behandlingar`
--

DROP TABLE IF EXISTS `behandlingar`;
CREATE TABLE IF NOT EXISTS `behandlingar` (
`id` int(11) NOT NULL,
  `namn` varchar(30) NOT NULL,
  `längd` int(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumpning av Data i tabell `behandlingar`
--

INSERT INTO `behandlingar` (`id`, `namn`, `längd`) VALUES
(5, 'taktil', 30),
(6, 'taktil', 60);

-- --------------------------------------------------------

--
-- Tabellstruktur `inlog`
--

DROP TABLE IF EXISTS `inlog`;
CREATE TABLE IF NOT EXISTS `inlog` (
  `anvnam` varchar(20) NOT NULL,
  `losord` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `inlog`
--

INSERT INTO `inlog` (`anvnam`, `losord`) VALUES
('inger', 'inger');

-- --------------------------------------------------------

--
-- Tabellstruktur `tider`
--

DROP TABLE IF EXISTS `tider`;
CREATE TABLE IF NOT EXISTS `tider` (
`id` int(11) NOT NULL,
  `starttid` datetime NOT NULL,
  `sluttid` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `tider`
--

INSERT INTO `tider` (`id`, `starttid`, `sluttid`) VALUES
(4, '2014-05-20 14:00:00', '2014-05-20 15:30:00'),
(5, '2014-04-20 14:00:00', '2014-04-20 14:30:00'),
(6, '2014-05-20 15:00:00', '2014-05-20 16:30:00'),
(7, '2014-05-20 16:00:00', '2014-05-20 17:30:00'),
(8, '2014-05-20 16:00:00', '2014-05-20 17:30:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `tider2`
--

DROP TABLE IF EXISTS `tider2`;
CREATE TABLE IF NOT EXISTS `tider2` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `starttid` time NOT NULL,
  `sluttid` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `tider2`
--

INSERT INTO `tider2` (`id`, `datum`, `starttid`, `sluttid`) VALUES
(1, '2015-02-08', '12:00:00', '17:00:00'),
(2, '2015-02-09', '10:00:00', '17:00:00');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `behandlingar`
--
ALTER TABLE `behandlingar`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `inlog`
--
ALTER TABLE `inlog`
 ADD PRIMARY KEY (`anvnam`);

--
-- Index för tabell `tider`
--
ALTER TABLE `tider`
 ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tider2`
--
ALTER TABLE `tider2`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `behandlingar`
--
ALTER TABLE `behandlingar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT för tabell `tider`
--
ALTER TABLE `tider`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT för tabell `tider2`
--
ALTER TABLE `tider2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
