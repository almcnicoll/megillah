<?php
App::uses( 'AppModel', 'Model' );

/**
 * Currency Model
 *
 * @property Country $Country
 */
class Currency extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array( 'Currency.name' => 'ASC' );

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
		'Country' => array(
			'className'  => 'Country',
			'foreignKey' => 'currency_id',
			'dependent'  => false,
			'conditions' => array(
				'Country.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

}
