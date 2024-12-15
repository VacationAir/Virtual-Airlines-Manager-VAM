<?php
App::uses('AppModel', 'Model');
/**
 * VaParameter Model
 *
 */
class VaParameter extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'va_parameters_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'va_icao';

}
