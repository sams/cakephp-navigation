<div class="menuItems view">
<h2><?php  __('Menu Item');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Menu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menuItem['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menuItem['Menu']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Menu Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($menuItem['ParentMenuItem']['title'], array('controller' => 'menu_items', 'action' => 'view', $menuItem['ParentMenuItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menuItem['MenuItem']['title']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu Item', true), array('admin' => true, 'prefix' => 'navigation', 'action' => 'edit', $menuItem['MenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Menu Item', true), array('admin' => true, 'prefix' => 'navigation', 'action' => 'delete', $menuItem['MenuItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'prefix' => 'navigation', 'action' => 'index', $menuId)); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('admin' => true, 'prefix' => 'navigation', 'action' => 'add', $menuId)); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('admin' => true, 'prefix' => 'navigation', 'controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('admin' => true, 'prefix' => 'navigation', 'controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'prefix' => 'navigation', 'controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Menu Item', true), array('admin' => true, 'prefix' => 'navigation', 'controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Menu Items');?></h3>
	<?php if (!empty($menuItem['ChildMenuItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Menu Id'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Title'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menuItem['ChildMenuItem'] as $childMenuItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childMenuItem['id'];?></td>
			<td><?php echo $childMenuItem['menu_id'];?></td>
			<td><?php echo $childMenuItem['parent_id'];?></td>
			<td><?php echo $childMenuItem['name'];?></td>
			<td><?php echo $childMenuItem['url'];?></td>
			<td><?php echo $childMenuItem['title'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'view', $childMenuItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'edit', $childMenuItem['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'delete', $childMenuItem['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childMenuItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Menu Item', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
