-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 19 sep 2022 om 10:40
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
-- Database: `db_stemwijzer`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `gebruikersnaam` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `gebruikersnaam`, `wachtwoord`, `date_time`) VALUES
(1, 'admin', 'admin', '2022-06-29 15:07:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `partijen`
--

CREATE TABLE `partijen` (
  `id` int NOT NULL,
  `naam` varchar(100) NOT NULL,
  `leider` varchar(100) DEFAULT NULL,
  `omschrijving` varchar(1000) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `partijen_antwoorden`
--

CREATE TABLE `partijen_antwoorden` (
  `id` int NOT NULL,
  `stelling_id` int NOT NULL,
  `partij_id` int NOT NULL,
  `antwoord` enum('eens','geen van beide','oneens') DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `politieke_richtingen`
--

CREATE TABLE `politieke_richtingen` (
  `id` int NOT NULL,
  `partij_id` int NOT NULL,
  `links` tinyint(1) DEFAULT NULL,
  `rechts` tinyint(1) DEFAULT NULL,
  `progressief` tinyint(1) DEFAULT NULL,
  `conservatief` tinyint(1) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stellingen`
--

CREATE TABLE `stellingen` (
  `id` int NOT NULL,
  `omschrijving` varchar(1000) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `stellingen`
--

INSERT INTO `stellingen` (`id`, `omschrijving`, `date_time`) VALUES
(2, 'seffs', '2022-06-29 15:13:43');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `partijen`
--
ALTER TABLE `partijen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `partijen_antwoorden`
--
ALTER TABLE `partijen_antwoorden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partij_id` (`partij_id`),
  ADD KEY `stelling_id` (`stelling_id`);

--
-- Indexen voor tabel `politieke_richtingen`
--
ALTER TABLE `politieke_richtingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partij_id` (`partij_id`);

--
-- Indexen voor tabel `stellingen`
--
ALTER TABLE `stellingen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `partijen`
--
ALTER TABLE `partijen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `partijen_antwoorden`
--
ALTER TABLE `partijen_antwoorden`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `politieke_richtingen`
--
ALTER TABLE `politieke_richtingen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `stellingen`
--
ALTER TABLE `stellingen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `partijen_antwoorden`
--
ALTER TABLE `partijen_antwoorden`
  ADD CONSTRAINT `partijen_antwoorden_ibfk_1` FOREIGN KEY (`partij_id`) REFERENCES `partijen` (`id`),
  ADD CONSTRAINT `partijen_antwoorden_ibfk_2` FOREIGN KEY (`stelling_id`) REFERENCES `stellingen` (`id`);

--
-- Beperkingen voor tabel `politieke_richtingen`
--
ALTER TABLE `politieke_richtingen`
  ADD CONSTRAINT `politieke_richtingen_ibfk_1` FOREIGN KEY (`partij_id`) REFERENCES `partijen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
