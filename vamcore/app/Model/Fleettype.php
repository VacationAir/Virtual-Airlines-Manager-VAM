<?php
App::uses('AppModel', 'Model');
/**
 * Fleettype Model
 *
 */
class Fleettype extends AppModel {

	var $hasMany  = array('fleet','route');
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'fleettype_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'plane_icao';

		
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'plane_icao' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'plane_description' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		));
		
	
}
