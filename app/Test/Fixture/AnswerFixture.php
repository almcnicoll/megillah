<?php
/**
 * AnswerFixture
 *
 */
class AnswerFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'question_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 1,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 2,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 2,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 3,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 3,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 4,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 4,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 5,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 5,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 6,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 6,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 7,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 7,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 8,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 8,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 9,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 9,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:22'
		),
		array(
			'id' => 10,
			'value' => 'Lorem ipsum dolor sit amet',
			'question_id' => 10,
			'created' => '2014-09-25 09:08:22',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:22',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:22'
		),
	);
}
