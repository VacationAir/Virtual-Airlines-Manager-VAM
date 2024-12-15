<?php class CkHelper extends Helper {
    public $helpers = array('Form');

	/**
	* This function inserts CK Editor for a form input
	*
	* @param string $input The name of the field, can be field_name or Model.field_name
	* @param array $options Options include $options['label'] for a custom label - this can be expanded on if required
	*/
    function input($input, $options = array()) {
        $input = explode('.', $input);
        if(empty($input[1])) {
        	$field = $input[0];
        	$model = $this->Form->model();
        } else {
        	$model = $input[0];
        	$field = $input[1];
        }
        
        if(!empty($options['label'])) {
        	echo '<h4>'.$options['label'].'</h4>';
        } else {
        	echo '<h4>'.Inflector::humanize(Inflector::underscore($field)).'</h4>';
        }
        
        echo $this->Form->error($model.'.'.$field);
        echo $this->Form->input($model.'.'.$field, array('type' => 'textarea', 'label' => false, 'error' => false, 'required' => false));
		?>
			<script type="text/javascript">
				CKEDITOR.replace('<?php echo Inflector::camelize($model.'_'.$field); ?>');
			</script>
			
			<p>&nbsp;</p>
		<?php
    }
}
