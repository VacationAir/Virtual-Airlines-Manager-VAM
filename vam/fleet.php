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
	$planetype = '';
	$planelocation = '';
	$panel_title = FLEET_VA;
	$sql = "select h.status as hangar,f.registry as registry,f.status,f.hours,f.name, f.booked , ft.plane_icao, f.location from fleets f inner join  fleettypes ft on f.fleettype_id=ft.fleettype_id left outer join hangar h on f.fleet_id = h.fleet_id order by plane_icao, location,registry asc";
	if (!isset($_GET["plane_icao"]) || trim($_GET["plane_icao"]) == "") {
	} else {
		$planetype = $_GET['plane_icao'];
		$panel_title = FLEET_VA_TYPE . $planetype;
		$sql = "select * from fleets f, fleettypes ft where f.fleettype_id=ft.fleettype_id and ft.plane_icao='$planetype'  order by plane_icao, location,registry asc";
	}
	if (!isset($_GET["plane_location"]) || trim($_GET["plane_location"]) == "") {
	} else {
		$planelocation = $_GET['plane_location'];
		$panel_title = FLEET_VA_LOC . $planelocation;
		$sql = "select * from fleets f, fleettypes ft where f.fleettype_id=ft.fleettype_id and f.location='$planelocation'  order by plane_icao, location,registry asc";
	}
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
			<div class="panel-heading"><?php echo $panel_title; ?></div>
			<!-- Table -->
			<table class="table table-hover">
				<?php
					echo "<tr><th>" . REGISTRY . "</th><th>" . TYPE . "</th><th>" . LOCATION_PLANE . "</th><th>" . STATUS_PLANE . "</th><th>" . HOURS_PLANE . "</th><th>" . NAME_PLANE . "</th><th>" . BOOKED_PLANE . "</th><th>" . INFO_PLANE . "</th></tr>";
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo $row["registry"] . '</td><td>';
						echo '<a href="./index_vam_op.php?page=fleet_public&plane_icao=' . $row["plane_icao"] . '">' . $row["plane_icao"] . '</a></td><td>';
						echo '<a href="./index_vam_op.php?page=fleet_public&plane_location=' . $row["location"] . '">' . $row["location"] . '</a></td><td>';
						echo $row["status"] . '</td><td>';
						echo $row["hours"] . '</td><td>';
						echo $row["name"] . '</td><td>';
						if ($row["hangar"] == 1) {
							echo PLANE_MAINTENANCE . '</td><td>';
						} else {
							if ($row["booked"] == 1) {
								echo PLANE_BOOKED . ' </td><td>';
							} else {
								echo PLANE_FREE . '</td><td>';
							}
						}
						echo '<a href="./index_vam_op.php?page=plane_info_public&registry_id=' . $row["registry"] . '"><IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
					}
				?>
			</table>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
