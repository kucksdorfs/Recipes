<div class="ingredients view">
<h2><?php  echo __('Ingredient'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ingredient['Ingredient']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recipe'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ingredient['Recipe']['name'], array('controller' => 'recipes', 'action' => 'view', $ingredient['Recipe']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ingredient'); ?></dt>
		<dd>
			<?php echo h($ingredient['Ingredient']['ingredient']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($ingredient['Ingredient']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Optional'); ?></dt>
		<dd>
			<?php echo h($ingredient['Ingredient']['optional']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ingredient'), array('action' => 'edit', $ingredient['Ingredient']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ingredient'), array('action' => 'delete', $ingredient['Ingredient']['id']), null, __('Are you sure you want to delete # %s?', $ingredient['Ingredient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ingredients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ingredient'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('controller' => 'recipes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recipe'), array('controller' => 'recipes', 'action' => 'add')); ?> </li>
	</ul>
</div>
