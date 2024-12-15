<?php
App::uses('AppModel', 'Model');
/**
 * Vampirep Model
 *
 *
 */
class Vampirep extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'flightid';
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