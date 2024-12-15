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
	$callsign='';
	$sql = "select a.name as airport_name, iso_country ,gv.callsign as callsign , f.gvauser_id, hu.hub_id,hub, ha.status as hangar,f.registry as registry,f.status,f.hours,f.name, f.booked ,
			ft.plane_icao, f.location
			from fleets f left outer join (select registry,status from hangar where status=1) ha
			on f.registry = ha.registry
			inner join  fleettypes ft on f.fleettype_id=ft.fleettype_id
			inner join hubs hu on hu.hub_id = f.hub_id
			left outer join gvausers gv on f.gvauser_id = gv.gvauser_id
			inner join airports a on a.ident=f.location";
	if (!isset($_GET["plane_icao"]) || trim($_GET["plane_icao"]) == "") {
	} else {
		$planetype = $_GET['plane_icao'];
		$panel_title = FLEET_VA_TYPE . $planetype;
		$sql = "select a.name as airport_name, iso_country ,gv.callsign as callsign, f.gvauser_id ,f.registry as registry,plane_icao,f.location as location,f.hub_id as hub_id, hub, f.status as status,f.name as name,f.hours as hours ,booked, hangar
from fleets f inner join  hubs h  on h.hub_id = f.hub_id inner join fleettypes ft on f.fleettype_id=ft.fleettype_id
left outer join reserves re on f.fleet_id = re.fleet_id
left outer join (select registry,status from hangar where status=1) ha on f.registry = ha.registry
left outer join gvausers gv on f.gvauser_id = gv.gvauser_id
inner join airports a on a.ident=f.location
where  ft.plane_icao ='$planetype'
order by plane_icao, f.location,f.registry asc";
	}
	if (!isset($_GET["plane_location"]) || trim($_GET["plane_location"]) == "") {
	} else {
		$planelocation = $_GET['plane_location'];
		$panel_title = FLEET_VA_LOC . $planelocation;
		$sql = "select a.name as airport_name, iso_country ,gv.callsign as callsign, f.gvauser_id,f.registry as registry,plane_icao,f.location as location,f.hub_id as hub_id, hub, f.status as status,f.name as name,f.hours as hours ,booked, hangar from fleets f inner join  hubs h  on h.hub_id = f.hub_id inner join fleettypes ft on f.fleettype_id=ft.fleettype_id
left outer join reserves re on f.fleet_id = re.fleet_id
left outer join (select registry,status from hangar where status=1) ha on f.registry = ha.registry
left outer join gvausers gv on f.gvauser_id = gv.gvauser_id
inner join airports a on a.ident=f.location
where  f.location ='$planelocation'
order by plane_icao, f.location,f.registry asc";
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
			<div class="panel-heading"><IMG src="images/icons/ic_flight_white_18dp_1x.png">&nbsp;<?php echo $panel_title; ?></div>
			<br>
			<div class="table-responsive" ><table class="table table-hover">
			<!-- Table -->
			<table id="fleet_public" class="table table-hover">
				<?php
					echo '<thead>';
					echo "<tr><th>" . REGISTRY . "</th><th>" . TYPE . "</th><th>" . LOCATION_PLANE . "</th><th>" . HUB . "</th><th>" . STATUS_PLANE . "</th><th>" . HOURS_PLANE . "</th><th>" . NAME_PLANE . "</th><th>" . BOOKED_PLANE . "</th><th>" . INFO_PLANE . "</th></tr>";
					echo '</thead>';
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo '<a href="./index.php?page=plane_info_public&registry_id=' . $row["registry"] . '">' . $row["registry"] . '</a></td><td>';
						echo '<a href="./index.php?page=fleet_public&plane_icao=' . $row["plane_icao"] . '">' . $row["plane_icao"] . '</a></td><td>';
						echo '<IMG src="images/country-flags/'.$row["iso_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=fleet_public&plane_location=' . $row["location"] . '">' . $row["location"] . '</a><br><font size="1">'.$row["airport_name"].'</font></td><td>';
						echo '<a href="./index.php?page=hub&hub_id=' . $row["hub_id"] . '">' . $row["hub"] . '</a></td><td>';
						if  ($row["status"]>=70){
							$bar='progress-bar-success';
						}
						elseif ($row["status"]<70 || $row["status"]>=35 )
							$bar='progress-bar-warning';
						if ($row["status"]<35  )
							$bar='progress-bar-danger';
						?>
						<div class="progress">
						  <?php
    							echo '<div class="progress-bar '. $bar .'" role="progressbar" aria-valuenow="'. $row["status"].'" aria-valuemin="0" aria-valuemax="100" style="width:'.$row["status"].'%">
      '.$row["status"].'% ';
      						?>
						  </td><td></div>
						</div>
						<?php
						echo '<i class="fa fa-clock-o"></i>&nbsp;'.convertTime($row["hours"],$va_time_format) . '</td><td>';
						echo $row["name"] . '</td><td>';
						if ($row["hangar"] == 1) {
							echo '<font color="red">'.PLANE_MAINTENANCE . '</font>	</td><td>';
						} else {
							if ($row["booked"] == 1) {
								echo '<font color="red">'.PLANE_BOOKED .'-['.$row["callsign"]. '] </font></td><td>';
							} else {
								echo '<font color="green">'.PLANE_FREE . '</font></td><td>';
							}
						}
						echo '<a href="./index.php?page=plane_info_public&registry_id=' . $row["registry"] . '"><IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
					}
					$db->close();
				?>
			</table>
			</div>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
