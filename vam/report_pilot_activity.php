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
if ($_SESSION["access_pilot_manager"] == '1')
{
	$sql = "select UNIX_TIMESTAMP(max_date) as max_date,DATE_FORMAT(warning_date,'$va_date_format') as warning_date,
	        DATE_FORMAT(max_date,'$va_date_format') as max_date_va,
			DATE_FORMAT(last_visit_date,'$va_date_format') as last_visit_date ,g.gvauser_id, name,surname, callsign, email
			from gvausers g left outer join
			(SELECT pilot,MAX(date) AS max_date FROM v_total_data_flight group by pilot) t
			 on (g.gvauser_id=t.pilot) left outer join pilot_warning pw on (g.gvauser_id=pw.gvauser_id) where activation=1 order by max_date asc";
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
			<div class="panel-heading"><IMG src="images/icons/ic_group_white_18dp_1x.png">&nbsp;<?php echo RPT_PILOT_ACT; ?></div>
			<br>
			<!-- Table -->
			<table id="report_pilot" class="table table-hover">
				<thead><tr><th><?php echo CALLSIGN;?></th><th><?php echo NAME;?></th><th><?php echo 'last flight';?></th><th><?php echo RPT_PILOT_WARNING;?></th><th><?php echo 'last login';?></th><th><?php echo VALIDATE_ACTION;?></th></tr></thead>
				<?php
					if ($_SESSION["access_fleet_manager"] ==1)
    				{
						while ($row = $result->fetch_assoc()) {
							echo '<tr>';
							echo '<td><a target="_blank" href="index_vam_op.php?page=pilot_details&pilot_id='.$row["gvauser_id"] .'">'.$row["callsign"] .' </a></td>';
							echo '<td>' . $row["name"].' '.$row["surname"] .'</td>';
							echo '<td>' . $row["max_date_va"].'</td>';
							echo '<td>' . $row["warning_date"].'</td>';
							echo '<td>' . $row["last_visit_date"].'</td>';
							echo '<td><a href="./index_vam_op.php?page=report_pilot_activity_warning&pilot='.$row["gvauser_id"].'" class="btn btn-info btn-sm" role="button">'.SEND_WARNING.'</a>&nbsp;&nbsp;<a href="./index_vam_op.php?page=pilot_inactivate&id='.$row["gvauser_id"].'" class="btn btn-danger btn-sm" role="button">'.INACTIVATE.'</a></td>';
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
