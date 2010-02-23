--
-- Structure de la table `gauffr_credential`
--

CREATE TABLE IF NOT EXISTS `gauffr_credential` (
  `gauffruser_id` int(10) NOT NULL,
  `gauffrslave_id` int(10) NOT NULL,
  `can` tinyint(1) NOT NULL,
  PRIMARY KEY  (`gauffruser_id`,`gauffrslave_id`),
  KEY `gauffrslave_id` (`gauffrslave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gauffr_log`
--

CREATE TABLE IF NOT EXISTS `gauffr_log` (
  `id` bigint(20) NOT NULL auto_increment,
  `category` varchar(255) NOT NULL,
  `file` varchar(255) default NULL,
  `line` bigint(20) default NULL,
  `message` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `gauffr_slave`
--

CREATE TABLE IF NOT EXISTS `gauffr_slave` (
  `id` int(10) NOT NULL auto_increment,
  `identifier` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gauffr_synchro`
--

CREATE TABLE IF NOT EXISTS `gauffr_synchro` (
  `id` int(10) NOT NULL auto_increment,
  `gauffruser_id` int(10) NOT NULL,
  `update_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `process_timestamp` timestamp NOT NULL default '0000-00-00 00:00:00',
  `process_code` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `gauffruser_id` (`gauffruser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gauffr_credential`
--
ALTER TABLE `gauffr_credential`
  ADD CONSTRAINT `gauffr_credential_ibfk_1` FOREIGN KEY (`gauffrslave_id`) REFERENCES `gauffr_slave` (`id`);
