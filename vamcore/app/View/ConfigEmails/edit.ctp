<?php

    if ($_SESSION["access_email_manager"] ==1)
    {
?>
<div class="configEmails form">
<?php echo $this->Form->create('ConfigEmail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Config Email'); ?></legend>
	<?php
		echo $this->Form->input('config_emails_id');
		echo $this->Form->input('staff_email');
		echo $this->Form->input('ceo_email');
		echo $this->Form->input('cc_email_1',['label' => 'CC Email']);
		echo $this->Ck->input('register_text');
		echo $this->Ck->input('warning_text');
		echo $this->Ck->input('inactivate_text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Email manager module</div>';
    }
?>
