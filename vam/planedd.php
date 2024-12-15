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
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$query = "select plane_icao from fleettypes order by plane_icao asc";
	if (!$result = $db->query($query)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combobit = '';
	while ($row = $result->fetch_assoc()) {
		$combobit .= " <option value='" . $row['plane_icao'] . "'>" . $row['plane_icao'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
	}
?>
