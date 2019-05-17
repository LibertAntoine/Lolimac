-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 17 mai 2019 à 12:25
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lolimac`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date_created` date NOT NULL,
  `date_edited` date NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date_created`, `date_edited`, `id_post`, `id_user`) VALUES
(1, 'Voila j\'ai changÃ© ce que je voulait dire', '2019-04-20', '2019-04-20', 2, 12),
(2, 'Voila j\'ai changÃ© ce que je voulait dire', '2019-04-20', '2019-04-20', 2, 12),
(3, 'Voila j\'ai changÃ© ce que je voulait dire', '2019-04-20', '2019-04-20', 2, 12);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `photo_url` text NOT NULL,
  `description` text,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `photo_url`, `description`, `date_start`, `date_end`, `date_created`) VALUES
(1, 'MAIS LOL', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', 'c\'est le lol', '2018-12-12 22:22:00', '2018-12-12 00:00:00', '2019-04-27 00:00:00'),
(2, 'euh coucou', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', 'c\'est le lol', '2018-12-11 10:10:10', '2018-12-12 10:10:10', '2019-04-27 23:42:06'),
(3, 'tÃ©ste dÃ ccÃªnts', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', 'c\'est le lol', '2018-12-11 10:10:10', '2018-12-12 10:10:10', '2019-04-27 23:44:54'),
(4, 'There we glkji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:19:07'),
(5, 'There we godfodlkji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:20:03'),
(6, 'There we godfodlkiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:22:23'),
(7, 'There we godfodlkuihiuiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:23:02'),
(8, 'There we godfodlkuihiuopiiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:24:01'),
(9, 'There we godfodlkuihiuopoopiiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:25:35');

-- --------------------------------------------------------

--
-- Structure de la table `eventtypes`
--

DROP TABLE IF EXISTS `eventtypes`;
CREATE TABLE IF NOT EXISTS `eventtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link_events_eventtypes`
--

DROP TABLE IF EXISTS `link_events_eventtypes`;
CREATE TABLE IF NOT EXISTS `link_events_eventtypes` (
  `id_event` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_event`,`id_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link_events_places`
--

DROP TABLE IF EXISTS `link_events_places`;
CREATE TABLE IF NOT EXISTS `link_events_places` (
  `id_event` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  PRIMARY KEY (`id_event`,`id_place`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link_events_users_modules`
--

DROP TABLE IF EXISTS `link_events_users_modules`;
CREATE TABLE IF NOT EXISTS `link_events_users_modules` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  PRIMARY KEY (`id_event`,`id_user`,`id_module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postcode` int(11) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `places`
--

INSERT INTO `places` (`id`, `postcode`, `street`, `number`, `city`, `name`) VALUES
(1, NULL, NULL, NULL, NULL, 'lalaspokzpela'),
(2, NULL, NULL, NULL, NULL, 'lalaspookpokzpela'),
(3, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(4, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(5, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(6, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(7, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(8, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_created` date NOT NULL,
  `date_edited` date NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `end_year` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  PRIMARY KEY (`end_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(22) NOT NULL,
  `lastname` varchar(22) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `pwd_hash` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `year_promotion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `pseudo`, `mail`, `phone`, `pwd_hash`, `photo_url`, `status`, `year_promotion`) VALUES
(21, 'liuiyiuyl', 'lien', 'nicolnt', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$iQs9LjUg./unNub/8xPQv.6zq2UXEdUukvigN3FH..AWCKbBAQQre', 'nom_photo.jpg', 1, 2021),
(22, 'nico', 'lien', 'nicol', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$YYYVYKgDq9iE6.zbzOp6zeAaoTmOYBcDfWAUUZgtdtiGUp7fH.S4W', 'nom_photo.jpg', 3, 2021);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
