<?php
	/*--HEADER--------------------------------------------------------------------------*/
	/*                                                                                  */
	/*    Project   : Live ACARS Demo PIREP Service v3.0.1                              */
	/*    Author    : Thomas Molitor                                                    */
	/*    Company   : Thomas Molitor EDV Service                                        */
	/*    Copyright : Copyright � 2002-2009 Thomas Molitor                              */
	/*                                                                                  */
	/*    Notes:  Adapted by Alejandro Garcia for VAM virtualairlinesmanager.net        */
	/*                                                                                  */
	/*                                                                                  */
	/*                                                                                  */
	/*--END-----------------------------------------------------------------------------*/
	include('../classes/class_vam_mailer.php');
	function GetNewIDPIREP($FlightNumber)
	{
		return date("dmYHis") . $FlightNumber;
	}
	if (!isset($_REQUEST["DATA2"])) die("Invalid PIREP data (no data transmitted).");
	/* ### Changed in 3.0 ### */
	$PIREP = str_replace("'" , "''" , " " . $_REQUEST["DATA2"]);
	//Get Flight Data - <FLIGHTDATA>
	$i = 0;
	$i = strpos($PIREP , "<FLIGHTDATA>" , 0);
	if ($i != false) {
		$i = $i + strlen("<FLIGHTDATA>");
		$j = $i;
		$j = strpos($PIREP , "</FLIGHTDATA>" , $j);
		if ($j != false) {
			$FlightData = trim(substr($PIREP , $i , $j - $i));
		} else {
			die("Invalid PIREP data (end tag FLIGHTDATA is missing).");
		}
	} else {
		die("Invalid PIREP data (tag FLIGHTDATA is missing)." . " " . $i);
	}
	$FlightData = str_replace("\r" , "\n" , $FlightData);
	$FlightData = str_replace("\n" , "" , $FlightData);
	//Get Flight Plan - <FLIGHTPLAN>
	$i = 0;
	$i = strpos($PIREP , "<FLIGHTPLAN>" , 0);
	if ($i != false) {
		$i = $i + strlen("<FLIGHTPLAN>");
		$j = $i;
		$j = strpos($PIREP , "</FLIGHTPLAN>" , $j);
		if ($j != false) {
			$FlightPlan = trim(substr($PIREP , $i , $j - $i));
		} else {
			die("Invalid PIREP data (end tag FLIGHTPLAN is missing).");
		}
	} else {
		die("Invalid PIREP data (tag FLIGHTPLAN is missing)." . " " . $i);
	}
	//Get Comment - <COMMENT>
	$i = 0;
	$i = strpos($PIREP , "<COMMENT>" , 0);
	if ($i != false) {
		$i = $i + strlen("<COMMENT>");
		$j = $i;
		$j = strpos($PIREP , "</COMMENT>" , $j);
		if ($j != false) {
			$Comment = trim(substr($PIREP , $i , $j - $i));
		} else {
			die("Invalid PIREP data (end tag COMMENT is missing).");
		}
	} else {
		die("Invalid PIREP data (tag COMMENT is missing)." . " " . $i);
	}
	//Get Flight Critique - <FLIGHTCRITIQUE>
	$i = 0;
	$i = strpos($PIREP , "<FLIGHTCRITIQUE>" , 0);
	if ($i != false) {
		$i = $i + strlen("<FLIGHTCRITIQUE>");
		$j = $i;
		$j = strpos($PIREP , "</FLIGHTCRITIQUE>" , $j);
		if ($j != false) {
			$FlightCritique = trim(substr($PIREP , $i , $j - $i));
		} else {
			die("Invalid PIREP data (end tag FLIGHTCRITIQUE is missing).");
		}
	} else {
		die("Invalid PIREP data (tag FLIGHTCRITIQUE is missing)." . " " . $i);
	}
	//Get Flight Maps - <FLIGHTMAPS>
	$i = 0;
	$i = strpos($PIREP , "<FLIGHTMAPS>" , 0);
	if ($i != false) {
		$i = $i + strlen("<FLIGHTMAPS>");
		$j = $i;
		$j = strpos($PIREP , "</FLIGHTMAPS>" , $j);
		if ($j != false) {
			$FlightMaps = trim(substr($PIREP , $i , $j - $i));
		} else {
			die("Invalid PIREP data (end tag FLIGHTMAPS is missing).");
		}
	} else {
		die("Invalid PIREP data (tag FLIGHTMAPS is missing)." . " " . $i);
	}
	$FlightMaps = str_replace("\r" , "\n" , $FlightMaps);
	$FlightMaps = str_replace("\n" , "" , $FlightMaps);
	//Analyze Flight Data
	$arData = explode("~" , $FlightData);
	if (count($arData) < 38) {
		die ("There are fields missing in the Flight Data (" . (count($arData) + 1) . "/39)");
	}
	//Analyze Flight Maps Data
	$arFlightMaps = explode("~" , $FlightMaps);
	/* ### Changed in 3.0 ### */
	if (count($arFlightMaps) < 5) {
		die ("There are fields missing in the Flight Maps Data (" . (count($arFlightMaps) + 1) . "/4)");
	}
	/* Connect to Database */
	include('../db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	/* ### VAM begin ### */
	// get VA parameters
	$sql = "select * from va_parameters";
	$va_name = '';
	$landing_vs_penalty1 = '';
	$landing_vs_penalty2 = '';
	$landing_penalty1 = '';
	$landing_penalty2 = '';
	$landing_crash = '';
	$plane_status_hangar = '';
	$hangar_maintenance_days = '';
	$hangar_maintenance_value = '';
	$hangar_crash_value = '';
	$hangar_crash_days = '';
	$pilot_crash_penalty = '';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$va_name = $row["va_name"];
		$landing_vs_penalty1 = $row["landing_vs_penalty1"];
		$landing_vs_penalty2 = $row["landing_vs_penalty2"];
		$landing_penalty1 = $row["landing_penalty1"];
		$landing_penalty2 = $row["landing_penalty2"];
		$flight_wear = $row["flight_wear"];
		$landing_crash = $row["landing_crash"];
		$plane_status_hangar = $row["plane_status_hangar"];
		$hangar_maintenance_days = $row["hangar_maintenance_days"];
		$hangar_maintenance_value = $row["hangar_maintenance_value"];
		$hangar_crash_value = $row["hangar_crash_value"];
		$hangar_crash_days = $row["hangar_crash_days"];
		$pilot_crash_penalty = $row["pilot_crash_penalty"];
	}
	$tipo_vuelo = '';
	$matricula = '';
	$plan_id = '';
	$call = '';
	$name = '';
	$surname = '';
	$origen = '';
	$destino = '';
	$route_id = '';
	$flight = '';
	$sql = "select * from pirepfsfk where gvauser_id='" . trim($arData[0]) . "' and OriginAirport='" . trim($arData[12]) . "' and DestinationAirport='" . trim($arData[16]) . "' and INTime='" . trim($arData[28]) . "' and OFFTime='" . trim($arData[26]) . "'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		echo '<br>THIS FLIGHT HAS BEEN ALREADY REPORTED, YOU CAN NOT REPORT DUPLICATED FLIGHTS <BR>';
	} else {
		// check if it is a charter or regular flight
		$query = 'select * from gvausers gu, routes r where gu.gvauser_id="' . trim($arData[0]) . '" and gu.route_id <> 0 and r.departure="' . substr(trim($arData[12]) , 0 , 4) . '" and r.arrival="' . substr(trim($arData[16]) , 0 , 4) . '" and gu.route_id=r.route_id;';
		$charter = 0;
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$number_of_rows = mysqli_num_rows($result);
		if ($number_of_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo 'REGULAR <BR>';
				$charter = 0;
				$plan_id = $array['route_id'];
				$call = $array['callsign'];
				$name = $array['name'];
				$route_id = $row['route_id'];
				$flight = $row['flight'];
			}
		} else {
			echo 'CHARTER <BR>';
			$charter = 1;
		}
		// Update location for pilot
		$query = 'UPDATE gvausers SET location="' . substr(trim($arData[16]) , 0 , 4) . '"where gvauser_id=' . trim($arData[0]) . ';';
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		if ($charter == 0) {
			$tipo_vuelo = 'Vuelo programado';
			// Update the plane
			$hora_vuelo = substr(trim($arData[32]) , 0 , 2);
			$hora_vuelo = str_replace("00" , "0" , $hora_vuelo);
			$minutos_vuelo = substr(trim($arData[32]) , 3 , 2);
			$minutos_vuelo = str_replace("00" , "0" , $minutos_vuelo);
			$op = (int)(100 * (int)$minutos_vuelo) / 60;
			$op_t = substr($op , 0 , 2);
			$tiempo = $hora_vuelo . '.' . $op_t;
			$vs = -1 * trim($arData[37]);
			$penalizacion_vs = 0;
			if ($vs >= $landing_crash) {
				$penalizacion_vs = 1000;
			} elseif ($vs >= $landing_vs_penalty2 && $vs < $landing_crash) {
				$penalizacion_vs = $landing_penalty2;
			} elseif ($vs >= $landing_vs_penalty1 && $vs < $landing_vs_penalty2) {
				$penalizacion_vs = $landing_penalty1;
			} else {
				$penalizacion_vs = 0;
			}
			$tiempo = substr($tiempo , 0 , -1);
			$query = 'update fleets set booked=0 ,status=status - ' . $flight_wear . ' - ' . $penalizacion_vs . ' , hours = hours + ' . $tiempo . ' , location = "' . substr(trim($arData[16]) , 0 , 4) . '" where fleet_id = (select fleet_id from  reserves where gvauser_id=' . trim($arData[0]) . ');';
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// check damage in plane and send it to the hangar if needed
			$query = 'select * from  fleets  where fleet_id = (select fleet_id from  reserves where gvauser_id=' . trim($arData[0]) . ');';
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$estado = 0;
			while ($row = $result->fetch_assoc()) {
				$estado = $row["status"];
				$avion = $row["fleet_id"];
				$matricula = $row["registry"];
				$location = $row["location"];
			}
			$pilot = trim($arData[0]);
			$origen = trim($arData[12]);
			if ($estado < $plane_status_hangar && $estado > 0) {
				$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_maintenance_days),'Mantenimiento Programado')";
				if (!$result = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "update fleets set booked=1 ,hangar=1, hangardate=now() where fleet_id=$avion";
				if (!$result = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_maintenance_value, now(),$pilot ,'Aircraft Maintenace  $matricula')";
				if (!$result = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				// Cost for the VA for the maintenance
				$query1 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values (-$hangar_maintenance_value, '99997', now(),$pilot ,'Aircraft Maintenace $matricula','SIM ACARS', '$flight')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
			if ($estado < 0) {
				$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_crash_days),'Crash')";
				if (!$result = $db->query($query1)) {
				die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "update fleets set booked=1 where fleet_id=$avion";
				if (!$result = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_crash_value, now(),$pilot ,'Aircraft Maintenace  $matricula')";
				if (!$result = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "insert into bank (gvauser_id, date,quantity,jump) values ($pilot,now(),-$pilot_crash_penalty,'Aircraft crash $matricula')";
				if (!$result = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				// cost for the crash
				$query1 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values (-$hangar_crash_value, '99996',now(),$pilot ,'Aircraft crash repair $matricula','SIM ACARS', '$flight')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
			// Desmarca al piloto
			$query = 'UPDATE gvausers SET route_id=0  where gvauser_id=' . trim($arData[0]) . ';';
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// Historico de vuelos
			$query = "insert into regular_flights_tracks (gvauser_id,date,departure,arrival,route_id, fuel,distance,fleet_id) values  (" . trim($arData[0]) . ",now(),'" . substr(trim($arData[12]) , 0 , 4) . "','" . substr(trim($arData[16]) , 0 , 4) . "',$route_id," . trim($arData[33]) . "," . trim($arData[23]) . ",'$avion');";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$tipo_vuelo = 'vuelo regular';
		} else {
			$tipo_vuelo = 'vuelo charter';
		}
		/* ### VAM end  ### */
		/* ### Changed in 3.0 ### */
		$query = "INSERT INTO pirepfsfk (IDPIREP, CreatedOn, gvauser_id, PilotName, AircraftTitle, AircraftType, TailNumber, Airline, FlightNumber, FlightLevel, FlightType, Passenger, Cargo, ZFW, OriginAirport, OriginGate, OriginRunway, OriginTA, DestinationAirport, DestinationGate, DestinationRunway, DestinationTA, AlternateAirport, SID, STAR, DistanceFlight, DistanceRoute, OUTTime, OFFTime, ONTime, INTime, DayFlightTime, NightFlightTime, BlockTime, FlightTime, BlockFuel, FlightFuel, TakeoffIAS, LandingIAS, LandingVS, FlightScore, FlightMapJPG, FlightMapWeatherJPG, FlightMapTaxiOutJPG, FlightMapTaxiInJPG, FlightMapVerticalProfileJPG, FlightMapLandingProfileJPG, FlightPlan, FlightCritique, Comment,charter,route,flight) VALUES (";
		$hora_vuelo = substr(trim($arData[32]) , 0 , 2);
		$hora_vuelo = str_replace("00" , "0" , $hora_vuelo);
		$minutos_vuelo = substr(trim($arData[32]) , 3 , 2);
		$minutos_vuelo = str_replace("00" , "0" , $minutos_vuelo);
		$minutos_vuelo = (int)$minutos_vuelo;
		if ($minutos_vuelo < 10) {
			$minutos_vuelo = $minutos_vuelo / 10;
		}
		$op = (int)(100 * (int)$minutos_vuelo) / 60;
		$op_t = substr($op , 0 , 1);
		$tiempo = $hora_vuelo . '.' . $op_t;
		$hora_vuelo = substr(trim($arData[31]) , 0 , 2);
		$hora_vuelo = str_replace("00" , "0" , $hora_vuelo);
		$minutos_vuelo = substr(trim($arData[31]) , 3 , 2);
		$minutos_vuelo = str_replace("00" , "0" , $minutos_vuelo);
		$minutos_vuelo = (int)$minutos_vuelo;
		if ($minutos_vuelo < 10) {
			$minutos_vuelo = $minutos_vuelo / 10;
		}
		$op = (int)(100 * (int)$minutos_vuelo) / 60;
		$op_t = substr($op , 0 , 1);
		$tiempo_b = $hora_vuelo . '.' . $op_t;
		//PilotID|PilotName|AircraftTitle|AircraftType|AircraftTailNumber|AircraftAirline|FlightNumber|FlightLevel|FlightType
		//   0   |    1    |      2      |      3     |         4        |       5       |      6     |     7     |     8
		//Passenger|Cargo|ZFW|OriginICAO|OriginGate|OriginRunway|OriginTransitionAltitude|DestinationICAO
		//   9     | 10  | 11|    12    |    13    |     14     |           15           |       16
		//DestinationGate|DestinationRunway|DestinationTransitionAltitude|AlternateICAO|SID|STAR|FlightDistance|RouteDistance
		//       17      |        18       |              19             |      20     | 21| 22 |      23      |     24
		//OUTTime|OFFTime|ONTime|INTime|DayFlightTime|NightFlightTime|BlockTime|FlightTime|BlockFuel|FlightFuel|TOIAS|LAIAS|ONVS|FlightScore
		//  25   |  26   |  27  |  28  |     29      |       30      |    31   |     32   |    33   |    34    |  35 |  36 | 37 |    38
		/* ### Changed v2.6 ### */
		if (strlen(trim($arData[6])) != 0) {
			$IDPIREP = GetNewIDPIREP(trim($arData[6]));
		} else {
			$IDPIREP = GetNewIDPIREP(trim($arData[0]));
		}
		$query = $query . "'" . $IDPIREP . "', ";
		$query = $query . date("YmdHis" , time()) . ", ";
		$query = $query . "'" . trim($arData[0]) . "', ";
		$query = $query . "'" . trim($arData[1]) . "', ";
		$query = $query . "'" . trim($arData[2]) . "', ";
		$query = $query . "'" . trim($arData[3]) . "', ";
		$query = $query . "'" . trim($arData[4]) . "', ";
		$query = $query . "'" . trim($arData[5]) . "', ";
		/* ### Changed v2.6 ### */
		if (strlen(trim($arData[6])) != 0) {
			$query = $query . "'" . trim($arData[6]) . "', ";
		} else {
			$query = $query . "'" . $IDPIREP . "', ";
		}
		$query = $query . "'" . trim($arData[7]) . "', ";
		$query = $query . "'" . trim($arData[8]) . "', ";
		$query = $query . "'" . trim($arData[9]) . "', ";
		$query = $query . "'" . trim($arData[10]) . "', ";
		$query = $query . "'" . trim($arData[11]) . "', ";
		$query = $query . "'" . trim($arData[12]) . "', ";
		$query = $query . "'" . trim($arData[13]) . "', ";
		$query = $query . "'" . trim($arData[14]) . "', ";
		$query = $query . "'" . trim($arData[15]) . "', ";
		$query = $query . "'" . trim($arData[16]) . "', ";
		$query = $query . "'" . trim($arData[17]) . "', ";
		$query = $query . "'" . trim($arData[18]) . "', ";
		$query = $query . "'" . trim($arData[19]) . "', ";
		$query = $query . "'" . trim($arData[20]) . "', ";
		$query = $query . "'" . trim($arData[21]) . "', ";
		$query = $query . "'" . trim($arData[22]) . "', ";
		$query = $query . "'" . trim($arData[23]) . "', ";
		$query = $query . "'" . trim($arData[24]) . "', ";
		$query = $query . "'" . trim($arData[25]) . "', ";
		$query = $query . "'" . trim($arData[26]) . "', ";
		$query = $query . "'" . trim($arData[27]) . "', ";
		$query = $query . "'" . trim($arData[28]) . "', ";
		$query = $query . "'" . trim($arData[29]) . "', ";
		$query = $query . "'" . trim($arData[30]) . "', ";
		$query = $query . "'" . trim($tiempo_b) . "', ";
		$query = $query . "'" . trim($tiempo) . "', ";
		$query = $query . "'" . trim($arData[33]) . "', ";
		$query = $query . "'" . trim($arData[34]) . "', ";
		$query = $query . "'" . trim($arData[35]) . "', ";
		$query = $query . "'" . trim($arData[36]) . "', ";
		$query = $query . "'" . trim($arData[37]) . "', ";
		$query = $query . "'" . trim($arData[38]) . "', ";
		$query = $query . "'" . trim($arFlightMaps[0]) . "', ";
		$query = $query . "'" . trim($arFlightMaps[1]) . "', ";
		$query = $query . "'" . trim($arFlightMaps[2]) . "', ";
		$query = $query . "'" . trim($arFlightMaps[3]) . "', ";
		/* ### Added in 3.0 ### */
		$query = $query . "'" . trim($arFlightMaps[4]) . "', ";
		$query = $query . "'" . trim($arFlightMaps[5]) . "', ";
		$query = $query . "'" . $FlightPlan . "', ";
		$query = $query . "'" . $FlightCritique . "', ";
		$query = $query . "'" . $Comment . "', ";
		$query = $query . "'" . $charter . "', ";
		$query = $query . "'" . $route_id . "', ";
		$query = $query . "'" . $flight . "'";
		$query = $query . ");";
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// VAM 2.5 Begin
		// Set assigned PAX and Cargo for regular flights
		if ($charter ==0)
		{
			$pax=0;
			$cargo=0;
			$query = 'select * from  reserves where gvauser_id='.trim($arData[0]).'';
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc())
			{
				$pax = $row["pax"];
				$cargo = $row["cargo"];
			}
			$query = "update pirepfsfk set Passenger = $pax , Cargo = $cargo where IDPIREP='$IDPIREP'";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// BORRA flota_reserva
			$query = 'delete from reserves where gvauser_id=' . trim($arData[0]) . ';';
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
		// VAM 2.5 End
		// Send mail to the staff
		$type='FSKEEPER PIREP';
		$mail = new vam_mailer();
		$mail->mail_flight_report_compose(trim($arData[0]),$type,trim($arData[12]),trim($arData[16]));
		print "PIREP loaded in the Virtual Airlines Manager system.<br><br>\r\n";
	}
?>