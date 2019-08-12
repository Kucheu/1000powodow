-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Cze 2019, 10:52
-- Wersja serwera: 10.1.24-MariaDB
-- Wersja PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `1000powodow`
--
CREATE DATABASE IF NOT EXISTS `1000powodow` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `1000powodow`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reasons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `evaluations`
--

INSERT INTO `evaluations` (`id`, `id_user`, `id_reasons`) VALUES
(6, 15, 44),
(7, 15, 40),
(8, 13, 45),
(9, 13, 36),
(10, 13, 41),
(11, 13, 33);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `id_user`) VALUES
(5, 'moder', 13),
(6, 'admin', 14),
(7, 'user', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reasons`
--

CREATE TABLE `reasons` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `content` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_verify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `reasons`
--

INSERT INTO `reasons` (`id`, `id_user`, `data`, `content`, `status`, `date_verify`) VALUES
(33, 15, '2019-06-06 10:33:46', 'Sample text1', 1, '2019-06-06 10:47:55'),
(34, 15, '2019-06-06 10:33:50', 'Sample text2', 0, '0000-00-00 00:00:00'),
(35, 15, '2019-06-06 10:33:55', 'Sample text3', 0, '0000-00-00 00:00:00'),
(36, 15, '2019-06-06 10:34:03', 'Sample text4', 0, '0000-00-00 00:00:00'),
(37, 15, '2019-06-06 10:34:06', 'Sample text5', 1, '2019-06-06 10:48:05'),
(38, 15, '2019-06-06 10:34:10', 'Sample text6', 0, '0000-00-00 00:00:00'),
(39, 15, '2019-06-06 10:34:15', 'Sample text7', 0, '0000-00-00 00:00:00'),
(40, 15, '2019-06-06 10:34:19', 'Sample text8', 0, '0000-00-00 00:00:00'),
(41, 15, '2019-06-06 10:34:23', 'Sample text9', 1, '2019-06-06 10:47:44'),
(42, 15, '2019-06-06 10:34:26', 'Sample text10', 1, '2019-06-06 10:47:50'),
(43, 15, '2019-06-06 10:34:30', 'Sample text11', 1, '2019-06-06 10:47:57'),
(44, 15, '2019-06-06 10:34:34', 'Sample text12', 1, '2019-06-06 10:47:46'),
(45, 15, '2019-06-06 10:34:36', 'Sample text13', 0, '0000-00-00 00:00:00'),
(46, 15, '2019-06-06 10:34:42', 'Sample text14', 0, '0000-00-00 00:00:00'),
(47, 15, '2019-06-06 10:34:46', 'Sample text15', 0, '0000-00-00 00:00:00'),
(48, 15, '2019-06-06 10:34:49', 'Sample text16', 1, '2019-06-06 10:48:13'),
(49, 15, '2019-06-06 10:34:53', 'Sample text17', 1, '2019-06-06 10:48:07'),
(50, 15, '2019-06-06 10:35:01', 'Sample text19', 1, '2019-06-06 10:36:35'),
(51, 15, '2019-06-06 10:35:09', 'Sample text20', 0, '0000-00-00 00:00:00'),
(52, 15, '2019-06-06 10:35:12', 'Sample text21', 0, '0000-00-00 00:00:00'),
(53, 15, '2019-06-06 10:35:15', 'Sample text22', 1, '2019-06-06 10:35:23'),
(54, 15, '2019-06-06 10:35:19', 'Sample text23', 1, '2019-06-06 10:47:48');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(13, 'mod', '$2y$10$MOgxuKnB58GVlDZtlWNbmu61X8.ZRJxmLuyHYUxyaFtWbAccOGrz6', 'mod@mod.pl'),
(14, 'admin', '$2y$10$w5TOM/B8P6Ua9dW1NjEEkeC6aahBLO3.nFyUsrfMFB6olD/CRfxz.', 'admin@a.pl'),
(15, 'user', '$2y$10$EgviEHhYH7zY4CJLX038GeQcUtpvdaGfj0/b6PsGTl9vPgR72VhuW', 'user@a.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_reasons` (`id_reasons`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `evaluations_ibfk_2` FOREIGN KEY (`id_reasons`) REFERENCES `reasons` (`id`);

--
-- Ograniczenia dla tabeli `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `reasons`
--
ALTER TABLE `reasons`
  ADD CONSTRAINT `reasons_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
