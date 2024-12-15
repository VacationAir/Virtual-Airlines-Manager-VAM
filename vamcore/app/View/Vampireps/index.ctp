<?php

    if ($_SESSION["access_simacars_manager"] ==1)
    {
?>
<div class="vampireps index">
	<h2><?php echo __('Vampireps'); ?></h2>

	<div class="col-md-12">


		<table class="table table-striped">
		<tr>
				<th><?php echo $this->Paginator->sort('gvauser_id'); ?></th>
				<th><?php echo $this->Paginator->sort('flight_date'); ?></th>
				<th><?php echo $this->Paginator->sort('callsign'); ?></th>
				<th><?php echo $this->Paginator->sort('departure'); ?></th>
				<th><?php echo $this->Paginator->sort('arrival'); ?></th>
				<th><?php echo $this->Paginator->sort('flight_duration'); ?></th>

				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($vampireps as $vampirep): ?>
		<tr>
			<td>
        		<?php echo $this->Html->link($vampirep['Gvauser']['callsign'], array('controller' => 'gvausers', 'action' => 'view', $vampirep['Gvauser']['gvauser_id'])); ?>
       		 </td>
			<td><?php echo h($vampirep['Vampirep']['flight_date']); ?>&nbsp;</td>
			<td><?php echo h($vampirep['Vampirep']['callsign']); ?>&nbsp;</td>
			<td><?php echo h($vampirep['Vampirep']['departure']); ?>&nbsp;</td>
			<td><?php echo h($vampirep['Vampirep']['arrival']); ?>&nbsp;</td>
			<td><?php echo h($vampirep['Vampirep']['flight_duration']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $vampirep['Vampirep']['id']),
                       array('escape' => false));?>

                <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $vampirep['Vampirep']['id']),
                       array('escape' => false));?>



				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vampirep['Vampirep']['id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete the flight %s?', $vampirep['Vampirep']['callsign'] .':' .$vampirep['Vampirep']['departure']  .'-' .$vampirep['Vampirep']['arrival'])); ?>
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
        echo '<div class="alert alert-danger"> You do not have access to SIM ACARS flights manager module</div>';
    }
?>
