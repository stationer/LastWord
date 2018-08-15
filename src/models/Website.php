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

namespace Stationer\LastWord\models;

use Stationer\Graphite\data\PassiveRecord;

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
 * @property int    lww_id
 * @property string label
 * @property string loginURI
 * @property string userField
 * @property string passField
 * @property int    iDateCreated
 * @property int    iDateModified
 */
class Website extends PassiveRecord {
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
