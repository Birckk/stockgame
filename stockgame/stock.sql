-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 12. 10 2017 kl. 13:01:57
-- Serverversion: 10.1.25-MariaDB
-- PHP-version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `balance`
--

INSERT INTO `balance` (`id`, `userid`, `balance`) VALUES
(38, 15, 30000),
(39, 16, 30000),
(40, 17, 30000),
(41, 18, 30000),
(42, 19, 30000),
(43, 13, 29900);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `companies`
--

CREATE TABLE `companies` (
  `id` int(5) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `aktieid` int(11) NOT NULL,
  `stockvalue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `companies`
--

INSERT INTO `companies` (`id`, `companyname`, `aktieid`, `stockvalue`) VALUES
(1, 'ecco', 1, 31),
(2, 'geox', 2, 70);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `currentstock`
--

CREATE TABLE `currentstock` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `antal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `currentstock`
--

INSERT INTO `currentstock` (`id`, `userid`, `companyid`, `antal`) VALUES
(9, 13, 2, 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Antal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `transaction`
--

INSERT INTO `transaction` (`id`, `UserID`, `CompanyID`, `Antal`) VALUES
(6, 13, 2, 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `active`, `admin`) VALUES
(13, 'admin', 'ea0d354c8611d4f411ba9dbd7fe436e33c3ab1e42c13787ab3688b067924687b', '»{ÑÒà¬D®‹Ønä¤½8ËÂÆä.ÒÍŸ.PGÈXê/‘G', 1, 1),
(15, 'user1', 'a63cd845af4bdf455cd4637a2ac659755e1da84f2f20f0b72eb6ec4f33377f9d', 'lôü ÿäÁf5P%¬\")Ýl9Þ*åmËFL p!9', 1, 0),
(16, 'user2', '33d58cdd34e96d5e20b1a2f253e04e122ea4d01aa9f175a602162a35405045d0', 'dL¼d+x–^M³íŒä#\0Yå«.uí-®¹„|±', 1, 0),
(17, 'tobias', '04f815d38353e16c3f1927950b2d02f04068a498bb38aa773f05a20a0b0bab62', 'O°R“ÃšÒµ#Á~ºüØ;eQ…œ¸]Ñ	x“ÂBPJ', 1, 0),
(18, 'user5', '4ffa1e6d1e2eb094d0d418342f61516ef27baa39a2a205b83ee43bcb10a5dcf6', '¿È~vŒOË0èÐB9Ëú‰ÆAô¥\n«¨K4H%ïÀ°C(', 1, 0),
(19, 'aktieguden', 'ecbd2deb1c047187a30a47637c7b84cb5fca48a0517f94b62157a39f9afad782', '$xÂšYJË2%„›•4M&à1*Öº_ÙÓI¼†Š¡', 1, 0);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `currentstock`
--
ALTER TABLE `currentstock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Tilføj AUTO_INCREMENT i tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tilføj AUTO_INCREMENT i tabel `currentstock`
--
ALTER TABLE `currentstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tilføj AUTO_INCREMENT i tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
