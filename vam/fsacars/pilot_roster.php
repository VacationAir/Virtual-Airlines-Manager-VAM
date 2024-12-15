<?php
	/*
	 * You may not remove this header!
	 *
	 * -----------------------------------------------------------------------------------------------------------------------
	 * 'pilot_roster.php' script code was made by Paulo Correia - FSAcars Team (�)2003
	 * It's part of the FSAcars 2 for VA's package
	 *
	 * This script assumes that the VA has PHP support and a MySQL database on it's site
	 * ----------------------------------------------------------------------------------------------------------------------
	 *
	 * FSACARS is distributed freely.
	 *
	 * Disclaimer
	 * Although this product has been intensively tested, the authors accepts no responsibility for any damages caused by the use or misuse of this
	 * software. This software is distributed 'as is' with no warranty expressed or implied. The authors will not be responsible for any losses incurred, either directly or indirectly, by the use of this software.
	 * Use this software entirely at your own risk. If you do not agree to these terms then you must not use this software.
	 *
	 * Copyright
	 * This software is a copyrighted program. AIBridge is a copyright of Jos� Oliveira. FSACARS coding is a copyright of Jos� Oliveira. FSACARS concept was idealized by Pedro Sousa.
	 * It is protected by international copyright laws.
	 */

	/* Constants */
	include('../db_login.php');


	/* Database connection */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
			
		}

	/* Select all pilots */
	$sql = "SELECT * FROM pilots ORDER BY pilot_num ASC";
	if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
			

	/* Determine the number of pilots */
	$number = $result->num_rows;
	

	if ($number > 0) {
		/* Print roster header
		   Change this HTML to fit your webpage layout */
		print "<table>";
		print "<tr>";
		print "<td bgcolor=#000080 width=73 height=12 align=left><font face=Arial color=#FFFFFF size=1><b>NUMBER</b></font></td>";
		print "<td bgcolor=#000080 width=73 height=12 align=left><font face=Arial color=#FFFFFF size=1><b>NAME</b></font></td>";
		print "<td bgcolor=#000080 width=73 height=12 align=left><font face=Arial color=#FFFFFF size=1><b>CITY</b></font></td>";
		print "<td bgcolor=#000080 width=73 height=12 align=left><font face=Arial color=#FFFFFF size=1><b>COUNTRY</b></font></td>";
		print "<td bgcolor=#000080 width=73 height=12 align=left><font face=Arial color=#FFFFFF size=1><b>FLIGHT TIME</b></font></td>";
		print "<td bgcolor=#000080 width=73 height=12 align=left><font face=Arial color=#FFFFFF size=1><b>STATUS</b></font></td>";
		print "</tr>";
		/* Get pilots info */
		for ($i = 0 ; $i < $number ; $i++) {
			$num = mysql_result($result , $i , "pilot_num");
			$name = mysql_result($result , $i , "name");
			$city = mysql_result($result , $i , "city");
			$country = mysql_result($result , $i , "country");
			$status = mysql_result($result , $i , "status");
			$id = mysql_result($result , $i , "pilot_id");
			/* Calculate flight hours */
			$query_hours = "SELECT sec_to_time(sum(time_to_sec(t2.duration))) AS duration_sum FROM pilots t1, reports t2 WHERE t1.pilot_id=$id AND t1.pilot_id=t2.pilot_id";
			$result_hours = mysql_query($query_hours);
			if (mysql_numrows($result_hours) > 0) {
				$time = mysql_result($result_hours , 0 , "duration_sum");
			}
			/* Display roster entries */
			print "<tr>";
			print "<td width=73 height=12 align=left><font face=Arial size=1 color=#000080>$num</font></td>";
			print "<td width=73 height=12 align=left><font face=Arial size=1 color=#000080>$name</font></td>";
			print "<td width=73 height=12 align=left><font face=Arial size=1 color=#000080>$city</font></td>";
			print "<td width=73 height=12 align=left><font face=Arial size=1 color=#000080>$country</font></td>";
			print "<td width=73 height=12 align=left><font face=Arial size=1 color=#000080>$time</font></td>";
			print "<td width=73 height=12 align=left><font face=Arial size=1 color=#000080>$status</font></td>";
			print "</tr>";
		}
		print "</table>";
	}

	/* Print table footer */
	print "<table>";
	print "<tr><td><font face=Arial size=1 color=gray>Powered by FSACARS for VA's - http://www.satavirtual.org/fsacars/</font></td></tr>";
	print "</table>";

	/* Close the database connection */
	mysql_close();
?>
