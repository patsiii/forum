-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 28 Août 2017 à 13:33
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test2`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'jeux'),
(2, 'films');

-- --------------------------------------------------------

--
-- Structure de la table `galeriepath`
--

CREATE TABLE `galeriepath` (
  `id_image` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `galeriepath`
--

INSERT INTO `galeriepath` (`id_image`, `path`) VALUES
(1, 'assets/img/galerie/img1.jpg'),
(2, 'assets/img/galerie/img2.jpg'),
(3, 'assets/img/galerie/img3.jpg'),
(4, 'assets/img/galerie/img4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(21) NOT NULL,
  `email` varchar(21) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `email`, `mdp`, `avatar`) VALUES
(1, 'new1', 'paterneee@gmail.com', '$2y$11$Er31415pcFklM98745A.PudOeGb5VkyxmuIjVS8dWw7XJoMhKDqR.', '1.jpg'),
(7, 'test2', 'paterneee@gmail.com', '$2y$11$Er31415pcFklM98745A.PudOeGb5VkyxmuIjVS8dWw7XJoMhKDqR.', '7.jpg'),
(8, 'test3', 'paterneee@gmail.com', '$2y$11$Er31415pcFklM98745A.PudOeGb5VkyxmuIjVS8dWw7XJoMhKDqR.', '8.jpg'),
(333, 'admin', 'paterneee@gmail.com', '$2y$11$Er31415pcFklM98745A.PudOeGb5VkyxmuIjVS8dWw7XJoMhKDqR.', '333.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `postsujet`
--

CREATE TABLE `postsujet` (
  `id` int(11) NOT NULL,
  `propri` int(11) NOT NULL,
  `contenu` text,
  `date` datetime DEFAULT NULL,
  `sujet` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `postsujet`
--

INSERT INTO `postsujet` (`id`, `propri`, `contenu`, `date`, `sujet`) VALUES
(50, 8, 'hum, pervers', '2017-08-28 16:27:26', 'Game of Thrones'),
(44, 1, 'c\'est quoi ce tableau', '2017-08-28 15:19:23', 'les nouveautÃ©s ne manque pas'),
(45, 1, 'besoin d\'aide Ã  l\'Ã©tape dragon', '2017-08-28 16:11:47', 'Tomb raider 12 vient de sortir'),
(46, 7, 'Quand je suis en colÃ¨re, je suis comme ce gars ', '2017-08-28 16:17:30', 'John wick'),
(47, 7, 'les scÃ¨nes sont, ouuuuuuuuuuu, vous devinez oÃ¹ je veux en venir', '2017-08-28 16:19:43', 'Game of Thrones'),
(48, 333, 'Rien de plus simple\r\nclic ici https://www.tombraider.com/fr', '2017-08-28 16:21:09', 'Tomb raider 12 vient de sortir');

-- --------------------------------------------------------

--
-- Structure de la table `slidepath`
--

CREATE TABLE `slidepath` (
  `id_image` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `slidepath`
--

INSERT INTO `slidepath` (`id_image`, `path`) VALUES
(1, 'assets/img/archi1.jpg'),
(2, 'assets/img/archi2.jpg'),
(3, 'assets/img/archi3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `categorie` varchar(21) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`id`, `name`, `categorie`) VALUES
(26, 'Tomb raider 12 vient de sortir', 'jeux'),
(27, 'Observer 2017', 'jeux'),
(28, 'John wick', 'films'),
(29, 'Game of Thrones', 'films'),
(30, 'Ghost recon', 'jeux');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `galeriepath`
--
ALTER TABLE `galeriepath`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `postsujet`
--
ALTER TABLE `postsujet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `slidepath`
--
ALTER TABLE `slidepath`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `galeriepath`
--
ALTER TABLE `galeriepath`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;
--
-- AUTO_INCREMENT pour la table `postsujet`
--
ALTER TABLE `postsujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `slidepath`
--
ALTER TABLE `slidepath`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
