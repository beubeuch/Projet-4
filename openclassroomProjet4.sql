-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 29 mars 2019 à 20:30
-- Version du serveur :  10.3.7-MariaDB
-- Version de PHP :  5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `openclassroomProjet4`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `moderation` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `content`, `date`, `name`, `moderation`) VALUES
(1, 1, '<p>A Procédé souvent émotté les clercs du pin<br>\r\nEncore dix jours à regarder la châtelaine et j\'entendais soupirer le verbe Fleurir<br>\r\nJe souffrais de l\'aquaplane inodore de l\'éclat<br>\r\nJ\'aimais le sourire d\'un mai</p>', '2019-01-28 00:00:00', 'Seb', 2),
(2, 1, '<p>C\'était le temps du bibi<br>\r\n\r\nMon violoncelle tirait sans fin<br>\r\n\r\nMon violoncelle coulait sans fin<br>\r\n\r\nC\'était le temps du fémur</p', '2019-01-29 00:00:00', 'Martin', 1),
(3, 1, '<p>La ville ressemblait à une unique lutte<br>\r\n\r\nLa ville ressemblait à une unique prostitution<br>\r\n\r\nLa ville ressemblait à une unique commande<br>\r\n\r\nLa ville ressemblait à une unique aventure</p>', '2019-02-01 00:00:00', 'Jean', 1),
(4, 1, 'Tous ces récits me rappellent les aventures de Jack London...', '2019-03-28 10:09:30', 'John', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment_moderate`
--

CREATE TABLE `comment_moderate` (
  `id` int(11) NOT NULL,
  `moderation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_moderate`
--

INSERT INTO `comment_moderate` (`id`, `moderation_name`) VALUES
(1, 'A modérer'),
(2, 'Signalé'),
(3, 'Modéré');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `date_modif` datetime DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 1,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `date`, `date_modif`, `statut`, `img`) VALUES
(1, 'Chapitre 01', '<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">L&rsquo;Alaska est le 49e &Eacute;tat des &Eacute;tats-Unis, dont la capitale est Juneau et la plus grande ville Anchorage, o&ugrave; habite environ 40 % de la population de l\'&Eacute;tat. Avec une superficie totale de 1 717 854 km2, il est l\'&Eacute;tat le plus &eacute;tendu et le plus septentrional du pays, mais l\'un des moins peupl&eacute;s, ne comptant que 737 438 habitants en 20181.</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Comme Hawa&iuml;, l\'Alaska est s&eacute;par&eacute; du Mainland et se situe au nord-ouest du Canada. Bord&eacute; par l\'oc&eacute;an Arctique au nord et la mer de B&eacute;ring et l\'oc&eacute;an Pacifique au sud, ce territoire est s&eacute;par&eacute; de l\'Asie par le d&eacute;troit de B&eacute;ring. En outre, ses divisions administratives ne sont pas des comt&eacute;s mais des boroughs.</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Alaska signifie &laquo; grande Terre &raquo; ou &laquo; continent &raquo; en al&eacute;oute3. Cette r&eacute;gion, que l\'on appelait au xixe si&egrave;cle l\'&laquo; Am&eacute;rique russe &raquo;, tire son nom d\'une longue presqu\'&icirc;le, au nord-ouest du continent am&eacute;ricain, &agrave; environ 1 000 kilom&egrave;tres au sud du d&eacute;troit de Bering, et qui se lie, vers le sud, aux &icirc;les Al&eacute;outiennes. Le surnom de l\'Alaska est &laquo; la derni&egrave;re fronti&egrave;re &raquo; ou &laquo; la terre du soleil de minuit &raquo;.</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Peupl&eacute; par des Al&eacute;outes, Esquimaux (notamment I&ntilde;upiak et Yupiks) et peut-&ecirc;tre d\'autres Am&eacute;rindiens depuis plusieurs mill&eacute;naires, le territoire est colonis&eacute; par des trappeurs russes &agrave; la fin du xviiie si&egrave;cle. L\'Alaska vit alors essentiellement du commerce du bois et de la traite des fourrures. En 1867, les &Eacute;tats-Unis l\'ach&egrave;tent &agrave; la Russie pour la somme de 7,2 millions de dollars (environ 120 millions de dollars actuels), et celui-ci adh&egrave;re &agrave; l\'Union le 3 janvier 1959. Les domaines &eacute;conomiques pr&eacute;dominants aujourd\'hui sont la p&ecirc;che, le tourisme, et surtout la production d\'hydrocarbures (p&eacute;trole, gaz) depuis la d&eacute;couverte de gisements &agrave; Prudhoe Bay dans les ann&eacute;es 1970.</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Le Denali (6 190 m&egrave;tres d\'altitude), point culminant des &Eacute;tats-Unis, se trouve dans la cha&icirc;ne d\'Alaska et constitue le c&oelig;ur du Parc national de Denali.</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Le climat y est de type polaire, et la faune caract&eacute;ristique des milieux froids (grizzli, caribou, orignal, ours blanc).</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Les territoires limitrophes sont le territoire du Yukon et la province de Colombie-Britannique au Canada. Le Kra&iuml; du Kamtchatka et le district autonome de Tchoukotka en Russie se trouvent &agrave; quelques dizaines de kilom&egrave;tres, de l\'autre c&ocirc;t&eacute; du d&eacute;troit de Bering.</span></span></p>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #222222; font-family: sans-serif;\"><span style=\"font-size: 14px;\">Bastion du Parti r&eacute;publicain, l\'Alaska fut gouvern&eacute; de 2006 &agrave; 2009 par Sarah Palin, candidate &agrave; la vice-pr&eacute;sidence des &Eacute;tats-Unis en 2008 et &eacute;g&eacute;rie du mouvement des Tea Party.</span></span></p>', '2019-02-21 18:00:00', '2019-03-28 11:03:19', 2, 'photo-1525220964737-6c299398493c.jpg'),
(2, 'Chapitre 02', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2019-02-21 18:30:00', '2019-03-29 18:42:56', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `post_statut`
--

CREATE TABLE `post_statut` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post_statut`
--

INSERT INTO `post_statut` (`id`, `name`) VALUES
(1, 'Brouillon'),
(2, 'Publié'),
(3, 'Archive');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `statut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `statut`) VALUES
(1, 'jeanForte', '$2y$10$d32gN/Wd0TmwkbudxF9Ve.AjWJCZ.sgycab4ScnVxqo2yT4t8f3Nm', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `moderation` (`moderation`);

--
-- Index pour la table `comment_moderate`
--
ALTER TABLE `comment_moderate`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statut` (`statut`);

--
-- Index pour la table `post_statut`
--
ALTER TABLE `post_statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment_moderate`
--
ALTER TABLE `comment_moderate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `post_statut`
--
ALTER TABLE `post_statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`moderation`) REFERENCES `comment_moderate` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`statut`) REFERENCES `post_statut` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
