<?php
App::uses( 'AppModel', 'Model' );

/**
 * ClientCounsellor Model
 *
 * @property Client         $Client
 * @property User         $User
 */
class ClientCounsellor extends AppModel {

	public $actsAs = array(
		'Loggable',
		'Tools.WhoDidIt',
	);

	public $order = array();

	public $useTable = 'clients_users';

	public $validate = array(
		'client_id'   => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'user_id'     => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'last_viewed' => array(
			'validateDate' => array(
				'rule'       => array( 'validateDate' ),
				'message'    => 'Please enter a valid date',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
	);

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Client' => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'User'   => array(
			'className'  => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

}
