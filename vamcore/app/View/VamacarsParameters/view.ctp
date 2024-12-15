<?php

    if ($_SESSION["access_vam_acars_manager"] ==1)
    {
?>
<div class="vamacarsParameters view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('VAM ACARS Parameters'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Crash'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['crash']).' %'; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Beacon off'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['beacon_off']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('IAS Below 10000 ft'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['ias_below_10000_ft']) .' %'; ?></td>
	              	</tr>
	       			<tr>
	              		<td><?php echo __('Lights below 10000 ft'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['lights_below_10000_ft']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Lights above 10000 ft'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['lights_above_10000_ft']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Overspeed'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['overspeed']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Pause'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['pause']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Refuel'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['refuel']) .' %'; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Slew'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['slew']) .' %'; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Taxi lights off'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['taxi_lights']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Taxi Speed > 25 kts'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['taxi_speed']) .' %'; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Take off & Lights off'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['takeoff_lights']) .' %'; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Landing & Lights off'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['land_lights']) .' %'; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Landed in not planned airport'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['incorrect_arrival']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS 0 - 100 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_0_100']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS 101 - 200 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_100_200']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS 201 - 300 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_200_300']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS 301 - 400 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_300_400']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS 401 - 500 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_400_500']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS 501 - 600 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_500_600']) .' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS > 601 ft/min'); ?></td>
	              		<td><?php echo h($vamacarsParameter['VamacarsParameter']['landing_vs_greater_600']) .' %'; ?></td>
	              	</tr>
	              	


	           
	              </table>
	            </div>
	          </div>
	</div>

	
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vamacarsParameter['VamacarsParameter']['vamacars_parameters_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to VAM ACARS manager module</div>';
    }
?>
