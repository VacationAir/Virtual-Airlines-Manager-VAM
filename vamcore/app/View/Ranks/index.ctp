<?php

    if ($_SESSION["access_rank_manager"] ==1)
    {
?>
<div class="ranks index">
	<h2><?php echo __('Ranks'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('rank'); ?></th>
			<th><?php echo $this->Paginator->sort('salary_hour'); ?></th>
			<th><?php echo $this->Paginator->sort('minimum_hours'); ?></th>
			<th><?php echo $this->Paginator->sort('maximum_hours'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ranks as $rank): ?>
	<tr>
		<td><?php echo h($rank['Rank']['rank']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['salary_hour']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['minimum_hours']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['maximum_hours']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'ranks', 'action' => 'view', $rank['Rank']['rank_id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'ranks', 'action' => 'edit', $rank['Rank']['rank_id'])
				));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rank['Rank']['rank_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $rank['Rank']['rank'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rank'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Rank manager module</div>';
    }
?>
