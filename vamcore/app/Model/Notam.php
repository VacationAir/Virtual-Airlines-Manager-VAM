<?php
App::uses('AppModel', 'Model');
/**
 * Notam Model
 *
 * 
 */
class Notam extends AppModel {
	
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'notam_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'notam_name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
/**
 * Validation rules
 *
 * @var array
 */
	
	public $validate = array(
		'notam_name' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'notam_text' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);
}