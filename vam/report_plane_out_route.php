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
if ($_SESSION["access_fleet_manager"] == '1')
{
	$sql = "select distinct f.fleet_id as fleetid,DATE_FORMAT(date,'$va_date_format') as last_flight,registry,location,f.name as p_name, a.name as airport_name, a.iso_country , h.hub as hub , h.hub_id
	from fleets f inner join hubs h on (f.hub_id=h.hub_id) inner join airports a on (a.ident=f.location)
	left outer join regular_flights_tracks ft on f.fleet_id=ft.fleet_id
	where f.location not in (select departure from routes where hub_id=f.hub_id); ";

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo RPT_PLANE_OUT_ROUTE; ?></div>
			<br>
			<!-- Table -->
			<table id="report_plane_out" class="table table-hover">
				<thead><tr><th><?php echo REGISTRY;?></th><th><?php echo LAST_REGULAR_FLIGHT;?></th><th><?php echo LOCATION_PLANE;?></th><th><?php echo HUB;?></th><th><?php echo VALIDATE_ACTION;?></th></tr></thead>
				<?php
					if ($_SESSION["access_fleet_manager"] ==1)
    				{
						while ($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td><a target="_blank" href="index_vam_op.php?page=plane_info_public&registry_id='.$row["registry"] .'">'.$row["registry"] .' </a></td>';
							echo '<td>' . $row["last_flight"] .'</td>';
							echo '<td><IMG src="images/country-flags/'.$row["iso_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . $row["location"] .'">'. $row["location"].'</a><br><font size=1>'.$row["airport_name"].'</font></td>';
							echo '<td><a target="_blank" href="index_vam_op.php?page=hub&hub_id='.$row["hub_id"] .'">'.$row["hub"] .' </a></td>';
							echo '<td><a href="./index_vam_op.php?page=report_plane_out_route_move&fleet_id='.$row["fleetid"].'" class="btn btn-danger btn-sm" role="button">'.MOVE_TO_HUB.'</a></td>';
							echo '</tr>';
						}
						echo '</table>';
						$db->close();
					}
				?>
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
