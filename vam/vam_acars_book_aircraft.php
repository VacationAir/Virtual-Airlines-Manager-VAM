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
	$data = json_decode(file_get_contents('php://input'), true);
	$pilot = strtoupper($data["pilot"]);
	$password = $data["password"];
	$registry = $data["aircraft"];
	$Encrypt_Pass = md5($password);
	$exists = 0;
	$gvauser='';
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
		$sql = "SELECT * FROM gvausers where activation=1 and UPPER(callsign)='" . $pilot . "' and password='" . $Encrypt_Pass . "'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$exists = 1;
		$gvauser = $row["gvauser_id"];
	}
	if ($exists != 0)
	{
		$sql = "update fleets set booked=1, booked_at = now(), gvauser_id=$gvauser where registry='$registry'";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	}
	$db->close();
?>