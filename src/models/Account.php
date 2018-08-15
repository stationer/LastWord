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

namespace Stationer\LastWord\models;

use Stationer\Graphite\data\PassiveRecord;

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
 * @property int    lwr_id
 * @property int    login_id
 * @property string service
 * @property string loginURI
 * @property string userField
 * @property string passField
 * @property string username
 * @property int    resetCount
 * @property int    passLen
 * @property int    iDateCreated
 * @property int    iDateModified
 */
class Account extends PassiveRecord {
    protected static $table = G_DB_TABL.'LW_Accounts';
    protected static $pkey = 'lwr_id';
    protected static $query = '';

    protected static $vars = [
        'lwr_id'        => ['type' => 'i', 'min' => 1, 'guard' => true],
        'login_id'      => ['type' => 'i', 'min' => 1],
        'service'       => ['type' => 's', 'max' => 255],
        'loginURI'      => ['type' => 's', 'max' => 255],
        'userField'     => ['type' => 's', 'max' => 255],
        'passField'     => ['type' => 's', 'max' => 255],
        'username'      => ['type' => 's', 'max' => 255],
        'resetCount'    => ['type' => 'i'],
        'passLen'       => ['type' => 'i', 'min' => 1, 'def' => 10],
        'iDateCreated'  => ['type' => 'ts', 'def' => NOW, 'guard' => true],
        'iDateModified' => ['type' => 'ts', 'def' => NOW, 'guard' => true],
    ];
}
