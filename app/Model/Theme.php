<?php
App::uses( 'AppModel', 'Model' );

/**
 * Theme Model
 *
 * @property User $User
 */
class Theme extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array( 'Theme.name' => 'ASC' );

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
		'User' => array(
			'className'  => 'User',
			'foreignKey' => 'theme_id',
			'dependent'  => false,
			'conditions' => array(
				'User.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

}
