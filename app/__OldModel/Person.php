<?php
App::uses( 'AppModel', 'Model' );
App::uses( 'CakeTime', 'Utility' );

/**
 * Person Model
 *
 * @property Client     $Client
 * @property PersonNote $PersonNote
 */
class Person extends AppModel {

	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
	const ROLE_CLIENT = 1;
	const ROLE_PARTNER = 2;
	const ROLE_DEPENDANT = 3;
	const ROLE_ADDITIONAL_ADULT = 4;
	const TITLE_MR = 1;
	const TITLE_MRS = 2;
	const TITLE_MS = 3;
	const TITLE_MISS = 4;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array( 'Person.role' => 'ASC', 'Person.full_name' => 'ASC' );
	public $validate = array(
		'title'                     => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'forename'                  => array(
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
		'middle_names'              => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'surname'                   => array(
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
		'phone'                     => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'mobile'                    => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'email'                     => array(
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
		'date_of_birth'             => array(
			'validateDate' => array(
				'rule'    => array( 'validateDate' ),
				'message' => 'Please enter a valid date',
				'last'    => true,
			),
			'isAdult'      => array(
				'rule'    => array( 'isAdult', 'role' ),
				'message' => 'Additional Adults must be over 18',
				'last'    => true,
			),
		),
		'national_insurance_number' => array(
			'validateNationalInsurance' => array(
				'rule'       => array( 'validateNationalInsurance' ),
				'message'    => 'valErrMandatoryField1',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
			'maxLength'                 => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'valErrMandatoryField2',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'gender'                    => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'role'                      => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'client_id'                 => array(
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
		'Client' => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);
	public $hasMany = array(
		'PersonNote' => array(
			'className'  => 'PersonNote',
			'foreignKey' => 'person_id',
			'dependent'  => false,
			'conditions' => array(
				'PersonNote.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => array(
				'PersonNote.created' => 'DESC',
			),
		)
	);

	public function __construct( $id = false, $table = null, $ds = null ) {
		parent::__construct( $id, $table, $ds );
		$this->virtualFields['age']           = sprintf( 'TIMESTAMPDIFF(YEAR, %s.date_of_birth, CURDATE())', $this->alias,
			$this->alias );
		$this->virtualFields['full_name']     = sprintf( 'CONCAT(%s.forename, \' \', %s.surname)', $this->alias,
			$this->alias );
		$this->virtualFields['complete_name'] = sprintf( 'IF(%s.middle_names > \'\', CONCAT(%s.forename, \' \', %s.middle_names, \' \', %s.surname), CONCAT(%s.forename, \' \', %s.surname))', $this->alias,
			$this->alias, $this->alias, $this->alias, $this->alias, $this->alias );
	}

	public static function genders( $value = null ) {
		$options = array(
			self::GENDER_MALE   => __( 'Male', true ),
			self::GENDER_FEMALE => __( 'Female', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function roles( $value = null ) {
		$options = array(
			self::ROLE_CLIENT           => __( 'Client', true ),
			self::ROLE_PARTNER          => __( 'Partner', true ),
			self::ROLE_DEPENDANT        => __( 'Dependant', true ),
			self::ROLE_ADDITIONAL_ADULT => __( 'Additional Adult', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function titles( $value = null ) {
		$options = array(
			self::TITLE_MR   => __( 'Mr', true ),
			self::TITLE_MRS  => __( 'Mrs', true ),
			self::TITLE_MS   => __( 'Ms', true ),
			self::TITLE_MISS => __( 'Miss', true ),
		);

		return parent::enum( $value, $options );
	}

	public function isAdult( $check, $role ) {
		$result = false;
		if ( (int) $this->data['Person'][ $role ] === self::ROLE_ADDITIONAL_ADULT ) { // An 'Additional Adult' must be 18 years old or over.
			if ( strtotime( CakeTime::format( $check['date_of_birth'], '%Y-%m-%d' ) ) <= strtotime( '-18 years' ) ) {
				$result = true;
			}/* else {
				die(CakeTime::format( $check['date_of_birth'], '%Y-%m-%d' ));
			}*/
		} else {
			$result = true;
		}

		return $result;
	}

	public function afterSave( $created, $options = array() ) {
		// Ensure that only one person per client can be the primary person.
		$data = $this->find( 'first', array( 'conditions' => array( 'Person.id' => $this->data['Person']['id'] ) ) );
		if ( ! empty( $data ) ) {
			if ( (int) $this->data['Person']['role'] === self::ROLE_CLIENT ) {
				$this->updateAll( array( 'Person.role' => self::ROLE_ADDITIONAL_ADULT ), array(
					'Person.id <>'     => $data['Person']['id'],
					'Person.client_id' => $data['Person']['client_id'],
					'Person.role'      => self::ROLE_CLIENT
				) );
			}
		}
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
						'alias'      => 'FilterClient',
						'table'      => 'clients',
						'type'       => 'INNER',
						'conditions' => array(
							'FilterClient.id = Person.client_id',
						),
					),
					array(
						'alias'      => 'FilterCentre',
						'table'      => 'centres',
						'type'       => 'INNER',
						'conditions' => array(
							'FilterCentre.id = FilterClient.centre_id',
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
						'FilterClient.is_archived'       => '0',
						'FilterCentre.is_archived'       => '0',
						'FilterCentre2.is_archived'      => '0',
						'OR'                             => array(
							'FilterCentreMembership.expiry_date IS NULL',
							'FilterCentreMembership.expiry_date > NOW()',
						),
					),
				);
				$filter['group']      = array(
					'Person.id',
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['joins']      = array(
						array(
							'alias'      => 'FilterClient',
							'table'      => 'clients',
							'type'       => 'INNER',
							'conditions' => array(
								'FilterClient.id = Person.client_id',
							),
						),
						array(
							'alias'      => 'FilterCentre',
							'table'      => 'centres',
							'type'       => 'INNER',
							'conditions' => array(
								'FilterCentre.id = FilterClient.centre_id',
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
							'FilterClient.is_archived'       => '0',
							'FilterCentre.is_archived'       => '0',
							'OR'                             => array(
								'FilterCentreMembership.expiry_date IS NULL',
								'FilterCentreMembership.expiry_date > NOW()',
							),
						),
					);
					$filter['group']      = array(
						'Person.id',
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

	public function validateNationalInsurance( $check ) {
		$value = array_values( $check );
		$value = $value[0];

		return preg_match( '/^\s*[a-zA-Z]{2}(?:\s*\d\s*){6}[a-zA-Z]?\s*$/i', $value );
	}
}
