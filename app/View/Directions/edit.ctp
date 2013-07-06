<div class="directions form">
<?php echo $this->Form->create('Direction'); ?>
	<fieldset>
		<legend><?php echo __('Edit Direction'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('recipe_id');
		echo $this->Form->input('order');
		echo $this->Form->input('direction');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Direction.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Direction.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Directions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('controller' => 'recipes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recipe'), array('controller' => 'recipes', 'action' => 'add')); ?> </li>
	</ul>
</div>
