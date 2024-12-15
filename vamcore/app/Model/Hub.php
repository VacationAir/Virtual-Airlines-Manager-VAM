<?php
App::uses('AppModel', 'Model');
/**
 * Hub Model
 *
 * @property Gvauser $Gvauser
 */
class Hub extends AppModel {
	//var $hasMany  = array('gvauser');
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'hub_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'hub';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'hub' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		));
	
	
/**
 * hasMany associations
 *
 * @var array
 */
 

	public $hasMany = array(
		'Gvauser' => array(
			'className' => 'Gvauser',
			'foreignKey' => 'hub_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Fleet' => array(
			'className' => 'Fleet',
			'foreignKey' => 'hub_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)

	);

}
