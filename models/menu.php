<?php
class Menu extends AppModel {
/**
 * Name
 *
 * @var string $name
 * @access public
 */
	public $name = 'Menu';
	//public $useTable = 'Menus';

/**
 * Display field name
 *
 * @var string
 * @access public
 */
	public $displayField = 'name';

/**
 * hasMany association
 *
 * @var array $hasMany
 * @access public
 */

	public $hasMany = array(
		'MenuItem' => array(
			'className' => 'MenuItem',
			'foreignKey' => 'menu_id',
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
 * @param array post data, should be Contoller->data
 * @return array
 * @access public
 */
	public function add($data = null) {
		if (!empty($data)) {
			$this->create();
			$result = $this->save($data);
			if ($result !== false) {
				$this->data = array_merge($data, $result);
				return true;
			} else {
				throw new OutOfBoundsException(__('Could not save the menu, please check your inputs.', true));
			}
			return $return;
		}
	}

/**
 * Edits an existing Menu.
 *
 * @param string $id, menu id 
 * @param array $data, controller post data usually $this->data
 * @return mixed True on successfully save else post data as array
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function edit($id = null, $data = null) {
		$menu = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)));

		if (empty($menu)) {
			throw new OutOfBoundsException(__('Invalid Menu', true));
		}
		$this->set($menu);

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
			return $menu;
		}
	}

/**
 * Returns the record of a Menu.
 *
 * @param string $id, menu id.
 * @return array
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function view($id = null) {
		$menu = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id)));

		if (empty($menu)) {
			throw new OutOfBoundsException(__('Invalid Menu', true));
		}

		return $menu;
	}

/**
 * Validates the deletion
 *
 * @param string $id, menu id 
 * @param array $data, controller post data usually $this->data
 * @return boolean True on success
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function validateAndDelete($id = null, $data = array()) {
		$menu = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)));

		if (empty($menu)) {
			throw new OutOfBoundsException(__('Invalid Menu', true));
		}

		$this->data['menu'] = $menu;
		if (!empty($data)) {
			$data['Menu']['id'] = $id;
			$tmp = $this->validate;
			$this->validate = array(
				'id' => array('rule' => 'notEmpty'),
				'confirm' => array('rule' => '[1]'));

			$this->set($data);
			if ($this->validates()) {
				if ($this->delete($data['Menu']['id'])) {
					return true;
				}
			}
			$this->validate = $tmp;
			throw new Exception(__('You need to confirm to delete this Menu', true));
		}
	}


}
?>