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
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Virtual Airlines Manager</title>
	<meta charset="utf-8">
	<meta name="keywords"
	      content="vam, virtual airlines manager , va , ivao, vatsim , airlines manager, prepar3d, aerosoft, pmdg,virtual pilot, piloto virtual, open source,xplane, flight simulator, flight simulation, flight, flying, fsx, fs9, flight simulator x, flight simulator 2004, simulators, simulator, simulation, flight enthusiasts, fsacars, fskeeper"/>
	<meta name="description"
	      content="VAM Virtual Airlines Manager is  free, open source web system for flight simulation enthusiasts, allowing them to create their own virtual airlines as a real one. Full airlines administration."/>
	<meta name="author" content="Alejandro Garcia">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel=”author” href=”https://plus.google.com/u/0/108665243705425046932/“ title="Virtual Airlines Manager on Google+" />
	<link rel="icon" href="vam_favicon.png" type="image/png" sizes="16x16">
	<link rel="shortcut icon" href="images/favicon.ico" >
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css"/>
	<script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
	<script src="Charts/Chart.js"></script>
	<script src="js/vam.js" type="text/javascript"></script>
	<script src="js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/social-vam.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
</head>
<body">
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
			        aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./index.php">Virtual Airlines Manager</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="./index.php">Home</a></li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo ABOUT; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="./index.php?page=staff"><?php echo STAFF; ?></a></li>
						<li><a href="./index.php?page=rules"><?php echo RULES; ?></a></li>
						<li><a href="./index.php?page=school"><?php echo SCHOOL; ?></a></li>
						<li><a href="#"><?php echo FORUM; ?></a></li>
						<li><a href="./index.php?page=pilot_register"><?php echo REGISTER; ?></a></li>
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo OPERATIONS; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="./index.php?page=fleet_public"><?php echo FLEET; ?></a></li>
						<li><a href="./index.php?page=route_public"><?php echo ROUTES; ?></a></li>
						<li><a href="./index.php?page=hubs"><?php echo HUBS; ?></a></li>
						<li><a href="./index.php?page=tours"><?php echo TOURS; ?></a></li>
						<li><a href="./index.php?page=ranks"><?php echo PILOT_RANKS; ?></a></li>
						<li><a href="./index.php?page=awards"><?php echo AWARDS; ?></a></li>
						<li><a href="./index.php?page=va_global_financial_report"><?php echo GLOBAL_FINANCES; ?></a></li>
					</ul>
				</li>
				<li><a href="./index.php?page=pilots_public"><?php echo PILOTS; ?></a></li>
				<li><a href="./index.php?page=stats"><?php echo STATS; ?></a></li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo LANGUAGES; ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php echo $linklanguage; ?>
					</ul>
				</li>
			</ul>
			<?php if ($user_logged==0) {
				?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="./index.php?page=pilot_register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
					<li><a href="#myModal" role="button" data-toggle="modal" rel="tooltip" data-original-title='Hello'><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
				</ul>
			<?php
			}
			else{
				?>
				<ul class="nav navbar-nav navbar-right" >
					<li><a href = "./index_vam.php" role = "button" ><span class="glyphicon glyphicon-home" ></span> System</a></li>
					<li><a href = "./index.php?page=logout" ><span class="glyphicon glyphicon-log-out" ></span > Log out</a ></li>
				</ul>
			<?php
			}
			?>
		</div>
	</div>
</nav>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Login VAM system</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="login-form" action="./login.php" role="form"
				      method="post">
					<div class="form-group">
						<label class="control-label col-sm-2" for="user">Callsign:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="user" id="user"
							       placeholder="Enter Callsign">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="password">Password:</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="password"
							       placeholder="Enter password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label><input type="checkbox"> Remember me</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<a href="./index.php?page=password_recover">Recover Password</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="container">
<div class="row">
	<div class="col-md-12">
		<div id="carousel">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					<li data-target="#carousel-example-generic" data-slide-to="3"></li>
					<li data-target="#carousel-example-generic" data-slide-to="4"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="./images/slider/1.jpg" alt="...">
						<div class="carousel-caption">
							<h3>Virtual Airlines Manager</h3>
						</div>
					</div>
					<div class="item">
						<img src="./images/slider/2.jpg" alt="...">
						<div class="carousel-caption">
							<h3>Virtual Airlines Manager</h3>
						</div>
					</div>
					<div class="item">
						<img src="./images/slider/3.jpg" alt="...">
						<div class="carousel-caption">
							<h3>Virtual Airlines Manager</h3>
						</div>
					</div>
					<div class="item">
						<img src="./images/slider/4.jpg" alt="...">
						<div class="carousel-caption">
							<h3>Virtual Airlines Manager</h3>
						</div>
					</div>
					<div class="item">
						<img src="./images/slider/5.jpg" alt="...">
						<div class="carousel-caption">
							<h3>Virtual Airlines Manager</h3>
						</div>
					</div>
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
			<!-- Carousel -->
		</div>
	</div>
</div>
<!-- HOME PAGE begin -->
<br>
<?php
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>
		<?php
			$sql = 'select callsign, arrival, departure, flight_status, name, surname, pending_nm, plane_type from vam_live_flights vf, gvausers gu where gu.gvauser_id = vf.gvauser_id ';
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			$row_cnt = $result->num_rows;
			$sql = "SELECT flight_id FROM `vam_live_flights` WHERE TIMESTAMPDIFF( MINUTE ,NOW( ) , last_update )<-3";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc())
			{
				$sql_inner = "delete from vam_live_acars where flight_id='".$row["flight_id"]."'";
				if (!$result_acars = $db->query($sql_inner))
				{
				die('There was an error running the query [' . $db->error . ']');
				}
				$sql_inner = "delete from vam_live_flights where flight_id='".$row["flight_id"]."'";
				if (!$result_acars = $db->query($sql_inner))
				{
				die('There was an error running the query [' . $db->error . ']');
				}
			}
			if ($row_cnt>0){
		?>
		<div class="row" id="live_flights">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo "LIVE FIGHTS" ?></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover" id="live_flights_table">
							<?php
									echo "<tr><th>" . LF_CALLSIG . "</th><th>" . LF_PILOT . "</th><th>" . LF_DEPARTURE . "</th><th>" . LF_ARRIVAL . "</th><th>" . FLIGHT_STAGE . "</th><th>". BOOK_ROUTE_ARICRAFT_TYPE . "</th><th>" . PERC_DONE ."</th><th>" . PENDING_NM . "</th><th>" . VAMACARS_NETWORK . "</th></tr>";
							?>
							</table>
						<?php include ('./vam_live_flights_map.php') ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo WELCOME_VA . ' ' . $va_name; ?></h3>
					</div>
					<div class="panel-body">
						VAM Airlines, Inc. ("Virtual"; NYSE: VAM) (commonly referred to simply as "Virtual Airlines") is an
						American major airline headquartered in Chicago, Illinois.It is the world's largest airline when
						measured by number of destinations served.In the late 1920s, just prior to the use of the Virtual
						Airlines name, The Boeing Company, currently one of the world's largest aircraft manufacturers
						operated a predecessor airline.
						VAM operates out of nine airline hubs in the continental United States, Guam, and
						Japan.George Bush Intercontinental Airport in Houston is United's largest passenger carrying hub
						handling 16.6 million passengers annually with an average of 45,413 passengers daily,while
						Chicago-O'Hare is its largest hub in terms of daily departures. The company employs over 88,500
						people while maintaining its headquarters in Chicago's Willis Tower (formerly known as Sears
						Tower).Through the airline's parent company, VAM Continental Holdings, it is publicly traded
						under NYSE: VAM with a market capitalization of over $18 billion as of September, 2014.<br><p>In 1995, United became the first airline to introduce the Boeing 777 in commercial service.In 1997, United co-founded the Star Alliance airline partnership. In May 2000, VAM announced a planned US$11.6 billion acquisition of VK Airways. </p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo STATISTICS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<tr>
								<td><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_NUMPILOTS; ?></td>
								<td><?php echo $num_pilots; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-plane"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_NUMPLANES; ?></td>
								<td><?php echo $num_planes; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-globe"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_NUMROUTES; ?></td>
								<td><?php echo $num_routes; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;<?php echo PILOT_HOURS; ?></td>
								<td><?php echo 0+ $va_hours; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_NUMFLIGHTS; ?></td>
								<td><?php echo $num_fskeeper + $num_pireps + $num_reports + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected ; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-toggle-on"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_NUMREGULAR; ?></td>
								<td><?php echo $num_fskeeper_reg + $num_pireps_reg + $num_reports_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-toggle-off"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_NUMCHARTER; ?></td>
								<td><?php echo $num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_pireps_reg - $num_fskeeper_reg - $num_fsacars_reg - $num_vamacars_reg ; ?></td>
							</tr>
							<tr>
								<td><i class="fa fa-pie-chart"></i>&nbsp;&nbsp;&nbsp;<?php echo ST_PERREGULAR; ?></td>
								<td><?php if (($num_fskeeper + $num_pireps + $num_reports + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) < 1) {
										echo '0 %';
									} else {
										echo number_format((100 * ($num_pireps_reg + $num_fskeeper_reg + $num_fsacars_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected)) / ($num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) , 2) . ' %';
									}?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
		</div>
		<!-- Row 2 -->
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo LATEST_FLIGHTS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select callsign,pilot_name,departure,arrival,DATE_FORMAT(date,'$date_format') as date_string, date, format(time,2) as time from v_last_5_flights where time is not null order by date desc";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<div class="table-responsive">
							<table class="table table-hover">
								<?php
									echo "<tr><th>" . LF_CALLSIG . "</th><th>" . LF_PILOT . "</th><th>" . LF_DEPARTURE . "</th><th>" . LF_ARRIVAL . "</th><th>" . LF_FLIGHTDATE . "</th><th>" . LF_FLIGHTTIME . "</th></tr>";
									while ($row = $result->fetch_assoc()) {
										echo "<td>";
										echo '<i class="fa fa-th-large"></i>&nbsp;&nbsp;'.$row["callsign"] . '</td><td>';
										echo '<i class="fa fa-user"></i>&nbsp;&nbsp;'.$row["pilot_name"] . '</td><td>';
										echo '<i class="fa fa-arrow-circle-up"></i>&nbsp;&nbsp;'.$row["departure"] . '</td><td>';
										echo '<i class="fa fa-arrow-circle-down"></i>&nbsp;&nbsp;'.$row["arrival"] . '</td><td>';
										echo '<i class="fa fa-calendar"></i>&nbsp;&nbsp;'.$row["date_string"] . '</td><td>';
										echo '<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.$row["time"] . '</td></tr>';
									}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo NEWEST_PILOTS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select iso2,concat(callsign,'-',name,' ',surname) as pilot , DATE_FORMAT(register_date,'$date_format') as register_date from gvausers gu inner join country_t c on (gu.country=c.iso2) where activation=1 order by DATE_FORMAT(register_date,'%Y%m%d') desc limit 5";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<table class="table table-hover">
							<?php
								echo "<tr><th>" . NEWPILOT . "</th><th>" . NEWJOINED . "</th></tr>";
								while ($row = $result->fetch_assoc()) {
									echo "<td>".'<img src="./images/country-flags/' . $row["iso2"] . '.png" alt="' . $row["iso2"] . '">&nbsp;';
									echo $row["pilot"] . '</td><td>';
									echo $row["register_date"] . '</td></tr>';
								}
							?>
						</table>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
		</div>
		<!-- Row 3 -->
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo FUTURE_EVENTS; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select event_id,event_name,DATE_FORMAT(publish_date,'$date_format') as publish_date_web ,DATE_FORMAT(publish_date,'%Y%m%d') as publish_date,DATE_FORMAT(hide_date,'%Y%m%d') as hide_date, DATE_FORMAT(now(),'%Y%m%d') as currdat
from events order by publish_date asc limit 5";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<table class="table table-striped">
							<?php
								echo "<tr><th>" . EVENT_NAME . "</th><th>" . EVENT_DATE . "</th></tr>";
								while ($row = $result->fetch_assoc()) {
									if (($row["publish_date"]-$row["currdat"] <=0) && ($row["hide_date"]-$row["currdat"]>0))
									{
										echo '<tr><td>';
										echo '<a href="index.php?page=event&event_id=' . $row["event_id"] . '">' . $row["event_name"] . '</a>' . '</td><td>';
										echo $row["publish_date_web"] . '</td></tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo TWEETS; ?></h3>
					</div>
					<div class="panel-body">
						<a class="twitter-timeline" href="https://twitter.com/pilotovirtual"
						   data-widget-id="525729765416660992">Tweets por el @pilotovirtual.</a>
						<script>!function (d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
								if (!d.getElementById(id)) {
									js = d.createElement(s);
									js.id = id;
									js.src = p + "://platform.twitter.com/widgets.js";
									fjs.parentNode.insertBefore(js, fjs);
								}
							}(document, "script", "twitter-wjs");</script>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo NOTAMS_VA; ?></h3>
					</div>
					<div class="panel-body">
						<?php
							$db = new mysqli($db_host , $db_username , $db_password , $db_database);
							$db->set_charset("utf8");
							if ($db->connect_errno > 0) {
								die('Unable to connect to database [' . $db->connect_error . ']');
							}
							$sql = "select notam_id,notam_name,DATE_FORMAT(publish_date,'$date_format') as publish_date_web ,DATE_FORMAT(publish_date,'%Y%m%d') as publish_date,DATE_FORMAT(hide_date,'%Y%m%d') as hide_date, DATE_FORMAT(now(),'%Y%m%d') as currdat
from notams order by publish_date asc limit 5";
							if (!$result = $db->query($sql)) {
								die('There was an error running the query [' . $db->error . ']');
							}
						?>
						<table class="table table-striped">
							<?php
								echo "<tr><th>" . NOTAM_NAME . "</th><th>" . NOTAM_DATE . "</th></tr>".$row["publish_date"] ;
								while ($row = $result->fetch_assoc()) {
									if (($row["publish_date"]-$row["currdat"] <=0) && ($row["hide_date"]-$row["currdat"]>0))
									{
										echo '<tr><td>';
										echo '<a href="index.php?page=notam&notam_id=' . $row["notam_id"] . '">' . $row["notam_name"] . '</a>' . '</td><td>';
										echo $row["publish_date_web"] . '</td></tr>';
									}
								}
							?>
						</table>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
			<!-- REMOVE COMMENTS to display ONLNE NETWORKS section
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php //echo FLIGHT_NETWORKS; ?></h3>
					</div>
					<div class="panel-body">
						<div class="container">
							<?php
							/*
								if ($ivao == 1) {
									echo '<img src="./images/ivao.gif" height="50" width="50">';
								}
								if ($vatsim == 1) {
									echo '<img src="./images/Vatsim.png" height="50" width="50">';
								}
							*/
							?>
						</div>
					</div>
				</div>
				<div class="clearfix visible-lg"></div>
			</div> -->
		</div>
		<br>
		<!-- HOME PAGE End -->
	<?php
	}
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
		$Existe = file_exists($_GET["page"] . ".php");
		if ($Existe == true) {
			include($_GET["page"] . ".php");
		} else {
			echo "Page Not Found";
		}
	}
?>
</div>
<br>
<div class="container-fluid">
	<hr>
	<div class="text-center center-block">
		<p class="txt-railway"><a href="http://virtualairlinesmanager.net">Powered by Virtual Airlines Manager</a></p>
		<a href="https://www.facebook.com/pages/PilotoVirtual/194466316337"><i id="social" class="fa fa-facebook-square fa-3x social-fb"></i></a>
		<a href="https://twitter.com/pilotovirtual"><i id="social" class="fa fa-twitter-square fa-3x social-tw"></i></a>
		<a href="https://plus.google.com/"><i id="social" class="fa fa-google-plus-square fa-3x social-gp"></i></a>
		<a href="mailto:admin@virtualairlinesmanager.net"><i id="social" class="fa fa-envelope-square fa-3x social-em"></i></a>
		<br />
		<br />
		<a href="http://virtualairlinesmanager.net" target="_blank"><img src="images/logo_vam.png" /></a>
	</div>
</div>
<br/>
</body>
<script type="text/javascript" src="js/moment-with-locales.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		// Validation for change location form
		var validator_recover_password = $("#login-form").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok",
				invalid: "glyphicon glyphicon-remove",
				validating: "glyphicon glyphicon-refresh"
			},
			fields: {
				user: {
					message: "Callsign is required",
					validators: {
						notEmpty: {
							message: "Please provide Callsign"
						}
					}
				},
				password: {
					message: "Password is required",
					validators: {
						notEmpty: {
							message: "Please provide Password"
						}
					}
				}
			}
		});
		// Validation for password reset form
		var validator_recover_password = $("#password-recover-form").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok",
				invalid: "glyphicon glyphicon-remove",
				validating: "glyphicon glyphicon-refresh"
			},
			fields: {
				callsign: {
					message: "Callsign is required",
					validators: {
						notEmpty: {
							message: "Please provide Callsign"
						}
					}
				},
				email: {
					message: "Email address is required",
					validators: {
						notEmpty: {
							message: "Please provide Email address"
						},
						emailAddress: {
							message: "Email address was invalid"
						}
					}
				}
			}
		});
		// Validation for register form
		var validator_register_form = $("#register-form").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok",
				invalid: "glyphicon glyphicon-remove",
				validating: "glyphicon glyphicon-refresh"
			},
			fields: {
				name: {
					message: "Name  is required",
					validators: {
						notEmpty: {
							message: "Please provide a Name"
						}
					}
				},
				surname: {
					message: "Last name is required",
					validators: {
						notEmpty: {
							message: "Please provide a Last name"
						}
					}
				},
				city: {
					message: "City is required",
					validators: {
						notEmpty: {
							message: "Please provide City"
						}
					}
				},
				email: {
					message: "Email address is required",
					validators: {
						notEmpty: {
							message: "Please provide Email address"
						},
						emailAddress: {
							message: "Email address was invalid"
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: "Password is required"
						},
						stringLength: {
							min: 6,
							message: "Password must be 6 characters long"
						},
						different: {
							field: "email",
							message: "Email address and password can not match"
						}
					}
				},
				password2: {
					validators: {
						notEmpty: {
							message: "Confirm password field is required"
						},
						identical: {
							field: "password",
							message: "Password and confirmation must match"
						}
					}
				},
				birthdate: {
					message: "Birthdate is required",
					validators: {
						notEmpty: {
							message: "Please provide a Birthdate"
						},
						date: {
							format: 'DD/MM/YYYY',
							message: 'The format is dd/mm/yyyy'
						}
					}
				},
				ivao: {
					message: "IVAO VID must be a number",
					validators: {
						integer: {
							message: 'The value is not an integer'
						},
						stringLength: {
							message: 'Maximun 8 digits',
							max: 8
							}
					}
				},
				vatsim: {
					message: "IVAO VID must be a number",
					validators: {
						integer: {
							message: 'The value is not an integer'
						},
						stringLength: {
							message: 'Maximun 8 digits',
							max: 8
						}
					}
				}
			}
		});
		$('#datetimepicker').datetimepicker({
			pickTime: false,
			language: 'es'
		});
		$("#datetimepicker").on("dp.change", function (e) {
			$('#register-form').bootstrapValidator('revalidateField', 'birthdate');
		});
	});
</script>
<script id="source" language="javascript" type="text/javascript">
  var semaforo=1;
   function refreshflightsdiv()
  {
	$.ajax({
		  url: 'get_live_flights.php',
		  data: "",
		  dataType: 'json',
		  success: function(data, textStatus, jqXHR) {
			drawTable(data);
			}
		});
  };
  function drawTable(data) {
	$("#live_flights_table").find("tr:gt(0)").remove();
    for (var i = 0; i < data.length; i++) {
        drawRow(data[i]);
    }
}
function drawRow(rowData) {
    var row = $("<tr />")
    $("#live_flights_table").append(row);
    row.append($("<td>" + rowData.callsign + "</td>"));
    row.append($("<td>" + rowData.name + " " + rowData.surname + "</td>"));
    row.append($("<td>" + rowData.departure + "</td>"));
	row.append($("<td>" + rowData.arrival + "</td>"));
    row.append($("<td>" + rowData.flight_status + "</td>"));
	row.append($("<td>" + rowData.plane_type + "</td>"));
	row.append($("<td>" + rowData.perc_completed + "%</td>"));
	row.append($("<td>" + rowData.pending_nm + "</td>"));
	row.append($("<td>" + rowData.pending_nm + "</td>"));
}
$( document ).ready(refreshflights);
var contador=0;
function refreshflights(){
refreshflightsdiv();
setInterval(function () {$.ajax({
		  url: 'get_live_flights.php',
		  data: "",
		  dataType: 'json',
		  success: function(data, textStatus, jqXHR) {
		           drawTable(data);
			}
		})}, 120000);
 }
</script>
</html>
