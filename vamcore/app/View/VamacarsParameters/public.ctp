<?php
 
    if ($_SESSION["access_vam_acars_manager"] ==1)
    {
?>
<div class="vaParameters view">
<h2><?php  echo __('Va Parameter'); ?></h2>
	<dl>
		<dt><?php echo __('Number Pilots'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['number_pilots']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ivao'); ?></dt>
		<?php $value='no'; if ($vaParameter['VaParameter']['ivao']==1) $value='yes' ; ?>
		<dd>
			<?php echo h($value); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vatsim'); ?></dt>
		<?php $value='no'; if ($vaParameter['VaParameter']['vatsim']==1) $value='yes'  ; ?>
		<dd>
			<?php echo h($value); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Va Icao'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['va_icao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Va Name'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['va_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Va Email1'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['va_email1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Va Email2'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['va_email2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Jump Type1'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['jump_type1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Jump Type2'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['jump_type2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Jump Type3'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['jump_type3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pirep Manual'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['pirep_manual']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pirep Fskeeper'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['pirep_fskeeper']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pirep Fsacars'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['pirep_fsacars']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pirep Kacars'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['pirep_kacars']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plane Status Hangar'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['plane_status_hangar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landing Crash'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['landing_crash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landing Penalty1'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['landing_penalty1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landing Penalty2'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['landing_penalty2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landing Penalty3'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['landing_penalty3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landing Vs Penalty1'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['landing_vs_penalty1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landing Vs Penalty2'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['landing_vs_penalty2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flight Wear'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['flight_wear']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hangar Maintenance Days'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['hangar_maintenance_days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hangar Maintenance Value'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['hangar_maintenance_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hangar Crash Days'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['hangar_crash_days']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hangar Crash Value'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['hangar_crash_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pilot Crash Penalty'); ?></dt>
		<dd>
			<?php echo h($vaParameter['VaParameter']['pilot_crash_penalty']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vaParameter['VaParameter']['va_parameters_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Parameters'), array('action' => 'index')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to VAM ACARS manager module</div>';
    }
?>
