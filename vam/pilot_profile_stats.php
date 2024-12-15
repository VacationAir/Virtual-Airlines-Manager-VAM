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
	if (isset($_GET['pilotid']))
	{
		$pilotid=$_GET['pilotid'];
	}
	require('pilot_profile_stats_sql.php');
?>
<!-- Row 0-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo PILOT_STATICS; ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<td><?php echo PILOT_FLIGHTS; ?></td>
						<td><?php echo $num_fsacars + $num_fskeeper + $num_pireps + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected; ?></td>
						<td><?php echo PILOT_HOURS; ?></td>
						<td><?php echo convertTime(($transfered_hours + $gva_hours),$va_date_format); ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_DISTANCE; ?></td>
						<td><?php echo $dist_pireps + $dist_fskeeper + $dist_fsacars  + $dist_vamacars - $dist_pireps_rejected - $dist_fskeeper_rejected - $dist_fsacars_rejected - $dist_vamacars_rejected .' NM'; ?></td>
						<td><?php echo PILOT_FLIGHTSREGULAR; ?></td>
						<td><?php echo $num_pireps_reg + $num_fskeeper_reg + $num_fsacars_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_FLIGHTSCHARTER; ?></td>
						<td><?php echo $num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_pireps_reg - $num_fskeeper_reg - $num_fsacars_reg - $num_vamacars_reg - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected; ?></td>
						<td><?php echo PILOT_PERFLIGHTREGULAR; ?></td>
						<td><?php
								if (($num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) < 1) {
									echo '0 %';
								} else {
									echo number_format((100 * ($num_pireps_reg + $num_fskeeper_reg + $num_fsacars_reg + $num_vamacars_reg - $num_pireps_reg_rejected - $num_fskeeper_reg_rejected - $num_fsacars_reg_rejected - $num_vamacars_reg_rejected)) / ($num_pireps + $num_fskeeper + $num_fsacars + $num_vamacars - $num_fsacars_rejected - $num_fskeeper_rejected - $num_pireps_rejected - $num_vamacars_rejected) , 2) . ' %';
								};?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_MANUALREPORT; ?></td>
						<td><?php echo $num_pireps - $num_pireps_rejected; ?></td>
						<td><?php echo PILOT_FSKEEPERREPORT; ?></td>
						<td><?php echo $num_fskeeper - $num_fskeeper_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo PILOT_FSACARSREPORT; ?></td>
						<td><?php echo $num_fsacars - $num_fsacars_rejected; ?></td>
						<td><?php echo PILOT_VAMACARSREPORT; ?></td>
						<td><?php echo $num_vamacars - $num_vamacars_rejected; ?></td>
					</tr>
					<tr>
						<td><?php echo AVG_DURATION; ?></td>
						<td><?php echo convertTime($duration_avg_gen,$va_date_format); ?></td>
						<td><?php echo AVG_DISTANCE; ?></td>
						<td><?php echo number_format($distance_avg_gen,2) .' NM'; ?></td>
					</tr>
					<tr>
						<td><?php echo AVG_LANDING_VS; ?></td>
						<td><?php
								if ($num_pireps<1 && $num_vamacars<1)
									{
										$landingvs_avg_gen=0;
									}
									echo number_format ($landingvs_avg_gen,2) .' ft/min'; ?></td>
						<td><?php echo LAST_30D_FLIGHT; ?></td>
						<td><?php echo $flights_last_30d; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
</div>
<!-- Row 1-->
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_NUMBER_FLIGTH_CURRENT_MONTH; ?></h3>
			</div>
			<div class="panel-body">
				<div id="flights_per_day" ></div>
				<script>
					  var flights_per_day= Morris.Bar({
					  element: 'flights_per_day',
					  data: [<?php echo $count_per_day;?>
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
				            flights_per_day.redraw();
				    });
				</script>
			</div>
		</div>
	</div>
	<div class="col-md-6">
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
	</div>
</div>
<!-- Row 2-->
<div class="row">
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
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PERCENTAGE_BY_REPORT_TYPE; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_countr2" style="height: 350px;"></div>
					<script>
						  var perc_countr2 = Morris.Donut({
						  element: 'perc_countr2',
						  data: [<?php echo $per_type_report ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_countr2.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo STATISTICS_PERCENTAGE_REG_VS_CHARTER; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_charter_reg" style="height: 350px;"></div>
					<script>
						  var perc_ch_re = Morris.Donut({
						  element: 'perc_charter_reg',
						  data: [<?php echo $perc_charter_reg ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_ch_re.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
</div>
<!-- Row 3-->
<div class="row">
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
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_equalizer_white_18dp_1x.png">&nbsp;<?php echo PILOT_STATS_PERC_PLANE; ?></h3>
			</div>
			<div class="panel-body">
				<div id="perc_type_report" style="height: 350px;"></div>
					<script>
						  var perc_aircarft_type_used =  Morris.Donut({
						  element: 'perc_type_report',
    					  data: [<?php echo $perc_aircarft_type_used ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_aircarft_type_used.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
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
</div>
