<?php
App::uses('AppModel', 'Model');
/**
 * Pirepfsfk Model
 *
 * @property Gvauser $Gvauser
 */
class Pirepfsfk extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'pirepfsfk';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'pirepfsfk_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
