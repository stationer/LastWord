<?php
/** @var \Stationer\LastWord\models\Account $Account */
/** @var \Stationer\LastWord\models\Website[] $Websites */
echo $this->render('header'); ?>
    <section>
        <form action="" method="post" id="lw_editForm">
            <div class="c-card">
                <div class="header">
                    <h4>Edit An Account</h4>
                </div>
                <div class="content lastWord">
                    <div class="form-group">
                        <label>Record Id</label>
                        <?= $Account->lwr_id; ?>
                        <input type="hidden" name="lwr_id" value="<?= $Account->lwr_id; ?>">
                    </div>

                    <div class="form-group">
                        <label for="delete">Delete?</label>
                        <input type="checkbox" name="delete" id="delete" value="<?= $Account->lwr_id; ?>">
                        <span class="alert">Warning: Deleting cannot be undone.</span>
                    </div>

                    <div class="form-group">
                        <label for="service">Service Name</label>
                        <input type="text" size="20" name="service" id="service"
                               value="<?php html($Account->service); ?>">
                    </div>

                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" size="20" name="username" id="username"
                               value="<?php html($Account->username); ?>">
                    </div>

                    <div class="form-group">
                        <label for="resetCount">Password #</label>
                        <input type="number" size="20" name="resetCount" id="resetCount"
                               value="<?= $Account->resetCount; ?>">
                    </div>

                    <div class="form-group">
                        <label for="passLen">Password Length</label>
                        <input type="number" size="20" name="passLen" id="passLen"
                               value="<?= $Account->passLen; ?>">
                    </div>

                    <div class="form-group">
                        <label for="preset">Presets</label>
                        <select id="preset" onchange="setLoginDetails(this.value);" title="Optional">
                            <option value="">Blank/Unknown</option>
                            <?php foreach ($Websites as $id => $Website) { ?>
                                <option value="<?= $id; ?>"><?php html($Website['label']); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="loginURI">Login URL</label>
                        <input type="text" size="20" name="loginURI" id="loginURI"
                               value="<?php html($Account->loginURI); ?>">
                        <span class="success">Safe to change: set to the address of the Service's login <i>handler</i>.
                    </div>

                    <div class="form-group">
                        <label for="userField">Username Field</label>
                        <input type="text" size="20" name="userField" id="userField"
                               value="<?php html($Account->userField); ?>">
                        <span class="warning">Advanced: set this to the form field name the service expects a username in
                    </div>

                    <div class="form-group">
                        <label for="passField">Password Field</label>
                        <input type="text" size="20" name="passField" id="passField"
                               value="<?php html($Account->passField); ?>">
                        <span class="warning">Advanced: set this to the form field name the service expects a password in
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
