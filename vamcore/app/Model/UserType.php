<?php
App::uses('AppModel', 'Model');
/**
 * UserType Model
 *
 * @property Gvauser $Gvauser
 */
class UserType extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'user_type_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_type';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Gvauser' => array(
			'className' => 'Gvauser',
			'foreignKey' => 'user_type_id',
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

}
