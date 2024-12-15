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

	function convert_timestamp($timestamp)
	{
		$timestring = substr($timestamp , 0 , 4) . '-' . substr($timestamp , 4 , 2) . '-' . substr($timestamp , 6 , 2) . ' ' . substr($timestamp , 8 , 2) . ':' . substr($timestamp , 10 , 2) . ':' . substr($timestamp , 12 , 2);
		return strtotime($timestring);
	}

	if (!isset($_REQUEST["ID"]))
		die("There is no FSACARS ID given.");
	$report_id = $_REQUEST["ID"];
	/* Connect to Database */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	// Execute SQL query
	$sql = "SELECT * from reports WHERE report_id = '" . $report_id . "'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><?php echo FSACARS_TRACK; ?></div>

			<!-- Table -->
			<table class="table table-hover">
				<?php
					echo '<tr><th>' . FSACARS_PARAMETER . '</th><th>' . FSACARS_VALUE . '</th></tr>';
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo FSACARS_DEPARTURE . '</td>';
						echo '<td>' . $row["origin_id"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_ARRIVAL . '</td>';
						echo '<td>' . $row["destination_id"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_FLIGHTYPE . '</td>';
						echo '<td>';
						if ($row["charter"] == 1) {
							echo FSACARS_FLIGHT_CHARTER;
						} else {
							echo FSACARS_FLIGHT_REGULAR;
						}
						echo '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_STATUS . '</td>';
						echo '<td>';
						if ($row["validated"] == 1) {
							echo FSACARS_STATUS_VALIDATED;
						} elseif ($row["validated"] == 2) {
							echo FSACARS_STATUS_REJECTED;
						} else {
							echo FSACARS_STATUS_NOVALIDATED;
						}
						echo '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_DATE . '</td>';
						echo '<td>' . $row["date"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_DURATION . '</td>';
						echo '<td>' . $row["duration"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_PLANETYPE . '</td>';
						echo '<td>' . $row["equipment"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_FUEL . '</td>';
						echo '<td>' . $row["fuel"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_DISTANCE . '</td>';
						echo '<td>' . $row["distance"] . '</td></tr><tr>';
						echo "<td>";
						echo FSACARS_TOUCHDOWN . '</td>';
						echo '<td>' . $row["LandingVS"] . ' ft/min</td></tr><tr>';
						echo "<td>";
						echo FSACARS_LOG . '</td>';
						echo '<td>' . str_replace("*" , "<br>" , $row["fsacars_log"]) . '</td></tr><tr>';
						$pos = strpos(str_replace("*" , "<br>" , $row["fsacars_log"]) , 'TouchDown:Rate');
						$pos2 = strpos(str_replace("*" , "<br>" , $row["fsacars_log"]) , 'ft/min');
						$log = str_replace("*" , "<br>" , $row["fsacars_log"]);
					}
					echo "</table>";
					$db->close();
				?>
		</div>
	</div>
</div>
