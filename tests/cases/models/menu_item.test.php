<?php
/* MenuItem Test cases generated on: 2011-03-27 00:03:32 : 1301187032*/
App::import('Model', 'MenuItem');

App::import('Lib', 'Templates.AppTestCase');
class MenuItemTestCase extends AppTestCase {
/**
 * Autoload entrypoint for fixtures dependecy solver
 *
 * @var string
 * @access public
 */
	public $plugin = 'app';

/**
 * Test to run for the test case (e.g array('testFind', 'testView'))
 * If this attribute is not empty only the tests from the list will be executed
 *
 * @var array
 * @access protected
 */
	protected $_testsToRun = array();

/**
 * Start Test callback
 *
 * @param string $method
 * @return void
 * @access public
 */
	public function startTest($method) {
		parent::startTest($method);
		$this->MenuItem = AppMock::getTestModel('MenuItem');
		$fixture = new MenuItemFixture();
		$this->record = array('MenuItem' => $fixture->records[0]);
	}

/**
 * End Test callback
 *
 * @param string $method
 * @return void
 * @access public
 */
	public function endTest($method) {
		parent::endTest($method);
		unset($this->MenuItem);
		ClassRegistry::flush();
	}

/**
 * Test adding a Menu Item 
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$data = $this->record;
		unset($data['MenuItem']['id']);
		$result = $this->MenuItem->add(99, $data);
		$this->assertTrue($result);
		
		try {
			$data = $this->record;
			unset($data['MenuItem']['id']);
			//unset($data['MenuItem']['title']);
			$result = $this->MenuItem->add(99, $data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
		
	}

/**
 * Test editing a Menu Item 
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$result = $this->MenuItem->edit('menuitem-1', null);

		$expected = $this->MenuItem->read(null, 'menuitem-1');
		$this->assertEqual($result['MenuItem'], $expected['MenuItem']);

		// put invalidated data here
		$data = $this->record;
		//$data['MenuItem']['title'] = null;

		$result = $this->MenuItem->edit('menuitem-1', $data);
		$this->assertEqual($result, $data);

		$data = $this->record;

		$result = $this->MenuItem->edit('menuitem-1', $data);
		$this->assertTrue($result);

		$result = $this->MenuItem->read(null, 'menuitem-1');

		// put record specific asserts here for example
		// $this->assertEqual($result['MenuItem']['title'], $data['MenuItem']['title']);

		try {
			$this->MenuItem->edit('wrong_id', $data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test viewing a single Menu Item 
 *
 * @return void
 * @access public
 */
	public function testView() {
		$result = $this->MenuItem->view('menuitem-1');
		$this->assertTrue(isset($result['MenuItem']));
		$this->assertEqual($result['MenuItem']['id'], 'menuitem-1');

		try {
			$result = $this->MenuItem->view('wrong_id');
			$this->fail('No exception on wrong id');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test ValidateAndDelete method for a Menu Item 
 *
 * @return void
 * @access public
 */
	public function testValidateAndDelete() {
		try {
			$postData = array();
			$this->MenuItem->validateAndDelete('invalidMenuItemId', $postData);
		} catch (OutOfBoundsException $e) {
			$this->assertEqual($e->getMessage(), 'Invalid Menu Item');
		}
		try {
			$postData = array(
				'MenuItem' => array(
					'confirm' => 0));
			$result = $this->MenuItem->validateAndDelete('menuitem-1', $postData);
		} catch (Exception $e) {
			$this->assertEqual($e->getMessage(), 'You need to confirm to delete this Menu Item');
		}

		$postData = array(
			'MenuItem' => array(
				'confirm' => 1));
		$result = $this->MenuItem->validateAndDelete('menuitem-1', $postData);
		$this->assertTrue($result);
	}
	
}
?>