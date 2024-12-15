<?php

    if ($_SESSION["access_va_parameters"] ==1)
    {
?>
<div class="vaParameters form">
<?php echo $this->Form->create('VaParameter'); ?>
	<fieldset>
		<legend><?php echo __('Edit VA Parameters'); ?></legend>
	<?php
		echo $this->Form->input('va_parameters_id');
		echo $this->Form->input('number_pilots');
		$yes_no = array('1' => 'Yes', '0' => 'No');
		$timeformat = array('1' => 'Decimal (example 2.45)', '0' => 'HH:MM');
		echo $this->Form->input(
		    'ivao',
		    array('options' => $yes_no, 'default' => '1'));

		echo $this->Form->input(
		    'vatsim',
		    array('options' => $yes_no, 'default' => '1'));

		echo $this->Form->input('va_icao');
		echo $this->Form->input('va_name');
		echo $this->Form->input('jump_type1');
		echo $this->Form->input('jump_type2');
		echo $this->Form->input('jump_type3');
		echo $this->Form->input('plane_status_hangar');
		echo $this->Form->input('landing_crash');
		echo $this->Form->input('landing_penalty1');
		echo $this->Form->input('landing_penalty2');
		echo $this->Form->input('landing_penalty3');
		echo $this->Form->input('landing_vs_penalty1');
		echo $this->Form->input('landing_vs_penalty2');
		echo $this->Form->input('flight_wear');
		echo $this->Form->input('hangar_maintenance_days');
		echo $this->Form->input('hangar_crash_value');
		echo $this->Form->input('hangar_crash_days');
		echo $this->Form->input('pilot_crash_penalty');
		echo $this->Form->input('charter_reduction');
		echo $this->Form->input('currency');
		echo $this->Form->input(
		    'no_count_rejected',
		    array('options' => $yes_no, 'default' => '1'));
		echo $this->Form->input(
		    'pilot_public',
		    array('options' => $yes_no, 'default' => '1'));
		echo $this->Form->input(
		    'allow_select_aircraft_for_charter',
		    array('options' => $yes_no, 'default' => '1'));
		echo $this->Form->input(
		    'activate_finance_module',
		    array('options' => $yes_no, 'default' => '1'));

		echo $this->Form->hidden('activate_finance_module_old', array('type' => 'hidden','value'=>$this->Form->value('date_activation_finance_module')));
		echo $this->Form->hidden('date_activation_finance_module', array('type' => 'hidden','value'=>$this->Form->value('date_activation_finance_module')));

		echo $this->Form->input(
		    'auto_approval',
		    array('options' => $yes_no, 'default' => '1'));
		echo $this->Form->input('date_format');
		echo $this->Form->input(
		    'time_format',
		    array('options' => $timeformat, 'default' => '1'));
		echo $this->Form->input('hours_auto_cancellation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">

		<li><?php echo $this->Html->link(__('VA Parameters'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to VA Parameters module</div>';
    }
?>
