<?php
App::uses('AppModel', 'Model');
/**
 * FleettypesRoute Model
 *
 * @property Route $Route
 * @property Fleettype $Fleettype
 */
class TourLeg extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'tour_leg_id';
	public $primaryKey = 'tour_leg_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */	public $belongsTo = array(
		'Tour' => array(
			'className' => 'Tour',
			'foreignKey' => 'tour_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
