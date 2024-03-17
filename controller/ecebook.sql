-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 mars 2023 à 20:57
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecebook`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE IF NOT EXISTS `abonnement` (
  `id_abonnement` int NOT NULL AUTO_INCREMENT,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  PRIMARY KEY (`id_abonnement`),
  UNIQUE KEY `uc_Abonnement` (`user1_id`,`user2_id`),
  KEY `user1_id` (`user1_id`),
  KEY `user2_id` (`user2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id_abonnement`, `user1_id`, `user2_id`) VALUES
(19, 130, 120),
(38, 131, 138),
(31, 134, 120),
(32, 134, 134);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) NOT NULL,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `time_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`),
  KEY `fk_commentaires_posts` (`id_post`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_comment`, `contenu`, `id_post`, `id_user`, `time_stamp`) VALUES
(1, 'dsfgdsfg', 9, 106, '2023-03-22 16:44:32'),
(2, 'sqgfdsgsd', 54, 122, '2023-03-23 09:02:27'),
(3, 'sdfqs', 54, 122, '2023-03-23 09:04:30'),
(4, 'retezrt', 54, 122, '2023-03-23 09:19:50'),
(5, 'retezrt', 54, 122, '2023-03-23 09:23:18'),
(6, 'très beau', 78, 138, '2023-03-25 09:03:52'),
(7, 'bien joué', 78, 138, '2023-03-25 09:04:04'),
(8, 'cc', 79, 138, '2023-03-25 20:18:44'),
(9, 'bjr', 82, 138, '2023-03-27 06:22:06'),
(10, 'bjr', 91, 138, '2023-03-27 22:16:55'),
(11, 'bjr cv?', 88, 138, '2023-03-28 05:12:27'),
(12, 'cv?', 78, 138, '2023-03-28 05:17:45'),
(13, 'bjr', 97, 138, '2023-03-28 05:19:31'),
(14, 'bg', 102, 138, '2023-03-29 08:35:14');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `like` int DEFAULT '1',
  PRIMARY KEY (`id_post`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_post`, `id_user`, `like`) VALUES
(50, 119, 1),
(50, 134, 1),
(50, 138, 1),
(61, 134, 1),
(78, 131, 1),
(81, 138, 1),
(87, 138, 1),
(91, 138, 1),
(100, 138, 1),
(103, 138, 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `expediteur_id` int NOT NULL,
  `destinataire_id` int NOT NULL,
  `contenu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`),
  KEY `fk_expediteur` (`expediteur_id`),
  KEY `fk_destinataire` (`destinataire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `expediteur_id`, `destinataire_id`, `contenu`, `date_envoi`) VALUES
(1, 131, 138, 'bjr', '2023-03-26 09:25:15'),
(2, 131, 138, 'cv?', '2023-03-26 09:25:24'),
(3, 138, 131, 'cv et toi?', '2023-03-26 09:29:26');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomcrea` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publique` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `message`, `image`, `nomcrea`, `titre`, `id_user`, `nom`, `publique`, `date`) VALUES
(50, 'ersdcgvsfx', NULL, NULL, 'efzrgsfgvrs', 120, NULL, NULL, '2023-03-22 16:43:13'),
(61, 'dqfvds', '', NULL, 'zedffrsv', 120, NULL, 0, '2023-03-23 16:49:15'),
(73, 'fdswfvsfdxw', '', NULL, 'gccyy', 136, 'rzsfged', 0, '2023-03-24 14:37:21'),
(78, '                                                                                                                        titou                                                                                                                                                                               ', '', NULL, 'rayane', 138, 'Jerbi', 0, '2023-03-25 07:44:55'),
(81, '                              sfxwgwfd                              ', 'bonk.jpg', NULL, 'bfgf', 138, 'JERBI', NULL, '2023-03-27 04:17:24'),
(83, '                              bjr                              ', 'Acer_Wallpaper_02_5000x2813.jpg', NULL, 'bjr', 131, 'Jerbi', NULL, '2023-03-27 05:42:41'),
(84, 'titou le plus beau', '', NULL, 'titou', 120, NULL, 0, '2023-03-27 13:15:38'),
(85, 'oui', 'bonk.jpg', NULL, 'cv bien ?', 120, NULL, 1, '2023-03-27 18:29:03'),
(86, 'oui', 'bonk.jpg', NULL, 'cv bien ?', 120, NULL, 1, '2023-03-27 18:30:55'),
(87, 'oui', 'bonk.jpg', NULL, 'cv bien ?', 120, NULL, 1, '2023-03-27 18:32:22'),
(88, 'oui #Rayane_jrb', '', NULL, 'cv bien ? #Rayane_jrb', 120, NULL, 1, '2023-03-27 18:33:37'),
(89, 'jvhvh', 'A330-800-first-flight-air-to-air-.jpg', NULL, ' bjbb', 120, NULL, 0, '2023-03-27 18:55:08'),
(90, 'srf<gwd', '', NULL, 'frsdxgf', 138, 'JERBI', 1, '2023-03-27 18:59:51'),
(91, 'srf<gwd', '', NULL, 'CV?', 138, 'JERBI', 1, '2023-03-27 19:01:03'),
(92, 'est ge til', '', NULL, 'Rayane', 138, 'JERBI', 0, '2023-03-27 19:02:55'),
(93, 'fsxgwdf', '8b71d8871985f079b31309fc17936e65-montana.jpg', NULL, 'fsgsd', 120, NULL, 1, '2023-03-27 20:27:00'),
(94, 'd', '29710_1479181673.webp', NULL, 'd', 120, NULL, 0, '2023-03-27 20:34:30'),
(96, 'bla', 'A330-800-first-flight-air-to-air-.jpg', NULL, 'bla', 120, NULL, 1, '2023-03-27 21:17:18'),
(97, 'TITOU', 'Acer_Wallpaper_02_5000x2813.jpg', NULL, 'TITOU', 120, 'rayane', 1, '2023-03-28 03:08:21'),
(98, 'il est très gentil', 'Capture d\'écran 2023-03-08 162315.png', NULL, 'titou', 138, 'JERBI', 1, '2023-03-28 03:31:48'),
(99, 'bjr #Rayane_jrb #Rayane #JERBI', '', NULL, 'bjr #Rayane_jrb #Rayane #JERBI', 131, 'Jerbi', 0, '2023-03-28 08:07:57'),
(100, 'sf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfw', '', NULL, 'sf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfw', 138, 'JERBI', 0, '2023-03-28 12:04:01'),
(101, 'sf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfwsf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfwsf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfw', '', NULL, 'sf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfwsf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfwsf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfwsf<gbdxwhdgcxhbgdcxhbdgfvhbgdwhbdnhdwhnbwgwfdcngdcngfwdgdxfw', 138, 'JERBI', 0, '2023-03-28 12:05:22'),
(102, 'titou', 'IMG_9689-removebg-preview.jpg', NULL, 'rayane', 138, 'JERBI', 1, '2023-03-29 06:35:00'),
(103, '#Rayane_jrb', '', NULL, '#Rayane_jrb', 138, 'JERBI', 1, '2023-03-29 17:49:29');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adressemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll` enum('etudiant','professeur','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'etudiant',
  `promo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `datedenaissance` date DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_confirmation` varchar(255) NOT NULL,
  `confirmer` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `image`, `ville`, `adressemail`, `mdp`, `roll`, `promo`, `datedenaissance`, `description`, `pseudo`, `code_confirmation`, `confirmer`) VALUES
(120, 'Jerbi', 'rayane', 'download-removebg-preview (1).jpg', 'Paris', 'rayane@admin.fr', '$2y$10$mXbbkOvM.5BrWugDRxhvROseSXl3lLax0Czf7LGkoU8f1Fepo1EYO', 'admin', 'Promo', '2003-04-17', 'qedfgfvzfsgv', 'rayane', 'e1e1c7b2f9b58f07ff0bcf76b283f245', 1),
(131, 'Jerbi', 'Rayane', 'download-removebg-preview (1).jpg', 'Paris', 'rayane.jerbi@omnes.intervenant.fr', '$2y$10$Ut0WGQrvP5a5bp4Na63mSuLGTfYqZ0p62ZhxTUhNhEbgh7T2bwfTm', 'professeur', 'ING1,ING3,B2', '2003-04-17', 'Développeur SI et IT', 'Rayane_jrb', '1de7e789af018ded3c3ac4be97523b90', 1),
(136, 'rzsfged', 'rfs<gedw', '', 'EFVSX', 'EFVSX@edu.ece.fr', '$2y$10$wlU/BwumAA3pYpGkyrd4huX3ytLgQSP1OWHVV.Gr/eYyepNi1YhIu', 'etudiant', 'ING2', '2004-12-12', 'rvefdbdfw', 'rayane', '641db3c241aa5', 1),
(138, 'JERBI', 'Rayane', 'download-removebg-preview (1).jpg', 'Paris', 'rayane.jerbi@edu.ece.fr', '$2y$10$er5Nr2RsR4AE1bYn0DZMaedo37hZmWq3tNAX/7LaP2yrYn.P/WpEy', 'etudiant', 'B2', '2003-04-17', 'Développeur SI et IT', 'Rayane_jrb', '6e81212a2d2381b05378e782e6880439', 1),
(140, 'bl', 'bl', '', 'bl', 'bl@edu.ece.fr', '$2y$10$zxXcOIz01wl7KtHVrIvOHeCfLeI60vjUnUr.5Qqmkpydi9RW9DJM.', 'etudiant', 'B3', '2003-04-12', 'qsfd', 'rayane@admin.fr', '642273d0d9e1a', 0),
(142, 'baldw', 'fgvwx', 'IMG_9689-removebg-preview.jpg', 'gchbfxc', 'gfwxdcgb@edu.ece.fr', '$2y$10$8Kkbb2ngEgEw.jDxk3MVOOdNiPLkbEzDUlrI337AMyM9sJtGFO54W', 'etudiant', 'B2', '2003-04-12', 'fvxgbfdx', 'rayane@admin.fr', '6424454f4d597', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_posts` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_posts_utilisateur` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
