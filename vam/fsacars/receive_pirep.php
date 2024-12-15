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
	function CheckFSAcarsInfo()
	{
		// Verify input
		if (!isset($_GET['pilot'])) {
			return 0;
		}
		// Request is not empty
		return 1;
	}
	function GetFSAcarsInfo()
	{
		/* ************************************************************************************************
		   @GetFSAcarsInfo
		   Receives inputs sent by FSAcars program and returns an array containing that information
		   Inputs: N/A
		   Outputs: string array
		   ************************************************************************************************ */
		// DO NOT EDIT THIS FUNCTION - THIS FIELDS ARE SENT BY FSACARS
		$fsacars_pirep = array(
			"pilot"       => $_GET['pilot'] ,
			"date"        => $_GET['date'] ,
			"time"        => $_GET['time'] ,
			"callsign"    => $_GET['callsign'] ,
			"reg"         => $_GET['reg'] ,
			"origin"      => $_GET['origin'] ,
			"dest"        => $_GET['dest'] ,
			"equipment"   => $_GET['equipment'] ,
			"fuel"        => $_GET['fuel'] ,
			"duration"    => $_GET['duration'] ,
			"distance"    => $_GET['distance'] ,
			"rep_url"     => "Dummy" ,
			"more"        => $_GET['more'] ,
			"fsacars_log" => $_GET['log']    // Get complete FSAcars log
		);
		return $fsacars_pirep;
	}
	function InsertReportIntoDB($pirep_array)
	{
		include('../db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
			return 0;
		}
		$the_pilot = ereg_replace("[^0-9]" , "" , $pirep_array['pilot']);
		$sql = "select gvauser_id as pilotid from gvausers where activation=1 and gvauser_id='" . $the_pilot . "'";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
			return 0;
		} else {
			while ($row = $result->fetch_assoc()) {
				$pilot_id = $row["pilotid"];
			}
			// get landing VS
			$vs = 0;
			$pos = strpos($pirep_array['fsacars_log'] , 'TouchDown:Rate');
			$pos2 = strpos($pirep_array['fsacars_log'] , 'ft/min');
			$vs = (int)substr($pirep_array['fsacars_log'] , $pos + 16 , $pos2 - $pos - 16);
			/*  Check if there is a report for the same flight and date*/
			$logone = $pirep_array['fsacars_log'];
			$origin_id = $pirep_array['origin'];
			$destination_id = $pirep_array['dest'];
			$dateflight = $pirep_array['date'];
			$timeflight = $pirep_array['time'];
			$sqlflight = "select * from reports where callsign='$the_pilot' and origin_id='$origin_id' and destination_id='$destination_id'
		and date='$dateflight' and time='$timeflight'";
			if (!$resultflight = $db->query($sqlflight)) {
				die('There was an error running the query [' . $db->error . ']');
				return 0;
			}
			while ($rowflight = $resultflight->fetch_assoc()) {
				$log = $rowflight["fsacars_log"];
				$report_id = $rowflight["report_id"];
			}
			if ($resultflight->num_rows > 0) {
				$sqlflight2 = "update reports set fsacars_log=concat('$log','$logone'), LandingVS=(-1)*$vs where report_id=$report_id ";
				if (!$resultflight2 = $db->query($sqlflight2)) {
					die('There was an error running the query  [' . $db->error . ']');
					return 0;
				}
			} else
			{
				/* Check Regular flight */
				$route_id = 0;
				$flight = '';
				$booked_plane='';
				$sqlflight = "select gva.route_id as route_id, fleet_id from reserves re inner join gvausers gva on re.gvauser_id = gva.gvauser_id inner join routes ro on ro.route_id = re.route_id and gva.gvauser_id=$pilot_id and  departure='$origin_id' and arrival='$destination_id'";
				if (!$resultflight = $db->query($sqlflight)) {
					die('There was an error running the query  [' . $db->error . ']');
					return 0;
				}
				$charter = 1;
				while ($rowflight = $resultflight->fetch_assoc()) {
					$route_id = $rowflight["route_id"];
					$flight = $rowflight["flight"];
					$charter = 0;
					$booked_plane = $rowflight["fleet_id"];
				}
				$values='';
				if ($charter == 1)
				{
					$values = '0' . ",";
				}
				else
				{
					$values = $booked_plane . ",";
				}
				$values .= '-' . $vs . ",";
				$values .= $route_id . "," . "'$flight'" . ",";
				$values .= $charter . "," . $pilot_id . ",'" . $pirep_array['date'] . "','" . $pirep_array['time'] . "','" . $pirep_array['callsign'] . "','" . $pirep_array['origin'] . "','" . $pirep_array['dest'] . "','" . $pirep_array['reg'] . "','" . $pirep_array['equipment'] . "','" . $pirep_array['duration'] . "'," . $pirep_array['fuel'] . "," . $pirep_array['distance'] . ",'" . $pirep_array['fsacars_log'] . "'";
				// Check duplicated reports and append log info.
				$sqlc = 'select * from reports where pilot_id=' . $pilot_id . ' and origin_id="' . $pirep_array['origin'] . '" and destination_id="' . $pirep_array['dest'] . '" and date="' . $pirep_array['date'] . '" and time="' . $pirep_array['time'] . '"';
				$duplicated = 0;
				$idduplicated = '';
				$charter_duplicated = '';
				$booked_plane_check= $booked_plane;
				if (!$resultflight = $db->query($sqlc)) {
					die('There was an error running the query  [' . $db->error . ']');
					return 0;
				}
				while ($rowflight = $resultflight->fetch_assoc()) {
					$idduplicated = $rowflight["report_id"];
					$duplicated = 1;
					$charter_duplicated= $rowflight["charter"];
					$booked_plane_check = $rowflight["fleet_id"];
				}
				if ($duplicated > 0) {
					$sql2 = "update reports set fsacars_log=concat(fsacars_log,'" . $pirep_array['fsacars_log'] . "'),LandingVS=(-1)*$vs  where report_id=" . $idduplicated;
				} else {
					$sql2 = "INSERT INTO reports (fleet_id,LandingVS,route,flight,charter,pilot_id,date,time,callsign,origin_id,destination_id,registration,equipment,duration,fuel,distance,fsacars_log) VALUES ($values)";
				}
				if (!$result = $db->query($sql2)) {
					die('There was an error running the query  [' . $db->error . ']');
					return 0;
				}
				/* ### VAM start  ### */
				// get VA parameters
				$queryva = "select * from va_parameters";
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
				if (!$resultvapara = $db->query($queryva)) {
					die('There was an error running the query  [' . $db->error . ']');
					return 0;
				}
				while ($rowvapara = $resultvapara->fetch_assoc()) {
					$va_name = $rowvapara["va_name"];
					$landing_vs_penalty1 = $rowvapara["landing_vs_penalty1"];
					$landing_vs_penalty2 = $rowvapara["landing_vs_penalty2"];
					$landing_penalty1 = $rowvapara["landing_penalty1"];
					$landing_penalty2 = $rowvapara["landing_penalty2"];
					$flight_wear = $rowvapara["flight_wear"];
					$landing_crash = $rowvapara["landing_crash"];
					$plane_status_hangar = $rowvapara["plane_status_hangar"];
					$hangar_maintenance_days = $rowvapara["hangar_maintenance_days"];
					$hangar_maintenance_value = $rowvapara["hangar_maintenance_value"];
					$hangar_crash_value = $rowvapara["hangar_crash_value"];
					$hangar_crash_days = $rowvapara["hangar_crash_days"];
					$pilot_crash_penalty = $rowvapara["pilot_crash_penalty"];
				}
				// Update location for pilot
				$query = 'UPDATE gvausers SET location="' . $destination_id . '"where gvauser_id=' . $pilot_id . ';';
				if (!$result = $db->query($query)) {
					die('There was an error running the query  [' . $db->error . ']');
					return 0;
				}
				if ($charter == 0 || $duplicated==1 ) {
					$tipo_vuelo = 'Vuelo programado';
					// Update the plane
					$hora_vuelo = substr(trim($pirep_array['duration']) , 0 , 2);
					$fake = 0;
					$hora_vuelo = str_replace("00" , "0" , $hora_vuelo);
					if (substr($hora_vuelo , 1 , 1) == '0') {
						$fake = '1';
					} else {
						$hora_vuelo = str_replace("0" , "" , $hora_vuelo);
					}
					$minutos_vuelo = substr(trim($pirep_array['duration']) , 3 , 2);
					$minutos_vuelo = str_replace("00" , "0" , $minutos_vuelo);
					if (substr($minutos_vuelo , 1 , 1) == '0') {
						$fake = '1';
					} else {
						$minutos_vuelo = str_replace("0" , "" , $minutos_vuelo);
					}
					$tiempo = round(($minutos_vuelo + ($hora_vuelo * 60)) / 60 , 2);
					/*
					$query = 'update fleets set booked=0 , hours = hours + ' . $tiempo . ' , location = "' . $pirep_array['dest'] . '" where fleet_id = (select fleet_id from  reserves where gvauser_id=' . $pilot_id . ');';
					if (!$result = $db->query($query)) {
						die('There was an error running the query  [' . $db->error . ']');
						return 0;
					}
					*/
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
					if ($duplicated==1){
						$flight_wear = 0;
						$tiempo = 0;
					}
					$sqlfleet = 'update fleets set booked=0 ,status=status - ' . $flight_wear . ' - ' . $penalizacion_vs . ' , hours = hours + ' . $tiempo . ' , location = "' . $pirep_array['dest'] . '" where fleet_id ='. $booked_plane_check;
					if (!$result = $db->query($sqlfleet)) {
						die('There was an error running the query  [' . $db->error . ']');
						return 0;
					}
					// check damage in plane and send it to the hangar if needed
					$sqlfleet = 'select * from  fleets  where fleet_id ='.$booked_plane_check ;
					if (!$result = $db->query($sqlfleet)) {
						die('There was an error running the query  [' . $db->error . ']');
						return 0;
					}
					$charter = 1;
					while ($rowfleet = $result->fetch_assoc()) {
						$estado = $rowfleet["status"];
						$avion = $rowfleet["fleet_id"];
						$matricula = $rowfleet["registry"];
						$location = $rowfleet["location"];
					}
					$origen = $pirep_array['origin'];
					$destino = $pirep_array['dest'];
					if ($estado < $plane_status_hangar && $estado > 0) {
						$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot_id,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_maintenance_days),'Mantenimiento Programado')";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
						$query1 = "update fleets set booked=1 ,hangar=1, hangardate=now() where fleet_id=$avion";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
						$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_maintenance_value, now(),$pilot_id ,'Mantenimiento $matricula')";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
					}
					if ($estado < 0) {
						$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot_id,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_crash_days),'Crash')";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
						$query1 = "update fleets set booked=1 where fleet_id=$avion";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
						$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_crash_value, now(),$pilot_id ,'Mantenimiento $matricula')";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
						$query1 = "insert into bank (gvauser_id, date,quantity,jump) values ($pilot_id,now(),-$pilot_crash_penalty,'Crash $matricula')";
						if (!$result = $db->query($query1)) {
							die('There was an error running the query  [' . $db->error . ']');
							return 0;
						}
					}
					// Desmarca al piloto
					$query = 'UPDATE gvausers SET route_id=0  where gvauser_id=' . $pilot_id . ';';
					if (!$result = $db->query($query)) {
						die('There was an error running the query  [' . $db->error . ']');
						return 0;
					}
					// BORRA flota_reserva
					$query = 'delete from reserves where gvauser_id=' . $pilot_id . ';';
					if (!$result = $db->query($query)) {
						die('There was an error running the query  [' . $db->error . ']');
						return 0;
					}
					// Historico de vuelos
					$fuel=$pirep_array['fuel'];
					$distance=$pirep_array['distance'];
					$query = "insert into regular_flights_tracks (gvauser_id,date,departure,arrival,route_id, fuel,distance,fleet_id) values  ($pilot_id,now(),'$origen','$destino',$route_id,$fuel ,$distance ,'$avion');";
					if (!$result = $db->query($query)) {
						die('There was an error running the query  [' . $db->error . ']');
						return 0;
					}
					$tipo_vuelo = 'vuelo regular';
				}
				/* ### VAM end  ### */
			}
			return 1;
		}
	}
	function main()
	{
		/* ************************************************************************************************
		   @main
		   Inputs: N/A
		   Outputs: "OK" sucess, "NOTOK" error
		   ************************************************************************************************ */
		$res = CheckFSAcarsInfo();
		if ($res == 0) {
			return "NOTOK";
		}
		$a = GetFSAcarsInfo(); // $a is the array with the flight details and the log
		$res = InsertReportIntoDB($a); // save flight into report table in the DB
		if ($res == 0) {
			return "NOTOK";
		}
		// Report sucessfully received
		return "OK";
	}
	/* receive_pirep.php return to FSACARS */
	$out = main();
	echo $out;
?>
