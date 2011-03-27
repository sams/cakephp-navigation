<h2><?php echo sprintf(__('Delete Menu "%s"?', true), $menu['Menu']['title']); ?></h2>
<p>	
	<?php __('Be aware that your Menu and all associated data will be deleted if you confirm!'); ?>
</p>
<?php
	echo $this->Form->create('Menu', array(
		'url' => array(
			'action' => 'delete',
			$menu['Menu']['id'])));
	echo $form->input('confirm', array(
		'label' => __('Confirm', true),
		'type' => 'checkbox',
		'error' => __('You have to confirm.', true)));
	echo $form->submit(__('Continue', true));
	echo $form->end();
?>