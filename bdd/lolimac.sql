-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2019 at 02:38 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

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
-- Table structure for table `eventtypes`
--

CREATE TABLE `eventtypes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `link_events_eventtypes`
--

CREATE TABLE `link_events_eventtypes` (
  `id_event` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `link_events_places`
--

CREATE TABLE `link_events_places` (
  `id_event` int(11) NOT NULL,
  `id_place` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `link_events_users_modules`
--

CREATE TABLE `link_events_users_modules` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `id_event` int(11) NOT NULL,
  `edit_time` datetime NOT NULL,
  `edit_type` varchar(255) NOT NULL,
  `edit_info` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, NULL, NULL, NULL, NULL, 'lalaspookpoiojkzpela');

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
  `phone` varchar(14) NOT NULL,
  `pwd_hash` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `year_promotion` int(11) NOT NULL,
  `last_notification_check` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `pseudo`, `mail`, `phone`, `pwd_hash`, `photo_url`, `status`, `year_promotion`, `last_notification_check`) VALUES
(21, 'liuiyiuyl', 'lien', 'nicolnt', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$iQs9LjUg./unNub/8xPQv.6zq2UXEdUukvigN3FH..AWCKbBAQQre', 'nom_photo.jpg', 1, 2021, '2019-05-17 14:33:49'),
(22, 'nico', 'lien', 'nicol', 'mail@gmail.com', '06 06 06 06 06', '$2y$10$YYYVYKgDq9iE6.zbzOp6zeAaoTmOYBcDfWAUUZgtdtiGUp7fH.S4W', 'nom_photo.jpg', 3, 2021, '2019-05-17 14:33:49');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `eventtypes`
--
ALTER TABLE `eventtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
