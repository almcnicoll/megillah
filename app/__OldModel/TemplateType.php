<?php
App::uses( 'AppModel', 'Model' );

/**
 * TemplateType Model
 *
 * @property Template   $Template
 * @property MergeField $MergeField
 */
class TemplateType extends AppModel {

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
	);

	public $hasMany = array(
		'Template' => array(
			'className'  => 'Template',
			'foreignKey' => 'template_type_id',
			'dependent'  => false,
			'conditions' => '',
			'fields'     => '',
			'order'      => '',
		)
	);

	public $hasAndBelongsToMany = array(
		'MergeField' => array(
			'className'             => 'MergeField',
			'joinTable'             => 'merge_fields_template_types',
			'foreignKey'            => 'template_type_id',
			'associationForeignKey' => 'merge_field_id',
			'unique'                => 'keepExisting',
			'conditions'            => '',
			'fields'                => '',
			'order'                 => '',
		)
	);

}
