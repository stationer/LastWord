<?php echo $this->render('header'); ?>
    <div class="lastWord">
        <div class="form">
            <div class="container col-xl-8 offset-2">
                <form action="" method="post" id="lw_editForm">
                    <div class="card">
                        <div class="card-header">
                            <h3>Choose a Website</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Choose a Website</label>
                                <div class="col-sm-3">
                                    <select class="custom-select" onchange="setLoginDetails(this.value);">
                                        <option value="">Blank/Unknown</option>
                                        <?php foreach ($Websites as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lww_id" class="col-sm-2 col-form-label">Record ID</label>
                                <div class="col-sm-3">
                                    <input type="hidden" class="form-control" id="lww_id" name="lww_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delete" class="col-sm-2">Delete?</label>
                                <div class="col-sm-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="delete" name="delete"
                                               value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="label" class="col-sm-2 col-form-label">Website Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="label" name="label">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="loginURI" class="col-sm-2 col-form-label">Login URL</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="loginURI" name="loginURI">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username Field</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="passField" class="col-sm-2 col-form-label">Password Field</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="passField" name="passField">
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
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
