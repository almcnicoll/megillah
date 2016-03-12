<?php
App::uses( 'AppModel', 'Model' );

/**
 * Expense Model
 *
 * @property Client          $Client
 * @property ExpenseCategory $ExpenseCategory
 */
class Expense extends AppModel {

	const FREQUENCY_WEEKLY = 1;
	const FREQUENCY_TWO_WEEKLY = 2;
	const FREQUENCY_FOUR_WEEKLY = 3;
	const FREQUENCY_MONTHLY = 4;
	const FREQUENCY_QUARTERLY = 5;
	const FREQUENCY_ANNUALLY = 6;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array();
	public $virtualFields = array(
		'monthly_amount' => 'IF(Expense.frequency = 1, (Expense.amount * 52) / 12, IF(Expense.frequency = 2, (Expense.amount * 26) / 12, IF(Expense.frequency = 3, (Expense.amount * 13) / 12, IF(Expense.frequency = 4, Expense.amount, IF(Expense.frequency = 5, Expense.amount / 3, Expense.amount / 12)))))',
	);
	public $validate = array(
		'amount'              => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'frequency'           => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'comment'             => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'client_id'           => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'expense_category_id' => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
	);
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Client'          => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'ExpenseCategory' => array(
			'className'  => 'ExpenseCategory',
			'foreignKey' => 'expense_category_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public static function frequencies( $value = null ) {
		$options = array(
			self::FREQUENCY_WEEKLY      => __( 'Weekly', true ),
			self::FREQUENCY_TWO_WEEKLY  => __( 'Two-Weekly', true ),
			self::FREQUENCY_FOUR_WEEKLY => __( 'Four-Weekly', true ),
			self::FREQUENCY_MONTHLY     => __( 'Monthly', true ),
			self::FREQUENCY_QUARTERLY   => __( 'Quarterly', true ),
			self::FREQUENCY_ANNUALLY    => __( 'Annually', true ),
		);

		return parent::enum( $value, $options );
	}

}
