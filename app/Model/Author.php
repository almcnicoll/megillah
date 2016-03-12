<?php
App::uses('AppModel', 'Model');
/**
 * Author Model
 *
 * @property Book $Book
 */
class Author extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book'/* => array(
			'className' => 'Book',
			'joinTable' => 'authors_books',
			'foreignKey' => 'author_id',
			'associationForeignKey' => 'book_id',
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

	public $virtualFields = array(
		'full_name'		=>	"CONCAT(Author.last_name,', ',Author.first_names)",
	);
	public $displayField = 'full_name';

}
