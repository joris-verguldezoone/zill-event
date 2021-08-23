-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 23 août 2021 à 08:42
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zill-event`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`) VALUES
(1, 'azerty', '$2a$12$YqQu.7HQXUd6796Qyo.OZe/o5JtxFxRY.zlnLYn0SqSYZrG2VE/pe\r\n'),
(2, 'azzzzzzz', '$2y$10$xUQXcSMlGWMe7NHUyMPLf.kvHFzjYnYUdFOFd.fYN6JPK7zEuqz5G');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `path` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `type`, `path`) VALUES
(1, 'seminaire', NULL),
(2, 'soiree', NULL),
(3, 'ceremonie', NULL),
(4, 'conference', NULL),
(5, 'congres', NULL),
(6, 'captation', '/Project_pool_3/zill-event/upload/captation.png'),
(7, 'hybride', NULL),
(8, 'digital', NULL),
(9, 'lancement', NULL),
(10, 'exposition', NULL),
(11, 'assemblee', NULL),
(12, 'opening', NULL),
(13, 'vernissage', NULL),
(14, 'sportif', NULL),
(15, 'partenaire', NULL),
(16, 'inauguration', NULL),
(17, 'crazy', NULL),
(18, 'concert', NULL),
(19, 'salon', NULL),
(20, 'classique', NULL),
(21, 'danse', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `lien` varchar(500) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `id_admin`, `titre`, `lien`, `description`, `date`) VALUES
(1, 2, 'lmkmkm', 'https://www.slimframework.com/docs/v2/routing/helpers.html', 'La Nvidia GeForce RTX 3070 a été présentée en septembre 2020, il s\'agit d\'un des premières modèles de cartes graphiques conçus avec l\'architecture Ampere. Selon Nvidia, ses performances sont équivalentes à celle d’un RTX 2080 Ti. La RTX 3070 possède 8 Go de Mémoire GDDR6 avec 5888 coeurs Nvidia Cuda.', '2021-08-20 14:31:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
