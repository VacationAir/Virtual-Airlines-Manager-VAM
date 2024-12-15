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
	require('check_login.php');
	if (is_logged())
	{
		$id=$_SESSION["id"];
		if ($id !='')
		{
			$pirep_id = $_GET['pirep_id'];
			$departure = $_GET['departure'];
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			$sql = "delete from pireps where pirep_id=$pirep_id and gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$sql = "update gvausers set location='$departure' where gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$db->close();
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_vam.php">';
		}
	}
	else
	{
		include("./notgranted.php");
	}
?>