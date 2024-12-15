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
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select gva.gvauser_id, callsign, name, surname ,mes, ye,SUM(dur) as time_per_month from v_hours_counter v inner join gvausers gva
on gva.gvauser_id = v.gvauser_id
group by gvauser_id,mes order by ye asc,mes asc,time_per_month desc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	echo '<table id="pilots_hours_per_month" class="table table-hover">';
	echo '<thead>';
	echo '<tr><th>' . STATISTICS_CALLSIGN . '</th><th>' . STATISTICS_PILOT . '</th><th>' . ST_YEAR . '</th><th>' . ST_MONTH . '</th><th>' . HOURS . '</th></tr>';
	echo '</thead>';
	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>";
		echo $row["callsign"] . '</td><td>';
		echo $row["name"] . ' ' . $row["surname"] . '</td><td>';
		echo $row["ye"] . '</td><td>';
		echo $row["mes"]  . '</td><td>';
		echo number_format($row["time_per_month"],2) . '</td>';
		echo "</tr>";
	}
	echo "</table></br>";
	$db->close();
?>
