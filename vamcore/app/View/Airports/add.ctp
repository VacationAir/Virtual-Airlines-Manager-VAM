<?php

    if ($_SESSION["access_airports_manager"] ==1)
    {
?>
<div class="airports form">
<?php echo $this->Form->create('Airport'); ?>
	<fieldset>
		<legend><?php echo __('Add Airport'); ?></legend>
	<?php
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
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Airports manager module</div>';
    }
?>
