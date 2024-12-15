<?php

    if ($_SESSION["access_airports_manager"] ==1)
    {
?>
<div class="airports index">
	<h2><?php echo __('Airports'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('ident'); ?></th>
			<th><?php echo $this->Paginator->sort('iata_code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($airports as $airport): ?>
	<tr>
		<td><?php echo h($airport['Airport']['ident']); ?>&nbsp;</td>
		<td><?php echo h($airport['Airport']['iata_code']); ?>&nbsp;</td>
		<td><?php echo h($airport['Airport']['name']); ?>&nbsp;</td>		
		<td><?php echo h($airport['Airport']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'airports', 'action' => 'view', $airport['Airport']['id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'airports', 'action' => 'edit', $airport['Airport']['id'])
				));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $airport['Airport']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $airport['Airport']['ident'])); ?>
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
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Airport'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Airport manager module</div>';
    }
?>
