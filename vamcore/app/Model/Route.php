<?php
App::uses('AppModel', 'Model');
/**
 * Route Model
 *
 * @property Fleettype $Fleettype
 */
class Route extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'route_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'flight';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */

	public $belongsTo = array(
		'Hub' => array(
			'className' => 'Hub',
			'foreignKey' => 'hub_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Fleettype' => array(
			'className' => 'Fleettype',
			'joinTable' => 'fleettypes_routes',
			'foreignKey' => 'route_id',
			'associationForeignKey' => 'fleettype_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	
}
