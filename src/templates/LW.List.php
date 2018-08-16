<?php echo $this->render('header'); ?>
    <div class="container-fluid">
        <div class="form">
            <div>
                <a style="float:right;" href="/LastWord/add">Add Service</a>
                <h3>Master Key</h3>
            </div>
            <form action="" method="post" onsubmit="return ajas.event.cancelBubble(event) && false;"><div>
                    <label for="lastword_masterKey">Enter your Master Key here:</label>
                    <input type="password" name="" id="lastword_masterKey" onkeydown="return ajas.event.catchReturn(event);"
                           onkeyup="update_();" onchange="update_();">
                    <span class="help" id="lastword_keyVisual" title="These icons help you know if you entered your Master Key correctly."><img src="/^LastWord/images/EnterKey.gif" alt="Enter your Master Key to get your Passwords" title="Enter your Master Key to get your Passwords"></span>
                </div></form>
            <div class="bottom"></div></div>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th></th>
                <th scope="col">Resource</th>
                <th scope="col">Username</th>
                <th colspan="3" class="resetCount">Password&nbsp;#</th>
                <th scope="col">Password</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="lastword_passwordList">
            <?php
            if (is_array($list) && count($list) > 0)
                foreach ($list as $k => $v){
                    echo '
                    <tr onmouseover="this.id=\'highlight\';" onmouseout="this.id=\'\';">
                        <td><a href="/LastWord/edit/'.$v->lwr_id.'">edit</a></td>
                        <td id="lw'.$k.'_s">'.$v->service.'</td>
                        <td id="lw'.$k.'_u">'.$v->username.'</td>
                        <td class="resetCount"><a href="javascript:void(0);" onclick="resetPass('.$k.',-1);return false;"><img width="16" height="16" alt="Choose Previous Password" title="Choose Previous Password" src="/assets/svgs/solid/arrow-down.svg"></a></td>
                        <td id="lw'.$k.'_r" class="resetCount">'.$v->resetCount.'</td>
                        <td class="resetCount"><a href="javascript:void(0);" onclick="resetPass('.$k.',1);return false;"><img width="16" height="16" alt="Choose Next Password" title="Choose Next Password" src="/assets/svgs/solid/arrow-up.svg"></a></td>
                        <td id="lw'.$k.'_p3" class="checker2" onmouseover="this.className=\'\';" onmouseout="this.className=\'checker2\';">Enter Key</td>
                        <td>'.(strlen($v->loginURI)<8?'':'<a href="'.$v->loginURI.'" onclick="return remoteLogin('.$k.',document.getElementById(\'lw'.$k.'_p3\').innerHTML);"><img width="16" height="16" alt="login" title="Login Remotely with the Secure password" src="/assets/svgs/solid/arrow-right.svg"></a>').'</td>
                        <td id="lw'.$k.'_m"></td>
                    </tr>';
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
    <script type="text/javascript"><!--
        aList=<?php echo $json; ?>;
        // --></script>
<?php echo $this->render('footer');
