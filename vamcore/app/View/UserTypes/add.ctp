<?php

    if ($_SESSION["access_user_type_manager"] ==1)
    {
?>
<div class="userTypes form">
<?php echo $this->Form->create('UserType'); ?>
	<fieldset>
		<legend><?php echo __('Add User Type'); ?></legend>
	<?php
		$yes_no = array('1' => 'Yes', '0' => 'No');
		echo $this->Form->input('user_type');
        echo $this->Form->input('access_administration_panel',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_va_parameters',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_hub_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_fleet_type_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_fleet_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_rank_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_pilot_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_route_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_route_assignator',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_user_type_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_jump_validator',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_flight_validator',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_event_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_notam_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_email_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_language_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_vam_acars_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_financial_parameters',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_tour_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_award_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_training_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_web_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_simacars_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_manual_manager',array('options' => $yes_no, 'default' => '0'));
        echo $this->Form->input('access_airports_manager',array('options' => $yes_no, 'default' => '0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List User Types'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?> </li>
		
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to User Type module</div>';
    }
?>
