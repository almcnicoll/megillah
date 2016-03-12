<?php
App::uses( 'AppModel', 'Model' );

/**
 * FinanceCategory Model
 *
 * @property ExpenseCategory $ExpenseCategory
 * @property IncomeCategory  $IncomeCategory
 * @property TriggerFigure   $TriggerFigure
 */
class FinanceCategory extends AppModel {

	const TYPE_EXPENSE = 1;
	const TYPE_INCOME = 2;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array( 'FinanceCategory.type' => 'ASC', 'FinanceCategory.rank' => 'ASC' );
	public $virtualFields = array(
		'amount'         => 0, // Potentially Redundant.
		'monthly_amount' => 0,
		'cap'            => 0,
	);
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
		'code' => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'rank' => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'type' => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
	);
	public $hasMany = array(
		'ExpenseCategory' => array(
			'className'  => 'ExpenseCategory',
			'foreignKey' => 'finance_category_id',
			'dependent'  => false,
			'conditions' => array(
				'ExpenseCategory.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'IncomeCategory'  => array(
			'className'  => 'IncomeCategory',
			'foreignKey' => 'finance_category_id',
			'dependent'  => false,
			'conditions' => array(
				'IncomeCategory.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_EXPENSE => __( 'Expense', true ),
			self::TYPE_INCOME  => __( 'Income', true ),
		);

		return parent::enum( $value, $options );
	}

}
