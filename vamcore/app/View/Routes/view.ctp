<?php

    if ($_SESSION["access_route_manager"] ==1)
    {
?>
<div class="routes view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Route'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Flight'); ?></td>
	              		<td><?php echo h($route['Route']['flight']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Departure'); ?></td>
	              		<td><?php echo h($route['Route']['departure']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Arrival'); ?></td>
	              		<td><?php echo h($route['Route']['arrival']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Alternative'); ?></td>
	              		<td><?php echo h($route['Route']['alternative']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('ETD'); ?></td>
	              		<td><?php echo h($route['Route']['etd']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('ETA'); ?></td>
	              		<td><?php echo h($route['Route']['eta']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('PAX Price'); ?></td>
	              		<td><?php echo h($route['Route']['pax_price']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Cargo Price'); ?></td>
	              		<td><?php echo h($route['Route']['cargo_price']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Route'); ?></td>
	              		<td><?php echo h($route['Route']['flproute']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Flight Level'); ?></td>
	              		<td><?php echo h($route['Route']['flight_level']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Comments'); ?></td>
	              		<td><?php echo h($route['Route']['comments']); ?></td>
	              	</tr>
		            <tr>
    	            	<td><?php echo __('Duration'); ?></td>
    	            	<td><?php echo h($route['Route']['duration']); ?></td>
    	            </tr>
	              	<tr>
	              		<td><?php echo __('Hub'); ?></td>
	              		<td><?php echo $this->Html->link($route['Hub']['hub'], array('controller' => 'hubs', 'action' => 'view', $route['Hub']['hub_id'])); ?></td>
	              	</tr>
	              </table>
	        </div>
	    </div>
	</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Route'), array('action' => 'edit', $route['Route']['route_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Routes'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Route'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Route'), array('action' => 'delete', $route['Route']['route_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $route['Route']['flight'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Fleet Types'); ?></h3>
	<?php if (!empty($route['Fleettype'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Plane Icao'); ?></th>
		<th><?php echo __('Plane Description'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($route['Fleettype'] as $fleettype): ?>
		<tr>
			<td><?php echo $fleettype['plane_icao']; ?></td>
			<td><?php echo $fleettype['plane_description']; ?></td>
			<td class="actions">
				<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'fleettypes', 'action' => 'view', $fleettype['fleettype_id'])));?>
				<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'fleettypes', 'action' => 'edit', $fleettype['fleettype_id'])));?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fleettypes', 'action' => 'delete', $fleettype['fleettype_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleettype['fleettype_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul class="list-inline">
			<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		</ul>
	</div>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Route manager module</div>';
    }
?>
