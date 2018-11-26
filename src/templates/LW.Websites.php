<?php
/** @var \Stationer\LastWord\models\Website[] $Websites */
echo $this->render('header'); ?>
    <section>
        <form action="" method="post" id="lw_editForm">
            <div class="c-card">
                <div class="header">
                    <h4>Edit Website</h4>
                </div>
                <div class="content lastWord">
                    <div class="form-group">
                        <label for="websites">Choose a Website</label>
                        <select id="websites" onchange="setLoginDetails(this.value);">
                            <option value="">Blank/Unknown</option>
                            <?php foreach ($Websites as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lww_id">Record Id</label>
                        <input type="text" id="lww_id" size="20" name="lww_id">
                    </div>

                    <div class="form-group">
                        <label for="delete">Delete?</label>
                        <input type="checkbox" id="delete" name="delete" value="1">
                    </div>

                    <div class="form-group">
                        <label for="label">Website Name</label>
                        <input type="text" id="label" size="20" name="label">
                    </div>

                    <div class="form-group">
                        <label for="loginURI">Login URL</label>
                        <input type="text" id="loginURI" size="20" name="loginURI">
                    </div>

                    <div class="form-group">
                        <label for="userField">Username Field</label>
                        <input type="text" id="userField" size="20" name="userField">
                    </div>

                    <div class="form-group">
                        <label for="passField">Password Field</label>
                        <input type="text" id="passField" size="20" name="passField">
                    </div>
                </div>
                <div class="footer">
                    <div class="buttons">
                        <input type="submit" class="c-btn" value="Save Account">
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script type="text/javascript"><!--
        var aLoginDetails = <?php echo json_encode($Websites); ?>;
        // --></script>
<?php echo $this->render('footer');
