<div class="recipes view">
	<h2>
		<?php  echo __('Recipe'); ?>
	</h2>
	<dl>
		<dt>
			<?php echo __('Id'); ?>
		</dt>
		<dd>
			<?php echo h($recipe['Recipe']['id']); ?>
			&nbsp;
		</dd>
		<dt>
			<?php echo __('Name'); ?>
		</dt>
		<dd>
			<?php echo h($recipe['Recipe']['name']); ?>
			&nbsp;
		</dd>
		<dt>
			<?php echo __('Description'); ?>
		</dt>
		<dd>
			<?php echo h($recipe['Recipe']['description']); ?>
			&nbsp;
		</dd>
		<dt>
			<?php echo __('Source'); ?>
		</dt>
		<dd>
			<?php echo h($recipe['Recipe']['source']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3>
		<?php echo __('Actions'); ?>
	</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Recipe'), array('action' => 'edit', $recipe['Recipe']['id'])); ?>
		</li>
		<li><?php echo $this->Form->postLink(__('Delete Recipe'), array('action' => 'delete', $recipe['Recipe']['id']), null, __('Are you sure you want to delete # %s?', $recipe['Recipe']['id'])); ?>
		</li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('New Recipe'), array('action' => 'add')); ?>
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
<div class="related">
	<h3>
		<?php echo __('Related Directions'); ?>
	</h3>
	<?php if (!empty($recipe['Direction'])): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Recipe Id'); ?></th>
			<th><?php echo __('Order'); ?></th>
			<th><?php echo __('Direction'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($recipe['Direction'] as $direction): ?>
		<tr>
			<td><?php echo $direction['id']; ?></td>
			<td><?php echo $direction['recipe_id']; ?></td>
			<td><?php echo $direction['order']; ?></td>
			<td><?php echo $direction['direction']; ?></td>
			<td class="actions"><?php echo $this->Html->link(__('View'), array('controller' => 'directions', 'action' => 'view', $direction['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'directions', 'action' => 'edit', $direction['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'directions', 'action' => 'delete', $direction['id']), null, __('Are you sure you want to delete # %s?', $direction['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Direction'), array('controller' => 'directions', 'action' => 'add')); ?>
			</li>
		</ul>
	</div>
</div>
<div class="related">
	<h3>
		<?php echo __('Related Ingredients'); ?>
	</h3>
	<?php if (!empty($recipe['Ingredient'])): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Recipe Id'); ?></th>
			<th><?php echo __('Ingredient'); ?></th>
			<th><?php echo __('Amount'); ?></th>
			<th><?php echo __('Optional'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($recipe['Ingredient'] as $ingredient): ?>
		<tr>
			<td><?php echo $ingredient['id']; ?></td>
			<td><?php echo $ingredient['recipe_id']; ?></td>
			<td><?php echo $ingredient['ingredient']; ?></td>
			<td><?php echo $ingredient['amount']; ?></td>
			<td><?php echo $ingredient['optional']; ?></td>
			<td class="actions"><?php echo $this->Html->link(__('View'), array('controller' => 'ingredients', 'action' => 'view', $ingredient['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ingredients', 'action' => 'edit', $ingredient['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ingredients', 'action' => 'delete', $ingredient['id']), null, __('Are you sure you want to delete # %s?', $ingredient['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?>
			</li>
		</ul>
	</div>
</div>
