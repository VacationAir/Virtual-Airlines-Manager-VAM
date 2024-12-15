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
	$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_apps_white_18dp_1x.png">&nbsp;<?php echo VA_PARAMETERS; ?></div>

			<!-- Table -->
			<table class="table table-hover">
				<?php
					echo "<tr><th>" . PARAMETER . "</th><th>" . VALUE . "</th></tr>";
					while ($row = $result->fetch_assoc()) {
						echo '<td>';
						echo COST_SHORT_JUMP . '</td>';
						echo '<td>' . $row["jump_type1"] . '</td></tr><tr>';
						echo '<td>';
						echo COST_MEDIUM_JUMP . '</td>';
						echo '<td>' . $row["jump_type2"] . '</td></tr><tr>';
						echo '<td>';
						echo COST_LONG_JUMP . '</td>';
						echo '<td>' . $row["jump_type3"] . '</td></tr><tr>';
						echo '<td>';
						echo PLANE_STATUS_MAINTENANCE . '</td>';
						echo '<td>' . $row["plane_status_hangar"] . ' % </td></tr><tr>';
						echo '<td>';
						echo LANDING_RATE_CRASH . '</td>';
						echo '<td>' . $row['landing_crash'] . ' ft/min </td></tr><tr>';
						echo '<td>';
						echo STATUS_LOST_1 . $row["landing_vs_penalty1"] . ' ft/min</td>';
						echo '<td>' . $row["landing_penalty1"] . ' % </td></tr><tr>';
						echo '<td>';
						echo STATUS_LOST_2 . $row["landing_vs_penalty1"] . ' ft/min ' . AND_STRING . $row["landing_vs_penalty2"] . ' ft/min</td>';
						echo '<td>' . $row["landing_penalty2"] . ' % </td></tr><tr>';
						echo '<td>';
						echo STATUS_LOST_2 . $row["landing_vs_penalty2"] . ' ft/min  ' . AND_STRING . $row["landing_crash"] . ' ft/min</td>';
						echo '<td>' . $row["landing_penalty3"] . ' % </td></tr><tr>';
						echo '<td>';
						echo MINIMUN_AIRCRAFT_WEAR . '</td>';
						echo '<td>' . $row['flight_wear'] . ' % </td></tr><tr>';
						echo '<td>';
						echo AIRCRAFT_MAINTENANCE_DURATION . '</td>';
						echo '<td>' . $row['hangar_maintenance_days'] . DAYS . '</td></tr><tr>';
						echo '<td>';
						echo AIRCRAFT_REPARATION_DURATION . '</td>';
						echo '<td>' . $row['hangar_crash_days'] . DAYS . '</td></tr><tr>';
						echo '<td>';
						echo PENALTY_IN_CRASH . '</td>';
						echo '<td>' . $row['pilot_crash_penalty'] . ' ' . $row['currency'] . ' </td></tr><tr>';
						echo '<td>';
						echo SALARY_PER_HOUR_FOR_YOUR_RANK . '</td>';
						echo '<td>' . $salary_hour . ' ' . $row['currency'] . '</td></tr><tr>';
						echo '<td>';
						echo SALARY_REDUCTION_CHARTER . '</td>';
						echo '<td>' . $row['charter_reduction'] . ' % </td></tr><tr>';
					}
					echo '</table>';
					$db->close();
				?>
		</div>
	</div>
</div>
