<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2016 Alejandro Garcia
	 * VAM is licenced under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	/* Connect to Database */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	// Execute SQL query
	$sql = "select * from staffs order by display_position asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><?php echo STAFF; ?></div>
			<!-- Table -->
			<table class="table table-hover">
			<?php while ($row = $result->fetch_assoc()) {	?>
			<tr>
				<td width="30%" align="center">
					<h4><?php echo $row["name"]; ?></h4>
					<img src="<?php echo $row["image_url"]; ?>" >
					<p>
					<p><?php echo $row["role"]; ?></p>
					<p><a href="mailto:<?php echo $row["email"]; ?>"><?php echo $row["email"]; ?></a></p>
				</td>
				<td width="70%"><?php echo $row["description"]; ?> </p></td>
			</tr>
			<?php 	
				}
				$db->close();
			?>	
		</table>
		</div>
	</div>
</div>
