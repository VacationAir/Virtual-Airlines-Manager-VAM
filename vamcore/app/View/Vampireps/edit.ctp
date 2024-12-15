<?php

    if ($_SESSION["access_simacars_manager"] ==1)
    {
?>
<div class="vampireps form">
<?php echo $this->Form->create('Vampirep'); ?>
	<fieldset>
		<legend><?php echo __('Edit Vampirep'); ?></legend>
	<?php
		$yes_no = array('1' => 'Yes', '0' => 'No');
		echo $this->Form->input('id');
		echo $this->Form->input('flight_date');
		echo $this->Form->input('callsign');
		echo $this->Form->input('departure');
		echo $this->Form->input('arrival');
		echo $this->Form->input('flight_duration');
		echo $this->Form->input('distance');
		echo $this->Form->input('route');
		echo $this->Form->input('network');
		echo $this->Form->input(
		    'charter',
		    array('options' => $yes_no, 'default' => '1'));
		echo $this->Ck->input('comments');
		echo $this->Form->input(
		    'validated',
		    array('options' => $yes_no, 'default' => '1'));
		echo $this->Ck->input('validator_comments');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List Pireps'), array('action' => 'index'), array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Vampirep.id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Vampirep.callsign').':' .$this->Form->value('Vampirep.departure').'-'.$this->Form->value('Vampirep.arrival') )); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to SIM ACARS flights manager module</div>';
    }
?>
