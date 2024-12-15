<?php
/**
	* @Project: Virtual Airlines Manager (VAM)
	* @Author: Alejandro Garcia
	* @Web http://virtualairlinesmanager.net
	* Copyright (c) 2013 - 2016 Alejandro Garcia
	* VAM is licensed under the following license:
	*   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	*   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
*/
?>
<?php
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
$db->set_charset("utf8");
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$sql = "select * from vampireps where gvauser_id=$id order by flight_date desc";
if (!$result = $db->query($sql)) {
    die('There was an error running the query [' . $db->error . ']');
}
?>
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
		<!-- Default panel contents -->
			<div class="panel-heading"><?php echo VAMACARS_SIMACARS; ?></div>
		<div class="table-responsive">
			<!-- Table -->
			<table class="table table-hover">
				<?php
					echo "<tr><th>" . VAMACARS_DATE . " </th><th>" . VAMACARS_DEPARTURE . "</th><th>" . VAMACARS_ARRIVAL . "</th><th>" . VAMACARS_DURATION . "</th><th>" . VAMACARS_DISTANCE . "</th>
					<th>" . VAMACARS_FUELCONSUMED . "</th><th>" . VAMACARS_DETAILS . "</th>"."</tr>";
				while ($row = $result->fetch_assoc()) {
				    echo "<td>";
				    echo $row["flight_date"] . '</td><td>';
				    echo $row["departure"] . '</td><td>';
				    echo $row["arrival"] . '</td><td>';
				    echo number_format($row["flight_duration"], 2) . '</td><td>';
				    echo $row["distance"] . '</td><td>';
				    echo $row["flight_fuel"] . '</td><td>';
				    echo '<a href="./index_vam_op.php?page=flight_details&flight_id=' . $row["flightid"] . '">' . "Information" . '</a></td>';
				    echo '</tr>';
				}
				$db->close();
				?>
			</table>
		</div>
	</div>
</div>
<div class="clearfix visible-lg"></div>
</div>
