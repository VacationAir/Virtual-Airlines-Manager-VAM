<?php

    if ($_SESSION["access_route_manager"] ==1)
    {
?>
<div class="routes index">
	<h2><?php echo __('Routes'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('flight'); ?></th>
			<th><?php echo $this->Paginator->sort('departure'); ?></th>
			<th><?php echo $this->Paginator->sort('arrival'); ?></th>
			<th><?php echo $this->Paginator->sort('alternative'); ?></th>
			<th><?php echo $this->Paginator->sort('etd'); ?></th>
			<th><?php echo $this->Paginator->sort('eta'); ?></th>
			<th><?php echo $this->Paginator->sort('pax_price'); ?></th>
			<th><?php echo $this->Paginator->sort('cargo_price'); ?></th>
			<th><?php echo $this->Paginator->sort('duration'); ?></th>
			<th><?php echo $this->Paginator->sort('hub_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($routes as $route): ?>
	<tr>
		<td><?php echo h($route['Route']['flight']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['departure']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['arrival']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['alternative']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['etd']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['eta']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['pax_price']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['cargo_price']); ?>&nbsp;</td>
		<td><?php echo h($route['Route']['duration']); ?>&nbsp;</td>
		<td>
        	<?php echo $this->Html->link($route['Hub']['hub'], array('controller' => 'hubs', 'action' => 'view', $route['Hub']['hub_id'])); ?>
        </td>
		<td class="actions">
			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'routes', 'action' => 'view', $route['Route']['route_id'])));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'routes', 'action' => 'edit', $route['Route']['route_id'])));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $route['Route']['route_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $route['Route']['flight'])); ?>
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
		<li><?php echo $this->Html->link(__('List Fleet Route'), array('controller' => 'fleettypesRoutes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fleet Type'), array('controller' => 'fleettypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Route'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		<li><?php echo $this->Html->link(__('New Fleet Type'), array('controller' => 'fleettypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>

	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Route manager module</div>';
    }
?>
