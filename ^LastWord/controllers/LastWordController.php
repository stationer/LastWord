<?php
/*****************************************************************************
 * Project     : LastWord
 *                Deterministic Password Generator
 * Created By  : LoneFry
 *                dev@lonefry.com
 * License     : CC BY-NC-SA
 *                Creative Commons Attribution-NonCommercial-ShareAlike
 *                http://creativecommons.org/licenses/by-nc-sa/3.0/
 * File        : /^LastWord/controllers/LastWordController.php
 *                An Account for which the user stores/generates credentials
 ****************************************************************************/

require_once dirname(__DIR__).'/models/Account.php';
require_once dirname(__DIR__).'/models/Website.php';

/*
 * LastWordController class - 
 * Controller for "LastWord" app
 */
class LastWordController extends Controller {
    protected $action='intro';
    
    public function __construct($argv = array()) {
        parent::__construct($argv);
        
        G::$V->_link('stylesheet', 'text/css', '/^LastWord/css/lastword.css');
        G::$V->_script('/^LastWord/js/lastword.js');
        G::$V->_script('/^LastWord/js/sha1.js');
        G::$V->_script('/^LastWord/js/ajas.js');
        G::$V->_script('/^LastWord/js/ajas.util.js');
        G::$V->_script('/^LastWord/js/ajas.http.js');
        G::$V->_script('/^LastWord/js/ajas.event.js');
        G::$V->setTemplate('subheader', 'subheader.php');
    }

    public function do_intro($argv) {
        G::$V->_template = 'LW.Intro.php';
        G::$V->_title    = G::$V->_siteName.' : LastWord';
    }
    public function do_faq($argv) {
        G::$V->_template = 'LW.Faq.php';
        G::$V->_title    = G::$V->_siteName.' : LastWord : Frequently Anticipated Questions';
    }
    public function do_list($argv) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to perform this action.', 'error');
            return $this->do_intro($argv);
        }
        G::$V->_template = 'LW.List.php';
        G::$V->_title    = G::$V->_siteName.' : LastWord : List';
        
        $A = new Account(array('login_id' => G::$S->Login->login_id));
        $A = $A->search(100, 0, 'service');
        $B = array();
        foreach ($A as $k => $v) {
            $B[$k] = $v->getAll();
        }
        G::$V->list = $A;
        G::$V->json = json_encode($B);
    }
    
    public function do_add($argv) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to perform this action.', 'error');
            return $this->do_intro($argv);
        }
        G::$V->_template = 'LW.Add.php';
        G::$V->_title    = G::$V->_siteName.' : LastWord : Add New';
        
        $A = new Account(true);
        if (isset($_POST['service'])
            && isset($_POST['loginURI'])
            && isset($_POST['userField'])
            && isset($_POST['passField'])
            && isset($_POST['username'])
        ) {
            $A->service   = $_POST['service'];
            $A->loginURI  = $_POST['loginURI'];
            $A->userField = $_POST['userField'];
            $A->passField = $_POST['passField'];
            $A->username  = $_POST['username'];
            $A->login_id  = G::$S->Login->login_id;
            
            if ('' == $A->service) {
                G::msg('Service name must not be blank', 'error');
            } elseif ('' == $A->username) {
                G::msg('Username must not be blank', 'error');
            } elseif (false !== $A->save()) {
                G::msg('Added Account');
                return $this->do_list($argv);
            } else {
                G::msg('Failed to add account.', 'error');
            }
        }
        G::$V->account = $A;
        $websites = Website::all();
        foreach ($websites as $k => $v) {
            $websites[$k] = $v->getAll();
        }
        G::$V->Websites = $websites;
    }
    public function do_edit($argv) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to perform this action.', 'error');
            return $this->do_intro($argv);
        }
        if (!isset($argv[1]) || !is_numeric($argv[1])) {
            return $this->do_list($argv);
        }
        G::$V->_template = 'LW.Edit.php';
        G::$V->_title    = G::$V->_siteName.' : LastWord : Edit';
        
        if ((false === $A = Account::byId($argv[1]))
            || G::$S->Login->login_id != $A->login_id
        ) {
            G::msg('Requested LastWord Account not found', 'error');
        }
        
        if (isset($_POST['lwr_id']) && is_numeric($_POST['lwr_id'])
            && isset($_POST['delete']) && is_numeric($_POST['delete'])
            && $_POST['delete'] == $A->lwr_id
        ) {
            if (false !== $A->delete()) {
                G::msg('Deleted Account');
                return $this->do_list($argv);
            } else {
                G::msg('Failed to delete account.', 'error');
            }
        }
        if (isset($_POST['lwr_id']) && is_numeric($_POST['lwr_id'])
            && isset($_POST['service'])
            && isset($_POST['loginURI'])
            && isset($_POST['userField'])
            && isset($_POST['passField'])
            && isset($_POST['username'])
            && isset($_POST['passLen'])
            && isset($_POST['resetCount'])
        ) {
            $A->service       = $_POST['service'];
            $A->loginURI      = $_POST['loginURI'];
            $A->userField     = $_POST['userField'];
            $A->passField     = $_POST['passField'];
            $A->username      = $_POST['username'];
            $A->passLen       = $_POST['passLen'];
            $A->resetCount    = $_POST['resetCount'];
            $A->iDateModified = NOW;
            
            if ('' == $A->service) {
                G::msg('Service name must not be blank', 'error');
            } elseif ('' == $A->username) {
                G::msg('Username must not be blank', 'error');
            } elseif (false !== $A->save()) {
                G::msg('Edited Account');
                return $this->do_list($argv);
            } else {
                G::msg('Failed to edit account.', 'error');
            }
        }
        G::$V->account = $A;
        $websites = Website::all();
        foreach ($websites as $k => $v) {
            $websites[$k] = $v->getAll();
        }
        G::$V->Websites = $websites;
    }
    
    public function do_websites($argv) {
        if (!G::$S->roleTest('LastWord/Admin')) {
            G::msg('You must be a LastWord Admin to perform this action.', 'error');
            return $this->do_intro($argv);
        }
        G::$V->_template = 'LW.Websites.php';
        G::$V->_title    = G::$V->_siteName.' : LastWord : Websites Admin';

        if (isset($_POST['lww_id']) && is_numeric($_POST['lww_id'])
            && isset($_POST['delete']) && $_POST['delete'] == 1
        ) {
            $A = new Website($_POST['lww_id']);
            if (false !== $A->delete()) {
                G::msg('Deleted Website Descriptor');
                return $this->do_list($argv);
            } else {
                G::msg('Failed to delete Website Descriptor.', 'error');
            }
        }
        if (isset($_POST['lww_id'])
            && isset($_POST['label'])
            && isset($_POST['loginURI'])
            && isset($_POST['userField'])
            && isset($_POST['passField'])
        ) {
            if (0 == $_POST['lww_id']) {
                $A = new Website();
            } else {
                $A = Website::byId($_POST['lww_id']);
            }
            $A->label         = $_POST['label'];
            $A->loginURI      = $_POST['loginURI'];
            $A->userField     = $_POST['userField'];
            $A->passField     = $_POST['passField'];
            $A->iDateModified = NOW;
            
            if ('' == $A->label) {
                G::msg('Website descriptor name must not be blank', 'error');
            } elseif (false !== $A->save()) {
                G::msg('Saved Website');
                return $this->do_list($argv);
            } else {
                G::msg('Failed to save Website.', 'error');
            }
        }
        $websites = Website::all();
        foreach ($websites as $k => $v) {
            $websites[$k] = $v->getAll();
        }
        G::$V->Websites = $websites;
    }
    
    public function do_json($argv) {
        $json = array('success' => false);
        if (!G::$S || !G::$S->Login) {
            $json['alert'] = 'You must be logged in to do that!';
            die(json_encode($json));
        }
        
        if (!isset($_POST['lwr_id']) || !isset($_POST['resetCount'])) {
            $json['alert'] = 'Expected parameters not found!';
            die(json_encode($json));
        }
        
        if (false === $lwr = Account::byId($_POST['lwr_id'])) {
            $json['alert'] = 'Specified id was not found!';
            die(json_encode($json));
        }
        if ($lwr->login_id != G::$S->Login->login_id) {
            $json['alert'] = 'Specified id was not found!';
            die(json_encode($json));
        }
        
        $lwr->resetCount    = $_POST['resetCount'];
        $lwr->iDateModified = NOW;
        if (false === $lwr->save()) {
            die(json_encode($json));
        }else{
            $json['success'] = true;
            die(json_encode($json));
        }
    }
}
