<div class="directions view">
<h2><?php  echo __('Direction'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($direction['Direction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recipe'); ?></dt>
		<dd>
			<?php echo $this->Html->link($direction['Recipe']['name'], array('controller' => 'recipes', 'action' => 'view', $direction['Recipe']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($direction['Direction']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Direction'); ?></dt>
		<dd>
			<?php echo h($direction['Direction']['direction']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Direction'), array('action' => 'edit', $direction['Direction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Direction'), array('action' => 'delete', $direction['Direction']['id']), null, __('Are you sure you want to delete # %s?', $direction['Direction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Directions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Direction'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('controller' => 'recipes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recipe'), array('controller' => 'recipes', 'action' => 'add')); ?> </li>
	</ul>
</div>
