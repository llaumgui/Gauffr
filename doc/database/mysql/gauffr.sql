--
-- Structure de la table `gauffr_credential`
--

CREATE TABLE IF NOT EXISTS `gauffr_credential` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gauffruser_id` int(10) NOT NULL,
  `gauffrslave_id` int(10) NOT NULL,
  `can` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gauffruser_id` (`gauffruser_id`,`gauffrslave_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `gauffr_credential`:
--   `gauffrslave_id`
--       `gauffr_slave` -> `id`
--

-- --------------------------------------------------------

--
-- Structure de la table `gauffr_log`
--

CREATE TABLE IF NOT EXISTS `gauffr_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `line` bigint(20) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gauffr_slave`
--

CREATE TABLE IF NOT EXISTS `gauffr_slave` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gauffr_userextended`
--

CREATE TABLE IF NOT EXISTS `gauffr_userextended` (
  `gauffruser_id` int(11) NOT NULL,
  `alt_login` varchar(255) NOT NULL,
  PRIMARY KEY (`gauffruser_id`),
  UNIQUE KEY `alt_login` (`alt_login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
