<?php
App::uses('AppModel', 'Model');
/**
 * ConfigEmail Model
 *
 */
class ConfigEmail extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'config_emails_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'staff_email';

/**
 * Validation rules
 *
 * @var array
 */
 /*
	public $validate = array(
		'staff_email' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ceo_email' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);*/
}
