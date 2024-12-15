<?php

    if ($_SESSION["access_vam_acars_manager"] ==1)
    {
?>
<div class="vamacarsParameters form">
<?php echo $this->Form->create('VamacarsParameter'); ?>
	<fieldset>
		<legend><?php echo __('Edit VAM ACARS Parameters'); ?></legend>
	<?php
		echo $this->Form->input('vamacars_parameters_id');
		echo $this->Form->input('crash');
		echo $this->Form->input('beacon_off');
		echo $this->Form->input('ias_below_10000_ft');
		echo $this->Form->input('lights_below_10000_ft');
		echo $this->Form->input('lights_above_10000_ft');
		echo $this->Form->input('stall');
		echo $this->Form->input('overspeed');
		echo $this->Form->input('pause');
		echo $this->Form->input('refuel');
		echo $this->Form->input('slew');
		echo $this->Form->input('taxi_lights');
		echo $this->Form->input('taxi_speed');
		echo $this->Form->input('takeoff_lights');
		echo $this->Form->input('land_lights');
		echo $this->Form->input('incorrect_arrival');
		echo $this->Form->input('landing_vs_0_100');
		echo $this->Form->input('landing_vs_100_200');
		echo $this->Form->input('landing_vs_200_300');
		echo $this->Form->input('landing_vs_300_400');
		echo $this->Form->input('landing_vs_400_500');
		echo $this->Form->input('landing_vs_500_600');
		echo $this->Form->input('landing_vs_greater_600');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
	
		<li><?php echo $this->Html->link(__('VAM ACARS Parameters'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to VAM ACARS manager module</div>';
    }
?>
