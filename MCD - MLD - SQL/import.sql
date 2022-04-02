-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 02 avr. 2022 à 12:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fyqghaxr_bd_classe_competences`
--

-- --------------------------------------------------------

--
-- Structure de la table `acquerir`
--

DROP TABLE IF EXISTS `acquerir`;
CREATE TABLE IF NOT EXISTS `acquerir` (
  `IDENTIFIANT_ETUD` int(11) NOT NULL,
  `N_ITEM_COMPETENCE` varchar(255) NOT NULL,
  `MISE_EN_OEUVRE` tinyint(1) DEFAULT 0,
  `ACQUISE` tinyint(1) DEFAULT 0,
  `EN_COURS_ACQUISITION` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`IDENTIFIANT_ETUD`,`N_ITEM_COMPETENCE`),
  UNIQUE KEY `IDENTIFIANT_ETUD_2` (`IDENTIFIANT_ETUD`,`N_ITEM_COMPETENCE`),
  KEY `IDENTIFIANT_ETUD` (`IDENTIFIANT_ETUD`),
  KEY `N_ITEM_COMPETENCE` (`N_ITEM_COMPETENCE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `blocs`
--

DROP TABLE IF EXISTS `blocs`;
CREATE TABLE IF NOT EXISTS `blocs` (
  `ID_NOM_BLOC` varchar(255) NOT NULL,
  `LIBEL_BLOC` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_NOM_BLOC`),
  UNIQUE KEY `ID_NOM_BLOC` (`ID_NOM_BLOC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `blocs`
--

INSERT INTO `blocs` (`ID_NOM_BLOC`, `LIBEL_BLOC`) VALUES
('Bloc 1', 'Support et mise à disposition des services informatiques'),
('Bloc 2 SLAM', 'Conception et développement d’applications'),
('Bloc 3 SISR', 'Administration des systèmes et des réseaux');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `N_ITEM_COMPETENCE` varchar(255) NOT NULL,
  `N_ITEM_INDICATEUR` varchar(32) NOT NULL,
  `N_ITEM_SAVOIR` varchar(32) NOT NULL,
  PRIMARY KEY (`N_ITEM_COMPETENCE`,`N_ITEM_INDICATEUR`,`N_ITEM_SAVOIR`),
  UNIQUE KEY `N_ITEM_COMPETENCE_2` (`N_ITEM_COMPETENCE`,`N_ITEM_INDICATEUR`,`N_ITEM_SAVOIR`),
  KEY `N_ITEM_COMPETENCE` (`N_ITEM_COMPETENCE`),
  KEY `N_ITEM_INDICATEUR` (`N_ITEM_INDICATEUR`),
  KEY `N_ITEM_SAVOIR` (`N_ITEM_SAVOIR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ensemble_de_competence`
--

DROP TABLE IF EXISTS `ensemble_de_competence`;
CREATE TABLE IF NOT EXISTS `ensemble_de_competence` (
  `ID_ENSEMBLE_COMPETENCE` varchar(255) NOT NULL,
  `LIBEL_ENSEMBLE_COMPETENCE` varchar(255) DEFAULT NULL,
  `ID_NOM_BLOC` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_ENSEMBLE_COMPETENCE`),
  UNIQUE KEY `ID_ENSEMBLE_COMPETENCE` (`ID_ENSEMBLE_COMPETENCE`),
  KEY `ID_NOM_BLOC` (`ID_NOM_BLOC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ensemble_de_competence`
--

INSERT INTO `ensemble_de_competence` (`ID_ENSEMBLE_COMPETENCE`, `LIBEL_ENSEMBLE_COMPETENCE`, `ID_NOM_BLOC`) VALUES
('B1.1', 'Gérer le patrimoine informatique', 'Bloc 1'),
('B1.2', 'Répondre aux incidents et aux demandes d’assistance et d’évolution', 'Bloc 1'),
('B1.3', 'Développer la présence en ligne de l’organisation', 'Bloc 1'),
('B1.4', 'Travailler en mode projet', 'Bloc 1'),
('B1.5', 'Mettre à disposition des utilisateurs un service informatique (orienté utilisateurs)', 'Bloc 1'),
('B1.6', 'Organiser son développement professionnel', 'Bloc 1'),
('B2.1.SLAM', 'Concevoir et développer une solution applicative', 'Bloc 2 SLAM'),
('B2.2.SLAM', 'Assurer la maintenance corrective ou évolutive d’une solution applicative', 'Bloc 2 SLAM'),
('B2.3.SLAM', 'Gérer les données', 'Bloc 2 SLAM'),
('B3.1.SISR-INFRA', 'Concevoir une solution d\'infrastructure réseau', 'Bloc 3 SISR'),
('B3.2.SISR-INFRA', 'Installer, tester et déployer une solution d\'infrastructure réseau', 'Bloc 3 SISR'),
('B3.3.SISR-INFRA', 'Exploiter, dépanner et superviser une solution d\'infrastructure réseau', 'Bloc 3 SISR');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `IDENTIFIANT_ETUD` int NOT NULL AUTO_INCREMENT,
  `NOM_ETUD` varchar(32) DEFAULT NULL,
  `PRENOM_ETUD` varchar(32) DEFAULT NULL,
  `OPTION_BTS_ETUD` varchar(255) DEFAULT NULL,
  `DATE_NAISSANCE_ETUD` datetime DEFAULT NULL,
  `MAIL_ETUD` varchar(255) DEFAULT NULL,
  `MOT_DE_PASSE_ETUD` varchar(255) DEFAULT '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm',
  `PREMIERE_CONNEXION_ETUD` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`IDENTIFIANT_ETUD`),
  UNIQUE KEY `IDENTIFIANT_ETUD` (`IDENTIFIANT_ETUD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`IDENTIFIANT_ETUD`, `NOM_ETUD`, `PRENOM_ETUD`, `OPTION_BTS_ETUD`, `DATE_NAISSANCE_ETUD`, `MAIL_ETUD`, `MOT_DE_PASSE_ETUD`, `PREMIERE_CONNEXION_ETUD`) VALUES
(1, 'Sordetti', 'Luca', 'SLAM', '2002-08-03 00:00:00', 'luca-sordetti@outlook.com', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(2, 'Naourbiev', 'Denis', 'SISR', '2002-03-16 00:00:00', 'denis.naourbiev@outlook.com', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(3, 'HUBE', 'Wallace', 'SISR', '2001-02-13 00:00:00', 'wallace.hube@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(4, 'BARBIER', 'Bradley', 'SLAM', '2002-06-05 00:00:00', 'bradley.barbier@outlook.fr', '$2y$12$otmtQJfGSjvM/rlwmymd7OOmYN3ofZDdB263mOr7lSX0VKFwJBwDm', 0),
(5, 'CLEMENT DELS', 'Teddy', 'SLAM', '2002-11-26 00:00:00', 'teddy.clement_dels@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(6, 'COLLOT', 'Enzo', 'SISR', '2002-03-17 00:00:00', 'collot.enzo@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(7, 'Courtney', 'Aloïs', 'SISR', '1999-02-23 00:00:00', 'alois.courtney@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(8, 'Licina', 'Almin', 'SLAM', '2002-11-08 00:00:00', 'almin.licina@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(9, 'Zanzi', 'Ugo', 'SLAM', '2002-06-13 00:00:00', 'ugo.zanzi@outlook.com', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(10, 'Halm', 'Pierre', 'SISR', '2002-02-19 00:00:00', 'pierre.halm@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(11, 'Tahri', 'Mehdi', 'SLAM', '1999-02-06 00:00:00', 'mehdi_tahri@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(12, 'Eisenbart', 'Théo', 'SISR', '2002-03-08 00:00:00', 'theo.eisenbart@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(13, 'Joliot', 'Julien', 'SLAM', '2001-10-18 00:00:00', 'julien.joliot@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(14, 'Soihoudaou Allaoui', 'Assam El-Dine', 'SISR', '2000-10-16 00:00:00', 'assam.soihoudaou@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(15, 'JUE', 'Christopher', 'SLAM', '2001-10-13 00:00:00', 'christopher.jue@outlook.com', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(16, 'Silbermann', 'Gregory', 'SISR', '2002-08-12 00:00:00', 'gregory-silbermann@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(17, 'Rozale', 'Habib', 'SISR', '2002-01-21 00:00:00', 'habib.rozale@outlook.com', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(18, 'Ozdemir', 'Senol', 'SLAM', '2002-10-09 00:00:00', 'senol-ozdemir@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(19, 'Roulier', 'Lucie', 'SLAM', '1997-10-02 00:00:00', 'roulier.lucie@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(20, 'Krim', 'Atika', 'SISR', '2000-02-22 00:00:00', 'atika_krim@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(21, 'HADJ KADDOUR', 'Yanis', 'SISR', '2001-09-09 00:00:00', 'yanis.hadjkaddour@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(22, 'PROENÇA ABRANTES', 'Alexandre', 'SLAM', '2002-05-12 00:00:00', 'alexandre.proenca-abrantes@outlook.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1),
(23, 'ZAEGEL', 'Guy', 'SLAM', '2000-01-01 00:00:00', 'guy_zaegel@hotmail.fr', '$2y$12$wGGUsfvqlTbg5PdRjCfeGekv5HDQ1PB0KhrgO7uXaSvyEUYUYopQm', 1);


-- --------------------------------------------------------

--
-- Structure de la table `indicateur`
--

DROP TABLE IF EXISTS `indicateur`;
CREATE TABLE IF NOT EXISTS `indicateur` (
  `N_ITEM_INDICATEUR` varchar(32) NOT NULL,
  `ID_PROJET` int(11) NOT NULL,
  PRIMARY KEY (`N_ITEM_INDICATEUR`,`ID_PROJET`),
  UNIQUE KEY `N_ITEM_INDICATEUR_2` (`N_ITEM_INDICATEUR`,`ID_PROJET`),
  KEY `N_ITEM_INDICATEUR` (`N_ITEM_INDICATEUR`),
  KEY `ID_PROJET` (`ID_PROJET`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `item_competence`
--

DROP TABLE IF EXISTS `item_competence`;
CREATE TABLE IF NOT EXISTS `item_competence` (
  `N_ITEM_COMPETENCE` varchar(255) NOT NULL,
  `LIBEL_ITEM` varchar(255) DEFAULT NULL,
  `ID_ENSEMBLE_COMPETENCE` varchar(255) NOT NULL,
  PRIMARY KEY (`N_ITEM_COMPETENCE`),
  UNIQUE KEY `N_ITEM_COMPETENCE` (`N_ITEM_COMPETENCE`),
  KEY `ID_ENSEMBLE_COMPETENCE` (`ID_ENSEMBLE_COMPETENCE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item_competence`
--

INSERT INTO `item_competence` (`N_ITEM_COMPETENCE`, `LIBEL_ITEM`, `ID_ENSEMBLE_COMPETENCE`) VALUES
('B1.1.1', 'Recenser et identifier les ressources numériques', 'B1.1'),
('B1.1.2', 'Mettre en place et vérifier les niveaux d\'habilitation associés à un service', 'B1.1'),
('B1.1.3', 'Exploiter des référentiels  normes et standards adoptés par le prestataire informatique', 'B1.1'),
('B1.1.4', 'Gérer les sauvegardes', 'B1.1'),
('B1.1.5', 'Vérifier les conditions de la continuité d\'un service informatique', 'B1.1'),
('B1.1.6', 'Vérifier le respect des régles d\'utilisation des ressources numériques', 'B1.1'),
('B1.2.1', 'Traiter des demandes concernant les services réseau et système, applicatifs', 'B1.2'),
('B1.2.2', 'Traiter des demandes concernant les applications', 'B1.2'),
('B1.2.3', 'Collecter - suivre et orienter les demandes', 'B1.2'),
('B1.3.1', 'Participer à l\'évolution d\'un site Web exploitant les données de l\'organisation', 'B1.3'),
('B1.3.2', 'Référencer les services en ligne de l\'organisation et mesurer leur visibilité', 'B1.3'),
('B1.3.3', 'Participer à la valorisation de l\'image de l\'organisation sur les médias numériques en tenant compte du cadre juridique et des enjeux économiques', 'B1.3'),
('B1.4.1', 'Analyser les objectifs et les modalités d\'organisation d\'un projet', 'B1.4'),
('B1.4.2', 'Évaluer les indicateurs de suivi d\'un projet et analyser les écarts', 'B1.4'),
('B1.4.3', 'Planifier les activités', 'B1.4'),
('B1.5.1', 'Déployer un service', 'B1.5'),
('B1.5.2', 'Réaliser les tests d\'intégration et d\'acceptation d\'un service', 'B1.5'),
('B1.5.3', 'Accompagner les utilisateurs dans la mise en place d\'un service', 'B1.5'),
('B1.6.1', 'Gérer son identité professionnelle', 'B1.6'),
('B1.6.2', 'Développer son projet professionnel', 'B1.6'),
('B1.6.3', 'Mettre en place son environnement d\'apprentissage personnel', 'B1.6'),
('B1.6.4', 'Mettre en oeuvre des outils et stratégies de veille informationnelle', 'B1.6'),
('B2.1.SLAM.1', 'Analyser un besoin exprimé et son contexte juridique', 'B2.1.SLAM'),
('B2.1.SLAM.10', 'Intégrer en continu des versions d\'une solution applicative', 'B2.1.SLAM'),
('B2.1.SLAM.11', 'Evaluer la qualité d\'une solution applicative', 'B2.1.SLAM'),
('B2.1.SLAM.12', 'Utiliser des composants d\'accès aux données', 'B2.1.SLAM'),
('B2.1.SLAM.2', 'Modéliser une solution applicative', 'B2.1.SLAM'),
('B2.1.SLAM.3', 'Participer à la conception de l\'architecture d\'une solution applicative', 'B2.1.SLAM'),
('B2.1.SLAM.4', 'Exploiter les technologies Web et mobile pour mettre en oeuvre les échanges entre applications, y compris de mobilité', 'B2.1.SLAM'),
('B2.1.SLAM.5', 'Identifier, développer, utiliser ou adapter des composants logiciels', 'B2.1.SLAM'),
('B2.1.SLAM.6', 'Exploiter les ressources du cadre applicatif (framework)', 'B2.1.SLAM'),
('B2.1.SLAM.7', 'Exploiter les fonctionnalités d\'un environnement de développement et de tests', 'B2.1.SLAM'),
('B2.1.SLAM.8', 'Rédiger des documentations techniques et d’utilisation d\'une solution applicative', 'B2.1.SLAM'),
('B2.1.SLAM.9', 'Réaliser des tests nécessaires à la validation ou à la mise en production d\'éléments adaptés ou développés', 'B2.1.SLAM'),
('B2.2.SLAM.1', 'Recueillir, analyser et mettre à jour les informations sur une version d\'une solution applicative', 'B2.2.SLAM'),
('B2.2.SLAM.2', 'Analyser et corriger un dysfonctionnement', 'B2.2.SLAM'),
('B2.2.SLAM.3', 'Elaborer et réaliser des tests des éléments mis à jour', 'B2.2.SLAM'),
('B2.2.SLAM.4', 'Mettre à jour la documentation technique et d’utilisation d\'une solution applicative', 'B2.2.SLAM'),
('B2.2.SLAM.5', 'Évaluer la qualité d\'une solution applicative', 'B2.2.SLAM'),
('B2.3.SLAM.1', 'Exploiter des données à l\'aide d\'un langage de requêtes', 'B2.3.SLAM'),
('B2.3.SLAM.2', 'Concevoir ou adapter une base de données', 'B2.3.SLAM'),
('B2.3.SLAM.3', 'Développer des fonctionnalités applicatives au sein d\'un système de gestion de bases de données (relationnel ou non)', 'B2.3.SLAM'),
('B2.3.SLAM.4', 'Administrer et déployer une base de données', 'B2.3.SLAM'),
('B3.1.SISR-INFRA.1', 'Analyser un besoin exprimé et son contexte juridique', 'B3.1.SISR-INFRA'),
('B3.1.SISR-INFRA.2', 'Étudier l\'impact d‟une évolution d‟un élément d‟infrastructure sur le système informatique', 'B3.1.SISR-INFRA'),
('B3.1.SISR-INFRA.3', 'Maquetter et prototyper une solution d\'infrastructure', 'B3.1.SISR-INFRA'),
('B3.1.SISR-INFRA.4', 'Choisir les éléments nécessaires pour assurer la qualité et la disponibilité d\'un service', 'B3.1.SISR-INFRA'),
('B3.1.SISR-INFRA.5', 'Élaborer un dossier de choix d\'une solution d‟infrastructure et rédiger les spécifications techniques', 'B3.1.SISR-INFRA'),
('B3.1.SISR-INFRA.6', 'Déterminer et préparer les tests nécessaires à la validation de la solution d‟infrastructure retenue', 'B3.1.SISR-INFRA'),
('B3.2.SISR-INFRA.1', 'Installer et configurer des éléments d\'infrastructure', 'B3.2.SISR-INFRA'),
('B3.2.SISR-INFRA.2', 'Rédiger ou mettre à jour la documentation technique et utilisateur d‟une solution d‟infrastructure', 'B3.2.SISR-INFRA'),
('B3.2.SISR-INFRA.3', 'Tester l\'intégration et l\'acceptation d\'une solution d\'infrastructure', 'B3.2.SISR-INFRA'),
('B3.2.SISR-INFRA.4', 'Déployer une solution d‟infrastructure', 'B3.2.SISR-INFRA'),
('B3.2.SISR-INFRA.5', 'Installer et configurer des éléments nécessaires pour assurer la continuité des services', 'B3.2.SISR-INFRA'),
('B3.2.SISR-INFRA.6', 'Installer et configurer des éléments nécessaires pour assurer la qualité de service', 'B3.2.SISR-INFRA'),
('B3.3.SISR-INFRA.1', 'Administrer sur site et à distance des éléments d\'une infrastructure', 'B3.3.SISR-INFRA'),
('B3.3.SISR-INFRA.2', 'Automatiser des tâches d\'administration', 'B3.3.SISR-INFRA'),
('B3.3.SISR-INFRA.3', 'Gérer des indicateurs et des fichiers d\'activité des éléments d\'une infrastructure', 'B3.3.SISR-INFRA'),
('B3.3.SISR-INFRA.4', 'Identifier- qualifier, évaluer et réagir face à un incident ou à un problème', 'B3.3.SISR-INFRA'),
('B3.3.SISR-INFRA.5', 'Évaluer  -maintenir et améliorer la qualité d‟un service', 'B3.3.SISR-INFRA');

-- --------------------------------------------------------

--
-- Structure de la table `item_indicateur`
--

DROP TABLE IF EXISTS `item_indicateur`;
CREATE TABLE IF NOT EXISTS `item_indicateur` (
  `N_ITEM_INDICATEUR` varchar(32) NOT NULL,
  `LIBEL_ITEM` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`N_ITEM_INDICATEUR`),
  UNIQUE KEY `N_ITEM_INDICATEUR` (`N_ITEM_INDICATEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item_indicateur`
--

INSERT INTO `item_indicateur` (`N_ITEM_INDICATEUR`, `LIBEL_ITEM`) VALUES
('P1.1.1', 'Le recensement du patrimoine informatique est exhaustif et réalisé au moyen d’un outil de gestion des actifs informatiques.'),
('P1.1.2', 'Les référentiels, normes et standards sont mobilisés de façon pertinente.'),
('P1.1.3', 'Les droits mis en place correspondent aux habilitations des acteurs.'),
('P1.1.4', 'Les conditions de continuité et de reprise d’un service sont vérifiées et les manquements sont signalés.'),
('P1.1.5', 'Les sauvegardes sont réalisées dans les conditions prévues conformément au plan de sauvegarde.'),
('P1.1.6', 'Les restaurations sont testées et opérationnelles.'),
('P1.1.7', 'Les écarts par rapport aux règles d’utilisation des ressources numériques sont détectés et signalés.'),
('P1.2.1', 'En utilisant les outils adaptés, les demandes d’assistance ont été prises en compte, correctement diagnostiquées et leur traitement correspond aux attentes.'),
('P1.2.2', 'La réponse à une demande d’assistance est conforme à la procédure et adaptée à l’utilisateur.'),
('P1.2.3', 'La méthode de diagnostic de résolution d’un incident est adéquate et efficiente.'),
('P1.2.4', 'Une solution à l’incident est trouvée et mise en œuvre.'),
('P1.2.5', 'Le cycle de résolution des demandes respecte les normes et standards du prestataire informatique.'),
('P1.2.6', 'L’utilisation d’un logiciel de gestion de parc et d’incidents est maîtrisée.'),
('P1.2.7', 'Le compte rendu d’intervention est clair et explicite.'),
('P1.2.8', 'La communication écrite et orale est adaptée à l’interlocuteur.'),
('P1.3.1', 'L’image de l’organisation est conforme aux attentes et valorisée.'),
('P1.3.2', 'Les enjeux économiques liés à l’image de l’organisation sont identifiés et les obligations juridiques sont respectées.'),
('P1.3.3', 'Les mentions légales sont accessibles et conformes à la législation.'),
('P1.3.4', 'La visibilité des services en ligne de l’organisation est satisfaisante.'),
('P1.3.5', 'Le site Web a évolué conformément au besoin exprimé.'),
('P1.4.1', 'Les objectifs et les modalités d’organisation du projet sont explicités.'),
('P1.4.2', 'L’analyse des besoins et de l’existant est pertinente.'),
('P1.4.3', ' Les activités personnelles sont planifiées selon une méthodologie donnée et les ressources humaines, matérielles et logicielles nécessaires sont mobilisées de manière efficace et pertinente.'),
('P1.4.4', 'Le découpage en tâches est réaliste.'),
('P1.4.5', 'Les livrables sont conformes.'),
('P1.4.6', 'Le projet est documenté.'),
('P1.4.7', 'Un compte rendu clair et concis est réalisé et les écarts sont justifiés.'),
('P1.4.8', 'La communication écrite et orale est adaptée à l’interlocuteur.'),
('P1.5.1', 'Des tests pertinents d’intégration et d’acceptation sont rédigés et effectués.'),
('P1.5.2', 'Les outils de test sont utilisés de manière appropriée.'),
('P1.5.3', 'Un rapport de test du service est produit.'),
('P1.5.4', 'Un support d’information est disponible.'),
('P1.5.5', 'Les modalités d’accompagnement sont définies.'),
('P1.5.6', 'Le service déployé est opérationnel et donne satisfaction à l’utilisateur.'),
('P1.6.1', 'Les besoins de formation sont identifiés pour assurer le support ou mettre à disposition un service.'),
('P1.6.2', 'L’environnement d’apprentissage personnel est délimité et expliqué.'),
('P1.6.3.1', 'repérer les techniques et technologies émergentes du secteur informatique ;'),
('P1.6.3.2', 'Utiliser de manière approfondie des moyens de recherche d\'information ;'),
('P1.6.3.3', 'Renforcer de ses compétences.'),
('P1.6.4', 'L’identité professionnelle est pertinente et visible sur un réseau social professionnel.'),
('P2.1.1.1', 'la modélisation de l’application est conforme aux besoins ;'),
('P2.1.1.2', 'la maquette des éléments applicatifs de la solution respecte les fonctionnalités exprimées ;'),
('P2.1.1.3', 'les spécifications de l’interface utilisateur répondent aux contraintes ergonomiques.'),
('P2.1.2', 'Le choix des composants logiciels à utiliser et/ou à développer est pertinent.'),
('P2.1.3', 'Les composants logiciels sont validés par les procédures de tests unitaires et fonctionnels.'),
('P2.1.4', 'Un service Web est exploité pour échanger des données entre applications.'),
('P2.1.5', 'Les données persistantes liées à la solution applicative sont exploitées à travers un langage de requête lié à la base de données qui peut être le langage de requête proposé par les échanges applicatifs des technologies Web, un langage de requête présent '),
('P2.1.6.1', 'le développement répond à l’expression des besoins fonctionnels et respecte les contraintes techniques figurant dans le cahier des charges ;'),
('P2.1.6.2', 'les tests d’intégration sont réalisés ;'),
('P2.1.6.3', 'un outil collaboratif de gestion des itérations de développement et de versions est utilisé ;'),
('P2.1.6.4', 'Une documentation des versions vient appuyer l’intégration continue ;'),
('P2.1.6.5', 'les composants logiciels sont documentés de manière à être réutilisés ;'),
('P2.1.6.6', 'un document est rédigé pour chaque contexte d’utilisation de l’application et est adapté à chaque destinataire tant par son contenu que par sa présentation ;'),
('P2.1.6.7', 'le développement tient compte des préoccupations de développement durable.'),
('P2.1.7', 'L’application développée est opérationnelle conformément au cahier des charges et stable dans l’environnement de production.'),
('P2.2.1', 'L’évolution de la solution applicative répond aux besoins exprimés dans le cahier des charges.'),
('P2.2.10', 'Les composants logiciels sont documentés de manière à être réutilisés.'),
('P2.2.11', 'La documentation technique et d’utilisateurs de la solution applicative sont mises à jour.'),
('P2.2.12', 'L’application améliorée et/ou corrigée est opérationnelle et stable dans l’environnement de production.'),
('P2.2.2', 'La modélisation de l’application existante est mise à jour par les nouvelles fonctionnalités et/ou les nouveaux correctifs apportés.'),
('P2.2.3', 'L’interface utilisateur est mise à jour en respectant les contraintes ergonomiques.'),
('P2.2.4', 'Un outil collaboratif de gestion des versions est utilisé.'),
('P2.2.5', 'Des composants logiciels sont adaptés pour améliorer la qualité de la solution applicative.'),
('P2.2.6', 'Les composants logiciels adaptés et/ou corrigés sont validés par les procédures de tests unitaires et fonctionnels.'),
('P2.2.7', 'Le dysfonctionnement de la solution existante est corrigé selon les procédures en vigueur et dans les délais.'),
('P2.2.8', 'Les accès aux données persistantes à travers le langage de requête du système de gestion de base de données relationnel, le langage de requête proposé par les échanges applicatifs des technologies Web, le langage de requête de l’outil de correspondance ob'),
('P2.2.9', 'Les tests de non régression sont réalisés.'),
('P2.3.1', 'L’exploitation des données permet de construire l’information attendue.'),
('P2.3.2', 'Les accès aux données sont contrôlés conformément aux habilitations définies par le cahier des charges.'),
('P2.3.3', 'Les traitements pris en charge par les composants développés dans la base de données sont conformes aux demandes du cahier des charges.'),
('P2.3.4', 'Les données sont modélisées conformément au besoin de la solution applicative.'),
('P2.3.5', 'Le choix du type de base de données est pertinent.'),
('P2.3.6', 'L’accessibilité des données est conforme à la qualité de service attendue.'),
('P2.3.7', 'La base de données est sauvegardée selon la planification retenue.'),
('P2.3.8', 'Des tests de restauration sont effectués.'),
('P2.3.9', 'La base de données est opérationnelle et stable dans l’environnement de production.'),
('P3.1.1', 'La collecte, le traitement et la conservation des données à caractère personnel sont effectués conformément à la réglementation en vigueur.'),
('P3.1.2', 'La charte informatique contient des dispositions destinées à protéger les données à caractère personnel.'),
('P3.1.3', 'Des supports de communication pertinents sont accessibles et adaptés aux utilisateurs.'),
('P3.1.4', 'Le recensement des traitements des données à caractère personnel est exhaustif.'),
('P3.1.5', 'Des moyens de protection sont mis en place pour garantir la confidentialité et l’intégrité des données à caractère personnel en tenant compte des risques identifiés.'),
('P3.2.1', 'L’identité numérique de l’organisation est protégée en s’appuyant sur des moyens techniques et juridiques.'),
('P3.2.2', 'La preuve électronique est déployée de manière sécurisée et dans le respect de la législation.'),
('P3.3.1', 'Des supports de communication interne sont accessibles aux utilisateurs et adaptés à leurs destinataires.'),
('P3.3.2.1', 'l’accès physique au terminal et à ses données est sécurisé ;'),
('P3.3.2.2', 'les applications installées sont vérifiées par des procédures automatisées et des logiciels de sécurité ;'),
('P3.3.2.3', 'les flux  réseaux sont identifiés et sécurisés.'),
('P3.3.3.1', 'les utilisateurs sont authentifiés ;'),
('P3.3.3.2', 'les habilitations sont configurées ;'),
('P3.3.3.3', 'l’accès aux données est contrôlé ;'),
('P3.3.3.4', 'les privilèges sont restreints.'),
('P3.3.4', 'L’efficacité de la protection mise en œuvre est évaluée.'),
('P3.4.1', 'Les risques associés à l’utilisation malveillante d’un service informatique sont caractérisés.'),
('P3.4.2', 'Les conséquences des actes malveillants sur un service informatique sont identifiées.'),
('P3.4.3', 'Les obligations légales en matière d’archivage et de protection des données sont identifiées et respectées.'),
('P3.4.4', 'Les preuves numériques sont conservées de manière sécurisée et dans le respect de la législation.'),
('P3.4.5.1', 'un schéma présentant la segmentation du réseau est disponible ;'),
('P3.4.5.2', 'les principes de mise en œuvre des  contrôles des connexions aux réseaux sont validés ;'),
('P3.4.5.3', 'l\'authentification et la confidentialité des échanges sont vérifiées ;'),
('P3.4.5.4', 'la sécurité de l\'administration est prise en compte ;'),
('P3.4.5.5', 'les accès physiques et logiques à un serveur ou à un service sont vérifiés en fonction des habilitations et des privilèges définis ;'),
('P3.4.5.6', 'les accès aux données sont contrôlés à chaque étape d’une transaction ;'),
('P3.4.5.7', 'les systèmes et les applications sont actualisés en fonction des alertes de sécurité ;'),
('P3.4.5.8', 'les vulnérabilités connues sont contrôlées'),
('P3.5.1', 'Le respect des bonnes pratiques de développement informatique est vérifié (les structures de données sont normalisées, les accès aux données sont optimisés, le code est modulaire et robuste, les tests sont effectués).'),
('P3.5.10', 'Les contre-mesures mises en place corrigent et préviennent les incidents de sécurité.'),
('P3.5.11', 'Les contre-mesures sont documentées de manière à en assurer le suivi.'),
('P3.5.12', 'La communication écrite et orale est adaptée à l’interlocuteur.'),
('P3.5.2', 'Les préoccupations de sécurité sont prises en compte à toutes les étapes d’un développement informatique.'),
('P3.5.3', 'Les bonnes pratiques de sécurité sont mises en œuvre à toutes les étapes d’un développement informatique.'),
('P3.5.4', 'Des tests de sécurité sont prévus et mis en œuvre.'),
('P3.5.5', 'Les traitements sur les données à caractère personnel sont déclarés et respectent la réglementation.'),
('P3.5.6', 'Le système d’authentification est conforme aux règles de sécurité.'),
('P3.5.7', 'L’accès aux données respecte les règles de sécurité.'),
('P3.5.8', 'Les échanges de données entre applications sont protégés.'),
('P3.5.9', 'Les composants utilisés sont certifiés, sécurisés et actualisés.');

-- --------------------------------------------------------

--
-- Structure de la table `item_savoir`
--

DROP TABLE IF EXISTS `item_savoir`;
CREATE TABLE IF NOT EXISTS `item_savoir` (
  `N_ITEM_SAVOIR` varchar(32) NOT NULL,
  `LIBEL_ITEM` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`N_ITEM_SAVOIR`),
  UNIQUE KEY `N_ITEM_SAVOIR` (`N_ITEM_SAVOIR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item_savoir`
--

INSERT INTO `item_savoir` (`N_ITEM_SAVOIR`, `LIBEL_ITEM`) VALUES
('S1.1.1', 'Patrimoine informatique : définition, outils de gestion'),
('S1.1.10', 'Typologie des licences logicielles, modalités de tarification'),
('S1.1.11', 'Gestion des actifs informatiques : méthodes, enjeux techniques, financiers, organisationnels et juridiques pour l’organisation'),
('S1.1.12', 'Contrat de prestation de service informatique et autres contrats liés à la gestion du patrimoine informatique'),
('S1.1.13', 'Obligations légales en matière de conservation et d’archivage des données'),
('S1.1.14', 'Charte informatique et sa valeur juridique'),
('S1.1.15', 'Responsabilités du salarié utilisateur des ressources informatiques'),
('S1.1.2', 'Système informatique'),
('S1.1.3', 'Système d’exploitation : gestion des utilisateurs, habilitations et droits d’accès'),
('S1.1.4', 'Disponibilité d’un service informatique : enjeux techniques, économiques et juridiques'),
('S1.1.5', 'Plans de continuité et de reprise d’activité'),
('S1.1.6', 'Typologie et techniques de sauvegarde et de restauration'),
('S1.1.7', 'Typologie des supports de sauvegarde'),
('S1.1.8', 'Typologie des acteurs de l’industrie informatique'),
('S1.1.9', 'Normes et standards : enjeux techniques et économiques'),
('S1.2.1', 'Outils et méthodes de gestion des incidents'),
('S1.2.10', 'Bases de la programmation : structures de données et de contrôle, procédures, fonctions, utilisation d’objets'),
('S1.2.11', 'Langage de commande d’un système d’exploitation : commandes usuelles et script'),
('S1.2.12', 'Entente de niveau de service et contrat d’assistance : obligations et responsabilités'),
('S1.2.2', 'Méthodologie de repérage de la cause d’un incident, d’une panne'),
('S1.2.3', 'Base de connaissances d’un centre d’assistance (helpdesk)'),
('S1.2.4', 'Prise de contrôle d’un poste de travail'),
('S1.2.5', 'Normes et standards concernant la gestion des configurations et la gestion d’incidents'),
('S1.2.6', 'Méthodes et outils de diagnostic'),
('S1.2.7', 'Bases du réseau : modèles de référence, médias d’interconnexion, protocoles de base et services associés, adressage, nommage, routage, principaux composants matériels, notion de périmètres réseau'),
('S1.2.8', 'Principaux composants matériels des équipements utilisateur et des serveurs'),
('S1.2.9', 'Système d’exploitation : logiciels des équipements utilisateur et des serveurs, fonctionnalités des systèmes d’exploitation des équipements utilisateur et serveurs, virtualisation'),
('S1.3.1', 'Référencement et mesure d’audience d’un service en ligne'),
('S1.3.10', 'Réglementation en matière de collecte, de traitement et de conservation des données à caractère personnel'),
('S1.3.11', 'Droit d’utilisation des contenus externes'),
('S1.3.12', 'Nom de domaine : formalisme, organismes d’attribution et de gestion, conflits et résolution'),
('S1.3.2', 'Conventions d’écriture électronique'),
('S1.3.3', 'Charte graphique'),
('S1.3.4', 'Bases de la programmation Web : langage de présentation et de mise en forme, langage d’accès aux données, langage de contrôle'),
('S1.3.5', 'Langage d’interrogation de données'),
('S1.3.6', 'Système de gestion de contenus : fonctionnalités et paramétrage'),
('S1.3.7', 'E-réputation d’une organisation : modalités de construction, atteintes, protection juridique et enjeux économiques  '),
('S1.3.8', 'Responsabilité de l’éditeur et de l’hébergeur du site Web'),
('S1.3.9', 'Mentions légales et conditions générales d’utilisation d’un site Web  '),
('S1.4.1', 'Planification de projet : approche prédictive et séquentielle, approche agile.'),
('S1.4.2', 'Outil de gestion de projet : fonctionnalités et paramétrage'),
('S1.5.1', 'Service informatique : prestations, moyens techniques, rôles des parties prenantes'),
('S1.5.2', 'Principes d’architecture d\'un service'),
('S1.5.3', 'Services et protocoles réseaux standard et de base'),
('S1.5.4', 'Techniques et outils de déploiement des services informatiques'),
('S1.5.5', 'Techniques et outils de test des services informatiques'),
('S1.6.1', 'Gestion des relations professionnelles : identité numérique professionnelle, techniques de rédaction de curriculum vitae et de lettre de motivation, présence sur les réseaux sociaux professionnels (outils, atouts et risques)'),
('S1.6.2', 'Veille informationnelle et curation : sources d’information, stratégies et outils.'),
('S1.6.3', 'Panorama des métiers de l’informatique'),
('S2.0.1', 'Méthodes, normes et standards associés au processus de conception et de développement d’une solution applicative'),
('S2.0.10', 'Caractéristiques des formats de données : structurées ou non'),
('S2.0.11', 'Persistance et couche d’accès aux données'),
('S2.0.12', 'Techniques et outils de documentation.'),
('S2.0.13', 'Techniques de gestion des erreurs et des exceptions'),
('S2.0.14', 'Fonctionnalités d’un outil de gestion de projets.'),
('S2.0.15', 'Concepts et techniques de développement agile'),
('S2.0.16', 'Fonctionnalités avancées d’un environnement de développement.'),
('S2.0.17', 'Techniques de gestion de versions  '),
('S2.0.18', 'Techniques et outils d’intégration continue'),
('S2.0.19', 'Techniques et outils de tests et d’intégration de composants logiciels'),
('S2.0.2', 'Architectures applicatives : concepts de base et typologies'),
('S2.0.20', 'Contraintes éthiques et environnementales dans la conception d\'une solution applicative'),
('S2.0.21', 'Cahier des charges et ses enjeux juridiques'),
('S2.0.22', 'Contrat de développement et de maintenance applicative (formation, exécution, inexécution) et ses clauses spécifiques'),
('S2.0.23', 'Réglementation en matière de collecte, de traitement et de conservation des données à caractère personnel'),
('S2.0.24', 'Responsabilité civile et pénale du concepteur de solutions applicatives'),
('S2.0.25', 'Protection juridique des productions de solutions applicatives : droit d’auteur, modes de protection indirects et conditions de brevetabilité  '),
('S2.0.26', 'Typologie des licences logicielles et droits des utilisateurs'),
('S2.0.3', 'Techniques et outils d’analyse et de rétro-conception Typologie et techniques des cycles de production d’un service et acteurs associés'),
('S2.0.4', 'Composition du coût d’une solution applicative  '),
('S2.0.5', 'Interfaces homme-machine : principes ergonomiques,  techniques de conception, d’évaluation et de validation.'),
('S2.0.6', 'Concepts de la programmation objet : classe, objet, abstraction, interface, héritage, polymorphisme, annotations, patrons de conception, interface de programmation d’applications'),
('S2.0.7', 'Concepts de la programmation événementielle : techniques de gestion des événements et exploitation de bibliothèques de composants graphiques'),
('S2.0.8', 'Programmation au sein d’un cadre applicatif (framework) : structure, outil d’aide au développement et de gestion des dépendances, techniques d’injection des dépendances'),
('S2.0.9', 'Architectures et techniques d’interopérabilité entre applications.'),
('S2.3.1', 'Typologie des bases de données'),
('S2.3.10', 'Protection juridique des bases de données par le droit d’auteur et le droit du producteur.'),
('S2.3.11', 'Responsabilité civile et pénale du concepteur de bases de données'),
('S2.3.2', 'Caractéristiques des formats de données structurées ou non'),
('S2.3.3', 'Principaux concepts des systèmes de gestion de bases de données : structure et implémentation des données, architecture et infrastructure de stockage, contrainte d’intégrité, de confidentialité et de sécurité des données, propriétés de cohérence, de dispo'),
('S2.3.4', 'Langage de définition des données, des contraintes et de contrôle des données.'),
('S2.3.5', 'Langage et outils de manipulation et d’interrogation d’une base de données'),
('S2.3.6', 'Langage d’automatisation des actions dans une base de données'),
('S2.3.7', 'Techniques et outils avancés intégrés au système de gestion de base de données : transactions, gestion des erreurs, mesure de performances, méthodes et techniques d’optimisation des données et de leur accès, méthodes et techniques de disponibilité et d’in'),
('S2.3.8', 'Modèles de référence de représentation des données. Méthodes et outils de modélisation des données.'),
('S2.3.9', 'Réglementation en matière de collecte, de traitement et de conservation des données à caractère personnel.'),
('S3.0.1', 'Typologie des risques et leurs impacts.'),
('S3.0.10', 'Sécurité des applications Web : risques, menaces et protocoles.'),
('S3.0.11', 'Outils de contrôle de la sécurité : plans de secours, traçabilité et audit technique.'),
('S3.0.12', 'Les données à caractère personnel : définition, réglementation, rôle de la CNIL.'),
('S3.0.13', 'L’identité numérique de l’organisation : risques et protection juridique.'),
('S3.0.14', 'Droit de la preuve électronique.'),
('S3.0.15', 'La sécurité des équipements personnels des utilisateurs et de leurs usages : prise en compte des nouvelles modalités de travail, rôle de la charte informatique.'),
('S3.0.16', 'Les risques des cyberattaques pour l’organisation : économique, juridique, atteinte à l’identité de l’entreprise.'),
('S3.0.17', 'Obligations légales de notification en cas de faille de sécurité.'),
('S3.0.18', 'Réglementation en matière de lutte contre la fraude informatique : infractions, sanctions.'),
('S3.0.19', 'Les organisations de lutte contre la cybercriminalité.'),
('S3.0.2', 'Principes de la sécurité : disponibilité, intégrité, confidentialité, preuve.'),
('S3.0.3', 'Sécurité et sûreté : périmètre respectif.'),
('S3.0.4', 'Sécurité des terminaux utilisateurs et de leurs données : principes et outils.'),
('S3.0.5', 'Authentification, privilèges et habilitations des utilisateurs : principes et techniques.'),
('S3.0.6', 'Gestion des droits d’accès aux données : principes et techniques.'),
('S3.0.7', 'Sécurité des communications numériques : rôle des protocoles, segmentation, administration, restriction physique et logique.'),
('S3.0.8', 'Protection et archivage des données : principes et techniques.'),
('S3.0.9', 'Chiffrement, authentification et preuve : principes et techniques.'),
('S3.5.1', 'Développement informatique : méthodes, normes, standards et bonnes pratiques.'),
('S3.5.2', 'Aspects réglementaires du développement applicatif : protection de la vie privée dès la conception, protection des données par défaut, sécurité par défaut, droit des individus.'),
('S3.5.3', 'Sécurité du développement d’application : gestion de projet, architectures logicielles, rôle des protocoles, authentification, habilitations et privilèges des utilisateurs, confidentialité des échanges, tests de sécurité, audit de code.'),
('S3.5.4', 'Vulnérabilités et contre-mesures sur les problèmes courants de développement.'),
('S3.5.5', 'Environnements de production et de développement : fonctionnalités de sécurité, techniques d’isolation des applicatifs.'),
('S3.5.6', 'Responsabilité du concepteur de solutions applicatives.');

-- --------------------------------------------------------

--
-- Structure de la table `maitriser`
--

DROP TABLE IF EXISTS `maitriser`;
CREATE TABLE IF NOT EXISTS `maitriser` (
  `N_ITEM_SAVOIR` varchar(32) NOT NULL,
  `IDENTIFIANT_ETUD` int NOT NULL AUTO_INCREMENT,
  `MAITRISE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`N_ITEM_SAVOIR`,`IDENTIFIANT_ETUD`),
  UNIQUE KEY `N_ITEM_SAVOIR_2` (`N_ITEM_SAVOIR`,`IDENTIFIANT_ETUD`),
  KEY `IDENTIFIANT_ETUD` (`IDENTIFIANT_ETUD`),
  KEY `N_ITEM_SAVOIR` (`N_ITEM_SAVOIR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mobiliser`
--

DROP TABLE IF EXISTS `mobiliser`;
CREATE TABLE IF NOT EXISTS `mobiliser` (
  `N_ITEM_SAVOIR` varchar(32) NOT NULL,
  `ID_PROJET` int(11) NOT NULL,
  PRIMARY KEY (`N_ITEM_SAVOIR`,`ID_PROJET`),
  UNIQUE KEY `N_ITEM_SAVOIR_2` (`N_ITEM_SAVOIR`,`ID_PROJET`),
  KEY `ID_PROJET` (`ID_PROJET`),
  KEY `N_ITEM_SAVOIR` (`N_ITEM_SAVOIR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `ID_PROJET` int NOT NULL AUTO_INCREMENT,
  `LIBEL_PROJET` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_PROJET`),
  UNIQUE KEY `ID_PROJET` (`ID_PROJET`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `realiser`
--

DROP TABLE IF EXISTS `realiser`;
CREATE TABLE IF NOT EXISTS `realiser` (
  `ID_PROJET` int(11) NOT NULL,
  `IDENTIFIANT_ETUD` int(11) NOT NULL,
  PRIMARY KEY (`ID_PROJET`,`IDENTIFIANT_ETUD`),
  UNIQUE KEY `ID_PROJET_2` (`ID_PROJET`,`IDENTIFIANT_ETUD`),
  KEY `IDENTIFIANT_ETUD` (`IDENTIFIANT_ETUD`),
  KEY `ID_PROJET` (`ID_PROJET`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acquerir`
--
ALTER TABLE `acquerir`
  ADD CONSTRAINT `acquerir_ibfk_1` FOREIGN KEY (`N_ITEM_COMPETENCE`) REFERENCES `item_competence` (`N_ITEM_COMPETENCE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acquerir_ibfk_2` FOREIGN KEY (`IDENTIFIANT_ETUD`) REFERENCES `etudiant` (`IDENTIFIANT_ETUD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`N_ITEM_COMPETENCE`) REFERENCES `item_competence` (`N_ITEM_COMPETENCE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`N_ITEM_INDICATEUR`) REFERENCES `item_indicateur` (`N_ITEM_INDICATEUR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contenir_ibfk_3` FOREIGN KEY (`N_ITEM_SAVOIR`) REFERENCES `item_savoir` (`N_ITEM_SAVOIR`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ensemble_de_competence`
--
ALTER TABLE `ensemble_de_competence`
  ADD CONSTRAINT `ensemble_de_competence_ibfk_1` FOREIGN KEY (`ID_NOM_BLOC`) REFERENCES `blocs` (`ID_NOM_BLOC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `indicateur`
--
ALTER TABLE `indicateur`
  ADD CONSTRAINT `indicateur_ibfk_1` FOREIGN KEY (`N_ITEM_INDICATEUR`) REFERENCES `item_indicateur` (`N_ITEM_INDICATEUR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `indicateur_ibfk_2` FOREIGN KEY (`ID_PROJET`) REFERENCES `projet` (`ID_PROJET`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `item_competence`
--
ALTER TABLE `item_competence`
  ADD CONSTRAINT `item_competence_ibfk_1` FOREIGN KEY (`ID_ENSEMBLE_COMPETENCE`) REFERENCES `ensemble_de_competence` (`ID_ENSEMBLE_COMPETENCE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `maitriser`
--
ALTER TABLE `maitriser`
  ADD CONSTRAINT `maitriser_ibfk_1` FOREIGN KEY (`N_ITEM_SAVOIR`) REFERENCES `item_savoir` (`N_ITEM_SAVOIR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maitriser_ibfk_2` FOREIGN KEY (`IDENTIFIANT_ETUD`) REFERENCES `etudiant` (`IDENTIFIANT_ETUD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mobiliser`
--
ALTER TABLE `mobiliser`
  ADD CONSTRAINT `mobiliser_ibfk_1` FOREIGN KEY (`N_ITEM_SAVOIR`) REFERENCES `item_savoir` (`N_ITEM_SAVOIR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mobiliser_ibfk_2` FOREIGN KEY (`ID_PROJET`) REFERENCES `projet` (`ID_PROJET`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `realiser`
--
ALTER TABLE `realiser`
  ADD CONSTRAINT `realiser_ibfk_1` FOREIGN KEY (`ID_PROJET`) REFERENCES `projet` (`ID_PROJET`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `realiser_ibfk_2` FOREIGN KEY (`IDENTIFIANT_ETUD`) REFERENCES `etudiant` (`IDENTIFIANT_ETUD`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
