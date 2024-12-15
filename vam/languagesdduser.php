<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 Alejandro Garcia
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
	$sql = "select * from gvausers where gvauser_id=$id";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$language_user = $row["language"];
		$hub_user = $row["hub_id"];
	}
	$sql = "select language_name, file_sufix from languages order by language_name asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	$combolanguage = '';
	while ($row = $result->fetch_assoc()) {
		if ($row['file_sufix'] == $language_user)
		{
			$combolanguage .= " <option selected=selected  value='" . $row['file_sufix'] . "'>" . $row['language_name'] . "</option>";
		}
		$combolanguage .= " <option value='" . $row['file_sufix'] . "'>" . $row['language_name'] . "</option>";
	}

 // GET combo for Hubs
 	$sql = "select hub_id, hub from hubs order by hub asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combo_hub_user = '';
	while ($row = $result->fetch_assoc()) {
		if ($row['hub_id'] == $hub_user)
		{
			$combo_hub_user .= " <option selected=selected  value='" . $row['hub_id'] . "'>" . $row['hub'] . "</option>";
		}
		$combo_hub_user .= " <option value='" . $row['hub_id'] . "'>" . $row['hub'] . "</option>";
	}
?>