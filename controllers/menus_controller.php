<?php
class MenusController extends AppController {

	var $name = 'Menus';
	
	public function index() {
		
		$this->set('menus', $this->Menu->find('all'));
		
	}

}
?>