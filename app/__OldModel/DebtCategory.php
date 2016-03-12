<?php
App::uses( 'AppModel', 'Model' );

/**
 * DebtCategory Model
 *
 * @property Debt $Debt
 */
class DebtCategory extends AppModel {

	const TYPE_PRIMARY = 1;
	const TYPE_SECONDARY = 2;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array( 'DebtCategory.name' => 'ASC' );
	public $virtualFields = array(
		'amount'        => 0,
		'monthly_offer' => 0,
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
		'type' => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
	);
	public $hasMany = array(
		'Debt' => array(
			'className'  => 'Debt',
			'foreignKey' => 'debt_category_id',
			'dependent'  => false,
			'conditions' => array(
				'Debt.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_PRIMARY   => __( 'Priority', true ),
			self::TYPE_SECONDARY => __( 'Non-Priority', true ),
		);

		return parent::enum( $value, $options );
	}

}
