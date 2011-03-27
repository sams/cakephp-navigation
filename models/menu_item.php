<?php
class MenuItem extends AppModel {
/**
 * Name
 *
 * @var string $name
 * @access public
 */
	public $name = 'MenuItem';


/**
 * belongsTo association
 *
 * @var array $belongsTo 
 * @access public
 */
	public $belongsTo = array(
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'menu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentMenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * hasMany association
 *
 * @var array $hasMany
 * @access public
 */

	public $hasMany = array(
		'ChildMenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
	var $actsAs = array(	'Utils.List');



/**
 * Constructor
 *
 * @param mixed $id Model ID
 * @param string $table Table name
 * @param string $ds Datasource
 * @access public
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->validate = array(
		);
	}



	

/**
 * Adds a new record to the database
 *
 * @param string $menuId, Menu id
 * @param array post data, should be Contoller->data
 * @return array
 * @access public
 */
	public function add($menuId = null, $data = null) {
		if (!empty($data)) {
			$data['MenuItem']['menu_id'] = $menuId;
			$this->create();
			$result = $this->save($data);
			if ($result !== false) {
				$this->data = array_merge($data, $result);
				return true;
			} else {
				throw new OutOfBoundsException(__('Could not save the menuItem, please check your inputs.', true));
			}
			return $return;
		}
	}

/**
 * Edits an existing Menu Item.
 *
 * @param string $id, menu item id 
 * @param array $data, controller post data usually $this->data
 * @return mixed True on successfully save else post data as array
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function edit($id = null, $data = null) {
		$menuItem = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)));

		if (empty($menuItem)) {
			throw new OutOfBoundsException(__('Invalid Menu Item', true));
		}
		$this->set($menuItem);

		if (!empty($data)) {
			$this->set($data);
			$result = $this->save(null, true);
			if ($result) {
				$this->data = $result;
				return true;
			} else {
				return $data;
			}
		} else {
			return $menuItem;
		}
	}

/**
 * Returns the record of a Menu Item.
 *
 * @param string $id, menu item id.
 * @return array
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function view($id = null) {
		$menuItem = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id)));

		if (empty($menuItem)) {
			throw new OutOfBoundsException(__('Invalid Menu Item', true));
		}

		return $menuItem;
	}

/**
 * Validates the deletion
 *
 * @param string $id, menu item id 
 * @param array $data, controller post data usually $this->data
 * @return boolean True on success
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function move($id = null, $data = array()) {
	}

/**
 * Validates the deletion
 *
 * @param string $id, menu item id 
 * @param array $data, controller post data usually $this->data
 * @return boolean True on success
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function validateAndDelete($id = null, $data = array()) {
		$menuItem = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)));

		if (empty($menuItem)) {
			throw new OutOfBoundsException(__('Invalid Menu Item', true));
		}

		$this->data['menuItem'] = $menuItem;
		if (!empty($data)) {
			$data['MenuItem']['id'] = $id;
			$tmp = $this->validate;
			$this->validate = array(
				'id' => array('rule' => 'notEmpty'),
				'confirm' => array('rule' => '[1]'));

			$this->set($data);
			if ($this->validates()) {
				if ($this->delete($data['MenuItem']['id'])) {
					return true;
				}
			}
			$this->validate = $tmp;
			throw new Exception(__('You need to confirm to delete this Menu Item', true));
		}
	}


}
?>