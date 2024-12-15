<?php
 
    if ($_SESSION["access_notam_manager"] ==1)
    {
?>
<div class="notams index">
	<h2><?php echo __('Notams'); ?></h2>

	<div class="col-md-12">


		<table class="table table-striped">
		<tr>
				<th><?php echo $this->Paginator->sort('create_date'); ?></th>
				<th><?php echo $this->Paginator->sort('publish_date'); ?></th>
				<th><?php echo $this->Paginator->sort('hide_date'); ?></th>
				<th><?php echo $this->Paginator->sort('notam_name'); ?></th>
				<th><?php echo $this->Paginator->sort('notam_text'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($notams as $notam): ?>
		<tr>
			
			<td><?php echo h($notam['Notam']['create_date']); ?>&nbsp;</td>
			<td><?php echo h($notam['Notam']['publish_date']); ?>&nbsp;</td>
			<td><?php echo h($notam['Notam']['hide_date']); ?>&nbsp;</td>
			<td><?php echo h($notam['Notam']['notam_name']); ?>&nbsp;</td>
			<td><?php echo h($notam['Notam']['notam_text']); ?>&nbsp;</td>
			
			<td class="actions">
				<?php echo $this->Html->link($this->Html->image('view.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'view', $notam['Notam']['notam_id']),
                       array('escape' => false));?>

                <?php echo $this->Html->link($this->Html->image('edit.png', array('width' => '32', 'height' => '32')) . '' . __(''),
                       array('action' => 'edit', $notam['Notam']['notam_id']),
                       array('escape' => false));?>
    

				
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $notam['Notam']['notam_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $notam['Notam']['notam_name'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('New Notam'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?></li>
		
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to NOTAM manager module</div>';
    }
?>
