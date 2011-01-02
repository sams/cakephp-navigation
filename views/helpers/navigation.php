<?php

 /**
  * class NavigationHelper
  */
 
 class NavigationHelper extends AppHelper {
	public $helpers = array('Html');

/**
 * Disable autoInclusion of view js files.
 *
 * @var string
 */
	public $autoInclude = true;

/**
 * parsed ini file values.
 *
 * @var array
 */
	protected $_currentView;

/**
 * parsed ini file values.
 *
 * @var array
 */
	protected $_iniFile;

/**
 * Contains the build timestamp from the file.
 *
 * @var string
 */
	protected $_buildTimestamp;
    
/**
 * Constructor - finds and parses the ini file the plugin uses.
 *
 * @return void
 */
	public function __construct($options = array()) {
		if (!empty($options['iniFile'])) {
			$iniFile = $options['iniFile'];
		} else {
			$iniFile = CONFIGS . 'navigation.ini';
		}
		if (!file_exists($iniFile)) {
			$iniFile = App::pluginPath('Navigation') . 'config' . DS . 'config.ini';
		}
		$this->_iniFile = parse_ini_file($iniFile, true);
                
                $this->_currentView = &ClassRegistry::getObject('view');
	
        //die(debug($this->_iniFile));
        //die(debug($this));
        }
        
    

/**
 * Modify the runtime configuration of the helper.
 * Used as a get/set for the ini file values.
 * 
 * @param string $name The dot separated config value to change ie. Css.searchPaths
 * @param mixed $value The value to set the config to.
 * @return mixed Either the value being read or null.  Null also is returned when reading things that don't exist.
 */
	public function config($name, $value = null) {
		if (strpos($name, '.') === false) {
			return null;
		}
		list($section, $key) = explode('.', $name);
		if ($value === null) {
			return isset($this->_iniFile[$section][$key]) ? $this->_iniFile[$section][$key] : null;
		}
		$this->_iniFile[$section][$key] = $value;
	}

/**
 * Set options, merge with existing options.
 *
 * @return void
 */
	public function options($options) {
		$this->options = Set::merge($this->options, $options);
	}
 
  /*
   * function _get_navigation
   * @param 
   */
  
  function _get_navigation() {
   $i = 0;
   $main = $sidebar = $foot = false;
   $mainArr = $sidebarArr = $footArr = array();
   //print_r($this->_iniFile);die();
   if(array_key_exists('Main', $this->_iniFile)) {
    $mainArr = $this->_iniFile['Main'];
    
    $mainKeys = array_keys($mainArr);
    
    foreach($mainKeys as $keyIndex => $keyValue) {
     $main[$keyIndex]['display'] = $keyValue;
     $main[$keyIndex]['link'] = Set::extract($keyValue, $mainArr);
    }
   }
   
   if(array_key_exists('Foot', $this->_iniFile)) {
    $footArr = $this->_iniFile['Foot'];
    
    $footKeys = array_keys($footArr);
    
    foreach($mainKeys as $keyIndex => $keyValue) {
     $foot[$keyIndex]['display'] = $keyValue;
     $foot[$keyIndex]['link'] = Set::extract($keyValue, $footArr);
    }
   }
   
   if(array_key_exists('Sidebar', $this->_iniFile)) {
    $sidebarArr = $this->_iniFile['Foot'];
    
    $sidebarKeys = array_keys($footArr);
    
    foreach($mainKeys as $keyIndex => $keyValue) {
     $sidebar[$keyIndex]['display'] = $keyValue;
     $sidebar[$keyIndex]['link'] = Set::extract($keyValue, $sidebarArr);
    }
   }
   
   return compact('main', 'foot', 'sidebar');
  }  
    
    /*
     * function beforeRender
     * @param 
     */
    
    function beforeRender() {
        $this->_currentView->viewVars['navigation_for_layout'] = $this->_get_navigation();
    }
    
    /*
     * function create
     * @param $section named naivagtion
     * @param $array_items hardcoded items set by view
     * @param $options - leave null for default wrappers
     */
    
    function create($section = 'main', $array_items = array(), $options = null) {
     
     
     $_items = ''; $_options = array(); $link = $display = '';
     //print_r($this->_currentView->params);die();
     //print_r($this->_currentView->viewVars);//die();
     //$items = Set::classicExtract($this->_currentView->viewVars, 'navigation_for_layout.*');
     //Set::extract()
     //print_r($array_items);
     $items = Set::extract('/navigation_for_layout/main', $this->_currentView->viewVars);
     $hitems = $array_items;//Set::extract('main', $array_items);
     //print_r($items);//die();
     //print_r($hitems);//die();
     $items = array_merge($items, $hitems);
     //print_r($items);die();
     
     foreach($items[0]['main'] as $key => $item) {
      //print_r($key);
      //print_r($item);
      $_items.= $this->Html->link($item['display'], $item['link'], $_options);
     }
     return $_items;
    }
 
 }


?>