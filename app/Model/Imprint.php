<?php
App::uses('AppModel', 'Model');
/**
 * Imprint Model
 *
 */
class Imprint extends AppModel {
	public $actsAs = array('Containable');
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Book',
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Publisher',
	);
	
}
?>