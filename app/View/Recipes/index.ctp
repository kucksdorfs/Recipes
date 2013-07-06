<div class="recipes index">
	<h2>
		<?php echo __('Recipes'); ?>
	</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?>
			</th>
			<th><?php echo $this->Paginator->sort('name'); ?>
			</th>
			<th><?php echo $this->Paginator->sort('description'); ?>
			</th>
			<th><?php echo $this->Paginator->sort('source'); ?>
			</th>
			<th class="actions"><?php echo __('Actions'); ?>
			</th>
		</tr>
		<?php foreach ($recipes as $recipe): ?>
		<tr>
			<td><?php echo h($recipe['Recipe']['id']); ?>&nbsp;</td>
			<td><?php echo h($recipe['Recipe']['name']); ?>&nbsp;</td>
			<td><?php echo h($recipe['Recipe']['description']); ?>&nbsp;</td>
			<td><?php echo h($recipe['Recipe']['source']); ?>&nbsp;</td>
			<td class="actions"><?php echo $this->Html->link(__('View'), array('action' => 'view', $recipe['Recipe']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recipe['Recipe']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recipe['Recipe']['id']), null, __('Are you sure you want to delete # %s?', $recipe['Recipe']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>
	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
<div class="actions">
	<h3>
		<?php echo __('Actions'); ?>
	</h3>
	<ul>
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
