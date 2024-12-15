<?php
    if ($_SESSION["access_pilot_manager"] ==1)
    {
?>
<div class="gvausers form">
<?php echo $this->Form->create('Gvauser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pilot'); ?></legend>
	<?php
		$options = array(array('name' => 'Inactive', 'value' => '2'),array('name' => 'Active', 'value' => '1'),array('name' => 'New', 'value' => '0'));
		echo $this->Form->input('activation',array('type'=>'select', 'options'=>$options));
		echo $this->Form->input('gvauser_id');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('callsign');
		echo $this->Form->input('email');
		echo $this->Form->input('user_type_id');
		echo $this->Form->input('ivaovid',['label' => 'IVAO VID']);
		echo $this->Form->input('vatsimid',['label' => 'VATSIM ID']);
		echo $this->Form->input('hub_id');
		echo $this->Form->input('location');
		echo $this->Form->input('city');
		echo $this->Form->input('rank_id');
		echo $this->Form->input('birth_date');
		echo $this->Form->input('Fleettype',['label' => 'Aircraft certification']);
		echo $this->Form->input('transfered_hours');
		echo $this->Form->hidden('callsign_prev', array('type' => 'hidden','value'=>$this->Form->value('callsign')));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('List Pilots'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?></li>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Gvauser.gvauser_id')), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Gvauser.gvauser_id'))); ?></li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Pilots module</div>';
    }
?>
