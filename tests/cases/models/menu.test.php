<?php
/* Menu Test cases generated on: 2011-03-27 00:03:04 : 1301185744*/
App::import('Model', 'Menu');

App::import('Lib', 'Templates.AppTestCase');
class MenuTestCase extends AppTestCase {
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
		$this->Menu = AppMock::getTestModel('Menu');
		$fixture = new MenuFixture();
		$this->record = array('Menu' => $fixture->records[0]);
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
		unset($this->Menu);
		ClassRegistry::flush();
	}

/**
 * Test adding a Menu 
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$data = $this->record;
		unset($data['Menu']['id']);
		$result = $this->Menu->add($data);
		$this->assertTrue($result);
		
		try {
			$data = $this->record;
			unset($data['Menu']['id']);
			//unset($data['Menu']['title']);
			$result = $this->Menu->add($data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
		
	}

/**
 * Test editing a Menu 
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$result = $this->Menu->edit('menu-1', null);

		$expected = $this->Menu->read(null, 'menu-1');
		$this->assertEqual($result['Menu'], $expected['Menu']);

		// put invalidated data here
		$data = $this->record;
		//$data['Menu']['title'] = null;

		$result = $this->Menu->edit('menu-1', $data);
		$this->assertEqual($result, $data);

		$data = $this->record;

		$result = $this->Menu->edit('menu-1', $data);
		$this->assertTrue($result);

		$result = $this->Menu->read(null, 'menu-1');

		// put record specific asserts here for example
		// $this->assertEqual($result['Menu']['title'], $data['Menu']['title']);

		try {
			$this->Menu->edit('wrong_id', $data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test viewing a single Menu 
 *
 * @return void
 * @access public
 */
	public function testView() {
		$result = $this->Menu->view('menu-1');
		$this->assertTrue(isset($result['Menu']));
		$this->assertEqual($result['Menu']['id'], 'menu-1');

		try {
			$result = $this->Menu->view('wrong_id');
			$this->fail('No exception on wrong id');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test ValidateAndDelete method for a Menu 
 *
 * @return void
 * @access public
 */
	public function testValidateAndDelete() {
		try {
			$postData = array();
			$this->Menu->validateAndDelete('invalidMenuId', $postData);
		} catch (OutOfBoundsException $e) {
			$this->assertEqual($e->getMessage(), 'Invalid Menu');
		}
		try {
			$postData = array(
				'Menu' => array(
					'confirm' => 0));
			$result = $this->Menu->validateAndDelete('menu-1', $postData);
		} catch (Exception $e) {
			$this->assertEqual($e->getMessage(), 'You need to confirm to delete this Menu');
		}

		$postData = array(
			'Menu' => array(
				'confirm' => 1));
		$result = $this->Menu->validateAndDelete('menu-1', $postData);
		$this->assertTrue($result);
	}
	
}
?>