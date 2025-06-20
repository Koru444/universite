-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 juil. 2024 à 17:03
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

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
(1, 'Dupont', 'Marie', 'F', 22, '123-456-7890', 'marie.dupont@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '1'),
(2, 'Martin', 'Pierre', 'M', 23, '987-654-3210', 'pierre.martin@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '1'),
(3, 'Lambert', 'Sophie', 'F', 23, '555-123-4567', 'sophie.l@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '1'),
(4, 'Durand', 'Julien', 'M', 20, '333-555-7777', 'julien.durand@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '1'),
(5, 'Lefevre', 'Thomas', 'M', 22, '666-999-8888', 'thomas.lefevre@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '2'),
(6, 'Leroux', 'Alice', 'F', 23, '777-888-9999', 'alice.leroux@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '2'),
(7, 'Roussel', 'Hugo', 'F', 20, '555-111-3333', 'hugo.roussel@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '2'),
(8, 'Robert', 'Camille', 'F', 22, '222-333-4444', 'camille.robert@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '2'),
(9, 'Mercier', 'Lucas', 'M', 21, '111-777-5555', 'lucas.mercier@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '2'),
(10, 'Girard', 'Emma', 'F', 20, '333-444-5555', 'emma.girard@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '3'),
(11, 'Bonnet', 'Noah', 'M', 23, '999-777-3333', 'noah.bonnet@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '3'),
(12, 'Faure', 'Chloe', 'F', 22, '666-555-2222', 'chloe.faure@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '3'),
(13, 'Lemoine', 'Louis', 'M', 21, '888-222-6666', 'louis.lemoine@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '3'),
(14, 'Dufour', 'Jade', 'F', 20, '444-666-9999', 'jade.dufour@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '3'),
(15, 'Giroux', 'Gabriel', 'M', 21, '111-333-7777', 'gabriel.giroux@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '4'),
(16, 'Vincent', 'Léa', 'F', 22, '777-111-4444', 'lea.vincent@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '4'),
(17, 'Leclerc', 'Ethan', 'M', 23, '555-999-2222', 'ethan.leclerc@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '4'),
(18, 'Lecomte', 'Lola', 'F', 20, '999-222-3333', 'lola.lecomte@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '4'),
(19, 'Henry', 'Tom', 'M', 21, '333-666-1111', 'tom.henry@email.com', '$2y$10$D9vA4nnqGEdxOOFrsTs13u09GLWdBj2HIl2kJfXXZ4kHBmTXzzg2i', '4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
