<?php
App::uses( 'AppModel', 'Model' );

/**
 * Debt Model
 *
 * @property Client       $Client
 * @property Creditor     $Creditor
 * @property DebtCategory $DebtCategory
 * @property Debt         $ParentDebt
 * @property DebtNote     $DebtNote
 * @property Debt         $ChildDebt
 */
class Debt extends AppModel {

	const FREQUENCY_WEEKLY = 1;
	const FREQUENCY_TWO_WEEKLY = 2;
	const FREQUENCY_FOUR_WEEKLY = 3;
	const FREQUENCY_MONTHLY = 4;
	const FREQUENCY_QUARTERLY = 5;
	const FREQUENCY_ANNUALLY = 6;
	const STATUS_COMPLETE = 1;
	const STATUS_OUTSTANDING = 2;
	const STATUS_SUSPENDED = 3;
	public $actsAs = array(
		'Loggable',
		'Search.Searchable',
		'Tools.SoftDelete',
		'Tools.WhoDidIt',
		'Tree',
	);
	public $filterArgs = array(
		'creditor_id'      => array(
			'type'       => 'lookup',
			'formField'  => 'creditor_input',
			'modelField' => 'name',
			'model'      => 'Creditor'
		),
		'debt_category_id' => array(
			'type'       => 'lookup',
			'formField'  => 'debt_category_input',
			'modelField' => 'name',
			'model'      => 'DebtCategory'
		),
	);
	public $order = array( 'Debt.is_priority' => 'DESC', 'Debt.created' => 'ASC', 'Debt.id' => 'ASC' );
	public $virtualFields = array(
		'monthly_offer' => 'IF(Debt.offer_frequency = 1, (Debt.offer * 52) / 12, IF(Debt.offer_frequency = 2, (Debt.offer * 26) / 12, IF(Debt.offer_frequency = 3, (Debt.offer * 13) / 12, IF(Debt.offer_frequency = 4, Debt.offer, IF(Debt.offer_frequency = 5, Debt.offer / 3, Debt.offer / 12)))))',
		'description'   => 0,
	);
	public $validate = array(
		'amount'           => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'account_code'     => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'reference'        => array(
			'maxLength' => array(
				'rule'       => array( 'maxLength', 254 ),
				'message'    => 'This field cannot be longer than 254 characters',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'offer'            => array(
			'numeric' => array(
				'rule'       => array( 'numeric' ),
				'message'    => 'valErrMandatoryField',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'is_judgment'      => array(
			'boolean' => array(
				'rule'    => array( 'boolean' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'is_pro_rata'      => array(
			'boolean' => array(
				'rule'    => array( 'boolean' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'is_priority'      => array(
			'boolean' => array(
				'rule'    => array( 'boolean' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'offer_frequency'  => array(
			'validateEnum' => array(
				'rule'       => array( 'validateEnum', 'frequencies' ),
				'message'    => 'valErrMandatoryField',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'status'           => array(
			'validateEnum' => array(
				'rule'       => array( 'validateEnum', true ),
				'message'    => 'Please select a value from the list',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'client_id'        => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'creditor_id'      => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'debt_category_id' => array(
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
		'Client'       => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Creditor'     => array(
			'className'  => 'Creditor',
			'foreignKey' => 'creditor_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'DebtCategory' => array(
			'className'  => 'DebtCategory',
			'foreignKey' => 'debt_category_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'ParentDebt'   => array(
			'className'  => 'Debt',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);
	public $hasMany = array(
		'DebtNote'  => array(
			'className'  => 'DebtNote',
			'foreignKey' => 'debt_id',
			'dependent'  => false,
			'conditions' => array(
				'DebtNote.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => array(
				'DebtNote.created' => 'DESC',
			),
		),
		'ChildDebt' => array(
			'className'  => 'Debt',
			'foreignKey' => 'parent_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

	public static function frequencies( $value = null ) {
		$options = array(
			self::FREQUENCY_WEEKLY      => __( 'Weekly', true ),
			self::FREQUENCY_TWO_WEEKLY  => __( 'Two-Weekly', true ),
			self::FREQUENCY_FOUR_WEEKLY => __( 'Four-Weekly', true ),
			self::FREQUENCY_MONTHLY     => __( 'Monthly', true ),
			self::FREQUENCY_QUARTERLY   => __( 'Quarterly', true ),
			self::FREQUENCY_ANNUALLY    => __( 'Annually', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function statuses( $value = null ) {
		$options = array(
			self::STATUS_COMPLETE    => __( 'Complete', true ),
			self::STATUS_OUTSTANDING => __( 'Outstanding', true ),
			self::STATUS_SUSPENDED   => __( 'Suspended', true ),
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
						'alias'      => 'FilterClient',
						'table'      => 'clients',
						'type'       => 'INNER',
						'conditions' => array(
							'FilterClient.id = Debt.client_id',
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
					'Debt.id',
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['joins']      = array(
						array(
							'alias'      => 'FilterClient',
							'table'      => 'clients',
							'type'       => 'INNER',
							'conditions' => array(
								'FilterClient.id = Debt.client_id',
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
						'Debt.id',
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
