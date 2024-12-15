<?php

	/*--HEADER--------------------------------------------------------------------------*/
	/*                                                                                  */
	/*    Project   : Live ACARS Demo Web Service v3.0.1                                */
	/*    Author    : Thomas Molitor                                                    */
	/*    Company   : Thomas Molitor EDV Service                                        */
	/*    Copyright : Copyright � 2002-2009 Thomas Molitor                              */
	/*                                                                                  */
	/*    Notes:                                                                        */
	/*    Position decoding written by Jens Roedel (jens@roedel-leo.de)                 */
	/*                                                                                  */
	/*                                                                                  */
	/*--END-----------------------------------------------------------------------------*/
?>

<html>

<head>
	<meta http-equiv="Content-Language" content="en-us">
	<title>FS Flight Keeper - Live ACARS Demo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<meta http-equiv="Refresh" content="60">
<meta http-equiv="Expires" content="0">
<body>

<body>

<script
	src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAIFijcIOPdRPte_dCcaStTRQQKc1gSKr6lXqMKj_YQ4_QvOBxDhTb9pmXxuRb2AfmGZZQjG6BK53EOA"
	type="text/javascript"></script>

<?php
	function DateAdd($interval , $number , $date)
	{
		$date_time_array = getdate($date);
		$hours = $date_time_array['hours'];
		$minutes = $date_time_array['minutes'];
		$seconds = $date_time_array['seconds'];
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];
		switch ($interval) {
			case 'y':
			case 'yyyy':
				$year += $number;
				break;
			case 'q':
				$year += ($number * 3);
				break;
			case 'm':
				$month += $number;
				break;
			case 'd':
			case 'w':
				$day += $number;
				break;
			case 'ww':
				$day += ($number * 7);
				break;
			case 'h':
				$hours += $number;
				break;
			case 'n':
				$minutes += $number;
				break;
			case 's':
				$seconds += $number;
				break;
		}
		$timestamp = mktime($hours , $minutes , $seconds , $month , $day , $year);
		return $timestamp;
	}

	/* Connect to Database */
	$link = mysql_connect("host" , "user" , "password")
	or die("SQL Server connection failed.");

	mysql_select_db("ddb2575") or die("Database connection failed.");

	/* Delete not responding flights (LastMessage older than 30 minutes) */
	$query = "DELETE FROM liveacars WHERE LastMessage <= " . date("YmdHis" , dateadd("n" , -30 , time())) . ";";
	$result = mysql_query($query) or die("0|SQL query failed");

	// Execute SQL query
	$query = "SELECT IDPilot, Position, Status, PilotName, Airline, FlightNumber, Aircraft, Passenger, Cargo, FlightPlan, CurrentWaypoint, FPLatitudes, FPLongitudes, TrueHeading, Altitude, IAS, TAS  FROM liveacars";
	if (isset($_REQUEST["ID"])) $query = $query . " WHERE IDFlight = '" . $_REQUEST["ID"] . "'";
	$result = mysql_query($query) or die("SQL query failed !");

	$count = mysql_num_rows($result);
	if ($count >= 1) {
		?>
		<u><strong>&nbsp;<a href="Index.php">Back to overview</a>&nbsp;</strong></u><BR><BR>

		<center>
		<div align="center" id="map" style="width: 800px; height: 600px"></div>
		<script type="text/javascript">
		//<![CDATA[

		function createMarker(point, markerOptions, infoHTML) {
			var marker = new GMarker(point, markerOptions);

			GEvent.addListener(marker, "click", function () {
				marker.openInfoWindowHtml('<div style="width:500px;height:155px" align=left><font size=2>' + infoHTML + '</font></div>');
			});
			return marker;
		}

		var map = new GMap2(document.getElementById("map"));
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		map.addControl(new GOverviewMapControl());
		map.enableDoubleClickZoom();
		map.enableScrollWheelZoom();
		map.enableContinuousZoom();

		var iconAirport = new GIcon();
		iconAirport.image = 'Images/mm_20_blue.png';
		iconAirport.shadow = 'Images/mm_20_shadow.png';
		iconAirport.iconSize = new GSize(12, 20);
		iconAirport.shadowSize = new GSize(22, 20);
		iconAirport.iconAnchor = new GPoint(6, 20);
		iconAirport.infoWindowAnchor = new GPoint(5, 1);

		var iconWaypoint = new GIcon();
		iconWaypoint.image = 'Images/mm_20_red.png';
		iconWaypoint.shadow = 'Images/mm_20_shadow.png';
		iconWaypoint.iconSize = new GSize(12, 20);
		iconWaypoint.shadowSize = new GSize(22, 20);
		iconWaypoint.iconAnchor = new GPoint(6, 20);
		iconWaypoint.infoWindowAnchor = new GPoint(5, 1);

		var iconCurWaypoint = new GIcon();
		iconCurWaypoint.image = 'Images/mm_20_orange.png';
		iconCurWaypoint.shadow = 'Images/mm_20_shadow.png';
		iconCurWaypoint.iconSize = new GSize(12, 20);
		iconCurWaypoint.shadowSize = new GSize(22, 20);
		iconCurWaypoint.iconAnchor = new GPoint(6, 20);
		iconCurWaypoint.infoWindowAnchor = new GPoint(5, 1);

		<?php
				if ($count != 1)
					print "map.setCenter(new GLatLng(0, 0), 1, G_HYBRID_MAP);";

				while ($row = mysql_fetch_array($result)) {

					/************************************************************/
					 /* Code section written by Jens Roedel (jens@roedel-leo.de) */
					/* Zerteilen der Positionsangabe */
					$arr=explode(" ", $row[1]); /*Zerlegt den Position String in seine Bestandteile anhand des Space trenners */
					$pos1= reset($arr); /* Liest den L�ngengrad aus */
					next($arr);
					$pos2= current($arr); /* Liest die Minutenagabe des L�ngengradwertes aus */
					next($arr);
					$pos3= current($arr); /* Liest den breitengrad aus */
					next($arr);
					$pos4= current($arr); /* Liest die Minutenangabe des breitengrad aus */

					/* Umwandel von NS in UMT format */
					$NS_zuordnung1=str_replace("S", "-", "$pos1"); /*Sucht  ob in der L�ngengradangabe ein S ist und ersetzt dies durch ein - */
					$NS_zuordnung_f= str_replace("N", "", "$NS_zuordnung1"); /*Sucht on in der L�ngengradangabe ein N ist und l�st dies */

					/*Berechnen der NS Minuten in Grad */
					$NS_Grad="$pos2" / 60; /* Rechnet den Minutenwert der L�mgengradangabe in Grad um*/
					/*Berechnen des NS in Grad */
					$NS_Erg_z=strstr($NS_Grad, "."); /*L�scht die stellen vor dem Komma aus dem berechnungsergebnis */
					$NS_arr[0]= $NS_zuordnung_f; /* Schreibt beide Gradwerte in ein ARREY zum sp�teren zusammenf�gen */
					$NS_arr[1]= $NS_Erg_z;
					$NS_Erg=implode("", $NS_arr); /* F�gt die beiden Gradwerte aus dem ARREY zusammen */
					$NS_aus=sprintf("%01.4f", $NS_Erg); /* K�rtz die Gradangabe auf 4 Stellen nach dem Komma */

					/* Umwandel von EW in UMT format */
					$EW_zuordnung1=str_replace("W", "-", "$pos3"); /*Sucht  ob in der Breitengradangabe ein W ist und ersetzt dies durch ein - */
					$EW_zuordnung_f= str_replace("E", "", "$EW_zuordnung1"); /*Sucht on in der L�ngengradangabe ein E ist und l�st dies */

					/*Berechnen der NS Minuten in Grad */
					$EW_Grad="$pos4" / 60; /* Rechnet den Minutenwert der Breitengradangabe in Grad um*/
					/*Berechnen des NS in Grad */
					$EW_Erg_z=strstr($EW_Grad, "."); /*L�scht die stellen vor dem Komma aus dem berechnungsergebnis */
					$EW_arr[0]= $EW_zuordnung_f; /* Schreibt beide Gradwerte in ein ARREY zum sp�teren zusammenf�gen */
					$EW_arr[1]= $EW_Erg_z;
					$EW_Erg=implode("", $EW_arr); /* F�gt die beiden Gradwerte aus dem ARREY zusammen */
					$EW_aus=sprintf("%01.4f", $EW_Erg); /* K�rtz die Gradangabe auf 4 Stellen nach dem Komma */
					/************************************************************/

					if ($count == 1) {
		?>
		map.setCenter(new GLatLng(<?php echo "$NS_aus"; ?>, <?php echo "$EW_aus"; ?>), <?php if ($row[2] == 2) echo "9"; else echo "16"; ?>, G_HYBRID_MAP);

		<?php
					}

					if (strlen($row[9]) > 0 && strlen($row[11]) > 0 && strlen($row[12]) > 0 && $count == 1)
					{
						$plan = split("~", $row[9]);
						$latitudes = split("~", $row[11]);
						$longitudes = split("~", $row[12]);

						print "		        var flightplan = new GPolyline([";
						for ($i = 0; $i < count($plan); $i++)
						{
							if ($i != 0) print ", ";
							print "\n        		    new GLatLng(".$latitudes[$i].", ".$longitudes[$i].")";
						}
						print "], \"#00ff00\", 3, 0.5, { geodesic: true });";

			?>

		map.addOverlay(flightplan);
		<?php
					$countPlan = count($plan);
					for ($i = 0; $i < $countPlan; $i++)
					{
						if ($i == 0 || $i == $countPlan - 1) {
							$icon = "Airport";
							$iconTitle = "Airport";
						}
						elseif ($row[10] == $plan[$i - 1]) {
							$icon = "CurWaypoint";
							$iconTitle = "Current Waypoint";
						}
						else {
							$icon = "Waypoint";
							$iconTitle = "Waypoint";
						}
		?>
		map.addOverlay(new GMarker(new GPoint(<?php print $longitudes[$i]; ?>, <?php print $latitudes[$i]; ?>), {
			title: '<?php print $iconTitle.": ".$plan[$i]; ?>',
			icon: <?php print "icon".$icon; ?>
		}));
		<?php
					}
				}

				if ($row[13] == -1)
				{
					$icon = "0";
				}
				else
				{
					for ($i = 2; $i < 360; $i += 5)
					{
						if ($row[13] >= ($i - 2) && $row[13] <= ($i + 2))
						{
							$icon = $i - 2;
						}
					}
				}

				$status = "Flight: ".$row[4]." (".$row[5].") - ".$row[6]."<br>Pilot: ".$row[3];
				$status = $status."<br>Route: ";
				if ($countPlan > 0)
				{
					for ($i = 0; $i < $countPlan; $i++)
					{
						if ($i > 0) {
							$status = $status."-";
							if ($row[10] == $plan[$i - 1])
								$status = $status."<b>[".$plan[$i]."]</b>";
							else
								$status = $status.$plan[$i];
						}
						else
							$status = $status.$plan[$i];
					}
				}
				else
					$status = $status."None";
				$status = $status."<br>Status: ";
				switch ($row[2]) {
					case 0:
						$status = $status."Boarding";
						break;

					case 1:
						$status = $status."Taxiing";
						break;

					case 2:
						$status = $status."Airborne";
						break;

					case 3:
						$status = $status."Landed";
						break;

					case 4:
						$status = $status."Parking";
						break;
				}
				if ($row[14] != -1) $status = $status."<br>Altitude: ".$row[14]."ft";
				if ($row[2] == 2)
				{
					if ($row[15] != -1 && $row[16] != -1)
						$status = $status."<br>IAS/TAS: ".$row[15]."/".$row[16]. " kts";
				}
				elseif ($row[15] != -1)
					$status = $status."<br>IAS: ".$row[15]." kts";
				$status = $status."<br>Passenger: ".$row[7];
				$status = $status."<br>Cargo: ".$row[8];
		?>

		var iconACARS = new GIcon(G_DEFAULT_ICON);
		iconACARS.image = "Images/ACARS_<?php echo "$icon"; ?>.png";
		iconACARS.iconSize = new GSize(24, 24);
		iconACARS.iconAnchor = new GPoint(12, 12);
		iconACARS.infoWindowAnchor = new GPoint(12, 2);
		iconACARS.shadowSize = new GSize(0, 0);

		map.addOverlay(createMarker(new GPoint(<?php echo "$EW_aus"; ?>, <?php echo "$NS_aus"; ?>), {
			title: '<?php print $row[3]; ?>',
			icon: iconACARS
		}, "<?php print $status; ?>"));
		<?php
				}
		?>
		//]]>
		</script>
		</center>
	<?php
	} else {
		print "There are currently no Flights available. Please try again later.";
	}
?>

</body>
</html>
