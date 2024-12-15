<?php

    if ($_SESSION["access_pilot_manager"] ==1)
    {
?>
<div class="gvausers view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Pilot'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Name'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['name']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Surname'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['surname']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Callsign'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['callsign']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Email'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['email']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('User Type'); ?></td>
	              		<td><?php echo $this->Html->link($gvauser['UserType']['user_type'], array('controller' => 'userTypes', 'action' => 'view', $gvauser['UserType']['user_type_id'])); ?></td>
	              	</tr>
	               	<tr>
	              		<td><?php echo __('Register Date'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['register_date']); ?></td>
	              	</tr>
	             	<tr>
	              		<td><?php echo __('Last Visit Date'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['last_visit_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Birth Date'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['birth_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Activation'); ?></td>
	              		<?php $status='2222';
							  if ($gvauser['Gvauser']['activation']==2) $status='Inactive';
							  if ($gvauser['Gvauser']['activation']==1) $status='Active';
							  if ($gvauser['Gvauser']['activation']==0) $status='New';	
						?>
	              		<td><?php echo $status; ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('IVAO VID'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['ivaovid']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('VATSIM ID'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['vatsimid']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Hub'); ?></td>
	              		<td><?php echo $this->Html->link($gvauser['Hub']['hub'], array('controller' => 'hubs', 'action' => 'view', $gvauser['Hub']['hub_id'])); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Rank'); ?></td>
	              		<td><?php echo $this->Html->link($gvauser['Rank']['rank'], array('controller' => 'ranks', 'action' => 'view', $gvauser['Rank']['rank_id'])); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Location'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['location']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Country'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['country']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('City'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['city']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Transfered hours'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['transfered_hours']); ?></td>
	              	</tr>
	           		<tr>
	              		<td><?php echo __('Current route book date'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['book_date']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Registry Comments'); ?></td>
	              		<td><?php echo h($gvauser['Gvauser']['reg_comments']); ?></td>
	              	</tr>
	              </table>
	        </div>
	    </div>
	</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Pilot'), array('action' => 'edit', $gvauser['Gvauser']['gvauser_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Pilot'), array('action' => 'delete', $gvauser['Gvauser']['gvauser_id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $gvauser['Gvauser']['gvauser_id'])); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php echo __('Related Fleet Types'); ?></h3>
	<?php if (!empty($gvauser['Fleettype'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Plane Icao'); ?></th>
		<th><?php echo __('Plane Description'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($gvauser['Fleettype'] as $fleettype): ?>
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
        echo '<div class="alert alert-danger"> You do not have access to Pilots module</div>';
    }
?>
