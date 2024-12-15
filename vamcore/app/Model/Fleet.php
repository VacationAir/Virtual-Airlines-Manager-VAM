<?php
App::uses('AppModel', 'Model');
/**
 * Fleet Model
 *
 * @property Fleettype $Fleettype
 */
class Fleet extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'fleets';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'fleet_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
 
	public $belongsTo = array(
		'Fleettype' => array(
			'className' => 'Fleettype',
			'foreignKey' => 'fleettype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hub' => array(
			'className' => 'Hub',
			'foreignKey' => 'hub_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
	'Route' =>
	array(
	'className' => 'Route',
	'joinTable' => 'fleettypes_routes',
	'foreignKey' => 'fleet_id',
	'associationForeignKey' => 'fleet_id'
	));
		
	
	
	
	
	
}
