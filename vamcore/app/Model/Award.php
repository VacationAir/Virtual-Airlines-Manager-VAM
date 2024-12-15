<?php
	App::uses('AppModel', 'Model');
	/**
	 * Award Model
	 *
	 * @property Award $Awards
	 */
	class Award extends AppModel {

		/**
		 * Primary key field
		 *
		 * @var string
		 */
		public $primaryKey = 'award_id';

		/**
		 * Display field
		 *
		 * @var string
		 */
		public $displayField = 'award_name';


		//The Associations below have been created with all possible keys, those that are not needed can be removed

		/**
		 * hasMany associations
		 *
		 * @var array
		 */
		public $hasMany = array(
			'Award_pilots' => array(
				'className' => 'AwardPilot',
				'foreignKey' => 'award_id',
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
