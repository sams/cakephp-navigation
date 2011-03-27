<?php
class MenusController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Menus';

/**
 * Helpers
 *
 * @var array
 * @access public
 */
	public $helpers = array('Html', 'Form');

	public function beforeFilter() {
		parent::beforeFilter(); 
	}

/**
 * Admin index for menu.
 * 
 * @access public
 */
	public function admin_index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate()); 
	}

/**
 * Admin view for menu.
 *
 * @param string $id, menu id 
 * @access public
 */
	public function admin_view($id = null) {
		try {
			$menu = $this->Menu->view($id);
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'index'));
		}
		$this->set(compact('menu')); 
	}

/**
 * Admin add for menu.
 * 
 * @access public
 */
	public function admin_add() {
		try {
			$result = $this->Menu->add($this->data);
			if ($result === true) {
				$this->Session->setFlash(__('The menu has been saved', true));
				$this->redirect(array('action' => 'index'));
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'index'));
		}
 
	}

/**
 * Admin edit for menu.
 *
 * @param string $id, menu id 
 * @access public
 */
	public function admin_edit($id = null) {
		try {
			$result = $this->Menu->edit($id, $this->data);
			if ($result === true) {
				$this->Session->setFlash(__('Menu saved', true));
				$this->redirect(array('action' => 'view', $this->Menu->data['Menu']['id']));
				
			} else {
				$this->data = $result;
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect('/');
		}
 
	}

/**
 * Admin delete for menu.
 *
 * @param string $id, menu id 
 * @access public
 */
	public function admin_delete($id = null) {
		try {
			$result = $this->Menu->validateAndDelete($id, $this->data);
			if ($result === true) {
				$this->Session->setFlash(__('Menu deleted', true));
				$this->redirect(array('action' => 'index'));
			}
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->Menu->data['menu'])) {
			$this->set('menu', $this->Menu->data['menu']);
		}
	}

}
?>