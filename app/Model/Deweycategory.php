<?php
App::uses('AppModel', 'Model');
/**
 * Deweycategory Model
 *
 * @property Deweycategory $Parent
 * @property Deweycategory $Child
 * @property Book $Book
 */
class Deweycategory extends AppModel {
	public $actsAs = array('Tree');
	
	public function beforeSave($options = array()) {
		if(!empty($this->data['Deweycategory']['classification'])) {
			// Set search string
			$this->data['Deweycategory']['search_string'] = ((string)$this->data['Deweycategory']['classification']) . '%';
			
			// Set parent
			if (strpos($this->data['Deweycategory']['classification'],'.') === false) {
				// No decimal part - check if it ends in 0 (no parent) or another digit (0-ending parent)
				$last_digit = substr($this->data['Deweycategory']['classification'],-1);
				if ($last_digit == 0) {
					// No parent
					$this->data['Deweycategory']['parent_id'] = null;
				} else {
					// Try to find parent
					$search_class = substr($this->data['Deweycategory']['classification'],0,-1).'0';
					$parent_class = $this->find('first', array(
						'conditions' => array(
							'classification' => $search_class,
						),
					));
					if (!empty($parent_class)) {
						$this->data['Deweycategory']['parent_id'] = $parent_class['Deweycategory']['id'];
					}
				}
			} else {
				// Try to find parent
				$search_class = substr($this->data['Deweycategory']['classification'],0,-1);
				$parent_class = $this->find('first', array(
					'conditions' => array(
						'classification' => $search_class,
					),
				));
				if (!empty($parent_class)) {
					$this->data['Deweycategory']['parent_id'] = $parent_class['Deweycategory']['id'];
				}
			}
		}
		
		return true;
	}
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'classification' => array(
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Each classification must be unique',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public $order = array(
		'lft',
	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Parent' => array(
			'className' => 'Deweycategory',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Child' => array(
			'className' => 'Deweycategory',
			'foreignKey' => 'parent_id',
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
		'Book',
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Taxonomy'/* => array(
			'className' => 'Taxonomy',
			'joinTable' => 'deweycategories_taxonomies',
			'foreignKey' => 'deweycategory_id',
			'associationForeignKey' => 'taxonomy_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)*/,
	);
	
	public $displayField = 'classification';

}