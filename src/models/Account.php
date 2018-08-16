<?php
/**
 * File: /src/models/Account.php
 *
 * PHP version 7
 *
 * @package  Stationer\LastWord
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/LastWord/blob/master/LICENSE
 * @link     http://github.com/stationer/LastWord
 */

namespace Stationer\LastWord\models;

use Stationer\Graphite\data\PassiveRecord;

/**
 * Account class -
 * An Account for which the user stores/generates credentials
 * File: /src/models/Account.php
 *
 * PHP version 7
 *
 * @package  Stationer\LastWord
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/LastWord/blob/master/LICENSE
 * @link     http://github.com/stationer/LastWord
 * @see      PassiveRecord.php
 * @property int    $lwr_id
 * @property int    $created_uts
 * @property string $updated_dts
 * @property int    $login_id
 * @property string $service
 * @property string $loginURI
 * @property string $userField
 * @property string $passField
 * @property string $username
 * @property int    $resetCount
 * @property int    $passLen
 */
class Account extends PassiveRecord {
    protected static $table = G_DB_TABL.'Account';
    protected static $pkey = 'lwr_id';
    protected static $keys = ['login_id'];
    protected static $query = '';

    protected static $vars = [
        'lwr_id'      => ['type' => 'i', 'min' => 1, 'guard' => true],
        'created_uts' => ['type' => 'ts', 'min' => 0, 'guard' => true],
        'updated_dts' => ['type' => 'dt', 'min' => NOW, 'def' => NOW, 'guard' => true],
        'login_id'    => ['type' => 'i', 'min' => 1],
        'service'     => ['type' => 's', 'max' => 255],
        'loginURI'    => ['type' => 's', 'max' => 255],
        'userField'   => ['type' => 's', 'max' => 255],
        'passField'   => ['type' => 's', 'max' => 255],
        'username'    => ['type' => 's', 'max' => 255],
        'resetCount'  => ['type' => 'i', 'max' => 255],
        'passLen'     => ['type' => 'i', 'min' => 1, 'max' => 255, 'def' => 12],
    ];
}
