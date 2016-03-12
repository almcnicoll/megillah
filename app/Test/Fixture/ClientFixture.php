<?php
/**
 * ClientFixture
 *
 */
class ClientFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address_line_1' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address_line_2' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address_line_3' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'city' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'county' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'postcode' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'number_of_cars' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'centre_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'country_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 1,
			'centre_id' => 1,
			'country_id' => 1,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 1,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 1,
			'is_archived' => 1,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 2,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 2,
			'centre_id' => 2,
			'country_id' => 2,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 2,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 2,
			'is_archived' => 2,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 3,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 3,
			'centre_id' => 3,
			'country_id' => 3,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 3,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 3,
			'is_archived' => 3,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 4,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 4,
			'centre_id' => 4,
			'country_id' => 4,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 4,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 4,
			'is_archived' => 4,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 5,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 5,
			'centre_id' => 5,
			'country_id' => 5,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 5,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 5,
			'is_archived' => 5,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 6,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 6,
			'centre_id' => 6,
			'country_id' => 6,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 6,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 6,
			'is_archived' => 6,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 7,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 7,
			'centre_id' => 7,
			'country_id' => 7,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 7,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 7,
			'is_archived' => 7,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 8,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 8,
			'centre_id' => 8,
			'country_id' => 8,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 8,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 8,
			'is_archived' => 8,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 9,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 9,
			'centre_id' => 9,
			'country_id' => 9,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 9,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 9,
			'is_archived' => 9,
			'archived_date' => '2014-09-25 09:08:43'
		),
		array(
			'id' => 10,
			'code' => 'Lorem ipsum dolor sit amet',
			'address_line_1' => 'Lorem ipsum dolor sit amet',
			'address_line_2' => 'Lorem ipsum dolor sit amet',
			'address_line_3' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'postcode' => 'Lorem ipsum dolor sit amet',
			'number_of_cars' => 10,
			'centre_id' => 10,
			'country_id' => 10,
			'created' => '2014-09-25 09:08:43',
			'created_by' => 10,
			'modified' => '2014-09-25 09:08:43',
			'modified_by' => 10,
			'is_archived' => 10,
			'archived_date' => '2014-09-25 09:08:43'
		),
	);
}
