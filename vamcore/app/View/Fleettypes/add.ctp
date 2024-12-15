<?php

    if ($_SESSION["access_fleet_type_manager"] ==1)
    {
?>
<div class="fleettypes form">
<?php echo $this->Form->create('Fleettype'); ?>
	<fieldset>
		<legend><?php echo __('Add Fleet Type'); ?></legend>
	<?php
		echo $this->Form->input('plane_icao');
		echo $this->Form->input('plane_description');
		echo $this->Form->input('pax');
		echo $this->Form->input('maximum_range');
		echo $this->Form->input('cargo_capacity');
		echo $this->Form->input('aircraft_length');
		echo $this->Form->input('mzfw');
		echo $this->Form->input('mlw');
		echo $this->Form->input('mtow');
		echo $this->Form->input('service_ceiling');
		echo $this->Form->input('cruising_speed');
        echo $this->Form->input('crew_members');
        echo $this->Form->input('image_url');
		echo $this->Form->input('unit_price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		<li><?php echo $this->Html->link(__('List Fleet Types'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Fleets'), array('controller' => 'fleets', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet'), array('controller' => 'fleets', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet Type manager module</div>';
    }
?>
