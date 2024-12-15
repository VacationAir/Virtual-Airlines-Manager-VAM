<?php

    if ($_SESSION["access_manual_manager"] ==1)
    {
?>
<div class="pireps index">
	<h2><?php echo __('Pireps'); ?></h2>

	<div class="col-md-12">


		<table class="table table-striped">
		<tr>
				<th><?php echo $this->Paginator->sort('gvauser_id'); ?></th>
				<th><?php echo $this->Paginator->sort('date'); ?></th>
				<th><?php echo $this->Paginator->sort('from_airport'); ?></th>
				<th><?php echo $this->Paginator->sort('to_airport'); ?></th>
				<th><?php echo $this->Paginator->sort('duration'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($pireps as $pirep): ?>
		<tr>

			<td>
        		<?php echo $this->Html->link($pirep['Gvauser']['callsign'], array('controller' => 'gvausers', 'action' => 'view', $pirep['Gvauser']['gvauser_id'])); ?>
       		 </td>
			<td><?php echo h($pirep['Pirep']['date']); ?>&nbsp;</td>
			<td><?php echo h($pirep['Pirep']['from_airport']); ?>&nbsp;</td>
			<td><?php echo h($pirep['Pirep']['to_airport']); ?>&nbsp;</td>
			<td><?php echo h($pirep['Pirep']['duration']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $pirep['Pirep']['pirep_id']),
                       array('escape' => false));?>

                <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $pirep['Pirep']['pirep_id']),
                       array('escape' => false));?>



				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pirep['Pirep']['pirep_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $pirep['Pirep']['pirep_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>

	</div>
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

<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Manual Pireps manager module</div>';
    }
?>
