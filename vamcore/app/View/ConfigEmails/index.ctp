<?php
    if ($_SESSION["access_email_manager"] ==1)
    {
?>
<div class="configEmails index">
	<h2><?php echo __('Config Emails'); ?></h2>
	<table class="table table-striped">
	<tr>
			<th><?php echo $this->Paginator->sort('staff_email'); ?></th>
			<th><?php echo $this->Paginator->sort('ceo_email'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_email'); ?></th>
			<th><?php echo $this->Paginator->sort('Register text'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($configEmails as $configEmail): ?>
	<tr>
		<td><?php echo h($configEmail['ConfigEmail']['staff_email']); ?>&nbsp;</td>
		<td><?php echo h($configEmail['ConfigEmail']['ceo_email']); ?>&nbsp;</td>
		<td><?php echo h($configEmail['ConfigEmail']['cc_email_1']); ?>&nbsp;</td>
		<td><?php echo h($configEmail['ConfigEmail']['register_text']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->image("view.png", array(
			    'url' => array('controller' => 'ConfigEmails', 'action' => 'view', $configEmail['ConfigEmail']['config_emails_id'])
				));?>
			<?php echo $this->Html->image("edit.png", array(
			    'url' => array('controller' => 'ConfigEmails', 'action' => 'edit', $configEmail['ConfigEmail']['config_emails_id'])
				));?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Email manager module</div>';
    }
?>
