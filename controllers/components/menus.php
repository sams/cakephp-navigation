<?php

/*
 * class MenusComponent
 */

class MenusComponent extends object {
    
	
	var $__menus_for_layout;
	var $__settings;
/**
 * parsed ini file values.
 *
 * @var array
 */
  protected $_iniFile;
  protected $Controller;
        
        
/**
 * function __construct
 * @param $options
 */
		function __construct($options = array()) {
			if (!empty($options['iniFile'])) {
				$iniFile = $options['iniFile'];
			} else {
				$iniFile = CONFIGS . 'navigation.ini';
			}
			if (!file_exists($iniFile)) {
				$iniFile = App::pluginPath('Navigation') . 'config' . DS . 'config.ini';
			}
			$this->_iniFile = parse_ini_file($iniFile, true);
		}

/**
 * Called before the Controller::beforeFilter().
 *
 * @param object  A reference to the controller
 * @return void
 * @access public
 * @link http://book.cakephp.org/view/65/MVC-Class-Access-Within-Components
 */
	function initialize(&$controller, $settings = array()) {
		if (!isset($this->__settings[$controller->name])) {
			$settings = $this->__settings[$controller->name];
		}
		
		#debug($controller);
		#debug($this);die();
	}

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object  A reference to the controller
 * @return void
 * @access public
 * @link http://book.cakephp.org/view/65/MVC-Class-Access-Within-Components
 */
	function startup(&$controller) {
		// auto check if slug exists for controller action load if so
			$this->Controller = $controller;
	}

/**
 * addMenu
 * 
 * @param $arg
 * @return $arg
 */
	public function addMenu($slug) {
	  $this->__menus_for_layout[] = $slug;
	}

/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object  A reference to the controller
 * @return void
 * @access public
 */
	function beforeRender(&$controller) {
			$menus = array();
			// convert __menus_for_layout to menus_for_layout
			if($this->__menus_for_layout > array()) {
				foreach($this->__menus_for_layout as $slug) {
					$menus[$slug] = $this->_get_menu($slug);
				}
			}
			
			$this->Controller->set('navsForLayout', $menus);
	}

/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * @param object  A reference to the controller
 * @return void
 * @access public
 */
	function shutdown(&$controller) {
	}
        
	function _get_menu($slug = 'ss33') {
            App::import('Model', 'Navigation.Menu');
            $this->Menu = new Menu();
            $this->Menu->recursive = 1;
            return $this->Menu->findBySlug($slug);
	}
}


?>