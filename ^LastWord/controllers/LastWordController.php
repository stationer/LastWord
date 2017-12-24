<?php
/**
 * Main Controller for 'LastWord' Deterministic Password (Re)Generator
 * File: /^Batty/controllers/LastWordController.php
 *
 * PHP version 5.3
 *
 * @category LoneFry
 * @package  LastWord
 * @author   LoneFry <dev@lonefry.com>
 * @license  Creative Commons CC-NC-BY-SA
 * @link     http://github.com/LoneFry/LastWord
 */


/**
 * LastWordController class -
 * Main Controller for 'LastWord' Deterministic Password (Re)Generator
 * File: /^Batty/controllers/LastWordController.php
 *
 * PHP version 5.3
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

        $this->View->_link('stylesheet', 'text/css', '/^LastWord/css/lastword.css');
        $this->View->_script('/^LastWord/js/lastword.js');
        $this->View->_script('/^LastWord/js/sha1.js');
        $this->View->_script('/^LastWord/js/ajas.js');
        $this->View->_script('/^LastWord/js/ajas.util.js');
        $this->View->_script('/^LastWord/js/ajas.http.js');
        $this->View->_script('/^LastWord/js/ajas.event.js');
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
        $this->View->_template = 'LW.List.php';
        $this->View->_title    = $this->View->_siteName.' : LastWord : List';

        $Account          = $this->DB->fetch(Account::class, ['login_id' => G::$S->Login->login_id],
            ['service' => true]);
        $this->View->list = $Account;
        $this->View->json = json_encode($Account);

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
        if (isset($request['service'])
            && isset($request['loginURI'])
            && isset($request['userField'])
            && isset($request['passField'])
            && isset($request['username'])
        ) {
            $Account->service   = $request['service'];
            $Account->loginURI  = $request['loginURI'];
            $Account->userField = $request['userField'];
            $Account->passField = $request['passField'];
            $Account->username  = $request['username'];
            $Account->login_id  = G::$S->Login->login_id;

            if ('' == $Account->service) {
                G::msg('Service name must not be blank', 'error');
            } elseif ('' == $Account->username) {
                G::msg('Username must not be blank', 'error');
            } elseif (false !== $this->DB->save($Account)) {
                G::msg('Added Account');

                return $this->do_list($argv);
            } else {
                G::msg('Failed to add account.', 'error');
            }
        }
        $this->View->account  = $Account;
        $websites             = $this->DB->fetch(Website::class);
        $this->View->Websites = $websites;

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

                return $this->do_list($argv);
            } else {
                G::msg('Failed to delete account.', 'error');
            }
        }
        if (isset($request['lwr_id']) && is_numeric($request['lwr_id'])
            && isset($request['service'])
            && isset($request['loginURI'])
            && isset($request['userField'])
            && isset($request['passField'])
            && isset($request['username'])
            && isset($request['passLen'])
            && isset($request['resetCount'])
        ) {
            $Account->service       = $request['service'];
            $Account->loginURI      = $request['loginURI'];
            $Account->userField     = $request['userField'];
            $Account->passField     = $request['passField'];
            $Account->username      = $request['username'];
            $Account->passLen       = $request['passLen'];
            $Account->resetCount    = $request['resetCount'];
            $Account->iDateModified = NOW;

            if ('' == $Account->service) {
                G::msg('Service name must not be blank', 'error');
            } elseif ('' == $Account->username) {
                G::msg('Username must not be blank', 'error');
            } elseif (false !== $this->DB->save($Account)) {
                G::msg('Edited Account');

                return $this->do_list($argv);
            } else {
                G::msg('Failed to edit account.', 'error');
            }
        }
        $this->View->account  = $Account;
        $websites             = $this->DB->fetch(Website::class);
        $this->View->Websites = $websites;

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
            $Account = G::build(Website::class, $request['lww_id']);
            if (true === $Account->delete()) {
                G::msg('Deleted Website Descriptor');

                return $this->do_list($argv);
            } else {
                G::msg('Failed to delete Website Descriptor.', 'error');
            }
        }
        if (isset($request['lww_id'])
            && isset($request['label'])
            && isset($request['loginURI'])
            && isset($request['userField'])
            && isset($request['passField'])
        ) {
            if (0 == $request['lww_id']) {
                $Account = G::build(Website::class);
            } else {
                $Account = $this->DB->byPK(Website::class, $request['lww_id']);
            }
            $Account->label         = $request['label'];
            $Account->loginURI      = $request['loginURI'];
            $Account->userField     = $request['userField'];
            $Account->passField     = $request['passField'];
            $Account->iDateModified = NOW;

            if ('' == $Account->label) {
                G::msg('Website descriptor name must not be blank', 'error');
            } elseif (false !== $this->DB->save($Account)) {
                G::msg('Saved Website');

                return $this->do_list($argv);
            } else {
                G::msg('Failed to save Website.', 'error');
            }
        }
        $websites = $this->DB->fetch(Website::class);
        foreach ($websites as $k => $v) {
            $websites[$k] = $v->getAll();
        }
        $this->View->Websites = $websites;

        return $this->View;
    }

    /**
     * Ajax handler for count adjustments
     *
     * @param array $argv    Argument list passed from Dispatcher
     * @param array $request Request_method-specific parameters
     *
     * @return View
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
        $Account = $this->DB->byPK(Account::class, $request['lwr_id']);
        if (false === $Account) {
            $json['alert'] = 'Specified id was not found!';
            die(json_encode($json));
        }
        if ($Account->login_id != G::$S->Login->login_id) {
            $json['alert'] = 'Specified id was not found!';
            die(json_encode($json));
        }

        $Account->resetCount    = $request['resetCount'];
        $Account->iDateModified = NOW;
        if (false === $this->DB->save($Account)) {
            die(json_encode($json));
        } else {
            $json['success'] = true;
            die(json_encode($json));
        }
    }
}
