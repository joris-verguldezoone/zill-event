-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 25 août 2021 à 20:14
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
(2, 'soiree', 'upload/event/soiree.png'),
(3, 'ceremonie', 'upload/event/ceremonie.jpg'),
(4, 'conference', NULL),
(5, 'congres', 'upload/event/congres.jpg'),
(6, 'captation', 'upload/event/captation.png'),
(7, 'hybride', 'upload/event/hybride.png'),
(8, 'digital', 'upload/event/digital.png'),
(9, 'lancement', NULL),
(10, 'exposition', 'upload/event/exposition.jpg'),
(11, 'assemblee', NULL),
(12, 'opening', 'upload/event/opening.jpg'),
(13, 'vernissage', 'upload/event/vernissage.png'),
(14, 'sportif', 'upload/event/sportif.png'),
(15, 'partenaire', NULL),
(16, 'inauguration', NULL),
(17, 'crazy', NULL),
(18, 'concert', 'upload/event/concert.png'),
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
  `admin` varchar(50) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `lien` varchar(500) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `date` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `lien_externe` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `admin`, `titre`, `lien`, `description`, `date`, `type`, `lien_externe`) VALUES
(1, '2', 'lmkmkm', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/L3-9b2gK16M\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'La Nvidia GeForce RTX 3070 a été présentée en septembre 2020, il s\'agit d\'un des premières modèles de cartes graphiques conçus avec l\'architecture Ampere. Selon Nvidia, ses performances sont équivalentes à celle d’un RTX 2080 Ti. La RTX 3070 possède 8 Go de Mémoire GDDR6 avec 5888 coeurs Nvidia Cuda.', '2021-08-20 14:31:16', 'video', ''),
(2, '2', 'Crack kid', 'https://pbs.twimg.com/profile_images/477157600048328704/EZv3ZRRM.jpeg', 'ntrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', '2021-08-25 13:58:18', 'photo', ''),
(3, '2', 'kjhgkjhgkjhg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/yhhpx4s78Ko\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n', 'Descriptionkjhgkhgkjh kgkjhgkhjgkjhg kjhgkjhgkjhg kjhg kjhggkjhg', '2021-08-25 14:00:48', 'video', ''),
(12, '2', 'Evenement chic', 'https://images.pexels.com/photos/16408/pexels-photo.jpg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id ligula at enim venenatis consequat. Curabitur tempus tristique lorem, nec mollis erat interdum sit amet. Aenean accumsan massa et porttitor rutrum. Duis malesuada sapien enim, et scelerisque velit hendrerit nec. Sed blandit risus diam, quis tempus neque venenatis at. Praesent ultricies finibus odio a ullamcorper. Aliquam et aliquam mi. Aliquam erat volutpat. Duis efficitur eget urna vitae rutrum. Suspendisse eu dapibus mi, et faucibus eros. Aenean id est nibh. Pellentesque pretium suscipit ante. Pellentesque quam mauris, accumsan ut ex vel, hendrerit rutrum sapien. Nulla lacinia rhoncus lacus vel dictum.\n\nDonec elementum condimentum nisi, vitae dignissim nisl. Etiam eget sodales felis. Vivamus at vehicula urna, ut venenatis ipsum. Aliquam vel tortor vitae enim aliquet efficitur in gravida nibh. Duis luctus massa nunc, quis pellentesque ante laoreet sed. Aliquam auctor, erat sit amet posuere cursus, sem elit pellentesque sapien, nec placerat orci metus vitae mi. In sollicitudin sem elit, vitae rhoncus nibh luctus et. Ut efficitur, neque ac pharetra euismod, lectus nunc venenatis erat, ut volutpat orci massa lobortis nunc.\n\nVestibulum feugiat ut orci ac pellentesque. Pellentesque posuere elit erat, sit amet iaculis lacus pulvinar ut. Morbi sed euismod dolor, quis aliquam mi. Praesent facilisis erat eu facilisis euismod. Nulla venenatis tristique diam. Praesent in venenatis erat. Donec eleifend arcu consectetur, tempus arcu id, tristique diam. Donec aliquet sem et fermentum luctus. Quisque a sodales ligula. In hac habitasse platea dictumst.', '2021-08-25 14:57:04', 'photo', ''),
(13, 'azzzzzzz', 'zazzazaza', 'https://ichef.bbci.co.uk/news/976/cpsprodpb/D2D2/production/_118707935_untitled-1.jpg', 'zDegscription', '2021-08-25 15:02:45', 'photo', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
