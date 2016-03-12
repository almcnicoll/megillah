<?php
App::uses( 'AppModel', 'Model' );

/**
 * Organisation Model
 *
 * @property Country      $Country
 * @property Centre       $Centre
 * @property CreditorNote $CreditorNote
 * @property Creditor     $Creditor
 * @property Template     $Template
 */
class Organisation extends AppModel {

	public $actsAs = array( 'Loggable', 'Search.Searchable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Organisation.name',
				'Organisation.code',
				'Organisation.address_line_1',
				'Organisation.address_line_2',
				'Organisation.address_line_3',
				'Organisation.city',
				'Organisation.county',
				'Organisation.postcode'
			)
		),
	);

	public $order = array( 'Organisation.name' => 'ASC' );

	public $validate = array(
		'name'           => array(
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
			'isUnique'  => array(
				'rule'    => array( 'isUnique' ),
				'message' => 'Organisation name already taken. Please choose another.',
				'last'    => true,
			),
		),
		'code'           => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
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
		'email'          => array(
			'notEmpty'  => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
			'email'     => array(
				'rule'    => array( 'email' ),
				'message' => 'Please enter a valid email address',
				'last'    => true,
			),
			'maxLength' => array(
				'rule'    => array( 'maxLength', 254 ),
				'message' => 'This field cannot be longer than 254 characters',
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
		'Country' => array(
			'className'  => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'Centre'       => array(
			'className'  => 'Centre',
			'foreignKey' => 'organisation_id',
			'dependent'  => false,
			'conditions' => array(
				'Centre.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'CreditorNote' => array(
			'className'  => 'CreditorNote',
			'foreignKey' => 'organisation_id',
			'dependent'  => false,
			'conditions' => array(
				'CreditorNote.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Creditor'     => array(
			'className'  => 'Creditor',
			'foreignKey' => 'organisation_id',
			'dependent'  => false,
			'conditions' => array(
				'Creditor.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Template'     => array(
			'className'  => 'Template',
			'foreignKey' => 'organisation_id',
			'dependent'  => false,
			'conditions' => array(
				'Template.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

	public function beforeFind( $query ) {
		$filter = array(
			'joins'      => array(),
			'conditions' => array(),
			'group'      => array(),
		);
		if ( Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
			$filter['joins']      = array(
				array(
					'alias'      => 'FilterCentre',
					'table'      => 'centres',
					'type'       => 'INNER',
					'conditions' => array(
						'FilterCentre.organisation_id = Organisation.id',
					),
				),
				array(
					'alias'      => 'FilterCentreMembership',
					'table'      => 'centres_users',
					'type'       => 'INNER',
					'conditions' => array(
						'FilterCentreMembership.centre_id = FilterCentre.id',
					),
				),
			);
			$filter['conditions'] = array(
				'FilterCentreMembership.user_id' => Auth::id(),
				'OR'                             => array(
					'FilterCentreMembership.expiry_date IS NULL',
					'FilterCentreMembership.expiry_date > NOW()',
				),
			);
			$filter['group']      = array(
				'Organisation.id',
			);
		}
		$query['joins']      = array_merge( $query['joins'], $filter['joins'] );
		$query['conditions'] = array_merge( $query['conditions'], $filter['conditions'] );
		if ( is_array( $query['group'] ) ) {
			$query['group'] = array_merge( $query['group'], $filter['group'] );
		} else {
			$query['group'] = $filter['group'];
		}

		return $query;
	}
}
