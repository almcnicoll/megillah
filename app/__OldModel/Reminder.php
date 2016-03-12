<?php
App::uses( 'AppModel', 'Model' );

/**
 * Reminder Model
 */
class Reminder extends AppModel {

	const MODEL_ASSET_NOTE = 1;
	const MODEL_CLIENT_NOTE = 2;
	const MODEL_CREDITOR_NOTE = 3;
	const MODEL_DEBT_NOTE = 4;
	const MODEL_PERSON_NOTE = 5;
	const MODEL_NOTE = 6;
	const MODEL_LETTER = 7;
	const STATUS_COMPLETE = 1;
	const STATUS_DEFAULT = 2;
	const TYPE_DEFAULT = 1;
	const TYPE_IMPORTANT = 2;
	public $actsAs = array( 'Search.Searchable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $filterArgs = array(
		'client_id' => array(
			'type'       => 'lookup',
			'formField'  => 'client_input',
			'model'      => 'Client',
			'modelField' => 'code',
		),
		'date_range' => array(
			'type'       => 'expression',
			'method' 	 => 'dateFilter',
			'field'		 =>	'Reminder.date BETWEEN ? AND ?',
		),
	);
	public $order = array( 'Reminder.date' => 'ASC', 'Reminder.status' => 'DESC', 'Reminder.type' => 'DESC' );

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

	public static function models( $value = null ) {
		$options = array(
			self::MODEL_ASSET_NOTE    => __( 'Asset Note', true ),
			self::MODEL_DEBT_NOTE     => __( 'Debt Note', true ),
			self::MODEL_CREDITOR_NOTE => __( 'Creditor Note', true ),
			self::MODEL_CLIENT_NOTE   => __( 'Client Note', true ),
			self::MODEL_PERSON_NOTE   => __( 'Person Note', true ),
			self::MODEL_NOTE          => __( 'Reminder', true ),
			self::MODEL_LETTER        => __( 'Letter', true ),
		);

		return parent::enum( $value, $options );
	}

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
		$filter = array(
			'joins'      => array(),
			'conditions' => array(),
			'group'      => array(),
		);
		$filter['joins']      = array(
			array(
				'alias'      => 'Client',
				'table'      => 'clients',
				'type'       => 'LEFT',
				'conditions' => array(
					'Client.id = Reminder.client_id',
				),
			),
			array(
				'alias'      => 'FilterCentre',
				'table'      => 'centres',
				'type'       => 'LEFT',
				'conditions' => array(
					'OR' => array(
						'FilterCentre.id = Client.centre_id',
						'FilterCentre.id = Reminder.centre_id',
					),
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
			'OR' => array(
				array('Reminder.created_by' => Auth::id(), 'Client.id IS NULL'),
				array(
					'FilterCentreMembership.user_id' => Auth::id(),
					'FilterCentre.is_archived'       => '0',
					'OR'                             => array(
						'FilterCentreMembership.expiry_date IS NULL',
						'FilterCentreMembership.expiry_date > NOW()',
					),
				),
			),
		);
		$filter['group']      = array(
			'Reminder.id',
			'Reminder.model',
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

	public function dateFilter($data = array()) {
		if (strpos($data['date_range']) !== false) {
			$tmp = explode(' - ', $data['date_range']);
			return $tmp;
		}
	}
}
