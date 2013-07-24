<div class="actions">
	<h3>
		<?php echo __('Actions'); ?>
	</h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('List Directions'), array('controller' => 'directions', 'action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('New Direction'), array('controller' => 'directions', 'action' => 'add')); ?>
		</li>
		<li><?php echo $this->Html->link(__('List Ingredients'), array('controller' => 'ingredients', 'action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?>
		</li>
	</ul>
</div>