<?php

    if ($_SESSION["access_web_manager"] ==1)
    {
?>
<div class="webConfigurations form">
<?php echo $this->Form->create('WebConfiguration'); ?>
	<fieldset>
		<legend><?php echo __('Edit Web Configuration'); ?></legend>
	<?php

		echo $this->Form->input('id');
		echo $this->Ck->input('welcome_text');
		echo $this->Ck->input('rules');
		echo $this->Ck->input('school');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php
    }
    else
    {
        echo '<div class="alert alert-danger"> You do not have access to Web manager module</div>';
    }
?>
