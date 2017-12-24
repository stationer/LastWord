<?php
/**
 * File: /^LastWord/models/Account.php
 *
 * PHP version 7
 *
 * @category LoneFry
 * @package  LastWord
 * @author   LoneFry <dev@lonefry.com>
 * @license  Creative Commons CC-NC-BY-SA
 * @link     http://github.com/LoneFry/LastWord
 */


/**
 * Account class -
 * An Account for which the user stores/generates credentials
 * File: /^LastWord/models/Account.php
 *
 * PHP version 7
 *
 * @category LoneFry
 * @package  LastWord
 * @author   LoneFry <dev@lonefry.com>
 * @license  Creative Commons CC-NC-BY-SA
 * @link     http://github.com/LoneFry/LastWord
 */
class Account extends Record {
    protected static $table = G_DB_TABL.'LW_Accounts';
    protected static $pkey  = 'lwr_id';
    protected static $query = '';

    protected static $vars = array(
        'lwr_id'        =>array('type'=>'i', 'min'=>1, 'guard'=>true),
        'login_id'      =>array('type'=>'i', 'min'=>1),
        'service'       =>array('type'=>'s', 'max'=>255),
        'loginURI'      =>array('type'=>'s', 'max'=>255),
        'userField'     =>array('type'=>'s', 'max'=>255),
        'passField'     =>array('type'=>'s', 'max'=>255),
        'username'      =>array('type'=>'s', 'max'=>255),
        'resetCount'    =>array('type'=>'i'),
        'passLen'       =>array('type'=>'i', 'min'=>1, 'def'=>10),
        'iDateCreated'  => array('type' => 'ts', 'def' => NOW, 'guard' => true),
        'iDateModified' => array('type' => 'ts', 'def' => NOW, 'guard' => true),
    );
}
/*
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
 */
