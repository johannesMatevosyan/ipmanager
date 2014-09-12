CREATE TABLE IF NOT EXISTS `stbl_subnet` (
          `Id` int(11) NOT NULL AUTO_INCREMENT,
          `ip` int(20) DEFAULT NULL,
          `hosts` int(11) DEFAULT NULL,
          `company` varchar(120) DEFAULT NULL,
          `subnet` int(11) DEFAULT NULL,
          `website` varchar(120) DEFAULT NULL,
          `vlan_id` int(11) DEFAULT NULL,
          `comments` text,
          `purpose` varchar(255) DEFAULT NULL,
          `site_id` int(11) DEFAULT NULL,
          PRIMARY KEY (`Id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;         
        INSERT INTO `stbl_subnet` (`Id`, `ip`, `hosts`, `company`, `subnet`, `website`, `vlan_id`, `comments`, `purpose`, `site_id`) VALUES(48, "200.100.11.100" , , "", 30, "", 18, "Ford Company", "Sys.admin dep", 16)