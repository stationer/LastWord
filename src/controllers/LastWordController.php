<?php
/**
 * Main Controller for 'LastWord' Deterministic Password (Re)Generator
 * File: /src/controllers/LastWordController.php
 *
 * PHP version 7
 *
 * @package  Stationer\LastWord
 * @author   Tyler Uebele
 * @license  MIT https://github.com/stationer/LastWord/blob/master/LICENSE
 * @link     http://github.com/stationer/LastWord
 */

namespace Stationer\LastWord\controllers;
use Stationer\Graphite\Controller;
use Stationer\Graphite\data\IDataProvider;
use Stationer\Graphite\View;
use Stationer\Graphite\G;
use Stationer\LastWord\models\Website;
use Stationer\LastWord\models\Account;
/**
 * LastWordController class -
 * Main Controller for 'LastWord' Deterministic Password (Re)Generator
 * File: /src/controllers/LastWordController.php
 *
 * PHP version 7
 *
 * @category LoneFry
 * @package  LastWord
 * @author   LoneFry <dev@lonefry.com>
 * @license  Creative Commons CC-NC-BY-SA
 * @link     http://github.com/LoneFry/LastWord
 */
class LastWordController extends Controller {
    protected $action = 'intro';

    /**
     * LastWordController constructor.
     *
     * @param array         $argv Argument list passed from Dispatcher
     * @param IDataProvider $DB   DataProvider to use with Controller
     * @param View          $View Graphite View helper
     */
    public function __construct($argv = [], IDataProvider $DB = null, View $View = null) {
        parent::__construct($argv, $DB, $View);

        $path = str_replace(SITE, '', dirname(__DIR__));
        $this->View->_link('stylesheet', 'text/css', $path.'/css/lastword.css');
        $this->View->_style(str_replace(SITE, '', dirname(__DIR__).'/css/letterhead.css'));
        $this->View->_script($path.'/js/lastword.js');
        $this->View->_script($path.'/js/sha1.js');
        $this->View->_script($path.'/js/ajas.js');
        $this->View->_script($path.'/js/ajas.util.js');
        $this->View->_script($path.'/js/ajas.http.js');
        $this->View->_script($path.'/js/ajas.event.js');
        $this->View->setTemplate('subheader', 'LW.subheader.php');
    }

    /**
     * Intro Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_intro(array $argv = [], array $request = []) {
        $this->View->_template = 'LW.Intro.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord';

        return $this->View;
    }

    /**
     * FAQ Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_faq(array $argv = [], array $request = []) {
        $this->View->_template = 'LW.Faq.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord : Frequently Anticipated Questions';

        return $this->View;
    }

    /**
     * List Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_list(array $argv = [], array $request = []) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to perform this action.', 'error');

            return $this->do_intro($argv);
        }

        $Accounts = $this->DB->fetch(Account::class, ['login_id' => G::$S->Login->login_id], ['service' => true]);

        $this->View->_template = 'LW.List.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord : List';
        $this->View->Accounts  = $Accounts;
        $this->View->json      = json_encode($Accounts);

        return $this->View;
    }

    /**
     * Add Account Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_add(array $argv = [], array $request = []) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to perform this action.', 'error');

            return $this->do_intro($argv);
        }
        $this->View->_template = 'LW.Add.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord : Add New';

        $Account = G::build(Account::class, true);
        $fields = ['service', 'loginURI', 'userField', 'passField', 'username'];
        if (array_keys_exist($fields, $request)) {
            // Filter POST data to expected fields
            $request = array_intersect_key($request, array_flip($fields));
            $Account->setAll($request);
            $Account->login_id  = G::$S->Login->login_id;

            if ('' == $Account->service) {
                G::msg('Service name must not be blank', 'error');
            } elseif ('' == $Account->username) {
                G::msg('Username must not be blank', 'error');
            } elseif (false !== $this->DB->save($Account)) {
                G::msg('Added Account');
                $this->_redirect('/LastWord/list');
            } else {
                G::msg('Failed to add account.', 'error');
            }
        }
        $this->View->Websites = $this->DB->fetch(Website::class);
        $this->View->account  = $Account;

        return $this->View;
    }

    /**
     * Edit Account Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_edit(array $argv = [], array $request = []) {
        if (!G::$S || !G::$S->Login) {
            G::msg('You must be logged in to perform this action.', 'error');

            return $this->do_intro($argv);
        }
        if (!isset($argv[1]) || !is_numeric($argv[1])) {
            return $this->do_list($argv);
        }
        $this->View->_template = 'LW.Edit.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord : Edit';

        /** @var Account $Account */
        $Account = $this->DB->byPK(Account::class, $argv[1]);
        if (false === $Account || G::$S->Login->login_id != $Account->login_id) {
            G::msg('Requested LastWord Account not found', 'error');
        }

        if (isset($request['lwr_id']) && is_numeric($request['lwr_id'])
            && isset($request['delete']) && is_numeric($request['delete'])
            && $request['delete'] == $Account->lwr_id
        ) {
            $result = $this->DB->delete($Account);
            if (true === $result) {
                G::msg('Deleted Account');
                $this->_redirect('/LastWord/list');
            } else {
                G::msg('Failed to delete account.', 'error');
            }
        }
        $fields = ['service', 'loginURI', 'userField', 'passField', 'username', 'passLen', 'resetCount'];
        if (isset($request['lwr_id']) && is_numeric($request['lwr_id'])
            && array_keys_exist($fields, $request)
        ) {
            // Filter POST data to expected fields
            $request = array_intersect_key($request, array_flip($fields));
            $Account->setAll($request, true);
            $Account->updated_dts = NOW;

            if ('' == $Account->service) {
                G::msg('Service name must not be blank', 'error');
            } elseif ('' == $Account->username) {
                G::msg('Username must not be blank', 'error');
            } elseif (false !== $this->DB->save($Account)) {
                G::msg('Edited Account');
                $this->_redirect('/LastWord/list');
            } else {
                G::msg('Failed to edit account.', 'error');
            }
        }
        $this->View->account  = $Account;
        $this->View->Websites = $this->DB->fetch(Website::class);

        return $this->View;
    }

    /**
     * Website list management Page
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
     */
    public function do_websites(array $argv = [], array $request = []) {
        if (!G::$S->roleTest('LastWord/Admin')) {
            G::msg('You must be a LastWord Admin to perform this action.', 'error');

            return $this->do_intro($argv);
        }
        $this->View->_template = 'LW.Websites.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord : Websites Admin';

        if (isset($request['lww_id']) && is_numeric($request['lww_id'])
            && isset($request['delete']) && $request['delete'] == 1
        ) {
            $Website = G::build(Website::class, $request['lww_id']);
            if (true === $Website->delete()) {
                G::msg('Deleted Website Descriptor');

                return $this->do_list($argv);
            } else {
                G::msg('Failed to delete Website Descriptor.', 'error');
            }
        }
        $fields = ['lww_id', 'label', 'loginURI', 'passField', 'username'];
        if (array_keys_exist($fields, $request)) {
            if (0 == $request['lww_id']) {
                $Website = G::build(Website::class);
            } else {
                $Website = $this->DB->byPK(Website::class, $request['lww_id']);
            }
            // Filter POST data to expected fields
            $request = array_intersect_key($request, array_flip($fields));
            $Website->setAll($request, true);
            $Website->iDateModified = NOW;

            if ('' == $Website->label) {
                G::msg('Website descriptor name must not be blank', 'error');
            } elseif (false !== $this->DB->save($Website)) {
                G::msg('Saved Website');

                return $this->do_list($argv);
            } else {
                G::msg('Failed to save Website.', 'error');
            }
        }

        $this->View->Websites = $this->DB->fetch(Website::class);

        return $this->View;
    }

    /**
     * Ajax handler for count adjustments
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return Void
     */
    public function do_json(array $argv = [], array $request = []) {
        $json = ['success' => false];
        if (!G::$S || !G::$S->Login) {
            $json['alert'] = 'You must be logged in to do that!';
            die(json_encode($json));
        }

        if (!isset($request['lwr_id']) || !isset($request['resetCount'])) {
            $json['alert'] = 'Expected parameters not found!';
            die(json_encode($json));
        }
        /** @var Account $Account */
        $Account = $this->DB->byPK(Account::class, $request['lwr_id']);
        if (false === $Account) {
            $json['alert'] = 'Specified id was not found!';
            die(json_encode($json));
        }
        if ($Account->login_id != G::$S->Login->login_id) {
            $json['alert'] = 'Specified id was not found!';
            die(json_encode($json));
        }

        $Account->resetCount  = $request['resetCount'];
        $Account->updated_dts = NOW;
        if (false === $this->DB->save($Account)) {
            die(json_encode($json));
        } else {
            $json['success'] = true;
            die(json_encode($json));
        }
    }
}
