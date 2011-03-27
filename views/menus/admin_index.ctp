<div class="menus index">
<h2><?php __('Menus');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('slug');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($menus as $menu):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $menu['Menu']['id']; ?>
		</td>
		<td>
			<?php echo $menu['Menu']['name']; ?>
		</td>
		<td>
			<?php echo $menu['Menu']['slug']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'view', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'edit', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'delete', $menu['Menu']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php echo $this->element('paging',array('plugin'=>'templates')); ?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Menu', true), array('admin' => true, 'plugin' => 'navigation', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Item', true), array('admin' => true, 'plugin' => 'navigation', 'controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
