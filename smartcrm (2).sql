-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 24 déc. 2020 à 10:58
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smartcrm`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

DROP TABLE IF EXISTS `agence`;
CREATE TABLE IF NOT EXISTS `agence` (
  `id` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `localisation` varchar(150) NOT NULL,
  `montant` int(150) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commercial`
--

DROP TABLE IF EXISTS `commercial`;
CREATE TABLE IF NOT EXISTS `commercial` (
  `id` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `lieuHabitation` varchar(150) NOT NULL,
  `pseudo` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `chefEquipe` int(1) NOT NULL,
  `equipeId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`),
  KEY `equipeId` (`equipeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `entiteId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`),
  KEY `entiteId` (`entiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailvente`
--

DROP TABLE IF EXISTS `detailvente`;
CREATE TABLE IF NOT EXISTS `detailvente` (
  `id` varchar(150) NOT NULL,
  `produitId` varchar(150) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixUnitaire` int(11) NOT NULL,
  `venteId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produitId` (`produitId`),
  KEY `venteId` (`venteId`),
  KEY `agenceId` (`agenceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

DROP TABLE IF EXISTS `entite`;
CREATE TABLE IF NOT EXISTS `entite` (
  `id` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `localisation` varchar(150) NOT NULL,
  `domaineActivite` varchar(150) DEFAULT NULL,
  `type` varchar(150) NOT NULL,
  `categorie` varchar(150) NOT NULL,
  `commercialId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`),
  KEY `commercialId` (`commercialId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `id` varchar(150) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  `createdOn` date NOT NULL,
  `status` int(1) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` varchar(150) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `statut` varchar(150) NOT NULL,
  `entiteId` varchar(150) NOT NULL,
  `commercialId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`),
  KEY `commercialId` (`commercialId`),
  KEY `entiteId` (`entiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `montant` int(11) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` varchar(150) NOT NULL,
  `libelle` varchar(150) NOT NULL,
  `prixUnitaire` int(11) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id` varchar(150) NOT NULL,
  `dateRdv` date NOT NULL,
  `heureRdv` timestamp NOT NULL,
  `motif` text NOT NULL,
  `commercialId` varchar(150) NOT NULL,
  `entiteId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenceId` (`agenceId`),
  KEY `commercialId` (`commercialId`),
  KEY `entiteId` (`entiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
CREATE TABLE IF NOT EXISTS `responsable` (
  `id` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pseudo` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  KEY `agenceId` (`agenceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `montant` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `offreId` varchar(150) DEFAULT NULL,
  `entiteId` varchar(150) NOT NULL,
  `agenceId` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entiteId` (`entiteId`),
  KEY `agenceId` (`agenceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commercial`
--
ALTER TABLE `commercial`
  ADD CONSTRAINT `commercial_ibfk_1` FOREIGN KEY (`equipeId`) REFERENCES `equipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`entiteId`) REFERENCES `entite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailvente`
--
ALTER TABLE `detailvente`
  ADD CONSTRAINT `detailvente_ibfk_1` FOREIGN KEY (`produitId`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailvente_ibfk_2` FOREIGN KEY (`venteId`) REFERENCES `vente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entite`
--
ALTER TABLE `entite`
  ADD CONSTRAINT `entite_ibfk_1` FOREIGN KEY (`commercialId`) REFERENCES `commercial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`entiteId`) REFERENCES `entite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offre_ibfk_2` FOREIGN KEY (`commercialId`) REFERENCES `commercial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`agenceId`) REFERENCES `agence` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`entiteId`) REFERENCES `entite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`commercialId`) REFERENCES `commercial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `responsable_ibfk_1` FOREIGN KEY (`agenceId`) REFERENCES `agence` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
