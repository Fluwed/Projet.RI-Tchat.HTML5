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
  `isAdmin` tinyint(1) DEFAULT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `user`, `password`, `isAdmin`, `dateInscription`) VALUES
(1, 'Admin', 'Admin', 1, '2015-02-02 14:48:51'),
(2, 'Kevin', 'Kevin', 0, '2015-02-02 14:48:51'),
(3, 'Paul', 'Paul', 0, '2015-02-02 14:48:51');

-- --------------------------------------------------------

--
-- Structure de la table `salons`
--

CREATE TABLE IF NOT EXISTS `salons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `dateOuverture` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateFermeture` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `salons`
--

INSERT INTO `salons` (`id`, `titre`, `dateOuverture`, `dateFermeture`) VALUES
(1, 'L''Enseignement et les Parcours', '2015-01-01 00:00:00', NULL),
(2, 'Le Logement à Saint-Étienne', '2015-01-01 00:00:00', NULL),
(3, 'La Ville de Saint-Étienne', '2015-01-01 00:00:00', NULL),
(4, 'La Vie Étudiante', '2015-01-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` tinytext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idSalon` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_salons_idx` (`idSalon`),
  KEY `fk_messages_auteurs1_idx` (`idAuteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Contraintes pour la table `messages`
--

ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_auteurs1` FOREIGN KEY (`idAuteur`) REFERENCES `auteurs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_salons` FOREIGN KEY (`idSalon`) REFERENCES `salons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
