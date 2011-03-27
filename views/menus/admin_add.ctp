<div class="menus form">
<?php echo $this->Form->create('Menu', array('url' => array('action' => 'add')));?>
	<fieldset>
 		<legend><?php __('Admin Add Menu');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Menus', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>