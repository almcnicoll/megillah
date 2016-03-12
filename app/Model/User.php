<?php
App::uses( 'AppModel', 'Model' );

/**
 * User Model
 *
 * @property Log    $Log
 */
class User extends AppModel {

	public $actsAs = array( 'Loggable', 'Search.Searchable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $displayField = 'full_name';

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'User.full_name',
				'User.username',
				'User.email'
			)
		),
	);

	public $order = array( 'User.full_name' => 'ASC' );

	public $validate = array(
		'username' => array(
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
				'message' => 'Username already taken - please try a different username',
				'last'    => true,
			),
		),
		'password' => array(
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
		'first_name' => array(
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
		'last_name'  => array(
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
		'email'    => array(
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
		'role_id'  => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'theme_id' => array(
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
		'Theme' => array(
			'className'  => 'Theme',
			'foreignKey' => 'theme_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'Log'              => array(
			'className'  => 'Log',
			'foreignKey' => 'user_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => array(
				'Log.created' => 'DESC',
			),
		),
		'Loan'              => array(
			'className'  => 'Loan',
			'foreignKey' => 'user_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => array(
				'Loan.due_date' => 'DESC',
			),
		),
	);

	public function __construct( $id = false, $table = null, $ds = null ) {
		parent::__construct( $id, $table, $ds );
		$this->virtualFields['full_name'] = sprintf( 'CONCAT(%s.first_name, \' \', %s.last_name)', $this->alias,
			$this->alias );
	}

	public function beforeFind( $query ) {
		if ( Auth::id() ) {
			$filter = array(
				'joins'      => array(),
				'conditions' => array(),
				'group'      => array(),
			);
			$filter['joins']      = array(
				/*array(
					'alias'      => 'FilterCentreMembership',
					'table'      => 'centres_users',
					'type'       => 'LEFT',
					'conditions' => array(
						'FilterCentreMembership.user_id = User.id',
					),
				),*/
			);
			if ( Auth::hasRole( Configure::read( 'Role.manager' ) ) ) {
				$filter['conditions'] = array(
					/*'OR' => array(
						'User.id' => Auth::id(),
						'AND'     => array(
							'FilterCentreMembership2.user_id' => Auth::id(),
							'OR'                              => array(
								'FilterCentreMembership.expiry_date IS NULL',
								'FilterCentreMembership.expiry_date > NOW()',
							),
							'AND'                             => array(
								'OR' => array(
									'FilterCentreMembership2.expiry_date IS NULL',
									'FilterCentreMembership2.expiry_date > NOW()',
								),
							),
						),
					),*/
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['conditions'] = array(
						/*'OR' => array(
							'User.id' => Auth::id(),
							'AND'     => array(
								'FilterCentreMembership2.user_id' => Auth::id(),
								'OR'                              => array(
									'FilterCentreMembership.expiry_date IS NULL',
									'FilterCentreMembership.expiry_date > NOW()',
								),
								'AND'                             => array(
									'OR' => array(
										'FilterCentreMembership2.expiry_date IS NULL',
										'FilterCentreMembership2.expiry_date > NOW()',
									),
								),
							),
						),*/
					);
				}
			}
			$filter['group']      = array(
				'User.id',
			);
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
