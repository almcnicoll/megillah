<?php
App::uses('AppModel', 'Model');
/**
 * Publisher Model
 *
 */
class Publisher extends AppModel {
	public $actsAs = array('Containable');
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Imprint',
	);

}
?>