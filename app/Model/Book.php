<?php
App::uses('AppModel', 'Model');
/**
 * Book Model
 *
 * @property Loan $Loan
 * @property Author $Author
 * @property Taxonomy $Taxonomy
 */
class Book extends AppModel {
	public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'classification' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Copy',
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Author' /*=> array(
			'className' => 'Author',
			'joinTable' => 'authors_books',
			'foreignKey' => 'book_id',
			'associationForeignKey' => 'author_id',
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
		'Taxonomy' /*=> array(
			'className' => 'Taxonomy',
			'joinTable' => 'books_taxonomies',
			'foreignKey' => 'book_id',
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
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Imprint',
	);
	
	public $displayField = 'title';

}
