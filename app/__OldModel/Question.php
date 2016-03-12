<?php
App::uses( 'AppModel', 'Model' );

/**
 * Question Model
 *
 * @property Answer $Answer
 */
class Question extends AppModel {

	const ROLE_CLIENT_CHECKLIST = 1;
	const ROLE_CLIENT_SURVEY = 2;
	const ROLE_CLIENT_SURVEY_ADVISER = 3;
	const TYPE_BOOLEAN = 1;
	const TYPE_CUSTOM = 2;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array( 'Question.role' => 'ASC', 'Question.rank' => 'ASC' );

	public $validate = array(
		'text'      => array(
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
		'type'      => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'role'      => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'rank'      => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule'    => array( 'boolean' ),
				'message' => 'Please select yes or no',
				'last'    => true,
			),
		),
	);

	public $hasMany = array(
		'ClientResponse' => array(
			'className'  => 'ClientResponse',
			'foreignKey' => 'question_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

	public static function roles( $value = null ) {
		$options = array(
			self::ROLE_CLIENT_CHECKLIST      => __( 'Client Checklist', true ),
			self::ROLE_CLIENT_SURVEY         => __( 'Client Survey', true ),
			self::ROLE_CLIENT_SURVEY_ADVISER => __( 'Client Survey - Adviser', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_BOOLEAN => __( 'Boolean', true ),
			self::TYPE_CUSTOM  => __( 'Custom', true ),
		);

		return parent::enum( $value, $options );
	}

}
