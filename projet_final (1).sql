-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 18 avr. 2024 à 14:56
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_final`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Message` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enregistrerpresence`
--

DROP TABLE IF EXISTS `enregistrerpresence`;
CREATE TABLE IF NOT EXISTS `enregistrerpresence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_etudiant` int DEFAULT NULL,
  `promo` int DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enregistrerpresence`
--

INSERT INTO `enregistrerpresence` (`id`, `id_etudiant`, `promo`, `status`, `date`) VALUES
(1, 1, 202305, NULL, NULL),
(2, 2, 202305, NULL, NULL),
(3, 3, 202305, NULL, NULL),
(4, 4, 202305, NULL, NULL),
(5, 15, 202320, NULL, NULL),
(6, 16, 202320, NULL, NULL),
(7, 17, 202320, NULL, NULL),
(8, 18, 202320, NULL, NULL),
(9, 19, 202320, NULL, NULL),
(10, 15, 202320, NULL, NULL),
(11, 16, 202320, NULL, NULL),
(12, 17, 202320, NULL, NULL),
(13, 18, 202320, NULL, NULL),
(14, 19, 202320, NULL, NULL),
(15, 1, 202305, NULL, NULL),
(16, 2, 202305, NULL, NULL),
(17, 3, 202305, NULL, NULL),
(18, 4, 202305, NULL, NULL),
(19, 1, 202305, NULL, NULL),
(20, 2, 202305, NULL, NULL),
(21, 3, 202305, NULL, NULL),
(22, 4, 202305, NULL, NULL),
(23, 1, 202305, NULL, NULL),
(24, 2, 202305, NULL, NULL),
(25, 3, 202305, NULL, NULL),
(26, 4, 202305, NULL, NULL),
(27, 1, 202305, NULL, NULL),
(28, 2, 202305, NULL, NULL),
(29, 3, 202305, NULL, NULL),
(30, 4, 202305, NULL, NULL),
(31, 1, 202305, NULL, NULL),
(32, 2, 202305, NULL, NULL),
(33, 3, 202305, NULL, NULL),
(34, 4, 202305, NULL, NULL),
(35, 1, 202305, NULL, NULL),
(36, 2, 202305, NULL, NULL),
(37, 3, 202305, NULL, NULL),
(38, 4, 202305, NULL, NULL),
(39, 1, 202305, NULL, NULL),
(40, 2, 202305, NULL, NULL),
(41, 3, 202305, NULL, NULL),
(42, 4, 202305, NULL, NULL),
(43, 10, 202310, NULL, NULL),
(44, 11, 202310, NULL, NULL),
(45, 12, 202310, NULL, NULL),
(46, 13, 202310, NULL, NULL),
(47, 14, 202310, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
CREATE TABLE IF NOT EXISTS `enseignants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `statut` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationTimeStamp` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `statut`, `creationTimeStamp`) VALUES
(1, 'Brandon', 'Blond', 'brandonblond7@gmail.com', '$2y$10$uNqAfFI/Q/rD6kLGVVnkMuKsItkDmoZMnZrT/t241ozrlj2Dr2DHC', 'enseignant', '2024-04-17');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` text NOT NULL,
  `age` int NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `promotion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `promotion` (`promotion`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `sexe`, `age`, `tel`, `email`, `mot_de_passe`, `promotion`) VALUES
(1, 'Dupont', 'Marie', 'F', 22, '123-456-7890', 'marie.dupont@email.com', 'password1', '1'),
(2, 'Martin', 'Pierre', 'M', 23, '987-654-3210', 'pierre.martin@email.com', 'secret123', '1'),
(3, 'Lambert', 'Sophie', 'F', 23, '555-123-4567', 'sophie.l@email.com', 'pass1234', '1'),
(4, 'Durand', 'Julien', 'M', 20, '333-555-7777', 'julien.durand@email.com', 'securepass', '1'),
(5, 'Lefevre', 'Thomas', 'M', 22, '666-999-8888', 'thomas.lefevre@email.com', '12345678', '2'),
(6, 'Leroux', 'Alice', 'F', 23, '777-888-9999', 'alice.leroux@email.com', 'pass9876', '2'),
(7, 'Roussel', 'Hugo', 'F', 20, '555-111-3333', 'hugo.roussel@email.com', 'secure321', '2'),
(8, 'Robert', 'Camille', 'F', 22, '222-333-4444', 'camille.robert@email.com', '87654321', '2'),
(9, 'Mercier', 'Lucas', 'M', 21, '111-777-5555', 'lucas.mercier@email.com', 'passpass', '2'),
(10, 'Girard', 'Emma', 'F', 20, '333-444-5555', 'emma.girard@email.com', 'securepass', '3'),
(11, 'Bonnet', 'Noah', 'M', 23, '999-777-3333', 'noah.bonnet@email.com', '123456abc', '3'),
(12, 'Faure', 'Chloe', 'F', 22, '666-555-2222', 'chloe.faure@email.com', 'abc987654', '3'),
(13, 'Lemoine', 'Louis', 'M', 21, '888-222-6666', 'louis.lemoine@email.com', 'xyz789abc', '3'),
(14, 'Dufour', 'Jade', 'F', 20, '444-666-9999', 'jade.dufour@email.com', '9876pass', '3'),
(15, 'Giroux', 'Gabriel', 'M', 21, '111-333-7777', 'gabriel.giroux@email.com', 'mypass123', '4'),
(16, 'Vincent', 'Léa', 'F', 22, '777-111-4444', 'lea.vincent@email.com', '4567xyz', '4'),
(17, 'Leclerc', 'Ethan', 'M', 23, '555-999-2222', 'ethan.leclerc@email.com', '789abcxyz', '4'),
(18, 'Lecomte', 'Lola', 'F', 20, '999-222-3333', 'lola.lecomte@email.com', 'xyz456789', '4'),
(19, 'Henry', 'Tom', 'M', 21, '333-666-1111', 'tom.henry@email.com', 'passpass', '4');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `promo` int DEFAULT NULL,
  `EtudiantID` int DEFAULT NULL,
  `ProfID` int DEFAULT NULL,
  `Note` decimal(4,2) DEFAULT NULL,
  `Commentaire` varchar(100) NOT NULL,
  `DateEnregistrement` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`ID`, `promo`, `EtudiantID`, `ProfID`, `Note`, `Commentaire`, `DateEnregistrement`) VALUES
(1, 0, 0, 0, '10.00', 'peut mieux faire', '2024-04-16'),
(2, 0, 0, 0, '10.00', 'peut mieux faire', '2024-04-16'),
(3, 0, 0, 0, '10.00', 'peut mieux faire', '2024-04-16'),
(4, 0, 0, 0, '10.00', '?>', '2024-04-16'),
(5, 0, 12, 1, '15.00', 'bien', '2024-04-16'),
(6, 0, NULL, 1, '15.00', 'bien', '2024-04-17'),
(7, 0, NULL, 1, '15.00', 'bien', '2024-04-17'),
(8, NULL, 12, 22, '10.00', 'SDSDSD', '2024-04-17'),
(9, NULL, 11, 22, '20.00', ' HHJHKJK', '2024-04-17'),
(10, NULL, 11, 22, '20.00', ' HHJHKJK', '2024-04-17'),
(11, NULL, 12, 22, '20.00', 'Bien\r\n', '2024-04-17'),
(12, NULL, 0, 0, '0.00', '', '2024-04-17'),
(13, NULL, 0, 0, '0.00', '', '2024-04-17'),
(14, NULL, 0, 0, '0.00', '', '2024-04-17'),
(15, NULL, 0, 0, '0.00', '', '2024-04-17'),
(16, NULL, 1, 1, '10.00', 'dfdfdsfsfs', '2024-04-18'),
(17, NULL, 2, 1, '10.00', 'dfdfdsfsfs', '2024-04-18'),
(18, NULL, 3, 1, '10.00', 'dfdfdsfsfs', '2024-04-18'),
(19, NULL, 4, 1, '10.00', 'dfdfdsfsfs', '2024-04-18'),
(20, NULL, 5, 1, '10.00', 'sdsdssdsd', '2024-04-18'),
(21, NULL, 6, 1, '10.00', 'sdsdssdsd', '2024-04-18'),
(22, NULL, 7, 1, '10.00', 'sdsdssdsd', '2024-04-18'),
(23, NULL, 8, 1, '10.00', 'sdsdssdsd', '2024-04-18'),
(24, NULL, 9, 1, '10.00', 'sdsdssdsd', '2024-04-18'),
(25, NULL, 10, 1, '0.00', '', '2024-04-18'),
(26, NULL, 11, 1, '0.00', '', '2024-04-18'),
(27, NULL, 12, 1, '0.00', '', '2024-04-18'),
(28, NULL, 13, 1, '0.00', '', '2024-04-18'),
(29, NULL, 14, 1, '0.00', '', '2024-04-18'),
(30, NULL, 10, 1, '0.00', '', '2024-04-18'),
(31, NULL, 11, 1, '0.00', '', '2024-04-18'),
(32, NULL, 12, 1, '0.00', '', '2024-04-18'),
(33, NULL, 13, 1, '0.00', '', '2024-04-18'),
(34, NULL, 14, 1, '0.00', '', '2024-04-18'),
(35, NULL, 10, 1, '0.00', '', '2024-04-18'),
(36, NULL, 11, 1, '0.00', '', '2024-04-18'),
(37, NULL, 12, 1, '0.00', '', '2024-04-18'),
(38, NULL, 13, 1, '0.00', '', '2024-04-18'),
(39, NULL, 14, 1, '0.00', '', '2024-04-18'),
(40, NULL, 10, 1, '10.00', 'ssdsdsdsd', '2024-04-18'),
(41, NULL, 11, 1, '10.00', 'ssdsdsdsd', '2024-04-18'),
(42, NULL, 12, 1, '10.00', 'ssdsdsdsd', '2024-04-18'),
(43, NULL, 13, 1, '10.00', 'ssdsdsdsd', '2024-04-18'),
(44, NULL, 14, 1, '10.00', 'ssdsdsdsd', '2024-04-18'),
(45, NULL, 15, 1, '20.00', 'bien', '2024-04-18'),
(46, NULL, 16, 1, '20.00', 'bien', '2024-04-18'),
(47, NULL, 17, 1, '20.00', 'bien', '2024-04-18'),
(48, NULL, 18, 1, '20.00', 'bien', '2024-04-18'),
(49, NULL, 19, 1, '20.00', 'bien', '2024-04-18'),
(50, 202320, 15, 1, '20.00', 'bien', '2024-04-18'),
(51, 202320, 16, 1, '20.00', 'bien', '2024-04-18'),
(52, 202320, 17, 1, '20.00', 'bien', '2024-04-18'),
(53, 202320, 18, 1, '20.00', 'bien', '2024-04-18'),
(54, 202320, 19, 1, '20.00', 'bien', '2024-04-18'),
(55, 202310, 10, 1, '15.00', 'bienn', '2024-04-18'),
(56, 202310, 11, 1, '15.00', 'bienn', '2024-04-18'),
(57, 202310, 12, 1, '15.00', 'bienn', '2024-04-18'),
(58, 202310, 13, 1, '15.00', 'bienn', '2024-04-18'),
(59, 202310, 14, 1, '15.00', 'bienn', '2024-04-18');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id`, `nom`) VALUES
(1, '202305A'),
(2, '202315C'),
(3, '202310B'),
(4, '202320D'),
(5, '202325E');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `status`, `Firstname`, `Lastname`, `Email`, `password`, `creationTimeStamp`) VALUES
(2, '', 'Cassandra', 'Albertin', 'cassandra@hotmail.fr', '$2y$10$gKiDSCy458q8.f9eE.Ai/eB0aEj10M/IynicxTBrWsMKgP3pp3iw2', '2024-03-15 15:33:17'),
(3, '', 'Charles', 'Galles', 'galles@hotmail.fr', '$2y$10$7doJThbhHtU5gK1GnrlwSeW092mPgfw6LNuzIujAsUHkGE5IYPfU.', '2024-03-17 00:16:31'),
(4, '', 'Lulu', 'Hugues', 'lulu@yahoo.fr', '$2y$10$GdyXx/Eh9qq8mWD4ryjMYuTt5o0asMJFLBB1pum92WMkYQAkAHoMO', '2024-03-17 00:44:35'),
(5, '', 'Blond', 'Brandon', 'brandonblond7@gmail.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '2024-04-08 08:04:24'),
(6, '', 'sdsdsds', 'zdsdsdsd', 'dsdsdsds@sd.com', '$2y$10$Y3Ky85nQmnx4FLu7q8Cc5.DFUaz9xkKN1kCNMdVxzxJi6qRntRzi2', '2024-04-08 08:09:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
