<?php
/* Menus Test cases generated on: 2011-03-27 00:03:02 : 1301186282*/
App::import('Controller', 'Menus');

App::import('Lib', 'Templates.AppTestCase');
class MenusControllerTestCase extends AppTestCase {
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
		$this->Menus = AppMock::getTestController('MenusController');
		$this->Menus->constructClasses();
		$this->Menus->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array());
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
		unset($this->Menus);
		ClassRegistry::flush();
	}

/**
 * Convenience method to assert Flash messages
 *
 * @return void
 * @access public
 */
	public function assertFlash($message) {
		$flash = $this->Menus->Session->read('Message.flash');
		$this->assertEqual($flash['message'], $message);
		$this->Menus->Session->delete('Message.flash');
	}

/**
 * Test object instances
 *
 * @return void
 * @access public
 */
	public function testInstance() {
		$this->assertIsA($this->Menus, 'MenusController');
		//$this->assertIsA($this->Menus->Menu, 'Menu');
	}


/**
 * testAdminIndex
 *
 * @return void
 * @access public
 */
	public function testAdminIndex() {
		$this->Menus->admin_index();
		$this->assertTrue(!empty($this->Menus->viewVars['menus']));
	}

/**
 * testAdminAdd
 *
 * @return void
 * @access public
 */
	public function testAdminAdd() {
		$this->Menus->data = $this->record;
		unset($this->Menus->data['Menu']['id']);
		$this->Menus->admin_add();
		$this->Menus->expectRedirect(array('action' => 'index'));
		$this->assertFlash('The menu has been saved');
		$this->Menus->expectExactRedirectCount();
	}

/**
 * testAdminEdit
 *
 * @return void
 * @access public
 */
	public function testAdminEdit() {
		$this->Menus->admin_edit('menu-1');
		$this->assertEqual($this->Menus->data['Menu'], $this->record['Menu']);

		$this->Menus->data = $this->record;
		$this->Menus->admin_edit('menu-1');
		$this->Menus->expectRedirect(array('action' => 'view', 1));
		$this->assertFlash('Menu saved');
		$this->Menus->expectExactRedirectCount();
	}

/**
 * testAdminView
 *
 * @return void
 * @access public
 */
	public function testAdminView() {
		$this->Menus->admin_view('menu-1');
		$this->assertTrue(!empty($this->Menus->viewVars['menu']));

		$this->Menus->admin_view('WRONG-ID');
		$this->Menus->expectRedirect(array('action' => 'index'));
		$this->assertFlash('Invalid Menu');
		$this->Menus->expectExactRedirectCount();
	}

/**
 * testAdminDelete
 *
 * @return void
 * @access public
 */
	public function testAdminDelete() {
		$this->Menus->admin_delete('WRONG-ID');
		$this->Menus->expectRedirect(array('action' => 'index'));
		$this->assertFlash('Invalid Menu');

		$this->Menus->admin_delete('menu-1');
		$this->assertTrue(!empty($this->Menus->viewVars['menu']));

		$this->Menus->data = array('Menu' => array('confirmed' => 1));
		$this->Menus->admin_delete('menu-1');
		$this->Menus->expectRedirect(array('action' => 'index'));
		$this->assertFlash('Menu deleted');
		$this->Menus->expectExactRedirectCount();
	}


	
}
?>