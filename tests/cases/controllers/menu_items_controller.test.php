<?php
/* MenuItems Test cases generated on: 2011-03-27 00:03:50 : 1301187050*/
App::import('Controller', 'MenuItems');

App::import('Lib', 'Templates.AppTestCase');
class MenuItemsControllerTestCase extends AppTestCase {
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
		$this->MenuItems = AppMock::getTestController('MenuItemsController');
		$this->MenuItems->constructClasses();
		$this->MenuItems->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array());
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
		unset($this->MenuItems);
		ClassRegistry::flush();
	}

/**
 * Convenience method to assert Flash messages
 *
 * @return void
 * @access public
 */
	public function assertFlash($message) {
		$flash = $this->MenuItems->Session->read('Message.flash');
		$this->assertEqual($flash['message'], $message);
		$this->MenuItems->Session->delete('Message.flash');
	}

/**
 * Test object instances
 *
 * @return void
 * @access public
 */
	public function testInstance() {
		$this->assertIsA($this->MenuItems, 'MenuItemsController');
		//$this->assertIsA($this->MenuItems->MenuItem, 'MenuItem');
	}


/**
 * testAdminIndex
 *
 * @return void
 * @access public
 */
	public function testAdminIndex() {
		$this->MenuItems->admin_index(1);
		$this->assertTrue(!empty($this->MenuItems->viewVars['menuItems']));
	}

/**
 * testAdminAdd
 *
 * @return void
 * @access public
 */
	public function testAdminAdd() {
		$this->MenuItems->data = $this->record;
		unset($this->MenuItems->data['MenuItem']['id']);
		$this->MenuItems->admin_add(1);
		$this->MenuItems->expectRedirect(array('action' => 'index', 1));
		$this->assertFlash('The menu item has been saved');
		$this->MenuItems->expectExactRedirectCount();
	}

/**
 * testAdminEdit
 *
 * @return void
 * @access public
 */
	public function testAdminEdit() {
		$this->MenuItems->admin_edit('menuitem-1');
		$this->assertEqual($this->MenuItems->data['MenuItem'], $this->record['MenuItem']);

		$this->MenuItems->data = $this->record;
		$this->MenuItems->admin_edit('menuitem-1');
		$this->MenuItems->expectRedirect(array('action' => 'view', 1));
		$this->assertFlash('Menu Item saved');
		$this->MenuItems->expectExactRedirectCount();
	}

/**
 * testAdminView
 *
 * @return void
 * @access public
 */
	public function testAdminView() {
		$this->MenuItems->admin_view('menuitem-1');
		$this->assertTrue(!empty($this->MenuItems->viewVars['menuItem']));

		$this->MenuItems->admin_view('WRONG-ID');
		$this->MenuItems->expectRedirect('/');

		$this->assertFlash('Invalid Menu Item');
		$this->MenuItems->expectExactRedirectCount();
	}

/**
 * testAdminDelete
 *
 * @return void
 * @access public
 */
	public function testAdminDelete() {
		$this->MenuItems->admin_delete('WRONG-ID');
		$this->MenuItems->expectRedirect('/');
		$this->assertFlash('Invalid Menu Item');

		$this->MenuItems->admin_delete('menuitem-1');
		$this->assertTrue(!empty($this->MenuItems->viewVars['menuItem']));

		$this->MenuItems->data = array('MenuItem' => array('confirmed' => 1));
		$this->MenuItems->admin_delete('menuitem-1');
		$this->MenuItems->expectRedirect(array('action' => 'index', 1));
		$this->assertFlash('Menu item deleted');
		$this->MenuItems->expectExactRedirectCount();
	}


	
}
?>