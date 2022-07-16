-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 juil. 2021 à 21:31
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mg`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Id_adm` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_adm` varchar(20) COLLATE utf8_bin NOT NULL,
  `Prenom_adm` varchar(20) COLLATE utf8_bin NOT NULL,
  `Email_adm` varchar(50) COLLATE utf8_bin NOT NULL,
  `Pass_adm` int(20) NOT NULL,
  PRIMARY KEY (`Id_adm`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`Id_adm`, `Nom_adm`, `Prenom_adm`, `Email_adm`, `Pass_adm`) VALUES
(1, 'Weslati', 'Ala', 'alaweslati2@gmail.com', 12345678),
(2, 'dahmou', 'manar', 'manardahmou360@gmail.com', 12345678),
(3, 'guesmi', 'yosri', 'yosri@gmail.com', 12345678);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `Id_cli` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_cli` varchar(20) COLLATE utf8_bin NOT NULL,
  `Prenom_cli` varchar(20) COLLATE utf8_bin NOT NULL,
  `Email_cli` varchar(50) COLLATE utf8_bin NOT NULL,
  `Pass_cli` varchar(20) COLLATE utf8_bin NOT NULL,
  `Date_ness` date NOT NULL,
  `Adr_cli` varchar(50) COLLATE utf8_bin NOT NULL,
  `Tel_cli` int(8) NOT NULL,
  PRIMARY KEY (`Id_cli`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_cli`, `Nom_cli`, `Prenom_cli`, `Email_cli`, `Pass_cli`, `Date_ness`, `Adr_cli`, `Tel_cli`) VALUES
(3, 'weslati', 'ala', 'alaweslati2@gmail.com', '12345678', '2021-04-14', 'korba', 24314081);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_com` int(11) NOT NULL AUTO_INCREMENT,
  `Id_cli` int(11) NOT NULL,
  `Montant_tot` float NOT NULL,
  `Date_cmd` date NOT NULL,
  PRIMARY KEY (`Id_com`),
  KEY `Id_cli` (`Id_cli`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`Id_com`, `Id_cli`, `Montant_tot`, `Date_cmd`) VALUES
(1, 3, 250, '2021-04-07'),
(2, 3, 70, '2021-04-06'),
(3, 4, 80, '2021-04-07'),
(4, 6, 150, '2021-04-14'),
(5, 3, 15000, '2021-06-02'),
(6, 1, 10, '2021-06-03'),
(7, 1, 10, '2021-06-03'),
(8, 1, 1510, '2021-06-03');

-- --------------------------------------------------------

--
-- Structure de la table `detail_com`
--

DROP TABLE IF EXISTS `detail_com`;
CREATE TABLE IF NOT EXISTS `detail_com` (
  `Id_pro` int(11) NOT NULL,
  `Id_com` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `Prix_un` int(11) NOT NULL,
  PRIMARY KEY (`Id_pro`,`Id_com`),
  KEY `Id_pro` (`Id_pro`,`Id_com`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_pro` int(8) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `prix` double(10,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id_pro`),
  UNIQUE KEY `product_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_pro`, `categorie`, `nom`, `code`, `image`, `prix`, `quantite`) VALUES
(1, 'ordinateurs', 'MSI GF63 Thin Core i7 9th Gen', 'MSI4353', 'product-images/msi-laptop.jpeg', 1500.00, 2),
(2, 'périphérique et accessoire', 'WD 1.5 TB Wired External Hard Disk Drive  (Black)', 'WD091', 'product-images/external-hardidisk.jpeg', 50.00, 4),
(3, '', 'VERTIGO Running Shoes For Men  (Black)', 'LOTTO215', 'product-images/lotto-shoes.jpeg', 10.00, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
