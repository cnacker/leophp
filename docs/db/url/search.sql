-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2019 at 09:14 AM
-- Server version: 5.5.53
-- PHP Version: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `url`
--

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_url` text COLLATE utf8mb4_unicode_ci,
  `search_title` text COLLATE utf8mb4_unicode_ci,
  `search_shortcut` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`search_id`, `search_url`, `search_title`, `search_shortcut`) VALUES
(1, 'https://translate.google.com/#view=home&op=translate&sl={%0}&tl={%1}&text=%s', 'Google 翻译', 't'),
(2, 'https://fanyi.baidu.com/#{%0}/{%1}/%s', '百度翻译', 'f'),
(3, 'https://map.baidu.com/?newmap=1&ie=utf-8&s=s%26wd%3D%s', '百度地图', 'bm');
