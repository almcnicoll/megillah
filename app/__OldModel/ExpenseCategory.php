<?php
App::uses( 'AppModel', 'Model' );

/**
 * ExpenseCategory Model
 *
 * @property FinanceCategory $FinanceCategory
 * @property Expense         $Expense
 * @property TriggerCategory $TriggerCategory
 */
class ExpenseCategory extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array( 'ExpenseCategory.finance_category_id' => 'ASC', 'ExpenseCategory.rank' => 'ASC' );

	public $validate = array(
		'name'                => array(
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
		'code'                => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'rank'                => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'finance_category_id' => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'trigger_category_id' => array(
			'naturalNumber' => array(
				'rule'       => array( 'naturalNumber' ),
				'message'    => 'Please enter a valid number',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
	);

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'FinanceCategory' => array(
			'className'  => 'FinanceCategory',
			'foreignKey' => 'finance_category_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'TriggerCategory' => array(
			'className'  => 'TriggerCategory',
			'foreignKey' => 'trigger_category_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'Expense' => array(
			'className'  => 'Expense',
			'foreignKey' => 'expense_category_id',
			'dependent'  => false,
			'conditions' => array(
				'Expense.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

}
