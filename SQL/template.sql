-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2015 at 09:32 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `Parameter` text COLLATE utf8_unicode_ci NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`Parameter`, `Value`) VALUES
('AddKey', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE IF NOT EXISTS `cookies` (
`id` int(11) NOT NULL,
  `selector` text NOT NULL,
  `validator` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

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
(7, 'Lamp E', '01000000', '0', 'light'),
(8, 'Door', '10000000', '0', 'door');

--
-- Triggers `devices`
--
DELIMITER //
CREATE TRIGGER `i2c_update` AFTER UPDATE ON `devices`
 FOR EACH ROW BEGIN 

DECLARE ret int(10); 

SET ret = sys_exec(CONCAT('python /var/www/html/api/i2c.py ',NEW.code,' ',NEW.status)); 
END
//
DELIMITER ;

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
(31, '8847572', 'Axl', 'Guns''n''roses', 1, '2015-05-02 12:18:17', '0', '10008700D4'),
(32, '8907095', 'Angus', 'ACDC', 1, '2015-05-02 12:18:23', '0', '100087E957'),
(33, '8853015', 'Malcolm', 'ACDC', 1, '2015-05-02 12:18:26', '0', '1000871617'),


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `value` text NOT NULL,
  `spare` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `parameter`, `value`, `spare`) VALUES
(1, 'door_time', '2', ''),
(2, 'i2c_th', '0x48', ''),
(3, 'i2c_rh', '0x40', ''),
(4, 'tos', '25', ''),
(5, 'thyst', '23', ''),
(6, 'temp', '27.0', '');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE IF NOT EXISTS `timetables` (
`id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` text NOT NULL,
  `category` text NOT NULL,
  `day` text NOT NULL,
  `time_from` int(11) NOT NULL,
  `time_to` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE IF NOT EXISTS `translations` (
`id` int(11) NOT NULL,
  `element` text CHARACTER SET latin1 NOT NULL,
  `lang` text CHARACTER SET latin1 NOT NULL,
  `value` text COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `element`, `lang`, `value`) VALUES
(1, 'hmenu', 'en_US', 'Menu'),
(2, 'hmenu', 'si_SL', 'Meni'),
(3, 'username', 'en_US', 'Username:'),
(4, 'username', 'si_SL', 'Uporabniško ime:'),
(5, 'password', 'en_US', 'Password:'),
(6, 'password', 'si_SL', 'Geslo:'),
(7, 'cookie', 'en_US', 'Remember me'),
(8, 'cookie', 'si_SL', 'Zapomni si me'),
(9, 'login', 'en_US', 'LOGIN'),
(10, 'login', 'si_SL', 'Prijava'),
(11, 'coretemp', 'en_US', 'Core temp: '),
(12, 'coretemp', 'si_SL', 'Temperatura jedra: '),
(13, 'storage', 'en_US', 'Storage: '),
(14, 'storage', 'si_SL', 'Shramba: '),
(15, 'free', 'en_US', 'Free: '),
(16, 'free', 'si_SL', 'Prosto: '),
(17, 'used', 'en_US', 'Used: '),
(18, 'used', 'si_SL', 'Zasedeno: '),
(19, 'system', 'en_US', 'System: '),
(20, 'system', 'si_SL', 'Sistem: '),
(21, 'size', 'en_US', 'Size: '),
(22, 'size', 'si_SL', 'Velikost: '),
(23, 'usage', 'en_US', 'Usage: '),
(24, 'usage', 'si_SL', 'Zasedenost: '),
(25, 'lights', 'en_US', 'Lights'),
(26, 'lights', 'si_SL', 'Luci'),
(27, 'lights', 'si_SL', 'Osvetljava'),
(28, 'heating', 'en_US', 'Heating'),
(29, 'heating', 'si_SL', 'Ogrevanje'),
(30, 'access', 'en_US', 'Access control'),
(31, 'access', 'si_SL', 'Kontrola dostopa'),
(32, 'settings', 'en_US', 'Settings'),
(33, 'settings', 'si_SL', 'Nastavitve'),
(34, 'diag', 'en_US', 'Diagnostics'),
(35, 'diag', 'si_SL', 'Diagnostika'),
(36, 'logout', 'en_US', 'Logout'),
(37, 'logout', 'si_SL', 'Odjava'),
(38, 'door', 'en_US', 'Door'),
(39, 'door', 'si_SL', 'Vrata'),
(40, 'users', 'en_US', 'Users'),
(41, 'users', 'si_SL', 'Uporabniki'),
(42, 'logs', 'en_US', 'Logs'),
(43, 'logs', 'si_SL', 'Dnevniki'),
(44, 'toggle', 'en_US', 'Toggle'),
(45, 'toggle', 'si_SL', 'Prehod'),
(46, 'open', 'en_US', 'Open'),
(47, 'open', 'si_SL', 'Odpri'),
(48, 'close', 'en_US', 'Close'),
(49, 'close', 'si_SL', 'Zapri'),
(50, 'door_state_open', 'en_US', 'The door is opened.'),
(51, 'door_state_open', 'si_SL', 'Vrata so odprta.'),
(52, 'door_state_closed', 'en_US', 'The door is closed.'),
(53, 'door_state_closed', 'si_SL', 'Vrata so zaprta.'),
(54, 'door_state_check', 'en_US', 'Checking the door state...'),
(55, 'door_state_check', 'si_SL', 'Preverjam stanje vrat...'),
(56, 'name', 'en_US', 'Name'),
(57, 'name', 'si_SL', 'Ime'),
(58, 'group', 'en_US', 'Group'),
(59, 'group', 'si_SL', 'Skupina'),
(60, 'added', 'en_US', 'Added on'),
(61, 'added', 'si_SL', 'Dodan'),
(62, 'edit', 'en_US', 'Edit'),
(63, 'edit', 'si_SL', 'Uredi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `pass` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `language` text COLLATE latin1_german1_ci NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `language`, `gid`) VALUES
(1, 'admin', '$2y$10$m6i1S6cl3DW0i72g5oGpQOsnq9gzWzYSqwgL9OcEiYMb5OSxSmwFW', 'si_SL', 0),
(2, 'test', '$2y$10$ycM1ArOm60v9VI6IyomDiOdbPUOuBGsaFLm7khPoSAMT08289E3B.', 'en_US', 1),

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
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=337;
--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
