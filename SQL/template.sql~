-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2015 at 05:53 PM
-- Server version: 10.0.22-MariaDB-0+deb8u1
-- PHP Version: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lcars`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccessLog`
--

CREATE TABLE IF NOT EXISTS `AccessLog` (
`ID` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Key` text COLLATE utf8_unicode_ci NOT NULL,
  `Action` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AccessLog`
--

INSERT INTO `AccessLog` (`ID`, `Time`, `Key`, `Action`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `Parameter` text COLLATE utf8_unicode_ci NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE IF NOT EXISTS `cookies` (
`id` int(11) NOT NULL,
  `selector` text NOT NULL,
  `validator` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
`id` int(11) NOT NULL,
  `device` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `code` varchar(55) COLLATE latin1_german1_ci NOT NULL DEFAULT '00000',
  `status` varchar(55) COLLATE latin1_german1_ci NOT NULL DEFAULT '0',
  `class` text COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device`, `code`, `status`, `class`) VALUES
(1, 'Heater', '00000001', '0', 'air'),
(2, 'Ventilation', '00000010', '0', 'air'),
(3, 'Lamp A', '00000100', '0', 'light'),
(4, 'Lamp B', '00001000', '0', 'light'),
(5, 'Lamp C', '00010000', '0', 'light'),
(6, 'Lamp D', '00100000', '0', 'light'),
(7, 'Namizna', '01000000', '1', 'light'),
(8, 'Kljucavnica', '10000000', '0', 'door');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
`ID` int(11) NOT NULL,
  `Key` text COLLATE utf8_unicode_ci NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Group` text COLLATE utf8_unicode_ci NOT NULL,
  `Active` int(1) NOT NULL,
  `Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Expires` text COLLATE utf8_unicode_ci NOT NULL,
  `Hex` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`ID`, `Key`, `Name`, `Group`, `Active`, `Added`, `Expires`, `Hex`) VALUES
(1, '8847572', 'Axl', 'Guns''n''roses', 1, '2015-05-02 12:18:17', '0', '10008700D4'),
(2, '8907095', 'Angus', 'ACDC', 1, '2015-05-02 12:18:23', '0', '100087E957'),
(3, '8853015', 'Malcolm', 'ACDC', 1, '2015-05-02 12:18:26', '0', '1000871617'),

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `value` text NOT NULL,
  `spare` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `parameter`, `value`, `spare`) VALUES
(1, 'door_time', '2', ''),
(2, 'i2c_th', '0x00', ''),
(3, 'i2c_rh', '0x00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `pass` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `gid`) VALUES
(1, 'admin', '$2y$10$m6i1S6cl3DW0i72g5oGpQOsnq9gzWzYSqwgL9OcEiYMb5OSxSmwFW', 0),
(2, 'test', '$2y$10$ycM1ArOm60v9VI6IyomDiOdbPUOuBGsaFLm7khPoSAMT08289E3B.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AccessLog`
--
ALTER TABLE `AccessLog`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
 ADD KEY `ID` (`ID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AccessLog`
--
ALTER TABLE `AccessLog`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=319;
--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
