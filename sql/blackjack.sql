-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2020 at 01:21 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blackjack`
--

-- --------------------------------------------------------

--
-- Table structure for table `playcards`
--

CREATE TABLE `playcards` (
  `id` tinyint(4) NOT NULL,
  `value_tinyint` tinyint(4) DEFAULT NULL,
  `value_text` enum('ace','two','three','four','five','six','seven','eight','nine','ten','jack','queen','king','joker') COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_symbol` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suit_symbol` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suit_text` enum('hearts','diamonds','clubs','spades') COLLATE utf8_unicode_ci DEFAULT NULL,
  `suit_color` enum('red','black') COLLATE utf8_unicode_ci DEFAULT NULL,
  `unicode_char` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Dumping data for table `playcards`
--

INSERT INTO `playcards` (`id`, `value_tinyint`, `value_text`, `value_symbol`, `suit_symbol`, `suit_text`, `suit_color`, `unicode_char`) VALUES
(1, 11, 'ace', 'A', '♥', 'hearts', 'red', '🂱'),
(2, 2, 'two', '2', '♥', 'hearts', 'red', '🂲'),
(3, 3, 'three', '3', '♥', 'hearts', 'red', '🂳'),
(4, 4, 'four', '4', '♥', 'hearts', 'red', '🂴'),
(5, 5, 'five', '5', '♥', 'hearts', 'red', '🂵'),
(6, 6, 'six', '6', '♥', 'hearts', 'red', '🂶'),
(7, 7, 'seven', '7', '♥', 'hearts', 'red', '🂷'),
(8, 8, 'eight', '8', '♥', 'hearts', 'red', '🂸'),
(9, 9, 'nine', '9', '♥', 'hearts', 'red', '🂹'),
(10, 10, 'ten', '10', '♥', 'hearts', 'red', '🂺'),
(11, 10, 'jack', 'J', '♥', 'hearts', 'red', '🂻'),
(12, 10, 'queen', 'Q', '♥', 'hearts', 'red', '🂽'),
(13, 10, 'king', 'K', '♥', 'hearts', 'red', '🂾'),
(14, 11, 'ace', 'A', '♦', 'diamonds', 'red', '🃁'),
(15, 2, 'two', '2', '♦', 'diamonds', 'red', '🃂'),
(16, 3, 'three', '3', '♦', 'diamonds', 'red', '🃃'),
(17, 4, 'four', '4', '♦', 'diamonds', 'red', '🃄'),
(18, 5, 'five', '5', '♦', 'diamonds', 'red', '🃅'),
(19, 6, 'six', '6', '♦', 'diamonds', 'red', '🃆'),
(20, 7, 'seven', '7', '♦', 'diamonds', 'red', '🃇'),
(21, 8, 'eight', '8', '♦', 'diamonds', 'red', '🃈'),
(22, 9, 'nine', '9', '♦', 'diamonds', 'red', '🃉'),
(23, 10, 'ten', '10', '♦', 'diamonds', 'red', '🃊'),
(24, 10, 'jack', 'J', '♦', 'diamonds', 'red', '🃋'),
(25, 10, 'queen', 'Q', '♦', 'diamonds', 'red', '🃍'),
(26, 10, 'king', 'K', '♦', 'diamonds', 'red', '🃎'),
(27, 11, 'ace', 'A', '♣', 'clubs', 'black', '🃑'),
(28, 2, 'two', '2', '♣', 'clubs', 'black', '🃒'),
(29, 3, 'three', '3', '♣', 'clubs', 'black', '🃓'),
(30, 4, 'four', '4', '♣', 'clubs', 'black', '🃔'),
(31, 5, 'five', '5', '♣', 'clubs', 'black', '🃕'),
(32, 6, 'six', '6', '♣', 'clubs', 'black', '🃖'),
(33, 7, 'seven', '7', '♣', 'clubs', 'black', '🃗'),
(34, 8, 'eight', '8', '♣', 'clubs', 'black', '🃘'),
(35, 9, 'nine', '9', '♣', 'clubs', 'black', '🃙'),
(36, 10, 'ten', '10', '♣', 'clubs', 'black', '🃚'),
(37, 10, 'jack', 'J', '♣', 'clubs', 'black', '🃛'),
(38, 10, 'queen', 'Q', '♣', 'clubs', 'black', '🃝'),
(39, 10, 'king', 'K', '♣', 'clubs', 'black', '🃞'),
(40, 11, 'ace', 'A', '♠', 'spades', 'black', '🂡'),
(41, 2, 'two', '2', '♠', 'spades', 'black', '🂢'),
(42, 3, 'three', '3', '♠', 'spades', 'black', '🂣'),
(43, 4, 'four', '4', '♠', 'spades', 'black', '🂤'),
(44, 5, 'five', '5', '♠', 'spades', 'black', '🂥'),
(45, 6, 'six', '6', '♠', 'spades', 'black', '🂦'),
(46, 7, 'seven', '7', '♠', 'spades', 'black', '🂧'),
(47, 8, 'eight', '8', '♠', 'spades', 'black', '🂨'),
(48, 9, 'nine', '9', '♠', 'spades', 'black', '🂩'),
(49, 10, 'ten', '10', '♠', 'spades', 'black', '🂪'),
(50, 10, 'jack', 'J', '♠', 'spades', 'black', '🂫'),
(51, 10, 'queen', 'Q', '♠', 'spades', 'black', '🂭'),
(52, 10, 'king', 'K', '♠', 'spades', 'black', '🂮');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_playcards`
-- (See below for the actual view)
--
CREATE TABLE `vw_playcards` (
`id` tinyint(4)
,`value_tinyint` tinyint(4)
,`value_text` enum('ace','two','three','four','five','six','seven','eight','nine','ten','jack','queen','king','joker')
,`value_symbol` char(2)
,`suit_symbol` char(1)
,`suit_text` enum('hearts','diamonds','clubs','spades')
,`suit_color` enum('red','black')
,`full_symbol` varchar(3)
,`full_name` varchar(17)
,`unicode_char` char(1)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_playcards`
--
DROP TABLE IF EXISTS `vw_playcards`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_playcards`  AS  select `playcards`.`id` AS `id`,`playcards`.`value_tinyint` AS `value_tinyint`,`playcards`.`value_text` AS `value_text`,`playcards`.`value_symbol` AS `value_symbol`,`playcards`.`suit_symbol` AS `suit_symbol`,`playcards`.`suit_text` AS `suit_text`,`playcards`.`suit_color` AS `suit_color`,case `playcards`.`id` when 53 then `playcards`.`value_symbol` when 54 then `playcards`.`value_symbol` when 0 then '#' else concat(`playcards`.`value_symbol`,`playcards`.`suit_symbol`) end AS `full_symbol`,case `playcards`.`id` when 53 then concat(`playcards`.`suit_color`,' ',`playcards`.`value_text`) when 54 then concat(`playcards`.`suit_color`,' ',`playcards`.`value_text`) when 0 then 'card back' else concat(`playcards`.`value_text`,' of ',`playcards`.`suit_text`) end AS `full_name`,`playcards`.`unicode_char` AS `unicode_char` from `playcards` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playcards`
--
ALTER TABLE `playcards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unicode_char` (`unicode_char`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
