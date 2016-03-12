<?php
/**
 * IncomeFixture
 *
 */
class IncomeFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'amount' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '19,5', 'unsigned' => false),
		'frequency' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'comment' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'income_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'amount' => '',
			'frequency' => 1,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 1,
			'income_category_id' => 1,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 2,
			'amount' => '',
			'frequency' => 2,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 2,
			'income_category_id' => 2,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 3,
			'amount' => '',
			'frequency' => 3,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 3,
			'income_category_id' => 3,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 4,
			'amount' => '',
			'frequency' => 4,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 4,
			'income_category_id' => 4,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 5,
			'amount' => '',
			'frequency' => 5,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 5,
			'income_category_id' => 5,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 6,
			'amount' => '',
			'frequency' => 6,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 6,
			'income_category_id' => 6,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 7,
			'amount' => '',
			'frequency' => 7,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 7,
			'income_category_id' => 7,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 8,
			'amount' => '',
			'frequency' => 8,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 8,
			'income_category_id' => 8,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 9,
			'amount' => '',
			'frequency' => 9,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 9,
			'income_category_id' => 9,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:50'
		),
		array(
			'id' => 10,
			'amount' => '',
			'frequency' => 10,
			'comment' => 'Lorem ipsum dolor sit amet',
			'client_id' => 10,
			'income_category_id' => 10,
			'created' => '2014-09-25 09:08:50',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:50',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:50'
		),
	);
}
