<?php
App::uses( 'AppModel', 'Model' );

/**
 * Answer Model
 */
class Answer extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array();

	public $validate = array(
		'value' => array(
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
	);

	public $hasMany = array(
		'ClientResponse' => array(
			'className'  => 'ClientResponse',
			'foreignKey' => 'answer_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

}
