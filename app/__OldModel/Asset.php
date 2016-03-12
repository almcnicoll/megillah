<?php
App::uses( 'AppModel', 'Model' );

/**
 * Asset Model
 *
 * @property Creditor  $Creditor
 * @property Client    $Client
 * @property AssetNote $AssetNote
 */
class Asset extends AppModel {

	public $actsAs = array( 'Loggable', 'Search.Searchable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Asset.name'
			)
		),
	);

	public $order = array( 'Asset.value' => 'DESC' );

	public $validate = array(
		'name'               => array(
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
		'value'              => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'This value must be a number',
				'last'    => true,
			),
		),
		'outstanding_amount' => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'This value must be a number',
				'last'    => true,
			),
		),
		'creditor_id'        => array(
			'naturalNumber' => array(
				'rule'       => array( 'naturalNumber' ),
				'message'    => 'This value must be a number',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'client_id'          => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'This value must be a number',
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
		'Creditor' => array(
			'className'  => 'Creditor',
			'foreignKey' => 'creditor_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Client'   => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'AssetNote' => array(
			'className'  => 'AssetNote',
			'foreignKey' => 'asset_id',
			'dependent'  => false,
			'conditions' => array(
				'AssetNote.is_archived' => 0,
			),
			'fields'     => '',
			'order'      => array(
				'AssetNote.created' => 'DESC',
			),
		)
	);

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
							'FilterClient.id = Asset.client_id',
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
					'Asset.id',
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['joins']      = array(
						array(
							'alias'      => 'FilterClient',
							'table'      => 'clients',
							'type'       => 'INNER',
							'conditions' => array(
								'FilterClient.id = Asset.client_id',
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
						'Asset.id',
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
