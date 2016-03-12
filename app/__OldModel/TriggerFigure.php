<?php
App::uses( 'AppModel', 'Model' );

/**
 * TriggerFigure Model
 *
 * @property Country         $Country
 * @property TriggerCategory $TriggerCategory
 */
class TriggerFigure extends AppModel {

	const TYPE_FIRST_ADULT = 1;
	const TYPE_ADDITIONAL_ADULT = 2;
	const TYPE_CHILD_OVER_14 = 3;
	const TYPE_CHILD_UNDER_14 = 4;
	const TYPE_CAR = 5;
	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array( 'TriggerFigure.type' => 'ASC' );
	public $validate = array(
		'value'               => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'valErrMandatoryField',
				'last'    => true,
			),
		),
		'type'                => array(
			'validateEnum' => array(
				'rule'    => array( 'validateEnum', true ),
				'message' => 'Please select a value from the list',
				'last'    => true,
			),
		),
		'country_id'          => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'trigger_category_id' => array(
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
		'Country'         => array(
			'className'  => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'TriggerCategory' => array(
			'className'  => 'TriggerCategory',
			'foreignKey' => 'trigger_category_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public static function types( $value = null ) {
		$options = array(
			self::TYPE_FIRST_ADULT      => __( 'First Adult', true ),
			self::TYPE_ADDITIONAL_ADULT => __( 'Additional Adults', true ),
			self::TYPE_CHILD_OVER_14    => __( 'Child Over 14', true ),
			self::TYPE_CHILD_UNDER_14   => __( 'Child Under 14', true ),
			self::TYPE_CAR              => __( 'Car', true ),
		);

		return parent::enum( $value, $options );
	}

}
