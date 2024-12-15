<?php
App::uses('FormHelper', 'View/Helper');

/**
 * BootstrapFormHelper.
 *
 * Applies styling-rules for Bootstrap 3
 *
 * To use it, just save this file in /app/View/Helper/BootstrapFormHelper.php
 * and add the following code to your AppController:
 *   	public $helpers = array(
 *		    'Form' => array(
 *		        'className' => 'BootstrapForm'
 *	  	  	)
 *		);
 *
 * @link https://gist.github.com/Suven/6325905
 */
class BootstrapFormHelper extends FormHelper {

    public function create($model = null, $options = array()) {
        $defaultOptions = array(
            'inputDefaults' => array(
                'div' => array(
                	'class' => 'form-group'
                ),
                
                'between' => '<div class="col-md-12">',
                'seperator' => '</div>',
                'after' => '</div>',
                'class' => 'form-control',
            ),
            'class' => 'form-horizontal',
            'role' => 'form',
        );

        if(!empty($options['inputDefaults'])) {
            $options = array_merge($defaultOptions['inputDefaults'], $options['inputDefaults']);
        } else {
            $options = array_merge($defaultOptions, $options);
        } 
        return parent::create($model, $options);
    }
    
    // Remove this function to show the fieldset & language again
    public function inputs($fields = null, $blacklist = null, $options = array()) {
    	$options = array_merge(array('fieldset' => false), $options);
    	return parent::inputs($fields, $blacklist, $options);
    }
    
    public function submit($caption = null, $options = array()) {
	    $defaultOptions = array(
	    	'class' => 'btn btn-primary',
	    	'div' =>  'form-group',
	    	'before' => '<div class="col-lg-offset-2 col-lg-2">',
	    	'after' => '</div>',
	    );
        $options = array_merge($defaultOptions, $options);     
	    return parent::submit($caption, $options);
    }

}