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
	include('./classes/class_vam_mailer.php');
	$data = json_decode(file_get_contents('php://input'), true);
	$weight_unit = $data[0]["weight_unit"];
	$dep = $data[0]["departure"];
	$arr = $data[0]["arrival"];
	$callsign = $data[0]["callsign"];
	$flight_id = $data[0]["flightId"];
	$gvauser_id = $data[0]["gvauserId"];
	$departure_time= $data[0]["departure_time"];
	$cruise_speed= $data[0]["cruise_speed"];
	$flight_level= $data[0]["flight_level"];
	$pax= $data[0]["pax"];
	$cargo= $data[0]["cargo"];
	$eet= $data[0]["eet"];
	$endurance= $data[0]["endurance"];
	$alt1= $data[0]["alt1"];
	$alt2= $data[0]["alt2"];
	$route= $data[0]["route"];
	$remarks= $data[0]["remarks"];
	$flight_type= $data[0]["flight_type"];
	$aircraft= $data[0]["aircraft"];
	$aircraft_type= $data[0]["aircraft_type"];
	$aircraft_registry= $data[0]["aircraft_registry"];
	$flight_status= $data[0]["flight_status"];
	$flight_duration= $data[0]["flight_duration"];
	$flight_fuel= $data[0]["flight_fuel"];
	$block_fuel= $data[0]["block_fuel"];
	$flight_date= $data[0]["flight_date"];
	$landing_vs= $data[0]["landing_vs"];
	$distance= $data[0]["distance"];
	$landing_ias	= $data[0]["landing_ias"];
	$landing_forceg	= $data[0]["landing_forceg"];
	$landing_bank	= $data[0]["landing_bank"];
	$landing_pitch	= $data[0]["landing_pitch"];
	$landing_winddeg	= $data[0]["landing_winddeg"];
	$landing_windknots	= $data[0]["landing_windknots"];
	$landing_oat	= $data[0]["landing_oat"];
	$landing_flaps	= $data[0]["landing_flaps"];
	$landing_light_bea	= $data[0]["landing_light_bea"];
	$landing_light_nav	= $data[0]["landing_light_nav"];
	$landing_light_ldn	= $data[0]["landing_light_ldn"];
	$landing_light_str	= $data[0]["landing_light_str"];
	$log_start	= $data[0]["log_start"];
	$flight_start	= $data[0]["flight_start"];
	$log_end	= $data[0]["log_end"];
	$flight_end	= $data[0]["flight_end"];
	$zfw	= $data[0]["zfw"];
	$departure_metar	= $data[0]["departure_metar"];
	$arrival_metar	= $data[0]["arrival_metar"];
	$network	= $data[0]["network"];
	$comments	= $data[0]["comments"];
	$pause_time = $data[0]["pause_time"];
	$crash = $data[0]["crash"];
	$beacon_off = $data[0]["beacon_off"];
	$ias_below_10000_ft = $data[0]["ias_below_10000_ft"];
	$lights_below_10000_ft = $data[0]["lights_below_10000_ft"];
	$lights_above_10000_ft = $data[0]["lights_above_10000_ft"];
	$stall = $data[0]["stall"];
	$overspeed = $data[0]["overspeed"];
	$pause = $data[0]["pause"];
	$refuel = $data[0]["refuel"];
	$slew = $data[0]["slew"];
	$taxi_no_lights = $data[0]["taxi_no_lights"];
	$takeoff_ldn_lights_off = $data[0]["takeoff_ldn_lights_off"];
	$landing_ldn_lights_off = $data[0]["landing_ldn_lights_off"];
	$landed_not_in_planned = $data[0]["landed_not_in_planned"];
	$taxi_speed = $data[0]["taxi_speed"];
	$qnh_takeoff = $data[0]["qnh_takeoff"];
	$qnh_landing = $data[0]["qnh_landing"];
	$final_fuel = $data[0]["final_fuel"];
	$landing_hdg = $data[0]["landing_hdg"];
	$flight = $data[0]["flightId"];
	$aircraftreg=''; // tail number filled in case of regular flight or aircraft booked by SIM ACARS
	if (!empty ($data[0]["aircraftreg"]))
	{
		$aircraftreg = $data[0]["aircraftreg"];
	}
	//$fob = $data[0]["fob"];  // reserved for SIM ACARS 1.5
	$fob =0;
	$is_charter=1; // by default consider it is a charter flight
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	function instert_flight( $flight , $data ,$db){
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$data = json_decode(file_get_contents('php://input'), true);
		$weight_unit = $data[0]["weight_unit"];
		$dep = $data[0]["departure"];
		$arr = $data[0]["arrival"];
		$callsign = $data[0]["callsign"];
		$flight_id = $data[0]["flightId"];
		$gvauser_id = $data[0]["gvauserId"];
		$departure_time= $data[0]["departure_time"];
		$cruise_speed= $data[0]["cruise_speed"];
		$flight_level= $data[0]["flight_level"];
		$pax= $data[0]["pax"];
		$cargo= $data[0]["cargo"];
		$eet= $data[0]["eet"];
		$endurance= $data[0]["endurance"];
		$alt1= $data[0]["alt1"];
		$alt2= $data[0]["alt2"];
		$route= $data[0]["route"];
		$remarks= $data[0]["remarks"];
		$flight_type= $data[0]["flight_type"];
		$aircraft= $data[0]["aircraft"];
		$aircraft_type= $data[0]["aircraft_type"];
		$aircraft_registry= $data[0]["aircraft_registry"];
		$flight_status= $data[0]["flight_status"];
		$flight_duration= $data[0]["flight_duration"];
		$flight_fuel= $data[0]["flight_fuel"];
		$block_fuel= $data[0]["block_fuel"];
		$flight_date= $data[0]["flight_date"];
		$landing_vs= $data[0]["landing_vs"];
		$distance= $data[0]["distance"];
		$landing_ias	= $data[0]["landing_ias"];
		$landing_forceg	= $data[0]["landing_forceg"];
		$landing_bank	= $data[0]["landing_bank"];
		$landing_pitch	= $data[0]["landing_pitch"];
		$landing_winddeg	= $data[0]["landing_winddeg"];
		$landing_windknots	= $data[0]["landing_windknots"];
		$landing_oat	= $data[0]["landing_oat"];
		$landing_flaps	= $data[0]["landing_flaps"];
		$landing_light_bea	= $data[0]["landing_light_bea"];
		$landing_light_nav	= $data[0]["landing_light_nav"];
		$landing_light_ldn	= $data[0]["landing_light_ldn"];
		$landing_light_str	= $data[0]["landing_light_str"];
		$log_start	= $data[0]["log_start"];
		$flight_start	= $data[0]["flight_start"];
		$log_end	= $data[0]["log_end"];
		$flight_end	= $data[0]["flight_end"];
		$zfw	= $data[0]["zfw"];
		$departure_metar	= $data[0]["departure_metar"];
		$arrival_metar	= $data[0]["arrival_metar"];
		$network	= $data[0]["network"];
		$comments	= $data[0]["comments"];
		$pause_time = $data[0]["pause_time"];
		$crash = $data[0]["crash"];
		$beacon_off = $data[0]["beacon_off"];
		$ias_below_10000_ft = $data[0]["ias_below_10000_ft"];
		$lights_below_10000_ft = $data[0]["lights_below_10000_ft"];
		$lights_above_10000_ft = $data[0]["lights_above_10000_ft"];
		$stall = $data[0]["stall"];
		$overspeed = $data[0]["overspeed"];
		$pause = $data[0]["pause"];
		$refuel = $data[0]["refuel"];
		$slew = $data[0]["slew"];
		$taxi_no_lights = $data[0]["taxi_no_lights"];
		$takeoff_ldn_lights_off = $data[0]["takeoff_ldn_lights_off"];
		$landing_ldn_lights_off = $data[0]["landing_ldn_lights_off"];
		$landed_not_in_planned = $data[0]["landed_not_in_planned"];
		$taxi_speed = $data[0]["taxi_speed"];
		$qnh_takeoff = $data[0]["qnh_takeoff"];
		$qnh_landing = $data[0]["qnh_landing"];
		$final_fuel = $data[0]["final_fuel"];
		$landing_hdg = $data[0]["landing_hdg"];
		$flight = $data[0]["flightId"];
		$aircraftreg=''; // tail number filled in case of regular flight or aircraft booked by SIM ACARS
		if (!empty ($data[0]["aircraftreg"]))
		{
			$aircraftreg = $data[0]["aircraftreg"];
		}
		//$fob = $data[0]["fob"];  // reserved for SIM ACARS 1.5
		$fob =0;
		$sql = "insert into vampireps (
			flightid,
		   gvauser_id,
		  departure,
		  arrival ,
		  callsign ,
		  departure_time,
		  cruise_speed ,
		  flight_level ,
		  pax  ,
		  cargo ,
		  eet ,
		  endurance ,
		  alt1 ,
		  alt2 ,
		  route ,
		  remarks ,
		  flight_type ,
		  aircraft ,
		  aircraft_type ,
		  aircraft_registry ,
		  flight_status ,
		  flight_fuel ,
		  block_fuel,
		  flight_duration ,
		  flight_date ,
		  landing_vs,
		  distance,
		  landing_ias,
		  landing_forceg,
		  landing_bank,
		  landing_pitch,
		  landing_winddeg,
		  landing_windknots,
		  landing_oat,
		  landing_flaps,
		  landing_light_bea,
		  landing_light_nav,
		  landing_light_ldn,
		  landing_light_str,
		  log_start,
		  flight_start,
		  log_end,
		  flight_end,
		  zfw,
		  departure_metar,
		  arrival_metar,
		  weight_unit,
		  network ,
		  comments,
		  pause_time,
		  crash,
		  beacon_off,
		  ias_below_10000_ft ,
		  lights_below_10000_ft ,
		  lights_above_10000_ft ,
		  stall ,
		  overspeed ,
		  pause ,
		  refuel ,
		  slew ,
		  taxi_no_lights ,
		  takeoff_ldn_lights_off ,
		  landing_ldn_lights_off ,
		  landed_not_in_planned,
		  taxi_speed,
		  qnh_takeoff,
		  qnh_landing,
		  final_fuel,
		  landing_hdg,
		  fob) values (
		  '$flight_id',
		  '$gvauser_id',
		  '$dep',
		  '$arr',
		  '$callsign',
		  '$departure_time',
		'$cruise_speed',
		'$flight_level',
		'$pax',
		'$cargo',
		'$eet',
		'$endurance',
		'$alt1',
		'$alt2',
		'$route',
		'$remarks',
		'$flight_type',
		'$aircraft',
		'$aircraft_type',
		'$aircraft_registry',
		'$flight_status',
		'$flight_fuel',
		'$block_fuel' ,
		'$flight_duration',
		'$flight_date',
		'$landing_vs',
		'$distance',
		'$landing_ias',
		'$landing_forceg',
		'$landing_bank',
		'$landing_pitch',
		'$landing_winddeg',
		'$landing_windknots',
		'$landing_oat',
		'$landing_flaps',
		'$landing_light_bea',
		'$landing_light_nav',
		'$landing_light_ldn',
		'$landing_light_str',
		'$log_start',
		'$flight_start',
		'$log_end',
		'$flight_end',
		'$zfw',
		'$departure_metar',
		'$arrival_metar',
		'$weight_unit',
		'$network',
		'$comments',
		'$pause_time',
		'$crash',
		'$beacon_off',
		'$ias_below_10000_ft' ,
		'$lights_below_10000_ft' ,
		'$lights_above_10000_ft' ,
		'$stall' ,
		'$overspeed' ,
		'$pause' ,
		'$refuel' ,
		'$slew' ,
		'$taxi_no_lights' ,
		'$takeoff_ldn_lights_off' ,
		'$landing_ldn_lights_off' ,
		'$landed_not_in_planned',
		'$taxi_speed',
		'$qnh_takeoff',
		'$qnh_landing',
		'$final_fuel',
		'$landing_hdg',
		'$fob'
		)";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	} // END function instert_flight(
	function check_duplicated_flight( $flight , $db){
		$duplicated=1;
		$counter=0;
		$sql="select * from vampireps where flightid='".$flight."'";
		if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
		}
		$counter=mysqli_num_rows($result);
		if ($counter>0){
		return $duplicated;
		}
		else{
			$duplicated=0;
			return $duplicated;
		}
	} // END function check_duplicated_flight
	function move_charter_aircraft ($aircraftreg_para,$gvauser_id, $dep, $arr , $flight_duration,  $block_fuel, $distance , $landing_vs , $flight ,$db){
		if (!empty($aircraftreg_para)) // if to process logic only on charter aircraft when a VA aircraft was booked
		{
			$avion='';
			$sql="update fleets set location='$arr', booked=0,gvauser_id=NULL, booked_at=null, hours=hours+$flight_duration  where registry='$aircraftreg_para'";
			if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
			}
			$sql="select * from  fleets where registry='$aircraftreg_para'";
			if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$avion = $row['fleet_id'];
			}
			// Calculate and update aircraft status
			// get VA parameters
			$sql = "select * from va_parameters";
			$va_name = '';
			$landing_vs_penalty1 = '';
			$landing_vs_penalty2 = '';
			$landing_penalty1 = '';
			$landing_penalty2 = '';
			$landing_penalty3 = '';
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
				$landing_vs_penalty1 = abs($row["landing_vs_penalty1"]);
				$landing_vs_penalty2 = abs($row["landing_vs_penalty2"]);
				$landing_penalty1 = $row["landing_penalty1"];
				$landing_penalty2 = $row["landing_penalty2"];
				$landing_penalty3 = $row["landing_penalty3"];
				$flight_wear = $row["flight_wear"];
				$landing_crash = abs($row["landing_crash"]);
				$plane_status_hangar = $row["plane_status_hangar"];
				$hangar_maintenance_days = $row["hangar_maintenance_days"];
				$hangar_maintenance_value = $row["hangar_maintenance_value"];
				$hangar_crash_value = $row["hangar_crash_value"];
				$hangar_crash_days = $row["hangar_crash_days"];
				$pilot_crash_penalty = $row["pilot_crash_penalty"];
			}
			// Update the plane
			$penalizacion_vs = 0;
			$landing_vs=abs($landing_vs);
			if ($landing_vs >= $landing_crash) {
				$penalizacion_vs = 999999; // $penalizacion_vs==999999 means a crash

			} elseif ($landing_vs >= $landing_vs_penalty2 && $landing_vs < $landing_crash) {
				$penalizacion_vs = $landing_penalty3;

			} elseif ($landing_vs >=$landing_vs_penalty1 && $landing_vs < $landing_vs_penalty2) {
				$penalizacion_vs = $landing_penalty2;

			} else {
				$penalizacion_vs = $landing_penalty1;

			}
			// update the aircraft status based on landing_vs
			if ($penalizacion_vs==999999)
			{
				$query2="update fleets set  status=status-$penalizacion_vs ,gvauser_id=NULL, booked_at=null where registry='$aircraftreg_para'";
			}
			else
			{
				$query2="update fleets set  status=status - $flight_wear - $penalizacion_vs ,gvauser_id=NULL, booked_at=null where registry='$aircraftreg_para'";
			}
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// check damage in plane and send it to the hangar if needed
			$query3 = "select * from  fleets  where registry='$aircraftreg_para'";
			if (!$result3 = $db->query($query3)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$estado = 0;
			$matricula ='';
			$location ='';
			while ($row3 = $result3->fetch_assoc()) {
				$estado = $row3["status"];
				$avion = $row3["fleet_id"];
				$matricula = $row3["registry"];
				$location = $row3["location"];
			}
			$pilot = $gvauser_id;
			$origen = $dep;
			if ($estado < $plane_status_hangar && $estado > 0) {
				$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_maintenance_days),'Maintenance')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "update fleets set booked=1 ,hangar=1, hangardate=now() where fleet_id=$avion";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_maintenance_value, now(),$pilot ,'Aircraft Maintenace $matricula')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				// Cost for the VA for the maintenance
				$query1 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values (-$hangar_maintenance_value, '99997', now(),$pilot ,'Aircraft Maintenace $matricula','SIM ACARS', '$flight')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
			if ($estado <= 0) {
				$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_crash_days),'Crash')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "update fleets set status=0, booked=1 where fleet_id=$avion";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_crash_value, now(),$pilot ,'Aircraft Maintenance $matricula')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$query1 = "insert into bank (gvauser_id, date,quantity,jump) values ($pilot,now(),-$pilot_crash_penalty,'Aircraft Crash $matricula')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				// Cost for the VA for the Crash repair
				$query1 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values (-$hangar_crash_value, '99996',now(),$pilot ,'Aircraft crash repair $matricula','SIM ACARS', '$flight')";
				if (!$result_sta = $db->query($query1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
			// Save flight historic
			$query = "insert into regular_flights_tracks (gvauser_id,date,departure,arrival,route_id, fuel,distance,fleet_id) values  (" . $gvauser_id . ",now(),'" . $dep . "','" . $arr ."','".'-1'. "'," . $block_fuel . "," . $distance . ",'$avion');";
			if (!$result_sta = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
		else
		{
			$xp=1;
		}
	} // END function move_charter_aircraft
	function is_charter_flight ($gvauser_id, $dep, $arr , $flight_duration,  $block_fuel, $distance , $landing_vs , $flight ,$db){
		$query = 'select * from gvausers gu, routes r where gu.gvauser_id="' . $gvauser_id . '" and gu.route_id <> 0 and r.departure="' . $dep . '" and r.arrival="' . $arr . '" and gu.route_id=r.route_id;';
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$number_of_rows = mysqli_num_rows($result);
		// if there is one record found means this flight is regular
		if ($number_of_rows > 0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	} // END function is_charter_flight
	function check_regular_flight ($gvauser_id, $dep, $arr , $flight_duration,  $block_fuel, $distance , $landing_vs , $flight ,$db){
		// get VA parameters
		$sql = "select * from va_parameters";
		$va_name = '';
		$landing_vs_penalty1 = '';
		$landing_vs_penalty2 = '';
		$landing_penalty1 = '';
		$landing_penalty2 = '';
		$landing_penalty3 = '';
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
			$landing_penalty3 = $row["landing_penalty3"];
			$flight_wear = $row["flight_wear"];
			$landing_crash = $row["landing_crash"];
			$plane_status_hangar = $row["plane_status_hangar"];
			$hangar_maintenance_days = $row["hangar_maintenance_days"];
			$hangar_maintenance_value = $row["hangar_maintenance_value"];
			$hangar_crash_value = $row["hangar_crash_value"];
			$hangar_crash_days = $row["hangar_crash_days"];
			$pilot_crash_penalty = $row["pilot_crash_penalty"];
		}
		// try to find if there is a route booked for this pilot
		$query = 'select * from gvausers gu, routes r where gu.gvauser_id="' . $gvauser_id . '" and gu.route_id <> 0 and r.departure="' . $dep . '" and r.arrival="' . $arr . '" and gu.route_id=r.route_id;';
		$charter = 0;
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$number_of_rows = mysqli_num_rows($result);
		// if there is one record found means this flight is regular
		if ($number_of_rows > 0)
		{
			while ($row = $result->fetch_array())
			{
				$is_charter=0;
				$route_id = $row['route_id'];
				$regularflight = $row['flight'];
				$vs=abs($landing_vs);
				////////////////////////////
				// Update the plane
				///////////////////////////
				$penalizacion_vs = 0;
				if ($vs >= $landing_crash) {
					$penalizacion_vs = 999999;
				} elseif ($vs >= $landing_vs_penalty2 && $vs < $landing_crash) {
					$penalizacion_vs = $landing_penalty3;
				} elseif ($vs >= $landing_vs_penalty1 && $vs < $landing_vs_penalty2) {
					$penalizacion_vs = $landing_penalty2;
				} else {
					$penalizacion_vs = $landing_penalty1;
				}
				// set aircraft free, sum time, move the aircraft and set status based on landing v/s
				$query2 = 'update fleets set booked=0 ,gvauser_id=NULL, booked_at=NULL, status=status - ' . $flight_wear . ' - ' . $penalizacion_vs . ' , hours = hours + ' . $flight_duration . ' , location = "' . $arr . '" where fleet_id = (select fleet_id from  reserves where gvauser_id=' . $gvauser_id . ');';
				if (!$result2 = $db->query($query2)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				// check damage in plane and send it to the hangar if needed
				$query3 = 'select * from  fleets  where fleet_id = (select fleet_id from  reserves where gvauser_id=' . $gvauser_id . ');';
				if (!$result3 = $db->query($query3)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$estado = 0;
				while ($row3 = $result3->fetch_assoc()) {
					$estado = $row3["status"];
					$avion = $row3["fleet_id"];
					$matricula = $row3["registry"];
					$location = $row3["location"];
				}
				$pilot = $gvauser_id;
				$origen = $dep;
				if ($estado < $plane_status_hangar && $estado > 0) {
					$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_maintenance_days),'Maintenance')";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "update fleets set booked=1 ,hangar=1, hangardate=now() where fleet_id=$avion";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_maintenance_value, now(),$pilot ,'Maintenance $matricula')";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
				}
				if ($estado < 0) {
					$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$location',CURDATE(),ADDDATE(CURDATE(),$hangar_crash_days),'Crash')";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "update fleets set booked=1 , status=0 where fleet_id=$avion";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "insert into vaprofits (value,date,gvauser_id,description) values (-$hangar_crash_value, now(),$pilot ,'Maintenance $matricula')";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "insert into bank (gvauser_id, date,quantity,jump) values ($pilot,now(),-$pilot_crash_penalty,'Crash $matricula')";
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
				}
				// Historico de vuelos
				$query = "insert into regular_flights_tracks (gvauser_id,date,departure,arrival,route_id, fuel,distance,fleet_id) values  (" . $gvauser_id . ",now(),'" . $dep . "','" . $arr . "',$route_id," . $block_fuel . "," . $distance . ",'$avion');";
				if (!$result_sta = $db->query($query)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				// Get pax and cargo from regular flight
				$assigned_pax=0;
				$assigned_cargo=0;
				$query = "select * from reserves where gvauser_id=$gvauser_id";
				if (!$result_sta = $db->query($query)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				while ($row = $result_sta->fetch_assoc()) {
					$assigned_pax = $row["pax"];
					$assigned_cargo = $row["cargo"];
				}
				// update vampirep with regular flights data: cargo, pax .... it overwrites value for pax and cargo based on the reserve
				$query2 = "update vampireps set route_id=$route_id ,assigned_pax=$assigned_pax, pax=$assigned_pax, assigned_cargo= $assigned_cargo , cargo=$assigned_cargo,  charter=0 ,flight='".$regularflight."' where flightid='".$flight."'";
				if (!$result2 = $db->query($query2)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
		}
		else {
		}
	} // END function check_regular_flight
	function move_pilot ($gvauser_id, $arr , $db){
			$query = 'UPDATE gvausers SET route_id=0 ,location="' . $arr . '"where gvauser_id=' . $gvauser_id . ';';
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
	} // END function move_pilot
	function clean_reserve ($gvauser_id, $db){
		$query = 'delete from reserves where gvauser_id=' . $gvauser_id . ';';
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	} // END function clean_reserve
	function flight_rating ($flight, $db){
		//  Get vamacars parameters
		$query = "select * from vamacars_parameters ";
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$beacon_off = $row["beacon_off"];
			$ias_below_10000_ft	 = $row["ias_below_10000_ft"];
			$lights_below_10000_ft = $row["lights_below_10000_ft"];
			$lights_above_10000_ft = $row["lights_above_10000_ft"];
			$stall = $row["stall"];
			$overspeed = $row["overspeed"];
			$pause = $row["pause"];
			$refuel = $row["refuel"];
			$crash = $row["crash"];
			$incorrect_arrival = $row["incorrect_arrival"];
			$slew = $row["slew"];
			$taxi_lights = $row["taxi_lights"];
			$takeoff_lights = $row["takeoff_lights"];
			$land_lights = $row["land_lights"];
			$taxi_speed = $row["taxi_speed"];
			$landing_vs_0_100 = $row["landing_vs_0_100"];
			$landing_vs_100_200 = $row["landing_vs_100_200"];
			$landing_vs_200_300 = $row["landing_vs_200_300"];
			$landing_vs_300_400 = $row["landing_vs_300_400"];
			$landing_vs_400_500 = $row["landing_vs_400_500"];
			$landing_vs_500_600 = $row["landing_vs_500_600"];
			$landing_vs_greater_600 = $row["landing_vs_greater_600"];
		}
		// Get flight data
		$query = "select * from vampireps where flightid='".$flight."'";
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$beacon_off_flight = $row["beacon_off"];
			$ias_below_10000_ft_flight = $row["ias_below_10000_ft"];
			$lights_below_10000_ft_flight = $row["lights_below_10000_ft"];
			$lights_above_10000_ft_flight = $row["lights_above_10000_ft"];
			$stall_flight = $row["stall"];
			$overspeed_flight = $row["overspeed"];
			$pause_flight = $row["pause"];
			$refuel_flight = $row["refuel"];
			$crash_flight = $row["crash"];
			$slew_flight = $row["slew"];
			$taxi_no_lights_flight = $row["taxi_no_lights"];
			$takeoff_ldn_lights_off_flight = $row["takeoff_ldn_lights_off"];
			$landing_ldn_lights_off_flight = $row["landing_ldn_lights_off"];
			$landed_not_in_planned_flight = $row["landed_not_in_planned"];
			$taxi_speed_flight = $row["taxi_speed"];
			$landing_vs_flight = abs($row["landing_vs"]);
		}
		$rating=100;
		$rating = $rating - ($beacon_off * $beacon_off_flight);
		$rating = $rating - ($ias_below_10000_ft * $ias_below_10000_ft_flight);
		$rating = $rating - ($lights_below_10000_ft * $lights_below_10000_ft_flight);
		$rating = $rating - ($lights_above_10000_ft * $lights_above_10000_ft_flight);
		$rating = $rating - ($stall * $stall_flight);
		$rating = $rating - ($overspeed * $overspeed_flight);
		$rating = $rating - ($pause * $pause_flight);
		$rating = $rating - ($refuel * $refuel_flight);
		$rating = $rating - ($crash * $crash_flight);
		$rating = $rating - ($slew * $slew_flight);
		$rating = $rating - ($taxi_lights * $taxi_no_lights_flight);
		$rating = $rating - ($takeoff_lights * $takeoff_ldn_lights_off_flight);
		$rating = $rating - ($land_lights * $landing_ldn_lights_off_flight);
		$rating = $rating - ($incorrect_arrival * $landed_not_in_planned_flight);
		$rating = $rating - ($taxi_speed * $taxi_speed_flight);
		$landingvs=0;
		if ($landing_vs_flight>0 && $landing_vs_flight<=100)
		{
			$landingvs = $landing_vs_0_100;
		}
		if ($landing_vs_flight>100 && $landing_vs_flight<=200)
		{
			$landingvs = $landing_vs_100_200;
		}
		if ($landing_vs_flight>200 && $landing_vs_flight<=300)
		{
			$landingvs = $landing_vs_200_300;
		}
		if ($landing_vs_flight>300 && $landing_vs_flight<=400)
		{
			$landingvs = $landing_vs_300_400;
		}
		if ($landing_vs_flight>400 && $landing_vs_flight<=500)
		{
			$landingvs = $landing_vs_400_500;
		}
		if ($landing_vs_flight>500 && $landing_vs_flight<=600)
		{
			$landingvs = $landing_vs_500_600;
		}
		if ($landing_vs_flight>600)
		{
			$landingvs = $landing_vs_greater_600;
		}
		$rating = $rating - $landingvs;
		// Update fligth rating
		$query = "update vampireps set rating=$rating where flightid='".$flight."'";
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	} // END function flight_rating
	function auto_approval ($flight, $db){
			$query = "select * from vampireps where flightid='$flight'";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$flight = $row["id"];
				$pilot = $row["gvauser_id"];
				$departure = $row["departure"];
				$arrival = $row["arrival"];
			}
		$type = 'vamacars';
		$charter = '';
		require('auto_acept_flight.php');
	} // END function auto_approval
	$duplicado= check_duplicated_flight($flight , $db);
	if ($duplicado==0){
		$is_charter_var = is_charter_flight($gvauser_id, $dep, $arr , $flight_duration,  $block_fuel, $distance , $landing_vs , $flight ,$db);
		instert_flight ($flight, $data , $db);
		check_regular_flight ($gvauser_id, $dep, $arr , $flight_duration,  $block_fuel, $distance , $landing_vs , $flight ,$db);
		move_pilot ($gvauser_id, $arr , $db);
		auto_approval ($flight_id , $db);
		if ($is_charter_var==1)
		{
			move_charter_aircraft ($aircraftreg,$gvauser_id, $dep, $arr , $flight_duration,  $block_fuel, $distance , $landing_vs , $flight ,$db);
		}
		clean_reserve($gvauser_id, $db);
		flight_rating($flight, $db);
		// Send mail to the staff
		$type='VAM ACARS';
		$mail = new vam_mailer();
		$mail->mail_flight_report_compose($gvauser_id,$type,$dep,$arr);
		$ok='OK';
		$ok=preg_replace('/\s+/', '',$ok);
		echo $ok;
	}
	else
	{
		echo "DUPLICATED";
	}
?>