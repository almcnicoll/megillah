<?php
App::uses( 'AppModel', 'Model' );

/**
 * CreditorNote Model
 *
 * @property Creditor $Creditor
 */
class CreditorNote extends AppModel {

	const STATUS_COMPLETE = 1;
	const STATUS_DEFAULT = 2;
	const TYPE_DEFAULT = 1;
	const TYPE_IMPORTANT = 2;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array();
	public $validate = array(
		'text'        => array(
			'notEmpty' => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
		),
		'date'        => array(
			'validateDate' => array(
				'rule'       => array( 'validateDate' ),
				'message'    => 'Please enter a valid date',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'time'        => array(
			'validateTime' => array(
				'rule'       => array( 'validateTime' ),
				'message'    => 'Please enter a valid time',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'status'      => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'type'        => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'creditor_id' => array(
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
		'Creditor' => array(
			'className'  => 'Creditor',
			'foreignKey' => 'creditor_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public static function statuses( $value = null ) {
		$options = array(
			self::STATUS_COMPLETE => __( 'Complete', true ),
			self::STATUS_DEFAULT  => __( 'Default', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_DEFAULT   => __( 'Default', true ),
			self::TYPE_IMPORTANT => __( 'Important', true ),
		);

		return parent::enum( $value, $options );
	}

}
