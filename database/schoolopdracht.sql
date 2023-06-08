-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 jun 2023 om 23:15
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolopdracht`
--
CREATE DATABASE IF NOT EXISTS `schoolopdracht` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `schoolopdracht`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230604130704', '2023-06-04 15:07:20', 96),
('DoctrineMigrations\\Version20230604131817', '2023-06-04 15:18:27', 24),
('DoctrineMigrations\\Version20230604131940', '2023-06-04 15:19:50', 19),
('DoctrineMigrations\\Version20230604152343', '2023-06-04 17:33:32', 38),
('DoctrineMigrations\\Version20230607095926', '2023-06-07 11:59:30', 22),
('DoctrineMigrations\\Version20230607100653', '2023-06-07 12:07:00', 113),
('DoctrineMigrations\\Version20230607101008', '2023-06-07 12:10:22', 109);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_persons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lesson`
--

INSERT INTO `lesson` (`id`, `training_id`, `instructor_id`, `time`, `date`, `location`, `max_persons`) VALUES
(1, 1, 5, '18:00:00', '2023-06-19', 'TrainingFactory Gym, 123 Main Street', 20),
(2, 2, 2, '17:30:00', '2023-06-21', 'TrainingFactory Gym, 123 Main Street', 15),
(3, 3, 5, '19:00:00', '2023-06-27', 'TrainingFactory Gym, 123 Main Street', 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hiring_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `social_sec_number` int(11) DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preprovision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateofbirth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `person`
--

INSERT INTO `person` (`id`, `email`, `roles`, `password`, `hiring_date`, `salary`, `social_sec_number`, `street`, `place`, `firstname`, `preprovision`, `lastname`, `dateofbirth`) VALUES
(1, 'klaas@rocmondriaan.nl', '[\"ROLE_KLANT\"]', '$2y$13$qJ1ftp27ipgvDyT4RYwbpOooAW6ydwut6bkxkZ0jihoy1Odlnhnie', NULL, NULL, NULL, NULL, NULL, 'Klaas', 'test', 'Jeet', '15-08-2002'),
(2, 'admin@rocmondriaan.nl', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$ZGm2KAauKtxNjkfrcROqqu2GcP05SMhmZzG2ocVZk3idisRoFa5Pi', '2021-06-03', '1600.00', 239870669, NULL, NULL, 'Tom', 'test', 'Holland', '23-09-1996'),
(5, 'dhiradj@mail.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$NdJ70ZsMSWKtF8een2lRTOvh0RJwyT/2Pj6.GMNzwHi7boerjWlNm', '2023-03-06', '1800.00', 98768907, 'Klauslaan 10', 'Den Haag', 'Dhiradj', 'Test', 'Tangali', '30-12-2004'),
(6, 'niels@mail.com', '[\"ROLE_KLANT\"]', '$2y$13$ik7j.NgxF.FtfuU3En2FfegSTNWyxJmvlq/44/DPhkXr.boJS/9f6', NULL, NULL, NULL, 'Mixostraat 5', 'Den Haag', 'Niels', 'test', 'Opperdam', '02-05-1995'),
(9, 'rohan@mail.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$kdRcQXS/.ad3XUnKAy1ILuzqk7blquRwDm1zQvlKkMpbRRgAsASQe', '2023-06-04', '1900.00', 378659087, NULL, NULL, 'Rohan', 'test', 'Tangali', '01-06-2023');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

DROP TABLE IF EXISTS `training`;
CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_costs` decimal(5,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `description`, `duration`, `extra_costs`, `image`, `title`) VALUES
(1, 'This high-intensity bootcamp combines elements of boxing, kickboxing, and MMA to provide a full-body workout that enhances strength, endurance, and agility. Participants will engage in a variety of cardio exercises, bag work, bodyweight movements, and par', '1 hour', NULL, '', 'Combat Fitness Bootcamp'),
(2, 'This lesson focuses on developing proper technique, power, and speed through bag training. Participants will learn a variety of striking combinations, footwork drills, and defensive maneuvers, while working on heavy bags, speed bags, and focus mitts. It i', '45 minutes', NULL, '', 'Bag Training Mastery'),
(3, 'This lesson combines the disciplines of mixed martial arts (MMA) with fitness training to improve overall conditioning and athleticism. Participants will engage in a variety of exercises, including striking drills, grappling movements, circuit training, a', '1.5 hours', NULL, '', 'MMA Conditioning and Fitness');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3BEFD98D1` (`training_id`),
  ADD KEY `IDX_F87474F38C4FC193` (`instructor_id`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_34DCD176E7927C74` (`email`);

--
-- Indexen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A7CDF80196` (`lesson_id`),
  ADD KEY `IDX_62A8A7A7217BBB47` (`person_id`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F38C4FC193` FOREIGN KEY (`instructor_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_F87474F3BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);

--
-- Beperkingen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A7217BBB47` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
