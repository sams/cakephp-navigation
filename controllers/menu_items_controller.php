<?php
class MenuItemsController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'MenuItems';

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
 * Admin index for menu item.
 *
 * @param string $menuId, Menu id 
 * @access public
 */
	public function admin_index($menuId) {
		$this->MenuItem->recursive = 0;
		$this->paginate['conditions'] = array('menu_id' => $menuId);
		$this->set('menuItems', $this->paginate());
		$this->set(compact('menuId')); 
	}

/**
 * Admin view for menu item.
 *
 * @param string $id, menu item id 
 * @access public
 */
	public function admin_view($id = null) {
		try {
			$menuItem = $this->MenuItem->view($id);
			$menuId = $menuItem['MenuItem']['menu_id'];
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
		
			$this->redirect('/');
		}
		$this->set(compact('menuItem'));
		$this->set(compact('menuId')); 
	}

/**
 * Admin add for menu item.
 *
 * @param string $menuId, Menu id 
 * @access public
 */
	public function admin_add($menuId) {
		try {
			$result = $this->MenuItem->add($menuId, $this->data);
			if ($result === true) {
				$this->Session->setFlash(__('The menu item has been saved', true));
				$this->redirect(array('action' => 'index', $menuId));
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'index', $menuId));
		}
		$menus = $this->MenuItem->Menu->find('list');
		$parentMenuItems = $this->MenuItem->ParentMenuItem->find('list');
		$this->set(compact('menus', 'parentMenuItems'));
		$this->set(compact('menuId')); 
	}

/**
 * Admin edit for menu item.
 *
 * @param string $id, menu item id 
 * @access public
 */
	public function admin_edit($id = null) {
		try {
			$result = $this->MenuItem->edit($id, $this->data);
			if ($result === true) {
		
				$menuId = $this->MenuItem->data['MenuItem']['menu_id'];
				$this->Session->setFlash(__('Menu Item saved', true));
				$this->redirect(array('action' => 'view', $this->MenuItem->data['MenuItem']['id']));
				
			} else {
				$this->data = $result;
		
				$menuId = $this->data['MenuItem']['menu_id'];
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect('/');
		}
		$menus = $this->MenuItem->Menu->find('list');
		$parentMenuItems = $this->MenuItem->ParentMenuItem->find('list');
		$this->set(compact('menus', 'parentMenuItems'));
		$this->set(compact('menuId')); 
	}

/**
 * Admin delete for menu item.
 *
 * @param string $id, menu item id 
 * @access public
 */
	public function admin_delete($id = null) {
		try {
			$menuItem = $this->MenuItem->view($id);
			$menuId = $menuItem['MenuItem']['menu_id'];			
			$this->set(compact('menuId')); 
			$result = $this->MenuItem->validateAndDelete($id, $this->data);
			if ($result === true) {
				$this->Session->setFlash(__('Menu item deleted', true));
				$this->redirect(array('action' => 'index', $menuId));
			}
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect('/');
		}
		if (!empty($this->MenuItem->data['menuItem'])) {
			$this->set('menuItem', $this->MenuItem->data['menuItem']);
		}
	}

}
?>