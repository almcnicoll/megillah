<?php
App::uses( 'AppModel', 'Model' );

/**
 * CentreMembership Model
 *
 * @property Centre $Centre
 * @property User   $User
 */
class CentreMembership extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.WhoDidIt' );

	public $order = array();

	public $useTable = 'centres_users';

	public $validate = array(
		'centre_id'   => array(
			'naturalNumber'  => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
			'validateUnique' => array(
				'rule'    => array( 'validateUnique', array( 'user_id' ) ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'user_id'     => array(
			'naturalNumber'  => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
			'validateUnique' => array(
				'rule'    => array( 'validateUnique', array( 'centre_id' ) ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'is_primary'  => array(
			'boolean' => array(
				'rule'    => array( 'boolean' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'expiry_date' => array(
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
		'Centre' => array(
			'className'  => 'Centre',
			'foreignKey' => 'centre_id',
			'conditions' => array(
				'Centre.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => ''
		),
	);

}
