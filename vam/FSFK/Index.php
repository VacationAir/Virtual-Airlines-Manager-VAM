<?php

	/*--HEADER--------------------------------------------------------------------------*/
	/*                                                                                  */
	/*    Project   : Live ACARS Demo Web Service v3.0.1                                */
	/*    Author    : Thomas Molitor                                                    */
	/*    Company   : Thomas Molitor EDV Service                                        */
	/*    Copyright : Copyright � 2002-2009 Thomas Molitor                              */
	/*                                                                                  */
	/*    Notes:                                                                        */
	/*                                                                                  */
	/*                                                                                  */
	/*                                                                                  */
	/*--END-----------------------------------------------------------------------------*/

	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0" , false);
	header("Pragma: no-cache");
?>

<html>

<head>
	<meta http-equiv="Content-Language" content="en-us">
	<title>FS Flight Keeper - Live ACARS Demo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<meta http-equiv="Refresh" content="60">
<meta http-equiv="Expires" content="0">
<body>

<?php

	/* ### Added v2.6 ### */
	function DateAdd($interval , $number , $date)
	{
		$date_time_array = getdate($date);
		$hours = $date_time_array['hours'];
		$minutes = $date_time_array['minutes'];
		$seconds = $date_time_array['seconds'];
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];
		switch ($interval) {
			case 'y':
			case 'yyyy':
				$year += $number;
				break;
			case 'q':
				$year += ($number * 3);
				break;
			case 'm':
				$month += $number;
				break;
			case 'd':
			case 'w':
				$day += $number;
				break;
			case 'ww':
				$day += ($number * 7);
				break;
			case 'h':
				$hours += $number;
				break;
			case 'n':
				$minutes += $number;
				break;
			case 's':
				$seconds += $number;
				break;
		}
		$timestamp = mktime($hours , $minutes , $seconds , $month , $day , $year);
		return $timestamp;
	}

	/* Connect to Database */
	$link = mysql_connect("host" , "user" , "password")
	or die("SQL Server connection failed.");

	mysql_select_db("ddb2575") or die("Database connection failed.");

	/* ### Added v2.6 ### */
	/* Delete not responding flights (LastMessage older than 30 minutes) */
	$query = "DELETE FROM liveacars WHERE LastMessage <= " . date("YmdHis" , DateAdd("n" , -30 , time())) . ";";
	$result = mysql_query($query) or die("SQL query failed");

	/* ### Changed v2.5 ### */
	// Execute SQL query
	$query = "SELECT * FROM liveacars";
	$result = mysql_query($query) or die("SQL query failed");

	if (mysql_num_rows($result) == 0) {
		print "There are currently no flights available.";
	} else {
		/* ### Added v3.0 ### */
		?>
		<u><strong>&nbsp;Current Flights&nbsp;</strong></u>
		<div align=right><a href="ACARSMap.php">&nbsp;Show Flights on Google Map&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div><BR><BR><BR>

		<?php
		while ($row = mysql_fetch_object($result)) {
			switch ($row->Status) {
				case 0:
					print "<img src=\"Images/Boarding.gif\" border=\"0\">&nbsp;Boarding";
					break;
				case 1:
					print "<img src=\"Images/Boarding.gif\" border=\"0\">&nbsp;Taxiing";
					break;
				case 2:
					print "<img src=\"Images/Airborne.gif\" border=\"0\">&nbsp;Airborne";
					break;
				case 3:
					print "<img src=\"Images/Landed.gif\" border=\"0\">&nbsp;Landed";
					break;
				case 4:
					print "<img src=\"Images/Boarding.gif\" border=\"0\">&nbsp;Parking";
					break;
			}
			switch ($row->AltitudeStatus) {
				Case 0:
					print " (Descending)";
					break;
				Case 1:
					print " (Level off)";
					break;
				Case 2:
					print " (Climbing)";
					break;
			}
			/* ### Changed v2.6 ### */
			if (strlen($row->Airline) != 0) {
				print " - " . $row->Airline;
				if (strlen($row->FlightNumber) != 0) print " (" . $row->FlightNumber . ")";
			} else if (strlen($row->FlightNumber) != 0) {
				print " - Flight " . $row->FlightNumber;
			}
			print " - " . $row->Aircraft;
			print " - Pilot " . $row->PilotName;
			if (strlen($row->Passenger) != 0) print " - Passenger " . $row->Passenger;
			if (strlen($row->Cargo) != 0) print " - Cargo " . $row->Cargo;
			print "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"Details.php?ID=" . $row->IDFlight . "\" Target=\"DETAILS\">Messages</a>";
			/* ### Added v3.0 ### */
			print "&nbsp;&nbsp;<a href=\"ACARSMap.php?ID=" . $row->IDFlight . "\">Map</a>";
			/* ### Added v2.5 ### */
			print "\r\n<BLOCKQUOTE>\r\n";
			if (strlen($row->FlightPlan) != 0) {
				$CurrentWP = $row->CurrentWaypoint;
				$FontColor = "";
				if (strlen($CurrentWP) != 0) {
					$FontColor = "<font color=\"#009933\">";
					print $FontColor;
				}
				$Plan = split("~" , $row->FlightPlan);
				for ($i = 0 ; $i < count($Plan) ; $i++) {
					if ($i != 0) {
						if (strlen($CurrentWP) == 0) {
							print " - ";
						} else {
							print "</font> - " . $FontColor;
						}
					}
					if (strtoupper($Plan[$i]) == $CurrentWP) {
						$FontColor = "<font color=\"#EE0000\">";
						print "</font><font color=\"#DD7700\">";
					}
					print $Plan[$i];
					if ($i > 0) {
						if (strtoupper($Plan[$i - 1]) == $CurrentWP) {
							$FontColor = "";
							print "</font>";
						}
					}
				}
				/* ### Changed v2.6 ### */
				if (strlen($FontColor) != 0) print "</font>";
				print "<BR><BR>";
			} /* ### Added v2.6 ### */
			else {
				if (strlen($row->OriginAirport) != 0) {
					print "\r\n<u><strong>&nbsp;Flight&nbsp;</strong></u><BR><BR>";
					print "From " . $row->OriginAirport;
					if (strlen($row->DestinationAirport) != 0) print " to " . $row->DestinationAirport;
					print "<BR><BR>";
				}
			}
			/* ### Added v2.5 ### */
			if ($row->PauseMode != 0) {
				print "\r\n<font color=\"#EE0000\"><strong><em>The Flight is currently paused.</em></strong></font><BR><BR>";
			}
			print "\r\n/POS " . $row->Position;
			if ($row->Heading != -1) print " /HDG " . sprintf("%03d" , $row->Heading);;
			/* ### Added v2.7 ### */
			if ($row->TrueHeading != -1) print " /HDT " . sprintf("%03d" , $row->TrueHeading);;
			if ($row->Altitude != -1) print " /ALT " . $row->Altitude . "ft";
			if ($row->IAS != -1) print " /IAS " . $row->IAS . "kts";
			if ($row->Status == 2 && $row->TAS != -1) print " /TAS " . $row->TAS . "kts";
			/* ### Changed v2.6 ### */
			if ($row->DistanceFlown != -1) {
				print " /DST " . $row->DistanceFlown;
				if ($row->DistancePlanned > 0) print " - " . $row->DistancePlanned . "nm";
				else print "nm";
			}
			print "\r\n</BLOCKQUOTE>";
		}
	}

	// Free resultsets
	mysql_free_result($result);

	// Close connection
	mysql_close($link);

?>

</body>
</html>
