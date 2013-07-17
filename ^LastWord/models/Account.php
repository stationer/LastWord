<?php
/*****************************************************************************
 * Project     : LastWord
 *                Deterministic Password Generator
 * Created By  : LoneFry
 *                dev@lonefry.com
 * License     : CC BY-NC-SA
 *                Creative Commons Attribution-NonCommercial-ShareAlike
 *                http://creativecommons.org/licenses/by-nc-sa/3.0/
 * File        : /^LastWord/models/Account.php
 *                An Account for which the user stores/generates credentials
 ****************************************************************************/

require_once LIB.'/Record.php';

/*
 * Account - 
 * see Record.php for details.
 */
class Account extends Record {
    protected static $table = 'LW_Accounts';
    protected static $pkey  = 'lwr_id';
    protected static $query = '';
    
    public static function prime() {
        self::$table = G::$M->tabl.self::$table;
        self::$query = 'SELECT t.`lwr_id`, t.`login_id`, t.`service`,'
            .' t.`loginURI`, t.`userField`, t.`passField`, t.`username`,'
            .' t.`resetCount`, t.`passLen`, t.`iDateCreated`, t.`iDateModified`'
            .' FROM `'.self::$table.'` t';
        self::$vars['iDateCreated']['def'] = NOW;
    }
    
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
        'iDateCreated'  =>array('type'=>'ts'),
        'iDateModified' =>array('type'=>'ts'),
    );
}
Account::prime();
