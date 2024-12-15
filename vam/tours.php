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
	$panel_title = TOURS_VA;
	$sql = "select t.tour_id,  t.tour_name, DATE_FORMAT(t.start_date,'$va_date_format') as start_date, DATE_FORMAT(t.end_date,'$va_date_format') as end_date, t1.tour_lenght as tour_len, t2.num_leg as legs from tours t
  INNER JOIN
  (select t.tour_id,sum(leg_length) as tour_lenght from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t1
on t1.tour_id = t.tour_id
  INNER JOIN
  (select t.tour_id,count(tour_leg_id) as num_leg from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t2
on t.tour_id = t2.tour_id";
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
			<div class="panel-heading"><IMG src="images/icons/ic_device_hub_white_18dp_1x.png">&nbsp;<?php echo $panel_title; ?></div>
			<div class="table-responsive">
			<br>
			<!-- Table -->
			<table id="tours" class="table table-hover">
				<?php
					echo '<thead>';
					echo "<tr><th>" . TOURS_NAME . "</th><th>" . TOURS_START_DATE . "</th><th>" . TOURS_END_DATE . "</th><th>" . TOURS_NUM_LEGS . "</th><th>" . TOURS_DISTANCE . "</th><th>" . INFO_PLANE . "</th></tr>";
					echo '</thead>';
					while ($row = $result->fetch_assoc()) {
						echo "<td>";
						echo $row["tour_name"] . '</td><td>';
						echo $row["start_date"] . '</td><td>';
						echo $row["end_date"] . '</td><td>';
						echo $row["legs"] . '</td><td>';
						echo $row["tour_len"] . '</td><td>';
						echo '<a href="./index.php?page=tour_detail&tour_id=' . $row["tour_id"] . '"><IMG src="./images/icons/ic_info_outline_black_24dp_1x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT=""></a></td></tr>';
					}
					$db->close();
				?>
			</table>
			</div>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
