<?php

    if ($_SESSION["access_fleet_type_manager"] ==1)
    {
?>
<div class="fleettypes view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Fleet Type'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Plane ICAO'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['plane_icao']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Type Description'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['plane_description']); ?></td>
	              	</tr>
	           		<tr>
	              		<td><?php echo __('PAX'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['pax']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cargo capacity'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['cargo_capacity']); ?></td>
	              	</tr>
	                <tr>
    	              	<td><?php echo __('Length'); ?></td>
    	              	<td><?php echo h($fleettype['Fleettype']['aircraft_length']); ?></td>
    	            </tr>
	           		<tr>
	              		<td><?php echo __('MZFW'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['mzfw']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('MLW'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['mlw']); ?></td>
	              	</tr>
	                <tr>
    	              	<td><?php echo __('MTOW'); ?></td>
    	              	<td><?php echo h($fleettype['Fleettype']['mtow']); ?></td>
    	            </tr>
	           		<tr>
	              		<td><?php echo __('Service ceiling'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['service_ceiling']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cruising Speed'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['cruising_speed']); ?></td>
	              	</tr>
	                <tr>
    	              	<td><?php echo __('Crew Members'); ?></td>
    	              	<td><?php echo h($fleettype['Fleettype']['crew_members']); ?></td>
    	            </tr>
	                <tr>
    	              	<td><?php echo __('Image url'); ?></td>
    	              	<td><?php echo h($fleettype['Fleettype']['image_url']); ?></td>
    	            </tr>
	              	<tr>
	              		<td><?php echo __('Price'); ?></td>
	              		<td><?php echo h($fleettype['Fleettype']['unit_price']); ?></td>
	              	</tr>
	              </table>
	        </div>
	    </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Fleet Type'), array('action' => 'edit', $fleettype['Fleettype']['fleettype_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Types'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleets'), array('controller' => 'fleets', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet'), array('controller' => 'fleets', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fleet Type'), array('action' => 'delete', $fleettype['Fleettype']['fleettype_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleettype['Fleettype']['fleettype_id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Fleets'); ?></h3>
	<?php if (!empty($fleettype['fleet'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Registry'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Hours'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Booked'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Base'); ?></th>
		<th><?php echo __('Hangar'); ?></th>
		<th><?php echo __('Hangardate'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fleettype['fleet'] as $fleet): ?>
		<tr>
			<td><?php echo $fleet['registry']; ?></td>
			<td><?php echo $fleet['location']; ?></td>
			<td><?php echo $fleet['hours']; ?></td>
			<td><?php echo $fleet['status']; ?>%</td>
			<?php $booked='No'; if ($fleet['booked']==1) $booked='Yes'  ; ?>
			<td><?php echo $booked; ?></td>
			<td><?php echo $fleet['name']; ?></td>
			<td><?php echo $fleet['hub_base']; ?></td>
			<?php $hangar='No'; if ($fleet['hangar']==1) $hangar='Yes'  ; ?>
			<td><?php echo $hangar; ?></td>
			<td><?php echo $fleet['hangardate']; ?></td>
			<td class="actions">
				<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'fleets', 'action' => 'view', $fleet['fleet_id'])
				));?>
				<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'fleets', 'action' => 'edit', $fleet['fleet_id'])
				));?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fleets', 'action' => 'delete', $fleet['fleet_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleet['registry'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul class="list-inline">
			<li><?php echo $this->Html->link(__('New Fleet'), array('controller' => 'fleets', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		</ul>
	</div>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet Type manager module</div>';
    }
?>
