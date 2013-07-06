<?php
/**
 * DirectionFixture
 *
 */
class DirectionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'recipe_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'order' => array('type' => 'integer', 'null' => false, 'default' => null),
		'direction' => array('type' => 'binary', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'recipe_id'), 'unique' => 1),
			'id_UNIQUE' => array('column' => 'id', 'unique' => 1),
			'fk_Directions_1_idx' => array('column' => 'recipe_id', 'unique' => 0)
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
			'recipe_id' => 1,
			'order' => 1,
			'direction' => 'Lorem ipsum dolor sit amet'
		),
	);

}
