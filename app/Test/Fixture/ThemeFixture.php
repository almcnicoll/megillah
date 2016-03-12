<?php
/**
 * ThemeFixture
 *
 */
class ThemeFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'is_archived' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'unsigned' => false),
		'archived_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 2,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 3,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 4,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 5,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 6,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 7,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 8,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 9,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:56'
		),
		array(
			'id' => 10,
			'name' => 'Lorem ipsum dolor sit amet',
			'code' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-25 09:08:56',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:56',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:56'
		),
	);
}
