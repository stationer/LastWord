<?php
/*****************************************************************************
 * Project     : LastWord
 *                Deterministic Password Generator
 * Created By  : LoneFry
 *                dev@lonefry.com
 * License     : CC BY-NC-SA
 *                Creative Commons Attribution-NonCommercial-ShareAlike
 *                http://creativecommons.org/licenses/by-nc-sa/3.0/
 * File        : /^LastWord/models/Service.php
 *                A Website, holds information about a website's login form
 ****************************************************************************/

require_once LIB.'/Record.php';

/*
 * Website - 
 * see Record.php for details.
 */
class Website extends Record {
	protected static $table = 'LW_Websites';
	protected static $pkey  = 'lww_id';
	protected static $query = '';
	
    public static function prime() {
		self::$table = G::$M->tabl.self::$table;
		self::$query = 'SELECT t.`lww_id`, t.`label`, t.`loginURI`, '
			.'t.`userField`, t.`passField`, t.`iDateCreated`, t.`iDateModified`'
			.' FROM `'.self::$table.'` t';
		self::$vars['iDateCreated']['def'] = NOW;
    }
	
	protected static $vars = array(
		'lww_id'        =>array('type'=>'i', 'min'=>1, 'guard'=>true),
		'label'         =>array('type'=>'s', 'max'=>255),
		'loginURI'      =>array('type'=>'s', 'max'=>255),
		'userField'     =>array('type'=>'s', 'max'=>255),
		'passField'     =>array('type'=>'s', 'max'=>255),
		'iDateCreated'  =>array('type'=>'ts'),
		'iDateModified' =>array('type'=>'ts'),
	);
}
Website::prime();
