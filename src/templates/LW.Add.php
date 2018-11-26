<?php
/** @var \Stationer\LastWord\models\Website[] $Websites */
echo $this->render('header'); ?>
    <section>
        <form action="" method="post" id="addForm" onsubmit="return validateAddForm();">
            <div class="c-card">
                <div class="header">
                    <h4>Add A New Account</h4>
                </div>
                <div class="content lastWord">
                    <div class="form-group">
                        <label for="nl" title="Required">Service Name</label>
                        <input id="nl" type="text" name="service" title="Required">
                    </div>
                    <div class="form-group">
                        <label for="nu" title="Required">UserName</label>
                        <input id="nu" type="text" name="username" title="Required">
                    </div>
                    <div class="form-group">
                        <label for="ns" title="Optional">Service Type</label>
                        <select id="ns" onchange="setLoginDetails(this.value);" title="Optional">
                            <option value="">Blank/Unknown</option>
                            <?php foreach ($Websites as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userField" title="Optional">Username Field</label>
                        <input id="userField" type="text" name="userField" value="username" title="Optional">
                    </div>
                    <div class="form-group">
                        <label for="passField" title="Optional">Password Field</label>
                        <input id="passField" type="text" name="passField" value="password" title="Optional">
                    </div>
                    <div class="form-group">
                        <label for="loginURI" title="Optional">Login URL</label>
                        <input id="loginURI" type="text" name="loginURI" value="http://" size="40" title="Optional">
                    </div>
                </div>
                <div class="footer">
                    <div class="buttons">
                        <input type="submit" class="c-btn" value="Add Account">
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script type="text/javascript"><!--
        var aLoginDetails = <?php echo json_encode($Websites); ?>;
        // --></script>
<?php echo $this->render('footer');
