<?php

    if ($_SESSION["access_airports_manager"] ==1)
    {
?>
<div class="ranks form">
<?php echo $this->Form->create('Airport'); ?>
	<fieldset>
		<legend><?php echo __('Edit Airport'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ident');
		echo $this->Form->input('iata_code');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('latitude_deg');
		echo $this->Form->input('longitude_deg');
		echo $this->Form->input('elevation_ft');
		echo $this->Form->input('iso_country');
		echo $this->Form->input('municipality');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">		
		<li><?php echo $this->Html->link(__('List Airports'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Airport.id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Airport.ident'))); ?></li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Airport manager module</div>';
    }
?>
