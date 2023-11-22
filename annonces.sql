-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 nov. 2023 à 19:39
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `avito`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `titre`, `description`, `prix`, `date_publication`, `utilisateur_id`, `image_url`) VALUES
(4, ' king yassine hanach', 'merraaakchiii lillbaaay3 b ay taman', 1.50, '2002-11-24', NULL, 'https://intranet.youcode.ma/storage/users/profile/thumbnail/956-1696615324.jpg'),
(5, 'voiture', 'red carrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 880.00, '2023-11-09', NULL, 'https://imgd-ct.aeplcdn.com/320x200/n/cw/ec/110437/zs-ev-facelift-exterior-right-front-three-quarter'),
(7, 'test', 'test', 1144.00, '2023-11-16', NULL, 'https://example.com/images/example.jpg'),
(8, 'azerty', 'fezjjjjjjjjjjjjjjjjjjjjjjjjj', 140.00, '2023-11-17', NULL, 'https://example.com/images/example.jpg'),
(10, 'test ', 'jrkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 2500.00, '2023-11-17', NULL, 'https://example.com/images/example.jpg'),
(11, 'korsiiiiiiii', 'krossssi khdeeeer', 500.00, '2023-11-17', NULL, 'https://example.com/images/example.jpg'),
(12, 'an1', 'aaaaaaaaaaaaaaaaaaaaa', 144.00, '2023-11-17', NULL, 'https://example.com/images/example.jpg'),
(13, 'maison', 'mziezjzfofhzhfoiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', 14555.00, '2023-11-17', NULL, 'https://prod-saint-gobain-fr.content.saint-gobain.io/sites/saint-gobain.fr/files/2022-04/maison-cont'),
(14, 'hh', 'jhhh', 14.00, '2023-11-17', NULL, ''),
(15, 'dd', 'ddddddddddddddddddd', 144.00, '2023-11-17', NULL, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.lamaisonsaintgobain.fr%2Fguides-travaux%2Freno'),
(18, 'hhh', 'mm', 444.00, '2023-11-17', NULL, ''),
(19, 'car', 'aaaaaa', 444444.00, '2023-11-17', NULL, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoGBxQUExYTFBQYGBYZGRkZGRoaGhwcGRwcHRogHBoZG'),
(20, 'jhkjhljb', 'oijhoijhi', 6521232.00, '0256-03-21', NULL, 'https://example.com/images/example.jpg'),
(21, ' king yassine hanach', 'dsds', 45.00, '2023-02-12', NULL, 'https://example.com/images/example.jpg'),
(23, 'ayoub', 'aaaaaaaaaaaaaaaaaaaaaaa', 147.00, '2023-11-17', NULL, 'https://intranet.youcode.ma/storage/users/profile/thumbnail/792-1696615701.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
