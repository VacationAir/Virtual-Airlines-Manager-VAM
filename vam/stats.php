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
	include('get_va_data.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	// select current day
	$sql = " select day(now()) as 'current_day', month(now()) as 'current_month'  , year(now()) as 'current_year' ; ";
	$current_day;
	$current_month;
	$current_year;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$current_day = $row['current_day'];
		$current_month = $row['current_month'];
		$current_year = $row['current_year'];
	}
	// Calculation for flights per month
	$days = '';
	$count_per_day = '';
	$count_per_day2 = '';
	for ($i = 1 ; $i <= $current_day ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(sum(c),0) as co from v_flights_pilots where date_format(flightdate,'%m')=date_format(now(),'%m') and date_format(flightdate,'%d')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_day = $count_per_day . ',' . $row2['co'];
			//$count_per_day2 = $count_per_day2 . "{ day: '".$current_year.'-'.$current_month.'-'.$i."', value: ".$row2['co']." },";
			$count_per_day2 = $count_per_day2 . "{ day: '".$i."', flights: ".$row2['co']." },";
		}
	}
	$days = substr($days , 1);
	$count_per_day = substr($count_per_day , 1);
	// Calculation global % Charter VS Regular
	$totalflights = $num_pireps + $num_reports + $num_fskeeper + $num_vamacars;
	$totalregularflights = $num_reports_reg + $num_pireps_reg + $num_fskeeper_reg + $num_vamacars_reg;
	$totalcharterflights = $totalflights - $totalregularflights;
	if ($totalflights == 0) {
		$percregularflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
	}
	$perccharterflights = round(100 - $percregularflights , 2);
	// Calculation for type of report
	if ($totalflights == 0) {
		$percfsacars = 0;
	} else {
		$percfsacars = round(($num_reports * 100) / $totalflights , 2);
	}
	if ($totalflights == 0) {
		$percfskeeper = 0;
	} else {
		$percfskeeper = round(($num_fskeeper * 100) / $totalflights , 2);
	}
	if ($totalflights == 0) {		$percvamacars = 0;	}
	else {
		$percvamacars = round(($num_vamacars * 100) / $totalflights , 2);
	}
	$percmanual = round((100 - $percfskeeper - $percfsacars - $percvamacars) , 2);
	//Calculation  per plane type
	$planetype = '';
	$countpanepertype = '';
	$countpanepertype2 = '';
	$vardatagraph = '';
	$sql = 'SELECT count(*) AS c, ft.plane_icao AS plane_icao FROM fleets f, fleettypes ft WHERE f.fleettype_id=ft.fleettype_id GROUP BY ft.fleettype_id ORDER BY plane_icao ASC';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$planetype = $planetype . ',"' . $row['plane_icao'] . '"';
		$percplanetype = round(($row['c'] * 100) / $num_planes , 2);
		$countpanepertype = $countpanepertype . ',' . $percplanetype;
		$countpanepertype2 = $countpanepertype2 . '{label: "'.$row['plane_icao'] .'", value: '.$percplanetype.'},';
		$vardatagraph = $vardatagraph . '
    {
          value: ' . $percplanetype . ',
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "' . $row['plane_icao'] . '"
      },';
	}
	$planetype = substr($planetype , 1);
	$countpanepertype = substr($countpanepertype , 1);
	// Calculate % by flight duration
	$duration_perc='';
	$duration_array = array();
	$duration_cnt = 0;
	$duration_graph ='';
	$sql = "select flightduration , SUM(cn) as cnt from (
select '0-1' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))<=1
union
select '1-2' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>1 and ABS(abs(flight_duration))<=2
union
select '2-3' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>2 and ABS(abs(flight_duration))<=3
union
select '3-4' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>3 and ABS(abs(flight_duration))<=4
union
select '4-5' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>4 and ABS(abs(flight_duration))<=5
union
select '5-6' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>5 and ABS(abs(flight_duration))<=6
union
select '6-7' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>6 and ABS(abs(flight_duration))<=7
union
select '7-8' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>7 and ABS(abs(flight_duration))<=8
union
select '8-9' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>8 and ABS(abs(flight_duration))<=9
union
select '>9' as flightduration , COUNT(*) as cn from vampireps where  LENGTH((flight_duration))>0 and ABS(abs(flight_duration))>9
union
select '0-1' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))<=1
union
select '1-2' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>1 and ABS(abs(duration))<=2
union
select '2-3' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>2 and ABS(abs(duration))<=3
union
select '3-4' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>3 and ABS(abs(duration))<=4
union
select '4-5' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>4 and ABS(abs(duration))<=5
union
select '5-6' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>5 and ABS(abs(duration))<=6
union
select '6-7' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>6 and ABS(abs(duration))<=7
union
select '7-8' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>7 and ABS(abs(duration))<=8
union
select '8-9' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>8 and ABS(abs(duration))<=9
union
select '>9' as flightduration , COUNT(*) as cn from pireps where  LENGTH((duration))>0 and ABS(abs(duration))>9
union
select '0-1' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))<=1
union
select '1-2' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>1 and ABS(abs(flighttime))<=2
union
select '2-3' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>2 and ABS(abs(flighttime))<=3
union
select '3-4' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>3 and ABS(abs(flighttime))<=4
union
select '4-5' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>4 and ABS(abs(flighttime))<=5
union
select '5-6' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>5 and ABS(abs(flighttime))<=6
union
select '6-7' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>6 and ABS(abs(flighttime))<=7
union
select '7-8' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>7 and ABS(abs(flighttime))<=8
union
select '8-9' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>8 and ABS(abs(flighttime))<=9
union
select '>9' as flightduration , COUNT(*) as cn from pirepfsfk where  LENGTH((flighttime))>0 and ABS(abs(flighttime))>9) as t group by flightduration";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$duration_array[$row["flightduration"]] = $row["cnt"];
		$duration_cnt +=  $row["cnt"];
	}
	foreach($duration_array as $key => $value)
	{		
		if ($value>0)
		{
			$val = number_format((100 * $value)/$duration_cnt,2);
			$duration_graph = $duration_graph. '{label: "'.$key.' h", value: '.$val.'},';
		}
	}
	// Calculate vs %
	$landing_vs_perc='';
	$landing_vs_array = array();
	$landing_vs_cnt = 0;
	$landing_vs_graph ='';
	$sql = "select LND_vs , SUM(cn) as cnt from (
select '0-100 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and ABS(abs(landing_vs))<=100
union
select '100-200 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=200 and abs(landing_vs)>100
union
select '200-300 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=300 and abs(landing_vs)>200
union
select '300-400 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=400 and abs(landing_vs)>300
union
select '400-500 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=500 and abs(landing_vs)>400
union
select '500-600 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=600 and abs(landing_vs)>500
union
select '600-700ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=700 and abs(landing_vs)>600
union
select '700-800 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=800 and abs(landing_vs)>700
union
select '800-900 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(landing_vs)<=900 and abs(landing_vs)>800
union
select '>900 ft/min' as LND_vs , COUNT(*) as cn from vampireps where  LENGTH((landing_vs))>0 and abs(abs(landing_vs))>=900
union
select '0-100 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and ABS(abs(landingVs))<=100
union
select '100-200 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=200 and abs(landingVs)>100
union
select '200-300 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=300 and abs(landingVs)>200
union
select '300-400 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=400 and abs(landingVs)>300
union
select '400-500 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=500 and abs(landingVs)>400
union
select '500-600 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=600 and abs(landingVs)>500
union
select '600-700 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=700 and abs(landingVs)>600
union
select '700-800 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=800 and abs(landingVs)>700
union
select '800-900 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(landingVs)<=900 and abs(landingVs)>800
union
select '>900 ft/min' as LND_vs , COUNT(*) as cn from pirepfsfk where  LENGTH((landingVs))>0 and abs(abs(landingVs))>=900) as t group by LND_vs";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$landing_vs_array[$row["LND_vs"]] = $row["cnt"];
		$landing_vs_cnt +=  $row["cnt"];
	}
	foreach($landing_vs_array as $key => $value)
	{
		
		if ($value>0)
		{
			$val = number_format((100 * $value)/$landing_vs_cnt,2);
			$landing_vs_graph = $landing_vs_graph. '{label: "'.$key.'", value: '.$val.'},';
		}
	}
	// Calculation for flights per month current year
	$count_per_month = '';
	for ($i = 1 ; $i <= $current_month ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(sum(c),0) as co from v_flights_pilots where date_format(flightdate,'%y')=date_format(now(),'%y') and date_format(flightdate,'%m')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_month = $count_per_month . "{ day: '".$i."', flights: ".$row2['co']." },";
		}
	}
	// Country  stats
	$sql = "select SUM(c) as c, short_name from
(select count(*) as c, short_name
			from vampireps vp, airports a , country_t c
			where c.`iso2`=a.`iso_country`  and  vp.departure=a.ident group by short_name
union
select count(*) as c, short_name
			from pireps p, airports a , country_t c
			where c.`iso2`=a.`iso_country`  and  from_airport=a.ident group by short_name
union
select count(*) as c, short_name
			from pirepfsfk p, airports a , country_t c
			where c.`iso2`=a.`iso_country`  and  SUBSTRING(OriginAirport,1,4)=a.ident group by short_name ) as t group by short_name;";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$totalcountry=0;
	$country='';
	$perccountry='';
	$countcountry='';
	while ($row = $result->fetch_assoc()) {
		$totalcountry += $row['c'];
	}
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$country = $country . ',"' . $row['short_name'] . '"';
		$perccountry = round(($row['c'] * 100) / $totalcountry , 2);
		$countcountry = $countcountry . '{label: "'.$row['short_name'] .'", value: '.$perccountry.'},';
	}
?>
<!-- Row 1-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_NUMBER_FLIGTH_CURRENT_MONTH; ?></h3>
			</div>
			<div class="panel-body">
				<div id="flights_per_day" style="height: 350px;"></div>
				<script>
						new Morris.Bar({
					  // ID of the element in which to draw the chart.
					  element: 'flights_per_day',
					  // Chart data records -- each entry in this array corresponds to a point on
					  // the chart.
					  data: [<?php echo $count_per_day2;?>
					  ],
					  // The name of the data record attribute that contains x-values.
					  xkey: 'day',
					  // A list of names of data record attributes that contain y-values.
					  ykeys: ['flights'],
					  // Labels for the ykeys -- will be displayed when you hover over the
					  // chart.
					  labels: ['flights'],
					  parseTime: false,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
				</script>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
</div>
<!-- Row 2-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_NUMBER_FLIGTH_PER_MONTH_CURRENT_YEAR; ?></h3>
			</div>
			<div class="panel-body">
				<div id="flights_per_month" ></div>
				<script>
					  var flights_per_month= Morris.Line({
					  element: 'flights_per_month',
					  data: [<?php echo $count_per_month;?>
					  ],
					  xkey: 'day',
					  ykeys: ['flights'],
					  labels: ['flights'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_month.redraw();
				    });
				</script>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
</div>
<!-- Row 3-->
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo PILOT_STATS_PERC_DURATION; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_flight_duration" style="height: 350px;"></div>
					<script>
						  var perc_flight_time = Morris.Donut({
						  element: 'perc_flight_duration',
						  data: [<?php echo $duration_graph ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_flight_time.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
		<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo VAMACARS_LANDANALYSIS; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_lnd_vs" style="height: 350px;"></div>
					<script>
						  var landing_vs_graph = Morris.Donut({
						  element: 'perc_lnd_vs',
						  data: [<?php echo $landing_vs_graph ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            landing_vs_graph.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
			<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo PILOT_STATS_COUNTRY; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_by_country" style="height: 350px;"></div>
					<script>
						  var perc_by_country =  Morris.Donut({
						  element: 'perc_by_country',
						  data: [<?php echo $countcountry ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_by_country.redraw();
				    });
					</script>
			</div>
		</div>
	</div>
</div>
<!-- Row 4-->
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PERCENTAGE_BY_AIRCRAFT_TYPE; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_fleet" style="height: 350px;"></div>
				<script>
					  new Morris.Donut({
					  // ID of the element in which to draw the chart.
					  element: 'perc_fleet',
					  formatter: function(y){return y+' %';},
					  data: [<?php echo $countpanepertype2 ; ?>]
					});
				</script>
			</div>
		</div>
	</div>
		<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PERCENTAGE_REG_VS_CHARTER ; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_acars" style="height: 350px;"></div>
				<script>
					  new Morris.Donut({
					  element: 'perc_acars',
					  data: [<?php
					    	echo '{label: "Regular", value: '.$percregularflights.'},';
					    	echo '{label: "Charter", value: '.$perccharterflights.'},';
					    ?>],
						 formatter: function(y){return y+' %';}
					});
				</script>
			</div>
		</div>
	</div>
			<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PERCENTAGE_BY_REPORT_TYPE; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_reg" style="height: 350px;"></div>
				<script>
					  new Morris.Donut({
					  element: 'perc_reg',
					  data: [<?php
					    	echo '{label: "SIM ACARS", value: '.$percvamacars.'},';
					    	echo '{label: "FS KEEPER", value: '.$percfskeeper.'},';
					    	echo '{label: "MANUAL", value: '.$percmanual.'},';
					    	echo '{label: "FSACARS", value: '.$percfsacars.'},';
					  ?>],
						formatter: function(y){return y+' %';}
					});
				</script>
			</div>
		</div>
	</div>
</div>
<!-- Row 5 -->
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_TOP5_HOUR; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'top_five_hour.php'; ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_TOP5_FLIGTH; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'top_five_fligths.php'; ?>
			</div>
		</div>
	</div>
</div>
<!-- Row 6 -->
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_TOP5_LANDING; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'top_five_vs.php'; ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_TOP5_ROUTES; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'top_five_route.php'; ?>
			</div>
		</div>
	</div>
</div>
<!-- Row 7 -->
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_FLIGHTS_AIRCRAFT_TYPE; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'stats_fleet_type_counter.php'; ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_TOP5_AIRCRAFTS; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'stats_fleet_counter.php'; ?>
			</div>
		</div>
	</div>
</div>
<!-- Row 8 -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PILOT_HOURS_YEAR_MONTH; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'pilots_hours_per_months.php'; ?>
			</div>
		</div>
	</div>
</div>
<!-- Row 9 -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PILOT_FLIGHTS_YEAR_MONTH; ?></h3>
			</div>
			<div class="panel-body">
				<?php include 'pilots_flights_per_months.php'; ?>
			</div>
		</div>
	</div>
</div>
