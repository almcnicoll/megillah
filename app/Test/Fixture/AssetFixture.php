<?php
/**
 * AssetFixture
 *
 */
class AssetFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '19,5', 'unsigned' => false),
		'outstanding_amount' => array('type' => 'decimal', 'null' => false, 'default' => '0.00000', 'length' => '19,5', 'unsigned' => false),
		'creditor_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 1,
			'client_id' => 1,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 2,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 2,
			'client_id' => 2,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 3,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 3,
			'client_id' => 3,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 4,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 4,
			'client_id' => 4,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 5,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 5,
			'client_id' => 5,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 6,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 6,
			'client_id' => 6,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 7,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 7,
			'client_id' => 7,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 8,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 8,
			'client_id' => 8,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 9,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 9,
			'client_id' => 9,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:41'
		),
		array(
			'id' => 10,
			'name' => 'Lorem ipsum dolor sit amet',
			'value' => '',
			'outstanding_amount' => '',
			'creditor_id' => 10,
			'client_id' => 10,
			'created' => '2014-09-25 09:08:41',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:41',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:41'
		),
	);
}
