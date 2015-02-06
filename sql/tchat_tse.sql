SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `tchat_tse`
--

CREATE DATABASE IF NOT EXISTS `tchat_tse` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tchat_tse`;

DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `auteurs`;
DROP TABLE IF EXISTS `salons`;

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE IF NOT EXISTS `auteurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `dateInscription` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `user`, `password`, `isAdmin`, `dateInscription`) VALUES
(1, 'Admin', '$2y$10$6GmHWbyaI/x4RrK7P9vlIer5/AhPi6FcrlAUpYc1N7CVe9F7SH72m', 1, '2015-02-06 11:36:39.850387'),
(2, 'Paul', '$2y$10$3CNMRrig12E4jdFOjqkfzeuSoaMSwWuzsB3BYzbMEolAoPAiF3l6e', 0, '2015-02-06 11:53:34.156755'),
(3, 'Kevin', '$2y$10$/GSYRouSM2HeyZIQ1oN6guKuAuZ8iPS5qJok8Sq4b2/n4gw/CvZe2', 0, '2015-02-06 11:54:13.789153');

-- --------------------------------------------------------

--
-- Structure de la table `salons`
--

CREATE TABLE IF NOT EXISTS `salons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `dateOuverture` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `dateFermeture` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `salons`
--

INSERT INTO `salons` (`id`, `titre`, `dateOuverture`, `dateFermeture`) VALUES
(1, 'L''Enseignement et les Parcours', '2015-01-01 00:00:00.000000', NULL),
(2, 'Le Logement à Saint-Étienne', '2015-01-01 00:00:00.000000', NULL),
(3, 'La Ville de Saint-Étienne', '2015-01-01 00:00:00.000000', NULL),
(4, 'La Vie Étudiante', '2015-01-01 00:00:00.000000', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` tinytext NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `idSalon` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  `isResponded` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_messages_salons_idx` (`idSalon`),
  KEY `fk_messages_auteurs_idx` (`idAuteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Contraintes pour la table `messages`
--

ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_auteurs` FOREIGN KEY (`idAuteur`) REFERENCES `auteurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_salons` FOREIGN KEY (`idSalon`) REFERENCES `salons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
