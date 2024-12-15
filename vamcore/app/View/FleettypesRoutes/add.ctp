<?php
   
    if ($_SESSION["access_route_assignator"] ==1)
    {
?>

<div class="fleettypesRoutes form">
<?php echo $this->Form->create('FleettypesRoute'); ?>
	<fieldset>
		<legend><?php echo __('Add Fleet Type Route'); ?></legend>
	<?php
		echo $this->Form->input('route_id');
		echo $this->Form->input('fleettype_id',['label' => 'Aircraft type']);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		<li><?php echo $this->Html->link(__('List Fleet Type Routes'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Routes'), array('controller' => 'routes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Route'), array('controller' => 'routes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Route assignation module</div>';
    }
?>
