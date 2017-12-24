<?php echo $this->render('header'); ?>
        <div class="lastWord">
            <div class="form">
                <div class="top"><h3>Edit An Account</h3></div>
            <form action="" method="post" id="lw_editForm">
                <table>
                    <tr>
                        <th>Record Id</th>
                        <td><?php echo $account->lwr_id; ?><input type="hidden" name="lwr_id" value="<?php echo $account->lwr_id; ?>"></td>
                    </tr>
                    <tr>
                        <th>Delete?</th>
                        <td><input type="checkbox" name="delete" value="<?php echo $account->lwr_id; ?>"></td>
                        <td class="red">Warning:  Deleting cannot be undone.</td>
                    </tr>
                    <tr>
                        <th>Service Name</th>
                        <td><input type="text" size="20" name="service" value="<?php html($account->service); ?>"></td>
                        <td class="red">Warning:  Changing This will result in a different password!</td>
                    </tr>
                    <tr>
                        <th>User Name</th>
                        <td><input type="text" size="20" name="username" value="<?php html($account->username); ?>"></td>
                        <td class="red">Warning:  Changing This will result in a different password!</td>
                    </tr>
                    <tr>
                        <th>Password&nbsp;#</th>
                        <td><input type="text" size="20" name="resetCount" value="<?php html($account->resetCount); ?>"></td>
                        <td class="red">Warning:  Changing This will result in a different password!</td>
                    </tr>
                    <tr>
                        <th>Password&nbsp;Length</th>
                        <td><input type="text" size="20" name="passLen" value="<?php html($account->passLen); ?>"></td>
                        <td class="red">Warning:  Changing This will result in a different password!</td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                        <th>Presets</th>
                        <td><select onchange="setLoginDetails(this.value);" title="Optional">
                                <option value="">Blank/Unknown</option>
<?php foreach ($Websites as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
<?php } ?>
                            </select>
                        </td>
                    <tr>
                        <th>Login&nbsp;URL</th>
                        <td><input type="text" id="loginURI" size="20" name="loginURI" value="<?php html($account->loginURI); ?>"></td>
                        <td class="green">Safe to change: set to the address of the Service's login <i>handler</i>.</td>
                    </tr>
                    <tr>
                        <th>Username&nbsp;Field</th>
                        <td><input type="text" id="userField" size="20" name="userField" value="<?php html($account->userField); ?>"></td>
                        <td class="green">Advanced: set this to the form fieldname the service expects a username in</td>
                    </tr>
                    <tr>
                        <th>Password&nbsp;Field</th>
                        <td><input type="text" id="passField" size="20" name="passField" value="<?php html($account->passField); ?>"></td>
                        <td class="green">Advanced: set this to the form fieldname the service expects a password in</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
                <div class="bottom"></div></div>
        </div>
        <script type="text/javascript"><!--
            var aLoginDetails = <?php echo json_encode($Websites); ?>;
            // --></script>
<?php echo $this->render('footer');
