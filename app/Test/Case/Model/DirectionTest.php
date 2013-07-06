<?php
App::uses('Direction', 'Model');

/**
 * Direction Test Case
 *
 */
class DirectionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.direction',
		'app.recipe'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Direction = ClassRegistry::init('Direction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Direction);

		parent::tearDown();
	}

}
