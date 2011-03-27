<div class="menuItems index">
<h2><?php __('Menu Items');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('menu_id');?></th>
	<th><?php echo $this->Paginator->sort('parent_id');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('url');?></th>
	<th><?php echo $this->Paginator->sort('title');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($menuItems as $menuItem):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $menuItem['MenuItem']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($menuItem['Menu']['name'], array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'controller' => 'menus', 'action' => 'view', $menuItem['Menu']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($menuItem['ParentMenuItem']['title'], array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'view', $menuItem['ParentMenuItem']['id'])); ?>
		</td>
		<td>
			<?php echo $menuItem['MenuItem']['name']; ?>
		</td>
		<td>
			<?php echo $menuItem['MenuItem']['url']; ?>
		</td>
		<td>
			<?php echo $menuItem['MenuItem']['title']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'action' => 'view', $menuItem['MenuItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'action' => 'edit', $menuItem['MenuItem']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('admin' => true, 'prefix' => 'admin', 'plugin' => 'navigation', 'action' => 'delete', $menuItem['MenuItem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php echo $this->element('paging',array('plugin'=>'templates')); ?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'add', $menuId)); ?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Menu Item', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
