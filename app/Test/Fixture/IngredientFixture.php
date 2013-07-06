<?php
/**
 * IngredientFixture
 *
 */
class IngredientFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'recipe_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ingredient' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'amount' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'optional' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id', 'recipe_id'), 'unique' => 1),
			'fk_Ingredients_1_idx' => array('column' => 'recipe_id', 'unique' => 0)
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
			'ingredient' => 'Lorem ipsum dolor sit amet',
			'amount' => 'Lorem ipsum dolor sit amet',
			'optional' => 1
		),
	);

}
