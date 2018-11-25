<?php
/**
 * File: /src/models/Website.php
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
 * Website class -
 * A Website, holds information about a website's login form
 * File: /src/models/Website.php
 *
 * PHP version 7
 *
 * @package  Stationer\LastWord
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/LastWord/blob/master/LICENSE
 * @link     http://github.com/stationer/LastWord
 * @see      PassiveRecord.php
 * @property int    $lww_id
 * @property int    $created_uts
 * @property int    $updated_dts
 * @property string $label
 * @property string $loginURI
 * @property string $userField
 * @property string $passField
 */
class Website extends PassiveRecord {
    protected static $table = G_DB_TABL.'Website';
    protected static $pkey = 'lww_id';
    protected static $query = '';

    protected static $vars = [
        'lww_id'      => ['type' => 'i', 'min' => 1, 'guard' => true],
        'created_uts' => ['type' => 'ts', 'min' => 0, 'guard' => true],
        'updated_dts' => ['type' => 'dt', 'def' => NOW, 'guard' => true],
        'label'       => ['type' => 's', 'max' => 255],
        'loginURI'    => ['type' => 's', 'max' => 255],
        'userField'   => ['type' => 's', 'max' => 255],
        'passField'   => ['type' => 's', 'max' => 255],
    ];
}
