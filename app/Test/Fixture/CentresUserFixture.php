<?php
/**
 * CentresUserFixture
 *
 */
class CentresUserFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'centre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'is_primary' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2, 'unsigned' => false),
		'expiry_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_centres_users_centres_1' => array('column' => 'centre_id', 'unique' => 0),
			'fk_centres_users_users_1' => array('column' => 'user_id', 'unique' => 0)
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
			'centre_id' => 1,
			'user_id' => 1,
			'is_primary' => 1,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 1
		),
		array(
			'id' => 2,
			'centre_id' => 2,
			'user_id' => 2,
			'is_primary' => 2,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 2
		),
		array(
			'id' => 3,
			'centre_id' => 3,
			'user_id' => 3,
			'is_primary' => 3,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 3
		),
		array(
			'id' => 4,
			'centre_id' => 4,
			'user_id' => 4,
			'is_primary' => 4,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 4
		),
		array(
			'id' => 5,
			'centre_id' => 5,
			'user_id' => 5,
			'is_primary' => 5,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 5
		),
		array(
			'id' => 6,
			'centre_id' => 6,
			'user_id' => 6,
			'is_primary' => 6,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 6
		),
		array(
			'id' => 7,
			'centre_id' => 7,
			'user_id' => 7,
			'is_primary' => 7,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 7
		),
		array(
			'id' => 8,
			'centre_id' => 8,
			'user_id' => 8,
			'is_primary' => 8,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 8
		),
		array(
			'id' => 9,
			'centre_id' => 9,
			'user_id' => 9,
			'is_primary' => 9,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 9
		),
		array(
			'id' => 10,
			'centre_id' => 10,
			'user_id' => 10,
			'is_primary' => 10,
			'expiry_date' => '2014-09-25 09:08:42',
			'created' => '2014-09-25 09:08:42',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:42',
			'modified_by' => 10
		),
	);
}
