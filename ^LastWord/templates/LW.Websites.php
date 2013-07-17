<?php get_header(); ?>
        <div class="lastWord">
            <div class="form">
                <div class="top"><h3>Edit Website</h3></div>
            <form action="" method="post" id="lw_editForm">
                <table>
                    <tr>
                        <th>Choose a Website</th>
                        <td><select onchange="setLoginDetails(this.value);">
                                <option value="">Blank/Unknown</option>
<?php foreach ($Websites as $k => $v) { ?>
                                <option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
<?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Record Id</th>
                        <td><input type="text" id="lww_id" size="20" name="lww_id"></td>
                    </tr>
                    <tr>
                        <th>Delete?</th>
                        <td><input type="checkbox" name="delete" value="1"></td>
                    </tr>
                    <tr>
                        <th>Website Name</th>
                        <td><input type="text" id="label" size="20" name="label"></td>
                    </tr>
                    <tr>
                        <th>Login&nbsp;URL</th>
                        <td><input type="text" id="loginURI" size="20" name="loginURI"></td>
                    </tr>
                    <tr>
                        <th>Username&nbsp;Field</th>
                        <td><input type="text" id="userField" size="20" name="userField"></td>
                    </tr>
                    <tr>
                        <th>Password&nbsp;Field</th>
                        <td><input type="text" id="passField" size="20" name="passField"></td>
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
            //--></script>
<?php get_footer(); ?>
