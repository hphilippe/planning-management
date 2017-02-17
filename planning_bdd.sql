-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 25 Avril 2016 à 17:34
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `planning`
--

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE IF NOT EXISTS `annee` (
  `annee` varchar(10) NOT NULL,
  PRIMARY KEY (`annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `annee`
--

INSERT INTO `annee` (`annee`) VALUES
('2014-2015'),
('2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `contrainte`
--

CREATE TABLE IF NOT EXISTS `contrainte` (
  `id_cont` int(11) NOT NULL AUTO_INCREMENT,
  `journee` enum('lundi','mardi','mercredi','jeudi','vendredi') NOT NULL,
  `moment` enum('matin','a-midi') NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `id_inter` int(11) NOT NULL,
  PRIMARY KEY (`id_cont`),
  KEY `id_inter` (`id_inter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Contenu de la table `contrainte`
--

INSERT INTO `contrainte` (`id_cont`, `journee`, `moment`, `niveau`, `id_inter`) VALUES
(1, 'lundi', 'matin', 'convenable', 13),
(2, 'mardi', 'matin', 'non-convenable', 13),
(3, 'mercredi', 'matin', 'impossible', 13),
(4, 'jeudi', 'matin', 'convenable', 13),
(5, 'vendredi', 'matin', 'convenable', 13),
(6, 'lundi', 'a-midi', 'convenable', 13),
(7, 'mardi', 'a-midi', 'impossible', 13),
(8, 'mercredi', 'a-midi', 'impossible', 13),
(9, 'jeudi', 'a-midi', 'impossible', 13),
(10, 'vendredi', 'a-midi', 'non-convenable', 13),
(11, 'lundi', 'matin', 'impossible', 9),
(12, 'mardi', 'matin', 'convenable', 9),
(13, 'mercredi', 'matin', 'impossible', 9),
(14, 'jeudi', 'matin', 'non-convenable', 9),
(15, 'vendredi', 'matin', 'impossible', 9),
(16, 'lundi', 'a-midi', 'convenable', 9),
(17, 'mardi', 'a-midi', 'non-convenable', 9),
(18, 'mercredi', 'a-midi', 'impossible', 9),
(19, 'jeudi', 'a-midi', 'convenable', 9),
(20, 'vendredi', 'a-midi', 'impossible', 9),
(21, 'lundi', 'matin', 'convenable', 5),
(22, 'mardi', 'matin', 'impossible', 5),
(23, 'mercredi', 'matin', 'convenable', 5),
(24, 'jeudi', 'matin', 'impossible', 5),
(25, 'vendredi', 'matin', 'impossible', 5),
(26, 'lundi', 'a-midi', 'non-convenable', 5),
(27, 'mardi', 'a-midi', 'convenable', 5),
(28, 'mercredi', 'a-midi', 'non-convenable', 5),
(29, 'jeudi', 'a-midi', 'convenable', 5),
(30, 'vendredi', 'a-midi', 'convenable', 5),
(31, 'lundi', 'matin', 'disponible', 4),
(32, 'mardi', 'matin', 'disponible', 4),
(33, 'mercredi', 'matin', 'disponible', 4),
(34, 'jeudi', 'matin', 'disponible', 4),
(35, 'vendredi', 'matin', 'disponible', 4),
(36, 'lundi', 'a-midi', 'disponible', 4),
(37, 'mardi', 'a-midi', 'disponible', 4),
(38, 'mercredi', 'a-midi', 'disponible', 4),
(39, 'jeudi', 'a-midi', 'disponible', 4),
(40, 'vendredi', 'a-midi', 'disponible', 4),
(41, 'lundi', 'matin', 'non-convenable', 7),
(42, 'mardi', 'matin', 'impossible', 7),
(43, 'mercredi', 'matin', 'convenable', 7),
(44, 'jeudi', 'matin', 'impossible', 7),
(45, 'vendredi', 'matin', 'convenable', 7),
(46, 'lundi', 'a-midi', 'impossible', 7),
(47, 'mardi', 'a-midi', 'impossible', 7),
(48, 'mercredi', 'a-midi', 'impossible', 7),
(49, 'jeudi', 'a-midi', 'convenable', 7),
(50, 'vendredi', 'a-midi', 'impossible', 7),
(51, 'lundi', 'matin', 'disponible', 2),
(52, 'mardi', 'matin', 'disponible', 2),
(53, 'mercredi', 'matin', 'disponible', 2),
(54, 'jeudi', 'matin', 'disponible', 2),
(55, 'vendredi', 'matin', 'disponible', 2),
(56, 'lundi', 'a-midi', 'disponible', 2),
(57, 'mardi', 'a-midi', 'disponible', 2),
(58, 'mercredi', 'a-midi', 'disponible', 2),
(59, 'jeudi', 'a-midi', 'disponible', 2),
(60, 'vendredi', 'a-midi', 'disponible', 2),
(61, 'lundi', 'matin', 'impossible', 8),
(62, 'mardi', 'matin', 'impossible', 8),
(63, 'mercredi', 'matin', 'impossible', 8),
(64, 'jeudi', 'matin', 'non-convenable', 8),
(65, 'vendredi', 'matin', 'convenable', 8),
(66, 'lundi', 'a-midi', 'impossible', 8),
(67, 'mardi', 'a-midi', 'impossible', 8),
(68, 'mercredi', 'a-midi', 'impossible', 8),
(69, 'jeudi', 'a-midi', 'convenable', 8),
(70, 'vendredi', 'a-midi', 'convenable', 8),
(71, 'lundi', 'matin', 'impossible', 11),
(72, 'mardi', 'matin', 'non-convenable', 11),
(73, 'mercredi', 'matin', 'impossible', 11),
(74, 'jeudi', 'matin', 'impossible', 11),
(75, 'vendredi', 'matin', 'impossible', 11),
(76, 'lundi', 'a-midi', 'convenable', 11),
(77, 'mardi', 'a-midi', 'convenable', 11),
(78, 'mercredi', 'a-midi', 'convenable', 11),
(79, 'jeudi', 'a-midi', 'impossible', 11),
(80, 'vendredi', 'a-midi', 'impossible', 11),
(81, 'lundi', 'matin', 'disponible', 1),
(82, 'mardi', 'matin', 'disponible', 1),
(83, 'mercredi', 'matin', 'disponible', 1),
(84, 'jeudi', 'matin', 'disponible', 1),
(85, 'vendredi', 'matin', 'disponible', 1),
(86, 'lundi', 'a-midi', 'disponible', 1),
(87, 'mardi', 'a-midi', 'disponible', 1),
(88, 'mercredi', 'a-midi', 'disponible', 1),
(89, 'jeudi', 'a-midi', 'disponible', 1),
(90, 'vendredi', 'a-midi', 'disponible', 1),
(91, 'lundi', 'matin', 'disponible', 1),
(92, 'mardi', 'matin', 'disponible', 1),
(93, 'mercredi', 'matin', 'disponible', 1),
(94, 'jeudi', 'matin', 'disponible', 1),
(95, 'vendredi', 'matin', 'disponible', 1),
(96, 'lundi', 'a-midi', 'disponible', 1),
(97, 'mardi', 'a-midi', 'disponible', 1),
(98, 'mercredi', 'a-midi', 'disponible', 1),
(99, 'jeudi', 'a-midi', 'disponible', 1),
(100, 'vendredi', 'a-midi', 'disponible', 1),
(111, 'lundi', 'matin', 'disponible', 17),
(112, 'mardi', 'matin', 'disponible', 17),
(113, 'mercredi', 'matin', 'disponible', 17),
(114, 'jeudi', 'matin', 'disponible', 17),
(115, 'vendredi', 'matin', 'disponible', 17),
(116, 'lundi', 'a-midi', 'disponible', 17),
(117, 'mardi', 'a-midi', 'disponible', 17),
(118, 'mercredi', 'a-midi', 'disponible', 17),
(119, 'jeudi', 'a-midi', 'disponible', 17),
(120, 'vendredi', 'a-midi', 'disponible', 17);

-- --------------------------------------------------------

--
-- Structure de la table `contrainte_particuliere`
--

CREATE TABLE IF NOT EXISTS `contrainte_particuliere` (
  `id_cont_par` int(11) NOT NULL AUTO_INCREMENT,
  `date_cont` date NOT NULL,
  `moment` enum('matin','a-midi') NOT NULL,
  `id_inter` int(11) NOT NULL,
  PRIMARY KEY (`id_cont_par`),
  KEY `id_inter` (`id_inter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `contrainte_particuliere`
--

INSERT INTO `contrainte_particuliere` (`id_cont_par`, `date_cont`, `moment`, `id_inter`) VALUES
(2, '2016-04-03', 'a-midi', 9),
(6, '2016-04-01', 'matin', 9);

-- --------------------------------------------------------

--
-- Structure de la table `diriger`
--

CREATE TABLE IF NOT EXISTS `diriger` (
  `id_seance` int(11) NOT NULL,
  `id_inter` int(11) NOT NULL,
  PRIMARY KEY (`id_seance`,`id_inter`),
  KEY `id_inter` (`id_inter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `diriger`
--

INSERT INTO `diriger` (`id_seance`, `id_inter`) VALUES
(55, 8),
(56, 8),
(57, 8),
(58, 8),
(59, 8),
(53, 9),
(54, 9),
(43, 11),
(45, 11),
(61, 17),
(62, 17);

-- --------------------------------------------------------

--
-- Structure de la table `dispenser`
--

CREATE TABLE IF NOT EXISTS `dispenser` (
  `id_seance` int(11) NOT NULL,
  `id_mat` int(11) NOT NULL,
  PRIMARY KEY (`id_seance`,`id_mat`),
  KEY `id_mat` (`id_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `dispenser`
--

INSERT INTO `dispenser` (`id_seance`, `id_mat`) VALUES
(57, 2),
(58, 2),
(59, 2),
(61, 9),
(62, 9),
(43, 13),
(45, 13),
(53, 16),
(54, 16),
(55, 24),
(56, 24);

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

CREATE TABLE IF NOT EXISTS `intervenant` (
  `id_inter` int(11) NOT NULL AUTO_INCREMENT,
  `nom_inter` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `commentaire` text NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_inter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `intervenant`
--

INSERT INTO `intervenant` (`id_inter`, `nom_inter`, `prenom`, `commentaire`, `email`) VALUES
(1, 'Balmont', 'Roseline', '', 'Roseline.Balmont@univ-st-etienne.fr'),
(2, 'Bonnefoy', 'Laurent', '', 'laurent.bonnefoy@univ-st-etienne.fr'),
(3, 'Bourlion', 'Maurice', '', 'maurice.bourlion@univ-st-etienne.fr'),
(4, 'Decerles', 'Patricia', '', 'Patricia.Decerle@univ-st-etienne.fr'),
(5, 'Fraisse', 'Pierre-Yves', '', 'py.fraisse@proxymacs.com'),
(6, 'Géry', 'Mathias', '', 'Mathias.Gery@univ-st-etienne.fr'),
(7, 'Giroud', 'Celine', '', 'celine.giroud@univ-st-etienne.fr'),
(8, 'Hachin', 'René', '', 'rene.hachin@nordnet.fr'),
(9, 'Jeudy', 'Baptiste', 'Je ne suis pas disponible le jeudi ', 'baptiste.jeudy@univ-st-etienne.fr'),
(10, 'Khodri', 'Farida', '', 'farida.khodri@univ-st-etienne.fr'),
(11, 'Laffite', 'Pascal', '', 'pl@seeu.fr'),
(12, 'Moulin', 'Lily', '', 'lilymoulin@voila.fr'),
(13, 'Muhlenbach', 'Fabrice', '', 'fabrice.muhlenbach@univ-st-etienne.fr'),
(14, 'Place', 'Jean Philipe', '', 'quatuorh@wanadoo.fr'),
(15, 'Propice', 'Vincent', '', 'vpropice@doing.fr'),
(16, 'Rabagny', 'Agnès', '', 'agnes.lagao@sfr.fr'),
(17, 'Skarniak', 'Christian', '', 'cskarniak@gmail.com'),
(18, 'Suc', 'Anthony', '', 'anthonysuc.avocat@yahoo.fr'),
(19, 'Yukna', 'Chris', '', 'yuknachris@yahoo.com'),
(20, 'Thomas', 'Carole', '', ''),
(21, 'Valla', 'Jean François', '', ''),
(22, 'Deleau', 'Patrick', '', ''),
(23, 'Soleil', 'Christian', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `intervenir`
--

CREATE TABLE IF NOT EXISTS `intervenir` (
  `id_mat` int(11) NOT NULL,
  `id_inter` int(11) NOT NULL,
  `annee` varchar(10) NOT NULL,
  PRIMARY KEY (`id_mat`,`id_inter`,`annee`),
  KEY `id_inter` (`id_inter`),
  KEY `annee` (`annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `intervenir`
--

INSERT INTO `intervenir` (`id_mat`, `id_inter`, `annee`) VALUES
(3, 1, '2015-2016'),
(12, 2, '2015-2016'),
(11, 3, '2015-2016'),
(24, 3, '2015-2016'),
(5, 5, '2015-2016'),
(16, 6, '2015-2016'),
(17, 6, '2015-2016'),
(1, 8, '2015-2016'),
(2, 8, '2015-2016'),
(24, 8, '2015-2016'),
(16, 9, '2015-2016'),
(13, 11, '2015-2016'),
(14, 11, '2015-2016'),
(14, 12, '2015-2016'),
(15, 13, '2015-2016'),
(17, 13, '2015-2016'),
(10, 15, '2015-2016'),
(7, 16, '2015-2016'),
(9, 17, '2015-2016'),
(7, 18, '2015-2016'),
(3, 19, '2015-2016'),
(6, 19, '2015-2016'),
(8, 21, '2015-2016'),
(4, 22, '2015-2016'),
(6, 23, '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

CREATE TABLE IF NOT EXISTS `jour` (
  `id_jour` int(11) NOT NULL AUTO_INCREMENT,
  `date_j` date NOT NULL,
  `id_sem` int(11) NOT NULL,
  PRIMARY KEY (`id_jour`),
  KEY `id_sem` (`id_sem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `jour`
--

INSERT INTO `jour` (`id_jour`, `date_j`, `id_sem`) VALUES
(1, '0000-00-00', 22),
(2, '0000-00-00', 22),
(3, '2015-09-05', 22),
(4, '2015-09-02', 22),
(5, '2015-09-19', 24),
(6, '2015-09-03', 22),
(7, '2015-09-06', 22),
(8, '2015-10-06', 25),
(9, '2015-10-13', 26),
(10, '2015-10-20', 27),
(11, '2015-09-13', 23),
(12, '2015-10-07', 25),
(13, '2015-09-17', 24),
(14, '2015-09-20', 24),
(15, '2015-10-14', 26),
(16, '2015-09-12', 23),
(17, '2015-10-12', 26),
(18, '2015-10-19', 27),
(19, '2015-10-26', 28),
(20, '2015-11-02', 29),
(23, '2015-09-11', 23),
(24, '2015-09-04', 22),
(30, '2015-10-11', 26),
(36, '2015-09-18', 24),
(37, '2015-10-05', 25);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_mat` varchar(50) NOT NULL,
  `abreg_mat` varchar(10) NOT NULL,
  `nb_heure` float NOT NULL,
  `nbh_seance` float NOT NULL,
  `id_ue` int(11) NOT NULL,
  PRIMARY KEY (`id_mat`),
  KEY `id_ue` (`id_ue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id_mat`, `nom_mat`, `abreg_mat`, `nb_heure`, `nbh_seance`, `id_ue`) VALUES
(1, 'Animation de projet', 'ANIM', 14, 3.5, 1),
(2, 'Communication et animation d''équipe', 'COMM', 38.5, 3.5, 1),
(3, 'Anglais', 'ANG', 21, 1.75, 1),
(4, 'Organisation et Fonctionnement de l''Entreprie', 'OFE', 21, 3.5, 1),
(5, 'Outils de TIC', 'OTIC', 21, 3.5, 2),
(6, 'Webmarketing et commerce électronic', 'WebMK', 28, 3.5, 2),
(7, 'Droit de l''informatique et de l''internet', 'DROIT 1', 21, 3.5, 2),
(8, 'Gestion de projet', 'PROJ', 24.5, 3.5, 3),
(9, 'Conception et Modélisation des Systèmes d''Informat', 'CMSI', 24.5, 3.5, 3),
(10, 'Méthodologie de conception de sites Web', 'MCSW', 14, 3.5, 3),
(11, 'Intelligence Economique', 'IE', 14, 3.5, 3),
(12, 'Mise en oeuvre d''une Base de Données', 'BD', 21, 3.5, 4),
(13, 'Réalisation de sites Web', 'RW', 42, 3.5, 4),
(14, 'Arts Graphiques et Infogaphie', 'INFOG', 42, 3.5, 4),
(15, 'Langages du Web', 'XML', 21, 3.5, 4),
(16, 'Algorithmique et Programmation', 'ALGO', 17.5, 3.5, 5),
(17, 'Développement de sites Web dynamiques', 'WebDyn', 38.5, 3.5, 5),
(18, 'Projet tutoré', 'PT', 110, 0, 6),
(19, 'Projet en Entreprise', 'STAGE', 0, 0, 7),
(21, 'Initiation Dreamweaver - HTML', 'HTML', 14, 3.5, 6),
(22, 'Algorithmique de base', 'ALGOBASE', 7, 3.5, 6),
(23, 'Mise à niveau droit', 'MANDROIT', 7, 1.75, 6),
(24, 'Expression orale', 'EXPR', 7, 3.5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `id_per` int(11) NOT NULL AUTO_INCREMENT,
  `date_d` date NOT NULL,
  `date_f` date NOT NULL,
  `annee` varchar(10) NOT NULL,
  PRIMARY KEY (`id_per`),
  KEY `annee` (`annee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`id_per`, `date_d`, `date_f`, `annee`) VALUES
(10, '2015-09-02', '2015-09-21', '2015-2016'),
(11, '2015-10-03', '2015-11-03', '2015-2016'),
(15, '2016-04-04', '2016-04-15', '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE IF NOT EXISTS `seance` (
  `id_seance` int(11) NOT NULL AUTO_INCREMENT,
  `journee` enum('lundi','mardi','mercredi','jeudi','vendredi') NOT NULL,
  `moment` enum('matin','a-midi','','') NOT NULL,
  `duree` float NOT NULL,
  `id_jour` int(11) NOT NULL,
  PRIMARY KEY (`id_seance`),
  KEY `id_jour` (`id_jour`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Contenu de la table `seance`
--

INSERT INTO `seance` (`id_seance`, `journee`, `moment`, `duree`, `id_jour`) VALUES
(43, 'mercredi', 'a-midi', 3.5, 19),
(45, 'mercredi', 'a-midi', 3.5, 18),
(53, 'lundi', 'a-midi', 3.5, 4),
(54, 'jeudi', 'a-midi', 3.5, 3),
(55, 'vendredi', 'matin', 3.5, 7),
(56, 'vendredi', 'a-midi', 3.5, 7),
(57, 'vendredi', 'matin', 3.5, 12),
(58, 'vendredi', 'a-midi', 3.5, 12),
(59, 'vendredi', 'matin', 3.5, 15),
(61, 'mercredi', 'a-midi', 3.5, 36),
(62, 'mercredi', 'matin', 3.5, 37);

-- --------------------------------------------------------

--
-- Structure de la table `semaine`
--

CREATE TABLE IF NOT EXISTS `semaine` (
  `id_sem` int(11) NOT NULL AUTO_INCREMENT,
  `date_d` date NOT NULL,
  `id_per` int(11) NOT NULL,
  PRIMARY KEY (`id_sem`),
  KEY `id_per` (`id_per`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `semaine`
--

INSERT INTO `semaine` (`id_sem`, `date_d`, `id_per`) VALUES
(22, '2015-09-02', 10),
(23, '2015-09-09', 10),
(24, '2015-09-16', 10),
(25, '2015-10-03', 11),
(26, '2015-10-10', 11),
(27, '2015-10-17', 11),
(28, '2015-10-24', 11),
(29, '2015-10-31', 11),
(42, '2016-04-04', 15),
(43, '2016-04-11', 15);

-- --------------------------------------------------------

--
-- Structure de la table `unite_enseignement`
--

CREATE TABLE IF NOT EXISTS `unite_enseignement` (
  `id_ue` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ue` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `unite_enseignement`
--

INSERT INTO `unite_enseignement` (`id_ue`, `nom_ue`) VALUES
(1, 'Formation général'),
(2, 'Réseaux d''entreprise et Internet'),
(3, 'Méthodologie de gestion de projet'),
(4, 'Techniques informaques'),
(5, 'Programmation et Réseaux'),
(6, 'Parcours Prsonnalisé'),
(7, 'Projet en Entreprise');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contrainte`
--
ALTER TABLE `contrainte`
  ADD CONSTRAINT `contrainte_ibfk_1` FOREIGN KEY (`id_inter`) REFERENCES `intervenant` (`id_inter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contrainte_particuliere`
--
ALTER TABLE `contrainte_particuliere`
  ADD CONSTRAINT `contrainte_particuliere_ibfk_1` FOREIGN KEY (`id_inter`) REFERENCES `intervenant` (`id_inter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `diriger`
--
ALTER TABLE `diriger`
  ADD CONSTRAINT `diriger_ibfk_1` FOREIGN KEY (`id_seance`) REFERENCES `seance` (`id_seance`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diriger_ibfk_2` FOREIGN KEY (`id_inter`) REFERENCES `intervenant` (`id_inter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dispenser`
--
ALTER TABLE `dispenser`
  ADD CONSTRAINT `dispenser_ibfk_1` FOREIGN KEY (`id_seance`) REFERENCES `seance` (`id_seance`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispenser_ibfk_2` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id_mat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `intervenir`
--
ALTER TABLE `intervenir`
  ADD CONSTRAINT `intervenir_ibfk_3` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `intervenir_ibfk_1` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id_mat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `intervenir_ibfk_2` FOREIGN KEY (`id_inter`) REFERENCES `intervenant` (`id_inter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `jour`
--
ALTER TABLE `jour`
  ADD CONSTRAINT `jour_ibfk_1` FOREIGN KEY (`id_sem`) REFERENCES `semaine` (`id_sem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_ue`) REFERENCES `unite_enseignement` (`id_ue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `periode`
--
ALTER TABLE `periode`
  ADD CONSTRAINT `periode_ibfk_1` FOREIGN KEY (`annee`) REFERENCES `annee` (`annee`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`id_jour`) REFERENCES `jour` (`id_jour`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `semaine`
--
ALTER TABLE `semaine`
  ADD CONSTRAINT `semaine_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `periode` (`id_per`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
