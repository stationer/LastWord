
CREATE TABLE `LW_Accounts` (
  `lwr_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL DEFAULT '0',
  `service` varchar(255) NOT NULL,
  `loginURI` varchar(255) NOT NULL,
  `userField` varchar(255) NOT NULL DEFAULT 'username',
  `passField` varchar(255) NOT NULL DEFAULT 'password',
  `username` varchar(255) NOT NULL,
  `resetCount` int(11) NOT NULL DEFAULT '0',
  `passLen` int(11) NOT NULL DEFAULT '0',
  `iDateCreated` int(11) NOT NULL,
  `iDateModified` int(11) NOT NULL,
  PRIMARY KEY (`lwr_id`),
  KEY `login_id` (`login_id`)
)

CREATE TABLE `LW_Websites` (
  `lww_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `loginURI` varchar(255) NOT NULL,
  `userField` varchar(255) NOT NULL,
  `passField` varchar(255) NOT NULL,
  `iDateCreated` int(11) NOT NULL,
  `iDateModified` int(11) NOT NULL,
  PRIMARY KEY (`lww_id`)
)
