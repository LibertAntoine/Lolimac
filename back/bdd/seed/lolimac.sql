-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2019 at 01:19 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lolimac`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_created` date NOT NULL,
  `date_edited` date NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date_created`, `date_edited`, `id_post`, `id_user`) VALUES
(1, 'Voila j\'ai changÃ© ce que je voulait dire', '2019-04-20', '2019-04-20', 2, 12),
(2, 'Voila j\'ai changÃ© ce que je voulait dire', '2019-04-20', '2019-04-20', 2, 12),
(3, 'Voila j\'ai changÃ© ce que je voulait dire', '2019-04-20', '2019-04-20', 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo_url` text NOT NULL,
  `description` text,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `photo_url`, `description`, `date_start`, `date_end`, `date_created`) VALUES
(1, 'Titre AAAAAeeAAA 1 <3', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', 'c\'est le lol', NULL, '2018-12-12 00:00:00', '2019-04-27 00:00:00'),
(2, 'euh coucou', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', 'c\'est le lol', '2019-05-23 10:10:10', '2019-12-12 10:10:10', '2019-04-27 23:42:06'),
(3, 'Titre AAAAAeeAAA 1 <3', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', 'c\'est le lol', '2019-05-20 10:00:00', '2019-05-21 00:00:00', '2019-04-27 23:44:54'),
(4, 'There we glkji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:19:07'),
(5, 'There we godfodlkji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:20:03'),
(6, 'There we godfodlkiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:22:23'),
(7, 'There we godfodlkuihiuiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:23:02'),
(8, 'There we godfodlkuihiuopiiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:24:01'),
(9, 'There we godfodlkuihiuopoopiiojji', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-16 15:25:35'),
(11, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:01:42'),
(12, 'Les slips en folie', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, '2019-05-24 18:22:12', '2019-05-24 23:25:12', '2019-05-17 19:08:44'),
(13, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:08:45'),
(14, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:08:46'),
(15, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:08:46'),
(16, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:08:46'),
(17, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:09:15'),
(18, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:09:34'),
(19, 'Name', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-17 19:10:35'),
(20, 'Nameeee', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-18 19:34:32'),
(21, 'Nameeee', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-18 19:35:09'),
(22, 'Nameeee', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-18 21:21:12'),
(23, 'Nameeee', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-18 21:21:14'),
(24, 'Nameeee', 'https://images.unsplash.com/photo-1504564321107-4aa3efddb5bd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80', NULL, NULL, NULL, '2019-05-18 21:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `eventtypes`
--

CREATE TABLE `eventtypes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventtypes`
--

INSERT INTO `eventtypes` (`id`, `name`) VALUES
(1, 'Trop rigolo'),
(2, 'salu'),
(3, 'Trop rigolo'),
(4, 'n\'importe iugyt fr quoi'),
(5, 'n\'importe iugyt fr quoi'),
(6, 'n\'importe iugyt fr quoi'),
(7, 'n\'importe iugyt fr quoi'),
(8, 'n\'importe iugyt fr quoi');

-- --------------------------------------------------------

--
-- Table structure for table `link_events_eventtypes`
--

CREATE TABLE `link_events_eventtypes` (
  `id_event` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_events_eventtypes`
--

INSERT INTO `link_events_eventtypes` (`id_event`, `id_type`) VALUES
(1, 2),
(12, 8),
(19, 1),
(21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `link_events_places`
--

CREATE TABLE `link_events_places` (
  `id_event` int(11) NOT NULL,
  `id_place` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_events_places`
--

INSERT INTO `link_events_places` (`id_event`, `id_place`) VALUES
(3, 10),
(12, 19);

-- --------------------------------------------------------

--
-- Table structure for table `link_events_users_modules`
--

CREATE TABLE `link_events_users_modules` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_events_users_modules`
--

INSERT INTO `link_events_users_modules` (`id_event`, `id_user`, `id_module`) VALUES
(1, 21, 2),
(1, 22, 2),
(12, 22, 1),
(13, 22, 1),
(14, 22, 1),
(15, 22, 1),
(16, 22, 1),
(17, 22, 1),
(18, 22, 1),
(19, 22, 1),
(21, 22, 1),
(22, 22, 1),
(23, 22, 1),
(24, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_events`
--

CREATE TABLE `notification_events` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `date_edit` datetime NOT NULL,
  `type_edit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_events`
--

INSERT INTO `notification_events` (`id`, `id_event`, `date_edit`, `type_edit`) VALUES
(8, 1, '2019-05-17 18:34:12', 'title'),
(9, 1, '2019-05-17 18:34:12', 'id'),
(10, 1, '2019-05-17 18:34:50', 'date_start'),
(11, 1, '2019-05-17 18:34:50', 'title'),
(12, 1, '2019-05-17 18:34:57', 'date_start'),
(13, 1, '2019-05-17 18:34:57', 'title'),
(14, 1, '2019-05-17 19:31:31', 'date_start'),
(15, 1, '2019-05-17 19:31:31', 'title'),
(16, 1, '2019-05-17 19:31:31', 'type'),
(17, 1, '2019-05-17 19:35:46', 'date_start'),
(18, 1, '2019-05-17 19:35:46', 'title'),
(19, 1, '2019-05-17 19:35:46', 'type'),
(20, 3, '2019-05-19 01:14:09', 'date_start'),
(21, 3, '2019-05-19 01:14:09', 'title'),
(22, 3, '2019-05-19 01:14:09', 'place'),
(23, 3, '2019-05-19 01:18:07', 'date_start'),
(24, 3, '2019-05-19 01:18:07', 'title'),
(25, 3, '2019-05-19 01:18:07', 'place'),
(26, 12, '2019-05-19 12:36:44', 'title'),
(27, 12, '2019-05-19 12:36:44', 'place'),
(28, 12, '2019-05-19 12:36:44', 'type'),
(29, 12, '2019-05-19 12:36:44', 'date_start'),
(30, 12, '2019-05-19 12:36:44', 'date_end'),
(31, 12, '2019-05-19 12:49:35', 'title'),
(32, 12, '2019-05-19 12:49:35', 'place'),
(33, 12, '2019-05-19 12:49:35', 'type'),
(34, 12, '2019-05-19 12:49:35', 'date_start'),
(35, 12, '2019-05-19 12:49:35', 'date_end'),
(36, 12, '2019-05-19 12:58:28', 'title'),
(37, 12, '2019-05-19 12:58:28', 'place'),
(38, 12, '2019-05-19 12:58:28', 'type'),
(39, 12, '2019-05-19 12:58:28', 'date_start'),
(40, 12, '2019-05-19 12:58:28', 'date_end'),
(41, 12, '2019-05-19 13:01:47', 'title'),
(42, 12, '2019-05-19 13:01:47', 'place'),
(43, 12, '2019-05-19 13:01:47', 'type'),
(44, 12, '2019-05-19 13:01:47', 'date_start'),
(45, 12, '2019-05-19 13:01:47', 'date_end'),
(46, 12, '2019-05-19 13:02:25', 'title'),
(47, 12, '2019-05-19 13:02:25', 'place'),
(48, 12, '2019-05-19 13:02:25', 'type'),
(49, 12, '2019-05-19 13:02:25', 'date_start'),
(50, 12, '2019-05-19 13:02:25', 'date_end'),
(51, 12, '2019-05-19 13:02:28', 'title'),
(52, 12, '2019-05-19 13:02:28', 'place'),
(53, 12, '2019-05-19 13:02:28', 'type'),
(54, 12, '2019-05-19 13:02:28', 'date_start'),
(55, 12, '2019-05-19 13:02:28', 'date_end'),
(56, 12, '2019-05-19 13:02:29', 'title'),
(57, 12, '2019-05-19 13:02:29', 'place'),
(58, 12, '2019-05-19 13:02:29', 'type'),
(59, 12, '2019-05-19 13:02:29', 'date_start'),
(60, 12, '2019-05-19 13:02:29', 'date_end'),
(61, 12, '2019-05-19 13:03:15', 'title'),
(62, 12, '2019-05-19 13:03:15', 'place'),
(63, 12, '2019-05-19 13:03:15', 'type'),
(64, 12, '2019-05-19 13:03:15', 'date_start'),
(65, 12, '2019-05-19 13:03:15', 'date_end'),
(66, 12, '2019-05-19 13:09:45', 'type_edit'),
(67, 12, '2019-05-19 13:10:00', 'type_edit'),
(68, 12, '2019-05-19 13:11:37', 'post'),
(69, 12, '2019-05-19 13:11:54', 'post'),
(70, 12, '2019-05-19 13:11:59', 'title'),
(71, 12, '2019-05-19 13:11:59', 'place'),
(72, 12, '2019-05-19 13:11:59', 'type'),
(73, 12, '2019-05-19 13:11:59', 'date_start'),
(74, 12, '2019-05-19 13:11:59', 'date_end');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `postcode` int(11) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `postcode`, `street`, `number`, `city`, `name`) VALUES
(1, NULL, NULL, NULL, NULL, 'lalaspokzpela'),
(2, NULL, NULL, NULL, NULL, 'lalaspookpokzpela'),
(3, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(4, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(5, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(6, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(7, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(8, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela'),
(9, 98247, 'Groove St', 2, 'San Andreas', 'C\'est lÃ '),
(10, 98247, 'Groove St', 2, 'San Andreas', 'C\'est lÃ '),
(11, NULL, NULL, NULL, 'ta mÃ¨re', 'lol'),
(12, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(13, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(14, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(15, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(16, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(17, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(18, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol'),
(19, 84848, 'Lalalol', 4, 'ta mÃ¨re', 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_created` date NOT NULL,
  `date_edited` date NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date_created`, `date_edited`, `id_event`, `id_user`) VALUES
(2, 'J\'adore ta grosse saucisse', 'Enforne moi la stp.', '2019-05-19', '2019-05-19', 12, 22),
(3, 'Coucou', 'a stp.', '2019-05-19', '2019-05-19', 12, 22),
(4, 'Coucou toa', 'a stp.', '2019-05-19', '2019-05-19', 12, 22),
(5, 'Coucou toeeea', 'a stp.', '2019-05-19', '2019-05-19', 12, 22);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `end_year` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(22) NOT NULL,
  `lastname` varchar(22) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `pwd_hash` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `year_promotion` int(11) NOT NULL,
  `date_notification_check` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `pseudo`, `mail`, `phone`, `pwd_hash`, `photo_url`, `status`, `year_promotion`, `date_notification_check`) VALUES
(21, 'liuiyiuyl', 'lien', 'nicolnt', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$iQs9LjUg./unNub/8xPQv.6zq2UXEdUukvigN3FH..AWCKbBAQQre', 'nom_photo.jpg', 1, 2021, '2019-05-17 14:33:49'),
(22, 'nico', 'lien', 'nicol', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$YYYVYKgDq9iE6.zbzOp6zeAaoTmOYBcDfWAUUZgtdtiGUp7fH.S4W', 'nom_photo.jpg', 3, 2021, '2019-05-19 13:13:41'),
(23, 'nico', 'lien', 'lalal', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$mXn.IcSl3Kk5.64zx3y7LOCAlndBrNgzreyKGT1veOyMk1FyvGT5m', 'nom_photo.jpg', 3, 2021, '2019-05-18 15:07:16'),
(24, 'nico', 'lien', 'yoyo', 'mail@gmail.com', NULL, '$2y$10$o8qfiU00HfqDN7GdmjdccOtuWOhOhScqJmjn2O.1tny/SXAJm.6Dm', 'nom_photo.jpg', 3, 2021, '2019-05-18 15:07:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventtypes`
--
ALTER TABLE `eventtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_events_eventtypes`
--
ALTER TABLE `link_events_eventtypes`
  ADD PRIMARY KEY (`id_event`,`id_type`);

--
-- Indexes for table `link_events_places`
--
ALTER TABLE `link_events_places`
  ADD PRIMARY KEY (`id_event`,`id_place`);

--
-- Indexes for table `link_events_users_modules`
--
ALTER TABLE `link_events_users_modules`
  ADD PRIMARY KEY (`id_event`,`id_user`,`id_module`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_events`
--
ALTER TABLE `notification_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`end_year`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `eventtypes`
--
ALTER TABLE `eventtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_events`
--
ALTER TABLE `notification_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
