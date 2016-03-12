<?php
App::uses( 'AppModel', 'Model' );

/**
 * Template Model
 *
 * @property Organisation $Organisation
 * @property Template     $ParentTemplate
 * @property Template     $ChildTemplate
 */
class Template extends AppModel {

	public $actsAs = array(
		'Loggable',
		'Search.Searchable',
		'Tools.SoftDelete',
		'Tools.WhoDidIt',
		'Tree',
	);

	public $filterArgs = array(
		'search' => array(
			'type'   => 'like',
			'encode' => true,
			'field'  => array(
				'Template.name',
				'Template.code',
				'Organisation.name'
			)
		),
	);

	public $order = array( 'Template.code' => 'ASC' );

	public $validate = array(
		'name'             => array(
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
		'code'             => array(
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
		'content'          => array(
			'notEmpty' => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
		),
		'reminder_delay'  => array(
			'naturalNumber' => array(
				'rule'       => array( 'naturalNumber' ),
				'message'    => 'Please enter a valid number',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'organisation_id'  => array(
			'naturalNumber' => array(
				'rule'       => array( 'naturalNumber' ),
				'message'    => 'Please enter a valid number',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'template_type_id' => array(
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
		'Organisation'   => array(
			'className'  => 'Organisation',
			'foreignKey' => 'organisation_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'ParentTemplate' => array(
			'className'  => 'Template',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'TemplateType'   => array(
			'className'  => 'TemplateType',
			'foreignKey' => 'template_type_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'ChildTemplate' => array(
			'className'  => 'Template',
			'foreignKey' => 'parent_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

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
						'FilterCentre.organisation_id = Template.organisation_id',
						'Template.organisation_id IS NULL',
					),
				),
			),
			array(
				'alias'      => 'FilterTemplate',
				'table'      => 'templates',
				'type'       => 'LEFT',
				'conditions' => array(
					'FilterTemplate.parent_id = Template.id',
					'FilterTemplate.organisation_id = FilterCentre.organisation_id',
					'FilterTemplate.is_archived' => 0,
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
				'FilterTemplate.id IS NULL',
				'FilterCentreMembership.user_id' => Auth::id(),
				array(
					'OR' => array(
						'FilterCentreMembership.expiry_date IS NULL',
						'FilterCentreMembership.expiry_date > NOW()',
					)
				),
				array(
					'OR' => array(
						'Template.organisation_id IS NULL',
						'AND' => array(
							'FilterCentre.is_archived'  => '0',
							'FilterCentre2.is_archived' => '0',
						),
					)
				)
			);
		}
		$filter['group']     = array(
			'Template.id',
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
