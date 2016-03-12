<?php
App::uses( 'AppModel', 'Model' );

/**
 * MergeField Model
 *
 * @property TemplateType $TemplateType
 */
class MergeField extends AppModel {

	public $actsAs = array( 'Loggable', 'Tools.SoftDelete', 'Tools.WhoDidIt' );

	public $order = array();

	public $validate = array(
		'name' => array(
			'notEmpty'  => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
			'maxLength' => array(
				'rule'    => array( 'maxLength', 254 ),
				'message' => 'This field cannot be longer than 254 characters',
				'last'    => true,
			),
		),
		'code' => array(
			'notEmpty'  => array(
				'rule'    => array( 'notEmpty' ),
				'message' => 'This field is required',
				'last'    => true,
			),
			'maxLength' => array(
				'rule'    => array( 'maxLength', 254 ),
				'message' => 'This field cannot be longer than 254 characters',
				'last'    => true,
			),
		),
	);

	public $hasAndBelongsToMany = array(
		'TemplateType' => array(
			'className'             => 'TemplateType',
			'joinTable'             => 'merge_fields_template_types',
			'foreignKey'            => 'merge_field_id',
			'associationForeignKey' => 'template_type_id',
			'unique'                => 'keepExisting',
			'conditions'            => '',
			'fields'                => '',
			'order'                 => '',
		)
	);

}
