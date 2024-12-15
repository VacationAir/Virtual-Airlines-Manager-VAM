<?php

    if ($_SESSION["access_fleet_manager"] ==1)
    {
?>
<div class="fleets form">
<?php echo $this->Form->create('Fleet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Fleet'); ?></legend>
	<?php

		echo $this->Form->input('fleettype_id');
		echo $this->Form->input('registry');
		echo $this->Form->input('location');
		echo $this->Form->input('hours');
		echo $this->Form->input('status');
		echo $this->Form->input('name');
		echo $this->Form->input('hub_id');
		$yes_no = array('1' => 'Yes', '0' => 'No');
		echo $this->Form->input(
		    'hangar',
		    array('options' => $yes_no, 'default' => '0'));
		echo $this->Form->input(
		    'booked',
		    array('options' => $yes_no, 'default' => '0'));


	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List Fleets'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet'), array('controller' => 'fleets', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Fleet.fleet_id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Fleet.registry'))); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet manager module</div>';
    }
?>
