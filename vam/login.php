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
	include('classes/security.php');
	$secure = new SECURITY();
	$secure->parse_incoming();
	session_start();
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$exists = 0;
	$_SESSION["access"] = false;
	if (isset($_POST['user']) and isset($_POST['password'])) {
		$user = mysqli_real_escape_string($db , $_POST['user']);
		$Encrypt_Pass = md5(mysqli_real_escape_string($db , $_POST["password"]));
		$query = "SELECT * FROM gvausers u inner join user_types ut on u.user_type_id = ut.user_type_id where activation=1 and callsign='" . $user . "' and password='" . $Encrypt_Pass . "'";
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$exists = 1;
			$user_type = $row['user_type_id'];
			$pilotname = $row['name'];
			$pilotsurname = $row['surname'];
			$callsign = $row['callsign'];
			$id = $row['gvauser_id'];
			$location = $row['location'];
			$usertype = $row['user_type_id'];
			$cto = $row['hub_id'];
			$register_date = $row['register_date'];
			$gva_hours = $row['gva_hours'];
			$rank_id = $row['rank_id'];
			$language = $row['language'];
			$access_administration_panel = $row['access_administration_panel'];
			$access_va_parameters = $row['access_va_parameters'];
			$access_hub_manager = $row['access_hub_manager'];
			$access_fleet_type_manager = $row['access_fleet_type_manager'];
			$access_fleet_manager = $row['access_fleet_manager'];
			$access_rank_manager = $row['access_rank_manager'];
			$access_pilot_manager = $row['access_pilot_manager'];
			$access_route_manager = $row['access_route_manager'];
			$access_route_assignator = $row['access_route_assignator'];
			$access_user_type_manager = $row['access_user_type_manager'];
			$access_jump_validator = $row['access_jump_validator'];
			$access_flight_validator = $row['access_flight_validator'];
			$access_event_manager = $row['access_event_manager'];
			$access_notam_manager = $row['access_notam_manager'];
			$access_email_manager = $row['access_email_manager'];
			$access_language_manager = $row['access_language_manager'];
			$access_vam_acars_manager = $row['access_vam_acars_manager'];
			$access_financial_parameters = $row['access_financial_parameters'];
			$access_tour_manager = $row['access_tour_manager'];
			$access_award_manager  = $row['access_award_manager'];
			$access_training_manager  = $row['access_training_manager'];
			$access_web_manager  = $row['access_web_manager'];
			$access_simacars_manager  = $row['access_simacars_manager'];
			$access_manual_manager  = $row['access_manual_manager'];
			$access_airports_manager  = $row['access_airports_manager'];
		}
		if ($exists != 0) {
			$_SESSION["access"] = true;
			$lifetime = 3600;
			session_set_cookie_params($lifetime);
			$_SESSION["username"] = $user;
			$_SESSION["name"] = $pilotname;
			$_SESSION["user"] = $callsign;
			$_SESSION["password"] = $Encrypt_Pass;
			$_SESSION["usertype"] = $user_type;
			$_SESSION["id"] = $id;
			$_SESSION["location"] = $location;
			$_SESSION["usertype"] = $usertype;
			$_SESSION["hub_id"] = $cto;
			$_SESSION["airport"] = $location;
			$_SESSION["register_date"] = $register_date;
			$_SESSION["gva_hours"] = $gva_hours;
			$_SESSION["rank_id"] = $rank_id;
			$_SESSION["language"] = $language;
			$_SESSION["access_administration_panel"] = $access_administration_panel;
			$_SESSION["access_va_parameters"] = $access_va_parameters;
			$_SESSION["access_hub_manager"] = $access_hub_manager;
			$_SESSION["access_fleet_type_manager"] = $access_fleet_type_manager ;
			$_SESSION["access_fleet_manager"] = $access_fleet_manager;
			$_SESSION["access_rank_manager"] = $access_rank_manager;
			$_SESSION["access_pilot_manager"] = $access_pilot_manager;
			$_SESSION["access_route_manager"] = $access_route_manager;
			$_SESSION["access_route_assignator"] = $access_route_assignator;
			$_SESSION["access_user_type_manager"] = $access_user_type_manager;
			$_SESSION["access_jump_validator"] = $access_jump_validator;
			$_SESSION["access_flight_validator"] = $access_flight_validator;
			$_SESSION["access_event_manager"] = $access_event_manager;
			$_SESSION["access_notam_manager"] = $access_notam_manager;
			$_SESSION["access_email_manager"] = $access_email_manager;
			$_SESSION["access_language_manager"] = $access_language_manager;
			$_SESSION["access_vam_acars_manager"] = $access_vam_acars_manager;
			$_SESSION["access_financial_parameters"] = $access_financial_parameters;
			$_SESSION["access_tour_manager"] = $access_tour_manager;
			$_SESSION["access_award_manager"] = $access_award_manager;
			$_SESSION["access_training_manager"] = $access_training_manager;
			$_SESSION["access_web_manager"] = $access_web_manager;
			$_SESSION["access_simacars_manager"] = $access_simacars_manager;
			$_SESSION["access_manual_manager"] = $access_manual_manager;
			$_SESSION["access_airports_manager"] = $access_airports_manager;
			// update last visit
			$query = "UPDATE gvausers set last_visit_date=now() where callsign='$user'";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			//  Get info about the pilot for pilot's stadistics
			$query = "select format(sum(quantity),2) money from bank where gvauser_id=$id";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$_SESSION["money"] = $row["money"];
			}
			//  Get count number of manual pireps for pilot's stadistics
			$query = "select count(pirep_id) numpireps from pireps where gvauser_id=$id";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$_SESSION["numpireps"] = $row["numpireps"];
			}
			//  Get plane certifications
			$query = "select plane_icao from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id=$id order by plane_icao asc";
			if (!$result = $db->query($query)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$planes = '';
			while ($row = $result->fetch_assoc()) {
				$planes .= $row["plane_icao"] . '</br>';
			}
			$_SESSION["planes"] = $planes;
			echo "<strong>Login in the Virtual Airlines Manager  " . $_SESSION["username"] . "</strong>";
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./index_vam.php'>";
		} else {
			$db->close();
			header("Location: ./index.php?page=nosession");
		}
	}
?>