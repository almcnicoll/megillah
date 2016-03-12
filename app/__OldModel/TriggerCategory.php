<?php
App::uses( 'AppModel', 'Model' );

/**
 * TriggerCategory Model
 *
 * @property ExpenseCategory $ExpenseCategory
 * @property TriggerFigure   $TriggerFigure
 */
class TriggerCategory extends AppModel {

	public $order = array();

	public $validate = array(
		'name' => array(
			'notEmpty'  => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
			'maxLength' => array(
				'rule'    => array( 'maxLength', 254 ),
				'message' => 'This field cannot be longer than 254 characters',
				'last'    => true,
			),
		),
	);

	public $hasMany = array(
		'ExpenseCategory' => array(
			'className'  => 'ExpenseCategory',
			'foreignKey' => 'trigger_category_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		),
		'TriggerFigure'   => array(
			'className'  => 'TriggerFigure',
			'foreignKey' => 'trigger_category_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

}
