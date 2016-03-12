<?php
App::uses('AppModel', 'Model');
/**
 * Copy Model
 *
 * @property Loan $Loan
 * @property Author $Author
 * @property Taxonomy $Taxonomy
 */
class Copy extends AppModel {
	public $actsAs = array('Containable');
	public $recursive = 2;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Loan' => array( 'order' => 'start_date DESC' ),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Book',
	);
	
	public $virtualFields = array('title' => "CONCAT(Copy.id,' / ',Copy.legacy_book_number)");
	public $displayField = "title";

}
