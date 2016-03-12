<?php
App::uses( 'AppModel', 'Model' );

/**
 * Country Model
 *
 * @property Currency      $Currency
 * @property Centre        $Centre
 * @property Client        $Client
 * @property Creditor      $Creditor
 * @property Organisation  $Organisation
 * @property TriggerFigure $TriggerFigure
 */
class Country extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array( 'Country.name' => 'ASC' );

	public $validate = array(
		'name'        => array(
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
		'code'        => array(
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
		'currency_id' => array(
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
		'Currency' => array(
			'className'  => 'Currency',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'Centre'        => array(
			'className'  => 'Centre',
			'foreignKey' => 'country_id',
			'dependent'  => false,
			'conditions' => array(
				'Centre.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Client'        => array(
			'className'  => 'Client',
			'foreignKey' => 'country_id',
			'dependent'  => false,
			'conditions' => array(
				'Client.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Creditor'      => array(
			'className'  => 'Creditor',
			'foreignKey' => 'country_id',
			'dependent'  => false,
			'conditions' => array(
				'Creditor.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Organisation'  => array(
			'className'  => 'Organisation',
			'foreignKey' => 'country_id',
			'dependent'  => false,
			'conditions' => array(
				'Organisation.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'TriggerFigure' => array(
			'className'  => 'TriggerFigure',
			'foreignKey' => 'country_id',
			'dependent'  => false,
			'conditions' => array(
				'TriggerFigure.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

}
