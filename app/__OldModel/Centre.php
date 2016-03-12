<?php
App::uses( 'AppModel', 'Model' );

/**
 * Centre Model
 *
 * @property Country          $Country
 * @property Organisation     $Organisation
 * @property Client           $Client
 * @property CentreMembership $CentreMembership
 */
class Centre extends AppModel {

	public $actsAs = array(
		'Loggable',
		'Search.Searchable',
		'Tools.SoftDelete',
		'Tools.WhoDidIt',
		'Upload.Upload' => array(
			'header' => array(
				'fields' => array(
					'dir' => 'header_dir'
				)
			)
		)
	);

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Centre.name',
				'Centre.code',
				'Centre.address_line_1',
				'Centre.address_line_2',
				'Centre.address_line_3',
				'Centre.city',
				'Centre.county',
				'Centre.postcode'
			)
		),
	);

	public $order = array( 'Centre.name' => 'ASC' );

	public $validate = array(
		'name'            => array(
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
		'code'            => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'address_line_1'  => array(
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
		'address_line_2'  => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'address_line_3'  => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'city'            => array(
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
		'county'          => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'postcode'        => array(
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
		'email'           => array(
			'email'     => array(
				'rule'       => array( 'email' ),
				'message'    => 'Please enter a valid email address',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'header'          => array(
			'isBelowMaxSize'    => array(
				'rule'    => array( 'isBelowMaxSize', 1000000, false ),
				'message' => 'valErrMandatoryField1',
			),
			'isValidExtension'  => array(
				'rule'    => array( 'isValidExtension', array( 'jpg', 'jpeg', 'png' ), false ),
				'message' => 'valErrMandatoryField2',
			),
			'isValidMimeType'   => array(
				'rule'    => array( 'isValidMimeType', array( 'image/png', 'image/jpeg' ), false ),
				'message' => 'valErrMandatoryField2',
			),/*
			'isAboveMinHeight'  => array(
				'rule'    => array( 'isAboveMinHeight', 125, false ),
				'message' => 'valErrMandatoryField3',
			),
			'isBelowMaxHeight'  => array(
				'rule'    => array( 'isBelowMaxHeight', 125, false ),
				'message' => 'valErrMandatoryField4',
			),
			'isAboveMinWidth'   => array(
				'rule'    => array( 'isAboveMinWidth', 800, false ),
				'message' => 'valErrMandatoryField5',
			),
			'isBelowMaxWidth'   => array(
				'rule'    => array( 'isBelowMaxWidth', 800, false ),
				'message' => 'valErrMandatoryField6',
			),*/
			'isCompletedUpload' => array(
				'rule'    => array( 'isCompletedUpload' ),
				'message' => 'valErrMandatoryField7',
			),
			'isFileUpload'      => array(
				'rule'    => array( 'isFileUpload' ),
				'message' => 'valErrMandatoryField8',
			),
			'isSuccessfulWrite' => array(
				'rule'    => array( 'isSuccessfulWrite', false ),
				'message' => 'valErrMandatoryField9',
			),
		),
		'country_id'      => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'organisation_id' => array(
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
		'Country'      => array(
			'className'  => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Organisation' => array(
			'className'  => 'Organisation',
			'foreignKey' => 'organisation_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'CentreMembership' => array(
			'className'  => 'CentreMembership',
			'foreignKey' => 'centre_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		),
		'Client'           => array(
			'className'  => 'Client',
			'foreignKey' => 'centre_id',
			'dependent'  => false,
			'conditions' => array(
				'Client.is_archived' => 0,
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
		if ( Auth::hasRole( Configure::read( 'Role.manager' ) ) ) {
			$filter['joins']      = array(
				array(
					'alias'      => 'FilterCentre',
					'table'      => 'centres',
					'type'       => 'INNER',
					'conditions' => array(
						'FilterCentre.organisation_id = Centre.organisation_id',
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
				'Centre.id',
			);
		} else {
			if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
				$filter['joins']      = array(
					array(
						'alias'      => 'FilterCentreMembership',
						'table'      => 'centres_users',
						'type'       => 'INNER',
						'conditions' => array(
							'FilterCentreMembership.centre_id = Centre.id',
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
					'Centre.id',
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

		return $query;
	}
}
