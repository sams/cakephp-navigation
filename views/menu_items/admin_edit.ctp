<div class="menuItems form">
<?php echo $this->Form->create('MenuItem', array('url' => array('action' => 'edit')));?>
	<fieldset>
 		<legend><?php __('Admin Edit Menu Item');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('menu_id', array('option' => $menus));
		echo $this->Form->input('parent_id', array('option' => $parentMenuItems));
		echo $this->Form->input('position');
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'delete', $this->Form->value('MenuItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'index', $menuId));?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Menu Item', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>