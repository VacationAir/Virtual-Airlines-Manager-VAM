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
	require('check_login.php');
	include ("./helpers/get_metar.php");
	$id=$_SESSION["id"];
	if (is_logged())
	{
		$route = $_GET['route'];
		$plane = $_GET['plane'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$reserve_exists=0;
		$cnt_reserve = 0;
		$sql = "select count(*) as cnt from reserves where gvauser_id=$id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$cnt_reserve = $row['cnt'] ;
		}
		if ($cnt_reserve>0)
		{
			$reserve_exists= 1;
		}
		if ($reserve_exists<1)
		{
			$sql = "UPDATE gvausers set route_id=$route where gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$sql = "UPDATE fleets set booked=1, gvauser_id= $id, booked_at=now() where fleet_id=$plane";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			// Set number of PAX & cargo and get plane details
			$sql = "select * from fleets f inner join fleettypes ft on (f.fleettype_id = ft.fleettype_id) and f.fleet_id=$plane";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$pax =  intval ($row['pax'] * (rand (85,100) / 100));
				$cargo =  intval ($row['cargo_capacity'] * (rand (85,100) / 100));
				$registry = $row['registry'] ;
				$name = $row['name'] ;
				$plane_icao = $row['plane_icao'] ;
				$status = $row['status'] ;
			}
			$sql = "delete from reserves where gvauser_id=$id";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$sql = "INSERT into reserves (route_id,gvauser_id,fleet_id,pax,cargo) values ($route,$id,$plane,$pax,$cargo)";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		}
			$sql = "select f.status as status,r.pax as pax,departure,arrival,cargo,flight,flproute , flight_level, plane_icao, name, registry, cargo from fleets f inner join fleettypes ft on (f.fleettype_id = ft.fleettype_id)
			inner join reserves r on (r.gvauser_id=f.gvauser_id)
			inner join routes ro on (ro.route_id=r.route_id)
			and f.fleet_id=$plane";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()) {
				$pax =  $row['pax'] ;
				$cargo = $row['cargo'];
				$registry = $row['registry'] ;
				$name = $row['name'] ;
				$plane_icao = $row['plane_icao'] ;
				$status = $row['status'] ;
				$departure = $row['departure'] ;
				$arrival = $row['arrival'] ;
				$flight = $row['flight'] ;
				$flproute = $row['flproute'] ;
				$flight_level = $row['flight_level'] ;
				$status = $row['status'] ;
			}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo BOOK_ROUTE_CONFIRMATION; ?></div>
			<div class="alert alert-success" role="alert"><?php echo BOOK_ROUTE_CONFIRM; ?></div>
			<a href="<?php echo "./index_vam_op.php?page=cancel_reserve&plane=$plane&route=$route"; ?>"
			   class="btn btn-block btn-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>
			   <?php echo BOOK_ROUTE_CANCEL_BTN; ?></a>
		<div>
	<div>
<div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<!-- Table -->
			<table class="table table-hover">
				<?php
					echo "<tr>";
					echo '<td>';
					echo FLIGHT_VA . '</td>';
					echo '<td>' . $flight . ' </td></tr><tr>';
					echo '<td>';
					echo DEPARTURE . '</td>';
					echo '<td>' . $departure . ' </td></tr><tr>';
					echo '<td>';
					echo ARRIVAL . '</td>';
					echo '<td>' . $arrival . ' </td></tr><tr>';
					echo '<td>';
					echo AIRCRAFT_DETAILS_PAX . '</td>';
					echo '<td>' . $pax . ' </td></tr><tr>';
					echo '<td>';
					echo VAMACARS_CARGO . '</td>';
					echo '<td>' . $cargo . ' </td></tr><tr>';
					echo '<td>';
					echo ROUTE_PLANE . '</td>';
					echo '<td>' . $plane_icao . ' </td></tr><tr>';
					echo '<td>';
					echo BOOK_ROUTE_ARICRAFT_REG . '</td>';
					echo '<td>' . $registry . ' </td></tr><tr>';
					echo '<td>';
					echo NAME_PLANE . '</td>';
					echo '<td>' . $name . ' </td></tr><tr>';
					echo '<td>';
					echo STATUS_PLANE . '</td>';
					echo '<td>' . $status . ' %</td></tr><tr>';
					echo '<td>';
					echo BOOK_ROUTE_ROUTE . '</td>';
					echo '<td>' . $flproute . ' </td></tr><tr>';
					echo '<td>';
					echo VAMACARS_FLIGHT_LEVEL . '</td>';
					echo '<td>' . $flight_level . ' </td></tr><tr>';
					echo '</table>';
				?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_cloud_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_METAR; ?></div>
			<table class="table table-hover">
				<tr>
					<?php
						get_metar($departure);
					?>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><IMG src="images/icons/ic_cloud_white_18dp_1x.png">&nbsp;<?php echo AIRPORT_AIRPORT_METAR; ?></div>
			<table class="table table-hover">
				<tr>
					<?php
						get_metar($arrival);
					?>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php
	}
	else
	{
		include("./notgranted.php");
	}
?>