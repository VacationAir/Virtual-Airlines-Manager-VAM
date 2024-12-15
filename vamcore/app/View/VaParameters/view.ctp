<?php

    if ($_SESSION["access_va_parameters"] ==1)
    {
?>
<div class="vaParameters view">
	<div class="col-md-12">

	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('VA Parameters'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('VA name'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['va_name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Airline ICAO'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['va_icao']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('IVAO'); ?></td>
	              		<?php $value='NO';if ($vaParameter['VaParameter']['ivao']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('VATSIM'); ?></td>
	              		<?php $value='NO';if ($vaParameter['VaParameter']['vatsim']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Number allowed pilots'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['number_pilots']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cost jump type 1'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['jump_type1']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cost jump type 2'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['jump_type2']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cost jump type 3'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['jump_type3']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Plane Status Hangar'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['plane_status_hangar']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing Crash'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['landing_crash']).' ft/min'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing Penalty 1'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['landing_penalty1']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing Penalty 2'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['landing_penalty2']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing Penalty 3'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['landing_penalty3']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS Penalty 1'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['landing_vs_penalty1']).' ft/min'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Landing VS Penalty 2'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['landing_vs_penalty2']).' ft/min'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Flight Wear'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['flight_wear']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Number days for plane maintenance'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['hangar_maintenance_days']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cost for repair an aircraft after carsh'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['hangar_crash_value']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Number days after crash'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['hangar_crash_days']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Pilot Crash Penalty'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['pilot_crash_penalty']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Charter reduction'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['charter_reduction']).' %'; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Currency'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['currency']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Count Rejected Flights'); ?></td>
	              		<?php $value='NO';if ($vaParameter['VaParameter']['no_count_rejected']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Pilot info private'); ?></td>
	              		<?php $value='NO';if ($vaParameter['VaParameter']['pilot_public']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Allow Select aircraft for charter'); ?></td>
	              		<?php $value='NO';if ($vaParameter['VaParameter']['activate_finance_module']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Flights Auto approval'); ?></td>
	              		<?php $value='NO';if ($vaParameter['VaParameter']['auto_approval']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Date Format'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['date_format']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Time Format'); ?></td>

	              		<?php $value='HH:MM';if ($vaParameter['VaParameter']['time_format']==1) $value='Decimal'; ?>
	              		<td><?php echo $value; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hours Auto cancellation'); ?></td>
	              		<td><?php echo h($vaParameter['VaParameter']['hours_auto_cancellation']); ?></td>
	              	</tr>
	              </table>
	            </div>
	          </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vaParameter['VaParameter']['va_parameters_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to VA Parameters module</div>';
    }
?>
