<?php
App::uses( 'AppModel', 'Model' );
App::uses( 'Person', 'Model' );

/**
 * Client Model
 *
 * @property Centre     $Centre
 * @property Country    $Country
 * @property Asset      $Asset
 * @property ClientNote $ClientNote
 * @property Debt       $Debt
 * @property Expense    $Expense
 * @property Income     $Income
 * @property Letter     $Letter
 * @property Person     $Person
 * @property Answer     $Answer
 * @property User       $User
 */
class Client extends AppModel {

	const STATUS_OPEN = 1;
	const STATUS_CLOSED = 2;

	public $actsAs = array( 'Loggable', 'Search.Searchable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $displayField = 'code';

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Client.code',
				'Client.address_line_1',
				'Client.address_line_2',
				'Client.address_line_3',
				'Client.city',
				'Client.county',
				'Client.postcode',
				'PrimaryPerson.forename',
				'PrimaryPerson.middle_names',
				'PrimaryPerson.surname'
			)
		),
		'status' => array(
			'type' => 'value'
		),
	);

	public $order = array( 'Client.code' => 'ASC' );

	public $validate = array(
		'code'           => array(
			'notEmpty'       => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
			'maxLength'      => array(
				'rule'    => array( 'maxLength', 254 ),
				'message' => 'This field cannot be longer than 254 characters',
				'last'    => true,
			),
			'validateUnique' => array(
				'rule'    => array( 'validateUnique', array( 'centre_id' ) ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'address_line_1' => array(
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
		'address_line_2' => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'address_line_3' => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'city'           => array(
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
		'county'         => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'postcode'       => array(
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
		'number_of_cars' => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber', true ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'status'         => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'centre_id'      => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'country_id'     => array(
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
		'Centre'  => array(
			'className'  => 'Centre',
			'foreignKey' => 'centre_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Country' => array(
			'className'  => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasOne = array(
		'PrimaryPerson' => array(
			'className'  => 'Person',
			'foreignKey' => 'client_id',
			'conditions' => array(
				'PrimaryPerson.is_archived' => 0,
				'PrimaryPerson.role'        => Person::ROLE_CLIENT
			),
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'Action'           => array(
			'className'  => 'Action',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		),
		'Asset'            => array(
			'className'  => 'Asset',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'Asset.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'ClientCounsellor' => array(
			'className'  => 'ClientCounsellor',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		),
		'ClientNote'       => array(
			'className'  => 'ClientNote',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'ClientNote.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => array(
				'ClientNote.created' => 'DESC',
			),
		),
		'ClientResponse'   => array(
			'className'  => 'ClientResponse',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		),
		'Debt'             => array(
			'className'  => 'Debt',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'Debt.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Expense'          => array(
			'className'  => 'Expense',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'Expense.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Income'           => array(
			'className'  => 'Income',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'Income.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Letter'           => array(
			'className'  => 'Letter',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'Letter.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Person'           => array(
			'className'  => 'Person',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => array(
				'Person.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Reminder'         => array(
			'className'  => 'Reminder',
			'foreignKey' => 'client_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

	public static function statuses( $value = null ) {
		$options = array(
			self::STATUS_OPEN   => __( 'Open', true ),
			self::STATUS_CLOSED => __( 'Closed', true ),
		);

		return parent::enum( $value, $options );
	}

	public function beforeFind( $query ) {
		if ( Auth::id() ) {
			$filter = array(
				'joins'      => array(),
				'conditions' => array(),
				'group'      => array(),
			);
			if ( Auth::hasRole( Configure::read( 'Role.super' ) ) || Auth::hasRole( Configure::read( 'Role.administrator' ) ) || Auth::hasRole( Configure::read( 'Role.manager' ) ) ) {
				$filter['joins']      = array(
					array(
						'alias'      => 'FilterCentre',
						'table'      => 'centres',
						'type'       => 'INNER',
						'conditions' => array(
							'FilterCentre.id = Client.centre_id',
						),
					),
					array(
						'alias'      => 'FilterCentre2',
						'table'      => 'centres',
						'type'       => 'INNER',
						'conditions' => array(
							'FilterCentre2.organisation_id = FilterCentre.organisation_id',
						),
					),
					array(
						'alias'      => 'FilterCentreMembership',
						'table'      => 'centres_users',
						'type'       => 'LEFT',
						'conditions' => array(
							'FilterCentreMembership.centre_id = FilterCentre2.id',
						),
					),
				);
				$filter['conditions'] = array(
					'AND' => array(
						'FilterCentreMembership.user_id' => Auth::id(),
						'FilterCentre.is_archived'       => '0',
						'FilterCentre2.is_archived'      => '0',
						'OR'                             => array(
							'FilterCentreMembership.expiry_date IS NULL',
							'FilterCentreMembership.expiry_date > NOW()',
						),
					),
				);
				$filter['group']      = array(
					'Client.id',
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['joins']      = array(
						array(
							'alias'      => 'FilterCentre',
							'table'      => 'centres',
							'type'       => 'INNER',
							'conditions' => array(
								'FilterCentre.id = Client.centre_id',
							),
						),
						array(
							'alias'      => 'FilterCentreMembership',
							'table'      => 'centres_users',
							'type'       => 'LEFT',
							'conditions' => array(
								'FilterCentreMembership.centre_id = FilterCentre.id',
							),
						),
					);
					$filter['conditions'] = array(
						'AND' => array(
							'FilterCentreMembership.user_id' => Auth::id(),
							'FilterCentre.is_archived'       => '0',
							'OR'                             => array(
								'FilterCentreMembership.expiry_date IS NULL',
								'FilterCentreMembership.expiry_date > NOW()',
							),
						),
					);
					$filter['group']      = array(
						'Client.id',
					);
				}
			}
			$query['joins']      = array_merge( $query['joins'], $filter['joins'] );
			$query['conditions'] = array_merge( $query['conditions'], $filter['conditions'] );
			if ( is_array( $query['group'] ) ) {
				$query['group'] = array_merge( $query['group'], $filter['group'] );
			} else {
				$query['group'] = $filter['group'];
			}
		}

		return $query;
	}
}
