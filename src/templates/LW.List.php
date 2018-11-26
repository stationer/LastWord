<?php
/** @var \Stationer\LastWord\models\Account[] $Accounts */
/** @var string $json */
echo $this->render('header'); ?>
    <section>
    <div class="c-card">
        <div class="header">
            <h4>Master Key</h4>
            <a href="/LastWord/add">Add Service</a>
        </div>
        <div class="content lastWord">
            <form action="" method="post" onsubmit="return ajas.event.cancelBubble(event) && false;">
                <div>
                    <div class="form-group">
                        <label for="lastword_masterKey">Enter your Master Key here:</label>
                        <input type="password" name="" id="lastword_masterKey"
                               onkeydown="return ajas.event.catchReturn(event);"
                               onkeyup="update_();" onchange="update_();">
                    </div>
                    <span class="help" id="lastword_keyVisual"
                          title="These icons help you know if you entered your Master Key correctly."><img
                            src="/vendor/stationer/lastword/src/images/EnterKey.gif"
                            alt="Enter your Master Key to get your Passwords"
                            title="Enter your Master Key to get your Passwords"></span>
                </div>
            </form>
        </div>
    </div>
    <div class="c-card">
        <div class="header">
            <h5>Passwords</h5>
        </div>
        <div class="content lastWord">
            <table id="lastword_list">
                <thead>
                <tr>
                    <th></th>
                    <th>Resource</th>
                    <th>Username</th>
                    <th colspan="3" class="resetCount">Password&nbsp;#</th>
                    <th>Password</th>
                </tr>
                </thead>
                <tbody id="lastword_passwordList">
                <?php
                if (is_array($Accounts) && count($Accounts) > 0) {
                    foreach ($Accounts as $id => $Account) {
                        echo '
                    <tr onmouseover="this.id=\'highlight\';" onmouseout="this.id=\'\';">
                        <td><a href="/LastWord/edit/'.$Account->lwr_id.'">edit</a></td>
                        <td id="lw'.$id.'_s">'.$Account->service.'</td>
                        <td id="lw'.$id.'_u">'.$Account->username.'</td>
                        <td class="resetCount"><a href="javascript:void(0);" onclick="resetPass('.$id.',-1);return false;"><img width="16" height="16" alt="Choose Previous Password" title="Choose Previous Password" src="/vendor/stationer/lastword/src/images/down.png"></a></td>
                        <td id="lw'.$id.'_r" class="resetCount">'.$Account->resetCount.'</td>
                        <td class="resetCount"><a href="javascript:void(0);" onclick="resetPass('.$id.',1);return false;"><img width="16" height="16" alt="Choose Next Password" title="Choose Next Password" src="/vendor/stationer/lastword/src/images/up.png"></a></td>
                        <td id="lw'.$id.'_p3" class="checker2" onmouseover="this.className=\'\';" onmouseout="this.className=\'checker2\';">Enter Key</td>
                        <td>'.(strlen($Account->loginURI) < 8 ? ''
                                : '<a href="'.$Account->loginURI.'" onclick="return remoteLogin('.$id.',document.getElementById(\'lw'.$id.'_p3\').innerHTML);"><img width="16" height="16" alt="login" title="Login Remotely with the Secure password" src="/vendor/stationer/lastword/src/images/right.png"></a>').'</td>
                        <td id="lw'.$id.'_m"></td>
                    </tr>';
                    }
                } else {
                    echo '<tr><td colspan="9">You will need to add a Service above.</td></tr>';
                }
                ?>
                </tbody>
            </table>
            <form id="lwlogin" method="post" action=""><p>
                    <input type="hidden" name="username" id="lwloginUser">
                    <input type="hidden" name="password" id="lwloginPass">
                </p></form>
        </div>
    </div>
    </section>
    <script type="text/javascript"><!--
        aList =<?php echo $json; ?>;
        // --></script>
<?php echo $this->render('footer');
