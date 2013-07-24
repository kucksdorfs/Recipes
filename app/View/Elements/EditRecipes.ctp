<fieldset>
	<legend>
		<?php echo __('Add Recipe'); ?>
	</legend>
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('name', array('spellcheck' => 'true'));
	echo $this->Form->input('description', array('spellcheck' => 'true'));
	echo $this->Form->input('source');
	?>
</fieldset>
