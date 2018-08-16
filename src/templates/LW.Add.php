<?php echo $this->render('header'); ?>
    <div class="lastWord">
        <div class="form">
            <div class="container col-xl-8 offset-2">
                <form action="" method="post" id="addForm" onsubmit="return validateAddForm();">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add A New Account</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nl" title="Required" class="col-sm-2 col-form-label">Service Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="nl" name="service" title="Required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nu" title="Required" class="col-sm-2 col-form-label">UserName</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="nu" name="username" title="Required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Service Type</label>
                                <div class="col-sm-3">
                                    <select class="custom-select" id="ns" name="ns" onchange="setLoginDetails(this.value);" title="Optional">
                                        <option value="">Blank/Unknown</option>
                                        <?php foreach ($Websites as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="userField" title="Optional" class="col-sm-2 col-form-label">UserName
                                    Field</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="userField" name="userField" title="Required" value="username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passField" title="Optional" class="col-sm-2 col-form-label">Password
                                    Field</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="passField" name="passField" title="Required" value="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="loginURI" title="Optional" class="col-sm-2 col-form-label">Login URL</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="loginURI" name="loginURI"
                                           value="http://" title="Optional">
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Add Account">
                            </div>
                </form>
            </div>
            <div class="bottom"></div>
        </div>
    </div>
    <script type="text/javascript"><!--
        var aLoginDetails = <?php echo json_encode($Websites); ?>;
        // --></script>
<?php echo $this->render('footer');
