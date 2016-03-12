<?php
App::uses( 'AppModel', 'Model' );

/**
 * Income Model
 *
 * @property Client         $Client
 * @property IncomeCategory $IncomeCategory
 */
class Income extends AppModel {

	const FREQUENCY_WEEKLY = 1;
	const FREQUENCY_TWO_WEEKLY = 2;
	const FREQUENCY_FOUR_WEEKLY = 3;
	const FREQUENCY_MONTHLY = 4;
	const FREQUENCY_QUARTERLY = 5;
	const FREQUENCY_ANNUALLY = 6;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array();
	public $virtualFields = array(
		'monthly_amount' => 'IF(Income.frequency = 1, (Income.amount * 52) / 12, IF(Income.frequency = 2, (Income.amount * 26) / 12, IF(Income.frequency = 3, (Income.amount * 13) / 12, IF(Income.frequency = 4, Income.amount, IF(Income.frequency = 5, Income.amount / 3, Income.amount / 12)))))',
	);
	public $validate = array(
		'amount'             => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'frequency'          => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'comment'            => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'client_id'          => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'income_category_id' => array(
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
		'Client'         => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'IncomeCategory' => array(
			'className'  => 'IncomeCategory',
			'foreignKey' => 'income_category_id',
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
