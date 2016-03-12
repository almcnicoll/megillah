<?php
App::uses( 'AppModel', 'Model' );

/**
 * Creditor Model
 *
 * @property Country      $Country
 * @property Organisation $Organisation
 * @property Creditor     $ParentCreditor
 * @property Asset        $Asset
 * @property CreditorNote $CreditorNote
 * @property Creditor     $ChildCreditor
 * @property Debt         $Debt
 */
class Creditor extends AppModel {

	public $actsAs = array(
		'Loggable',
		'Search.Searchable',
		'Tools.SoftDelete',
		'Tools.WhoDidIt',
		'Tree',
	);

	public $displayField = 'display';

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Creditor.name',
				'Creditor.city',
				'Organisation.name'
			)
		),
	);

	public $order = array( 'Creditor.name' => 'ASC' );

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
		'phone'           => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'mobile'          => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
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
		'website'         => array(
			'url' => array(
				'rule'       => array( 'url' ),
				'message'    => 'Please enter a valid web address',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
			'maxLength'   => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
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
				'rule'       => array( 'naturalNumber' ),
				'message'    => 'Please enter a valid number',
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
		'Country'        => array(
			'className'  => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Organisation'   => array(
			'className'  => 'Organisation',
			'foreignKey' => 'organisation_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'ParentCreditor' => array(
			'className'  => 'Creditor',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'Asset'         => array(
			'className'  => 'Asset',
			'foreignKey' => 'creditor_id',
			'dependent'  => false,
			'conditions' => array(
				'Asset.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'CreditorNote'  => array(
			'className'  => 'CreditorNote',
			'foreignKey' => 'creditor_id',
			'dependent'  => false,
			'conditions' => array(
				'CreditorNote.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => array(
				'CreditorNote.created' => 'DESC',
			),
		),
		'ChildCreditor' => array(
			'className'  => 'Creditor',
			'foreignKey' => 'parent_id',
			'dependent'  => false,
			'conditions' => array(
				'ChildCreditor.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		),
		'Debt'          => array(
			'className'  => 'Debt',
			'foreignKey' => 'creditor_id',
			'dependent'  => false,
			'conditions' => array(
				'Debt.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => '',
		)
	);

	public function __construct( $id = false, $table = null, $ds = null ) {
		parent::__construct( $id, $table, $ds );
		$this->virtualFields['display'] = sprintf( 'IFNULL(NULLIF(%s.display_name, ""), %s.name)', $this->alias, $this->alias );
	}

	public function beforeFind( $query ) {
		$filter          = array(
			'joins'      => array(),
			'conditions' => array(),
			'group'      => array(),
		);
		$filter['joins'] = array(
			array(
				'alias'      => 'FilterCentre',
				'table'      => 'centres',
				'type'       => 'INNER',
				'conditions' => array(
					'OR' => array(
						'FilterCentre.organisation_id = Creditor.organisation_id',
						'Creditor.organisation_id IS NULL',
					),
				),
			),
			array(
				'alias'      => 'FilterCreditor',
				'table'      => 'creditors',
				'type'       => 'LEFT',
				'conditions' => array(
					'FilterCreditor.parent_id = Creditor.id',
					'FilterCreditor.organisation_id = FilterCentre.organisation_id',
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
				'type'       => 'INNER',
				'conditions' => array(
					'FilterCentreMembership.centre_id = FilterCentre2.id',
				),
			),
		);
		if ( Auth::hasRole( Configure::read( 'Role.manager' ) ) || Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
			$filter['conditions'] = array(
				'FilterCreditor.id IS NULL',
				'FilterCentreMembership.user_id' => Auth::id(),
				array(
					'OR' => array(
						'FilterCentreMembership.expiry_date IS NULL',
						'FilterCentreMembership.expiry_date > NOW()',
					)
				),
				array(
					'OR' => array(
						'Creditor.organisation_id IS NULL',
						'AND' => array(
							'FilterCentre.is_archived'  => '0',
							'FilterCentre2.is_archived' => '0',
						),
					)
				)
			);
		}
		$filter['group']     = array(
			'Creditor.id',
		);
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
