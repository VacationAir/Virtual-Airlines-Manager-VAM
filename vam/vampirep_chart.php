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
	unset($chart_data);
	unset($time_passed);
	unset($altitude);
	unset($ias);
	unset($radio_altitude);
	$chart_data = array();
	$time_passed = array();
	$altitude = array();
	$ias = array();
	$radio_altitude = array();
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql= "select round(time_passed/60,0) as time_passed,altitude, ias,radio_altitude from vam_track where ias>50 and flight_id='" . $vamflightid . "' order by time_passed asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db_map->error . ']');
	}
	$i=0;
	while ($row = $result->fetch_assoc()) {
		$time_passed[$i]=$row["time_passed"];
		$altitude[$i]=$row["altitude"] ;
		$ias [$i]= $row["ias"] ;
		$radio_altitude [$i]= $row["radio_altitude"] ;
		$i=$i+1;
	}
	$chart_data[0]=$time_passed;
	$chart_data[1]=$altitude;
	$chart_data[2]=$ias;
	$chart_data[3]=$radio_altitude;
?>
	<div class="panel-body">
		<div class="panel-body">
			<canvas id="typeplane" height="400" width="1100"></canvas>
			<script>
				var time_passed = new Array();
				var altitude = new Array();
				var ias = new Array();
				var radio_altitude = new Array();
				time_passed=<?php echo json_encode($chart_data[0]); ?>;
				altitude=<?php echo json_encode($chart_data[1]); ?>;
				ias=<?php echo json_encode($chart_data[2]); ?>;
				radio_altitude=<?php echo json_encode($chart_data[3]); ?>;
				var data = {
					labels: time_passed ,
					datasets: [
						{
							label: "Altitude",
							fillColor: "rgba(151,187,205,0.2)",
							strokeColor: "rgba(151,187,205,1)",
							pointColor: "rgba(151,187,205,1)",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(151,187,205,1)",
							data: altitude
						}
					]
				};
				var canvas_planetype = document.getElementById("typeplane");
				var ctx_planetype = canvas_planetype.getContext("2d");
				new Chart(ctx_planetype).Line(data,{showTooltips: false, responsive: true});
			</script>
		</div>
	</div>
