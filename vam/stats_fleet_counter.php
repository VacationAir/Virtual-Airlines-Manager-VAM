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
	$sql = "select f.registry,TRUNCATE(sum(hours),2) hrs from fleets f where hours>0 group by f.registry order by hrs desc limit 5";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	echo '<table class="table table-hover">';
	echo '<tr><th>' . VAMACARS_REGISTRY . '</th><th>' . HOURS . '</th></tr>';
	while ($row = $result->fetch_assoc()) {
		echo "<tr><td>";
		echo '<a href="./index.php?page=plane_info_public&registry_id=' . $row["registry"] . '">' . $row["registry"] . '</a></td><td>';
		echo convertTime($row["hrs"],$va_time_format) .  '</td>';
		echo "</tr>";
	}
	echo "</table></br>";
	$db->close();
?>
