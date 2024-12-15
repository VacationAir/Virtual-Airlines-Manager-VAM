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
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><IMG src="images/icons/ic_airline_seat_recline_normal_white_18dp_1x.png">&nbsp;<?php echo PILOT_CERTIFICATIONS; ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<?php
						$x_value = '';
						if (sizeof($planes_certificated) > 0) {
							foreach ($planes_certificated as $x => $x_value) {
								?>
								<tr>
									<td><i class="fa fa-plane">&nbsp;&nbsp;</i><?php echo $x_value; ?></td>
								</tr>
							<?php
							}
						}
					?>
				</table>
			</div>
		</div>
		<div class="clearfix visible-lg"></div>
	</div>
</div>
