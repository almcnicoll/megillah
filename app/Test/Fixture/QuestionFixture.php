<?php
/**
 * QuestionFixture
 *
 */
class QuestionFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'text' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'rank' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'is_active' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2, 'unsigned' => false),
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
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 1,
			'rank' => 1,
			'is_active' => 1,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 2,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 2,
			'rank' => 2,
			'is_active' => 2,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 3,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 3,
			'rank' => 3,
			'is_active' => 3,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 4,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 4,
			'rank' => 4,
			'is_active' => 4,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 5,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 5,
			'rank' => 5,
			'is_active' => 5,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 6,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 6,
			'rank' => 6,
			'is_active' => 6,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 7,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 7,
			'rank' => 7,
			'is_active' => 7,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 8,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 8,
			'rank' => 8,
			'is_active' => 8,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 9,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 9,
			'rank' => 9,
			'is_active' => 9,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:54'
		),
		array(
			'id' => 10,
			'text' => 'Lorem ipsum dolor sit amet',
			'type' => 10,
			'rank' => 10,
			'is_active' => 10,
			'created' => '2014-09-25 09:08:54',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:54',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:54'
		),
	);
}
