<?php
    if ($_SESSION["access_email_manager"] ==1)
    {
?>
<div class="configEmails view">
	<div class="col-md-12">
	          <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title"><?php  echo __('Email Configuration'); ?></h3>
	            </div>
	            <div class="panel-body">
	              <table class="table table-striped">
	              	<tr>
	              		<td><?php echo __('Staff email'); ?></td>
	              		<td><?php echo h($configEmail['ConfigEmail']['staff_email']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('CEO email'); ?></td>
	              		<td><?php echo h($configEmail['ConfigEmail']['ceo_email']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('CC email'); ?></td>
	              		<td><?php echo h($configEmail['ConfigEmail']['cc_email_1']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Register email text'); ?></td>
	              		<td><?php echo h($configEmail['ConfigEmail']['register_text']); ?></td>
	              	</tr>
	              	<tr>
	              		<td><?php echo __('Warning email text'); ?></td>
	              		<td><?php echo h($configEmail['ConfigEmail']['warning_text']); ?></td>
	              	</tr>
					<tr>
	              		<td><?php echo __('Inactivate email text'); ?></td>
	              		<td><?php echo h($configEmail['ConfigEmail']['inactivate_text']); ?></td>
	              	</tr>
	              </table>
	            </div>
	          </div>
	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul class="list-inline">
		<li><?php echo $this->Html->link(__('Edit Config Email'), array('action' => 'edit', $configEmail['ConfigEmail']['config_emails_id']),array('class' => 'btn btn-md btn-primary')); ?> </li>
		<li><?php echo $this->Html->link(__('List Config Emails'), array('action' => 'index'),array('class' => 'btn btn-md btn-primary')); ?> </li>
	</ul>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Email manager module</div>';
    }
?>
