<?php

require_once('admin-header.php');

if (isset($_POST['update']) ) {
	global $wpdb;
	update_option('lovedby_api_key', $_POST['lovedby_api_key']);
	echo '<div id="message" class="updated fade"><p>Your settings have been changed.</p></div>';
}

?>
<div class="wrap">
<h2>Loved.by Pro Settings</h2>
<p>To enable link affiliation you need to get your LovedBy.Pro API Key at <a href="http://lovedby.pro" target="_blank">http://lovedby.pro</a>. Log in and copy your API Key from the "account" page.</p>
<form method="post">
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><label for="lovedby_api_key">LovedBy.Pro API Key</label></th>
			<td><input style="width: 270px" type="text" name="lovedby_api_key"
				size="33" value="<?php echo get_option('lovedby_api_key'); ?>" /></td>
		</tr>


	</tbody>
</table>
<p class="submit"><input type="submit" value="Save" name="submit" /><input
	type="hidden" name="update" value="1" /></p>
</form>
</div>
