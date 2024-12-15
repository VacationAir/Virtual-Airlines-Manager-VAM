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
	include('get_va_parameters.php');
	include('./classes/class_vam_mailer.php');
	require('check_login.php');
	if (is_logged())
	{
		$from_airport = strtoupper($_POST['departure']);
		$to_airport = strtoupper($_POST['arrival']);
		$duration = $_POST['duration'];
		$distance = $_POST['distance'];
		$fuel = $_POST['fuel'];
		$plane = $_POST['plane'];
		$comment = $_POST['notes'];
		$flight_date = $_POST['flight_date'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		// select if the pilot has booked a flight with same from and to airports, then it means it is a regular flight
		$sql = 'select r.route_id route, r.flight flight from gvausers, routes r where gvauser_id="' . $id . '" and gvausers.route_id is not null and r.departure="' . $from_airport . '" and r.arrival="' . $to_airport . '" and gvausers.route_id=r.route_id  ;';
		$route_id = null;
		$charter = null;
		$flight = null;
		$pax = null;
		$cargo = null;
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		if ($result) {
			$number_of_rows = $result->num_rows;
			if ($number_of_rows > 0) {
				$row = $result->fetch_assoc();
				$route_id = $row['route'];
				$flight = $row['flight'];
				$charter = 0;
				// Get PAX and cargo
				$sql = "select * from  reserves where gvauser_id=$id";
				if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
				}
				while ($row = $result->fetch_assoc()) {
					$pax = $row["pax"];
					$cargo = $row["cargo"];
				}
			} else {
				$charter = 1;
			}
		} else {
			echo("There was an error running the query ");
		}
		// Insert the pirep
		$sql = "insert into pireps (from_airport,to_airport,comment,duration,plane_type,fuel,gvauser_id,charter,distance,date,route,flight,pax,cargo) values ('$from_airport','$to_airport','$comment',$duration,'$plane',$fuel , $id ,$charter,$distance,STR_TO_DATE('$flight_date','%d/%m/%Y'),'$route_id','$flight','$pax','$cargo' );";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		if ($charter == 0) // regular flight then move & unlock the plane
		{
			// Update the pilot: VAM time and location
			$sql = "UPDATE gvausers SET route_id=0 , location='$to_airport',gva_hours=gva_hours + $duration where gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// Review plane status
			$sql = "select * from  fleets  where fleet_id = (select fleet_id from  reserves where gvauser_id=$id)";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$plane_status = $row["status"] - $flight_wear;
				$fleet_id = $row["fleet_id"];
				$registry = $row["registry"];
			}
			$booked = 0;
			if ($plane_status <= $plane_status_hangar) {
				$sql = "insert into hangar (gvauser_id,fleet_id,registry,departure,location,date_in,date_out,reason) values ($id,$fleet_id,'$registry','$from_airport','$to_airport',now(),ADDDATE(CURDATE(),$hangar_maintenance_days) ,'In Maintenance') ";
				if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				$booked = 1;
			}
			// move & unlock plane
			// parameter
			$sql = "UPDATE fleets SET gvauser_id=NULL, hangardate=now(),status=status-$flight_wear, booked=$booked,location='$to_airport',hours=hours + $duration where fleet_id=(select fleet_id from reserves where gvauser_id=$id)";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// change status fleet reserve
			$sql = "delete from reserves where gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// store the fligth for tracking purposes
			$sql = "insert into regular_flights_tracks (gvauser_id,date,departure,arrival,route_id, fuel,distance,fleet_id) values ($id,now(),'$from_airport','$to_airport',$route_id,$fuel,$distance,$fleet_id )";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		} else {
			$sql = "UPDATE gvausers SET location='$to_airport',gva_hours=gva_hours + $duration where gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
		$sql = "select * from pireps where gvauser_id=$id and from_airport='$from_airport' and to_airport='$to_airport' order by pirep_id desc limit 1";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
		$flightid=0;
		while ($row = $result->fetch_assoc()) {
			$flightid =  $row["pirep_id"];
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><?php echo MANUAL_PIREP; ?></div>
						<table class="table table-hover">
							<tr>
								<td><strong><?php echo MANUAL_PIREP_DATE; ?></strong></td>
								<td><?php echo $row["date"]; ?></td>
								<td><strong><?php echo MANUAL_PIREP_DEP; ?></strong></td>
								<td><?php echo $row["from_airport"]; ?></td>
								<td><strong><?php echo MANUAL_PIREP_ARR; ?></strong></td>
								<td><?php echo $row["to_airport"]; ?></td>
								<td><strong><?php echo MANUAL_PIREP_FLIGHT_TYPE; ?></strong></td>
								<td><?php if ($row["charter"] == 1) {
										echo MANUAL_PIREP_CHARTER;
									} else {
										echo MANUAL_PIREP_REG;
									} ?></td>
							</tr>
							<tr>
								<td><strong><?php echo MANUAL_PIREP_TIME; ?></strong></td>
								<td><?php echo $row["duration"]; ?></td>
								<td><strong><?php echo MANUAL_PIREP_DISTANCE; ?></strong></td>
								<td><?php echo $row["distance"]; ?></td>
								<td><strong><?php echo MANUAL_PIREP_FUEL; ?></strong></td>
								<td><?php echo $row["fuel"]; ?></td>
								<td><strong><?php echo MANUAL_PIREP_AIRCRAFT; ?></strong></td>
								<td><?php echo $row["plane_type"]; ?></td>
							</tr>
							<tr>
								<td>
								</td>
								<td></td>
								<td>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<?php
			$db->close();
			// Send mail to the staff
			$type='MANUAL PIREP';
			$mail = new vam_mailer();
			$mail->mail_flight_report_compose($id,$type,$from_airport,$to_airport);
		}
		// Auto approval  begin
		$flight = $flightid;
		$type = 'pirep';
		$pilot = $id;
		$departure = $from_airport;
		$arrival = $to_airport;
		$charter = '';
		require('auto_acept_flight.php');
	}
	else
	{
		include("./notgranted.php");
	}
?>
