<?php
App::uses('AppModel', 'Model');
/**
 * Loan Model
 *
 * @property User $User
 * @property Book $Book
 */
class Loan extends AppModel {
	public $actsAs = array('Containable');
	public $recursive = 2;

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Copy' => array(
			'className' => 'Copy',
			'foreignKey' => 'copy_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	

	public $virtualFields = array(
		'loan_descriptor'		=>	"CONCAT('#',Loan.id,' (due ',DATE_FORMAT(Loan.due_date,'%d %b %Y'),')')",
	);
	public $displayField = 'loan_descriptor';
}