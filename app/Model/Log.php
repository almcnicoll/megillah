<?php
App::uses( 'AppModel', 'Model' );

/**
 * Log Model
 *
 * @property User $User
 */
class Log extends AppModel {

	public $order = array( 'Log.created' => 'DESC' );

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'User' => array(
			'className'  => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
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
					'alias'      => 'FilterCentreMembership',
					'table'      => 'centres_users',
					'type'       => 'LEFT',
					'conditions' => array(
						'FilterCentreMembership.user_id = Log.user_id',
					),
				),
				array(
					'alias'      => 'FilterCentre',
					'table'      => 'centres',
					'type'       => 'LEFT',
					'conditions' => array(
						'FilterCentre.id = FilterCentreMembership.centre_id',
					),
				),
				array(
					'alias'      => 'FilterCentre2',
					'table'      => 'centres',
					'type'       => 'LEFT',
					'conditions' => array(
						'FilterCentre2.organisation_id = FilterCentre.organisation_id',
					),
				),
				array(
					'alias'      => 'FilterCentreMembership2',
					'table'      => 'centres_users',
					'type'       => 'LEFT',
					'conditions' => array(
						'FilterCentreMembership2.centre_id = FilterCentre2.id',
					),
				),
			);
			$filter['conditions'] = array(
				'OR' => array(
					'Log.user_id' => Auth::id(),
					'AND'         => array(
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
				),
			);
			$filter['group']      = array(
				'Log.id',
			);
		} else {
			if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) ) {
				$filter['joins']      = array(
					array(
						'alias'      => 'FilterCentreMembership',
						'table'      => 'centres_users',
						'type'       => 'LEFT',
						'conditions' => array(
							'FilterCentreMembership.user_id = Log.user_id',
						),
					),
					array(
						'alias'      => 'FilterCentreMembership2',
						'table'      => 'centres_users',
						'type'       => 'LEFT',
						'conditions' => array(
							'FilterCentreMembership2.centre_id = FilterCentreMembership.centre_id',
						),
					),
				);
				$filter['conditions'] = array(
					'OR' => array(
						'Log.user_id' => Auth::id(),
						'AND'         => array(
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
					),
				);
				$filter['group']      = array(
					'Log.id',
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['conditions'] = array(
						'Log.user_id' => Auth::id(),
					);
				}
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
