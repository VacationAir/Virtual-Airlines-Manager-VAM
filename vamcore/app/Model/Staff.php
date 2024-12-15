<?php
App::uses('AppModel', 'Model');
/**
 * Staff Model
 *
 * @property Gvauser $Gvauser
 */
class Staff extends AppModel {

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
	public $displayField = 'role';
	//The Associations below have been created with all possible keys, those that are not needed can be removed


}
