<?php echo $this->render('header'); ?>
    <div class="container-fluid">
        <div class="form">
            <div class="container col-xl-8 offset-2">
                <form action="" method="post" id="lw_editForm">
                    <div class="card">
                        <div class="card-header">
                            <h3> Edit An Account</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="lwr_id" class="col-sm-2 col-form-label">Record ID</label>
                                <label class="col-sm-2 col-form-label"> <?php echo $account->lwr_id; ?></label>

                                <div class="col-sm-3">
                                    <input type="hidden" class="form-control" id="lwr_id" name="lwr_id" value="<?php echo $account->lwr_id; ?>"
                                           placeholder="<?php echo $account->lwr_id; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delete" class="col-sm-2">Delete?</label>
                                <div class="col-sm-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="delete" name="delete" value="<?php echo $account->lwr_id; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-check-label text-warning" for="delete">
                                        Warning: Deleting cannot be undone.
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="service" class="col-sm-2 col-form-label">Service Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="service" name="service"
                                           placeholder="<?php html($account->service); ?>" value="<?php html($account->service); ?>">
                                </div>
                                <div class="col-sm-6 text-warning">
                                    Warning: Changing This will result in a different password!
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control " id="username" name="username"
                                           placeholder="<?php html($account->username); ?>" value="<?php html($account->username); ?>">
                                </div>
                                <div class="col-sm-6 text-warning">
                                    Warning: Changing This will result in a different password!
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="resetCount" class="col-sm-2 col-form-label">Password #</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="resetCount" name="resetCount"
                                           value="<?php html($account->resetCount); ?>">
                                </div>
                                <div class="col-sm-6 text-warning">
                                    Warning: Changing This will result in a different password!
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passLen" class="col-sm-2 col-form-label">Password Length</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="passLen" name="passLen"
                                           value="<?php html($account->passLen); ?>"
                                           placeholder="<?php html($account->passLen); ?>">
                                </div>
                                <div class="col-sm-6 text-warning">
                                    Warning: Changing This will result in a different password!
                                </div>
                            </div>
                            <div class="border-top my-3"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Preset</label>
                                <div class="col-sm-3">
                                    <select class="custom-select" onchange="setLoginDetails(this.value);"
                                            title="Optional">
                                        <option value="">Blank/Unknown</option>
                                        <?php foreach ($Websites as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="loginURI" class="col-sm-2 col-form-label">Login URL</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="loginURI" name="loginURI"
                                           placeholder="<?php html($account->loginURI); ?>" value="<?php html($account->loginURI); ?>">
                                </div>
                                <div class="col-sm-6 text-success">
                                    Safe to change: set to the address of the Service's login
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="userField" class="col-sm-2 col-form-label">Username Field</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="userField" name="userField"
                                           value="<?php html($account->userField); ?>"
                                           placeholder="<?php html($account->userField); ?>">
                                </div>
                                <div class="col-sm-6 text-info">
                                    Advanced: set this to the form fieldname the service expects a username in
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passField" class="col-sm-2 col-form-label">Password Field</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="passField" name="passField"
                                           value="<?php html($account->passField); ?>"
                                           placeholder="<?php html($account->passField); ?>">
                                </div>
                                <div class="col-sm-6 text-info">
                                    Advanced: set this to the form fieldname the service expects a password in
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="bottom"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript"><!--
        var aLoginDetails = <?php echo json_encode($Websites); ?>;
        // --></script>
<?php echo $this->render('footer');
