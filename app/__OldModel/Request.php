<?php
App::uses( 'AppModel', 'Model' );

/**
 * Request Model
 *
 * @property User $User
 */
class Request extends AppModel {

	const STATUS_CLOSED = 1;
	const STATUS_OPEN = 2;
	const TYPE_FEEDBACK = 1;
	const TYPE_SUPPORT = 2;
	public $actsAs = array( 'Loggable', 'Search.Searchable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $filterArgs = array(
		'search'  => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Request.subject',
				'Request.text'
			)
		),
		'user_id' => array(
			'type'       => 'lookup',
			'formField'  => 'user_input',
			'modelField' => 'full_name',
			'model'      => 'User'
		),
		'status'  => array(
			'type' => 'value'
		),
		'type'    => array(
			'type' => 'value'
		),
	);
	public $order = array( 'Request.created' => 'DESC' );
	public $validate = array(
		'subject' => array(
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
		'text'    => array(
			'notEmpty' => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
		),
		'status'  => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'type'    => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'user_id' => array(
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
		'User' => array(
			'className'  => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public static function statuses( $value = null ) {
		$options = array(
			self::STATUS_CLOSED => __( 'Closed', true ),
			self::STATUS_OPEN   => __( 'Open', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_FEEDBACK => __( 'Feedback', true ),
			self::TYPE_SUPPORT  => __( 'Support', true ),
		);

		return parent::enum( $value, $options );
	}

}
