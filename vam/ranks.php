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
	$planetype = '';
	$planelocation = '';
	$panel_title = TOURS_VA;
	$sql = "select * from ranks order by minimum_hours asc";
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
			<div class="panel-heading"><IMG src="images/icons/ic_photo_filter_white_18dp_1x.png">&nbsp;<?php echo RANK_PANEL; ?></div>
			<br>
			<!-- Table -->
			<table id="ranks" class="table table-hover">
					<?php
						echo '<thead>';
						echo "<tr><th>" . RANK . "</th><th>" . RANK_IMAGE . "</th><th>" . RANK_MIN_HOURS . "</th><th>" . RANK_MAX_HOURS . "</th><th>" . PILOT_SALARY . "</th></tr>";
						echo '</thead>';
						while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo $row["rank"] . '</td><td>';
						echo '<IMG src="'.$row["image_url"].'" ALT="">'. '</td><td>';
						echo $row["minimum_hours"] . '</td><td>';
						echo $row["maximum_hours"] . '</td><td>';
						echo $row["salary_hour"] . '</td></tr>';
					}
					$db->close();
					?>
			</table>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
