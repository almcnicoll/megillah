<?php
App::uses('AppModel', 'Model');
/**
 * Library Model
 *
 * @property Book $Book
 */
class Library extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Copy',
	);

	public $displayField = 'name';

}
