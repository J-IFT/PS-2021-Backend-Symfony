-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 24 oct. 2021 à 14:22
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lesylv`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse`, `numero`) VALUES
(1, 'Norris', 'Chuck', 'Texas', 666429999),
(2, 'Percin', 'Loris', 'Ici', 123456789),
(3, 'Duciel', 'Jairaimie', 'Périgord', 123456789),
(4, 'Dicktatrice', 'Juliette', 'Vovo-City', 123456789);

-- --------------------------------------------------------

--
-- Structure de la table `galaxie`
--

DROP TABLE IF EXISTS `galaxie`;
CREATE TABLE IF NOT EXISTS `galaxie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `galaxie`
--

INSERT INTO `galaxie` (`id`, `nom`) VALUES
(1, 'Voie lactée'),
(2, 'Adromède'),
(3, 'Bordure extérieure');

-- --------------------------------------------------------

--
-- Structure de la table `planete`
--

DROP TABLE IF EXISTS `planete`;
CREATE TABLE IF NOT EXISTS `planete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_galaxie` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `distance` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_galaxie` (`id_galaxie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `planete`
--

INSERT INTO `planete` (`id`, `id_galaxie`, `nom`, `distance`, `type`) VALUES
(4, 1, 'Mars', 78000000, 'Tellurique'),
(5, 1, 'Jupiter', 750000000, 'Gazeux'),
(6, 3, 'Tatooine', 2147483647, 'Tellurique'),
(7, 2, 'X Æ A-XII', 860000000, 'Tellurique');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_client` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `date_reservation` date NOT NULL,
  PRIMARY KEY (`id_client`,`id_voyage`),
  KEY `id_client` (`id_client`),
  KEY `id_voyage` (`id_voyage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_client`, `id_voyage`, `date_reservation`) VALUES
(1, 3, '2021-08-02'),
(3, 2, '2021-10-01'),
(4, 1, '2021-09-14');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `vitesse` int(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `nom`, `vitesse`, `capacite`) VALUES
(1, 'Aygo', 9001, 4),
(2, 'Trotinette', 5, 1),
(3, 'Mystery Machine', 110, 7),
(4, 'Tesla Modèle S', 210, 2),
(5, 'Voyager 1', 500000000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
CREATE TABLE IF NOT EXISTS `voyage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_planete` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL,
  `date_depart` date NOT NULL,
  `date_arrive` date NOT NULL,
  `nombre_voyageur` int(11) NOT NULL,
  `cout` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_planete` (`id_planete`) USING BTREE,
  KEY `id_vehicule` (`id_vehicule`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`id`, `id_planete`, `id_vehicule`, `date_depart`, `date_arrive`, `nombre_voyageur`, `cout`) VALUES
(1, 4, 1, '2021-10-05', '2021-10-13', 3, 666999),
(2, 6, 2, '2021-10-01', '2169-10-07', 1, 3),
(3, 7, 3, '2021-09-08', '2021-11-12', 6, 6536);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `planete`
--
ALTER TABLE `planete`
  ADD CONSTRAINT `planete_galaxie` FOREIGN KEY (`id_galaxie`) REFERENCES `galaxie` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `reservation_voyage` FOREIGN KEY (`id_voyage`) REFERENCES `voyage` (`id`);

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `planete_voyage` FOREIGN KEY (`id_planete`) REFERENCES `planete` (`id`),
  ADD CONSTRAINT `vehicule_voyage` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
