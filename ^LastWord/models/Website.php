<?php
/**
 * File: /^LastWord/models/Website.php
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
 * Website class -
 * A Website, holds information about a website's login form
 * File: /^LastWord/models/Website.php
 *
 * PHP version 7
 *
 * @category LoneFry
 * @package  LastWord
 * @author   LoneFry <dev@lonefry.com>
 * @license  Creative Commons CC-NC-BY-SA
 * @link     http://github.com/LoneFry/LastWord
 */
class Website extends Record {
    protected static $table = G_DB_TABL.'LW_Websites';
    protected static $pkey = 'lww_id';
    protected static $query = '';

    protected static $vars = [
        'lww_id'        => ['type' => 'i', 'min' => 1, 'guard' => true],
        'label'         => ['type' => 's', 'max' => 255],
        'loginURI'      => ['type' => 's', 'max' => 255],
        'userField'     => ['type' => 's', 'max' => 255],
        'passField'     => ['type' => 's', 'max' => 255],
        'iDateCreated'  => ['type' => 'ts', 'def' => NOW, 'guard' => true],
        'iDateModified' => ['type' => 'ts', 'def' => NOW, 'guard' => true],
    ];
}
/*
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
 */
