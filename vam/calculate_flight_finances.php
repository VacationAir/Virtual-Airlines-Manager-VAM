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

	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	function calculate_cost ($gvauser_id,$flight_id,$flight_duration,$pax,$fuel,$distance,$db,$reporttype,$route_id,$cargo) {
		$sql_cost = 'select * from financial_parameters where parameter_active=1 and is_cost=1';

		if (!$result_cost = $db->query($sql_cost)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row_cost = $result_cost->fetch_assoc()) {
				$amount=0;
				// Cost by time
				if ($row_cost['linked_to_time']==1){			
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Flight duration: '.$flight_duration;
					$amount = -1 * $row_cost['amount'] * $flight_duration;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";

						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
					

				// Cost by distance
				if ($row_cost['linked_to_distance']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Distance: '.$distance;
					$amount = -1 * $row_cost['amount'] * $distance;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// Cost by pax
				if ($row_cost['linked_to_pax']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Number of PAX: '.$pax;
					$amount = -1 * $row_cost['amount'] * $pax;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// Cost by fuel
				if ($row_cost['linked_to_fuel']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Fuel used: '.$fuel;
					$amount = -1 * $row_cost['amount'] * $fuel;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// Cost by flight
				if ($row_cost['linked_to_flight']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'];
					$amount = -1 * $row_cost['amount'] ;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 
		// End cost

		// Begin income section for regular flights
		$sql_cost = "select * from routes where route_id=$route_id";	
		if (!$result_cost = $db->query($sql_cost)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_cost = $result_cost->fetch_assoc()) {
				// Income by PAX				
				$pax_price = $row_cost['pax_price'];
				$cargo_price = $row_cost['cargo_price'];
				$amount = $pax_price * $pax;
				$descrip= 'Number of PAX:' .$pax.' .Price per PAX:'.$pax_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values (99999,now(),$amount,$gvauser_id,'$descrip','$reporttype','$flight_id')";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
				}

				$amount = $cargo_price * $cargo;
				$descrip= 'Cargo:' .$cargo.' .Price per Cargo Unit:'.$cargo_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values (99998,now(),$amount,$gvauser_id,'$descrip','$reporttype','$flight_id')";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
				}
		}
		// End income for regular flights
		// Begin income section for any flight
		$sql_cost = 'select * from financial_parameters where parameter_active=1 and is_profit=1';

		if (!$result_cost = $db->query($sql_cost)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row_cost = $result_cost->fetch_assoc()) {
				$amount=0;
				// income by time
				if ($row_cost['linked_to_time']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Flight duration: '.$flight_duration;
					$amount =  $row_cost['amount'] * $flight_duration;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";

						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
					

				// income by distance
				if ($row_cost['linked_to_distance']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].').Distance: '.$distance;
					$amount =  $row_cost['amount'] * $distance;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// income by pax
				if ($row_cost['linked_to_pax']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Number of PAX: '.$pax;
					$amount =  $row_cost['amount'] * $pax;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// income by fuel
				if ($row_cost['linked_to_fuel']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Fuel used: '.$fuel;
					$amount = $row_cost['amount'] * $fuel;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// income by flight
				if ($row_cost['linked_to_flight']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'];
					$amount =  $row_cost['amount'] ;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$flight_id')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 		


		// End income for any flight

	} 

	$sql = "select DATE_FORMAT(date_activation_finance_module,'%Y%m%d') as date_activation_finance_module from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$finance_mod_activation_date =  $row['date_activation_finance_module'];
	}
	

	// SIM ACARS flights
	
	$sql = "select gvauser_id, flightid, flight_duration,pax, cargo, block_fuel, distance, route_id,DATE_FORMAT(flight_date,'%Y%m%d') as flight_date from vampireps where validated=1 and flightid not in (select distinct(report_id) from va_finances where report_id is not NULL)";
	
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		
		$diff_days=($row['flight_date']-$finance_mod_activation_date);
		if ($diff_days>=0)
		{
			$gvauser_id =  $row['gvauser_id'];
			$flight_id =  $row['flightid'];
			$flight_duration = $row['flight_duration'];
			$pax =  $row['pax'];
			$cargo =  $row['cargo'];
			$fuel =  $row['block_fuel'];
			$distance =  $row['distance'];
			$reporttype = 'SIM ACARS';
			$route_id =  $row['route_id'];
			calculate_cost ($gvauser_id,$flight_id,$flight_duration,$pax,$fuel,$distance,$db,$reporttype,$route_id,$cargo);
		}

	}

	// Manual reports
	$sql = "select gvauser_id,pirep_id,duration,pax ,cargo,fuel,distance,route,DATE_FORMAT(created_at,'%Y%m%d') as flight_date from pireps where valid=1 and pirep_id not in (select distinct(report_id) from va_finances where report_id is not NULL)";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$diff_days=($row['flight_date']-$finance_mod_activation_date);
		if ($diff_days>=0)
		{
			$gvauser_id =  $row['gvauser_id'];
			$flight_id =  $row['pirep_id'];
			$flight_duration = $row['duration'];
			$pax =  $row['pax'];
			$cargo =  $row['cargo'];
			$fuel =  $row['fuel'];
			$distance =  $row['distance'];
			$route_id =  $row['route'];
			$reporttype = 'Manual report';
			calculate_cost ($gvauser_id,$flight_id,$flight_duration,$pax,$fuel,$distance,$db,$reporttype,$route_id,$cargo);
		}
	}

	// FS KEEPER
	
	$sql = "select gvauser_id,IDPIREP,FlightTime,Passenger,Cargo,BlockFuel,DistanceFlight,route,DATE_FORMAT(CreatedOn,'%Y%m%d') as flight_date from pirepfsfk where validated=1 and IDPIREP not in (select distinct(report_id) from va_finances where report_id is not NULL)";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$diff_days=($row['flight_date']-$finance_mod_activation_date);
		if ($diff_days>=0)
		{		
			$gvauser_id =  $row['gvauser_id'];
			$flight_id =  $row['IDPIREP'];
			$flight_duration = $row['FlightTime'];
			$pax =  $row['Passenger'];
			$cargo =  $row['Cargo'];
			$fuel =  $row['BlockFuel'];
			$distance =  $row['DistanceFlight'];
			$route_id =  $row['route'];
			$reporttype = 'FSKEEPER';
			calculate_cost ($gvauser_id,$flight_id,$flight_duration,$pax,$fuel,$distance,$db,$reporttype,$route_id,$cargo);
		}
	}


?>
