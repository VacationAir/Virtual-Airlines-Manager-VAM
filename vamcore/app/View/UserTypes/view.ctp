<?php

    if ($_SESSION["access_user_type_manager"] ==1)
    {
?>
<div class="userTypes view">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('User Type'); ?></h3>
	        </div>
	        <div class="panel-body">
	            <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('User Type'); ?></td>
	              		<td><?php echo h($userType['UserType']['user_type']); ?></td>
	             	</tr>
	              	<tr>
	              		<td><?php echo __('Access administration Panel'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_administration_panel']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access VA parameters'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_va_parameters']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access hub manager'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_hub_manager']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access fleet type manager'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_fleet_type_manager']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access fleetmanager'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_fleet_manager']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access rank manager'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_rank_manager']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access pilot manager'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_pilot_manager']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Access route manager'); ?></td>
	              		<?php $value='NO';if ($userType['UserType']['access_route_manager']==1) $value='YES'; ?>
	              		<td><?php echo $value; ?></td>	              		
	              	</tr>
		            <tr>
			            <td><?php echo __('Access user type manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_user_type_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access jump validator'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_jump_validator']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access flight validator'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_flight_validator']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access event manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_event_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access notam manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_notam_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access email manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_email_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access language manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_language_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access sim acars manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_vam_acars_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access financial manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_financial_parameters']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access tour manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_tour_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access awards manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_award_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>
		            <tr>
			            <td><?php echo __('Access training manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_training_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>   
		            <tr>
			            <td><?php echo __('Access web manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_web_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr>  
		            <tr>
			            <td><?php echo __('Access SIM ACARS manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_simacars_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr> 
		            <tr>
			            <td><?php echo __('Access Manual flights manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_manual_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr> 
		            <tr>
			            <td><?php echo __('Access Airport manager'); ?></td>
			            <?php $value='NO';if ($userType['UserType']['access_airports_manager']==1) $value='YES'; ?>
			            <td><?php echo $value; ?></td>
		            </tr> 		            		            		        

	            </table>
	        </div>
	    </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit User Type'), array('action' => 'edit', $userType['UserType']['user_type_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pilots'), array('controller' => 'gvausers', 'action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type'), array('action' => 'add'),array('class' => 'btn btn-md btn-success')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Type'), array('action' => 'delete', $userType['UserType']['user_type_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $userType['UserType']['user_type_id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pilots'); ?></h3>
	<?php if (!empty($userType['Gvauser'])): ?>
	<table class="table table-striped">
	<tr>
		<th><?php echo __('Callsign'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Last Visit Date'); ?></th>
		<th><?php echo __('Activation'); ?></th>
		<th><?php echo __('Location'); ?></th>	

		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($userType['Gvauser'] as $gvauser): ?>
		<tr>
			<td><?php echo $gvauser['callsign']; ?></td>
			<td><?php echo $gvauser['name']; ?></td>
			<td><?php echo $gvauser['surname']; ?></td>
			<td><?php echo $gvauser['email']; ?></td>
			<td><?php echo $gvauser['last_visit_date']; ?></td>
			<?php $activation='Active'; if ($gvauser['activation']==2) $activation='Inactive'  ; ?>
			<td><?php echo $activation; ?></td>
			<td><?php echo $gvauser['location']; ?></td>			
	

			<td class="actions">
				<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'view', $gvauser['gvauser_id'])
				));?>
				<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'gvausers', 'action' => 'edit', $gvauser['gvauser_id'])
				));?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'gvausers', 'action' => 'delete', $gvauser['gvauser_id']), array('class' => 'btn btn-md btn-danger'), __('Are you sure you want to delete # %s?', $gvauser['gvauser_id'])); ?>
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
        echo '<div class="alert alert-danger"> You do not have access to User Type module</div>';
    }
?>
