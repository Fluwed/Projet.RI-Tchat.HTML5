CREATE DATABASE  `Salons` /*!40100 DEFAULT CHARACTER SET latin1 */


CREATE TABLE  `Salons`.`Auteurs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `auteur` varchar(80) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `timestamp` varchar(15) DEFAULT NULL,
  `idSalon` int(11) DEFAULT '1',
  `idManager` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99445 DEFAULT CHARSET=latin1


CREATE TABLE  `Salons`.`Coord` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) DEFAULT NULL,
  `timestamp` varchar(15) DEFAULT NULL,
  `mail` varchar(80) DEFAULT NULL,
  `nom` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1


CREATE TABLE  `Salons`.`Messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `texte` varchar(2500) DEFAULT NULL,
  `idAuteur` int(11) DEFAULT NULL,
  `idSalon` int(11) DEFAULT NULL,
  `timestampmessage` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1168 DEFAULT CHARSET=latin1


CREATE TABLE  `Salons`.`Salons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `salon` text CHARACTER SET utf8,
  `timestampouverture` varchar(15) DEFAULT NULL,
  `timestampfermeture` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1


CREATE TABLE  `Salons`.`TrashWords` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
