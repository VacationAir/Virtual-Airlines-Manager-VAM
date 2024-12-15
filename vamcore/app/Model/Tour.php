<?php

App::uses('AppModel', 'Model');

/**

 * Tour Model

 *

 * @property Tour $Tours

 */

class Tour extends AppModel {



/**

 * Primary key field

 *

 * @var string

 */

	public $primaryKey = 'tour_id';



/**

 * Display field

 *

 * @var string

 */

	public $displayField = 'tour_name';





	//The Associations below have been created with all possible keys, those that are not needed can be removed



/**

 * hasMany associations

 *

 * @var array

 */

	public $hasMany = array(

		'TourLeg' => array(

			'className' => 'TourLeg',

			'foreignKey' => 'tour_id',

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





}

