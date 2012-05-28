<?php get_header(); ?>
		<div class="lastWord">
			<div class="form">
				<div class="top"><h3>Add A New Account</h3></div>
				<form action="" method="post" id="addForm" onsubmit="return validateAddForm();">
					<table>
						<tr>
							<td><label for="nl" title="Required">Service Name</label></td>
							<td><label for="nu" title="Required">UserName</label></td>
							<td><label for="ns" title="Optional">Service Type</label></td>
						</tr>
						<tr>
							<td><input id="nl" type="text" name="service" title="Required"></td>
							<td><input id="nu" type="text" name="username" title="Required"></td>
							<td><select id="ns" onchange="setLoginDetails(this.value);" title="Optional">
									<option value="">Blank/Unknown</option>
<?php foreach ($Websites as $k => $v) { ?>
									<option value="<?php echo $k; ?>"><?php echo $v['label']; ?></option>
<?php } ?>
								</select></td>
							<td><input type="submit" value="Add Account"></td>
						</tr>
						<tr>
							<td><label for="userField" title="Optional">Username Field</label></td>
							<td><label for="passField" title="Optional">Password Field</label></td>
							<td><label for="loginURI" title="Optional">Login URL</label></td>
						</tr>
						<tr>
							<td><input id="userField" type="text" name="userField" value="username" title="Optional"></td>
							<td><input id="passField" type="text" name="passField" value="password" title="Optional"></td>
							<td colspan="2"><input id="loginURI" type="text" name="loginURI" value="http://" size="40" title="Optional"></td>
						</tr>
					</table>
				</form>
				<div class="bottom"></div></div>
		</div>
		<script type="text/javascript"><!--
			var aLoginDetails = <?php echo json_encode($Websites); ?>;
			//--></script>
<?php get_footer(); ?>
