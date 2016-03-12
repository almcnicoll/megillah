<?php
App::uses( 'AppModel', 'Model' );

/**
 * Letter Model
 *
 * @property Client $Client
 */
class Letter extends AppModel {

	const STATUS_COMPLETE = 1;
	const STATUS_DEFAULT = 2;
	const TYPE_DEFAULT = 1;
	const TYPE_IMPORTANT = 2;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array( 'Letter.created' => 'DESC' );

	public $validate = array(
		'description' => array(
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
		'content'     => array(
			'notEmpty' => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
		),
		'date'     => array(
			'validateDate' => array(
				'rule'       => array( 'validateDate' ),
				'message'    => 'Please enter a valid date',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'time'     => array(
			'validateTime' => array(
				'rule'       => array( 'validateTime' ),
				'message'    => 'Please enter a valid time',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'status'   => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'type'     => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'client_id'   => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'debt_id'     => array(
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
		'Client' => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Debt'   => array(
			'className'  => 'Debt',
			'foreignKey' => 'debt_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public static function statuses( $value = null ) {
		$options = array(
			self::STATUS_COMPLETE => __( 'Complete', true ),
			self::STATUS_DEFAULT  => __( 'Default', true ),
		);

		return parent::enum( $value, $options );
	}

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_DEFAULT   => __( 'Default', true ),
			self::TYPE_IMPORTANT => __( 'Important', true ),
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
							'FilterClient.id = Letter.client_id',
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
						'OR'                             => array(
							'FilterCentreMembership.expiry_date IS NULL',
							'FilterCentreMembership.expiry_date > NOW()',
						),
					),
				);
				$filter['group']      = array(
					'Letter.id',
				);
			} else {
				if ( Auth::hasRole( Configure::read( 'Role.supervisor' ) ) || Auth::hasRole( Configure::read( 'Role.user' ) ) ) {
					$filter['joins']      = array(
						array(
							'alias'      => 'FilterClient',
							'table'      => 'clients',
							'type'       => 'INNER',
							'conditions' => array(
								'FilterClient.id = Letter.client_id',
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
							'OR'                             => array(
								'FilterCentreMembership.expiry_date IS NULL',
								'FilterCentreMembership.expiry_date > NOW()',
							),
						),
					);
					$filter['group']      = array(
						'Letter.id',
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

	public function mergeContent( $template, $client, $debt = null ) {
		$mergeFields    = ClassRegistry::init( 'MergeField' )->find( 'all', array(
			'joins'      => array(
				array(
					'alias'      => 'MergeFieldTemplateType',
					'table'      => 'merge_fields_template_types',
					'type'       => 'INNER',
					'conditions' => array(
						'MergeFieldTemplateType.merge_field_id = MergeField.id',
					),
				),
			),
			'conditions' => array(
				'MergeFieldTemplateType.template_type_id' => $template['Template']['template_type_id'],
			),
		) );
		$matches        = array();
		$decodedContent = html_entity_decode( $template['Template']['content'], ENT_COMPAT );
		preg_match_all( '/¦(.*?)¦/s', $decodedContent, $matches );
		$patterns     = array();
		$replacements = array();
		
		foreach ( $mergeFields as $mergeField ) {
			foreach ( $matches[1] as $key => $match ) {
				if ( $match === $mergeField['MergeField']['code'] ) {
					$patterns[] = '/¦' . $match . '¦/';
					// Populate the replacements array.
					switch ( $match ) {
						case 'OrganisationName':
							$use_centre_address = false;
							if ( ! empty( $client['Centre']['Organisation']['use_centre_address'] ) ) {
								$use_centre_address = ($client['Centre']['Organisation']['use_centre_address'] == 1);
							}
							if ($use_centre_address) {
								$replacements[] = $client['Centre']['name'];
							} else {
								$replacements[] = $client['Centre']['Organisation']['name'];
							}
							break;
						case 'OrganisationAddressBlock':
							$address = '';
							$use_centre_address = false;
							if ( ! empty( $client['Centre']['Organisation']['use_centre_address'] ) ) {
								$use_centre_address = ($client['Centre']['Organisation']['use_centre_address'] == 1);
							}
							/*var_dump($use_centre_address);
							die();*/
							//$this->log('error', "Use centre address: {$use_centre_address}");
							if ($use_centre_address) {
								if ( ! empty( $client['Centre']['address_line_1'] ) ) {
									$address .= $client['Centre']['address_line_1'] . '<br />';
								}
								if ( ! empty( $client['Centre']['address_line_2'] ) ) {
									$address .= $client['Centre']['address_line_2'] . '<br />';
								}
								if ( ! empty( $client['Centre']['address_line_3'] ) ) {
									$address .= $client['Centre']['address_line_3'] . '<br />';
								}
								if ( ! empty( $client['Centre']['city'] ) ) {
									$address .= $client['Centre']['city'] . '<br />';
								}
								if ( ! empty( $client['Centre']['county'] ) ) {
									$address .= $client['Centre']['county'] . '<br />';
								}
								$address .= $client['Centre']['postcode'];
							} else {
								if ( ! empty( $client['Centre']['Organisation']['address_line_1'] ) ) {
									$address .= $client['Centre']['Organisation']['address_line_1'] . '<br />';
								}
								if ( ! empty( $client['Centre']['Organisation']['address_line_2'] ) ) {
									$address .= $client['Centre']['Organisation']['address_line_2'] . '<br />';
								}
								if ( ! empty( $client['Centre']['Organisation']['address_line_3'] ) ) {
									$address .= $client['Centre']['Organisation']['address_line_3'] . '<br />';
								}
								if ( ! empty( $client['Centre']['Organisation']['city'] ) ) {
									$address .= $client['Centre']['Organisation']['city'] . '<br />';
								}
								if ( ! empty( $client['Centre']['Organisation']['county'] ) ) {
									$address .= $client['Centre']['Organisation']['county'] . '<br />';
								}
								$address .= $client['Centre']['Organisation']['postcode'];
							}
							$replacements[] = $address;
							break;
						case 'CurrentDate':
							$replacements[] = date( 'l, jS F Y' );
							break;
						case 'CreditorName':
							$replacements[] = $debt['Creditor']['name'];
							break;
						case 'CreditorAddressBlock':
							$address = '';
							if ( ! empty( $debt['Creditor']['address_line_1'] ) ) {
								$address .= $debt['Creditor']['address_line_1'] . '<br />';
							}
							if ( ! empty( $debt['Creditor']['address_line_2'] ) ) {
								$address .= $debt['Creditor']['address_line_2'] . '<br />';
							}
							if ( ! empty( $debt['Creditor']['address_line_3'] ) ) {
								$address .= $debt['Creditor']['address_line_3'] . '<br />';
							}
							if ( ! empty( $debt['Creditor']['city'] ) ) {
								$address .= $debt['Creditor']['city'] . '<br />';
							}
							if ( ! empty( $debt['Creditor']['county'] ) ) {
								$address .= $debt['Creditor']['county'] . '<br />';
							}
							$address .= $debt['Creditor']['postcode'];
							$replacements[] = $address;
							break;
						case 'AccountNumber':
							$replacements[] = $debt['Debt']['account_code'];
							break;
						case 'Reference':
							if ( ! empty( $debt['Debt']['reference'] ) ) {
								$replacements[] = $debt['Debt']['reference'];
							} else {
								$replacements[] = $client['Client']['code'];
							}
							break;
						case 'ClientName':
							$replacements[] = $client['PrimaryPerson']['full_name'];
							break;
						case 'AdviserName':
							$replacements[] = Auth::user( 'full_name' );
							break;
						case 'ClientAddressBlock':
							$address = '';
							if ( ! empty( $client['Client']['address_line_1'] ) ) {
								$address .= $client['Client']['address_line_1'] . '<br />';
							}
							if ( ! empty( $client['Client']['address_line_2'] ) ) {
								$address .= $client['Client']['address_line_2'] . '<br />';
							}
							if ( ! empty( $client['Client']['address_line_3'] ) ) {
								$address .= $client['Client']['address_line_3'] . '<br />';
							}
							if ( ! empty( $client['Client']['city'] ) ) {
								$address .= $client['Client']['city'] . '<br />';
							}
							if ( ! empty( $client['Client']['county'] ) ) {
								$address .= $client['Client']['county'] . '<br />';
							}
							$address .= $client['Client']['postcode'];
							$replacements[] = $address;
							break;
						case 'ClientCode':
							$replacements[] = $client['Client']['code'];
							break;
					}
					unset( $matches[1][ $key ] );
				}
			}
		}
		if ( ! empty( $matches[1] ) ) {
			// ERROR - Use of undefined merge fields.
			Debugger::log(__('ERROR - Use of undefined merge fields. User ID: %s.', Auth::id()));
			Debugger::log( $matches[1] );
		}
		$result = preg_replace( $patterns, $replacements, $decodedContent );

		return $result;
	}
}
