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
<?php include('va_parameters.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} $sql = "select * from va_parameters "; if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
} while ($row = $result->fetch_assoc()) {
	$no_count_rejected = $row["no_count_rejected"];
} if ($no_count_rejected == 1) {
	$sql = "select a.name as airport_name, iso_country, gu.hub_id as hubid,v.gva_hours,transfered_hours,gvauser_id,callsign,surname,activation,vatsimid,ivaovid ,transfered_hours, rank, gu.name as name,hub,location, r.image_url as rank_image, iso2, short_name from country_t c, gvausers gu, ranks r, hubs h, (select 0 + sum(time) as gva_hours, pilot from v_pilot_roster_rejected vv group by pilot) as v , airports a where a.ident=gu.location and gu.rank_id=r.rank_id and h.hub_id=gu.hub_id and gu.activation
<>0 and gu.country=c.iso2 and v.pilot = gu.gvauser_id order by callsign asc";
} else {
	$sql = "select a.name as airport_name, iso_country, gu.hub_id as hubid,v.gva_hours,transfered_hours,gvauser_id,callsign,surname,activation,vatsimid,ivaovid ,transfered_hours, rank, gu.name as name,hub,location, r.image_url as rank_image, iso2, short_name from country_t c, gvausers gu, ranks r, hubs h, (select 0 + sum(time) as gva_hours, pilot from v_pilot_roster vv group by pilot) as v , airports a where a.ident=gu.location and gu.rank_id=r.rank_id and h.hub_id=gu.hub_id and gu.activation
    <>0 and gu.country=c.iso2 and v.pilot = gu.gvauser_id order by callsign asc";
} if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
}?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_group_white_18dp_1x.png">&nbsp;<?php echo PILOT_ROSTER; ?></div>
			<br>
			<!-- Table -->
			<table id="pilots_public" class="table table-hover">
					<?php
						echo '<thead>';
						echo "<tr><th>" . CALLSIGN . " </th><th>" . NAME . "</th><th>" . HUB . "</th><th>" . LOCATION . "</th><th>" . HOURS . "</th><th>" . RANK . "</th><th>" . COUNTRY . "</th><th>" . STATUS . "</th>";
						if ($ivao == 1) echo '<th>' . IVAOID . '</th>';
						if ($vatsim == 1) echo '<th>' . VATSIMID . '</th>';
						echo "</tr>";
						echo '</thead>';
						while ($row = $result->fetch_assoc()) {
						echo "
                            <td>";
						echo '<a href="./index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["callsign"] . '</a>
                            </td>
                            <td>';
						echo $row["name"] . ' ' . $row["surname"] . '</td>
                            <td>';
						echo '<a href="./index.php?page=hub&hub_id='.$row["hubid"] .'">'. $row["hub"].'</a></td>
                            <td>';
						echo '<IMG src="images/country-flags/'.$row["iso_country"].'.png"  ALT="">&nbsp;<a href="./index.php?page=airport_info&airport='.$row["location"] .'">'. strtoupper($row["location"]).'</a><br><font size=1>'.str_replace("Airport","",$row["airport_name"]).'</font></td>
                            <td>';
						echo '<i class="fa fa-clock-o"></i>&nbsp;'.convertTime((round($row["gva_hours"] , 2) + round($row["transfered_hours"] , 2)),$va_time_format) . '</td>
                            <td>';
						if (strlen($row["rank_image"]) > 0) {
							echo '<img src="' . $row["rank_image"] . '">' . ' ';
						}
						echo $row["rank"] . '</td>
                            <td>';;
						echo '<img src="./images/country-flags/' . $row["iso2"] . '.png" alt="' . $row["iso2"] . '">' . ' ' . $row["short_name"] . '</td>
                            <td>';
						if ($row["activation"] == 1) echo '<img src="./images/green-user-icon.png" height="25" width="25" </td>'; else echo '<img src="./images/red-user-icon.png" height="25" width="25" </td>';
						if ($ivao == 1) {
							echo '
                                <td><a href="https://www.ivao.aero/Member.aspx?ID=' . $row["ivaovid"] . '">' . $row["ivaovid"] . '</a>
                                </td>';
						}
						if ($vatsim == 1) {
							echo '
                                <td><a href="http://www.vataware.com/pilot/' . $row["vatsimid"] . '">' . $row["vatsimid"] . '</a>
                                </td>';
						}
						echo '</tr>';
					} $db->close(); ?>
			</table>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
