<?php
/**
 * DebtFixture
 *
 */
class DebtFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'amount' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '19,5', 'unsigned' => false),
		'account_code' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'reference' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'offer' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '19,5', 'unsigned' => false),
		'is_judgment' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'unsigned' => false),
		'is_pro_rata' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'unsigned' => false),
		'is_priority' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'unsigned' => false),
		'offer_frequency' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'creditor_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'debt_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 1,
			'is_pro_rata' => 1,
			'is_priority' => 1,
			'offer_frequency' => 1,
			'status' => 1,
			'client_id' => 1,
			'creditor_id' => 1,
			'debt_category_id' => 1,
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 2,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 2,
			'is_pro_rata' => 2,
			'is_priority' => 2,
			'offer_frequency' => 2,
			'status' => 2,
			'client_id' => 2,
			'creditor_id' => 2,
			'debt_category_id' => 2,
			'parent_id' => 2,
			'lft' => 2,
			'rght' => 2,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 3,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 3,
			'is_pro_rata' => 3,
			'is_priority' => 3,
			'offer_frequency' => 3,
			'status' => 3,
			'client_id' => 3,
			'creditor_id' => 3,
			'debt_category_id' => 3,
			'parent_id' => 3,
			'lft' => 3,
			'rght' => 3,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 4,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 4,
			'is_pro_rata' => 4,
			'is_priority' => 4,
			'offer_frequency' => 4,
			'status' => 4,
			'client_id' => 4,
			'creditor_id' => 4,
			'debt_category_id' => 4,
			'parent_id' => 4,
			'lft' => 4,
			'rght' => 4,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 5,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 5,
			'is_pro_rata' => 5,
			'is_priority' => 5,
			'offer_frequency' => 5,
			'status' => 5,
			'client_id' => 5,
			'creditor_id' => 5,
			'debt_category_id' => 5,
			'parent_id' => 5,
			'lft' => 5,
			'rght' => 5,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 6,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 6,
			'is_pro_rata' => 6,
			'is_priority' => 6,
			'offer_frequency' => 6,
			'status' => 6,
			'client_id' => 6,
			'creditor_id' => 6,
			'debt_category_id' => 6,
			'parent_id' => 6,
			'lft' => 6,
			'rght' => 6,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 7,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 7,
			'is_pro_rata' => 7,
			'is_priority' => 7,
			'offer_frequency' => 7,
			'status' => 7,
			'client_id' => 7,
			'creditor_id' => 7,
			'debt_category_id' => 7,
			'parent_id' => 7,
			'lft' => 7,
			'rght' => 7,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 8,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 8,
			'is_pro_rata' => 8,
			'is_priority' => 8,
			'offer_frequency' => 8,
			'status' => 8,
			'client_id' => 8,
			'creditor_id' => 8,
			'debt_category_id' => 8,
			'parent_id' => 8,
			'lft' => 8,
			'rght' => 8,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 9,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 9,
			'is_pro_rata' => 9,
			'is_priority' => 9,
			'offer_frequency' => 9,
			'status' => 9,
			'client_id' => 9,
			'creditor_id' => 9,
			'debt_category_id' => 9,
			'parent_id' => 9,
			'lft' => 9,
			'rght' => 9,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:47'
		),
		array(
			'id' => 10,
			'amount' => '',
			'account_code' => 'Lorem ipsum dolor sit amet',
			'reference' => 'Lorem ipsum dolor sit amet',
			'offer' => '',
			'is_judgment' => 10,
			'is_pro_rata' => 10,
			'is_priority' => 10,
			'offer_frequency' => 10,
			'status' => 10,
			'client_id' => 10,
			'creditor_id' => 10,
			'debt_category_id' => 10,
			'parent_id' => 10,
			'lft' => 10,
			'rght' => 10,
			'created' => '2014-09-25 09:08:47',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:47',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:47'
		),
	);
}