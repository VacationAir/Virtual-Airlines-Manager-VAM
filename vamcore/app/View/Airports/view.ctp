<?php

    if ($_SESSION["access_airports_manager"] ==1)
    {
?>
<div class="airports view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Airport'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('ICAO'); ?></td>
	              		<td><?php echo h($airport['Airport']['ident']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('IATA'); ?></td>
	              		<td><?php echo h($airport['Airport']['iata_code']); ?></td>
	              	</tr>	              	
	              	<tr>
	              		<td><?php echo __('Name'); ?></td>
	              		<td><?php echo h($airport['Airport']['name']); ?></td>
	              	</tr>

	              	<tr>
	              		<td><?php echo __('Type'); ?></td>
	              		<td><?php echo h($airport['Airport']['type']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Latitude deg'); ?></td>
	              		<td><?php echo h($airport['Airport']['latitude_deg']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Longitude deg'); ?></td>
	              		<td><?php echo h($airport['Airport']['longitude_deg']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Elevation (FT)'); ?></td>
	              		<td><?php echo h($airport['Airport']['elevation_ft']); ?></td>
	              	</tr>	              	
	              	<tr>
	              		<td><?php echo __('Iso Country'); ?></td>
	              		<td><?php echo h($airport['Airport']['iso_country']); ?></td>
	              	</tr>	 
	              	<tr>
	              		<td><?php echo __('City'); ?></td>
	              		<td><?php echo h($airport['Airport']['municipality']); ?></td>
	              	</tr>	              	          
	              </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Airport'), array('action' => 'edit', $airport['Airport']['id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Airports'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New Airport'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Airport'), array('action' => 'delete', $airport['Airport']['id']),array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $airport['Airport']['ident'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pilots'); ?></h3>
	<?php if (!empty($airport['Gvauser'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Callsign'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Last Visit Date'); ?></th>
		<th><?php echo __('Activation'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('VAM Hours'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($airport['Gvauser'] as $gvauser): ?>
		<tr>
			<td><?php echo $gvauser['callsign']; ?></td>		
			<td><?php echo $gvauser['name']; ?></td>
			<td><?php echo $gvauser['surname']; ?></td>
			<td><?php echo $gvauser['email']; ?></td>
			<td><?php echo $gvauser['last_visit_date']; ?></td>
			<?php $activation='Active'; if ($gvauser['activation']==2) $activation='Inactive'  ; ?>
			<td><?php echo $activation; ?></td>
			<td><?php echo $gvauser['location']; ?></td>
			<td><?php echo $gvauser['gva_hours']; ?></td>
			<td class="actions">
				<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'view', $gvauser['gvauser_id'])
				));?>
				<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'edit', $gvauser['gvauser_id'])
				));?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'gvausers', 'action' => 'delete', $gvauser['gvauser_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $gvauser['callsign'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Airport manager module</div>';
    }
?>
