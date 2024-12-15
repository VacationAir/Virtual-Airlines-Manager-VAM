<?php
App::uses('AppModel', 'Model');
/**
 * Rank Model
 *
 * @property Gvauser $Gvauser
 */
class Rank extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'rank_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'rank';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Gvauser' => array(
			'className' => 'Gvauser',
			'foreignKey' => 'rank_id',
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
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'rank' => array(
			'notempty' => array(
				'rule' => array('notblank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'salary_hour' => array(
			'notempty' => array(
				'rule' => 'numeric' ,
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		));

}
