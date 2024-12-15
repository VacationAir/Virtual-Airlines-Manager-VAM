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
	$tour_id = $_GET['tour_id'];
	$pilot = $_GET['pilot_id'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select (UNIX_TIMESTAMP(end_date)+86400)- UNIX_TIMESTAMP(now())as diff_days ,tour_award_image, t.tour_image as tour_image , t.tour_id,  t.tour_name, DATE_FORMAT(t.start_date,'$va_date_format') as start_date, DATE_FORMAT(t.end_date,'$va_date_format') as end_date, t1.tour_lenght as tour_len, t2.num_leg as legs from tours t
  INNER JOIN
(select t.tour_id,sum(leg_length) as tour_lenght from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t1
on t1.tour_id = t.tour_id
  INNER JOIN
(select t.tour_id,count(tour_leg_id) as num_leg from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t2
on t.tour_id = t2.tour_id and t2.tour_id= $tour_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$diff_days = $row["diff_days"];
		$tour_image = $row["tour_image"];
		$tour_award_image = $row["tour_award_image"];
		$tour_name = $row["tour_name"];
		$start_date = $row["start_date"];
		$end_date = $row["end_date"];
		$tour_len = $row["tour_len"];
		$legs= $row["legs"];
	}
?>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_zoom_in_white_18dp_1x.png">&nbsp;<?php echo TOUR_DETAILS ;  ?></div>
			<div class="table-responsive">
				<!-- Table -->
				<table class="table table-hover">
					<?php
						echo "<tr>";
						echo '<td>';
						echo '<img src='.$tour_image.' width="100%" >';
						echo '</td></tr>';
						echo '<td>';
						echo '<img src='.$tour_award_image.' width="100%" >';
						echo '</td></tr>';
						echo '<tr><td>';
						echo '<div class="small"><strong>'.TOURS_NAME.'</strong></div>';
						echo $tour_name . '</td></tr><tr><td>';
						echo '<div class="small"><strong>'.TOURS_START_DATE.'</strong></div>';
						echo $start_date.'</td></tr><tr><td>';
						echo '<div class="small"><strong>'.TOURS_END_DATE.'</strong></div>';
						echo $end_date.'</td></tr><tr><td>';
						echo '<div class="small"><strong>'.TOURS_DISTANCE.'</strong></div>';
						echo $tour_len.'</td></tr><tr><td>';
						echo '<div class="small"><strong>'.TOURS_NUM_LEGS.'</strong></div>';
						echo $legs.'</td>';
						echo '</tr>';
					?>
				</table>
			</div>
		</div>
	</div>
	<?php
		// legs
		$sql ="select leg_number,departure,arrival, IFNULL(status,9) as status from tour_legs tl left OUTER JOIN tour_pilots tp on tp.tour_id = tl.tour_id
and tp.leg_id = tl.leg_number and tp.gvauser_id=$id
where tl.tour_id= $tour_id order by leg_number asc";
	?>
	<div class="col-md-8">
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><IMG src="images/icons/ic_public_white_18dp_1x.png">&nbsp;<?php echo TOUR_LEGS;  ?></div>
			<div class="table-responsive">
				<!-- Table -->
				<table class="table table-hover">
					<?php
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
						if ($diff_days<0) {
							echo "<tr><th>" . DEPARTURE .  "</th><th>" . ARRIVAL .  "</th><th>" . TOURS_LEG_STATUS . "</th>";
						}else {
							echo "<tr><th>" . DEPARTURE .  "</th><th>" . ARRIVAL .  "</th><th>" . TOURS_LEG_STATUS . "</th><th>" . TOURS_LEGS_REPORT . "</th>";
						}
						echo "</tr>";
						while ($row = $result->fetch_assoc()) {
							echo '<tr><td>';
							echo '<IMG src="images/icons/ic_flight_takeoff_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . strtoupper($row["departure"]) . '">' . strtoupper($row["departure"]) . '</a></td><td>';
							echo '<IMG src="images/icons/ic_flight_land_black_18dp_2x.png" WIDTH="20" HEIGHT="20" BORDER=0 ALT="">&nbsp;<a href="./index.php?page=airport_info&airport=' . strtoupper($row["arrival"]) . '">' . strtoupper($row["arrival"]) . '</a></td><td>';
							if ($row["status"]==1)
							{
								echo '<IMG src="images/' . 'accepted.png' . '" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></td><td>';
							}
							elseif ($row["status"]==0)
							{
								echo '<IMG src="images/' . 'pause32.png' . '" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></td><td>';
							}
							elseif ($row["status"]==2)
							{
								echo '<IMG src="images/' . 'rejected.png' . '" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></td><td>';
							}
							else
							{
								echo '</td><td>';
							}
							if ($row["status"]==1)
							{
								echo '</td></tr>';
							}
							elseif ($row["status"]==0)
							{
								echo '</td></tr>';
							}
							elseif ($row["status"]==2)
							{
								if ($diff_days>=0) {
									echo '<a href="./index_vam_op.php?page=tour_report&tourid=' . $tour_id . '&legid=' . $row["leg_number"] . '"><IMG src="images/validate.png" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></a></td></tr>';
								}
							}
							else
							{
								if ($diff_days>=0) {
									echo '<a href="./index_vam_op.php?page=tour_report&tourid=' . $tour_id . '&legid=' . $row["leg_number"] . '"><IMG src="images/validate.png" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></a></td></tr>';
								}
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>
	<div class="clearfix visible-lg"></div>
</div>
