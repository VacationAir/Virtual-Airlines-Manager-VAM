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
	$NUMCELLS = 5;
	$sql="select * from award_pilots ap INNER JOIN awards a where ap.award_id = a.award_id and gvauser_id=$medal_pilot order by award_date";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$count = $result->num_rows;
	$numrows= ($count % $NUMCELLS )+2;
	$countrest= ($numrows * $NUMCELLS) - $count ;
	$medals= array();
	$i = 1;
	while ($row = $result->fetch_assoc()) {
		$medals[$i] = $row["award_image"];
		$i++;
	}
	for ($j=$i;$j<=$count+$countrest+1;$j++)
	{
		$medals[$j]='';
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_photo_filter_white_18dp_1x.png">&nbsp;<?php echo PILOT_AWARDS; ?></h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table borderless">
						<?php
							$i=1;
							for ($rows=1;$rows<=$numrows; $rows++)
							{
								echo '<tr>';
								for ($cells=1;$cells<=$NUMCELLS;$cells++)
								{
									if (strlen ($medals[$i])>0)
									{
										echo '<td><img src="'. $medals[$i].'"></td>';
									}
									else
									{
										echo '<td></td>';
									}
									$i++;
								}
								echo '</tr>';
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
