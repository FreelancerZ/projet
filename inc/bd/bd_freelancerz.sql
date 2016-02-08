-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Février 2016 à 19:23
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bd_freelancerz`
--

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE IF NOT EXISTS `contrat` (
  `contrat_id` int(11) NOT NULL AUTO_INCREMENT,
  `contrat_auteur` int(11) DEFAULT NULL,
  `contrat_titre` varchar(150) NOT NULL,
  `contrat_theme` varchar(20) NOT NULL,
  `contrat_etat` int(11) NOT NULL,
  `contrat_description` text NOT NULL,
  `contrat_montant` double NOT NULL,
  `contrat_competences` varchar(60) NOT NULL,
  `contrat_publication` date NOT NULL,
  `contrat_debut_prevue` date NOT NULL,
  `contrat_debut_reel` date DEFAULT NULL,
  `contrat_fin_prevue` date DEFAULT NULL,
  `contrat_fin_reelle` date DEFAULT NULL,
  PRIMARY KEY (`contrat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`contrat_id`, `contrat_auteur`, `contrat_titre`, `contrat_theme`, `contrat_etat`, `contrat_description`, `contrat_montant`, `contrat_competences`, `contrat_publication`, `contrat_debut_prevue`, `contrat_debut_reel`, `contrat_fin_prevue`, `contrat_fin_reelle`) VALUES
(1, 8, 'Recherche Programmeur Java', 'Aplication mobile', 1, 'Je recherche un programmeur afin d''adapter mon application java windows, pour smartphone et tablettes <strong>android</strong>.', 190, 'Java, Android', '2015-12-12', '2015-12-20', '2015-12-12', '2016-02-20', NULL),
(2, 9, 'Design jeu 2d', 'python graphique', 0, 'Je cherche une peronne capable de me faire une interface graphique en python pour mon petit jeu de morpion.\r\n\r\nMerci !', 30, 'Python', '2015-12-12', '2016-01-05', NULL, '2016-01-29', NULL),
(3, 1, 'Creation Site web', 'web', 0, 'Recherche une personne\r\n<ul>\r\n    <li>Motivée</li>\r\n    <li>Dynamique</li>\r\n</ul>\r\n\r\nPour éffectuer le site web de mon jeu Mobile.\r\n\r\nMe contacter pour plus d''informations au 06 05 46 50 48', 599, 'JS, CSS3, HTML5, jQuery, Responsive Design', '2015-12-12', '2016-02-01', NULL, '2016-05-01', NULL),
(4, 1, 'Jeu pour IOS', 'programmation mobile', 1, 'Cherche quelqun capable de passer mon application android en version IOS.\r\n', 699, 'Android, IOS, Java, Swift', '2015-12-12', '0000-00-00', '2016-02-08', '2016-03-20', NULL),
(5, 2, 'Charte graphique', 'Design', 0, 'Cherche une personne pour collaborer dans mon développement d''application mobile.\r\nLe travail porterait sur :\r\n<ol>\r\n    <li>Le design</li>\r\n    <li>Les couleurs</li>\r\n    <li>Le graphisme</li>\r\n</ol>', 299, 'Design, Java, Android', '2015-12-12', '2016-01-05', NULL, '2016-06-05', NULL),
(6, 3, 'Site web MVC', 'web, mvc', 0, 'Bonjour à tous !\r\n\r\nje recherche une personne qui voudrais bien effectuer le ménage dans mon site web, pour un bon prix.\r\n\r\nEn effet je souhaiterais le passer en MVC.\r\n\r\nProposez vous pour plus d''informations, ou contactez moi', 999, 'Web, HTML, php, sql, mvc', '2015-12-12', '2015-12-20', NULL, '2016-03-20', NULL),
(7, 4, 'Programme Vélo Training', 'Santé et forme', 0, 'Bonjour a tous ! l''heure est grave !\r\nJ''ai absolument besoin de quelqun pour m''aider a programmer mon application sur un theme de Training Santé Vélo tout''c''qui faut !', 79, 'Visual basic', '2015-12-05', '2016-01-15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `historique_contrat`
--

CREATE TABLE IF NOT EXISTS `historique_contrat` (
  `histo_contrat` int(11) NOT NULL AUTO_INCREMENT,
  `histo_titre` varchar(150) DEFAULT NULL,
  `histo_desc` text,
  `histo_demandeur` int(11) DEFAULT NULL,
  `histo_prestataire` int(11) DEFAULT NULL,
  `histo_date_deb` date DEFAULT NULL,
  `histo_date_fin` date DEFAULT NULL,
  `histo_theme` varchar(20) DEFAULT NULL,
  `histo_montant` double DEFAULT NULL,
  `histo_competences` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`histo_contrat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_user1` int(11) NOT NULL,
  `message_user2` int(11) NOT NULL,
  `message_contrat` int(11) NOT NULL,
  `message_contenu` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`message_id`, `message_user1`, `message_user2`, `message_contrat`, `message_contenu`, `message_date`) VALUES
(8, 8, 2, 1, 'Bonjour', '2016-01-30 13:45:53'),
(10, 2, 8, 1, 'Yo', '2016-01-30 13:51:14'),
(11, 2, 8, 1, 'blah', '2016-01-30 13:51:44'),
(16, 8, 2, 1, 'Bonjour', '2016-02-02 09:51:46'),
(17, 2, 8, 1, 'Blahblha', '2016-02-02 09:51:58'),
(18, 1, 0, 4, 'va faire du vélo wesh !', '2016-02-08 18:08:06');

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE IF NOT EXISTS `proposition` (
  `prop_id` int(11) NOT NULL AUTO_INCREMENT,
  `prop_user` int(11) DEFAULT NULL,
  `prop_contrat` int(11) DEFAULT NULL,
  `prop_etat` int(11) NOT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`prop_id`, `prop_user`, `prop_contrat`, `prop_etat`) VALUES
(2, 2, 1, 1),
(3, 8, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_pseudo` varchar(50) NOT NULL,
  `user_ville` varchar(50) NOT NULL,
  `user_adresse` varchar(50) NOT NULL,
  `user_cp` char(5) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(120) NOT NULL,
  `user_naissance` date DEFAULT NULL,
  `user_inscription` date DEFAULT NULL,
  `user_competences` varchar(255) NOT NULL,
  `user_site1` varchar(120) DEFAULT NULL,
  `user_site2` varchar(120) DEFAULT NULL,
  `user_site3` varchar(120) DEFAULT NULL,
  `user_site4` varchar(120) DEFAULT NULL,
  `user_site5` varchar(120) DEFAULT NULL,
  `user_etat` int(11) DEFAULT NULL,
  `user_cle` varchar(255) DEFAULT NULL,
  `user_admin` int(1) NOT NULL DEFAULT '0',
  `user_banni` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_pseudo` (`user_pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_pseudo`, `user_ville`, `user_adresse`, `user_cp`, `user_password`, `user_email`, `user_naissance`, `user_inscription`, `user_competences`, `user_site1`, `user_site2`, `user_site3`, `user_site4`, `user_site5`, `user_etat`, `user_cle`, `user_admin`, `user_banni`) VALUES
(1, 'Clément', 'Hugo', 'Sydher', 'Cahors', 'Le Bournaguet', '46090', 'a906449d5769fa7361d7ecc6aa3f6d28', 'hugo.clement@iut-rodez.fr', '1996-10-14', '2015-12-02', 'HTML, CSS, PHP, SQL, Java, C', 'https://www.facebook.com/hugo.clement.5', 'http://www.google.fr', '', '', NULL, 1, NULL, 1, 0),
(2, 'Bernard', 'Guillaume', 'Crwup', 'Firmi', 'Capendu', '12300', '8dbdda48fb8748d6746f1965824e966a', 'guillaume.bernard@iut-rodez.fr', '1996-04-24', '2015-12-02', 'Rien', 'http://www.google.fr', NULL, NULL, NULL, NULL, 1, NULL, 1, 0),
(3, 'Boulle', 'David', 'TheBlackPulse', 'Rodez', '19 Rue Maréchal Leclerc', '12000', '8dbdda48fb8748d6746f1965824e966a', 'david.boulle@iut-rodez.fr', '1997-01-03', '2015-12-02', 'Dubstep, CMAO, Photoshop', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1),
(4, 'Belmon', 'Maxime', 'Cereale', 'Rodez', '13 rue de la vielle gare', '12000', '64c02fd8a5b6c3d9e30b1a1e8e5032d5', 'maxime.belmon@iut-rodez.fr', '1995-10-12', '2015-12-02', 'Managment, Scrum Mananging, Immiter le pigeon', 'http://www.francis.fr', 'http://fr.francis.com', 'http://www.francis.org', 'http://www.francis.net', 'http://www.francis.com', 1, NULL, 1, 0),
(8, 'Fraysse', 'Marcel', 'Fraysse12', 'Privée', 'Privée', '12000', '8dbdda48fb8748d6746f1965824e966a', 'fraysse.marcel@yopmail.com', NULL, NULL, 'PHP, HTML, SQL, C++', 'http://fraysse.marcel.com', '', '', '', NULL, 1, 'e2a5a9e344d27550d3961c4d295d52ad', 0, 0),
(9, 'Marcenac', 'Sylvie', 'Sylvac-55', 'Naucelle', '', '', '719430328e11f79a55f4c95b2faccfec', 'sylvie.marcenac@yopmail.com', NULL, NULL, 'C# plsql et python', 'http://facebook.com/sylviemarcenac', '', '', '', NULL, 1, '93df6b8c2dbe1709574e3d59fd4b05fb', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_privee`
--

CREATE TABLE IF NOT EXISTS `users_privee` (
  `privee_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_pseudo` varchar(50) NOT NULL,
  `user_ville` varchar(50) NOT NULL,
  `user_adresse` varchar(50) NOT NULL,
  `user_cp` char(5) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(120) NOT NULL,
  `user_naissance` date DEFAULT NULL,
  `user_inscription` date DEFAULT NULL,
  `user_competences` varchar(255) NOT NULL,
  `user_site1` varchar(120) DEFAULT NULL,
  `user_site2` varchar(120) DEFAULT NULL,
  `user_site3` varchar(120) DEFAULT NULL,
  `user_site4` varchar(120) DEFAULT NULL,
  `user_site5` varchar(120) DEFAULT NULL,
  `user_etat` int(11) DEFAULT NULL,
  `user_cle` varchar(255) DEFAULT NULL,
  `user_admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`privee_id`),
  UNIQUE KEY `user_pseudo` (`user_pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users_privee`
--

INSERT INTO `users_privee` (`privee_id`, `user_id`, `user_nom`, `user_prenom`, `user_pseudo`, `user_ville`, `user_adresse`, `user_cp`, `user_password`, `user_email`, `user_naissance`, `user_inscription`, `user_competences`, `user_site1`, `user_site2`, `user_site3`, `user_site4`, `user_site5`, `user_etat`, `user_cle`, `user_admin`) VALUES
(1, 1, 'Clément', 'Hugo', 'Sydher', 'Cahors', 'Le Bournaguet', '46090', 'a906449d5769fa7361d7ecc6aa3f6d28', 'hugo.clement@iut-rodez.fr', '1996-10-14', '2015-12-02', 'HTML, CSS, PHP, SQL, Java, C', 'https://www.facebook.com/hugo.clement.5', 'http://www.google.fr', '', '', NULL, 1, NULL, 1),
(2, 2, 'Bernard', 'Guillaume', 'Crwup', 'Firmi', 'Capendu', '12300', '8dbdda48fb8748d6746f1965824e966a', 'guillaume.bernard@iut-rodez.fr', '1996-04-24', '2015-12-02', 'Rien', 'http://www.google.fr', NULL, NULL, NULL, NULL, 1, NULL, 1),
(3, 3, 'Boulle', 'David', 'TheBlackPulse', 'Rodez', '19 Rue Maréchal Leclerc', '12000', 'b1f4f9a523e36fd969f4573e25af4540', 'david.boulle@iut-rodez.fr', '1997-01-03', '2015-12-02', 'Dubstep, CMAO, Photoshop', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1),
(4, 4, 'Belmon', 'Maxime', 'Cereale', 'Rodez', '13 rue de la vielle gare', '12000', '64c02fd8a5b6c3d9e30b1a1e8e5032d5', 'maxime.belmon@iut-rodez.fr', '1995-10-12', '2015-12-02', 'Managment, Scrum Mananging, Immiter le pigeon', 'http://www.francis.fr', 'http://fr.francis.com', 'http://www.francis.org', 'http://www.francis.net', 'http://www.francis.com', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_recherche_periode`
--
CREATE TABLE IF NOT EXISTS `v_recherche_periode` (
`contrat_id` int(11)
,`user_nom` varchar(50)
,`user_prenom` varchar(50)
,`contrat_titre` varchar(150)
,`contrat_theme` varchar(20)
,`contrat_montant` double
,`contrat_competences` varchar(60)
,`contrat_description` text
,`contrat_debut_prevue` date
,`contrat_fin_prevue` date
);
-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_recherche_texte`
--
CREATE TABLE IF NOT EXISTS `v_recherche_texte` (
`contrat_id` int(11)
,`user_nom` varchar(50)
,`user_prenom` varchar(50)
,`contrat_titre` varchar(150)
,`contrat_theme` varchar(20)
,`contrat_montant` double
,`contrat_competences` varchar(60)
,`contrat_description` text
);
-- --------------------------------------------------------

--
-- Structure de la vue `v_recherche_periode`
--
DROP TABLE IF EXISTS `v_recherche_periode`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_recherche_periode` AS select `contrat`.`contrat_id` AS `contrat_id`,`users`.`user_nom` AS `user_nom`,`users`.`user_prenom` AS `user_prenom`,`contrat`.`contrat_titre` AS `contrat_titre`,`contrat`.`contrat_theme` AS `contrat_theme`,`contrat`.`contrat_montant` AS `contrat_montant`,`contrat`.`contrat_competences` AS `contrat_competences`,`contrat`.`contrat_description` AS `contrat_description`,`contrat`.`contrat_debut_prevue` AS `contrat_debut_prevue`,`contrat`.`contrat_fin_prevue` AS `contrat_fin_prevue` from (`contrat` left join `users` on((`users`.`user_id` = `contrat`.`contrat_auteur`))) where (`contrat`.`contrat_etat` = 0);

-- --------------------------------------------------------

--
-- Structure de la vue `v_recherche_texte`
--
DROP TABLE IF EXISTS `v_recherche_texte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_recherche_texte` AS select `contrat`.`contrat_id` AS `contrat_id`,`users`.`user_nom` AS `user_nom`,`users`.`user_prenom` AS `user_prenom`,`contrat`.`contrat_titre` AS `contrat_titre`,`contrat`.`contrat_theme` AS `contrat_theme`,`contrat`.`contrat_montant` AS `contrat_montant`,`contrat`.`contrat_competences` AS `contrat_competences`,`contrat`.`contrat_description` AS `contrat_description` from (`contrat` left join `users` on((`users`.`user_id` = `contrat`.`contrat_auteur`))) where (`contrat`.`contrat_etat` = 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
