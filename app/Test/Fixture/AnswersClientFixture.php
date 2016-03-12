<?php
/**
 * AnswersClientFixture
 *
 */
class AnswersClientFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'answer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'answer_id' => 1,
			'client_id' => 1,
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 1
		),
		array(
			'id' => 2,
			'answer_id' => 2,
			'client_id' => 2,
			'parent_id' => 2,
			'lft' => 2,
			'rght' => 2,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 2
		),
		array(
			'id' => 3,
			'answer_id' => 3,
			'client_id' => 3,
			'parent_id' => 3,
			'lft' => 3,
			'rght' => 3,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 3
		),
		array(
			'id' => 4,
			'answer_id' => 4,
			'client_id' => 4,
			'parent_id' => 4,
			'lft' => 4,
			'rght' => 4,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 4
		),
		array(
			'id' => 5,
			'answer_id' => 5,
			'client_id' => 5,
			'parent_id' => 5,
			'lft' => 5,
			'rght' => 5,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 5
		),
		array(
			'id' => 6,
			'answer_id' => 6,
			'client_id' => 6,
			'parent_id' => 6,
			'lft' => 6,
			'rght' => 6,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 6
		),
		array(
			'id' => 7,
			'answer_id' => 7,
			'client_id' => 7,
			'parent_id' => 7,
			'lft' => 7,
			'rght' => 7,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 7
		),
		array(
			'id' => 8,
			'answer_id' => 8,
			'client_id' => 8,
			'parent_id' => 8,
			'lft' => 8,
			'rght' => 8,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 8
		),
		array(
			'id' => 9,
			'answer_id' => 9,
			'client_id' => 9,
			'parent_id' => 9,
			'lft' => 9,
			'rght' => 9,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 9
		),
		array(
			'id' => 10,
			'answer_id' => 10,
			'client_id' => 10,
			'parent_id' => 10,
			'lft' => 10,
			'rght' => 10,
			'created' => '2014-09-25 09:08:40',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:40',
			'modified_by' => 10
		),
	);
}
