<?php
App::uses( 'AppModel', 'Model' );

/**
 * Action Model
 */
class Action extends AppModel {

	const MODEL_ASSET_NOTE = 1;
	const MODEL_CLIENT_NOTE = 2;
	const MODEL_DEBT_NOTE = 3;
	const MODEL_PERSON_NOTE = 4;
	const MODEL_LETTER = 5;
	
	const RANGE_DEFAULT = 14;
	const RANGE_LAST_WEEK = 7;
	const RANGE_LAST_FORTNIGHT = 14;
	const RANGE_LAST_MONTH = 30;
	const RANGE_LAST_YEAR = 365;
	const RANGE_ALL_TIME = -1;
	
	public $actsAs = array( 'Tools.SoftDelete', 'Tools.WhoDidIt' );
	public $order = array( 'Action.created' => 'DESC' );

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
			self::MODEL_ASSET_NOTE  => __( 'Asset Note', true ),
			self::MODEL_DEBT_NOTE   => __( 'Debt Note', true ),
			self::MODEL_CLIENT_NOTE => __( 'Client Note', true ),
			self::MODEL_PERSON_NOTE => __( 'Person Note', true ),
			self::MODEL_LETTER      => __( 'Letter', true ),
		);

		return parent::enum( $value, $options );
	}
	
	public static function dateRanges( $value = null ) {
		$options = array(
			self::RANGE_LAST_WEEK  => __( 'Last Week', true ),
			self::RANGE_LAST_FORTNIGHT => __( 'Last Fortnight', true ),
			self::RANGE_LAST_MONTH => __( 'Last Month', true ),
			self::RANGE_LAST_YEAR => __( 'Last Year', true ),
			self::RANGE_ALL_TIME => __( 'All Time', true ),
		);

		return parent::enum( $value, $options );
	}

}
