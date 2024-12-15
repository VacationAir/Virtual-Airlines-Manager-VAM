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
	$notam_id = $_GET["notam_id"];
	$sql = "select * from notams where notam_id=$notam_id";
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><?php echo NOTAM; ?></div>
			<!-- Table -->
			<table class="table table-hover">
				<?php
					while ($row = $result->fetch_assoc()) {
						echo '<td>';
						echo NOTAM_NAME_PANEL . '</td>';
						echo '<td>' . $row["notam_name"] . '</td></tr><tr>';
						echo '<td>';
						echo NOTAM_CREATE_DATE . '</td>';
						echo '<td>' . $row["create_date"] . '</td></tr><tr>';
						echo '<td>';
						echo NOTAM_PUBLISH_DATE . '</td>';
						echo '<td>' . $row["publish_date"] . '</td></tr><tr>';
						echo '<td>';
						echo NOTAM_TEXT . '</td>';
						echo '<td>' . $row["notam_text"] . '</td></tr>';
					}
					echo '</table>';
					$db->close();
				?>
		</div>
	</div>
</div>
