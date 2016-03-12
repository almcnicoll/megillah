<?php
/**
 * ClientsUserFixture
 *
 */
class ClientsUserFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = array(
		array(
			'id' => 1,
			'client_id' => 1,
			'user_id' => 1,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 1
		),
		array(
			'id' => 2,
			'client_id' => 2,
			'user_id' => 2,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 2
		),
		array(
			'id' => 3,
			'client_id' => 3,
			'user_id' => 3,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 3
		),
		array(
			'id' => 4,
			'client_id' => 4,
			'user_id' => 4,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 4
		),
		array(
			'id' => 5,
			'client_id' => 5,
			'user_id' => 5,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 5
		),
		array(
			'id' => 6,
			'client_id' => 6,
			'user_id' => 6,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 6
		),
		array(
			'id' => 7,
			'client_id' => 7,
			'user_id' => 7,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 7
		),
		array(
			'id' => 8,
			'client_id' => 8,
			'user_id' => 8,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 8
		),
		array(
			'id' => 9,
			'client_id' => 9,
			'user_id' => 9,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 9
		),
		array(
			'id' => 10,
			'client_id' => 10,
			'user_id' => 10,
			'created' => '2014-09-25 09:08:44',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:44',
			'modified_by' => 10
		),
	);
}
