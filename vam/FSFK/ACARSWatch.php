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
	$link = mysql_connect("host" , "user" , "password") or die("");

	mysql_select_db("ddb2575") or die("");

	/* ### Added v2.6 ### */
	/* Delete not responding flights (LastMessage older than 30 minutes) */
	$query = "DELETE FROM liveacars WHERE LastMessage <= " . date("YmdHis" , DateAdd("n" , -30 , time())) . ";";
	$result = mysql_query($query) or die("");

	$Version12AndHigher = False;

	/* ### Added v2.0 ### */
	$Version20AndHigher = False;

	if (isset($_REQUEST["DATA1"])) {
		$FSFKID = split("\|" , $_REQUEST["DATA1"]);
		if (count($FSFKID) == 2) {
			if ($FSFKID[0] == "FLKEEPER") {
				$FSFKVersion = split("\." , $FSFKID[1]);
				if (count($FSFKVersion) == 2) {
					if ($FSFKVersion[0] >= 1 && $FSFKVersion[1] >= 2) $Version12AndHigher = True;
					/* ### Added v2.0 ### */
					if ($FSFKVersion[0] >= 2 && $FSFKVersion[1] >= 0) {
						$Version12AndHigher = True;
						$Version20AndHigher = True;
					}
				}
			}
		}
	}

	/* ### Changed v3.0 ### */
	// Execute SQL query
	$query = "SELECT IDFlight, IDPilot, PilotName, Airline, FlightNumber, Aircraft, OriginAirport, DestinationAirport, Position, Altitude, Heading, IAS, TAS, ZFW, Fuel, Status, AltitudeStatus, Passenger, Cargo, Wind, OAT, FlightType, FlightPlan, DistanceFlown, DistancePlanned, PauseMode, CurrentWaypoint, TrueHeading, FPLatitudes, FPLongitudes FROM liveacars";
	$result = mysql_query($query) or die("");

	while ($row = mysql_fetch_array($result , MYSQL_NUM)) {
		$value = $row[0] . "|";                       //IDFlight
		$value = $value . $row[1] . "|";                //IDPilot
		$value = $value . $row[2] . "|";                //PilotName
		/* ### Changed v2.6 ### */
		if (strlen($row[3]) != 0) { //Airline + FlightNumber
			$value = $value . $row[3];
			if (strlen($row[4]) != 0) $value = $value . " " . $row[4];
		} else if (strlen($row[4]) != 0) {
			$value = $value . $row[4];
		} else {
			$value = $value . $row[2] . " (" . $row[1] . ")";
		}
		$value = $value . "|";
		$value = $value . $row[5] . "|";                //Aircraft
		$value = $value . $row[6] . "|";                //OriginAirport
		$value = $value . $row[7] . "|";                //DestinationAirport
		$data = split(" " , $row[8]);                    //Position (Latitude/Longitude)
		if (count($data) >= 4) {
			$value = $value . $data[0] . " " . $data[1] . "|" . $data[2] . " " . $data[3] . "|";
		} else {
			$value = $value . "||";
		}
		//Altitude
		if ($row[9] != -100000) {
			$value = $value . $row[9] . " ft|";
		} else {
			$value = $value . "|";
		}
		//Heading
		if ($row[10] != -1) {
			$value = $value . $row[10] . "|";
		} else {
			$value = $value . "|";
		}
		//IAS
		if ($row[11] != -1) {
			$value = $value . $row[11] . " kts|";
		} else {
			$value = $value . "|";
		}
		if ($Version12AndHigher) {
			//TAS, but only if airborne
			if ($row[12] != -1 && $row[15] == 2) {
				$value = $value . $row[12] . " kts|";
			} else {
				$value = $value . "|";
			}
		}
		//ZFW
		if ($row[13] != -1) {
			$value = $value . $row[13] . " lbs|";
		} else {
			$value = $value . "|";
		}
		//Fuel
		if ($row[14] != -1) {
			$value = $value . $row[14] . " lbs|";
		} else {
			$value = $value . "|";
		}
		/* ### Entire Switch Statement Changed v2.5 ### */
		switch ($row[15]) {
			Case 0:
				$value = $value . "Boarding";
				break;
			Case 1:
				$value = $value . "Taxiing";
				break;
			Case 2:
				$value = $value . "Airborne";
				//AltitudeStatus
				switch ($row[16]) {
					Case 0:
						$value = $value . " (Descending)";
						break;
					Case 1:
						$value = $value . " (Level off)";
						break;
					Case 2:
						$value = $value . " (Climbing)";
						break;
				}
				break;
			Case 3:
				$value = $value . "Landed";
				break;
			Case 4:
				$value = $value . "Parking";
				break;
		}
		if ($row[25] != 0) {
			$value = $value . " [PAUSED]";
		}
		$value = $value . "|";
		//BlockTimes - Not available in this sample
		$value = $value . "|";
		$value = $value . "|";
		$value = $value . $row[17] . "|";               //Passenger
		$value = $value . $row[18] . "|";               //Cargo
		//Wind
		if (strlen($row[19]) < 5) {
			$value = $value . "|";
		} else {
			$value = $value . substr($row[19] , 0 , 3) . "/" . substr($row[19] , 3) . "|";
		}
		if ($row[20] != -100000) {
			$value = $value . $row[20] . "|";
		} else {
			$value = $value . "|";
		}
		$value = $value . $row[21] . "|";                       //FlightType
		/* Changed v2.5 ### */
		$FlightPlan = $row[22]; //FlightPlan
		if (strlen($row[26]) > 0) { //CurrentWaypoint available?
			$FlightPlan = str_replace($row[26] , "[" . $row[26] . "]" , $FlightPlan);
		}
		$value = $value . str_replace("~" , " - " , $FlightPlan);
		/* ### Changed v2.7 ### */
		if ($Version20AndHigher) {
			$value = $value . "|";
			//Distance flown
			if ($row[23] != -1) {
				$value = $value . $row[23] . "nm|";
			} else {
				$value = $value . "0nm|";
			}
			/* Changed v2.7 ### */
			//Distance planned
			if ($row[24] != -1) {
				$value = $value . $row[24] . "nm";
			} else {
				$value = $value . "NA";
			}
			/* Added v2.7 ### */
			if ($row[27] != -1) {   //TrueHeading
				$value = $value . "|" . $row[27];
			} /* Added v3.0 ### */
			else {
				$value = $value . "|";
			}
			/* Added v3.0 ### */
			$value = $value . "|" . $row[28];  //FPLatitudes
			$value = $value . "|" . $row[29];  //FPLongitudes
		}
		print $value . "\r\n";
	}

	// Free resultsets
	mysql_free_result($result);

	// Close connection
	mysql_close($link);

?>
