<?php
App::uses( 'AppModel', 'Model' );

/**
 * ClientResponse Model
 *
 * @property Client         $Client
 * @property Answer         $Answer
 * @property ClientResponse $ParentClientResponse
 * @property ClientResponse $ChildClientResponse
 */
class ClientResponse extends AppModel {

	public $actsAs = array(
		'Loggable',
		'Tree',
		'Tools.WhoDidIt',
	);

	public $order = array();

	public $useTable = 'answers_clients';

	public $validate = array(
		'client_id'   => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'answer_id'   => array(
			'naturalNumber' => array(
				'rule'       => array( 'naturalNumber' ),
				'message'    => 'Please enter a valid number',
				'last'       => true,
				'required'   => false,
				'allowEmpty' => true,
			),
		),
		'question_id' => array(
			'naturalNumber' => array(
				'rule'    => array( 'naturalNumber' ),
				'message' => 'Please enter a valid number',
				'last'    => true,
			),
		),
		'value'       => array(
			'numeric' => array(
				'rule'    => array( 'numeric' ),
				'message' => 'valErrMandatoryField',
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
		'Client'               => array(
			'className'  => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Answer'               => array(
			'className'  => 'Answer',
			'foreignKey' => 'answer_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Question'             => array(
			'className'  => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'ParentClientResponse' => array(
			'className'  => 'ClientResponse',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	public $hasMany = array(
		'ChildClientResponse' => array(
			'className'  => 'ClientResponse',
			'foreignKey' => 'parent_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

}
