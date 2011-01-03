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
        
        
        /*
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
                
                debug($controller);
                debug($this);die();
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
            // convert __menus_for_layout to menus_for_layout
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
}


?>