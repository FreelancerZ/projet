-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 23 Mars 2016 à 17:39
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`contrat_id`, `contrat_auteur`, `contrat_titre`, `contrat_theme`, `contrat_etat`, `contrat_description`, `contrat_montant`, `contrat_competences`, `contrat_publication`, `contrat_debut_prevue`, `contrat_debut_reel`, `contrat_fin_prevue`, `contrat_fin_reelle`) VALUES
(1, 1, 'Rendre responsive FreelancerZ', 'Web', 1, 'Je cherche quelqu''un pour rendre responsive ce site web.', 100, 'HTML, CSS, PHP', '2016-03-16', '2016-03-16', '2016-03-16', '2016-03-20', NULL),
(2, 2, 'Test', 'Web', 0, 'ceci est un contrat de test', 125, 'PHP', '2016-03-23', '2016-03-23', NULL, '2016-04-23', NULL),
(3, 2, 'Dév', 'Android', 0, 'sdfghjklmùmlkhfdsqsdfghjk:l', 150, 'Android', '2016-03-23', '2016-03-23', NULL, '2016-04-23', NULL);

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
-- Structure de la table `histo_messagerie`
--

CREATE TABLE IF NOT EXISTS `histo_messagerie` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_user1` int(11) NOT NULL,
  `message_user2` int(11) NOT NULL,
  `message_contrat` int(11) NOT NULL,
  `message_contenu` text CHARACTER SET latin1 NOT NULL,
  `message_date` timestamp NOT NULL,
  PRIMARY KEY (`message_id`)
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
  `message_contenu` text CHARACTER SET latin1 NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`prop_id`, `prop_user`, `prop_contrat`, `prop_etat`) VALUES
(1, 2, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_pseudo`, `user_ville`, `user_adresse`, `user_cp`, `user_password`, `user_email`, `user_naissance`, `user_inscription`, `user_competences`, `user_site1`, `user_site2`, `user_site3`, `user_site4`, `user_site5`, `user_etat`, `user_cle`, `user_admin`, `user_banni`) VALUES
(1, 'Clément', 'Hugo', 'Sydher', 'Trespoux-Rassiels', 'Privée', '46090', '8dbdda48fb8748d6746f1965824e966a', 'hugo.clement@iut-rodez.fr', NULL, NULL, 'Java, PHP, HTML', 'https://www.facebook.com/hugo.clement.5', '', '', '', NULL, 1, '9e627c30ccf3cdc481fc8d496244badc', 1, 0),
(2, 'Guillaume', 'Bernard', 'crwup', '', '', '', '8dbdda48fb8748d6746f1965824e966a', 'guillaume.bernard@iut-rodez.fr', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1, 'e83ddaaad0aa2eec708c026dee11e7c4', 1, 0),
(3, 'Fraysse', 'Marcel', 'frayssinet', '', '', '', '8dbdda48fb8748d6746f1965824e966a', 'fraysse.marcel@yopmail.com', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1, '4b3d732c898ec276d91b4082d6138eea', 0, 0),
(4, 'Mathieu', 'Jérome', 'Jerome', '', '', '', '8dbdda48fb8748d6746f1965824e966a', 'j.mathieu@mail.com', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1, 'fb872e8cb032b48c3fc6adaa7345b086', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_privee`
--

CREATE TABLE IF NOT EXISTS `users_privee` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users_privee`
--

INSERT INTO `users_privee` (`user_id`, `user_nom`, `user_prenom`, `user_pseudo`, `user_ville`, `user_adresse`, `user_cp`, `user_password`, `user_email`, `user_naissance`, `user_inscription`, `user_competences`, `user_site1`, `user_site2`, `user_site3`, `user_site4`, `user_site5`, `user_etat`, `user_cle`, `user_admin`, `user_banni`) VALUES
(1, 'Clément', 'Hugo', 'Sydher', 'Trespoux-Rassiels', '45 allées des Claousses', '46090', '8dbdda48fb8748d6746f1965824e966a', 'hugo.clement@iut-rodez.fr', NULL, NULL, 'Java, PHP, HTML', 'https://www.facebook.com/hugo.clement.5', '', '', '', NULL, 0, '9e627c30ccf3cdc481fc8d496244badc', 1, 0),
(2, 'Guillaume', 'Bernard', 'crwup', '', '', '', '8dbdda48fb8748d6746f1965824e966a', 'guillaume.bernard@iut-rodez.fr', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 'e83ddaaad0aa2eec708c026dee11e7c4', 0, 0),
(3, 'Fraysse', 'Marcel', 'frayssinet', '', '', '', '8dbdda48fb8748d6746f1965824e966a', 'fraysse.marcel@yopmail.com', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '4b3d732c898ec276d91b4082d6138eea', 0, 0),
(4, 'Mathieu', 'Jérome', 'Jerome', '', '', '', '8dbdda48fb8748d6746f1965824e966a', 'j.mathieu@mail.com', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 'fb872e8cb032b48c3fc6adaa7345b086', 0, 0);

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
