<?php

    if ($_SESSION["access_route_manager"] ==1)
    {
?>
<div class="routes form">
<?php echo $this->Form->create('Route'); ?>
	<fieldset>
		<legend><?php echo __('Edit Route'); ?></legend>
	<?php
		echo $this->Form->input('route_id');
		echo $this->Form->input('flight');
		echo $this->Form->input('departure');
		echo $this->Form->input('arrival');
		echo $this->Form->input('alternative');
		echo $this->Form->input('etd',['label' => 'ETD']);
		echo $this->Form->input('eta',['label' => 'ETA']);
		echo $this->Form->input('pax_price');
		echo $this->Form->input('cargo_price');
		echo $this->Form->input('flproute',['label' => 'FP Route']);
		echo $this->Form->input('flight_level');
		echo $this->Form->input('comments');
		echo $this->Form->input('duration');
		echo $this->Form->input('hub_id');
		echo $this->Form->input('Fleettype',['label' => 'Aircraft type assignation']);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		<li><?php echo $this->Html->link(__('List Routes'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Route.route_id')),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Route.flight'))); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Route manager module</div>';
    }
?>
