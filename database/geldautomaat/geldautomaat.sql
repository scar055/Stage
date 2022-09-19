-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 19 sep 2022 om 10:33
-- Serverversie: 8.0.27
-- PHP-versie: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geldautomaat`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `number` int NOT NULL,
  `saldo` double NOT NULL,
  `pin` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `id_user`, `number`, `saldo`, `pin`, `date`, `blocked`) VALUES
(1, 1, 12345, 100, '12345', '2022-04-07 08:47:04', 1),
(2, 1, 54321, 95, '5124', '2022-04-07 11:31:33', 0),
(7, 7, 78945, 0, '7872', '2022-04-06 10:53:43', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `employee`
--

INSERT INTO `employee` (`id`, `username`, `password`, `date`) VALUES
(5, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', '2022-01-24 09:09:18'),
(7, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2022-01-26 13:00:32');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `bank_account` int NOT NULL,
  `amount` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `transactions`
--

INSERT INTO `transactions` (`id`, `bank_account`, `amount`, `date`) VALUES
(1, 54321, -100, '2022-04-04 08:01:22'),
(2, 54321, 500, '2022-04-05 08:03:22'),
(3, 54321, 40, '2022-04-04 13:07:45'),
(4, 54321, 20, '2022-04-04 08:03:35'),
(5, 54321, -10, '2022-04-04 08:03:42'),
(7, 54321, -100, '2022-04-04 08:02:04'),
(8, 54321, -50, '2022-04-04 08:02:14'),
(9, 54321, -20, '2022-04-04 08:02:24'),
(12, 12345, 100, '2022-04-05 09:28:16'),
(13, 12345, -10, '2022-04-05 09:42:01'),
(14, 12345, -1, '2022-04-05 09:42:18'),
(15, 12345, -1, '2022-04-05 09:42:34'),
(16, 12345, 1, '2022-04-05 09:45:31'),
(17, 54321, 20, '2022-04-05 12:54:25'),
(18, 54321, -20, '2022-04-05 12:56:22'),
(19, 54321, -5, '2022-04-05 12:56:38'),
(20, 54321, -10, '2022-04-05 12:56:52'),
(21, 54321, -50, '2022-04-06 10:57:51'),
(22, 54321, -50, '2022-04-06 10:58:42'),
(23, 54321, 100, '2022-04-06 11:00:21'),
(25, 54321, -500, '2022-04-06 11:03:49'),
(26, 54321, 10, '2022-04-07 09:21:18'),
(27, 54321, -10, '2022-04-07 09:21:43'),
(28, 54321, 10, '2022-04-07 09:57:45'),
(30, 54321, -5, '2022-04-07 09:59:38'),
(32, 54321, 100, '2022-04-07 11:31:17'),
(33, 54321, -10, '2022-04-07 11:31:33');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `home_adress` varchar(255) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `woonplaats` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `home_adress`, `postcode`, `woonplaats`, `date`) VALUES
(1, 'test', 'testnaam', 'test@gmail.com', '12378', '1234BV', 'Amersfoort', '2022-04-06 11:29:46'),
(2, 'rowan', 'van laar', 'admin@gmail.com', '9 schoolveld', '1321GB', 'Amersfoort', '2022-04-06 11:30:05'),
(7, 'pietje', 'pot', 'pietjepot@gmail.com', 'straat123', '2341FR', 'Hoevenlaken', '2022-04-06 11:30:19');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexen voor tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_account` (`bank_account`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Beperkingen voor tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`bank_account`) REFERENCES `bank_accounts` (`number`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
