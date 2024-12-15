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

	function GetNewIDFlight($FlightNumber)
	{
		return date("dmYHis") . $FlightNumber;
	}

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

	if (!isset($_REQUEST["DATA1"])) die("0|Invalid Data");
	if (!isset($_REQUEST["DATA2"])) die("0|Invalid Data");

	$Function = $_REQUEST["DATA2"];
	if (!isset($_REQUEST["DATA3"])) {
		$Value = "";
	} else {
		$Value = $_REQUEST["DATA3"];
	}
	if (!isset($_REQUEST["DATA4"])) {
		$Message = "";
	} else {
		$Message = $_REQUEST["DATA4"];
	}

	/* ### Changed in 3.0 ### */
	//$Function =str_replace("'", "''", $Function);
	//$Value =str_replace("'", "''", $Value);
	//$Message =str_replace("'", "''", $Message);

	/* Connect to Database */
	$link = mysql_connect("host" , "user" , "password")
	or die("0|Server connection failed");

	mysql_select_db("ddb2575") or die("0|Database connection failed");

	/* ### Added v2.6 ### */
	/* Delete not responding flights (LastMessage older than 30 minutes) */
	$query = "DELETE FROM liveacars WHERE LastMessage <= " . date("YmdHis" , DateAdd("n" , -30 , time())) . ";";
	$result = mysql_query($query) or die("0|SQL query failed");

	switch ($Function) {
		case "TEST":
			/* ### Changed v3.0 ### */
			$query = "SELECT IDPilot from pilotsfsfk WHERE IDPilot = '" . $Value . "';";
			$result = mysql_query($query) or die("0|SQL query failed");
			if (mysql_num_rows($result) == 1) {
				print "1|30";
			} else {
				print "0|Unknown ID " . $Value;
			}
			mysql_free_result($result);
			break;
		/* ### Added v3.0 ### */
		case "UPDATEFLIGHTPLAN":
			$query = "SELECT IDFlight FROM liveacars WHERE IDFlight = '" . $Value . "';";
			$result = mysql_query($query) or die("0|SQL query failed");
			if (mysql_num_rows($result) == 1) {
				mysql_free_result($result);
				$Data = split("\|" , $Message);
				if (count($Data) < 7) {
					print "0|Invalid flight plan data";
				} else {
					$query = "UPDATE liveacars SET ";
					$query = $query . "FlightPlan = '" . $Data[0] . "', ";
					$query = $query . "FPLatitudes = '" . $Data[1] . "', ";
					$query = $query . "FPLongitudes = '" . $Data[2] . "', ";
					$query = $query . "OriginAirport = '" . $Data[3] . "', ";
					$query = $query . "DestinationAirport = '" . $Data[4] . "', ";
					$query = $query . "DistancePlanned = '" . $Data[5] . "', ";
					$query = $query . "CurrentWaypoint = '" . $Data[6] . "'";
					$query = $query . " WHERE IDFlight = '" . $Value . "';";
					$result = mysql_query($query) or die("0|SQL query failed");
					print "1|";
				}
			} else {
				mysql_free_result($result);
				print "0|Unknown Flight ID";
			}
			break;
		case "BEGINFLIGHT":
			/* ### Changed v3.0 ### */
			$Data = split("\|" , $Value);
			if (count($Data) < 10) {
				print "0|Invalid login data";
			} else {
				/* ### Added v3.0 ### */
				$query = "SELECT IDPilot, FullName, Email, Password from pilotsfsfk WHERE IDPilot = '" . $Data[0] . "' AND Email = '" . $Data[1] . "' AND Password = '" . $Data[17] . "';";
				$result = mysql_query($query) or die("0|SQL query failed");
				if (mysql_num_rows($result) != 1) {
					print "0|Login failed";
				} else {
					/* ### Added v3.0 ### */
					$pilot = mysql_fetch_array($result);
					mysql_free_result($result);
					/* ### Changed v3.0 ### */
					$query = "INSERT INTO liveacars (IDFlight, IDPilot, PilotName, Status, Messages, Aircraft, Airline, FlightNumber, FlightPlan, Position, Altitude, IAS, TAS, AltitudeStatus, LastMessage, Passenger, Cargo, OriginAirport, DestinationAirport, Heading, Fuel, ZFW, Wind, OAT, FlightType, DistanceFlown, DistancePlanned, PauseMode, CurrentWaypoint, TrueHeading, FPLatitudes, FPLongitudes) VALUES (";
					$IDFlight = GetNewIDFlight($Data[2]);
					$query = $query . "'" . $IDFlight . "', ";
					$query = $query . "'" . $Data[0] . "', ";                     //IDPilot
					/* ### Changed v3.0 ### */
					//PilotName
					if (strlen($pilot[2]) != 0) {
						$query = $query . "'" . $pilot[1] . " (" . $pilot[2] . ")', ";
					} else {
						$query = $query . "'" . $pilot[1] . "', ";
					}
					$query = $query . "0" . ", ";                               //Status
					$query = $query . "''" . ", ";                              //Messages
					$query = $query . "'" . $Data[3] . "', ";                     //Aircraft
					$query = $query . "'" . $Data[4] . "', ";                     //Airline
					$query = $query . "'" . $Data[2] . "', ";                     //FlightNumber
					$query = $query . "'" . $Data[5] . "', ";                     //FlightPlan
					$query = $query . "'" . $Data[6] . "', ";                     //Position
					$query = $query . $Data[7] . ", ";                          //Altitude
					$query = $query . "-1" . ", ";                              //IAS
					$query = $query . "-1" . ", ";                              //TAS
					$query = $query . "-1" . ", ";                              //AltitudeStatus
					$query = $query . date("YmdHis" , time()) . ", ";            //LastMessage
					$query = $query . "'" . $Data[8] . "', ";                     //Passenger
					$query = $query . "'" . $Data[9] . "', ";                     //Cargo
					/* ### Added v2.5 ### */
					$CurrentWP = "''";
					//Origin and Destination Airports
					if (strlen($Data[5]) != 0) {
						$Plan = split("~" , $Data[5]);
						$query = $query . "'" . $Plan[0] . "', ";
						/* ### Added v2.5 ### */
						$CurrentWP = strtoupper("'" . $Plan[0] . "'");
						if (count($Plan) > 1) {
							$query = $query . "'" . $Plan[count($Plan) - 1] . "', ";
						} else {
							$query = $query . "''" . ", ";
						}
					} else {
						$query = $query . "''" . ", ";
						$query = $query . "''" . ", ";
					}
					/* ### Changed v2.7 ### */
					//Support for FSFK v1.0, v1.1, v1.2, v2.0, v2.5, v2.6 and v2.7
					if (count($Data) > 10) {
						//FSFK v1.1, v1.2, v2.0 and v2.5
						//Heading
						$query = $query . $Data[12] . ", ";
						//Fuel
						$query = $query . $Data[11] . ", ";
						//ZFW
						$query = $query . $Data[10] . ", ";
						//Wind
						$query = $query . "'" . $Data[13] . "', ";
						//OAT
						$query = $query . $Data[14] . ", ";
						//FlightType
						$query = $query . "'" . $Data[15] . "', ";
						if (count($Data) > 16) {
							//DistanceFlown
							$query = $query . "0, ";
							//DistancePlanned
							$query = $query . $Data[16] . ", ";
							/* ### Added v2.5 ### */
							if (count($Data) > 17) {
								//Password can be used to verify a login
								//$Password = $query.$Data[17];
							}
						} else {
							//DistanceFlown
							$query = $query . "-1" . ", ";
							//DistancePlanned
							$query = $query . "-1" . ", ";
						}
					} else {
						//FSFK v1.0
						//Heading
						$query = $query . "-1" . ", ";
						//Fuel
						$query = $query . "-1" . ", ";
						//ZFW
						$query = $query . "-1" . ", ";
						//Wind
						$query = $query . "''" . ", ";
						//OAT
						$query = $query . "-100000" . ", ";
						//FlightType
						$query = $query . "''" . ", ";
						//DistanceFlown
						$query = $query . "-1" . ", ";
						//DistancePlanned
						$query = $query . "-1" . ", ";
					}
					/* ### Changed v2.5 ### */
					//PauseMode
					$query = $query . "0, ";
					/* ### Changed v2.7 ### */
					$query = $query . $CurrentWP . ", ";
					/* ### Changed v3.0 ### */
					if (count($Data) > 18) {
						//TrueHeading
						if (strlen($Data[18]) != 0) {
							$query = $query . $Data[18] . ", ";
						} else {
							$query = $query . '-1, ';
						}
					} else {
						$query = $query . '-1, ';
					}
					/* ### Added v3.0 ### */
					if (count($Data) > 20) {
						//Flight Plan Latitudes
						$query = $query . "'" . $Data[19] . "', ";
						//Flight Plan Longitudes
						$query = $query . "'" . $Data[20] . "'";
					} else {
						$query = $query . "''" . ", ";
						$query = $query . "''";
					}
					$query = $query . ");";
					// Execute SQL query
					$result = mysql_query($query) or die("0|SQL query failed");
					print "1|" . $IDFlight;
				}
			}
			break;
		case "MESSAGE":
			/* ### Changed v2.7 ### */
			$query = "SELECT IDFlight, Messages, LastMessage, Status, AltitudeStatus, Position, Altitude, Heading, IAS, TAS, Fuel, Wind, OAT, DistanceFlown, DistancePlanned, CurrentWaypoint, TrueHeading FROM liveacars WHERE IDFlight = '" . $Value . "';";
			/* Changed for v2.0 (entire case statement!) */
			$result = mysql_query($query) or die("0|SQL query failed");
			if (mysql_num_rows($result) == 1) {
				$row = mysql_fetch_array($result , MYSQL_NUM);
				/* ### Changed v3.0 ### */
				$ACARS = $ACARS = str_replace("'" , "''" , $row[1]);
				$LastACARS = $row[2];
				$Status = $row[3];
				$AltitudeStatus = $row[4];
				$Position = $row[5];
				$Altitude = $row[6];
				$Heading = $row[7];
				$IAS = $row[8];
				$TAS = $row[9];
				$Fuel = $row[10];
				$Wind = $row[11];
				$OAT = $row[12];
				$DistanceFlown = $row[13];
				$DistancePlanned = $row[14];
				/* ### Added v2.5 ### */
				$CurrentWaypoint = $row[15];
				/* ### Added v2.7 ### */
				$TrueHeading = $row[16];
				mysql_free_result($result);
				$j = 0;
				$k = 0;
				$j = strpos($Message , "Message:\r\n" , 0);
				if ($j != false) {
					$j = $j + strlen("Message:\r\n");
					$k = strpos($Message , " " , $j);
					if ($k != false) {
						$Command = strtoupper(trim(substr($Message , $j , $k - $j)));
						switch ($Command) {
							case "OUT":
								$Status = 1;
								$AltitudeStatus = -1;
								break;
							case "OFF":
								$Status = 2;
								$AltitudeStatus = -1;
								break;
							/* ### Added v2.5 ### */
							case "TNG":
								$Status = 2;
								break;
							case "ON":
								$Status = 3;
								$AltitudeStatus = -1;
								/* ### Added v2.5 ### */
								$CurrentWaypoint = "####LANDED####";
								break;
							case "IN":
								$Status = 4;
								$AltitudeStatus = -1;
								break;
							case "POS":
								$k = 0;
								$k = strpos($Message , "\r\n" , $j);
								$j = $j + strlen("POS ");
								if ($k != false) {
									/* ### Added v2.5 ### */
									$Waypoint = trim(substr($Message , $j , $k - $j));
									/* ### Changed v2.5 ### */
									$Position = $Waypoint;
									/* ### Added v2.5 ### */
									$k = 0;
									$k = strpos($Waypoint , "[" , 0);
									if ($k != false) {
										$j = 0;
										$j = strpos($Waypoint , "]" , $k);
										if ($j != false) {
											$CurrentWaypoint = strtoupper(trim(substr($Waypoint , $k + 1 , $j - $k - 1)));
										}
									}
								}
								break;
							case "ALT":
								$k = 0;
								$j = $j + strlen("ALT ");
								$k = strpos($Message , " " , $j);
								if ($k != false) {
									$Altitude = trim(substr($Message , $j , $k - $j));
								}
								$k = strpos($Message , "DESC" , $j);
								if ($k != false) {
									$AltitudeStatus = 0;
								} else {
									$k = strpos($Message , "LEVEL" , $j);
									if ($k != false) {
										$AltitudeStatus = 1;
									} else {
										$k = strpos($Message , "CLIMB" , $j);
										if ($k != false) {
											$AltitudeStatus = 2;
										}
									}
								}
								break;
						}
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/POS " , 0);
				if ($j != false) {
					$j = $j + strlen("/POS ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Position = trim(substr($Message , $j , $k - $j));
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/HDG " , 0);
				if ($j != false) {
					$j = $j + strlen("/HDG ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Heading = trim(substr($Message , $j , $k - $j));
					}
				}
				/* ### Added v2.7 ### */
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/HDT " , 0);
				if ($j != false) {
					$j = $j + strlen("/HDT ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$TrueHeading = trim(substr($Message , $j , $k - $j));
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/ALT " , 0);
				if ($j != false) {
					$j = $j + strlen("/ALT ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Altitude = trim(substr($Message , $j , $k - $j));
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/IAS " , 0);
				if ($j != false) {
					$j = $j + strlen("/IAS ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Command = trim(substr($Message , $j , $k - $j));
						$k = 0;
						$k = strpos($Command , " " , 0);
						if ($k != false) {
							$IAS = trim(substr($Command , 0 , $k));
						} else {
							$IAS = trim($Command);
						}
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/TAS " , 0);
				if ($j != false) {
					$j = $j + strlen("/TAS ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Command = trim(substr($Message , $j , $k - $j));
						$k = 0;
						$k = strpos($Command , " " , 0);
						if ($k != false) {
							$TAS = trim(substr($Command , 0 , $k));
						} else {
							$TAS = trim($Command);
						}
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/FOB " , 0);
				if ($j != false) {
					$j = $j + strlen("/FOB ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Command = trim(substr($Message , $j , $k - $j));
						$k = 0;
						$k = strpos($Command , " " , 0);
						if ($k != false) {
							$Fuel = trim(substr($Command , 0 , $k));
						} else {
							$Fuel = trim($Command);
						}
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/WND " , 0);
				if ($j != false) {
					$j = $j + strlen("/WND ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Command = trim(substr($Message , $j , $k - $j));
						$k = 0;
						$k = strpos($Command , " " , 0);
						if ($k != false) {
							$Wind = trim(substr($Command , 0 , $k));
						} else {
							$Wind = trim($Command);
						}
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/OAT " , 0);
				if ($j != false) {
					$j = $j + strlen("/OAT ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Command = trim(substr($Message , $j , $k - $j));
						$k = 0;
						$k = strpos($Command , " " , 0);
						if ($k != false) {
							$OAT = trim(substr($Command , 0 , $k));
						} else {
							$OAT = trim($Command);
						}
					}
				}
				$j = 0;
				$k = 0;
				$j = strpos($Message , "/DST " , 0);
				if ($j != false) {
					$j = $j + strlen("/DST ");
					$k = strpos($Message , "\r\n" , $j);
					if ($k != false) {
						$Command = trim(substr($Message , $j , $k - $j));
						$k = 0;
						$k = strpos($Command , " " , 0);
						if ($k != false) {
							$DistanceFlown = trim(substr($Command , 0 , $k));
							$j = 0;
							$j = strpos($Command , "-" , 0);
							if ($j != false) {
								$DistancePlanned = trim(substr($Command , $j + 1));
							}
						} /* ### Added v2.6 ### */
						else {
							$DistanceFlown = trim($Command);
						}
					}
				}
				$ACARS = $ACARS . $Message;
				$LastACARS = date("YmdHis" , time());
				$query = "UPDATE liveacars SET ";
				$query = $query . "Messages = '" . $ACARS . "', ";
				$query = $query . "LastMessage = " . $LastACARS . ", ";
				$query = $query . "Status = '" . $Status . "', ";
				$query = $query . "AltitudeStatus = '" . $AltitudeStatus . "', ";
				$query = $query . "Position = '" . $Position . "', ";
				$query = $query . "Altitude = '" . $Altitude . "', ";
				$query = $query . "Heading = '" . $Heading . "', ";
				$query = $query . "IAS = '" . $IAS . "', ";
				$query = $query . "TAS = '" . $TAS . "', ";
				$query = $query . "Fuel = '" . $Fuel . "', ";
				$query = $query . "Wind = '" . $Wind . "', ";
				$query = $query . "OAT = '" . $OAT . "', ";
				$query = $query . "DistanceFlown = '" . $DistanceFlown . "', ";
				/* ### Changed v2.5 ### */
				$query = $query . "DistancePlanned = '" . $DistancePlanned . "', ";
				/* ### Changed v2.7 ### */
				$query = $query . "CurrentWaypoint = '" . $CurrentWaypoint . "', ";
				/* ### Added v2.7 ### */
				$query = $query . "TrueHeading = '" . $TrueHeading . "' ";
				$query = $query . " WHERE IDFlight = '" . $Value . "';";
				$result = mysql_query($query) or die("0|SQL query failed");
				print "1|";
			} else {
				mysql_free_result($result);
				print "0|Unknown Flight ID";
			}
			break;
		case "PAUSEFLIGHT":
			$query = "SELECT IDFlight FROM liveacars WHERE IDFlight = '" . $Value . "';";
			$result = mysql_query($query) or die("0|SQL query failed");
			if (mysql_num_rows($result) == 1) {
				mysql_free_result($result);
				if ($Message == "1") {
					$query = "UPDATE liveacars SET PauseMode = 1 WHERE IDFlight = '" . $Value . "';";
					$result = mysql_query($query) or die("0|SQL query failed");
				} else {
					$query = "UPDATE liveacars SET PauseMode = 0 WHERE IDFlight = '" . $Value . "';";
					$result = mysql_query($query) or die("0|SQL query failed");
				}
				print "1";
			} else {
				mysql_free_result($result);
				print "0|Unknown Flight ID";
			}
			break;
		case "ENDFLIGHT":
			$query = "DELETE FROM liveacars WHERE IDFlight = '" . $Value . "' LIMIT 1;";
			$result = mysql_query($query) or die("0|SQL query failed");
			if (mysql_affected_rows() == 1) {
				print "1";
			} else {
				print "0|Unknown Flight ID";
			}
			break;
		default:
			print "0|Wrong Function";
			break;
	}

	// Close connection
	mysql_close($link);

?>
