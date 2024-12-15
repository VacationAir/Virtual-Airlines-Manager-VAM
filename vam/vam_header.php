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
	<link rel="shortcut icon" href="images/favicon.ico" >
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css"/>
	<script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
	<script src="Charts/Chart.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/social-vam.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/numeric-comma.js"></script>
	<script src="js/raphael.min.js" type="text/javascript"></script>
	<script src="js/morris.min.js" type="text/javascript"></script>
	<!-- VAM javascript -->
	<script src="js/vam.js" type="text/javascript"></script>
</head>
<body>
<?php
	//require('check_login.php');
	include('get_pilot_data.php');
	require_once ('./helpers/conversions.php');
?>
<nav class="navbar navbar-inverse" role=" navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
			        aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./index.php">VAM</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="./index.php"><i class="fa fa-home fa-fw"></i> <?php echo 'Home'; ?></a></li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<?php echo ABOUT; ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="./index_vam_op.php?page=staff"><i class="fa fa-user-o fa-fw"></i> <?php echo STAFF; ?></a></li>
						<li><a href="./index_vam_op.php?page=rules"><i class="fa fa-file-text-o fa-fw"></i> <?php echo RULES; ?></a></li>
						<li><a href="./index_vam_op.php?page=school"><i class="fa fa-graduation-cap fa-fw"></i> <?php echo SCHOOL; ?></a></li>
						<li><a href="#"><i class="fa fa-comments-o fa-fw"></i> <?php echo FORUM; ?></a></li>
					</ul>
				</li>
				<li><a href="./index_vam_op.php?page=pilot_options"><i class="fa fa-gears fa-fw"></i> <?php echo MENU; ?></a></li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-sliders fa-fw"></i> <?php echo OPERATIONS; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="./index_vam_op.php?page=fleet_public"><i class="fa fa-plane fa-fw"></i> <?php echo FLEET; ?></a></li>
					<li><a href="./index_vam_op.php?page=route_public"><i class="fa fa-globe fa-fw"></i> <?php echo ROUTES; ?></a></li>
					<li><a href="./index_vam_op.php?page=hubs"><i class="fa fa-crosshairs fa-fw"></i> <?php echo HUBS; ?></a></li>
					<li><a href="./index_vam_op.php?page=tours"><i class="fa fa-code-fork fa-fw"></i> <?php echo TOURS; ?></a></li>
					<li><a href="./index_vam_op.php?page=ranks"><i class="fa fa-bookmark fa-fw"></i> <?php echo PILOT_RANKS; ?></a></li>
					<li><a href="./index_vam_op.php?page=awards"><i class="fa fa-star fa-fw"></i> <?php echo AWARDS; ?></a></li>
					<li><a href="./index_vam_op.php?page=va_global_financial_report"><i class="fa fa-dollar fa-fw"></i> <?php echo GLOBAL_FINANCES; ?></a></li>
					<?php 
						if ($_SESSION["access_pilot_manager"] == '1')
						{
							echo '<li><a href="./index_vam_op.php?page=report_pilot_activity"><i class="fa fa-user-o fa-fw"></i>&nbsp;'. RPT_PILOT_ACTIVITY. '</a></li>';
						}
						if ($_SESSION["access_fleet_manager"] == '1')
						{
							echo '<li><a href="./index_vam_op.php?page=report_plane_out_route"><i class="fa fa-map-marker fa-fw"></i>&nbsp;' . RPT_PLANE_OUT ,'</a></li>';
						}
					?>
					</ul>
				</li>
				<li><a href="./index_vam_op.php?page=pilots_public"><i class="fa fa-users fa-fw"></i> <?php echo PILOTS; ?></a></li>
				<li><a href="./index_vam_op.php?page=stats"><i class="fa fa-area-chart  fa-fw"></i> <?php echo STATS; ?></a></li>
			<?php if ($_SESSION["access_administration_panel"] == 1) { ?>
				<li><a href="../vamcore/Gvausers"><span class="glyphicon glyphicon-briefcase"></span> <?php echo ADMIN; ?></a></li> <?php } ?>
				<li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo 'Log out ' . $_SESSION["user"]; ?></a></li>
			</ul>
		</div>
	</div>
</nav>
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
						<div class="item active"><img src="./images/slider/1.jpg" alt="...">
							<div class="carousel-caption"><h3>Virtual Airlines Manager</h3></div>
						</div>
						<div class="item"><img src="./images/slider/2.jpg" alt="...">
							<div class="carousel-caption"><h3>Virtual Airlines Manager</h3></div>
						</div>
						<div class="item"><img src="./images/slider/3.jpg" alt="...">
							<div class="carousel-caption"><h3>Virtual Airlines Manager</h3></div>
						</div>
						<div class="item"><img src="./images/slider/4.jpg" alt="...">
							<div class="carousel-caption"><h3>Virtual Airlines Manager</h3></div>
						</div>
						<div class="item"><img src="./images/slider/5.jpg" alt="...">
							<div class="carousel-caption"><h3>Virtual Airlines Manager</h3></div>
						</div>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span> </a></div>
				<!-- Carousel -->
			</div>
		</div>
	</div>
	<br>