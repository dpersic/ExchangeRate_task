-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2021 at 08:23 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rate`
--

DROP TABLE IF EXISTS `exchange_rate`;
CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `Unit` double NOT NULL,
  `BuyRateForeign` double NOT NULL,
  `MeanRate` double NOT NULL,
  `SellRateForeign` double NOT NULL,
  `Currency_name` varchar(50) CHARACTER SET utf16 COLLATE utf16_croatian_ci NOT NULL,
  `Currency_date` varchar(20) CHARACTER SET utf16 COLLATE utf16_croatian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii;

--
-- Dumping data for table `exchange_rate`
--

INSERT INTO `exchange_rate` (`Unit`, `BuyRateForeign`, `MeanRate`, `SellRateForeign`, `Currency_name`, `Currency_date`) VALUES
(1, 4.681329, 4.876384, 5.022676, 'AUD', '25.03.2021.'),
(1, 4.943831, 5.096733, 5.249635, 'CAD', '25.03.2021.'),
(1, 0.280262, 0.28893, 0.297598, 'CZK', '25.03.2021.'),
(1, 0.998181, 1.018552, 1.049109, 'DKK', '25.03.2021.'),
(100, 2.011934, 2.074159, 2.136384, 'HUF', '25.03.2021.'),
(100, 5.708897, 5.885461, 6.062025, 'JPY', '25.03.2021.'),
(1, 0.716475, 0.746328, 0.776181, 'NOK', '25.03.2021.'),
(1, 0.723322, 0.745693, 0.768064, 'SEK', '25.03.2021.'),
(1, 6.637557, 6.842842, 7.048127, 'CHF', '25.03.2021.'),
(1, 8.521958, 8.785524, 9.04909, 'GBP', '25.03.2021.'),
(1, 6.217654, 6.409953, 6.602252, 'USD', '25.03.2021.'),
(1, 3.826055, 3.872525, 3.918995, 'BAM', '25.03.2021.'),
(1, 7.524, 7.574, 7.624, 'EUR', '25.03.2021.'),
(1, 1.586144, 1.6352, 1.684256, 'PLN', '25.03.2021.'),
(1, 2, 3, 4, 'AUD', '24.03.2021.'),
(1, 2, 3, 4, 'CAD', '24.03.2021.'),
(1, 2, 3, 4, 'CZK', '24.03.2021.'),
(1, 2, 3, 4, 'DKK', '24.03.2021.'),
(1, 2, 3, 4, 'HUF', '24.03.2021.'),
(1, 2, 3, 4, 'JPY', '24.03.2021.'),
(1, 2, 3, 4, 'NOK', '24.03.2021.'),
(1, 2, 3, 4, 'SEK', '24.03.2021.'),
(1, 2, 3, 4, 'CHF', '24.03.2021.'),
(1, 2, 3, 4, 'GBP', '24.03.2021.'),
(1, 2, 3, 4, 'USD', '24.03.2021.'),
(1, 2, 3, 4, 'BAM', '24.03.2021.'),
(1, 2, 3, 4, 'EUR', '24.03.2021.'),
(1, 2, 3, 4, 'PLN', '24.03.2021.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
