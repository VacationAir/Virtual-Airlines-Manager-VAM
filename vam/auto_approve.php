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
	function autopprove($p_type)
	{
		include('db_login.php');
		include('get_va_parameters.php');
		if ($auto_approval==1)
		{
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			if ($p_type=='manual')
			{
				$query = "select pirep_id as id,gvauser_id  from pireps where valid=0";
			}
			if ($p_type=='simacars')
			{
				$query = "select id,gvauser_id from vampireps where validated=0";
			}
			if ($p_type=='fsfk')
			{
				$query = "select pirepfsfk_id as id,gvauser_id  from pirepfsfk where validated=0";
			}
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$p_id =$row["id"];
				$pilot =$row["gvauser_id"];
			}
		}
	}
?>