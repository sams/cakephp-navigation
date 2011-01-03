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
  * function _get_setup
  * @param 
  */
 
 function _get_setup() {
  $i = 0;
  $navigations = false;
  $naviArr = array();
  $naviArr = $this->_iniFile['Navigation.Menus'];
  
   return array_keys($naviArr);
 }
 
  /*
   * function _get_navigation
   * @param 
   */
  
  function _get_navigation($name) {
   $i = 0;
   $Arr = $keys = $menu = array();
   //print_r($this->_iniFile);die();
   if(array_key_exists(ucfirst($name), $this->_iniFile)) {
    $Arr = $this->_iniFile[ucfirst($name)];
    
    $Keys = array_keys($Arr);
    
    foreach($Keys as $keyIndex => $keyValue) {
     $menu[$keyIndex]['display'] = $keyValue;
     $menu[$keyIndex]['link'] = Set::extract($keyValue, $Arr);
    }
   }
   
   return compact('menu');
  }  
    
    /*
     * function beforeRender
     * @param 
     */
    
    function beforeRender() {
       $menus = array();
       foreach($this->_get_setup() as $menu) {
	$menus[] = $this->_get_navigation($menu);
       }
        $this->_currentView->viewVars['navigation_for_layout'] = $menus;
    }
    
    /*
     * function create
     * @param $section named naivagtion
     * @param $array_items hardcoded items set by view
     * @param $options - leave null for default wrappers
     */
    
    function create($section = 'main', $array_items = array(), $options = null) {
     
     
     $_items = ''; $_options = array(); $link = $display = '';
     
     $items = $this->_iniFile[ucfirst($section).'.links'];
     $titles = $this->_iniFile[ucfirst($section).'.titles'];
     foreach($array_items as $k => $v) {
      $hitems[$v['display']] = $v['link'];
      if(isset($v['title'])) {
       $titles[$v['display']] = $v['title'];
      }
     }
     $items = array_merge($items, $hitems);
     
     
     foreach($items as $key => $item) {
      $options = (isset($titles[$key])) ? array_merge($_options, array('title' => $titles[$key])) : null;
      $_items.= $this->Html->link($key, $item, $options);
     }
     return $_items;
    }
 
 }


?>