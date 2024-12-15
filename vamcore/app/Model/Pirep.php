<?php
App::uses('AppModel', 'Model');
/**
 * Pirep Model
 *
 * 
 */
class Pirep extends AppModel {
	
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'pirep_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'pirep_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
/**
 * Validation rules
 *
 * @var array
 */
	
/**
 * belongsTo associations
 *
 * @var array
 */
 
	public $belongsTo = array(
		'Gvauser' => array(
			'className' => 'Gvauser',
			'foreignKey' => 'gvauser_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);		

}