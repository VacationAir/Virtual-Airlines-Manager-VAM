<?php
    
    if ($_SESSION["access_route_assignator"] ==1)
    {
?>

<div class="fleettypesRoutes index">
	<h2><?php echo __('Fleet Type & Routes'); ?></h2>
	<table class="table table-striped">
	<tr>
			
			<th><?php echo $this->Paginator->sort('route_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fleettype_id','Fleet type'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($fleettypesRoutes as $fleettypesRoute): ?>
	<tr>
		
		<td>
			<?php echo $this->Html->link($fleettypesRoute['Route']['flight'], array('controller' => 'routes', 'action' => 'view', $fleettypesRoute['Route']['route_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fleettypesRoute['Fleettype']['plane_icao'], array('controller' => 'fleettypes', 'action' => 'view', $fleettypesRoute['Fleettype']['fleettype_id'])); ?>
		</td>
		<td class="actions">

			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'FleettypesRoutes', 'action' => 'view', $fleettypesRoute['FleettypesRoute']['id'])));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'FleettypesRoutes', 'action' => 'edit', $fleettypesRoute['FleettypesRoute']['id'])));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fleettypesRoute['FleettypesRoute']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $fleettypesRoute['FleettypesRoute']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
		<ul class="pagination">
		<?php
		  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
		  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
		  echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
		?>
		</ul>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List Routes'), array('controller' => 'routes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fleet&Route'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Route'), array('controller' => 'routes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Route assignation module</div>';
    }
?>
