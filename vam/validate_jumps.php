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
	if ($_SESSION["access_jump_validator"] == '1')
	{
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "select a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,gvauser_id,callsign, from_airport, to_airport, j.id as id, date_format(date,'$va_date_format') as date_jump from jumps j, airports a1 , airports a2 where from_airport=a1.ident and to_airport=a2.ident and paid=0";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo VALIDATE_JUMPS; ?></div>
				<br>
				<!-- Table -->
				<table id="validate_jumps" class="table table-hover">
					<?php
					echo '<thead>';
					echo "<tr><th>" . VALIDATE_JUMP_CALLSIGN . " </th><th>" . VALIDATE_JUMP_DEPARTURE . "</th><th>" . VALIDATE_JUMP_ARRIVAL . "</th><th>" . VALIDATE_JUMP_DATE . "</th><th>" . VALIDATE_JUMP_JUMP1 . "</th><th>" . VALIDATE_JUMP_JUMP2 . "</th><th>" . VALIDATE_JUMP_JUMP3 . "</th></tr>";
					echo '</thead>';
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo '<a href="./index_vam_op.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["callsign"] . '</a></td><td>';
						echo '<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . $row["from_airport"] . '">' . strtoupper($row["from_airport"]) . '</a><br><font size="1">'.str_replace("Airport","",$row["dep_name"]).'</font> </td><td>';
						echo '<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<IMG src="images/country-flags/'.$row["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . $row["to_airport"] . '">' . strtoupper($row["to_airport"]) . '</a><br><font size="1">'.str_replace("Airport","",$row["arr_name"]).'</font> </td><td>';
						echo $row["date_jump"] . '</td><td>';
						echo '<a href="./index_vam_op.php?page=accept_jump&jump=' . $row["id"] . '&from_airport=' . $row["from_airport"] . '&to_airport=' . $row["to_airport"] . '&pilot=' . $row["gvauser_id"] . '&type=national"><IMG src="images/Edit-Validated-48.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td><td>';
						echo '<a href="./index_vam_op.php?page=accept_jump&jump=' . $row["id"] . '&from_airport=' . $row["from_airport"] . '&to_airport=' . $row["to_airport"] . '&pilot=' . $row["gvauser_id"] . '&type=continental"><IMG src="images/Edit-Validated-48.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td><td>';
						echo '<a href="./index_vam_op.php?page=accept_jump&jump=' . $row["id"] . '&from_airport=' . $row["from_airport"] . '&to_airport=' . $row["to_airport"] . '&pilot=' . $row["gvauser_id"] . '&type=intercontinental"><IMG src="images/Edit-Validated-48.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
						}
					?>
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
