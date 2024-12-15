<?php
App::uses('AppModel', 'Model');
/**
 * Awardpilot Model
 *
 */
class AwardPilot extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'award_pilot_id';
	public $primaryKey = 'award_pilot_id';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Award' => array(
			'className' => 'Award',
			'foreignKey' => 'award_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gvauser' => array(
			'className' => 'Gvauser',
			'foreignKey' => 'gvauser_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
}


