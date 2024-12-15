<?php
   
    if ($_SESSION["access_route_assignator"] ==1)
    {
?>

<div class="fleettypesRoutes view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Route'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Route'); ?></td>
	              		<td><?php echo $this->Html->link($fleettypesRoute['Route']['flight'], array('controller' => 'routes', 'action' => 'view', $fleettypesRoute['Route']['route_id'])); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Fleet type'); ?></td>
	              		<td><?php echo $this->Html->link($fleettypesRoute['Fleettype']['plane_icao'], array('controller' => 'fleettypes', 'action' => 'view', $fleettypesRoute['Fleettype']['fleettype_id'])); ?></td>
	              	</tr>	              	    
	              </table>
	        </div>
	    </div>
	</div>


<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		
		
		<li><?php echo $this->Html->link(__('List Fleettypes Routes'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Fleettypes Route'), array('action' => 'edit', $fleettypesRoute['FleettypesRoute']['id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		
		<li><?php echo $this->Html->link(__('List Routes'), array('controller' => 'routes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleettypes Route'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fleettypes Route'), array('action' => 'delete', $fleettypesRoute['FleettypesRoute']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleettypesRoute['FleettypesRoute']['id'])); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Route assignation module</div>';
    }
?>
