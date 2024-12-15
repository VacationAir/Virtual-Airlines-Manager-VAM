<?php
App::uses('AppModel', 'Model');
/**
 * Gvauser Model
 *
 * @property Jump $Jump
 * @property Pirepfsfk $Pirepfsfk
 * @property Report $Report
 * @property Reserf $Reserf
 * @property Stafftracker $Stafftracker
 * @property Vaprofit $Vaprofit
 * @property Fleettype $Fleettype
 */
class Gvauser extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'gvauser_id';

/**
 * Display field
 *
 * @var string
 */
	public $virtualFields = array(
	'name_surname' => 'CONCAT(name, " ", surname,  "   [", Gvauser.callsign,"]")'
	);

	public $displayField = 'name';
	//public $displayField = $virtualFields;


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Jump' => array(
			'className' => 'Jump',
			'foreignKey' => 'gvauser_id',
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
		'Pirepfsfk' => array(
			'className' => 'Pirepfsfk',
			'foreignKey' => 'gvauser_id',
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
		'Report' => array(
			'className' => 'Report',
			'foreignKey' => 'gvauser_id',
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
		'Reserf' => array(
			'className' => 'Reserf',
			'foreignKey' => 'gvauser_id',
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
		'Stafftracker' => array(
			'className' => 'Stafftracker',
			'foreignKey' => 'gvauser_id',
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
		'Vaprofit' => array(
			'className' => 'Vaprofit',
			'foreignKey' => 'gvauser_id',
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
		'Vampirep' => array(
			'className' => 'Vampirep',
			'foreignKey' => 'gvauser_id',
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
		'Pirep' => array(
			'className' => 'Pirep',
			'foreignKey' => 'gvauser_id',
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

	
	
/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Fleettype' => array(
			'className' => 'Fleettype',
			'joinTable' => 'fleettypes_gvausers',
			'foreignKey' => 'gvauser_id',
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
		),
		'Rank' => array(
			'className' => 'Rank',
			'foreignKey' => 'rank_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserType' => array(
			'className' => 'UserType',
			'foreignKey' => 'user_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	

}
