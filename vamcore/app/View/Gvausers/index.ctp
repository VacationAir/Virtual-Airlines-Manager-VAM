<?php
    if ($_SESSION["access_pilot_manager"] ==1)
    {
?>
<div class="gvausers index">

	<h2><?php echo __('Pilots'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('callsign'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('surname'); ?></th>
			<th><?php echo $this->Paginator->sort('last_visit_date'); ?></th>
			<th><?php echo $this->Paginator->sort('user_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rank_id'); ?></th>
			<th><?php echo $this->Paginator->sort('hub'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	
	<?php foreach ($gvausers as $gvauser): ?>
	
<?php //if ($gvauser['Gvauser']['activation']==1) {?>	
	<tr>
		<td><?php echo h($gvauser['Gvauser']['callsign']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['name']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['surname']); ?>&nbsp;</td>
		<td><?php echo h($gvauser['Gvauser']['last_visit_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($gvauser['UserType']['user_type'], array('controller' => 'userTypes', 'action' => 'view', $gvauser['UserType']['user_type_id'])); ?>
		</td>		
		
		<td>
			<?php echo $this->Html->link($gvauser['Rank']['rank'], array('controller' => 'ranks', 'action' => 'view', $gvauser['Rank']['rank_id'])); ?>
		</td>		
		
		<td>
			<?php echo $this->Html->link($gvauser['Hub']['hub'], array('controller' => 'hubs', 'action' => 'view', $gvauser['Hub']['hub_id'])); ?>
		</td>
		
		<td><?php echo h($gvauser['Gvauser']['location']); ?>&nbsp;</td>
		<td><?php 
				if ($gvauser['Gvauser']['activation']==1){
					echo $this->Html->image('green-user-icon.png', array('width'=>'32px'));	
				}
					
				elseif ($gvauser['Gvauser']['activation']==2){
					echo $this->Html->image('red-user-icon.png', array('width'=>'32px'));
				}
				elseif ($gvauser['Gvauser']['activation']==0){
					echo 'NEW';
				}

					


		 ?>&nbsp;</td>
		

		<td class="actions">

			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'view', $gvauser['Gvauser']['gvauser_id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'edit', $gvauser['Gvauser']['gvauser_id'])
				));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $gvauser['Gvauser']['gvauser_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $gvauser['Gvauser']['callsign'])); ?>
			<?php echo $this->Form->postLink(__('Inactivate'), array('action' => 'inactivate', $gvauser['Gvauser']['gvauser_id']), array('class' => 'btn btn-md btn-warning'), __('Are you sure you want to inactivate # %s?', $gvauser['Gvauser']['callsign'])); ?>
		</td>
	</tr>
		<?php //}?>
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
		
		<li><?php echo $this->Html->link(__('List Ranks'), array('controller' => 'ranks', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Hubs'), array('controller' => 'hubs', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types'), array('controller' => 'usertypes', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rank'), array('controller' => 'ranks', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type'), array('controller' => 'usertypes', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hub'), array('controller' => 'hubs', 'action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Pilots module</div>';
    }
?>
