<?php

    if ($_SESSION["access_fleet_manager"] ==1)
    {
?>
<div class="fleets form">
<?php echo $this->Form->create('Fleet'); ?>
	<fieldset>
		<legend><?php echo __('Add Fleet'); ?></legend>
	<?php
	//$form->input('category_id');
		echo $this->Form->input('fleettype_id');
		echo $this->Form->input('registry');
		echo $this->Form->input('location');
		echo $this->Form->input('hours');
		echo $this->Form->input('status');
		echo $this->Form->input('name');
		echo $this->Form->input('hub_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		<li><?php echo $this->Html->link(__('List Fleets'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Fleet manager module</div>';
    }
?>
