<?php
App::uses('AppModel', 'Model');
/**
 * FleettypesRoute Model
 *
 * @property Route $Route
 * @property Fleettype $Fleettype
 */
class FleettypesRoute extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fleettype_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Route' => array(
			'className' => 'Route',
			'foreignKey' => 'route_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fleettype' => array(
			'className' => 'Fleettype',
			'foreignKey' => 'fleettype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
