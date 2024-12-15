<!DOCTYPE html>
<html lang="en">
<head>
	<title>Virtual Arilines Manager</title>
	<META http-equiv=Content-Type content="text/html; charset=ISO-8859-1">
	<link href="css/vam.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript">
		window.onload = function () {
			var tfrow = document.getElementById('tfhover').rows.length;
			var tbRow = [];
			for (var i = 1; i < tfrow; i++) {
				tbRow[i] = document.getElementById('tfhover').rows[i];
				tbRow[i].onmouseover = function () {
					this.style.backgroundColor = '#EFF8FB';
				};
				tbRow[i].onmouseout = function () {
					this.style.backgroundColor = '#ffffff';
				};
			}
		};
	</script>
</head>
<body>
<div>
	<section id="content">
		<article>
			<div>
				<div>
					<?php
						include('db_login.php');
						$db = new mysqli($db_host , $db_username , $db_password , $db_database);
						if ($db->connect_errno > 0) {
							die('Unable to connect to database [' . $db->connect_error . ']');
						}
						$sql = "select pirep_id as id,comment,valid as status,pirep_id as flight,from_airport departure, to_airport arrival ,date,distance,duration,charter, 'pirep' as type ,flight as flight
from pireps where gvauser_id=$id
UNION
select pirepfsfk_id as id,'' as comment,validated as status,pirepfsfk_id as flight, SUBSTRING(OriginAirport,1,4) departure, SUBSTRING(DestinationAirport,1,4) arrival , CreatedOn as date, DistanceFlight as distance, FlightTime as duration, charter , 'keeper' as type , '' as flight
from pirepfsfk where gvauser_id=$id
UNION
SELECT report_id as id,'' as comment , validated as status, report_id as flight , origin_id as departure, destination_id as arrival, date, distance, duration, charter, 'Fsacars' as type, '' as flight
from reports where pilot_id=$id order by date desc, id desc";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query  [' . $db->error . ']');
						}
					?>
					<h2>Vuelos realizados</h2>
					<div class="datagrid">
						<?php
							echo '<table id="tfhover" class="tftable" >';
							echo "<tr><th>Origen</th><th>Destino</th><th>Fecha</th><th>Duraci�n</th><th>Distancia</th><th>Tipo</th><th>Validaci�n</th><th>Detalles</th></tr>";
							while ($row = $result->fetch_assoc()) {
								echo "<td>";
								echo $row["departure"] . '</td><td>';
								echo $row["arrival"] . '</td><td>';
								echo $row["date"] . '</td><td>';
								echo number_format($row["duration"] , 2) . '</td><td>';
								echo number_format($row["distance"] , 0) . '</td><td>';
								if ($row["status"] == 0)
									$status_image = 'pause32.png';
								else if ($row["status"] == 1)
									$status_image = 'accepted.png';
								else
									$status_image = 'rejected.png';
								if ($row["charter"] == 1) {
									echo 'Charter' . '</td><td>';
								} else {
									echo 'Regular - ' . $row["flight"] . '</td><td>';
								}
								echo '<IMG src="images/' . $status_image . '" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></td><td>';
								if ($row["type"] == 'pirep') {
									echo '<a href="" title="' . $row["comment"] . '">Comentario</a></td></tr>';
								} elseif ($row["type"] == 'keeper') {
									echo '<a href="./index_vam_op.php?page=PIREPDetails&ID=' . $row["id"] . '"><IMG src="icons/ic_info_outline_black_24dp_1x.png" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></a></td></tr>';
								} elseif ($row["type"] == 'Fsacars') {
									echo '<a href="./index_vam_op.php?page=FSACARSDetails&ID=' . $row["id"] . '"><IMG src="icons/ic_info_outline_black_24dp_1x.png" WIDTH="25" HEIGHT="25" BORDER=0 ALT=""></a></td></tr>';
								}
							}
							echo "</table>";
						?>
					</div>
				</div>
			</div>
		</article>
	</section>
</div>
</body>
</html>
